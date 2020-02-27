<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface StatRepositoryInterface
{
    public function getAllStats();

    public function getSmsPerMonth(Request $request);

    public function getCallsPerMonth(Request $request);

    public function getVouchersPerMonth(Request $request);

    public function getStatsGuestByCompany($id_company, Request $request);

    public function getCallsByCompany($id_company, Request $request);

    public function getVouchersByCompany($id_company, Request $request);

    public function statsSms();

    public function statsCalls();

    public function statsVouchers();
}
