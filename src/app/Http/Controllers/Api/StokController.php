<?php

namespace App\Http\Controllers\Api;

use App\Repositories\KendaraanRepository;
use Illuminate\Http\Request;

class StokController extends BaseController
{
    private $repository;

    public function __construct(KendaraanRepository $kendaraanRepository)
    {
        $this->repository = $kendaraanRepository;
    }

    public function stokKendaraan()
    {
        return $this->repository->getStockAll();
    }
}
