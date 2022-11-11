<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'kendaraan' => new KendaraanResource($this->kendaraan),
            'qty' => $this->qty,
            'harga' => $this->harga,
            'total_harga' => $this->total_harga
        ];
    }
}
