<?php

namespace App\Features\Lab\Transformers;

use App\Features\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabBranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $parent = $this->labDetail->parent;
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
            'img'           => optional(User::find($parent['lab_id']))->getFirstMediaUrl('users') ?: null,
        ];
    }
}
