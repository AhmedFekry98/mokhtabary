<?php

namespace App\Features\Order\Requests;

use App\Features\Order\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class UpOrderRequest extends FormRequest
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
            // 'client_id',  // comming from auth
            // 'family_detail_id'     =>['nullable','integer','exists:family_details,id'], can't make update to add family id
            'order_type'           =>['nullable','in:'. implode(',', Order::$orderTypes)], // can't make update for order type
            'visit'                =>['nullable','boolean'],
            'delivery'             =>['nullable','boolean'],

            'order_info'           => ['array', 'nullable'],  // to send LabTest ids or RadiologyXray ids
            'order_info.*.id'      => ['required','integer']

        ];
    }
}
