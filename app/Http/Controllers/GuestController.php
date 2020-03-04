<?php

namespace App\Http\Controllers;

use App\Entities\Guests\Guest;
use App\Repositories\Interfaces\GuestRepositoryInterface;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    private $guestRepository;

    public function __construct(GuestRepositoryInterface $guestRepository)
    {
        $this->guestRepository = $guestRepository;
        parent::__construct();
    }

    public function guestBySpot($id, Request $request)
    {
        return $this->guestRepository->guestBySpot($id, $request);

    }

    public function guestByCompany($id, Request $request)
    {
        return $this->guestRepository->guestByCompany($id, $request);
    }

    public function store(Request $request)
    {
//        if request->company_id = spots.company id
        return Guest::create($request->all());
//
    }
}
