<?php

namespace App\Http\Resources;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesKendaraanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'kendaraan' => new KendaraanResource($this),
            'sales' => SalesKendaraanItemResource::collection($this->orderItems)
            // 'sales' => Order::select(['_id', 'tgl_transaksi', 'nama_pelanggan'])->whereIn('_id', $orderItem)->get()
        ];
    }
}
