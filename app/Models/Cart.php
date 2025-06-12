<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $fillable = [
        'user_id',
        'bundle_id',
        "promocode_id",
        "plan_id",
        "discount",
        "original_price",
        "price",
    ];

    public function bundle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductBundle::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function promocode()
    {
        return $this->belongsTo(Promocode::class);
    }
}
