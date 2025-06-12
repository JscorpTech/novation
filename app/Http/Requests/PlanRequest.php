<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required",
            "price" => "required",
            "description" => "required",
            "free_trial" => "required",
            "duration" => "required",
            "discount" => "required",
        ];
    }
}
