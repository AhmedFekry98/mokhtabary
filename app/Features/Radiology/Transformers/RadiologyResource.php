<?php

namespace App\Features\Radiology\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RadiologyResource extends JsonResource
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
            'name'              => $this->radiologyDetail->name, // model user function radiologyDetail
            'country_info'      => $this->radiologyDetail->country()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'city_info'         => $this->radiologyDetail->city()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'governorate_info'  => $this->radiologyDetail->governorate()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'street'            => $this->radiologyDetail->street, // model user function radiologyDetail
            'description'       => $this->radiologyDetail->description, // model user function radiologyDetail
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'phone_verified_at' => now(),
            'role'              => $this->role->name,
            'img'               => $this->getFirstMediaUrl('users') ?: null,
            'branches'          => $this->radiologyDetail->children->map(function ($branch){
                return [
                    "id"                 =>$branch->id,
                    "branch_id"          =>$branch->radiology_id, // this id refrance id in model user  (id branch in table users)
                    "parent_id"          =>$branch->parent_id,
                    "email"              => $branch->user->email ?? null, // Use the loaded user relationship
                    "phone"              => $branch->user->phone ?? null, // Use the loaded user relationship
                    "name"               =>$branch->name,
                    'country_info'       => $branch->country()->first(['id','name_ar','name_en']), // model user function radiologyDetail
                    'city_info'          => $branch->city()->first(['id','name_ar','name_en']), // model user function radiologyDetail
                    'governorate_info'   => $branch->governorate()->first(['id','name_ar','name_en']), // model user function radiologyDetail
                    "street"             =>$branch->street,
                    "description"        =>$branch->description,
                    "created_at"         =>$branch->created_at,
                    "updated_at"         =>$branch->updated_at,
                ];
            }) ?? null,
        ];

    }
}
