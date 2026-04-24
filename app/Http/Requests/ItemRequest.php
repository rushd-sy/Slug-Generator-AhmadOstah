<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'title' => 'sometimes|string|max:255',
        'price' => 'sometimes|numeric|min:0',
        'stock_flag' => 'sometimes|boolean',
        'image' => 'nullable|url',
        'description' => 'nullable|string',
        ];
    }
}
