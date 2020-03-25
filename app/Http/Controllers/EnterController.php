<?php

namespace App\Http\Controllers;

use App\Entities\Call;
use App\Entities\Device;
use App\Entities\GuestCall;
use App\Entities\Guests\Guest;
use App\Entities\GuestSms;
use App\Entities\GuestVoucher;
use App\Entities\Radius;
use App\Entities\SessionsAuth;
use App\Entities\Spot;
use App\Entities\Stage;
use App\Entities\StatsGuest;
use App\Entities\UserAgent;
use App\Entities\Voucher;
use App\Services\Auth;
use Illuminate\Http\Request;

class EnterController extends Controller
{
    public function enter(Request $request)
    {
        $date = new \DateTime();
        $ident = $request->v1;
        $name = $request->v2;
        $device_mac = strtoupper($request->v3);
        $ip = $request->v4;
        $height = $request->screen_h;
        $width = $request->screen_w;
        $spot = Spot::whereIdent($ident)->first();
        //Любой девайс который законектился к нашей сети залетает в логи.
        $status = "Resolution";
        $temp = "$width x $height|";
        $this->formationLog($ident, $status, $device_mac, $temp);
        if (!$spot) {
            return response('F', 404);
        }
        $type = $spot->type;
        $request['type'] = $type;
        $device = Device::whereMac($device_mac)->first();

        $user['info'] = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_SPECIAL_CHARS);
        $devInfoHash = md5($user['info']);
        $user['signature'] = md5($name . $device_mac . $ip . 'TooManySecrets');

//        Есть в devices по mac?
//        Нет - записываем с дефолтными полями

        if ($device) {
            Device::whereMac($device_mac)->update(['created' => $date]);
        } else {
            Device::create(['created' => $date, 'screen_h' => $height, 'screen_w' => $width, 'mac' => $device_mac]);
        }

//        Проверяем наличие записи DeviceInfo в таблице user - agents
//        Есть - обновляем запись в devices
//        Нет - добавляем с дефолтными значениями

        $userinfo = UserAgent::whereUid($devInfoHash)->first();
        if ($userinfo) {
            UserAgent::whereUid($devInfoHash)->update(['info' => $user['info']]);
        } else {
            UserAgent::create(['uid' => $devInfoHash, 'info' => $user['info']]);
        }

//  Проверяем наличие записи в sessions . auth(соответствие зоны, мака и сигнатуры, не истекший expiration)
        //    Есть - обновляем counter и авторизируем устройство

        $session = SessionsAuth::whereSpot_id($spot->id)->whereDevice_mac($device_mac)
            ->whereSignature($user['signature'])->where('expiration', '>', $date)->first();
        if ($session) {
            $count = $session->counter;
            $count = $count + 1;
            SessionsAuth::whereDevice_mac($device_mac)->update(['created' => $date, 'counter' => $count]);
            $status = "SessionFound";
            $temp = $user['signature'];
            $this->formationLog($ident, $status, $device_mac, "$temp|");
            return $this->auth($device_mac, $session->expiration);
        }

//        Проверяем наличие записи в stages
//        Есть - передаем фронту данные записи

        $stages = Stage::whereSpot_id($spot->id)->whereDevice_mac($device_mac)->first();
        if ($stages) {
            $Phone = "?"; // на этом этапе у нас нет телефона
            $status = "StageCode";
            $temp = "$Phone|";
            $this->formationLog($ident, $status, $device_mac, $temp);
            return response(['stages' => $stages]);
        }
        $status = "StageBegin";
        $this->formationLog($ident, $status, $device_mac, "");

        return view('spot-template', ['data' => $request->all()]);
    }

//      Блок авторизации

    public function enterWithPhone(Request $request, $ident)
    {
        $date = new \DateTime();
        $day = $date->format('Y-m-d 00:00:00');
        $name = $request->v2;
        $device_mac = $request->v3;
        $ip = $request->v4;
        $spot = Spot::whereIdent($ident)->first();
        if (!$spot) {
            return response('Fake ident', 404);
        }
        $spot_id = $spot->id;
        //Начальная стадия, добавляем любой девайс который подключился к нашей

        $status = "CheckPhone";
        $this->formationLog($ident, $status, $device_mac, "");
        if (isset($request->phone)) {
            $phone = $this->checkCorrectPhoneNumber($request->phone);
            $phone_country = $this->checkPhoneCountry($phone);
        }
        $user['info'] = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_SPECIAL_CHARS);
        $devInfoHash = md5($user['info']);
        $user['signature'] = md5($name . $device_mac . $ip . 'TooManySecrets');
        $voucher_code = $request->code;
        $expiration = new \DateTime();
        $expiration->modify('+6 month');// такое себе решение, тупо меняет число в месяце
        $spot_type = $spot->type;
        $arrayForSession = ['spot_id' => $spot_id, 'date' => $date, 'expiration' => $expiration, 'device_mac' => $device_mac, 'signature' => $user['signature']];
        $arrayForGuest = ['company_id' => $spot->company_id, 'spot_id' => $spot_id, 'spot_type' => $spot_type, 'device_mac' => $device_mac];
