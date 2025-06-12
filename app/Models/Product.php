<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = [
        "image",
        'name',
        'description',
        'price'
    ];
}
