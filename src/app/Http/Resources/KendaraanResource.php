<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KendaraanResource extends JsonResource
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
            'id' => $this->id,
            'nama_kendaraan' => $this->nama_kendaraan,
            'jenis_kendaraan' => $this->jenis_kendaraan,
            'tahun_keluaran' => $this->tahun_keluaran,
            'spesifikasi' => json_decode($this->spesifikasi)
        ];
    }
}
