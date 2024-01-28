<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|numeric|digits:10',
            'room_id' => 'nullable|integer|exists:rooms,id',
            'room_type' => 'nullable|integer|between:0,4',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|gt:min_price',
            'location' => 'nullable|string',
            'bedroom' => 'nullable|integer|min:1',
            'bathroom' => 'nullable|integer|min:1',
        ];
    }
}