//        $arrayForStats = ['date' => $day, 'company_id' => $spot->company_id, 'spot_id' => $spot_id, 'load' => 1, 'auth' => 2, 'new' => 1, 'old' => 2];

        switch ($spot_type) {
            case 1://   Смс
                $proverka = GuestSms::wherePhone($phone)->where('expiration', '>', $date)->first();
                if ($proverka) {
                    //Круто, должны перевести на другой эндпоинт
                    $status = "HaveCode";
                    $this->formationLog($ident, $status, $device_mac, "");
                    return 'You have a code';
                    //сообщаем фронту, что данный гость уже имеет код?
                } else {
                    // Новый пользователь.
                    $status = "NewPhone";
                    $this->formationLog($ident, $status, $device_mac, "");

//                    Лимиты смс, стоит узнать как правильно сделать.
//                    $CountDaySMS['phone']=DefaultSetting::where('sms_phone_limit',$phone)->where('');
//                    if ($CountDaySMS['phone']>=$LimitSMS || $CountDaySMS['mac']>=$LimitSMS ) {
//                    $status ="LimitSMS";
//                    $this->formationLog($ident, $status, $device_mac,"$phone|");
//                        echo "Limit";
//                    }

//                    Типо нельзя отправлять сообщения на телефон другой страны
                    $spot_country = "ru";
                    if ($spot_country == 'ru' && $phone_country == 'en') {
                        $status = "LimitSMSCountry";
                        $this->formationLog($ident, $status, $device_mac, "$phone|");
                        echo "OnlyRus";
                    }
                    $code = rand(1000, 9999);
                    GuestSms::create(['created' => $date, 'expiration' => $expiration, 'spot_id' => $spot->id,
                        'phone' => $phone, 'device_mac' => $device_mac, 'code' => $code]);
                    if ($phone_country == 'ru') {
                        $sms_message = "Ваш код: $code";
                    } else {
                        $sms_message = "Your code: $code";
                    }
                    //Тут функция для отправки СМС!
                    $sms_answer = $this->sendSms($phone, $sms_message);
                    if ($sms_answer == 'fail') {
                        $status = "SmsTimeout";
                        $this->formationLog($ident, $status, $device_mac, "$phone|");
                        return "SendSmsFail";
                    }
                    // отправляем СМС?
//                    $UID=GetStringPart($SMS_answer,',',0);
                    $status = "SmsSended";
                    $UID = "";
                    $temp = $UID;
                    $this->formationLog($ident, $status, $device_mac, "$temp|");
                    return 'Send sms';
                }
                break;
            case 2://   Звонки
                GuestCall::create(['created' => $date, 'expiration' => $expiration, 'phone' => $phone, 'device_mac' => $device_mac, 'spot_id' => $spot->id]);
                Stage::create(['created' => $date, 'spot_id' => $spot->id, 'device_mac' => $device_mac, 'phone' => $phone]);

                $calls = Call::where('phone', '=', $phone)->first();
                if ($calls) {
                    $guest_call = GuestCall::orderBy('created', 'DESC')->first();
                    $auth = $this->auth($device_mac, $guest_call->expiration);
                    $this->createSession($arrayForSession);
                    return $auth;
                }
                break;
            case 3://   Ваучеры
                $voucher = Voucher::whereCode($voucher_code)->where('dt_end', '>', $date)
//                    ->where('can_used', '>', 0)
                    ->first();
                if ($voucher) {
                    $test = GuestVoucher::whereVoucher_id($voucher->id)->count();
                    $can_used = $voucher->can_used;
                    if ($can_used > $test) {
                        GuestVoucher::create(['activated' => $date, 'expiration' => $expiration, 'voucher_id' => $voucher->id,
                            'device_mac' => $device_mac, 'spot_id' => $spot->id]);
                        $auth = $this->auth($device_mac, $voucher->dt_end);
                        if (isset($auth['user']) && isset($auth['password'])) {
                            //Если сессия есть чтоб не делать дубли, потому можно удалить
                            $session = SessionsAuth::whereSpot_id($spot->id)->whereDevice_mac($device_mac)
                                ->whereSignature($user['signature'])->where('expiration', '>', $date)->first();
                            if (!$session) {
                                $this->createSession($arrayForSession);
                            }
                            //
                            $this->createGuests($arrayForGuest, $voucher->id);
//                            $arrayForStats['auth'] = 1;
//                            $this->createStats($arrayForStats);
                            return response($auth);
                        } else
                            return response('user || password incorrect', 404);
                    } else {
                        return response('Закончились ваучеры', 404);
                    }
                } else {
                    $status = "IncorrectVoucher";
                    $this->formationLog($ident, $status, $device_mac, "");
                    return response('Voucher not found', 404);
                }
                break;
        }
    }

    public function auth($device_mac, $expiration)
    {
        $pass = md5("$device_mac" . "$expiration" . rand(1000, 9999));
        $username = md5("$expiration" . "$device_mac" . rand(1000, 9999));
        $date = new \DateTime($expiration);
        $exp = $date->format('d M Y H:m');

        Radius::create(['username' => $username, 'attribute' => 'Cleartext-Password', 'op' => ':=', 'value' => $pass]);
        Radius::create(['username' => $username, 'attribute' => 'Expiration', 'op' => ':=', 'value' => $exp]);
        return (['user' => $username, 'password' => $pass]);
    }

