<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface GuestRepositoryInterface
{
    public function guestBySpot($id, Request $request);

    public function guestByCompany($id, Request $request);
}
