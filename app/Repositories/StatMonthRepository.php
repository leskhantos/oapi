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
use App\Entities\Style;
use App\Entities\Voucher;
use App\Helpers\Helper;
use App\Repositories\Interfaces\StatMonthRepositoryInterface;
use Illuminate\Http\Request;

class StatMonthRepository implements StatMonthRepositoryInterface
{
    public function getAllStats(Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $device = new Device();
        $count_devices = $device->countDevices();
        $count_new_device = $device->countDevicesForMonth();
        $auth_guest = $device->countAuthUser();

        $session = new SessionsAuth();
        $sessions = $session->sessionAuth();

        $count_spots = Spot::count();
        $count_companies = Company::count();
        $count_pages = Style::count();
        $count_vouchers = Voucher::count();

        $smss = $this->getSms($myDate)->get()->toArray();
        $calls = $this->getCall($myDate)->get()->toArray();
        $vouchers = $this->getVoucher($myDate)->get()->toArray();

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

    public function getAllStatsPerMonth(Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $call = $this->getCall($myDate)->get()->toArray();
        $voucher = $this->getVoucher($myDate)->get()->toArray();
        $sms = $this->getSms($myDate)->get()->toArray();

        $vouchers = $this->counterMonth($voucher, $myDate['day']);
        $count_sms = $this->counterMonth($sms, $myDate['day']);
        $calls = $this->counterMonth($call, $myDate['day']);

        return response(['vouchers' => $vouchers, 'sms' => $count_sms, 'calls' => $calls, 'days' => $myDate['day']]);
    }

    public function getStatsByCompanyPerMonth($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $call = $this->getCall($myDate)->whereCompany_id($company->id)->get()->toArray();
        $guest = $this->getGuest($myDate)->whereCompany_id($company->id)->get()->toArray();
        $voucher = $this->getVoucher($myDate)->whereCompany_id($company->id)->get()->toArray();

        $vouchers = $this->counterMonth($voucher, $myDate['day']);
        $guests = $this->counterMonth($guest, $myDate['day']);
        $calls = $this->counterMonth($call, $myDate['day']);

        return response(['vouchers' => $vouchers, 'guests' => $guests, 'calls' => $calls, 'days' => $myDate['day']]);
    }

    public function getStatsBySpotPerMonth($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $spot = Spot::findOrFail($id);
        $guest = $this->getGuest($myDate)->whereSpot_id($spot->id)->get()->toArray();
        $guests = $this->counterMonth($guest, $myDate['day']);
        $stats = [];
        switch ($spot->type) {
            case 1://Смс
                $sms = $this->getSms($myDate)->whereSpot_id($spot->id)->get()->toArray();
                $stats = $this->counterMonth($sms, $myDate['day']);
                break;
            case 2://Звонки
                $call = $this->getCall($myDate)->whereSpot_id($spot->id)->get()->toArray();
                $stats = $this->counterMonth($call, $myDate['day']);
                break;
            case 3://Ваучеры
                $voucher = $this->getCall($myDate)->whereSpot_id($spot->id)->get()->toArray();
                $stats = $this->counterMonth($voucher, $myDate['day']);
                break;
        }

        return response(['guests' => $guests, 'stats' => $stats, 'type' => $spot->type, 'days' => $myDate['day']]);
    }

    //Круги

    public function getStatsByCompany($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $devices = $this->getDevice($myDate)->whereCompany_id($company->id)->get()->toArray();
        $calls = $this->getCall($myDate)->whereCompanyId($company->id)->get()->toArray();
        $guests = $this->getGuest($myDate)->whereCompanyId($company->id)->get()->toArray();

        $device = $this->counter($devices);
        $call = $this->counter($calls);
        $guest = $this->counter($guests);

//        $array = array_merge($devices, $calls, $guests);
//        $result = $this->counter($array);

        return response(['device' => $device, 'call' => $call, 'guest' => $guest]);
    }

    public function getStatsBySpot($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $spot = Spot::findOrFail($id);
        $type = $spot->type;
        $devices = $this->getDevice($myDate)->whereSpot_id($spot->id)->get()->toArray();
        $guests = $this->getGuest($myDate)->whereSpotId($spot->id)->get()->toArray();

        $device = $this->counter($devices);
        $guest = $this->counter($guests);
        $stats = [];
        switch ($type) {
            case 1:// Смс
                $sms = $this->getSms($myDate)->whereSpotId($spot->id)->get()->toArray();
                $stats = $this->counter($sms);
                break;
            case 2:// Звонки
                $calls = $this->getCall($myDate)->whereSpotId($spot->id)->get()->toArray();
                $stats = $this->counter($calls);
                break;
            case 3:// Ваучеры
                $vouchers = $this->getVoucher($myDate)->whereSpotId($spot->id)->get()->toArray();
                $stats = $this->counter($vouchers);
                break;
        }

        return response(['device' => $device, 'guest' => $guest, 'stats' => $stats, 'type' => $type]);
    }

    public function getSms($myDate)
    {
        return StatsSms::select('date', 'all as all_sms', 'resend', 'delivered')
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year']);
    }

    public function getVoucher($myDate)
    {
        return StatsVoucher::select('date', 'all as all_vouchers', 'auth')
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year']);
    }

    public function getCall($myDate)
    {
        return StatsCall::select('date', 'requests', 'checked')
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year']);
    }

    public function getGuest($myDate)
    {
        return StatsGuest::select('date', 'load', 'auth as auth_guests', 'new', 'old')
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year']);
    }

    public function getDevice($myDate)
    {
        return StatsDevice::select(
            'android', 'ios', 'linux', 'windows', 'windows_phone', 'os_other', 'android_browser',
            'edge', 'firefox', 'chrome', 'opera', 'safari', 'yandex_browser',
            'webkit', 'browser_other', 'mobile', 'tablet', 'computer', 'type_other')
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year']);
    }

    //@param array $array - массив со статистикой для обработки
    //@param $number - колличество дней
    //@return фильтрованный массив со всей статистикой по дням


    public function counterMonth($array, $number)
    {
        if (!empty($array)) {
            $end = [];
            for ($i = 1; $i <= $number; $i++) {
                $result = [];
                foreach ($array as $arr) {
                    $date = new \DateTime($arr['date']);
                    $day = $date->format('d');
                    unset($arr['date']);

                    if ($i == $day) {
                        foreach ($arr as $k => $v) {
                            @$result[$k] += $v;
                        }
                    } else {
                        foreach ($arr as $k => $v) {
                            @$result[$k] += 0;
                        }
                    }
                }
                $end += [$i => $result];
            }
            return ($end);
        } else {
            return (0);
        }
    }

    public function counter($array)
    {
        if (!empty($array)) {
            $result = [];
            foreach ($array as $key => $value) {
                unset($value['date']);
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
