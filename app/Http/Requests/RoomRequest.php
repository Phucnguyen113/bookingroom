<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomRequest extends FormRequest
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
                'name' => ['required', 'string', 'max:255', Rule::unique('rooms', 'name')->ignore($this->room)],
                'price' => 'required|integer',
                'address' => 'required|string',
                'description' => 'required|string',
                'images' => 'nullable|array|max:5',
                'images.*' => 'required|image',
                'thumbnail' => 'nullable|image',
            ];
        }
        return [
            'name' => 'required|string|max:255,unique:rooms,name',
            'price' => 'required|integer',
            'address' => 'required|string',
            'description' => 'required|string',
            'images' => 'required|array|max:5',
            'images.*' => 'required|image',
            'thumbnail' => 'required|image',
        ];
    }
}
