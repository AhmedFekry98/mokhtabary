<?php

namespace App\Features\Client\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id'                => $this->id,    // module user
            'email'             => $this->email, // module user
            'phone'             => $this->phone, // module user
            'name'              => $this->clientDetail->name, // model user function clientDetail
            'country_info'      => $this->clientDetail->country()->first(['id','name_ar','name_en']), // model user function clientDetail
            'city_info'         => $this->clientDetail->city()->first(['id','name_ar','name_en']), // model user function clientDetail
            'governorate_info'  => $this->clientDetail->governorate()->first(['id','name_ar','name_en']), // model user function clientDetail
            'street'            => $this->clientDetail->street, // model user function clientDetail
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'phone_verified_at' =>  $this->phone_verified_at,
            'role'              => $this->role->name,
            'img'               => $this->getFirstMediaUrl('users') ?: null,
        ];
    }
}
