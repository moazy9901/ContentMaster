<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'email' => ['sometimes', 'email', Rule::unique('customers', 'email')->ignore($this->customer->id)],
            'phone' => ['sometimes', Rule::unique('customers', 'phone')->ignore($this->customer->id), 'regex:/^01[0125][0-9]{8}$/'],
            'password' => 'sometimes|min:6',
            'gender' => 'nullable|in:male,female',
        ];
    }
}
