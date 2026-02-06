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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $this->customer?->id,
            'phone' => ['required', 'unique:customers,phone,' . $this->customer?->id, 'regex:/^01[0-9]{9}$/'],
            'password' => 'required|min:6',
            'gender' => 'nullable|in:male,female',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
