<?php

namespace App\Features\Order\Requests;

use App\Features\Order\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class StOrderRequest extends FormRequest
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
            'patient_name'         => ['required','string'], //
            'coupon_id'            => ['nullable','exists:coupons,id', 'integer'],
            'receiver_id'          => ['required','exists:users,id','integer'], // id user
            'branch_id'            => ['required','exists:users,id','integer'], // id user
            'order_type'           => ['required','in:'. implode(',', Order::$orderTypes)],
            'visit'                => ['required','boolean'],
            'delivery'             => ['required','boolean'],

            'order_info'           => ['array', 'required'],  // to send LabTest ids or RadiologyXray ids
            'order_info.*.id'      => ['required','integer']

        ];
    }
}
