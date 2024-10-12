<?php

namespace App\Features\User\Requests;

use App\Features\User\Requests\Services\Validation\GuardContext;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
    public function rules()
    {
        // Get the guard from the request
        $guard = request('guard');
        // dd($guard);
        // Use GuardContext to dynamically get validation rules
        $guardContext = new GuardContext($guard);

        // Return the validation rules
        return $guardContext->getRules();
    }
}
