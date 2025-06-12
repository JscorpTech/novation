<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['string', "required"],
            'plan_id' => ['integer', "required", "exists:plans,id"],
            'card_id' => ['integer', "required", "exists:cards,id"],
        ];
    }
}
