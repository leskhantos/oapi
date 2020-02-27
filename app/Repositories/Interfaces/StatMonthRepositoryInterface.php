<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface StatMonthRepositoryInterface
{

    public function getStatsSmsPerMonth(Request $request);

    public function getStatsCallsPerMonth(Request $request);

    public function getStatsVouchersPerMonth(Request $request);

    public function getStatsGuestByCompany($company_id, Request $request);

    public function getStatsCallsByCompany($company_id, Request $request);

    public function getStatsVouchersByCompany($company_id, Request $request);

    public function getStatsGuestBySpot($spot_id, Request $request);

    public function getStatsCallsBySpot($spot_id, Request $request);

    public function getStatsVouchersBySpot($spot_id, Request $request);

}
