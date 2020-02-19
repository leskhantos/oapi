<?php

namespace App\Repositories;

use App\Entities\Spot;
use App\Entities\Company;
use App\Repositories\Interfaces\SpotRepositoryInterface;

class SpotRepository implements SpotRepositoryInterface
{
    public function spotByCompany($id){
        $company=Company::find($id);
        return Spot::where("$company->id")->get();
    }

}
