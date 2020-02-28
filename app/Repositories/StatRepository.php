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

        $sms = StatsSms::select('all as all_sms', 'resend', 'delivered')->get()->toArray();
        $calls = StatsCall::select('requests', 'checked')->get()->toArray();
        $vouchers = StatsVoucher::select('all as all_voucher', 'auth')->get()->toArray();
        $keys = ['all_sms' => 0, 'auth' => 0,'requests' => 0, 'checked' => 0,
            'all_voucher' => 0, 'resend' => 0, 'delivered' => 0];
        $array = array_merge($sms,$calls,$vouchers);

        $stats = $this->counter($array, $keys);
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
        $data +=$stats;

        return $data;

    }

    public function getStatsSms()
    {
        $sms = StatsSms::select('all', 'resend', 'delivered')->get()->toArray();
        $keys = ['all' => 0, 'resend' => 0, 'delivered' => 0];

        return $this->counter($sms, $keys);
    }

    public function getStatsCalls()
    {
        $calls = StatsCall::select('requests', 'checked')->get()->toArray();
        $keys = ['requests' => 0, 'checked' => 0];

        return $this->counter($calls, $keys);
    }

    public function getStatsVouchers()
    {
        $vouchers = StatsVoucher::select('all', 'auth')->get()->toArray();
        $keys = ['all' => 0, 'auth' => 0];

        return $this->counter($vouchers, $keys);
    }

    //Круги
    public function getStatsByDeviceInCompany($id)
    {
        $company = Company::findOrFail($id);
        $devices = StatsDevice::select('mobile', 'tablet', 'computer', 'type_other')
            ->whereCompanyId($company->id)->get()->toArray();
        $keys = ['mobile' => 0, 'tablet' => 0, 'computer' => 0, 'type_other' => 0];

        return $this->counter($devices, $keys);
    }

    public function getStatsByOsInCompany($id)
    {
        $company = Company::findOrFail($id);
        $devices = $company->select(
            'android', 'ios', 'linux', 'windows', 'windows_phone', 'os_other',
            'android_browser', 'edge', 'firefox', 'chrome', 'opera', 'safari', 'yandex_browser', 'webkit', 'browser_other',
            'mobile', 'tablet', 'computer', 'type_other',
            )
            ->join('stats_devices', 'companies.id', '=', 'stats_devices.company_id')
            ->where('stats_devices.company_id', '=', $company->id)
            ->get()->toArray();

        $keys = ['android' => 0, 'ios' => 0, 'linux' => 0, 'windows' => 0, 'windows_phone' => 0, 'os_other' => 0,
            'android_browser' => 0, 'edge' => 0, 'firefox' => 0, 'chrome' => 0, 'opera' => 0,
            'safari' => 0, 'yandex_browser' => 0, 'webkit' => 0, 'browser_other' => 0,
            'mobile' => 0, 'tablet' => 0, 'computer' => 0, 'type_other' => 0
        ];

        return $this->counter($devices, $keys);
    }

    public function getStatsByBrowserInCompany($id)
    {
        $company = Company::findOrFail($id);
        $devices = StatsDevice::select('android_browser', 'edge', 'firefox', 'chrome', 'opera', 'safari', 'yandex_browser', 'webkit', 'browser_other')
            ->whereCompanyId($company->id)->get()->toArray();
        $keys = ['android_browser' => 0, 'edge' => 0, 'firefox' => 0, 'chrome' => 0, 'opera' => 0,
            'safari' => 0, 'yandex_browser' => 0, 'webkit' => 0, 'browser_other' => 0];

        return $this->counter($devices, $keys);
    }

    public function getStatsByCallsInCompany($id)
    {
        $company = Company::findOrFail($id);
        $devices = StatsCall::select('requests', 'checked')
            ->whereCompanyId($company->id)->get()->toArray();
        $keys = ['requests' => 0, 'checked' => 0];

        return $this->counter($devices, $keys);
    }

    public function getStatsByGuestsInCompany($id)
    {
        $company = Company::findOrFail($id);
        $devices = StatsGuest::select('load', 'auth', 'new', 'old')
            ->whereCompanyId($company->id)->get()->toArray();
        $keys = ['load' => 0, 'auth' => 0, 'new' => 0, 'old' => 0];

        return $this->counter($devices, $keys);
    }

    public function getStatsByDeviceInSpot($id)
    {
        $spot = Company::findOrFail($id);
        $devices = StatsDevice::select('mobile', 'tablet', 'computer', 'type_other')
            ->whereSpotId($spot->id)->get()->toArray();
        $keys = ['mobile' => 0, 'tablet' => 0, 'computer' => 0, 'type_other' => 0];

        return $this->counter($devices, $keys);
    }

    public function getStatsByOsInSpot($id)
    {
        $spot = Spot::findOrFail($id);
        $devices = $spot->select(
            'android', 'ios', 'linux', 'windows', 'windows_phone', 'os_other',
            'android_browser', 'edge', 'firefox', 'chrome', 'opera', 'safari', 'yandex_browser', 'webkit', 'browser_other',
            'mobile', 'tablet', 'computer', 'type_other',
        )
            ->join('stats_devices', 'spots.id', '=', 'stats_devices.spot_id')
            ->where('stats_devices.spot_id', '=', $spot->id)
            ->get()->toArray();

        $keys = ['android' => 0, 'ios' => 0, 'linux' => 0, 'windows' => 0, 'windows_phone' => 0, 'os_other' => 0,
            'android_browser' => 0, 'edge' => 0, 'firefox' => 0, 'chrome' => 0, 'opera' => 0,
            'safari' => 0, 'yandex_browser' => 0, 'webkit' => 0, 'browser_other' => 0,
            'mobile' => 0, 'tablet' => 0, 'computer' => 0, 'type_other' => 0
        ];

        $result = $this->counter($devices, $keys);


        $devices = StatsCall::select('requests', 'checked')
            ->whereSpotId($spot->id)->get()->toArray();
        $keys1 = ['requests' => 0, 'checked' => 0];

        $result += $this->counter($devices, $keys1);

        return $result;
    }

    public function getStatsByBrowserInSpot($id)
    {
        $spot = Spot::findOrFail($id);
        $devices = StatsDevice::select('android_browser', 'edge', 'firefox', 'chrome', 'opera', 'safari', 'yandex_browser', 'webkit', 'browser_other')
            ->whereSpotId($spot->id)->get()->toArray();
        $keys = ['android_browser' => 0, 'edge' => 0, 'firefox' => 0, 'chrome' => 0, 'opera' => 0,
            'safari' => 0, 'yandex_browser' => 0, 'webkit' => 0, 'browser_other' => 0];

        return $this->counter($devices, $keys);
    }

    public function getStatsByCallsInSpot($id)
    {
        $spot = Spot::findOrFail($id);
        $devices = StatsCall::select('requests', 'checked')
            ->whereSpotId($spot->id)->get()->toArray();
        $keys = ['requests' => 0, 'checked' => 0];

        return $this->counter($devices, $keys);
    }

    public function getStatsByGuestsInSpot($id)
    {
        $spot = Spot::findOrFail($id);
        $devices = StatsGuest::select('load', 'auth', 'new', 'old')
            ->whereSpotId($spot->id)->get()->toArray();
        $keys = ['load' => 0, 'auth' => 0, 'new' => 0, 'old' => 0];

        return $this->counter($devices, $keys);
    }

    //@array $array - входной массив
    //@array $keys - выходной массив
    //@return общую статистику
    public function counter($array, $keys)
    {
        $result = $keys;

        foreach ($array as $key => $value) {
            foreach ($value as $k => $v) {
                $result[$k] += $v;
            }
        }

        return ($result);
    }
}
