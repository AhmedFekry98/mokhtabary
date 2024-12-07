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
            'id'                => $this->testOrder()->first()->labTest->lab->id ?? null,    // module user
            'email'             => $this->testOrder()->first()->labTest->lab->email?? null, // module user
            'phone'             => $this->testOrder()->first()->labTest->lab->phone?? null, // module user
            'name'              => $this->testOrder()->first()->labTest->lab->labDetail->name?? null, // model user function labDetail
            'country_info'      => $this->testOrder()->first()->labTest->lab->labDetail->country()->first(['id','name_ar','name_en']), // model user function labDetail
            'city_info'         => $this->testOrder()->first()->labTest->lab->labDetail->city()->first(['id','name_ar','name_en']), // model user function labDetail
            'governorate_info'  => $this->testOrder()->first()->labTest->lab->labDetail->governorate()->first(['id','name_ar','name_en']), // model user function labDetail
            'street'            => $this->testOrder()->first()->labTest->lab->labDetail->street?? null, // model user function labDetail
            'description'       => $this->testOrder()->first()->labTest->lab->labDetail->description?? null, // model user function labDetail
            'role'              => $this->testOrder()->first()->labTest->lab->role->name?? null,

        ]
        :
        [

            'id'                => $this->xrayOrder()->first()->radiologyXRay->radiology->id?? null,    // module user
            'email'             => $this->xrayOrder()->first()->radiologyXRay->radiology->email?? null, // module user
            'phone'             => $this->xrayOrder()->first()->radiologyXRay->radiology->phone?? null, // module user
            'name'              => $this->xrayOrder()->first()->radiologyXRay->radiology->radiologyDetail->name?? null, // model user function radiologyDetail
            'country_info'      => $this->xrayOrder()->first()->radiologyXRay->radiology->radiologyDetail->country()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'city_info'         => $this->xrayOrder()->first()->radiologyXRay->radiology->radiologyDetail->city()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'governorate_info'  => $this->xrayOrder()->first()->radiologyXRay->radiology->radiologyDetail->governorate()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'street'            => $this->xrayOrder()->first()->radiologyXRay->radiology->radiologyDetail->street?? null, // model user function radiologyDetail
            'description'       => $this->xrayOrder()->first()->radiologyXRay->radiology->radiologyDetail->description?? null, // model user function radiologyDetail
            'role'              => $this->xrayOrder()->first()->radiologyXRay->radiology->role->name,

        ];

        return [
            "id"        => $this->id ?? null,
            "patient_name"   => $this->patient_name ?? null,
            "orderType" => $this->order_type ?? null,
            "delivery"  => $this->delivery == 0 ? 'No' : 'Yes',
            "visit"     => $this->visit == 0 ? 'No' : 'Yes',
            "status"    => $this->status ?? null,
            "receiver"  => $receiver ?? null, // Keep unique labs here or radiology


            "client"  => [
                'id'                => $this->client->id ?? null,    // module user
                'email'             => $this->client->email ?? null, // module user
                'phone'             => $this->client->phone ?? null, // module user
                'name'              => $this->client->clientDetail->name?? null, // model user function clientDetail
                'country_info'      => $this->client->clientDetail->country()->first(['id','name_ar','name_en']), // model user function clientDetail
                'city_info'         => $this->client->clientDetail->city()->first(['id','name_ar','name_en']), // model user function clientDetail
                'governorate_info'  => $this->client->clientDetail->governorate()->first(['id','name_ar','name_en']), // model user function clientDetail
                'street'            => $this->client->clientDetail->street ?? null, // model user function clientDetail
            ],
            "coupon_info" => [
                'coupon_id'             => $this->coupon_id?? null,
                'code'                  => $this->promo_code?? null,
                'discount_percentage'   => $this->discount_percentage?? null,
                'discount_value'        => $this->discount_value?? null,
            ],
            'invoice_transaction' => $this->invoiceTransaction,
            "amount"    =>  $this->amount?? null,
            "order_info" => $orderInfo?? null,
            "created_at" => $this->created_at?? null,
            "updated_at" => $this->updated_at?? null,
        ];
    }

}
