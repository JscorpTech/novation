<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\PlanResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /**
         * @var \App\Models\Cart $this
         */

        return [
            "id" => $this->id,
            "price" => $this->price,
            "discount" => $this->discount,
            "original_price" => $this->original_price,
            "plan" => PlanResource::make($this->plan),
            "promocode" => $this->promocode?->code,
            "bundle" => ProductBundleResource::make($this->bundle),
        ];
    }
}
