<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\ApiRequest;

/**
 * Class StoreRequest
 * @property string $name
 * @property string $surname
 * @property string $login
 * @property string $password
 * @property int $role_id
 * @package App\Http\Requests\Api\User
 */
class StoreRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'surname' => 'required|string|min:2|max:255',
            'login' => 'required|string|min:6|max:55|unique:users,login',
            'password' => 'required|string|min:6|max:255',
            'role_id' => 'required|integer|exists:roles,id',
        ];
    }

}
