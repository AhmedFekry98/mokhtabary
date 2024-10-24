<?php

namespace App\Features\Client\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'email'         => $this->email ?? null,
            'phone'         => $this->phone ?? null,
            'name'          => $this->clientDetail->name ?? null,
            'country'       => $this->clientDetail->country ?? null,
            'city'          => $this->clientDetail->city ?? null,
            'state'         => $this->clientDetail->state ?? null,
            'street'        => $this->clientDetail->street ?? null,
            'post_code'     => $this->clientDetail->post_code ?? null,
            'img'           => optional($this->resource)->getFirstMediaUrl('users') ?? null,
            'family'        => $this->familyDetail ?? null,
        ];
    }
}
