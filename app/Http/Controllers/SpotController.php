<?php

namespace App\Http\Controllers;

use App\Entities\GuestCall;
use App\Entities\Spot;
use App\Http\Requests\Api\Spot\SpotsStoreRequest;
use App\Http\Requests\Api\Spot\SpotsUpdateRequest;
use App\Repositories\Interfaces\SpotRepositoryInterface;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    private $spotRepository;

    public function __construct(SpotRepositoryInterface $spotRepository)
    {
        $this->spotRepository = $spotRepository;
        parent::__construct();
    }

    public function spotsByCompany($company_id)
    {
        return $this->spotRepository->spotByCompany($company_id);
    }

    public function callBySpot($spot_id, Request $request)
    {
        return $this->spotRepository->callBySpot($spot_id, $request);
    }

    public function sessionBySpot($spot_id)
    {
        return $this->spotRepository->sessionBySpot($spot_id);
    }

    public function create(Request $request){
        return  GuestCall::create($request->all());
    }

    public function show($id)
    {
        return Spot::findOrFail($id);
    }

    public function store(SpotsStoreRequest $request)
    {
        return Spot::create($request->all());
    }

    public function update(SpotsUpdateRequest $request, $id)
    {
        $spot = Spot::findOrFail($id);
        $spot->update($request->all());
        return $spot;
    }


}
