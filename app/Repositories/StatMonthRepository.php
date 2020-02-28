<?php

namespace App\Repositories;

use App\Entities\Company;
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
        $calls = StatsCall::select('date', 'requests', 'checked')->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();
        $voucher = StatsVoucher::select('date', 'all as all_vouchers', 'auth')->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();
        $sms = StatsSms::select('date', 'all as all_sms', 'resend', 'delivered')->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $array = array_merge($voucher, $calls, $sms);

        $data = $this->counterMonth($array, $myDate['day']);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }


    public function getStatsByCompanyPerMonth($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $calls = StatsCall::select('date', 'requests', 'checked')->whereCompany_id($company->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();
        $guests = StatsGuest::select('date', 'load', 'auth as auth_guests', 'new', 'old')->whereCompany_id($company->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();
        $voucher = StatsVoucher::select('date', 'all', 'auth as auth_vouchers')->whereCompany_id($company->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();
        $array = array_merge($voucher, $calls, $guests);

        $data = $this->counterMonth($array, $myDate['day']);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getStatsBySpotPerMonth($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $spot = Spot::findOrFail($id);
        $calls = StatsCall::select('date', 'requests', 'checked')->whereSpot_id($spot->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();
        $voucher = StatsVoucher::select('date', 'all', 'auth as auth_vouchers')->whereSpot_id($spot->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();
        $guests = StatsGuest::select('date', 'load', 'auth as auth_guests', 'new', 'old')->whereSpot_id($spot->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $array = array_merge($voucher, $calls, $guests);
        $data = $this->counterMonth($array, $myDate['day']);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    //@param array $array - массив со статистикой для обработки
    //@param @number - колличество дней
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
