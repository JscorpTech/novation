<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "products" => ["required", "array", "min:1"],
            "products.*.id" => ["required", "exists:products,id"],
            "products.*.count" => ['required', "min:1", "integer"],
            "promocode" => ['nullable', 'string'],
            "plan_id" => ['exists:plans,id'],
        ];
    }
}
