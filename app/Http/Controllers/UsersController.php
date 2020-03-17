<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\User\UserUpdate;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\User\StoreUser;
use App\Http\Requests\Api\User\UpdatePassword;

class UsersController extends Controller
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    public function index()
    {
        return $this->userRepository->all();
    }

    public function store(StoreUser $request)
    {
        return User::create($request->validated());
    }

    public function show($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function update(UserUpdate $request, $id)
    {
        if (auth()->user()->type == 'admin') {
            $user = User::findOrFail($id);
            $user->update($request->validated());
            return response($user);
        }else{
            return response('No privileges',403);
        }
    }

    public function updatePassword(UpdatePassword $request)
    {
        $id = auth()->user()->id;
        $pass = $request->oldPassword;
        $user = User::find($id);

        if (Hash::check($pass, $user->password)) {
            $user->update([
                'password' => $request->password,
                'last_online' => $request->last_online,
                'last_ip' => $request->last_ip]);
            return response($user, 200);
        } else
            return response([
                'password' => ['The oldPassword is invalid']
            ], 422);
    }
}
