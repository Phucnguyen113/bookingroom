<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->method() === 'POST') {
            return [
                'name' => 'required|string|unique:categories,name'
            ];
        }

        return [
            'name' => [
                'required',
                'string',
                Rule::unique('categories', 'name')->ignore($this->route('category')),
            ],
        ];
        
    }
}
