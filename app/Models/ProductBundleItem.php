<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBundleItem extends Model
{
    public $fillable = [
        "id",
        "product_id",
        "count",
        "price",
        "bundle_id"
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
