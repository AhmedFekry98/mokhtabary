<?php

namespace App\Features\Radiology\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UOCRadiologyxRayRequest extends FormRequest
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
            'x_ray_id'          =>['required','integer','exists:x_rays,id'],
            'radiology_id'      =>['required','integer','exists:users,id'],
            'contract_price'    =>['required','numeric'],
            'before_price'      =>['required','numeric'],
            'after_price'       =>['required','numeric'],  
            'offer_price'       =>['required','numeric'],
        ];
    }
}
