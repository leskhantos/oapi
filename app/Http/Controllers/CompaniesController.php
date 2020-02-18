<?php

namespace App\Http\Controllers;

use App\Entities\Company;
use App\Http\Requests\Api\Companies\StoreRequest;
use App\Http\Requests\Api\Companies\UpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Repositories\Company as CompanyRepository;
use App\Services\Company as CompaniesService;
use App\Repositories\Spot as SpotsRepository;

class CompaniesController extends Controller
{
    protected $companyRepository;
    protected $companiesService;

    public function __construct(CompanyRepository $companyRepository, SpotsRepository $spotsRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->companiesService = new CompaniesService($companyRepository, $spotsRepository);
        parent::__construct();
    }

    public function index()
    {
        return Company::select('companies.id','companies.name as company_name','spots_types.name as spot_name','address','ident','code')
            ->leftJoin('spots','companies.id','=','spots.company_id')
            ->leftJoin('spots_types','spots.type','=','spots_types.id')
            ->orderBy('id')->get();
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */

    public function store(StoreRequest $request)
    {
        return Company::create($request->all());
    }

    public function update(UpdateRequest $request, $id)
    {
        $company = Company::find($id);
        $company->update([$request->all()]);
        return $company;
    }

    public function show(int $id): JsonResponse
    {
        $company = $this->companyRepository->findById($id);

        return new JsonResponse($company);
    }
}
