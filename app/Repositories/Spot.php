<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/20/19
 * Time: 11:18 AM
 */

namespace App\Repositories;

use App\Adapters\StoreSpotRepositoryInterface;
use App\Entities\Spot as SpotModel;

class Spot
{
    public function create(StoreSpotRepositoryInterface $request, int $company_id): SpotModel
    {
        $spot = SpotModel::make($request->all());
        $spot->company_id = $company_id;
//        $spot->updateSettings();
//        $spot->page_type=


        $spot->save();

        return $spot;
    }
}