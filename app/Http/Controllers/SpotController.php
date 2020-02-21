<?php

namespace App\Http\Controllers;

use App\Entities\Spot;
use App\Http\Requests\Api\Spot\SpotsStoreRequest;
use App\Repositories\Interfaces\SpotRepositoryInterface;

class SpotController extends Controller
{
    private $spotRepository;

    public function __construct(SpotRepositoryInterface $spotRepository)
    {
        $this->spotRepository = $spotRepository;
        parent::__construct();
    }

    public function spotsByCompany($id)
    {
        return $this->spotRepository->spotByCompany($id);
    }

    public function show($id)
    {
        return Spot::findOrFail($id);
    }

    public function store(SpotsStoreRequest $request)
    {
        return Spot::create($request->all());
    }


}
