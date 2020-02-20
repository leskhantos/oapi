<?php

namespace App\Http\Requests\Api\Companies;

use App\Http\Requests\Api\ApiRequest;

/**
 * Class StoreRequest
 * @property int $user_id
 * @property string $company
 * @package App\Http\Requests\Api\Companies
 */
class UpdateRequest extends ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|min:3|max:150',
            'enabled' => 'boolean'
        ];
    }
}
