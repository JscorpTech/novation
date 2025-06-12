<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductBundleItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "product" => ProductResource::make($this->product),
            "count" => $this->count,
            "price" => $this->price,
        ];
    }
}
