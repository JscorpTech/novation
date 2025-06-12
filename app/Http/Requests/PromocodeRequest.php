<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromocodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'string',
            'discount' => 'integer',
            'quantity' => 'integer',
            'exp' => 'date',
        ];
    }
}
