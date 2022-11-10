<?php

namespace App\Repositories;

use App\Http\Resources\StockResource;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\DB;

class KendaraanRepository
{
    public function getStockAll()
    {
        return StockResource::collection(Kendaraan::all());
    }
}
