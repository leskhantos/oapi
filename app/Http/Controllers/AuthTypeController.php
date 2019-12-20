<?php

namespace App\Http\Controllers;

use App\Entities\AuthType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthTypeController extends Controller
{
    public function index(): JsonResponse
    {
        $types = AuthType::all('id', 'name', 'code');
        return new JsonResponse($types);
    }
}
