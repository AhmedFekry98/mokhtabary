<?php


namespace App\Features\User\Requests\Services\Validation\Contracts;


interface GuardValidationStrategy
{
    public function rules(): array;
}