<?php

namespace App\Http\Controllers;

use App\Entities\Guests\Guest;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function guestBySpot($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $guest = Guest::select('datetime', 'device_mac', 'data_auth', 'type', 'os','sessions')
            ->leftJoin('devices', 'guests.device_mac', '=', 'devices.mac')
            ->where('guests.spot_id', '=', $id)
            ->whereMonth('datetime', $myDate['month'])
            ->whereYear('datetime', $myDate['year'])->get();

        return response($guest);
    }

    public function guestByCompany($id)
    {
        $guest = Guest::whereCompany_id($id)->get();

        return response($guest);
    }

    public function store(Request $request)
    {
//        if request->company_id = spots.company id
        return Guest::create($request->all());
//
    }
}
