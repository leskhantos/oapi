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
}
