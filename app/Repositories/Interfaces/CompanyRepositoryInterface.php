<?php

namespace App\Repositories\Interfaces;

use App\Entities\Company;

interface CompanyRepositoryInterface
{
    public function all();
    public function getCompanyById($id);
}
