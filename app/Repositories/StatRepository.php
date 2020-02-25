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
            ->get();

        return response(['calls' => $calls, 'days' => $myDate['day']]);
    }

    public function getSmsPerMonth(Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $sms = StatsSms::whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->orderBy('date')
            ->get();

        $result = [];
        foreach ($sms as $smss) {
            $date = new \DateTime($smss['date']);
            $day = $date->format('d');
            //Если числа нет то создать
            if (!isset($result[$day])) {
                $result += [
                    $day => [
                        'all' => $smss['all'],
                        'resend' => $smss['resend'],
                        'delivered' => $smss['delivered']
                    ],
                ];
                // Если дата есть то добавить к массиву данные
            } else {
                foreach ($result as $res) {
                    $res['all'] += $smss['all'];
                    $res['resend'] += $smss['resend'];
                    $res['delivered'] += $smss['delivered'];
                    $result[$day] = $res;
                }
            }
        }
        return response(['sms'=>$result,'days'=>$myDate['day']]);
    }

    public function getCallsByCompany($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $calls = StatsCall::where('company_id', $company->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get();

        return response(['calls' => $calls, 'days' => $myDate['day']]);
    }

    public function getStatsGuestByCompany($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $guests = StatsGuest::where('company_id', $company->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get();

        return response(['guest' => $guests, 'days' => $myDate['day']]);
    }

}
