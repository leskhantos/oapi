<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface CompanyRepositoryInterface
{
    public function all();

    public function getCompanyById($company_id);

    public function accountsByCompany($company_id);
}
