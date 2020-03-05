<?php

namespace App\Repositories;


use App\Entities\SessionsAuth;
use App\Entities\SessionsSpot;
use App\Entities\Spot;
use App\Helpers\Helper;
use App\Repositories\Interfaces\SessionRepositoryInterface;
use Illuminate\Http\Request;

class SessionRepository implements SessionRepositoryInterface
{
    public function activeSessionBySpot($id)
    {
        $spot = Spot::findOrFail($id);
        $session = SessionsSpot::select('start as created', 'type as device_type', 'os', 'sessions_spots.device_mac')
            ->leftJoin('devices', 'sessions_spots.device_mac', '=', 'devices.mac')
            ->where('active', '=', 1)
            ->where('sessions_spots.spot_id', '=', $spot->id)->paginate(5)->toArray();

        $data = $session['data'];
        $meta = ['current_page' => $session['current_page'], 'total' => $session['total'], 'per_page' => $session['per_page']];

        return response(['data' => $data, 'meta' => $meta]);

    }

    public function finishedSessionBySpot($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $spot = Spot::findOrFail($id);
        $session = SessionsSpot::select('start as created', 'stop as finished', 'type as device_type',
            'os', 'bytes_in', 'bytes_out', 'sessions_spots.device_mac')
            ->leftJoin('devices', 'sessions_spots.device_mac', '=', 'devices.mac')
            ->whereMonth('finished', $myDate['month'])
            ->whereYear('finished', $myDate['year'])
            ->where('active', '=', 0)
            ->where('sessions_spots.spot_id', '=', $spot->id)->paginate(5)->toArray();

        $data = $session['data'];
        $meta = ['current_page' => $session['current_page'], 'total' => $session['total'], 'per_page' => $session['per_page']];

        return response(['data' => $data, 'meta' => $meta]);
    }

    public function authSessionBySpot($id)
    {
        $spot = Spot::findOrFail($id);
        $session = SessionsAuth::select('sessions_auths.created', 'expiration', 'type as device_type',
            'os', 'sessions_auths.device_mac')
            ->leftJoin('devices', 'sessions_auths.device_mac', '=', 'devices.mac')
            ->where('expiration', '!=', null)
            ->where('sessions_auths.spot_id', '=', $spot->id)->paginate(5)->toArray();

        $data = $session['data'];
        $meta = ['current_page' => $session['current_page'], 'total' => $session['total'], 'per_page' => $session['per_page']];

        return response(['data' => $data, 'meta' => $meta]);

    }
}
