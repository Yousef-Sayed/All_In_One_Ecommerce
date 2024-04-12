<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'shipping_name',
        'shipping_address',
        'phone',
        'product_id',
        'prodect_price',
        'quantity',
        'order_total',
        'note',
        'order_status',
        'shipping_value',
        'order_code',
    ];
}
