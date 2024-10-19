<?php

namespace App\Features\Lab\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabResource extends JsonResource
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
            'lab_detail_id' => $this->labDetail->id ?? null,
            'email'         => $this->email ?? null,
            'phone'         => $this->phone?? null,
            'name'          => $this->labDetail->name?? null,
            'country'       => $this->labDetail->country?? null,
            'city'          => $this->labDetail->city?? null,
            'state'         => $this->labDetail->state?? null,
            'street'        => $this->labDetail->street?? null,
            'post_code'     => $this->labDetail->post_code?? null,
            'description'   => $this->labDetail->description?? null,
            'img'           => $this->getFirstMediaUrl('users') ?: null,
            'branches'       => $this->labDetail->children ?? null,
        ];
    }
}
