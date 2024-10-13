<?php

namespace App\Features\Lab\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UOCLabTestRequest extends FormRequest
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
            'test_id'           =>['required','integer','exists:tests,id'],
            'lab_id'            =>['required','integer','exists:users,id'],
            'contract_price'    =>['required','numeric'],
            'before_price'      =>['required','numeric'],
            'after_price'       =>['required','numeric'],  
            'offer_price'       =>['required','numeric'],
        ];
    }
}
