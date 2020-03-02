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

        $smss = StatsSms::select('all as all_sms', 'resend', 'delivered')->get()->toArray();
        $calls = StatsCall::select('requests', 'checked')->get()->toArray();
        $vouchers = StatsVoucher::select('all as all_vouchers', 'auth')->get()->toArray();



//        $array = array_merge($sms, $calls, $vouchers);
//        $stats = $this->counter($array);
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
        $data += $sms;
        $data += $call;
        $data += $voucher;

        return $data;
    }

    //Круги

    public function getStatsByCompany($id)
    {
        $company = Company::findOrFail($id);
        $devices = StatsDevice::select(
            'android', 'ios', 'linux', 'windows', 'windows_phone', 'os_other', 'android_browser', 'edge',
            'firefox', 'chrome', 'opera', 'safari', 'yandex_browser', 'webkit', 'browser_other',
            'mobile', 'tablet', 'computer', 'type_other')->whereCompany_id($company->id)
            ->get()->toArray();

        $calls = StatsCall::select('requests', 'checked')
            ->whereCompanyId($company->id)->get()->toArray();

        $guests = StatsGuest::select('load', 'auth', 'new', 'old')
            ->whereCompanyId($company->id)->get()->toArray();

        $device = $this->counter($devices);
        $call = $this->counter($calls);
        $guest = $this->counter($guests);

//        $array = array_merge($devices, $calls, $guests);
//        $result = $this->counter($array);

        return response(['device' => $device, 'call' => $call, 'guest' => $guest]);
    }

    public function getStatsBySpot($id)
    {
        $spot = Spot::findOrFail($id);
        $devices = StatsDevice::select(
            'android', 'ios', 'linux', 'windows', 'windows_phone', 'os_other', 'android_browser', 'edge',
            'firefox', 'chrome', 'opera', 'safari', 'yandex_browser', 'webkit', 'browser_other',
            'mobile', 'tablet', 'computer', 'type_other')->whereSpot_id($spot->id)->get()->toArray();

        $calls = StatsCall::select('requests', 'checked')
            ->whereSpotId($spot->id)->get()->toArray();
        $guests = StatsGuest::select('load', 'auth', 'new', 'old')
            ->whereSpotId($spot->id)->get()->toArray();

//        $array = array_merge($devices, $calls, $guests);
//        return $this->counter($array);

        $device = $this->counter($devices);
        $call = $this->counter($calls);
        $guest = $this->counter($guests);

        return response(['device'=>$device,'call'=>$call,'guest'=>$guest]);
    }

    //@array $array - входной массив
    //@return общую статистику
    public function counter($array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            foreach ($value as $k => $v) {
                @$result[$k] += $v;
            }
        }

        return ($result);
    }
}
