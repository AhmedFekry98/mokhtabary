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

        return array_merge([
            // radiology details
                   "radiology_info" => [
                       'radiology_id'      => $this->radiology_id,
                       'name'              => $this->radiology->radiologyDetail->name,
                       'country_ifo'       => $this->radiology->radiologyDetail->country()->first(['id','name_ar','name_en']),
                       'governorate'       => $this->radiology->radiologyDetail->governorate()->first(['id','name_ar','name_en']),
                       'city'              => $this->radiology->radiologyDetail->city()->first(['id','name_ar','name_en']),
                       'street'            => $this->radiology->radiologyDetail->street,
                       'description'       => $this->radiology->radiologyDetail->description,
                   ],
               // xray details
                   "xray_info" => [
                       'xray_id'           => $this->xray_id,
                       'num_code'          => $this->xray->num_code,
                       'code'              => $this->xray->code,
                       'name_en'           => $this->xray->name_en,
                       'name_ar'           => $this->xray->name_ar,
                   ],

                   'id'                     => $this->id,
                   'contract_price'         => $this->contract_price,
                   'before_price'           => $this->before_price,
                   'after_price'            => $this->after_price,
                   'offer_price'            => $this->offer_price,
                   'created_at'             => $this->created_at,
                   'updated_at'             => $this->updated_at,
               ]);
    }

}
