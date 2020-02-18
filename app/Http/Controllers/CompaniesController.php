<?php

namespace App\Http\Controllers;

use App\Entities\Company;
use App\Entities\Spot;
use Illuminate\Http\Request;
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
        return Company::select('companies.name as company_name','spots_types.name','address','ident','code')
            ->leftJoin('spots','companies.id','=','spots.company_id')
            ->leftJoin('spots_types','spots.type','=','spots_types.id')->get();
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
        return new JsonResponse($this->companyRepository
            ->destroy($id), 204);
    }

    public function store(StoreRequest $request)
    {
        //

//        return new JsonResponse($this->companiesService->create($request), 201);
    }

//    public function update(UpdateRequest $request, int $id): JsonResponse
    public function update(Request $request, $id)
    {
//        $company = $this->companyRepository->update($request, $id);
//        return new JsonResponse($company, 201);

        $company = Company::find($id);
        $company->update(['enabled'=>$request->enabled]);
        return $company;

    }

    public function show(int $id): JsonResponse
    {
        $company = $this->companyRepository->findById($id);

        return new JsonResponse($company);
    }
}
