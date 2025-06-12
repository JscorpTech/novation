<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        "description",
        "free_trial",
        'duration',
        "discount",
    ];

    public $casts = [
        "price" => ['float'],
    ];
}
