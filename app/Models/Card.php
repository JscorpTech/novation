<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public $fillable = [
        "card_number",
        "card_exp",
        "card_token",
        "user_id",
        "status",
    ];
}
