<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/20/19
 * Time: 12:02 PM
 */

namespace App\Adapters;


use App\Http\Requests\Api\Companies\StoreRequest;

class StoreSpotRequestAdapter implements StoreSpotRepositoryInterface
{
    /**
     * @var StoreRequest
     */
    private $request;

    public function __construct(StoreRequest $request)
    {
        $this->request = $request;
    }

    public function all(): array
    {
        return $this->request->spot;
    }
}