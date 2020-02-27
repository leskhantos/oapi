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
    public function getStatsCallsPerMonth(Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $calls = StatsCall::whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $data = $this->counterMonth($calls, $myDate['day'], 'requests', 'checked', null, null);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getStatsSmsPerMonth(Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $sms = StatsSms::whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $data = $this->counterMonth($sms, $myDate['day'], 'all', 'resend', 'delivered', null);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getStatsVouchersPerMonth(Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $voucher = StatsVoucher::whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $data = $this->counterMonth($voucher, $myDate['day'], 'all', 'auth', null, null);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getStatsCallsByCompany($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $calls = StatsCall::whereCompany_id($company->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();
        $data = $this->counterMonth($calls, $myDate['day'], 'requests', 'checked', null, null);

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

        $data = $this->counterMonth($guests, $myDate['day'], 'load', 'auth', 'new', 'old');

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getStatsVouchersByCompany($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $company = Company::findOrFail($id);
        $voucher = StatsVoucher::whereCompany_id($company->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $data = $this->counterMonth($voucher, $myDate['day'], 'all', 'auth', null, null);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getStatsCallsBySpot($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $spot = Spot::findOrFail($id);
        $calls = StatsCall::whereSpot_id($spot->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();
        $data = $this->counterMonth($calls, $myDate['day'], 'requests', 'checked', null, null);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getStatsGuestBySpot($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $spot = Spot::findOrFail($id);
        $guests = StatsGuest::whereSpot_id($spot->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $data = $this->counterMonth($guests, $myDate['day'], 'load', 'auth', 'new', 'old');

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    public function getStatsVouchersBySpot($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $spot = Spot::findOrFail($id);
        $voucher = StatsVoucher::whereSpot_id($spot->id)
            ->whereMonth('date', $myDate['month'])
            ->whereYear('date', $myDate['year'])
            ->get()->toArray();

        $data = $this->counterMonth($voucher, $myDate['day'], 'all', 'auth', null, null);

        return response(['data' => $data, 'days' => $myDate['day']]);
    }

    //@param array $arrays - массив со статистикой для обработки
    //@param @number - колличество дней
    //@param $par1-$par4 - название столбика с массива котороый нам нужно посчитать
    //@return фильтрованный массив со всей статистикой по дням

    public function counterMonth($array, $number, $par1, $par2, $par3, $par4)
    {
        if (!empty($array)) {
            $result = [];
            for ($i = 1; $i <= $number; $i++) {
                $requests = 0;
                $checked = 0;
                $count = 0;
                $count4 = 0;
                foreach ($array as $arr) {
                    $date = new \DateTime($arr['date']);
                    $day = $date->format('d');
                    if ($i == $day) {
                        $requests += $arr["$par1"];
                        $checked += $arr["$par2"];
                        if ($par3 !== null) {
                            $count += $arr["$par3"];
                        }
                        if ($par4 !== null) {
                            $count4 += $arr["$par4"];
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
