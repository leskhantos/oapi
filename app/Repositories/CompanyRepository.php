<?php

namespace App\Repositories;

use App\Entities\Account;
use App\Entities\Company;
use App\Entities\Page;
use App\Entities\Style;
use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function all()
    {
        return Company::all();
    }

    public function getCompanyById($id)
    {
        return Company::findOrFail($id);
    }

    public function accountsByCompany($company_id)
    {
        $company = Company::findOrFail($company_id);
        $account = Account::select('email', 'last_ip', 'last_online')
            ->where('accounts.company_id', '=', $company->id)->get();
        return $account;
    }

    public function pagesByCompany($company_id)
    {
        $company = Company::findOrFail($company_id);
        $pages = Style::select('name','address as spot','spots.type')->where('styles.company_id', '=', $company->id)
            ->leftJoin('spots','spots.style_id','=','styles.id')
            ->get();

        return $pages;
    }

}
