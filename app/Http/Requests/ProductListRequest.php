<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ProductListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'properties' => ['required', 'array'],
        ];
    }
}
