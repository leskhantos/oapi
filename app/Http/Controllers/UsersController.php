<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\User\StoreRequest;
use App\Entities\User;
use App\Http\Requests\Api\User\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse(User::all());
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $user = User::make($request->all());
        $user->setPassword($request->password);
        $user->save();

        return new JsonResponse($user, 201);
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        $user->fill($request->all());
        if (isset($request->password)) {
            $user->setPassword($request->password);
        }
        $user->save();

        return new JsonResponse($user, 201);
    }

}
