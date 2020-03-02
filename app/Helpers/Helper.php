<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class Helper
{
    public function currentDate(Request $request)
    {
        $date = new \DateTime();
        $day = $date->format('d');
        $month = $date->format('m');
        $year = $date->format('Y');
        if (!empty($request->month) && ($request->month != $month)) {
            $month = $request->month;
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        if (!empty($request->year) && ($request->year != $year)) {
            $year = $request->year;
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        $result = ['day' => $day, 'month' => $month, 'year' => $year];

        return $result;
    }
}
