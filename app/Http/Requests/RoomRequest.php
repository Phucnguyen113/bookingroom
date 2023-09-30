<?php

namespace App\Http\Requests;

use App\Enums\TypeCategory;
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
                'province' => 'required|string',
                'district' => 'required|string',
                'address' => 'required|string',
                'description' => 'required|string',
                'images' => 'nullable|array|max:5',
                'images.*' => 'required|image',
                'thumbnail' => 'nullable|image',
                'unit' => 'required|string|in:day,month,year',
                'start_date' => 'required|date|date_format:Y-m-d',
                'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
                'bedroom' => 'required|integer|min:1',
                'bathroom' => 'required|integer|min:1',
                'acreage' => 'required|integer|min:1',
                'outdoor_facilities' => 'required|array',
                'general_amenities' => 'required|array',
                'outdoor_facilities.*' => 'required|string',
                'general_amenities.*' => 'required|string',
                'category' => 'required|array',
                'category.*' => [
                    'required',
                    'integer',
                    Rule::exists('categories', 'id')->where('type', TypeCategory::Room),
                ],
            ];
        }

        return [
            'name' => 'required|string|max:255,unique:rooms,name',
            'price' => 'required|integer',
            'province' => 'required|string',
            'district' => 'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'images' => 'required|array|max:5',
            'images.*' => 'required|image',
            'thumbnail' => 'required|image',
            'unit' => 'required|string|in:day,month,year',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
            'bedroom' => 'required|integer|min:1',
            'bathroom' => 'required|integer|min:1',
            'acreage' => 'required|integer|min:1',
            'outdoor_facilities' => 'required|array',
            'general_amenities' => 'required|array',
            'outdoor_facilities.*' => 'required|string',
            'general_amenities.*' => 'required|string',
            'category' => 'required|array',
            'category.*' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')->where('type', TypeCategory::Room),
            ],
        ];
    }
}
