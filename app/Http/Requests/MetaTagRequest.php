<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MetaTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return $this->user()->isAdmin();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->_method === 'PUT') {
            return [
                'name' => 'required|string|max:255|unique:meta_tags,name',
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('meta_tags', 'name')->ignore($this->route('tag')),
                ],
                'content' => 'nullable|string',
            ];
        } else {
            return [
                'name' => 'required|string|max:255|unique:meta_tags,name',
                'content' => 'nullable|string',
            ];
        }
        
    }
}
