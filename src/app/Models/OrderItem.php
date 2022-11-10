<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $collection = "order_items";
}
