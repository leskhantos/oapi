<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/18/19
 * Time: 2:57 PM
 */

namespace App\Repositories;

use App\Entities\Company as CompanyModel;
use App\Http\Requests\Api\Companies\StoreRequest;
use App\Http\Requests\Api\Companies\UpdateRequest;

class Company
{
    /**
     * @return CompanyModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return CompanyModel::all();
    }

    /**
     * @param int $companyId
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(int $companyId): ?bool
    {
        return $this->findById($companyId)->delete();
    }

    public function findById(int $companyId): CompanyModel
    {
        return CompanyModel::findOrFail($companyId);
    }

    public function create(StoreRequest $request): CompanyModel
    {
        return CompanyModel::create($request->all());
    }

    public function update(UpdateRequest $request, int $companyId): CompanyModel
    {
        $company = $this->findById($companyId);
        $company->update($request->all());

        return $company;
    }

}