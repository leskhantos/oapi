<?php

namespace App\Repositories;

use App\Entities\Spot;
use App\Entities\Company;
use App\Repositories\Interfaces\SpotRepositoryInterface;

class SpotRepository implements SpotRepositoryInterface
{
    public function spotByCompany($id)
    {
        $company = Company::findOrFail($id);
        return Spot::
        select('spots.id','spots.company_id','pages.name',
            'spots.last_active','spots.ident','address','spots.type','page_id')->
            leftJoin('pages','page_id','=','pages.id')
            ->where('spots.company_id','=',$company->id)
            ->get();
    }

}
