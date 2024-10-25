<?php

namespace App\Features\Lab\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabResource extends JsonResource
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
            'img'               => $this->getFirstMediaUrl('users') ?: null,
            'branches'          => $this->labDetail->children->map(function ($branch){
                return [
                    "id"                 =>$branch->id,
                    "branch_id"          =>$branch->lab_id, // this id refrance id in model user  (id branch in table users)
                    "parent_id"          =>$branch->parent_id,
                    "name"               =>$branch->name,
                    'country_info'       => $branch->country()->first(['id','name_ar','name_en']), // model user function labDetail
                    'city_info'          => $branch->city()->first(['id','name_ar','name_en']), // model user function labDetail
                    'governorate_info'   => $branch->governorate()->first(['id','name_ar','name_en']), // model user function labDetail
                    "street"             =>$branch->street,
                    "description"        =>$branch->description,
                    "created_at"         =>$branch->created_at,
                    "updated_at"         =>$branch->updated_at,
                ];
            }) ?? null,
        ];

    }
}
