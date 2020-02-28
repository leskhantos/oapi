<?php

namespace App\Repositories\Interfaces;

interface StatRepositoryInterface
{
    public function getAllStats();

    public function getStatsByCompany($company_id);

    public function getStatsBySpot($spot_id);

}
