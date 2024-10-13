<?php

namespace App\Features\Lab\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'test_id' => $this->id,
            'test_name_en' => $this->name_en,
            'test_name_ar' => $this->name_ar,
            'num_code' => $this->num_code,
            'contract_price' => $this->whenLoaded('labTest')->contract_price ?? null,
            'before_price' => $this->whenLoaded('labTest')->before_price ?? null,
            'after_price' => $this->whenLoaded('labTest')->after_price ?? null,
            'offer_price' => $this->whenLoaded('labTest')->offer_price ?? null,
        ];
    }
}
