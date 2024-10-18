<?php

namespace App\Features\Offers\Requests;

use App\Features\Offers\Models\Offer;
use Illuminate\Foundation\Http\FormRequest;

class StOfferRequest extends FormRequest
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
            'name'                  => ['required','string'],
            'offer_type'            => ['required','in:'. implode(',', Offer::$OfferType)],
            'offer'                 => ['array' , 'required'],
            'offer.*.offerable_id'  => ['required','integer'],
        ];
    }
}
