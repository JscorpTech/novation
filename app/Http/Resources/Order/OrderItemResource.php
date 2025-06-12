<?php

namespace App\Http\Resources\Order;

use App\Models\ProductBundle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "price" => $this->price,
            "original_price" => $this->original_price,
            "discount" => $this->discount,
            "items" => ProductBundleItemResource::collection($this->bundle->items),
        ];
    }
}
