<?php

namespace App\Http\Requests\Api\Spot;

use App\Adapters\StoreSpotRepositoryInterface;
use App\Entities\Spot;
use App\Http\Requests\Api\ApiRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreRequest
 * @property string $name
 * @property string $address
 * @property string $type
 * @property string $interface
 * @property int $company_id
 * @package App\Http\Requests\Api\Spot
 */
class StoreRequest extends ApiRequest implements StoreSpotRepositoryInterface
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
            'company_id' => 'required|integer|exists:companies,id',
            'name' => 'required|string|min:4|max:50',
            'address' => 'required|string|min:4|max:160',
            'auth_type_id' => 'required|integer|exists:auth_types,id',
            'interface' => 'required|string|min:4|max:50',
        ];
    }
}
