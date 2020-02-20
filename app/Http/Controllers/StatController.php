<?php

namespace App\Http\Controllers;

use App\Entities\ParentStats;
use App\Repositories\Interfaces\StatRepositoryInterface;


class StatController extends Controller
{
    private $statRepository;

    public function __construct(StatRepositoryInterface $statRepository)
    {
        $this->statRepository = $statRepository;
        parent::__construct();
    }

    public function getAllStat(){
        return $this->statRepository->getAllStats();
    }
}
