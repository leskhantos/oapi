<?php

namespace App\Http\Requests\Api\SpotsType;

use App\Adapters\StoreSpotRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;


class StoreRequest extends FormRequest implements StoreSpotRepositoryInterface
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
            'code'=>'string|max:15',
            'name'=>'string|max:15'
        ];
    }
}
