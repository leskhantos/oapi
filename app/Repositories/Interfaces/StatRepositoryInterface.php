<?php

namespace App\Repositories\Interfaces;

interface StatRepositoryInterface
{
    public function getAllStats();

    public function getStatsSms();

    public function getStatsCalls();

    public function getStatsVouchers();

    public function statsByDeviceInCompany($company_id);

    public function statsByOsInCompany($company_id);

    public function statsByBrowserInCompany($company_id);

    public function statsByCallsInCompany($company_id);

    public function statsByGuestsInCompany($company_id);
}
