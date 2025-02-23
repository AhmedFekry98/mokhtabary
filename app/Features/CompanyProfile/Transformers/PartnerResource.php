<?php

namespace App\Features\CompanyProfile\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'partner'    => $this->partner,
            'img'     => $this->getFirstMediaUrl('partner'),
        ];
    }
}
