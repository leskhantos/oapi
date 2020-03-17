<?php

namespace App\Http\Controllers;

use App\Entities\StatsCall;
use App\Entities\StatsDevice;
use App\Entities\StatsGuest;
use App\Entities\StatsSms;
use App\Entities\StatsVoucher;
use App\Repositories\Interfaces\StatMonthRepositoryInterface;
use Illuminate\Http\Request;


class StatController extends Controller
{
    private $statMonthRepository;

    public function __construct(StatMonthRepositoryInterface $statMonthRepository)
    {
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

    public function addDevice(Request $request)
    {
        return StatsDevice::create($request->all());
    }

    public function getAllStatsPerMonth(Request $request)
    {
        return $this->statMonthRepository->getAllStatsPerMonth($request);
    }

    public function getStatsByCompanyPerMonth($company_id, Request $request)
    {
        return $this->statMonthRepository->getStatsByCompanyPerMonth($company_id, $request);
    }

    public function getStatsBySpotPerMonth($spot_id, Request $request)
    {
        return $this->statMonthRepository->getStatsBySpotPerMonth($spot_id, $request);
    }

    public function getAllStat(Request $request)
    {
        return $this->statMonthRepository->getAllStats($request);
    }

    public function getStatsByCompany($company_id, Request $request)
    {
        return $this->statMonthRepository->getStatsByCompany($company_id, $request);
    }

    public function getStatsBySpot($spot_id, Request $request)
    {
        return $this->statMonthRepository->getStatsBySpot($spot_id, $request);
    }
}
