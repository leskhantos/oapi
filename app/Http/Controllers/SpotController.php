<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Spot\StoreRequest;
use Illuminate\Http\JsonResponse;
use App\Repositories\Spot as SpotsRepository;

class SpotController extends Controller
{
    /**
     * @var SpotsRepository
     */
    private $spotRepository;

    public function __construct(SpotsRepository $spotRepository)
    {
        $this->spotRepository = $spotRepository;
        parent::__construct();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $spot = $this->spotRepository->create($request, $request->company_id);
        return new JsonResponse($spot, 201);
    }
}
