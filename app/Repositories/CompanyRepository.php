<?php

namespace App\Repositories;

use App\Entities\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function all()
    {
        return Company::all();
    }
    public function getCompanyById($id)
    {
        return Company::find($id);
    }
}
