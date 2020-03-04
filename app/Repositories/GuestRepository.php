<?php

namespace App\Repositories;

use App\Entities\Guests\Guest;
use App\Helpers\Helper;
use App\Repositories\Interfaces\GuestRepositoryInterface;
use Illuminate\Http\Request;

class GuestRepository implements GuestRepositoryInterface
{
    public function guestBySpot($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $guests = Guest::select('guests.id','datetime', 'devices.type as type_device', 'os', 'device_mac', 'spots.type', 'data_auth', 'sessions')
            ->leftJoin('devices', 'guests.device_mac', '=', 'devices.mac')
            ->leftJoin('spots', 'guests.spot_id', '=', 'spots.id')
            ->where('guests.spot_id', '=', $id)
            ->whereMonth('datetime', $myDate['month'])
            ->whereYear('datetime', $myDate['year'])->orderBy('sessions', 'DESC')
            ->get()->toArray();

        $uniq_mac=[];$uniq_arr=[];
        foreach ($guests as $guest)
        {
            if(!in_array($guest['device_mac'],$uniq_mac)){
                $uniq_mac[]=$guest['device_mac'];
                $uniq_arr[]=$guest;
            }
        }

        return response($uniq_arr);
    }

    public function guestByCompany($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $guests = Guest::select('guests.id','datetime', 'devices.type as type_device', 'os', 'device_mac', 'spots.type', 'data_auth', 'sessions')
            ->leftJoin('devices', 'guests.device_mac', '=', 'devices.mac')
            ->leftJoin('spots', 'guests.spot_id', '=', 'spots.id')
            ->where('guests.company_id', '=', $id)
            ->whereMonth('datetime', $myDate['month'])
            ->whereYear('datetime', $myDate['year'])->get();

        $uniq_mac=[];$uniq_arr=[];
        foreach ($guests as $guest)
        {
            if(!in_array($guest['device_mac'],$uniq_mac)){
                $uniq_mac[]=$guest['device_mac'];
                $uniq_arr[]=$guest;
            }
        }
        return response($uniq_arr);
    }
}
