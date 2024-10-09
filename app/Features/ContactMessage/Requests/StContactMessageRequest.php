<?php

namespace App\Features\ContactMessage\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StContactMessageRequest extends FormRequest
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
            'name'              => ['required','string'],
            'email_address'     => ['required','email'],
            'phone'             => ['required','string'],
            'message'           => ['required','string'],
            'file'              => ['nullable','file' ,'mimes:png,jpg,pdf'],
        ];
    }
}
