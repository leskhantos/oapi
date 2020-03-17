<?php

namespace App\Http\Requests\Api\Vouchers;

use App\Http\Requests\Api\ApiRequest;

class VoucherUpdate extends ApiRequest
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
            'dt_end'=>'required',
            'dt_start'=>'required',
            'room'=>'required'
        ];
    }
}
