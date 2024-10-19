<?php


namespace App\Features\User\Requests\Services\Validation\Guards;

use App\Features\User\Requests\Services\Validation\Contracts\GuardValidationStrategy;

class ClientValidation implements GuardValidationStrategy
{
    public function rules(): array
    {
        return [
            // 'client_id'      => ['required', 'integer'], comming from relation users
            'email'          => ['required', 'email','unique:users,email'],
            'phone'          => ['required', 'string','unique:users,phone'],
            'password'       => ['required', 'string', 'min:6'],
            'name'           => ['required', 'string'],
            'country'        => ['required', 'string'],
            'city'           => ['required', 'string'],
            'state'          => ['required', 'string'],
            'street'         => ['nullable', 'string'],
            'post_code'      => ['nullable', 'string'],
            'imag'           => ['nullable','image']
        ];
    }
}
