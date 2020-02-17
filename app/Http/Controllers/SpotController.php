<?php

namespace App\Http\Controllers;

use App\Entities\Spot;
use App\Http\Requests\Api\Spot\StoreRequest;
use Illuminate\Http\JsonResponse;
use App\Repositories\Spot as SpotsRepository;
use Illuminate\Http\Request;

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

    public function store(StoreRequest $request)
    {
        return Spot::create($request->all());
    }

    public function index(Request $request)
    {
        $company = $request->company;
        return Spot::join('companies','spots.company_id','=','companies.id')
            ->where('company_id','=',"$company")
            ->get();
    }
}
