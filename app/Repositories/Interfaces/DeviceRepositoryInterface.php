<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface DeviceRepositoryInterface
{
    public function show($mac);

    public function mainByDevice($id);

    public function spotsByDevice($id);

    public function sessionByDevice($id, Request $request);

    public function phoneByDevice($mac);

    public function eventsByDevice($mac);
}
