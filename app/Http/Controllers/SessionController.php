<?php

namespace App\Http\Controllers;

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

    public function activeSessionBySpot($id, Request $request)
    {
        return $this->sessionRepository->activeSessionBySpot($id, $request);
    }

    public function finishedSessionBySpot($id, Request $request)
    {
        return $this->sessionRepository->finishedSessionBySpot($id, $request);
    }

    public function authSessionBySpot($id, Request $request)
    {
        return $this->sessionRepository->authSessionBySpot($id, $request);
    }
}
