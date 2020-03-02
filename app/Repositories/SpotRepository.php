<?php

namespace App\Repositories;

use App\Entities\GuestCall;
use App\Entities\SessionsAuth;
use App\Entities\Spot;
use App\Entities\Company;
use App\Helpers\Helper;
use App\Repositories\Interfaces\SpotRepositoryInterface;
use Illuminate\Http\Request;

class SpotRepository implements SpotRepositoryInterface
{
    public function spotByCompany($id)
    {
        $company = Company::findOrFail($id);
        $spot = Spot::
        select('spots.id', 'spots.company_id', 'pages.name as page_name',
            'spots.last_active', 'spots.ident', 'address',
            'spots.type', 'spots.page_id', 'spots.enabled')
            ->leftJoin('pages', 'page_id', '=', 'pages.id')
            ->where('spots.company_id', '=', $company->id)
            ->get();
        return $spot;
    }

    public function sessionBySpot($id){
        $spot = Spot::findOrFail($id);
        $session = SessionsAuth::select('created','device_mac')
            ->whereSpot_id($spot->id)->get();

        return $session;
    }

    public function callBySpot($id, Request $request)
    {
        $new = new Helper();
        $myDate = $new->currentDate($request);
        $spot = Spot::findOrFail($id);
//        dd($spot);
        $call = GuestCall::select('created','expiration','phone','device_mac','checked')
            ->whereSpot_id($spot->id)
            ->whereMonth('created', $myDate['month'])
            ->whereYear('created', $myDate['year'])
            ->orderBy('created', 'DESC')
        ->get();
//        dd($call);

        return @response($call);
    }
}
