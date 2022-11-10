<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
            'nama_kendaraan' => $this->nama_kendaraan,
            'jenis_kendaraan' => $this->jenis_kendaraan,
            'harga' => $this->harga,
            'stok' => $this->stok,
            'total_harga' => ($this->harga * $this->stok)
        ];
    }
}
