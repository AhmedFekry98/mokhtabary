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
            'id'            => $this->id ?? null,
            'radiology_detail_id' => $this->radiologyDetail->id ?? null,
            'email'         => $this->email ?? null,
            'phone'         => $this->phone?? null,
            'name'          => $this->radiologyDetail->name?? null,
            'country'       => $this->radiologyDetail->country?? null,
            'city'          => $this->radiologyDetail->city?? null,
            'state'         => $this->radiologyDetail->state?? null,
            'street'        => $this->radiologyDetail->street?? null,
            'post_code'     => $this->radiologyDetail->post_code?? null,
            'description'   => $this->radiologyDetail->description?? null,
            'img'           => optional(User::find($parent['radiology_id']))->getFirstMediaUrl('users') ?: null,
        ];
    }
}
