<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesKendaraanItemResource extends JsonResource
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
            'qty' => $this->qty,
            'harga' => $this->harga,
            'total_harga' => $this->total_harga,
            'order' => new OrderResource($this->order)
        ];
    }
}
