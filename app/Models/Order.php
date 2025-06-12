<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
        "id",
        "user_id",
        "status",
        "price",
        "original_price",
        "discount",
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
