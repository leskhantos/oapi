<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/19/19
 * Time: 5:10 PM
 */

namespace App\Services;

use App\Http\Requests\Api\Companies\StoreRequest;
use App\Repositories\Company as CompaniesRepository;

class Company
{
    /**
     * @var CompaniesRepository
     */
    private $companyRepository;

    public function __construct(CompaniesRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function create(StoreRequest $request)
    {
        $company = $this->companyRepository->create($request);

    }
}