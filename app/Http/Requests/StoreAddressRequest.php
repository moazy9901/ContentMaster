<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'details' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'governorate' => 'required|string',
            'flag' => 'required|boolean',
        ];
    }
}
