<?php

namespace App\Features\Radiology\Transformers;

use App\Features\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RadiologyBranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $parent = $this->radiologyDetail->parent;
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
            'img'               => optional(User::find($parent['radiology_id']))->getFirstMediaUrl('users') ?: null,
        ];
    }

}
