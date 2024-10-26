<?php

namespace App\Features\Coupon\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data['is_active'] = $data['is_active'] == true ? 'Active' : 'In Active';
        return $data;
    }
}
