<?php

namespace App\Repositories\Interfaces;

interface StatRepositoryInterface
{
    public function getAllStats();

    public function getSmsPerMonth();

    public function getCallsPerMonth();

    public function getStatsGuestByCompany($id_company);

    public function getCallsByCompany($id_company);
}
