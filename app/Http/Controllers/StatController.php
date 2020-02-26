<?php

namespace App\Http\Controllers;

use App\Entities\StatsCall;
use App\Entities\StatsSms;
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

    public function getAllStat()
    {
        return $this->statRepository->getAllStats();
    }

    public function addSms(Request $request)
    {
        return StatsSms::create($request->all());
    }

    public function addCall(Request $request)
    {
        return StatsCall::create($request->all());
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
}
