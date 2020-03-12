<?php

namespace App\Http\Controllers;

use App\Entities\GuestCall;
use App\Entities\Sms;
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

    public function spotTypesByCompany($spot_id)
    {
        return $this->spotRepository->spotTypesByCompany($spot_id);
    }

    public function smsBySpot($id, Request $request)
    {
        return $this->spotRepository->smsBySpot($id, $request);
    }

    public function eventsBySpot($id)
    {
        return $this->spotRepository->eventsBySpot($id);
    }

    public function create(Request $request)
    {
        return GuestCall::create($request->all());
    }

    public function test(Request $request)
    {
        return Sms::create($request->all());
    }

    public function show($id)
    {
        return Spot::leftJoin('spots_types', 'spots.type', '=', 'spots_types.id')->findOrFail($id);
    }

    public function store(SpotsStoreRequest $request)
    {
        return Spot::create($request->all());
    }

    public function saveLogsBySpot(Request $request)
    {
//        $id = $request->id;
//        $spot = Spot::findOrFail($id);
//        $name = strtolower($spot->ident);
//        $name .= ".log";
//        $way="/home/roman/valet/api.oyspot/www/data/spots/$name";
//        $array = $request->request;
//
//        $result="";
//        foreach ($array as $arr){
//            $result .= "$arr|";
//        }
//        $data = "$result\r\n";
//
//        \File::append("$way", "$data");
//        $contents =\File::get("$way");
//
//        return $contents;
        return view('test', $request->all());
    }

    public function update(SpotsUpdateRequest $request, $id)
    {
        $spot = Spot::findOrFail($id);
        $spot->update($request->all());
        return $spot;
    }
}
