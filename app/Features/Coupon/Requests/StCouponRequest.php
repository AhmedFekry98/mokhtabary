<?php

namespace App\Features\Coupon\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StCouponRequest extends FormRequest
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
            'code' => ['required','string','max:255'],
            'discount_percentage' => ['required','numeric','min:0','max:1000'],
            'expiration_date' => ['required','date'],
        ];
    }
}
