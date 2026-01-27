<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
       $studentId = auth('api')->id();

        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:students,email,' . $studentId,
            'phone' => [
                'sometimes',
                'regex:/^01[0-9]{9}$/',
                'unique:students,phone,' . $studentId
            ],
            'password' => 'sometimes|min:6',
            'gender' => 'nullable|in:male,female',
        ];
    }
}