//        $contents = \File::get("$way");
//        $arr = Storage::get($way);

    function GetDevSignature($devInfo = "")
    {
        preg_match('~\(([^)]+)\)~', $devInfo, $matches);
        if (isset($matches[1])) return md5($matches[1]);
        $matches = explode(" ", $devInfo);
        if (isset($matches[0]) && strpos($devInfo, " ")) return md5($matches[0]);
        return md5($devInfo);
    }

    private function createSession($session_array)
    {
        SessionsAuth::create($session_array);
    }

    private function createGuests($guest_array, $data_auth)
    {
        Guest::create(array_merge($guest_array, ['data_auth' => $data_auth]));
    }

    //ужс
//    private function createStats($stat_array)
//    {
//        $guest_this_day = StatsGuest::whereDate($stat_array['day'])->whereSpot_id($stat_array['spot_id'])->first();
//        $old = $guest_this_day->old;
//        $auth = $guest_this_day->auth;
//        if (isset($stat_array['old'])) {
//            $stat_array['old'] = $old + $stat_array['old'];
//        }
//        if ($guest_this_day) {
//            if (isset($stat_array['auth'])) {
//                $stat_array['auth'] = $auth + $stat_array['auth'];
//            }
//            StatsGuest::update(['auth' => $stat_array['auth'], 'old' => $stat_array['old']]);
//        } else {
//            $new = $guest_this_day->new;
//            if (isset($stat_array['new'])) {
//                $stat_array['new'] = $new + $stat_array['new'];
//            }
//            StatsGuest::create($stat_array);
//        }
//    }

    private function checkCorrectPhoneNumber($phone)
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

    private function checkPhoneCountry($phone)
    {
        if (strlen($phone) === 11 && $phone[0] == '7' && $phone[1] == '9') {
            $phone_country = 'ru';
        } else {
            $phone_country = 'en';
        }
        return $phone_country;
    }

    private function formationLog($ident, $status, $device_mac, $temp)
    {
        $date = new \DateTime();
        $date_str = $date->format('Y-m-d H:m:s');
        $mac = strtolower($device_mac);
        $device_name = str_replace(':', '', $mac);
        $spot_name = strtolower($ident);
        $this->addToLog("devices/" . $device_name . ".log", "$date_str|$status|$ident|$temp");
        $this->addToLog("spots/" . $spot_name . ".log", "$date_str|$status|$device_mac|$temp");
        $this->addToLog("events.log", "$date_str|$status|$ident|$device_mac|$temp");
    }

    private function addToLog($way, $array)
    {
        \Storage::append($way, $array);
//        $name = strtolower($ident);
//        $way = "device/$name.log";
//        $log = "";
//        foreach ($array as $arr) {
//            $log .= "$arr|";
//        }
    }

    private function guestWasHere()
    {

    }

    private function sendSms($phone, $sms_message)
    {

    }
}
