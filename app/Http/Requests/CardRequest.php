<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'card_number' => 'string',
            'card_exp' => 'string',
            'card_token' => 'string',
            'user_id' => 'integer',
            'status' => 'string',
        ];
    }
}
