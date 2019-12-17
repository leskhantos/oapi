<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\User\StoreRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        return new JsonResponse(User::all());
    }

    public function store(StoreRequest $request)
    {
        $user = User::make($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        return new JsonResponse($user, 201);
    }

    public function update(UpdateRequest $request)
    {
        //TODO
    }

}
