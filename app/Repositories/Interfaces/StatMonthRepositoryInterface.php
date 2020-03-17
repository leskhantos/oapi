<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface StatMonthRepositoryInterface
{

    public function getAllStatsPerMonth(Request $request);

    public function getStatsByCompanyPerMonth($company_id, Request $request);

    public function getStatsBySpotPerMonth($spot_id, Request $request);

    public function getStatsByCompany($company_id, Request $request);

    public function getStatsBySpot($spot_id, Request $request);

}
