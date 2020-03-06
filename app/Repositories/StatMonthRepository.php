<?php

namespace App\Repositories;

use App\Entities\Company;
use App\Entities\Page;
use App\Entities\Spot;
use App\Entities\StatsCall;
use App\Entities\StatsGuest;
use App\Entities\StatsSms;
use App\Entities\StatsVoucher;
use App\Helpers\Helper;
use App\Repositories\Interfaces\StatMonthRepositoryInterface;
use Illuminate\Http\Request;

class StatMonthRepository implements StatMonthRepositoryInterface
{
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
            case 1:
                $sms = $this->getSms($myDate)->whereSpot_id($spot->id)->get()->toArray();
                $stats = $this->counterMonth($sms, $myDate['day']);
                break;
            case 2:
                $call = $this->getCall($myDate)->whereSpot_id($spot->id)->get()->toArray();
                $stats = $this->counterMonth($call, $myDate['day']);
                break;
            case 3:
                $voucher = $this->getCall($myDate)->whereSpot_id($spot->id)->get()->toArray();
                $stats = $this->counterMonth($voucher, $myDate['day']);
                break;
        }

        return response(['guests' => $guests, 'stats' => $stats, 'type' => $spot->type, 'days' => $myDate['day']]);
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
}
