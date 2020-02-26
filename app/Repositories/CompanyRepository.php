<?php

namespace App\Repositories;

use App\Entities\Account;
use App\Entities\Call;
use App\Entities\Company;
use App\Entities\Guest;
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

    public function guestsByCompany($company_id)
    {
        $guest = Company::
        leftjoin('spots', 'companies.id', '=', 'spots.company_id')
            ->leftJoin('stats_guests', 'spots.id', '=', 'stats_guests.spot_id')
            ->leftJoin('')

//            ->where('stats_guests.company_id', '=', $company_id)
            ->get();
        return response($guest, '200');
        //Визиты
    }

    public function accountsByCompany($company_id)
    {
        return Account::select('email', 'last_ip', 'last_online')
            ->where('accounts.company_id', '=', $company_id)->get();
    }

}
