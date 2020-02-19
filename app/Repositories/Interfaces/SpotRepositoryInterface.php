<?php
namespace App\Repositories\Interfaces;

use App\Entities\Spot;
use App\Entities\Company;

interface SpotRepositoryInterface
{
    public function spotByCompany(Company $company);

}
