<?php

namespace App\Features\Lab\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabTestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge([

            'id'  => $this->id,
            'contract_price'    => $this->id,
            'before_price'      => $this->id,
            'after_price'       => $this->id,
            'offer_price'       => $this->id,
            // test details
            'test_id'           => $this->test_id,
            'num_code'          => $this->test->num_code,
            'code'              => $this->test->code,
            'name_en'           => $this->test->name_en,
            'name_ar'           => $this->test->name_ar,
            // lab details
            'lab_id'            => $this->lab_id,
            'name'              => $this->lab->labDetail->name,
            'country'           => $this->lab->labDetail->country,
            'city'              => $this->lab->labDetail->city,
            'state'             => $this->lab->labDetail->state,
            'street'            => $this->lab->labDetail->street,
            'post_code'         => $this->lab->labDetail->post_code,
            'description'       => $this->lab->labDetail->description,

            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,

        ]);
    }
}





