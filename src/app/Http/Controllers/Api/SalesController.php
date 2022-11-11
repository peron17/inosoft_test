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

    public function salesKendaraan($id = null)
    {
        return $this->repository->salesKendaraan($id);
    }

    public function sales()
    {
        return $this->repository->sales();
    }
}
