<?php

namespace App\Features\Radiology\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StxRayRequest extends FormRequest
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
            'num_code'      => ['required','integer','unique:x_rays,num_code'],
            'code'          => ['required','string' ,'unique:x_rays,code'],
            'name_en'       => ['required','string'],
            'name_ar'       => ['required','string'],
        ];
    }
}
