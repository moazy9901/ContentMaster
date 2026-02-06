<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $customerId = auth('api')->id();

        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:customers,email,' . $customerId,
            'phone' => [
                'sometimes',
                'regex:/^01[0-9]{9}$/',
                'unique:customers,phone,' . $customerId
            ],
            'password' => 'sometimes|min:6',
            'gender' => 'nullable|in:male,female',
        ];
    }
}
