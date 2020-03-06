<?php

namespace App\Http\Controllers;

use App\Entities\SessionsAuth;
use App\Entities\SessionsSpot;
use App\Repositories\Interfaces\SessionRepositoryInterface;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    private $sessionRepository;

    public function __construct(SessionRepositoryInterface $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
        parent::__construct();
    }

    public function sessionBySpot($id, Request $request)
    {
        return $this->sessionRepository->sessionBySpot($id, $request);
    }

    public function addSessionAuth (Request $request)
    {
        return SessionsAuth::create($request->all());
    }

    public function addSessionSpot (Request $request)
    {
        return SessionsSpot::create($request->all());
    }

}
