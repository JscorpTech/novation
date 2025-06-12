<?php

namespace App\Http\Resources;

use App\Enums\SubscribeStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /**
         * @var User $user
         */
        $user = Auth::guard("sanctum")->user();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'free_trial' => $this->free_trial,
            'duration' => $this->duration,
            'discount' => $this->discount,
            "is_subscribe" => $user ? $user->subscribe()->where(['plan_id' => $this->id, 'status' => SubscribeStatusEnum::ACTIVE])->exists() : false
        ];
    }
}
