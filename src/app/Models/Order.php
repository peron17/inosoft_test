<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $collection = "orders";

    protected $fillable = [
        'tgl_transaksi', 'nama_pelanggan', 'total_harga'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'id_order', '_id');
    }
}
