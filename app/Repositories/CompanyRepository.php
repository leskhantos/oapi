<?php

namespace App\Repositories;

use App\Entities\Account;
use App\Entities\Call;
use App\Entities\Company;
use App\Entities\Guests\Guest;
use App\Entities\Page;
use App\Helpers\Helper;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Http\Request;

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
        $pages = Page::select('name','address as spot')->where('pages.company_id', '=', $company->id)
            ->leftJoin('spots','spots.page_id','=','pages.id')
            ->get();

        return $pages;
    }

}
