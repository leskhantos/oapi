<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface SpotRepositoryInterface
{
    public function spotByCompany($company_id);

    public function callBySpot($spot_id, Request $request);

    public function spotTypesByCompany($spot_id);

    public function smsBySpot($id, Request $request);

    public function eventsBySpot($id);
}
