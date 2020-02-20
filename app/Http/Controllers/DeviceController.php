<?php

namespace App\Http\Controllers;

use App\Entities\Device;
use App\Entities\ParentStats;
use Illuminate\Http\JsonResponse;
use App\Repositories\Interfaces\StatRepositoryInterface;
use Illuminate\Http\Request;


class DeviceController extends Controller
{

    public function store(Request $request)
    {
        return Device::create($request->all());
    }
}
