<?php

namespace App\Http\Controllers;

use App\Entities\Device;
use App\Repositories\Interfaces\DeviceRepositoryInterface;
use Illuminate\Http\Request;


class DeviceController extends Controller
{
    private $deviceRepository;

    public function __construct(DeviceRepositoryInterface $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
        parent::__construct();
    }

    public function store(Request $request)
    {
        $check = Device::where('mac', '=', $request->mac)->first();
        if (!empty($check)) {
            $check->update($request->all());
            return $check;
        } else {
            return Device::create($request->all());
        }
    }

    public function show($id)
    {
        return $this->deviceRepository->show($id);
    }

    public function mainByDevice($id)
    {
        return $this->deviceRepository->mainByDevice($id);
    }

    public function spotsByDevice($id)
    {
        return $this->deviceRepository->spotsByDevice($id);
    }

    public function sessionByDevice($id, Request $request)
    {
        return $this->deviceRepository->sessionByDevice($id, $request);
    }

    public function phoneByDevice($id)
    {
        return $this->deviceRepository->phoneByDevice($id);
    }

    public function eventsByDevice($id)
    {
        return $this->deviceRepository->eventsByDevice($id);
    }

}
