<?php

namespace App\Helpers;

class Helper{
    public function currentDate(){
        $date = new \DateTime();
        $day = $date->format('d');
        $month = $date->format('m');
        $year = $date->format('Y');
        $result=['day'=>$day,'month'=>$month,'year'=>$year];

        return $result;
    }
}
