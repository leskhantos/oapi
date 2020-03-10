<?php

namespace App\Repositories;

use App\Entities\Device;
use App\Entities\SessionsAuth;
use App\Entities\SessionsSpot;
use App\Entities\Spot;
use App\Entities\Stage;
use App\Helpers\Helper;
use App\Repositories\Interfaces\DeviceRepositoryInterface;
use Illuminate\Http\Request;

class DeviceRepository implements DeviceRepositoryInterface
{
    public function show($id)
    {
        $device = Device::findOrFail($id);
        return Device::select('mac', 'created', 'last_online', 'sessions', 'type', 'os', 'os_version')
            ->whereMac($device->mac)->first();
    }

    public function mainByDevice($id)
    {
        $device = Device::findOrFail($id);

        $count_auth = SessionsSpot::where('active', '=', 0)->count();
        $count_finished = SessionsSpot::where('active', '=', 1)->count();
        $traffic = SessionsSpot::select('bytes_in', 'bytes_out')->get()->toArray();
        $result = [];
        foreach ($traffic as $key => $value) {
            foreach ($value as $k => $v) {
                @$result[$k] += $v;
            }
        }
        $devices = Device::select('last_session', 'companies.name', 'spots.address', 'screen_w', 'screen_h')
            ->join('spots', 'spots.id', '=', 'devices.spot_id')
            ->join('companies', 'companies.id', 'spots.company_id')
            ->where('devices.mac', '=', $device->mac)
            ->first()->toArray();
        $devices += ['count_auth' => $count_auth, 'count_finished' => $count_finished,
            'bytes_in' => $result['bytes_in'], 'bytes_out' => $result['bytes_out']];

        return response($devices);
    }

    public function spotsByDevice($id)
    {
        $device = Device::findOrFail($id);

        $devices = Device::select('created', 'companies.name', 'spots.address')
            ->join('spots', 'spots.id', '=', 'devices.spot_id')
            ->join('companies', 'companies.id', 'spots.company_id')
            ->where('devices.mac', '=', $device->mac)
            ->orderBy('sessions', 'DESC')->get()->toArray();

        return response($devices);
    }

    public function sessionByDevice($id, Request $request)
    {
        $device = Device::findOrFail($id);
        $new = new Helper();
        $myDate = $new->currentDate($request);
        switch ($request->session_type) {
            case 1: // Активные сессии
                $session = SessionsSpot::select('start as created', 'companies.name', 'spots.address', 'device_mac')
                    ->join('spots', 'spots.id', '=', 'sessions_spots.spot_id')
                    ->join('companies', 'companies.id', '=', 'spots.company_id')
                    ->where('sessions_spots.device_mac', '=', $device->mac)
                    ->where('active', '=', 1);
                break;
            case 2: // Авторизации
                $session = SessionsAuth::select('sessions_auths.created', 'expiration', 'companies.name', 'spots.address')
                    ->join('spots', 'spots.id', '=', 'sessions_auths.spot_id')
                    ->join('companies', 'companies.id', '=', 'spots.company_id')
                    ->where('sessions_auths.device_mac', '=', $device->mac)
                    ->where('expiration', '!=', null);
                break;
            case 3: // Завершенные сессии
                $session = SessionsSpot::select('start as created', 'stop as finished', 'bytes_in', 'bytes_out', 'companies.name', 'spots.address')
                    ->join('spots', 'spots.id', '=', 'sessions_spots.spot_id')
                    ->join('companies', 'companies.id', '=', 'spots.company_id')
                    ->whereMonth('stop', $myDate['month'])
                    ->whereYear('stop', $myDate['year'])
                    ->where('sessions_spots.device_mac', '=', $device->mac)
                    ->where('active', '=', 0);
                break;
        }
        $session = $session->orderBy('created', 'DESC')->paginate(9)->toArray();

        $data = $session['data'];
        $meta = ['current_page' => $session['current_page'], 'total' => $session['total'], 'per_page' => $session['per_page']];

        return response(['data' => $data, 'meta' => $meta]);
    }

    public function phoneByDevice($id)
    {
        $device = Device::findOrFail($id);

        return Stage::select('stages.created', 'phone')->where('stages.device_mac', '=', $device->mac)
            ->get();
    }

    public function eventsByDevice($mac)
    {
        return ('fake');
        //date
        //event
        //per month/year
    }
}
