<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Companies\StoreRequest;
use App\Http\Requests\Api\Companies\UpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Repositories\Company as CompanyRepository;

class CompaniesController extends Controller
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index(): JsonResponse
    {
        return new JsonResponse($this->companyRepository->all());
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

    public function store(StoreRequest $request): JsonResponse
    {
        return new JsonResponse($this->companyRepository
            ->create($request), 201);
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $company = $this->companyRepository->update($request, $id);

        return new JsonResponse($company, 201);
    }

    public function show(int $id): JsonResponse
    {
        $company = $this->companyRepository->findById($id);

        return new JsonResponse($company->load('user'));
    }
}
