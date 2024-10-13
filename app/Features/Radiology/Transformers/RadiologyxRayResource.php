<?php

namespace App\Features\Radiology\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RadiologyxRayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return  $request->toArray();
        // dd($request);
        return array_merge([

            'id'                => $this->id,
            'contract_price'    => $this->id,
            'before_price'      => $this->id,
            'after_price'       => $this->id,
            'offer_price'       => $this->id,
            // xray details
            'x_ray_id'          => $this->x_ray_id,
            'num_code'          => $this->xRay->num_code,
            'code'              => $this->xRay->code,
            'name_en'           => $this->xRay->name_en,
            'name_ar'           => $this->xRay->name_ar,
            // rediology details
            'radiology_id'      => $this->radiology_id ?? null,
            'name'              => $this->radiology->radiologyDetail->name,
            'country'           => $this->radiology->radiologyDetail->country,
            'city'              => $this->radiology->radiologyDetail->city,
            'state'             => $this->radiology->radiologyDetail->state,
            'street'            => $this->radiology->radiologyDetail->street,
            'post_code'         => $this->radiology->radiologyDetail->post_code,
            'description'       => $this->radiology->radiologyDetail->description,

            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,

        ]);
    }
}
