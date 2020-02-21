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
        $spot = Spot::
        select('spots.id', 'spots.company_id', 'pages.name as page_name',
            'spots.last_active', 'spots.ident', 'address', 'spots.type', 'spots.page_id','spots.enabled')->
        leftJoin('pages', 'page_id', '=', 'pages.id')
            ->where('spots.company_id', '=', $company->id)
            ->get();
        return $spot;
    }

}
