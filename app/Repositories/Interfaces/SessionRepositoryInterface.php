<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface SessionRepositoryInterface
{
    public function sessionBySpot($id, Request $request);
}
