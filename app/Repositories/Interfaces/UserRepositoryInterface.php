<?php
namespace App\Repositories\Interfaces;

use App\Entities\User;

interface UserRepositoryInterface
{
    public function all();
    public function getUserById(User $user);
}
