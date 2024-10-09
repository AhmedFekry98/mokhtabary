<?php

namespace App\Features\CompanyProfile\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BasicInformationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        $data =  parent::toArray($request);
    
        $data['logo'] = $this->getFirstMediaUrl('logo') ?? null;

        return $data;
    }
}
