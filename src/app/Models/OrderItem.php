<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $collection = "order_items";

    protected $fillable = [
        'id_order', 'id_kendaraan', 'harga', 'qty', 'total_harga'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', '_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', '_id');
    }
}
