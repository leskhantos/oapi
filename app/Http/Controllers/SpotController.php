<?php

namespace App\Http\Controllers;

use App\Entities\Call;
use App\Entities\Device;
use App\Entities\GuestCall;
use App\Entities\GuestSms;
use App\Entities\GuestVoucher;
use App\Entities\SessionsAuth;
use App\Entities\Sms;
use App\Entities\Spot;
use App\Entities\Stage;
use App\Entities\UserAgent;
use App\Helpers\Helper;
use App\Http\Requests\Api\Spot\SpotsStoreRequest;
use App\Http\Requests\Api\Spot\SpotsUpdateRequest;
use App\Repositories\Interfaces\SpotRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class SpotController extends Controller
{
    private $spotRepository;

    public function __construct(SpotRepositoryInterface $spotRepository)
    {
        $this->spotRepository = $spotRepository;
        parent::__construct();
    }

    public function spotsByCompany($company_id)
    {
        return $this->spotRepository->spotByCompany($company_id);
    }

    public function callBySpot($spot_id, Request $request)
    {
        return $this->spotRepository->callBySpot($spot_id, $request);
    }

    public function spotTypesByCompany($spot_id)
    {
        return $this->spotRepository->spotTypesByCompany($spot_id);
    }

    public function smsBySpot($id, Request $request)
    {
        return $this->spotRepository->smsBySpot($id, $request);
    }

    public function eventsBySpot($id)
    {
        return $this->spotRepository->eventsBySpot($id);
    }

    public function create(Request $request)
    {
        return GuestCall::create($request->all());
    }

    public function test(Request $request)
    {
        return Sms::create($request->all());
    }

    public function show($id)
    {
        return Spot::leftJoin('spots_types', 'spots.type', '=', 'spots_types.id')->findOrFail($id);
    }

    public function store(SpotsStoreRequest $request)
    {
        $debug = md5("$request->address.$request->ident", false);
        return Spot::create(array_merge($request->validated(), ['debug_key' => $debug]));
    }

    // Проводим проверку данных с микротика, передаём их на фронт.
    public function saveLogsBySpot(Request $request)
    {
        $date = new \DateTime();
        $ident = $request->v1;
        $name = $request->v2;
        $mac = $request->v3;
        $ip = $request->v4;

        $array = $request->all();

        $spot = Spot::whereIdent($ident)->first();
        if (!$spot) {
            return response('F', 404);
        }
//        $this->auth($request, $spot);

        $device = Device::whereMac($mac)->first();

//        Есть в devices по mac?
//        Нет - записываем с дефолтными полями

        if ($device) {
            Device::whereMac($mac)->update(['created' => $date]);
        } else {
            Device::create(['created' => $date, 'mac' => $mac]);
        }

        $User['info'] = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_SPECIAL_CHARS);
        $DevInfoHash = md5($User['info']);
        $User['signature'] = md5($name . $mac . $ip . 'TooManySecrets');

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
            SessionsAuth::whereMac($mac)->update(['created' => $date, 'counter' => $count]);
//            $this->auth(); как правильна
        }

//  Проверяем наличие записи в stages
//    Есть - передаем фронту данные записи

        $stages = Stage::whereSpot_id($spot->id)->whereDevice_mac($mac)->first();
        if ($stages) {
            return $stages;
        }

        return view('test', $request->all());
    }

//      тут мы получаем номер телефона и скорее всего тип спота, дальше идём обрабатывать данные

    public function auth2(Request $request, $spot)
    {
        $ident = $request->v1;
        $name = $request->v2;
        $mac = $request->v3;
        $ip = $request->v4;
        $date = new \DateTime();
        $expiration = new \DateTime();
        $expiration->modify('+6 month');// такое себе решение, тупо меняет число в месяце
        $spot_type = 4;
        $phone = 8768768;

        switch ($spot_type) {
            case 1://   Смс
                $proverka = GuestSms::wherePhone($phone)->where('expiration', '>', $date)->first();
                if ($proverka) {
                    return 'cod est`';
                    //сообщаем фронту, что данный гость уже имеет код?
                } else {
                    $code = rand(1000, 9999);
                    GuestSms::create(['created' => $date, 'expiration' => $expiration, 'spot_id' => $spot->id,
                        'phone' => $phone, 'device_mac' => $mac, 'code' => $code]);
                    // отправляем СМС?
                    return 'otpravil sms';
                }
                break;
            case 2://   Звонки
                GuestCall::create(['phone' => $phone]);
                Stage::create(['created' => $date, 'spot_id' => $spot->id, 'device_mac' => $mac, 'phone' => $phone]);
                $proverka = Call::wherePhone($phone)->first();
                if ($proverka) {
                    GuestCall::update(['phone' => $phone]);
                }
                break;
            case 3://   Ваучеры
                $voucher = GuestVoucher::whereDevice_mac($mac)->where('expiration', '>', $date)->first();
                if ($voucher) {
                    return ('авторизируем');
                }
                break;
        }
    }

    // тут происходит сама авторизация

    public function auth3(Request $request)
    {
        // avtorizuem
    }

//        $contents =\File::get("$way");
//        $arr = Storage::get($way);

    public function logs($array, $name)
    {
//        $name = strtolower($spot->ident);
        $way = "device/$name.log";
        $log = "";
        foreach ($array as $arr) {
            $log .= "$arr|";
        }
        Storage::append($way, $log);
//
        return response('Log успешно сохранён',200);
    }

    function GetDevSignature($DevInfo = "")
    {
        preg_match('~\(([^)]+)\)~', $DevInfo, $matches);
        if (isset($matches[1])) return md5($matches[1]);
        $matches = explode(" ", $DevInfo);
        if (isset($matches[0]) && strpos($DevInfo, " "))
            return md5($matches[0]);
        return md5($DevInfo);
    }

    public function update(SpotsUpdateRequest $request, $id)
    {
        $spot = Spot::findOrFail($id);
        $spot->update($request->all());
        return $spot;
    }
}
