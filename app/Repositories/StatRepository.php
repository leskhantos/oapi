<?php

namespace App\Repositories;

use App\Entities\Company;
use App\Entities\Device;
use App\Entities\Page;
use App\Entities\Spot;
use App\Repositories\Interfaces\StatRepositoryInterface;

class StatRepository implements StatRepositoryInterface
{
    public function getAllStats()
    {
        $company=Company::count();
        $spot=Spot::count();
        $pages=Page::count();
        $all_device=Device::count();
        $new_device=Device::where('sessions','<',10)->count();
        $auth_guest=0;
        $session=0;

        return response([
            'count_company'=>$company,
            'count_spot'=>$spot,
            'pages'=>$pages,
            'count_all_device'=>$all_device,
            'count_new_device'=>$new_device,
            'auth_guest'=>$auth_guest,
            'session'=>$session,
        ]
        );
    }
}
