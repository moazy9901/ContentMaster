<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:students,email,' . $this->student?->id,
            'phone' => ['sometimes','unique:students,phone,' . $this->student?->id,'regex:/^01[0-9]{9}$/'],
            'password' => 'sometimes|min:6',
            'gender' => 'nullable|in:male,female',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
