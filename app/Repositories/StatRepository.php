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
use App\Entities\StatsVoucher;
use App\Helpers\Helper;
use App\Repositories\Interfaces\StatRepositoryInterface;
use Illuminate\Http\Request;

class StatRepository implements StatRepositoryInterface
{
    public function getAllStats()
    {
        //Получаем всю статистику
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

        $data = $this->counter($calls, $myDate['day'], 'requests', 'checked', null, null);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getSmsPerMonth(Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $sms = StatsSms::whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $data = $this->counter($sms, $myDate['day'], 'all', 'resend', 'delivered', null);

        return response(['data' => $data, 'days' => $myDate['day']]);
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

        $data = $this->counter($calls, $myDate['day'], 'requests', 'checked', null, null);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getStatsGuestByCompany($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $guests = StatsGuest::whereCompany_id($company->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $data = $this->counter($guests, $myDate['day'], 'requests', 'checked', null, null);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getVouchersPerMonth(Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $voucher = StatsVoucher::whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $data = $this->counter($voucher, $myDate['day'], 'all', 'auth', null, null);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    //@param array $arrays - массив со статистикой для обработки
    //@param @number - колличество дней
    //@param $par1-$par4 - название столбика с массива котороый нам нужно посчитать
    //@return фильтрованный массив со всей статистикой по дням

    public function counter($arrays, $number, $par1, $par2, $par3, $par4)
    {
        if (!empty($arrays)) {
            $result = [];
            for ($i = 1; $i <= $number; $i++) {
                $requests = 0;
                $checked = 0;
                $count = 0;
                $count4 = 0;
                foreach ($arrays as $array) {
                    $date = new \DateTime($array['date']);
                    $day = $date->format('d');
                    if ($i == $day) {
                        $requests += $array["$par1"];
                        $checked += $array["$par2"];
                        if ($par3 !== null) {
                            $count += $array["$par3"];
                        }
                        if ($par4 !== null) {
                            $count4 += $array["$par4"];
                        }
                    }
                }
                $result += [
                    $i => [
                        "$par1" => $requests,
                        "$par2" => $checked
                    ],
                ];
                if ($par3 !== null) {
                    $result[$i] += ["$par3" => $count];
                }
                if ($par4 !== null) {
                    $result[$i] += ["$par4" => $count4];
                }
            }
            return ($result);
        } else {
            return (0);
        }
    }
}
