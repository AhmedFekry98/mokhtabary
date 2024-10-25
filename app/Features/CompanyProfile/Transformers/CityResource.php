<?php

namespace App\Features\CompanyProfile\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
        "id"              => $this->id,
        "governorate"     => $this->governorate()->first(['id','name_en','name_ar']),
        "name_ar"         => $this->name_ar,
        "name_en"         => $this->name_en,
        "updated_at"      => $this->updated_at,
        "created_at"      => $this->created_at,
      ];
    }
}
