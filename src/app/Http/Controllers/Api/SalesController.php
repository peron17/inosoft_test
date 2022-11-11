<?php

namespace App\Http\Controllers\Api;

use App\Repositories\SalesRepository;

class SalesController extends BaseController
{
    private $repository;

    public function __construct(SalesRepository $salesRepository)
    {
        $this->repository = $salesRepository;
    }

    public function salesPerItem()
    {
        return $this->repository->salesPerItem();
    }

    public function sales()
    {
        return $this->repository->sales();
    }
}
