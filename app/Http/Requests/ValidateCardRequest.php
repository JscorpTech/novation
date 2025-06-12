<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "card_id" => ['required', "exists:cards,id"],
            "code" => ['required', "min:4", "max:4"],
        ];
    }
}
