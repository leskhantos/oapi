<?php

namespace App\Http\Requests\Api\Companies;

use App\Http\Requests\Api\ApiRequest;

/**
 * Class StoreRequest
 * @property int $user_id
 * @property string $company
 * @package App\Http\Requests\Api\Companies
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
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|min:3|max:150',
        ];
    }
}
