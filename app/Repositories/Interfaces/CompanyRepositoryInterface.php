<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface CompanyRepositoryInterface
{
    public function all();

    public function getCompanyById($company_id);

    public function guestsByCompany($company_id, Request $request);

    public function accountsByCompany($company_id);
}
