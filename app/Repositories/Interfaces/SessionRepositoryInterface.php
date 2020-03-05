<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface SessionRepositoryInterface
{
    public function finishedSessionBySpot($id, Request $request);

    public function activeSessionBySpot($id);

    public function authSessionBySpot($id);
}
