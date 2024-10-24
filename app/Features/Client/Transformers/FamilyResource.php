<?php

namespace App\Features\Client\Transformers;

use App\Features\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyResource extends JsonResource
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
            'name'          => $this->name ?? null,
            'country'       => $this->country ?? null,
            'city'          => $this->city ?? null,
            'state'         => $this->state ?? null,
            'street'        => $this->street ?? null,
            'post_code'     => $this->post_code ?? null,
            'img'           => optional(User::find($this->client_id ?? null))->getFirstMediaUrl('users') ?? null,
        ];
    }
}
