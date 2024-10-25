<?php

namespace App\Features\Lab\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpLabRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name"              => ['nullable','string'],
            'country_id'        => ['nullable','integer','exists:countries,id'],
            'city_id'           => ['nullable','integer','exists:cities,id'],
            'governorate_id'    => ['nullable','integer','exists:governorates,id'],
            "street"            => ['nullable','string'],
            "img"               => ['nullable','image'],
            "description"       => ['nullable','string'],
        ];
    }
}
