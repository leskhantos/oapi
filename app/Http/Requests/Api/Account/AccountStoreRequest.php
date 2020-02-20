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
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|email|max:250|min:5|unique:accounts,email',
            'password' => 'required|string|max:200|min:5',
            'last_ip' => 'string|max:16',
            'last_online' => 'date',
        ];
    }
}
