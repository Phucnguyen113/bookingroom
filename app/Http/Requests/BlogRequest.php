<?php

namespace App\Http\Requests;

use App\Enums\TypeCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
        if ($this->method() === 'PUT') {
            return [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'thumbnail' => 'nullable|image',
                'category' => 'required|array',
                'category.*' => [
                    'required',
                    'integer',
                    Rule::exists('categories', 'id')->where('type', TypeCategory::Blog),
                ],
                'tags' => 'required|array',
            ];
        }
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'required|image',
            'category' => 'required|array',
            'category.*' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')->where('type', TypeCategory::Blog),
            ],
            'tags' => 'required|array',
        ];
    }
}
