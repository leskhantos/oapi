<?php

namespace App\Http\Controllers;

use App\Entities\Call;
use App\Entities\DefaultSetting;
use App\Entities\Device;
use App\Entities\GuestCall;
use App\Entities\GuestSms;
use App\Entities\Radius;
use App\Entities\SessionsAuth;
use App\Entities\Spot;
use App\Entities\Stage;
use App\Entities\UserAgent;
use App\Entities\Voucher;
use Illuminate\Http\Request;

const Resolution = "Resolution";

class EnterController extends Controller
{
    public function enter(Request $request)
    {

        $date = new \DateTime();
        $ident = $request->v1;
        $name = $request->v2;
        $device_mac = $request->v3;
        $mac = strtolower($request->v3);

        $ip = $request->v4;
        $height = $request->height;
        $width = $request->witdth;
        $spot = Spot::whereIdent($ident)->first();

        $s = str_replace(':', '', $mac);
        $ide = strtolower($ident);

        $date_str = $date->format('Y-m-d H:m:s');
        //Любой девайс который законектился к нашей сети залетает в логи.
        $this->addToLog("devices/" . $s . ".log", "$date_str|Resolution|$ident|$width x $height|");
        $this->addToLog("spots/" . $ide . ".log", "$date_str|Resolution|$device_mac|$width x $height|");
        $this->addToLog("events.log", "$date_str|Resolution|$ident|$device_mac|$width x $height|");

        if (!$spot) {
            return response('F', 404);
        }

        $type = $spot->type;
        $request['type'] = $type;
        $device = Device::whereMac($mac)->first();

        $User['info'] = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_SPECIAL_CHARS);
        $DevInfoHash = md5($User['info']);
        $User['signature'] = md5($name . $mac . $ip . 'TooManySecrets');

//        Есть в devices по mac?
//        Нет - записываем с дефолтными полями

        if ($device) {
            Device::whereMac($mac)->update(['created' => $date]);
        } else {
            Device::create(['created' => $date, 'screen_h' => $height, 'screen_w' => $width, 'mac' => $mac]);
        }

//        Проверяем наличие записи DeviceInfo в таблице user - agents
//        Есть - обновляем запись в devices
//        Нет - добавляем с дефолтными значениями

        $userinfo = UserAgent::whereUid($DevInfoHash)->first();
        if ($userinfo) {
            UserAgent::whereUid($DevInfoHash)->update(['info' => $User['info']]);
        } else {
            UserAgent::create(['uid' => $DevInfoHash, 'info' => $User['info']]);
        }

//  Проверяем наличие записи в sessions . auth(соответствие зоны, мака и сигнатуры, не истекший expiration)
        //    Есть - обновляем counter и авторизируем устройство

        $session = SessionsAuth::whereSpot_id($spot->id)->whereDevice_mac($mac)
            ->whereSignature($User['signature'])->where('expiration', '>', $date)->first();
        if ($session) {
            $count = $session->counter;
            $count = $count + 1;
            SessionsAuth::whereDevice_mac($mac)->update(['created' => $date, 'counter' => $count]);
            $this->addToLog("devices/" . $s . ".log", "$date_str|SessionFound|$ident|" . $User['signature'] . "|");
            $this->addToLog("spots/" . $ide . ".log", "$date_str|SessionFound|$device_mac|" . $User['signature'] . "|");
            $this->addToLog("events.log", "$date_str|SessionFound|$ident|$device_mac|" . $User['signature'] . "|");
            $this->auth($session);
        }

//        Проверяем наличие записи в stages
//        Есть - передаем фронту данные записи

        $stages = Stage::whereSpot_id($spot->id)->whereDevice_mac($mac)->first();
        if ($stages) {
            $Phone = "?";
            $this->addToLog("devices/" . $s . ".log", "$date_str|StageCode|$ident|$Phone|");
            $this->addToLog("spots/" . $ide . ".log", "$date_str|StageCode|$device_mac|$Phone");
            $this->addToLog("events.log", "$date_str|StageCode|$ident|$device_mac|$Phone|");
            return response(['stages' => $stages]);
        }
        $this->addToLog("devices/" . $s . ".log", "$date_str|StageBegin|$ident|");
        $this->addToLog("spots/" . $ide . ".log", "$date_str|StageBegin|$device_mac|");
        $this->addToLog("events.log", "$date_str|StageBegin|$ident|$device_mac|");
        return view('spot-template', ['data' => $request->all()]);
    }

