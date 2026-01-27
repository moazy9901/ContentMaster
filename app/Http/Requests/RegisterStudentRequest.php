<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $this->student?->id,
            'phone' => ['required','unique:students,phone,' . $this->student?->id,'regex:/^01[0-9]{9}$/'],
            'password' => 'required|min:6',
            'gender' => 'nullable|in:male,female',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
