<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/18/19
 * Time: 1:45 PM
 */

namespace App\Repositories;


use App\Entities\User as UserModel;
use App\Http\Requests\Api\User\StoreRequest;
use App\Http\Requests\Api\User\UpdateRequest;

class User
{
    /**
     * @return UserModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return UserModel::all();
    }

    /**
     * @param StoreRequest $request
     * @return UserModel
     */
    public function create(StoreRequest $request): UserModel
    {
        $user = UserModel::make($request->all());
        $user->setPassword($request->password);
        $user->save();

        return $user;
    }

    /**
     * @param UpdateRequest $request
     * @param int $userId
     * @return UserModel
     */
    public function update(UpdateRequest $request, int $userId): UserModel
    {
        $user = UserModel::findOrFail($userId);

        $user->fill($request->all());
        if (isset($request->password)) {
            $user->setPassword($request->password);
        }
        $user->save();

        return $user;
    }
}