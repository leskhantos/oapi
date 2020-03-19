<?php

namespace App\Http\Controllers;

use App\Entities\Company;
use App\Entities\Spot;
use App\Http\Requests\Api\Companies\CompanyStoreRequest;
use App\Http\Requests\Api\Companies\UpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    private $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
        parent::__construct();
    }

    public function index()
    {
        return $this->companyRepository->all();
    }

    public function store(CompanyStoreRequest $request)
    {
        return Company::create($request->validated());
    }

    public function update(UpdateRequest $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->validated());
        return $company;
    }

    public function show(int $id): JsonResponse
    {
        $company = $this->companyRepository->getCompanyById($id);

        return new JsonResponse($company);
    }

    public function destroy($id)
    {
        if (auth()->user()->type == 'admin') {
            Spot::where('company_id', '=', $id)->delete();
            Company::destroy($id);
            return response('Success');
        } else {
            return response('No privileges', 403);
        }
    }

    public function accountsByCompany($id)
    {
        return $this->companyRepository->accountsByCompany($id);
    }

    public function pagesByCompany($id)
    {
        return $this->companyRepository->pagesByCompany($id);
    }
}
