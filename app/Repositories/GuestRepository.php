<?php

namespace App\Repositories;

use App\Entities\Company;
use App\Entities\Guests\Guest;
use App\Helpers\Helper;
use App\Repositories\Interfaces\GuestRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class GuestRepository implements GuestRepositoryInterface
{
    public function guestBySpot($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $guests = Guest::select('guests.id', 'datetime', 'devices.type as type_device', 'os', 'device_mac', 'spots.type', 'data_auth', 'sessions')
            ->leftJoin('devices', 'guests.device_mac', '=', 'devices.mac')
            ->leftJoin('spots', 'guests.spot_id', '=', 'spots.id')
            ->where('guests.spot_id', '=', $company->id)
            ->whereMonth('datetime', $myDate['month'])
            ->whereYear('datetime', $myDate['year'])->orderBy('sessions', 'DESC')
            ->get()->toArray();

        return $this->getUniqMac($guests);
    }

    public function guestByCompany($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $guests = Guest::select('guests.id', 'datetime', 'devices.type as type_device', 'os', 'device_mac', 'spots.type', 'data_auth', 'sessions')
            ->leftJoin('devices', 'guests.device_mac', '=', 'devices.mac')
            ->leftJoin('spots', 'guests.spot_id', '=', 'spots.id')
            ->where('guests.company_id', '=', $company->id)
            ->whereMonth('datetime', $myDate['month'])
            ->whereYear('datetime', $myDate['year'])->orderBy('sessions', 'DESC')
            ->get()->toArray();

        return $this->getUniqMac($guests);
    }

    public function getUniqMac($guests)
    {
        $uniq_mac = [];
        $uniq_arr = [];
        foreach ($guests as $guest) {
            if (!in_array($guest['device_mac'], $uniq_mac)) {
                $uniq_mac[] = $guest['device_mac'];
                $uniq_arr[] = $guest;
            }
        }

        $total = count($uniq_arr);
        $perPage = 5;
        $currentPage = 1;

        $paginator = new LengthAwarePaginator($uniq_arr, $total, $perPage, $currentPage);
        $paginator = $paginator->toArray();

        $data = $paginator['data'];
        $meta = ['current_page' => $paginator['current_page'], 'total' => $paginator['total'], 'per_page' => $paginator['per_page']];
        return response(['data' => $data, 'meta' => $meta]);
    }
}
