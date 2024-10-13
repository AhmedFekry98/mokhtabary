<?php

namespace App\Features\Lab\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpTestRequest extends FormRequest
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
            'num_code'      => ['nullable','integer','unique:tests,num_code'],
            'code'          => ['nullable','string','unique:tests,code'],
            'name_en'       => ['nullable','string'],
            'name_ar'       => ['nullable','string'],
        ];
    }
}
