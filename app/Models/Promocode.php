<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    public $fillable = [
        "id",
        "code",
        "discount",
        "quantity",
        "exp",
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, "user_promocodes", "promocode_id", "user_id");
    }
}
