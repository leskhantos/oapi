<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\User\StoreRequest;
use App\Http\Requests\Api\User\UpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Repositories\User as UsersRepository;

class UsersController extends Controller
{
    private $usersRepository;

    public function __construct(UsersRepository $repository)
    {
        $this->usersRepository = $repository;
    }

    public function index(): JsonResponse
    {
        return new JsonResponse($this->usersRepository->all());
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $user = $this->usersRepository->create($request);

        return new JsonResponse($user, 201);
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $user = $this->usersRepository->update($request, $id);

        return new JsonResponse($user, 201);
    }

}
