<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class Helper{
    public function currentDate(Request $request){
        $date = new \DateTime();
        $day = $date->format('d');
        $month = $date->format('m');
        $year = $date->format('Y');
        if (!empty($request->month)) {
            $month = $request->month;
        }
        if (!empty($request->year)) {
            $year = $request->year;
        }
        $result=['day'=>$day,'month'=>$month,'year'=>$year];

        return $result;
    }
}
