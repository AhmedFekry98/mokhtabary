<?php


namespace App\Features\User\Requests\Services\Validation\Guards;

use App\Features\User\Requests\Services\Validation\Contracts\GuardValidationStrategy;

class ClientValidation implements GuardValidationStrategy
{
    public function rules(): array
    {
        return [
            // 'client_id'      => ['required', 'integer'], comming from relation users
            'email'             => ['required', 'email','unique:users,email'],
            'phone'             => ['required', 'string','unique:users,phone'],
            'password'          => ['required', 'string', 'min:6'],
            'name'              => ['required', 'string'],

            'country_id'        => ['required', 'integer','exists:countries,id'],
            'city_id'           => ['required', 'integer','exists:cities,id'],
            'governorate_id'    => ['required', 'integer','exists:governorates,id'],

            'street'            => ['nullable', 'string'],
            'img'              => ['nullable','image']
        ];
    }
}
