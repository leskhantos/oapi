<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'=>['required','string'],
            'name'=>['required','string','max:32'],
            'login'=>['required', 'string', 'min:4', 'max:32','unique:users,login'].$this->route()->id,
            'password'=>['required','string','min:5','max:45'],
            'last_online'=>['date','min:5'],
            'last_ip'=>['string','min:7'],
            'enabled'=>['boolean']
        ];
    }
}
