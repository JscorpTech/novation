<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBundle extends Model
{
    public $table = "bundles";
    public $fillable = [
        "id",
        "user_id",
    ];

    public function items(){
        return $this->hasMany(ProductBundleItem::class, "bundle_id", "id");
    }
}
