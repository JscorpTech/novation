<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscribeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            'status' => $this->status,
            'plan' => PlanResource::make($this->plan),
            'card' => CardResource::make($this->card),
            'quantity' => $this->quantity,
        ];
    }
}
