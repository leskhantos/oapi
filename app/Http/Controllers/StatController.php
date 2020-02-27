<?php

namespace App\Http\Controllers;

use App\Entities\StatsCall;
use App\Entities\StatsGuest;
use App\Entities\StatsSms;
use App\Entities\StatsVoucher;
use App\Repositories\Interfaces\StatRepositoryInterface;
use Illuminate\Http\Request;


class StatController extends Controller
{
    private $statRepository;

    public function __construct(StatRepositoryInterface $statRepository)
    {
        $this->statRepository = $statRepository;
        parent::__construct();
    }

    public function addSms(Request $request)
    {
        return StatsSms::create($request->all());
    }

    public function addCall(Request $request)
    {
        return StatsCall::create($request->all());
    }

    public function addGuest(Request $request)
    {
        return StatsGuest::create($request->all());
    }

    public function addVoucher(Request $request)
    {
        return StatsVoucher::create($request->all());
    }

    public function getSmsPerMonth(Request $request)
    {
        return $this->statRepository->getSmsPerMonth($request);
    }

    public function getCallsPerMonth(Request $request)
    {
        return $this->statRepository->getCallsPerMonth($request);
    }

    public function getVouchersPerMonth(Request $request)
    {
        return $this->statRepository->getVouchersPerMonth($request);
    }

    public function getCallsByCompany($id, Request $request)
    {
        return $this->statRepository->getCallsByCompany($id, $request);
    }

    public function getStatsGuestByCompany($id, Request $request)
    {
        return $this->statRepository->getStatsGuestByCompany($id, $request);
    }

    public function getVouchersByCompany($id, Request $request)
    {
        return $this->statRepository->getVouchersByCompany($id, $request);
    }

    public function getAllStat()
    {
        return $this->statRepository->getAllStats();
    }

    public function statsSms()
    {
        return $this->statRepository->statsSms();
    }

    public function statsCalls()
    {
        return $this->statRepository->statsCalls();
    }

    public function statsVouchers()
    {
        return $this->statRepository->statsVouchers();
    }
}
