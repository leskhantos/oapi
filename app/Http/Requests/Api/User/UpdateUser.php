<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends ApiRequest
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
            'password'=>'required|string|min:5|max:200',
            'last_online'=>'date|min:5',
            'last_ip'=>'string|min:7',
            'oldPassword'=>'required|string|min:5|max:200',
        ];
    }
}
