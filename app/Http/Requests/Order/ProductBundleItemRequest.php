<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class ProductBundleItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "product_id" => ["required", "exists:products,id"],
            "count" => ['required', "min:1", "integer"],
        ];
    }
}
