<?php


namespace App\Features\User\Requests\Services\Validation\Guards;

use App\Features\User\Requests\Services\Validation\Contracts\GuardValidationStrategy;

class RadiologyValidation implements GuardValidationStrategy
{
    protected string $guard;

    public function __construct(string $guard)
    {
        $this->guard = $guard; // Store the guard type information
    }

    public function rules(): array
    {
        $rules = [
            // 'radiology_id'          => ['required', 'integer'],
            'parent_id'         => ['nullable', 'integer','exists:users,id'],
            'description'           => ['nullable', 'string'],
            'email'                 => ['required', 'email','unique:users,email'],
            'phone'                 => ['required', 'string','unique:users,phone'],
            'password'              => ['required', 'string', 'min:6'],
            'name'                  => ['required', 'string'],
            'country'               => ['required', 'string'],
            'city'                  => ['required', 'string'],
            'state'                 => ['required', 'string'],
            'street'                => ['nullable', 'string'],
            'post_code'             => ['nullable', 'string'],
        ];

        // Add parent_id rule if the guard is 'radiologyBranch'
        if ($this->guard == "radiologyBranch") {
            $rules['parent_id'] = ['required', 'integer', 'exists:users,id'];
        } else {
            // Make parent_id nullable for 'lab' guard
            $rules['parent_id'] = ['nullable', 'integer', 'exists:users,id'];
        }

        return $rules;
    }
}