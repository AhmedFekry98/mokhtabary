<?php

namespace App\Features\Order\Requests;

use App\Features\Order\Models\PrescriptionOrder;
use Illuminate\Foundation\Http\FormRequest;

class StPrescriptionOrderRequest extends FormRequest
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
            // 'client_id', // coming from auth
            'receiver_id'    => ['nullable','integer'],
            'order_type'     =>['required','in:'. implode(',', PrescriptionOrder::$orderTypes)],
            'img'            => ['required','image'], // send prescription img
            'medicals'       => ['required','array'],
            'medicals.*.medicalable_id'     => ['required','integer'] , // id test or xray model
        ];
    }
}
