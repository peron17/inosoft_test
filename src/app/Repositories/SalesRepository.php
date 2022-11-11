<?php

namespace App\Repositories;

use App\Http\Requests\SalesReportRequest;
use App\Http\Resources\SalesKendaraanResource;
use App\Http\Resources\SalesResource;
use App\Models\Kendaraan;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesRepository
{
    private $request;

    public function __construct(SalesReportRequest $request)
    {
        $this->request = $request;
    }

    /**
     * collect data kendaraan with sales total for each kendaraan
     */
    public function salesKendaraan($id = null)
    {
        $jenis = strtolower($this->request->get('jenis_kendaraan'));

        if ($jenis && $id) {
            $list = Kendaraan::with(['orderItems'])
                ->where('_id', $id)
                ->where('jenis_kendaraan', $jenis)
                ->paginate();
        } elseif ($id) {
            $list = Kendaraan::with(['orderItems'])
                ->where('_id', $id)
                ->paginate();
        } elseif ($jenis) {
            $list = Kendaraan::with(['orderItems'])
                ->where('jenis_kendaraan', $jenis)
                ->paginate();
        } else {
            $list = Kendaraan::with(['orderItems'])->paginate();
        }

        return SalesKendaraanResource::collection($list);
    }

    /**
     * collect sales data
     */
    public function sales()
    {
        $startDate = $this->request->get('start_date');
        $endDate = $this->request->get('end_date') ?? Carbon::now()->format('Y-m-d');
        $sortBy = $this->request->get('sort_by') ?? 'tgl_transaksi';
        $sort = $this->request->get('sort') ?? 'asc';

        $sortBy = strtolower($sortBy);
        $sort = strtolower($sort);

        if ($startDate) {
            $list = Order::with(['orderItems'])
                ->where('tgl_transaksi', '>', $startDate)
                ->where('tgl_transaksi', '<=', $endDate)
                ->orderBy($sortBy, $sort)
                ->paginate();
        } else {
            $list = Order::with(['orderItems'])
                ->where('tgl_transaksi', '<=', $endDate)
                ->orderBy($sortBy, $sort)
                ->paginate();
        }

        return SalesResource::collection($list);
    }
}
