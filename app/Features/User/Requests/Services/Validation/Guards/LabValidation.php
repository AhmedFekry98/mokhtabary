<?php


namespace App\Features\User\Requests\Services\Validation\Guards;

use App\Features\User\Requests\Services\Validation\Contracts\GuardValidationStrategy;


class LabValidation implements GuardValidationStrategy
{
    protected string $guard;

    public function __construct(string $guard)
    {
        $this->guard = $guard; // Store the guard type information
    }

    public function rules(): array
    {

        $rules = [
            // 'lab_id'            => ['required', 'integer'],
            'description'       => ['nullable', 'string'],
            'email'             => ['required', 'email','unique:users,email'],
            'phone'             => ['required', 'string','unique:users,phone'],
            'password'          => ['required', 'string', 'min:6'],
            'name'              => ['required', 'string'],

            'country_id'        => ['required','integer','exists:countries,id'],
            'city_id'           => ['required','integer','exists:cities,id'],
            'governorate_id'    => ['required','integer','exists:governorates,id'],

            'street'            => ['nullable', 'string'],
            'img'              => ['nullable','image']
        ];

        // Add parent_id rule if the guard is 'labBranch'
        if ($this->guard == "labBranch") {
            $rules['parent_id'] = ['required', 'integer', 'exists:users,id'];
        } else {
            // Make parent_id nullable for 'lab' guard
            $rules['parent_id'] = ['nullable', 'integer'];
        }

        return $rules;
    }
}
