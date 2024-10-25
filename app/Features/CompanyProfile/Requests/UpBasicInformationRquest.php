<?php

namespace App\Features\CompanyProfile\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpBasicInformationRquest extends FormRequest
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
            'logo'           => ['nullable','image'],
            'phone_number'   => ['nullable','string','max:20'],
            'mobile_number'  => ['nullable','string','max:20'],
            'whatsapp'       => ['nullable','url','max:255'],
            'facebook'       => ['nullable','url','max:255'],
            'instagram'      => ['nullable','url','max:255'],
            'x'              => ['nullable','url','max:255'], // X (formerly Twitter)
            'tiktok'         => ['nullable','url','max:255'],
            'snapchat'       => ['nullable','url','max:255'],
            'linkedin'       => ['nullable','url','max:255'],
            'website'        => ['nullable','url','max:255'],
            'email_address'  => ['nullable','email','max:255'],
            'address'        => ['nullable','string'],
            'about_us'        => ['nullable','string'],
        ];
    }
}
