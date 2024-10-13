<?php

namespace App\Features\Radiology\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class XRayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'xray_id' => $this->id,
            'xray_name_en' => $this->name_en,
            'xray_name_ar' => $this->name_ar,
            'num_code' => $this->num_code,
            'contract_price' => $this->whenLoaded('radiologyxRay')->contract_price ?? null,
            'before_price' => $this->whenLoaded('radiologyxRay')->before_price ?? null,
            'after_price' => $this->whenLoaded('radiologyxRay')->after_price ?? null,
            'offer_price' => $this->whenLoaded('radiologyxRay')->offer_price ?? null,
        ];
    }
}
