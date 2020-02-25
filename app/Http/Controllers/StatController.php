<?php

namespace App\Http\Controllers;

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

    public function getSmsPerMonth()
    {
        return $this->statRepository->getSmsPerMonth();
    }

    public function getCallsPerMonth()
    {
        return $this->statRepository->getCallsPerMonth();
    }

    public function getCallsByCompany($id)
    {
        return $this->statRepository->getCallsByCompany($id);
    }

    public function getStatsGuestByCompany($id)
    {
        return $this->statRepository->getStatsGuestByCompany($id);
    }
}
