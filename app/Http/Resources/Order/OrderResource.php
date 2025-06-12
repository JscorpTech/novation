<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "items" => OrderItemResource::collection($this->items),
            "price" => $this->price,
            "original_price" => $this->original_price,
            "status" => $this->status,
        ];
    }
}