//      Блок авторизации

    public function enterWithPhone(Request $request, $ident)
    {
        $date = new \DateTime();
        $device_mac = $request->v3;
        $date_str = $date->format('Y-m-d H:m:s');
        $mac = strtolower($request->v3);
        $s = str_replace(':', '', $mac);  // mac мелкими буквами без двоеточий
        $ide = strtolower($ident); // идент мелкими буквами.

        $spot = Spot::whereIdent($ident)->first();
        if (!$spot) {
            return response('Fake ident', 404);
        }
        //Начальная стадия, добавляем любой девайс который подключился к нашей
        $this->addToLog("devices/" . $s . ".log", "$date_str|CheckPhone|$ident|");
        $this->addToLog("spots/" . $ide . ".log", "$date_str|CheckPhone|$device_mac|");
        $this->addToLog("events.log", "$date_str|CheckPhone|$ident|$device_mac|");
        if (isset($request->phone)) {
            $phone = $this->checkCorrectPhoneNumber($request->phone);
            $phone_country = $this->checkPhoneCountry($phone);
        }
        $voucher_code = $request->code;
        $mac = strtolower($request->v3);

        $expiration = new \DateTime();
        $expiration->modify('+6 month');// такое себе решение, тупо меняет число в месяце
        $spot_type = $spot->type;

        switch ($spot_type) {
            case 1://   Смс
                $proverka = GuestSms::wherePhone($phone)->where('expiration', '>', $date)->first();
                if ($proverka) {
                    //Круто, должны перевести на другой эндпоинт

                    $this->addToLog("devices/" . $s . ".log", "$date_str|HaveCode|$ident|");
                    $this->addToLog("spots/" . $ide . ".log", "$date_str|HaveCode|$device_mac|");
                    $this->addToLog("events.log", "$date_str|HaveCode|$ident|$device_mac|");
                    return 'You have a code';
                    //сообщаем фронту, что данный гость уже имеет код?
                } else {
                    // Новый пользователь.

                    $this->addToLog("devices/" . $s . ".log", "$date_str|NewPhone|$ident|");
                    $this->addToLog("spots/" . $ide . ".log", "$date_str|NewPhone|$device_mac|");
                    $this->addToLog("events.log", "$date_str|NewPhone|$ident|$device_mac|");

//                    Лимиты смс, стоит узнать как правильно сделать.
//                    $CountDaySMS['phone']=DefaultSetting::where('sms_phone_limit',$phone)->where('');
//                    if ($CountDaySMS['phone']>=$LimitSMS || $CountDaySMS['mac']>=$LimitSMS ) {
//                        $this->addToLog("devices/" . $s . ".log", "$date_str|LimitSMS|$ident|$phone");
//                        $this->addToLog("spots/" . $ide . ".log", "$date_str|LimitSMS|$device_mac|$phone");
//                        $this->addToLog("events.log", "$date_str|LimitSMS|$ident|$device_mac|$phone");
//                        echo "Limit";
//                    }

                    //типо нельзя отправлять сообщения на телефон другой страны
                    if ($spot_country == 'ru' && $phone_country == 'en') {
                        $this->addToLog("devices/" . $s . ".log", "$date_str|LimitSMSCountry|$ident|$phone");
                        $this->addToLog("spots/" . $ide . ".log", "$date_str|LimitSMSCountry|$device_mac|$phone");
                        $this->addToLog("events.log", "$date_str|LimitSMSCountry|$ident|$device_mac|$phone");
                        echo "OnlyRus";
                    }
                    $code = rand(1000, 9999);
                    GuestSms::create(['created' => $date, 'expiration' => $expiration, 'spot_id' => $spot->id,
                        'phone' => $phone, 'device_mac' => $mac, 'code' => $code]);
                    if ($phone_country == 'ru') {
                        $sms_message = "Ваш код: $code";
                    } else {
                        $sms_message = "Your code: $code";
                    }
                    //Тут функция для отправки СМС!
                    $sms_answer = sendSms($phone, $sms_message);
                    if ($sms_answer == 'fail') {
                        $this->addToLog("devices/" . $s . ".log", "$date_str|SmsTimeout|$ident|$phone|");
                        $this->addToLog("spots/" . $ide . ".log", "$date_str|SmsTimeout|$device_mac|$phone|");
                        $this->addToLog("events.log", "$date_str|SmsTimeout|$ident|$device_mac|$phone|");
                        return "SendSmsFail";
                    }
                    // отправляем СМС?
//                    $UID=GetStringPart($SMS_answer,',',0);
                    $this->addToLog("devices/" . $s . ".log", "$date_str|SmsSended|$ident|$UID|");
                    $this->addToLog("spots/" . $ide . ".log", "$date_str|SmsSended|$device_mac|$UID|");
                    $this->addToLog("events.log", "$date_str|SmsSended|$ident|$device_mac|$UID|");
                    return 'Send sms';
                }
                break;
            case 2://   Звонки
                GuestCall::create(['created' => $date, 'expiration' => $expiration, 'phone' => $phone, 'device_mac' => $mac, 'spot_id' => $spot->id]);
                Stage::create(['created' => $date, 'spot_id' => $spot->id, 'device_mac' => $mac, 'phone' => $phone]);

                $calls = Call::where('phone', '=', $phone)->first();
                if ($calls) {
                    $guestcall = GuestCall::orderBy('created', 'DESC')->first();
                    $this->auth($guestcall);
                }
                break;
            case 3://   Ваучеры
                $voucher = Voucher::whereCode($voucher_code)->where('dt_end', '>', $date)
                    ->where('can_used', '>', 0)
                    ->first();
                if ($voucher) {
                    $can_used = $voucher->can_used;
                    $new = $can_used - 1;
                    $voucher->update(['can_used' => $new]);
                    $this->auth($voucher);
                } else {
                    return ('Voucher not found');
                }
                break;
        }
    }

    public function auth($array)
    {
        $pass = md5("$array->device_mac" . rand(1000, 9999));
        $username = md5("$array->expiration" . rand(1000, 9999));
        $date = new \DateTime($array->expiration);
        $exp = $date->format('d F Y H:m');

        Radius::create(['username' => $username, 'attribute' => 'Cleartext-Password', 'op' => ':=', 'value' => $pass]);
        Radius::create(['username' => $username, 'attribute' => 'Expiration', 'op' => ':=', 'value' => $exp]);
        dd('done.');
    }

