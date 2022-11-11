<?php

namespace App\Repositories;

use App\Http\Requests\StockReportRequest;
use App\Http\Resources\StockResource;
use App\Models\Kendaraan;

class KendaraanRepository
{
    private $request;

    public function __construct(StockReportRequest $request)
    {
        $this->request = $request;
    }

    public function getStockAll()
    {
        $nama = $this->request->get('nama_kendaraan');
        $jenis = $this->request->get('jenis_kendaraan');

        $list = [];
        if ($nama && $jenis) {
            $list = Kendaraan::where('nama_kendaraan', 'like', '%' . $nama . '%')
                ->where('jenis_kendaraan', '=', $jenis)
                ->paginate();
        } elseif ($nama) {
            $list = Kendaraan::where('nama_kendaraan', 'like', '%' . $nama . '%')
                ->paginate();
        } elseif ($jenis) {
            $list = Kendaraan::where('jenis_kendaraan', '=', $jenis)
                ->paginate();
        } else {
            $list = Kendaraan::paginate();
        }

        return StockResource::collection($list);
    }
}
