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

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = date('d-m-y H:i:s',strtotime($value));
    }
}
