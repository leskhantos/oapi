<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface SpotRepositoryInterface
{
    public function spotByCompany($company_id);

    public function callBySpot($spot_id, Request $request);

    public function sessionBySpot($spot_id);
}
