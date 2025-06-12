<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            'card_number' => substr($this->card_number, 0, 4) . "********" . substr($this->card_number, -4),
            'card_exp' => $this->card_exp,
            // 'card_token' => $this->card_token,
            // 'user_id' => $this->user_id,
            'status' => $this->status,
        ];
    }
}
