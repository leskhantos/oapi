<?php

namespace App\Repositories;

use App\Entities\Company;
use App\Entities\Device;
use App\Entities\Page;
use App\Entities\SessionsAuth;
use App\Entities\Spot;
use App\Entities\StatsCall;
use App\Entities\StatsDevice;
use App\Entities\StatsGuest;
use App\Entities\StatsSms;
use App\Entities\StatsVoucher;
use App\Entities\Voucher;
use App\Repositories\Interfaces\StatRepositoryInterface;

class StatRepository implements StatRepositoryInterface
{
    public function getAllStats()
    {
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

        $smss = StatsSms::select('all as all_sms', 'resend', 'delivered')->get()->toArray();
        $calls = StatsCall::select('requests', 'checked')->get()->toArray();
        $vouchers = StatsVoucher::select('all as all_vouchers', 'auth')->get()->toArray();

        $sms = $this->counter($smss);
        $call = $this->counter($calls);
        $voucher = $this->counter($vouchers);

        $data = [
            'count_company' => $count_companies,
            'count_spot' => $count_spots,
            'pages' => $count_pages,
            'count_all_device' => $count_devices,
            'count_new_device' => $count_new_device,
            'auth_guest' => $auth_guest,
            'session' => $sessions,
            'count_vouchers' => $count_vouchers,
        ];
        $data['sms'] = $sms;
        $data['call'] = $call;
        $data['voucher'] = $voucher;

        return $data;
    }

    //Круги



    //@array $array - входной массив
    //@return общую статистику
    public function counter($array)
    {
        if (!empty($array)) {
            $result = [];
            foreach ($array as $key => $value) {
                foreach ($value as $k => $v) {
                    @$result[$k] += $v;
                }
            }

            return ($result);
        } else {
            return (0);
        }
    }
}
