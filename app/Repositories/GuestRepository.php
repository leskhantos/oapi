<?php

namespace App\Repositories;

use App\Entities\Company;
use App\Entities\Guests\Guest;
use App\Entities\Spot;
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
        $spot = Spot::findOrFail($id);
        $guests = Guest::select('guests.id','devices.id as id_device', 'datetime', 'devices.type as type_device', 'os', 'device_mac', 'spots.type', 'data_auth', 'sessions')
            ->leftJoin('devices', 'guests.device_mac', '=', 'devices.mac')
            ->leftJoin('spots', 'guests.spot_id', '=', 'spots.id')
            ->where('guests.spot_id', '=', $spot->id)
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
        $guests = Guest::select('guests.id', 'devices.id as id_device', 'datetime', 'devices.type as type_device', 'os', 'device_mac', 'spots.type', 'data_auth', 'sessions')
            ->leftJoin('devices', 'guests.device_mac', '=', 'devices.mac')
            ->leftJoin('spots', 'guests.spot_id', '=', 'spots.id')
            ->where('guests.company_id', '=', $company->id)
            ->whereMonth('datetime', $myDate['month'])
            ->whereYear('datetime', $myDate['year'])->orderBy('sessions', 'DESC')
            ->get()->toArray();

        return $this->getUniqMac($guests);
    }

    //@param $guest - все пользователи
    //@return список уникальных гостей, берётся самая последняя сессия

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

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $perPage = 5;
        $total = count($uniq_arr);
        $offset = ($currentPage * $perPage) - $perPage;
        $data = array_slice($uniq_arr, $offset, $perPage, false);

        $meta = ['current_page' => $currentPage, 'total' => $total, 'per_page' => $perPage];
        return response(['data' => $data, 'meta' => $meta]);
    }

}
