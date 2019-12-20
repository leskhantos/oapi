<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/19/19
 * Time: 5:10 PM
 */

namespace App\Services;

use App\Adapters\StoreSpotRequestAdapter;
use App\Http\Requests\Api\Companies\StoreRequest;
use App\Repositories\Company as CompaniesRepository;
use App\Repositories\Spot as SpotsRepository;

class Company
{
    /**
     * @var CompaniesRepository
     */
    private $companyRepository;
    /**
     * @var SpotsRepository
     */
    private $spotRepository;

    public function __construct(CompaniesRepository $companyRepository, SpotsRepository $spotRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->spotRepository = $spotRepository;
    }

    public function create(StoreRequest $request): array
    {
        $company = $this->companyRepository->create($request);
        $spot = $this->spotRepository->create(new StoreSpotRequestAdapter($request), $company->id);

        return [
            'company' => $company,
            'spot' => $spot
        ];
    }
}