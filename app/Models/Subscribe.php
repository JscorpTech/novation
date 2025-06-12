<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    public $fillable = [
        "id",
        "plan_id",
        "user_id",
        "status",
        "quantity",
        "card_id",
        "payment_status",
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
