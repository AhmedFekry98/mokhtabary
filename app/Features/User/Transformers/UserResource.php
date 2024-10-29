<?php

namespace App\Features\User\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {



        if($this->role->name == "admin"){
            return[
                'id'                => $this->id,    // module user
                'email'             => $this->email, // module user
                'phone'             => $this->phone, // module user
                'created_at'        => $this->created_at,
                'updated_at'        => $this->updated_at,
                'img'               => $this->getFirstMediaUrl('users') ?: null,
                'phone_verified_at' => now(),
                'role'              => $this->role->name,
            ];
        }
        if($this->role->name == "lab" || $this->role->name == "labBranch"){
            return[
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
                'img'               => $this->getFirstMediaUrl('users') ?: null,
                'phone_verified_at' => now(),
                'role'              => $this->role->name,
            ];
        }
        if($this->role->name == "radiology" || $this->role->name == "radiologyBranch"){
            return[
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
                'img'               => $this->getFirstMediaUrl('users') ?: null,
                'phone_verified_at' => now(),
                'role'              => $this->role->name,
            ];
        }

        if($this->role->name == "client"){
            return[
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
                'img'               => $this->getFirstMediaUrl('users') ?: null,
                'phone_verified_at' => $this->phone_verified_at,
                'role'              => $this->role->name,
            ];
        }

    }
}
