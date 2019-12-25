<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Requests\Api\User\StoreRequest;
use App\Http\Requests\Api\User\UpdateRequest;
use App\Services\UserManageService;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    private UserManageService $service;

    public function __construct(UserManageService $service)
    {
        $this->service = $service;
        $this->middleware(['role:admin|manager']);
        parent::__construct();
    }

    public function index(): JsonResponse
    {
        return new JsonResponse(User::all());
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $user = $this->service->create($request);
        return new JsonResponse($user, 201);
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $user = $this->service->update($request, $id);
        return new JsonResponse($user, 201);
    }

}
