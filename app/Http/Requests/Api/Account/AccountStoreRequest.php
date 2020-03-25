<?php

namespace App\Http\Requests\Api\Account;

use App\Http\Requests\Api\ApiRequest;

class AccountStoreRequest extends ApiRequest
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

    public function rules()
    {
        return [
            'id_company' => 'required|exists:companies,id',
            'login' => 'required|email|max:250|min:5|unique:users,login',
            'password' => 'required|string|min:5|max:45',
            'last_online' => 'date|min:5',
            'last_ip' => 'string|min:7',
            'enabled' => 'boolean'
        ];
    }
}
