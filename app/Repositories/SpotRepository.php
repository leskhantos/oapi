<?php

namespace App\Repositories;

use App\Entities\GuestCall;
use App\Entities\Sms;
use App\Entities\Spot;
use App\Entities\Company;
use App\Helpers\Helper;
use App\Repositories\Interfaces\SpotRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpotRepository implements SpotRepositoryInterface
{
    public function spotByCompany($id)
    {
        $company = Company::findOrFail($id);
        $spot = Spot::
        select('spots.id', 'spots.company_id', 'styles.name as page_name',
            'spots.last_active', 'spots.ident', 'address',
            'spots.type', 'spots.style_id as page_id', 'spots.enabled')
            ->leftJoin('styles', 'style_id', '=', 'styles.id')
            ->where('spots.company_id', '=', $company->id)
            ->get();

        return response($spot);
    }

    public function spotTypesByCompany($id)
    {
        $company = Company::findOrFail($id);
        $spot = Spot::select('spots_types.id', 'spots_types.name')
            ->leftJoin('spots_types', 'spots.type', '=', 'spots_types.id')
            ->where('spots.company_id', '=', $company->id)->get()->toArray();
        $uniq_arr = [];
        foreach ($spot as $key => $value) {
            if (!in_array($value, $uniq_arr)) {
                $uniq_arr[] = $value;
            }
        }

        return response($uniq_arr);
    }

    public function callBySpot($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $spot = Spot::findOrFail($id);
        $call = GuestCall::select('guest_calls.created', 'type as type_device',
            'os', 'phone', 'guest_calls.device_mac', 'checked')
            ->leftJoin('devices', 'devices.mac', '=', 'guest_calls.device_mac')
            ->where('guest_calls.spot_id', '=', $spot->id)
            ->whereMonth('guest_calls.created', $myDate['month'])
            ->whereYear('guest_calls.created', $myDate['year']);

        if (isset($request->search)) {
            $call = $call->where('phone', 'like', "%$request->search%")
                ->orWhere('device_mac', 'like', "%$request->search%");
        }

        $call = $call->orderBy('created', 'DESC')->paginate(15)->toArray();
        $data = $call['data'];
        $meta = ['current_page' => $call['current_page'], 'total' => $call['total'], 'per_page' => $call['per_page']];

        return response(['data' => $data, 'meta' => $meta]);
    }

    public function smsBySpot($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $spot = Spot::findOrFail($id);
        $sms = Sms::select('dt_request', 'phone', 'country', 'region', 'operator', 'price', 'status', 'dt_check')
            ->whereSpot_id($spot->id)
            ->whereMonth('dt_request', $myDate['month'])
            ->whereYear('dt_request', $myDate['year']);

        if (isset($request->search)) {
            $sms = $sms->where('phone', 'like', "%$request->search%");
        }

        $sms = $sms->orderBy('dt_request', 'DESC')->paginate(15)->toArray();
        $data = $sms['data'];
        $meta = ['current_page' => $sms['current_page'], 'total' => $sms['total'], 'per_page' => $sms['per_page']];

        return response(['data' => $data, 'meta' => $meta]);
    }

    public function eventsBySpot($id)
    {
        $spot = Spot::findOrFail($id);
        $path = storage_path();
        $name = strtolower($spot->ident);
        $way = "$path/app/device/$name.log";
        $log = "";

//      $array = Storage::get($way);
        $array = file($way);

        $result = [];
        foreach ($array as $value) {
            $stroka = str_replace("\n", '', $value);
            $slovo = explode("|", $stroka);

            array_push($result, $slovo);
        }
        dd($result);

        return response(['data'=>$result]);
    }
}
