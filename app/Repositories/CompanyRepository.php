<?php

namespace App\Repositories;

use App\Entities\Account;
use App\Entities\Call;
use App\Entities\Company;
use App\Entities\Guests\Guest;
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

    public function guestsByCompany($company_id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $guests = Guest::select('guests.id','datetime', 'devices.type as type_device', 'os', 'device_mac', 'spots.type', 'data_auth', 'sessions')
            ->leftJoin('devices', 'guests.device_mac', '=', 'devices.mac')
            ->leftJoin('spots', 'guests.spot_id', '=', 'spots.id')
            ->where('guests.company_id', '=', $company_id)
            ->whereMonth('datetime', $myDate['month'])
            ->whereYear('datetime', $myDate['year'])->orderBy('sessions', 'DESC')->get();

        $uniq_mac=[];$uniq_arr=[];
        foreach ($guests as $guest)
        {
            if(!in_array($guest['device_mac'],$uniq_mac)){
                $uniq_mac[]=$guest['device_mac'];
                $uniq_arr[]=$guest;
            }
        }

        return response($uniq_arr);
    }

    public function accountsByCompany($company_id)
    {
        $company = Company::findOrFail($company_id);
        $account = Account::select('email', 'last_ip', 'last_online')
            ->where('accounts.company_id', '=', $company->id)->get();
        return $account;
    }

}
