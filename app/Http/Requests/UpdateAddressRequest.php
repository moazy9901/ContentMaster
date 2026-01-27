<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'details' => 'sometimes|string',
            'country' => 'sometimes|string',
            'city' => 'sometimes|string',
            'governorate' => 'sometimes|string',
            'flag' => 'sometimes|boolean',
        ];
    }
}
