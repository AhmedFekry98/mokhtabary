<?php

namespace App\Features\Lab\Transformers;

use App\Features\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabBranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $parent = $this->labDetail->parent;
        return [
            'id'                => $this->id,    // module user
            'email'             => $this->email, // module user
            'phone'             => $this->phone, // module user
            'name'              => $this->labDetail->name, // model user function labDetail
            'country_info'      => $this->labDetail->country()->first(['id','name_ar','name_en']), // model user function labDetail
            'city_info'         => $this->labDetail->city()->first(['id','name_ar','name_en']), // model user function labDetail
            'governorate_info'  => $this->labDetail->governorate()->first(['id','name_ar','name_en']), // model user function labDetail
            'street'            => $this->labDetail->street, // model user function labDetail
            'description'       => $this->labDetail->description, // model user function labDetail
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'phone_verified_at' => now(),
            'role'              => $this->role->name,
            'img'           => optional(User::find($parent['lab_id']))->getFirstMediaUrl('users') ?: null,
        ];
    }
}
