<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\User\StoreRequest;
use App\Entities\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse(User::all());
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $user = User::make($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        return new JsonResponse($user, 201);
    }

    //TODO:
    public function update(StoreRequest $request, int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        $attributes = $request->all();
        if (isset($request->password)) {
            $attributes['password'] = Hash::make($request->password);
        }

        $user->update($request->all());

        return new JsonResponse($user, 201);
    }

}
