<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface StatRepositoryInterface
{
    public function getAllStats();

    public function statsSms();

    public function statsCalls();

    public function statsVouchers();
}
