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
     // lab details
            "lab_info" => [
                'lab_id'            => $this->lab_id,
                'name'              => $this->lab->labDetail->name,
                'country_ifo'       => $this->lab->labDetail->country()->first(['id','name_ar','name_en']),
                'governorate'       => $this->lab->labDetail->governorate()->first(['id','name_ar','name_en']),
                'city'              => $this->lab->labDetail->city()->first(['id','name_ar','name_en']),
                'street'            => $this->lab->labDetail->street,
                'description'       => $this->lab->labDetail->description,
            ],
        // test details
            "test_info" => [
                'test_id'           => $this->test_id,
                'num_code'          => $this->test->num_code,
                'code'              => $this->test->code,
                'name_en'           => $this->test->name_en,
                'name_ar'           => $this->test->name_ar,
            ],

            'id'                     => $this->id,
            'contract_price'         => $this->contract_price,
            'before_price'           => $this->before_price,
            'after_price'            => $this->after_price,
            'offer_price'            => $this->offer_price,
            'created_at'             => $this->created_at,
            'updated_at'             => $this->updated_at,
        ]);

    }
}





