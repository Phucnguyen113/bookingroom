<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('users', 'name')->ignore($this->user),
                ],
                'role' => 'required|integer|in:' . implode(',', UserRole::getValues()),
            ];
        }

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'name'),
            ],
            'role' => 'required|integer|in:' . implode(',', UserRole::getValues()),
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
        ];
    }
}
