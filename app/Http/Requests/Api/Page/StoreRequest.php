<?php

namespace App\Http\Requests\Api\Page;

use App\Http\Requests\Api\ApiRequest;

class StoreRequest extends ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_id'=>'required|integer|exists:companies,id',
            'name'=>'required|string|max:30',
            'type'=>'required|integer',
            'title'=>'required|string',
            'logo'=>'string|max:40',
            'background'=>'json',
            'style'=>'json',
            'banner'=>'json',
            'debug_key'=>'string|max:40'
        ];
    }
}
