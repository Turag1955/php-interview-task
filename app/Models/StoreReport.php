<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Model;

class StoreReport extends Model
{
    protected $fillable = [
        'name',
        'user_phone',
        'order_no',
        'product_code',
        'product_name',
        'product_price',
        'purchase_quantity',
        'created_at',
    ];


}
