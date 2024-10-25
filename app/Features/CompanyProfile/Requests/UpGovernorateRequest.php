<?php

namespace App\Features\CompanyProfile\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpGovernorateRequest extends FormRequest
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
            // 'country_id' => ['required','integer','exists:countries,id'], //can't make update for country
            'name_ar'    => ['nullable','string','max:50'],
            'name_en'    => ['nullable','string','max:50'],
        ];
    }
}
