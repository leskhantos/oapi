<?php

namespace App\Repositories;

use App\Entities\Company;
use App\Entities\Device;
use App\Entities\Page;
use App\Entities\SessionsAuth;
use App\Entities\Spot;
use App\Entities\StatsCall;
use App\Entities\StatsGuest;
use App\Entities\StatsSms;
use App\Helpers\Helper;
use App\Repositories\Interfaces\StatRepositoryInterface;
use Illuminate\Http\Request;

class StatRepository implements StatRepositoryInterface
{
    public function getAllStats()
    {
        //Получаем всю статистику
//        $company = new Company();
//        $count_spots = $company->countSpots();
//        $count_pages = $company->countPages();
//        $count_companies = $company->countCompany();

        $device = new Device();
        $count_devices = $device->countDevices();
        $count_new_device = $device->countDevicesForMonth();
        $auth_guest = $device->countAuthUser();

        $session = new SessionsAuth();
        $sessions = $session->sessionAuth();

        $count_spots = Spot::count();
        $count_companies = Company::count();
        $count_pages = Page::count();

        return response([
                'count_company' => $count_companies,
                'count_spot' => $count_spots,
                'pages' => $count_pages,
                'count_all_device' => $count_devices,
                'count_new_device' => $count_new_device,
                'auth_guest' => $auth_guest,
                'session' => $sessions,
            ]
        );
    }

    public function getCallsPerMonth(Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $calls = StatsCall::whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();
        $data = $this->noidea($calls, $myDate['day']);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getSmsPerMonth(Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $sms = StatsSms::whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get();

        $result = [];
        for ($i = 1; $i <= $myDate['day']; $i++) {
            $all = 0;
            $resend = 0;
            $delivered = 0;
            foreach ($sms as $array) {
                $date = new \DateTime($array['date']);
                $day = $date->format('d');
                if ($i == $day) {
                    $all += $array['all'];
                    $resend += $array['resend'];
                    $delivered += $array['delivered'];
                }
            }
            $result += [
                $i => [
                    'all' => $all,
                    'resend' => $resend,
                    'delivered' => $delivered
                ],
            ];
        }
        return response(['sms' => $result, 'days' => $myDate['day']]);
    }

    public function getCallsByCompany($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $calls = StatsCall::whereCompany_id($company->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $data = $this->noidea($calls, $myDate['day']);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getStatsGuestByCompany($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $guests = StatsGuest::where('company_id', $company->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $data = $this->noidea($guests, $myDate['day']);

        return response(['guest' => $data, 'days' => $myDate['day']]);
    }

    //@param array $arrays - массив со статистикой для обработки по дням
    //@param @number - колличество дней
    //@return фильтрованный массив со всей статистикой по дням

    public function noidea($arrays, $number)
    {
        if (!empty($arrays)) {
            $result = [];
            for ($i = 1; $i <= $number; $i++) {
                $requests = 0;
                $checked = 0;
                foreach ($arrays as $array) {
                    $date = new \DateTime($array['date']);
                    $day = $date->format('d');
                    if ($i == $day) {
                        $requests += $array['requests'];
                        $checked += $array['checked'];
                    }
                }
                $result += [
                    $i => [
                        'requests' => $requests,
                        'checked' => $checked
                    ],
                ];
            }
            return ($result);
        }
        else{
            return(0);
        }
    }

}
