<?php

namespace App\Http\Requests\Api\Companies;

use App\Entities\Spot;
use App\Http\Requests\Api\ApiRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreRequest
 * @property array $company
 * @property array $spot
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
            'company.name' => 'required|string|min:3|max:150',

            'spot.name' => 'required|string|min:4|max:50',
            'spot.address' => 'required|string|min:4|max:160',
            'spot.type' => ['required', Rule::in(Spot::types())],
            'spot.interface' => 'required|string|min:4|max:50',
        ];
    }
}
