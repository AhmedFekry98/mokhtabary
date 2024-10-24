<?php

namespace App\Features\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpClientRequest extends FormRequest
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
            'name'        => ['nullable','string'],
            'country'     => ['nullable','string'],
            'city'        => ['nullable','string'],
            'street'      => ['nullable','string'],
            'state'       => ['nullable','string'],
            'post_code'   => ['nullable','string'],
            'img'         => ['nullable','image']
        ];
    }
}
