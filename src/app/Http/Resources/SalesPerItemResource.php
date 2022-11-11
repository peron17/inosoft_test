<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesPerItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $qty = $this->orderItems->sum('qty');
        return [
            'id' => $this->id,
            'nama_kendaraan' => $this->nama_kendaraan,
            'jenis_kendaraan' => $this->jenis_kendaraan,
            'harga' => $this->harga,
            'terjual' => $qty,
            'total_harga' => $this->harga * $qty
        ];
    }
}
