<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $fillable = [
        "id",
        "order_id",
        "bundle_id",
        "price",
        "original_price",
        "discount",
        "promocode_id",
        "plan_id",
    ];

    public function bundle()
    {
        return $this->belongsTo(ProductBundle::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
