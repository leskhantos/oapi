<?php

namespace App\Repositories;

use App\Entities\GuestCall;
use App\Entities\Sms;
use App\Entities\Spot;
use App\Entities\Company;
use App\Helpers\Helper;
use App\Repositories\Interfaces\SpotRepositoryInterface;
use Illuminate\Http\Request;

class SpotRepository implements SpotRepositoryInterface
{
    public function spotByCompany($id)
    {
        $company = Company::findOrFail($id);
        $spot = Spot::
        select('spots.id', 'spots.company_id', 'pages.name as page_name',
            'spots.last_active', 'spots.ident', 'address',
            'spots.type', 'spots.page_id', 'spots.enabled')
            ->leftJoin('pages', 'page_id', '=', 'pages.id')
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
            ->whereSpot_id($spot->id)
            ->whereMonth('created', $myDate['month'])
            ->whereYear('created', $myDate['year']);

        if (isset($request->phone)) {
            $call = $call->where('phone', 'like', "%$request->phone%");
        }
        if (isset($request->device_mac)) {
            $call = $call->where('phone', 'like', "%$request->device_mac%");
        }
        $call = $call->orderBy('created', 'DESC')->paginate(15)->toArray();

        return response($call);
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

        if (isset($request->phone)) {
            $sms = $sms->where('phone', 'like', "%$request->phone%");
        }
        $sms = $sms->orderBy('dt_request', 'DESC')->paginate(15)->toArray();
        return response($sms);
    }
}
