<?php

namespace App\Http\Controllers;

use App\Entities\Company;
use App\Http\Requests\Api\Companies\StoreRequest;
use App\Http\Requests\Api\Companies\UpdateRequest;
use Illuminate\Http\JsonResponse;

class CompaniesController extends Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse(Company::all());
    }

    public function destroy($id): JsonResponse
    {
        $company = Company::findOrFail($id);
        return new JsonResponse($company->delete(), 204);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $company = Company::create($request->all());
        return new JsonResponse($company, 201);
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $company = Company::findOrFail($id);
        $company->update($request->all());

        return new JsonResponse($company, 201);
    }
}
