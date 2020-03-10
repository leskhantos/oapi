<?php

namespace App\Repositories\Interfaces;

interface CompanyRepositoryInterface
{
    public function all();

    public function getCompanyById($company_id);

    public function accountsByCompany($company_id);

    public function pagesByCompany($company_id);
}
