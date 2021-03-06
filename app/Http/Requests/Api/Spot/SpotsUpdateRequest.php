<?php

namespace App\Http\Requests\Api\Spot;

use App\Adapters\StoreSpotRepositoryInterface;
use App\Http\Requests\Api\ApiRequest;

/**
 * Class StoreRequest
 * @property string $name
 * @property string $address
 * @property string $type
 * @property string $interface
 * @property int $company_id
 * @package App\Http\Requests\Api\Spot
 */
class SpotsUpdateRequest extends ApiRequest implements StoreSpotRepositoryInterface
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address' => 'string|min:4|max:160',
            'type' => 'integer|exists:spots_types,id',
            'ident' => 'string|min:4|max:50',
            'settings' => 'json',
            'page_id' => 'integer|exists:pages,id',
            'last_active' => 'date',
            'debug_key' => 'string|max:50',
            'enabled' => 'boolean'
        ];
    }
}
