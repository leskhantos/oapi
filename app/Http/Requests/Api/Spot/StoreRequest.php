<?php

namespace App\Http\Requests\Api\Spot;

use App\Entities\Spot;
use App\Http\Requests\Api\ApiRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreRequest
 * @property string $name
 * @property string $address
 * @property string $type
 * @property string $interface
 * @package App\Http\Requests\Api\Spot
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
            'name' => 'required|string|min:4|max:50',
            'address' => 'required|string|min:4|max:160',
            'type' => ['required', Rule::in(Spot::types())],
            'interface' => 'required|string|min:4|max:50',
        ];
    }
}
