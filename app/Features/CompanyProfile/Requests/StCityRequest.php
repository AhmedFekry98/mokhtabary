<?php

namespace App\Features\CompanyProfile\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StCityRequest extends FormRequest
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
            "governorate_id"    => ['required','integer','exists:governorates,id'],
            "name_ar"           => ['required','string'],
            "name_en"           => ['required','string'],
        ];
    }
}
