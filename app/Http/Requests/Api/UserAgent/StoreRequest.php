<?php

namespace App\Http\Requests\Api\UserAgent;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'info'=>'required|string|max:300',
            'software'=>'required|string|max:300',
            'software_name'=>'string|max:30',
            'software_code'=>'string|max:30',
            'software_version'=>'string|max:30',
            'software_type'=>'string|max:30',
            'engine_name'=>'string|max:30',
            'engine_version'=>'string|max:30',
            'hardware_type'=>'string|max:50',
            'os'=>'string|max:30',
            'os_name'=>'string|max:30',
            'os_code'=>'string|max:30',
            'os_version'=>'string|max:30'
        ];
    }
}
