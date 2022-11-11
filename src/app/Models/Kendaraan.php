<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $collection = "kendaraans";

    protected $fillable = [
        'tahun_keluaran', 'warna', 'harga', 'jenis_kendaraan', 'nama_kendaraan', 'spesifikasi', 'stok'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'id_kendaraan', '_id');
    }
}
