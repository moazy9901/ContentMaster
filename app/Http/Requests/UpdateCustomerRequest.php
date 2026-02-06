<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:customers,email,' . $this->customer?->id,
            'phone' => ['sometimes', 'unique:customers,phone,' . $this->customer?->id, 'regex:/^01[0-9]{9}$/'],
            'password' => 'sometimes|min:6',
            'gender' => 'nullable|in:male,female',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
