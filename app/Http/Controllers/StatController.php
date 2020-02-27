<?php

namespace App\Http\Controllers;

use App\Entities\StatsCall;
use App\Entities\StatsGuest;
use App\Entities\StatsSms;
use App\Entities\StatsVoucher;
use App\Repositories\Interfaces\StatMonthRepositoryInterface;
use App\Repositories\Interfaces\StatRepositoryInterface;
use Illuminate\Http\Request;


class StatController extends Controller
{
    private $statRepository;
    private $statMonthRepository;

    public function __construct(StatRepositoryInterface $statRepository, StatMonthRepositoryInterface $statMonthRepository)
    {
        $this->statRepository = $statRepository;
        $this->statMonthRepository = $statMonthRepository;
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

    public function getStatsSmsPerMonth(Request $request)
    {
        return $this->statMonthRepository->getStatsSmsPerMonth($request);
    }

    public function getStatsCallsPerMonth(Request $request)
    {
        return $this->statMonthRepository->getStatsCallsPerMonth($request);
    }

    public function getStatsVouchersPerMonth(Request $request)
    {
        return $this->statMonthRepository->getStatsVouchersPerMonth($request);
    }

    public function getStatsCallsByCompany($company_id, Request $request)
    {
        return $this->statMonthRepository->getStatsCallsByCompany($company_id, $request);
    }

    public function getStatsGuestByCompany($company_id, Request $request)
    {
        return $this->statMonthRepository->getStatsGuestByCompany($company_id, $request);
    }

    public function getStatsVouchersByCompany($company_id, Request $request)
    {
        return $this->statMonthRepository->getStatsVouchersByCompany($company_id, $request);
    }

    public function getCallsBySpot($spot_id, Request $request)
    {
        return $this->statMonthRepository->getStatsCallsBySpot($spot_id, $request);
    }

    public function getStatsGuestBySpot($spot_id, Request $request)
    {
        return $this->statMonthRepository->getStatsGuestBySpot($spot_id, $request);
    }

    public function getVouchersBySpot($spot_id, Request $request)
    {
        return $this->statMonthRepository->getStatsVouchersBySpot($spot_id, $request);
    }

    public function getAllStat()
    {
        return $this->statRepository->getAllStats();
    }

    public function getStatsSms()
    {
        return $this->statRepository->getStatsSms();
    }

    public function getStatsCalls()
    {
        return $this->statRepository->getStatsCalls();
    }

    public function getStatsVouchers()
    {
        return $this->statRepository->getStatsVouchers();
    }

    public function statsByDeviceInCompany($company_id)
    {
        return $this->statRepository->statsByDeviceInCompany($company_id);
    }

    public function statsByOsInCompany($company_id)
    {
        return $this->statRepository->statsByOsInCompany($company_id);
    }

    public function statsByBrowserInCompany($company_id)
    {
        return $this->statRepository->statsByBrowserInCompany($company_id);
    }

    public function statsByCallsInCompany($company_id)
    {
        return $this->statRepository->statsByCallsInCompany($company_id);
    }

    public function statsByGuestsInCompany($company_id)
    {
        return $this->statRepository->statsByGuestsInCompany($company_id);
    }
}
