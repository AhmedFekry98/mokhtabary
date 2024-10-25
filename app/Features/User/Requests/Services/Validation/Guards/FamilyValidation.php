<?php


namespace App\Features\User\Requests\Services\Validation\Guards;

use App\Features\User\Requests\Services\Validation\Contracts\GuardValidationStrategy;

class FamilyValidation implements GuardValidationStrategy
{
    public function rules(): array
    {
        return [
            // 'client_id'      => ['required', 'integer'], comming from auth
            'email'          => ['required', 'email','unique:family_details,email'],
            'phone'          => ['required', 'string','unique:family_details,phone'],
            'name'           => ['required', 'string'],

            'country_id'        => ['required', 'integer','exists:countries,id'],
            'city_id'           => ['required', 'integer','exists:cities,id'],
            'governorate_id'    => ['required', 'integer','exists:governorates,id'],

            'street'         => ['nullable', 'string'],
            'img'           => ['nullable','image']
        ];
    }
}
