<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        return new JsonResponse(Role::all(['id', 'name']));
    }
}
