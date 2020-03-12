<?php

namespace App\Http\Controllers;

use App\Entities\Device;
use App\Entities\GuestCall;
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
        return Spot::create($request->all());
    }

    public function saveLogsBySpot(Request $request) // Тупо запись в файл данных
    {
        $date = new \DateTime();
        $ident = $request->v1;
        $name = $request->v2;
        $mac = $request->v3;
        $ip = $request->v4;
        $spot = Spot::whereIdent($ident)->first();
        if (!$spot) {
            return response('F', 404);
        }

        $device = Device::whereMac($mac)->first();

        $User['info'] = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_SPECIAL_CHARS);
        $DevInfoHash = md5($User['info']);

        $User['signature'] = md5($name . $mac . $ip . 'TooManySecrets');

        $array = $request->all();

//        Есть в devices по mac?
//        Нет - записываем с дефолтными полями

        if ($device) {
            Device::whereMac($mac)->update(['created' => $date]);
        } else {
            Device::create(['created' => $date, 'mac' => $mac]);
        }

//        Проверяем наличие записи DeviceInfo в таблице user - agents
//        Есть - обновляем запись в devices
//        Нет - добавляем с дефолтными значениями
//    Есть - обновляем запись

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
        }

//  Проверяем наличие записи в stages
//    Есть - передаем фронту данные записи

        $stages = Stage::whereSpot_id($spot->id)->whereDevice_mac($mac)->first();
        if ($stages) {
            return 123;
        }

        $vibor = [1, 2, 3];
        $phone ="";  // ДОЛЖЕН ПРИЙТИ
        switch ($vibor) {
            case 1:
                break;//SMS
            case 2:
                GuestCall::create(['phone' => 123]);
                Stage::create(['created' => $date, 'spot_id' => $spot->id, 'device_mac' => $mac, 'phone' =>$phone]);
                break;//CALL
            case 3:
                break;//VOUCHER
        }

        $name = strtolower($spot->ident);
        $name .= ".log";

        $result = "";
        foreach ($array as $arr) {
            $result .= "$arr|";
        }

        Storage::append($name, $result);

//        $contents =\File::get("$way");

        return view('test', $request->all());
    }

    public function update(SpotsUpdateRequest $request, $id)
    {
        $spot = Spot::findOrFail($id);
        $spot->update($request->all());
        return $spot;
    }
}
