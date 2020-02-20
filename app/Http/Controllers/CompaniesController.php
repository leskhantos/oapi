<?php

namespace App\Http\Controllers;

use App\Entities\Company;
use App\Entities\Guest;
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
        return Company::create($request->all());
    }

    public function update(UpdateRequest $request, $id)
    {
        $company = Company::find($id);
        $company->update([
            'name' => $request->name,
            'enabled' => $request->enabled
        ]);
        return $company;
    }

    public function show(int $id): JsonResponse
    {
        $company = $this->companyRepository->getCompanyById($id);

        return new JsonResponse($company);
    }

    public function guestsByCompany($id)
    {
        return $this->companyRepository->guestsByCompany($id);
    }

    public function test(Request $request)
    {
        return Guest::create($request->all());
    }

    public function accountsByCompany($id)
    {
        return $this->companyRepository->accountsByCompany($id);
    }
}
