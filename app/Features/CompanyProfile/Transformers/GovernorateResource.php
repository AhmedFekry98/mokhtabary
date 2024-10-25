<?php

namespace App\Features\CompanyProfile\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GovernorateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        $data['country_info'] = $this->country()->first(['id','name_ar','name_en']);
        $data['city_info'] = $this->governorate()->get(['id','name_ar','name_en']);
        return  $data;
    }
}
