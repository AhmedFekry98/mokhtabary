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
            'id'            => $this->id ?? null,
            'lab_detail_id' => $this->radiologyDetail->id ?? null,
            'email'         => $this->email ?? null,
            'phone'         => $this->phone?? null,
            'name'          => $this->radiologyDetail->name?? null,
            'country'       => $this->radiologyDetail->country?? null,
            'city'          => $this->radiologyDetail->city?? null,
            'state'         => $this->radiologyDetail->state?? null,
            'street'        => $this->radiologyDetail->street?? null,
            'post_code'     => $this->radiologyDetail->post_code?? null,
            'description'   => $this->radiologyDetail->description?? null,
            'img'           => $this->getFirstMediaUrl('users') ?: null,
            'branches'       => $this->radiologyDetail->children ?? null,
        ];
    }
}
