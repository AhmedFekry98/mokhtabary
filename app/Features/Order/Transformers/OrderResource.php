<?php

namespace App\Features\Order\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Collect order info
        $orderInfo = $this->order_type == 'test' ?
            $this->testOrder->map(function ($testOrder) {
                return [

                    'numCode'       => $testOrder->labTest->test->num_code ?? null,
                    'code'          => $testOrder->labTest->test->code ?? null,
                    'nameEn'        => $testOrder->labTest->test->name_en ?? null,
                    'nameAr'        => $testOrder->labTest->test->name_ar ?? null,
                    'contractPrice' => $testOrder->labTest->contract_price ?? null,
                    'beforePrice'   => $testOrder->labTest->before_price ?? null,
                    'afterPrice'    => $testOrder->labTest->after_price ?? null,
                    'offerPrice'    => $testOrder->labTest->offer_price ?? null,

                ];
            }) :
            $this->xrayOrder->map(function ($xrayOrder) {
                return [
                    'numCode'       => $xrayOrder->radiologyXRay->xRay->num_code ?? null,
                    'code'          => $xrayOrder->radiologyXRay->xRay->code ?? null,
                    'nameEn'        => $xrayOrder->radiologyXRay->xRay->name_en ?? null,
                    'nameAr'        => $xrayOrder->radiologyXRay->xRay->name_ar ?? null,
                    'contractPrice' => $xrayOrder->radiologyXRay->contract_price ?? null,
                    'beforePrice'   => $xrayOrder->radiologyXRay->before_price ?? null,
                    'afterPrice'    => $xrayOrder->radiologyXRay->after_price ?? null,
                    'offerPrice'    => $xrayOrder->radiologyXRay->offer_price ?? null,

                ];
            });


        // Retrieve the receiver based on the order type
        $receiver = $this->order_type == 'test' ?
        [
            'id'                => $this->testOrder()->first()->labTest->lab->id,    // module user
            'email'             => $this->testOrder()->first()->labTest->lab->email, // module user
            'phone'             => $this->testOrder()->first()->labTest->lab->phone, // module user
            'name'              => $this->testOrder()->first()->labTest->lab->labDetail->name, // model user function labDetail
            'country_info'      => $this->testOrder()->first()->labTest->lab->labDetail->country()->first(['id','name_ar','name_en']), // model user function labDetail
            'city_info'         => $this->testOrder()->first()->labTest->lab->labDetail->city()->first(['id','name_ar','name_en']), // model user function labDetail
            'governorate_info'  => $this->testOrder()->first()->labTest->lab->labDetail->governorate()->first(['id','name_ar','name_en']), // model user function labDetail
            'street'            => $this->testOrder()->first()->labTest->lab->labDetail->street, // model user function labDetail
            'description'       => $this->testOrder()->first()->labTest->lab->labDetail->description, // model user function labDetail

        ]
        :
        [

            'id'                => $this->testOrder()->first()->radiologyXRay->radiology->id,    // module user
            'email'             => $this->testOrder()->first()->radiologyXRay->radiology->email, // module user
            'phone'             => $this->testOrder()->first()->radiologyXRay->radiology->phone, // module user
            'name'              => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->name, // model user function radiologyDetail
            'country_info'      => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->country()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'city_info'         => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->city()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'governorate_info'  => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->governorate()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'street'            => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->street, // model user function radiologyDetail
            'description'       => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->description, // model user function radiologyDetail

        ];

        return [
            "id"        => $this->id,
            "patient_name"   => $this->patient_name,
            "orderType" => $this->order_type,
            "delivery"  => $this->delivery == 0 ? 'No' : 'Yes',
            "visit"     => $this->visit == 0 ? 'No' : 'Yes',
            "status"    => $this->status ,
            "receiver"  => $receiver, // Keep unique labs here or radiology


            "client"  => [
                'id'                => $this->client->id,    // module user
                'email'             => $this->client->email, // module user
                'phone'             => $this->client->phone, // module user
                'name'              => $this->client->clientDetail->name, // model user function clientDetail
                'country_info'      => $this->client->clientDetail->country()->first(['id','name_ar','name_en']), // model user function clientDetail
                'city_info'         => $this->client->clientDetail->city()->first(['id','name_ar','name_en']), // model user function clientDetail
                'governorate_info'  => $this->client->clientDetail->governorate()->first(['id','name_ar','name_en']), // model user function clientDetail
                'street'            => $this->client->clientDetail->street, // model user function clientDetail
            ],

            "order_info" => $orderInfo,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }

}
