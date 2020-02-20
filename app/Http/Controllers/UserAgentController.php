<?php

namespace App\Http\Controllers;

use App\Entities\UserAgent;
use App\Http\Requests\Api\UserAgent\StoreRequest;
use Illuminate\Http\Request;

class UserAgentController extends Controller
{
    public function index()
    {
        return UserAgent::all();
    }

    public function store(StoreRequest $request)
    {
        return UserAgent::create($request->all());
    }

    public function show($id)
    {
        return UserAgent::find($id);
    }

}
