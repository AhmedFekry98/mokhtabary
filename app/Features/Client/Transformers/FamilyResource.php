<?php

namespace App\Features\Client\Transformers;

use App\Features\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'name'              => $this->name,
            'country_info'      => $this->country()->first(['id','name_ar','name_en']),
            'city_info'         => $this->city()->first(['id','name_ar','name_en']),
            'governorate_info'  => $this->governorate()->first(['id','name_ar','name_en']),
            'street'            => $this->street,
            'img'               => $this->getFirstMediaUrl('users') ?? null,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
