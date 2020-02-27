<?php

namespace App\Repositories\Interfaces;

interface StatRepositoryInterface
{
    public function getAllStats();

    public function getStatsSms();

    public function getStatsCalls();

    public function getStatsVouchers();
}
