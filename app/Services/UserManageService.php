<?php


namespace App\Services;


use App\Entities\User;
use App\Http\Requests\Api\User\StoreRequest;
use App\Http\Requests\Api\User\UpdateRequest;

class UserManageService
{
    public function create(StoreRequest $request): User
    {
        $user = User::make($request->all());
        $user->setPassword($request->password);
        $user->assignRole($request->role_id);

        $user->save();

        return $user;
    }

    public function update(UpdateRequest $request, int $userId): User
    {
        $user = User::findOrFail($userId);
        $user->fill($request->all());

        if (isset($request->password)) {
            $user->setPassword($request->password);
        }

        if (isset($request->role_id)) {
            $user->assignRole($request->role_id);
        }

        $user->save();

        return $user;
    }
}
