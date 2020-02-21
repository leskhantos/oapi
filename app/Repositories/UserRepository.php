<?php

namespace App\Repositories;

use App\Entities\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function getUserById($user)
    {
        return User::findOrFail($user);
    }
}

