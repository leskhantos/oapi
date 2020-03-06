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

    public function sessionBySpot($id, Request $request)
    {
        return $this->sessionRepository->sessionBySpot($id, $request);
    }

}
