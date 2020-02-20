<?php

namespace App\Http\Controllers;

use App\Entities\Device;
use App\Entities\ParentStats;
use Illuminate\Http\JsonResponse;
use App\Repositories\Interfaces\StatRepositoryInterface;
use Illuminate\Http\Request;


class DeviceController extends Controller
{
//    private $statRepository;
//
//    public function __construct(StatRepositoryInterface $statRepository)
//    {
//        $this->statRepository = $statRepository;
//        parent::__construct();
//    }

    public function store(Request $request)
    {
//        return $this->statRepository->getAllStats();
        return Device::create($request->all());
    }
}