//        $contents = \File::get("$way");
//        $arr = Storage::get($way);

    function GetDevSignature($DevInfo = "")
    {
        preg_match('~\(([^)]+)\)~', $DevInfo, $matches);
        if (isset($matches[1])) return md5($matches[1]);
        $matches = explode(" ", $DevInfo);
        if (isset($matches[0]) && strpos($DevInfo, " ")) return md5($matches[0]);
        return md5($DevInfo);
    }

    function checkCorrectPhoneNumber($phone)
    {
        $onlyNumeralPattern = "/[^0-9]/i";
        $normalized_phone = preg_replace($onlyNumeralPattern, '', $phone);
        if (strlen($normalized_phone) < 11) {
            return 'incorrect phone number';
        }
        if ($normalized_phone[0] == '8' && $normalized_phone[1] == '9') {
            $normalized_phone[0] = '7';
        }
        return $normalized_phone;
    }

    public function checkPhoneCountry($phone)
    {
        if (strlen($phone) === 11 && $phone[0] == '7' && $phone[1] == '9') {
            $phone_country = 'ru';
        } else {
            $phone_country = 'en';
        }
        return $phone_country;
    }

    public function addToLog($way, $array)
    {
//        $name = strtolower($ident);
//        $way = "device/$name.log";
//        $log = "";
//        foreach ($array as $arr) {
//            $log .= "$arr|";
//        }
        \Storage::append($way, $array);
    }
}
