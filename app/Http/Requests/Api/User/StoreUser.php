<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Api\ApiRequest;

class StoreUser extends ApiRequest
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
            'type'=>'required|in:admin,manager,support',
            'name'=>'required|string|max:32',
            'login'=>'required|string|min:4|max:32|unique:users,login',
            'password'=>'required|string|min:5|max:45',
            'last_online'=>'date|min:5',
            'last_ip'=>'string|min:7',
            'enabled'=>'boolean'
        ];
    }
}
