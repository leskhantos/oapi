<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface StatMonthRepositoryInterface
{

    public function getSmsPerMonth(Request $request);

    public function getCallsPerMonth(Request $request);

    public function getVouchersPerMonth(Request $request);

    public function getStatsGuestByCompany($company_id, Request $request);

    public function getCallsByCompany($company_id, Request $request);

    public function getVouchersByCompany($company_id, Request $request);

    public function getStatsGuestBySpot($spot_id, Request $request);

    public function getCallsBySpot($spot_id, Request $request);

    public function getVouchersBySpot($spot_id, Request $request);

}
