<?php

namespace App\Features\Packages\Requests;

use App\Features\Packages\Models\Package;
use Illuminate\Foundation\Http\FormRequest;

class StPackageRequest extends FormRequest
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
            'name'          => ['required','string'],
            'package_type'  => ['required','in:'. implode(',', Package::$packageType)],
            'package'       => ['array' , 'required'],
            'package.*.packageable_id' => ['required','integer'],
        ];
    }
}
