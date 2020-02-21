<?php

namespace App\Repositories;

use App\Entities\Company;
use App\Entities\Device;
use App\Entities\SessionsAuth;
use App\Entities\Spot;
use App\Repositories\Interfaces\StatRepositoryInterface;

class StatRepository implements StatRepositoryInterface
{
    public function getAllStats()
    {
        $company = new Company();
        $count_spots = $company->countSpots();
        $count_pages = $company->countPages();
        $count_companies = $company->countCompany();

        $device = new Device();
        $count_devices = $device->countDevices();
        $count_new_device = $device->countDevicesForMonth();
        $auth_guest = $device->countAuthUser();

        $session = new SessionsAuth();
        $sessions = $session->sessionAuth();

        return response([
                'count_company' => $count_companies,
                'count_spot' => $count_spots,
                'pages' => $count_pages,
                'count_all_device' => $count_devices,
                'count_new_device' => $count_new_device,
                'auth_guest' => $auth_guest,
                'session' => $sessions,
            ]
        );
    }
}
