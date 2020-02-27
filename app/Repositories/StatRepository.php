<?php

namespace App\Repositories;

use App\Entities\Company;
use App\Entities\Device;
use App\Entities\Page;
use App\Entities\SessionsAuth;
use App\Entities\Spot;
use App\Entities\StatsCall;
use App\Entities\StatsSms;
use App\Entities\StatsVoucher;
use App\Entities\Voucher;
use App\Repositories\Interfaces\StatRepositoryInterface;

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
        $count_vouchers = Voucher::count();

        return response([
                'count_company' => $count_companies,
                'count_spot' => $count_spots,
                'pages' => $count_pages,
                'count_all_device' => $count_devices,
                'count_new_device' => $count_new_device,
                'auth_guest' => $auth_guest,
                'session' => $sessions,
                'count_vouchers' => $count_vouchers,
            ]
        );
    }

    public function statsSms()
    {
        $sms = StatsSms::get();
        $data = $this->counter($sms, 'all', 'resend', 'delivered');

        return $data;
    }

    public function statsCalls()
    {
        $calls = StatsCall::get();
        $data = $this->counter($calls, 'requests', 'checked', null);

        return $data;
    }

    public function statsVouchers()
    {
        $vouchers = StatsVoucher::get();
        $data = $this->counter($vouchers, 'all', 'auth', null);

        return $data;
    }

    //@array $array - входной массив
    //$par1-3 название элемента с массива котороый нам нужно посчитать
    //@return общую статистику
    public function counter($array, $par1, $par2, $par3)
    {
        $count = 0;
        $count2 = 0;
        $count3 = 0;

        foreach ($array as $arr) {
            $count += $arr["$par1"];
            $count2 += $arr["$par2"];
            if ($par3 !== null) {
                $count3 += $arr["$par3"];
            }
        }
        $result = [
            "$par1" => $count,
            "$par2" => $count2,
        ];
        if ($par3 !== null) {
            $result += ["$par3" => $count3];
        }

        return ($result);
    }
}
