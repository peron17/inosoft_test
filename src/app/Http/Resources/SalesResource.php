<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
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
            'tgl_transaksi' => $this->tgl_transaksi,
            'nama_pelanggan' => $this->nama_pelanggan,
            'total_harga' => $this->total_harga,
            'item' => OrderItemResource::collection($this->orderItems)
        ];
    }
}
