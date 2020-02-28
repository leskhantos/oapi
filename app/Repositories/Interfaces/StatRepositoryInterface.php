<?php

namespace App\Repositories\Interfaces;

interface StatRepositoryInterface
{
    public function getAllStats();

    public function getStatsSms();

    public function getStatsCalls();

    public function getStatsVouchers();

    public function getStatsByCompany($company_id);

    public function getStatsByDeviceInSpot($spot_id);

    public function getStatsByOsInSpot($spot_id);

    public function getStatsByBrowserInSpot($spot_id);

    public function getStatsByCallsInSpot($spot_id);

    public function getStatsByGuestsInSpot($spot_id);
}
