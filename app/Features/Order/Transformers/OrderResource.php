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
            'email'         => $this->testOrder()->first()->labTest->lab->email ?? null,
            'phone'         => $this->testOrder()->first()->labTest->lab->phone ?? null,
            'name'          => $this->testOrder()->first()->labTest->lab->labDetail->name ?? null,
            'country'       => $this->testOrder()->first()->labTest->lab->labDetail->country ?? null,
            'city'          => $this->testOrder()->first()->labTest->lab->labDetail->city ?? null,
            'state'         => $this->testOrder()->first()->labTest->lab->labDetail->state ?? null,
            'street'        => $this->testOrder()->first()->labTest->lab->labDetail->street ?? null,
            'post_code'     => $this->testOrder()->first()->labTest->lab->labDetail->post_code ?? null,
            'description'   => $this->testOrder()->first()->labTest->lab->labDetail->description ?? null,

        ]
        :
        [
            'email'         => $this->testOrder()->first()->radiologyXRay->radiology->email ?? null,
            'phone'         => $this->testOrder()->first()->radiologyXRay->radiology->phone ?? null,
            'name'          => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->name ?? null,
            'country'       => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->country ?? null,
            'city'          => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->city ?? null,
            'state'         => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->state ?? null,
            'street'        => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->street ?? null,
            'post_code'     => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->post_code ?? null,
            'description'   => $this->testOrder()->first()->radiologyXRay->radiology->radiologyDetail->description ?? null,

        ];

        return [
            "id"        => $this->id,
            "orderType" => $this->order_type,
            "delivery"  => $this->delivery,
            "visit"     => $this->delivery,
            "status"    => $this->delivery,
            "receiver"  => $receiver, // Keep unique labs here or radiology
            "order_info" => $orderInfo,

            "client"  => [
                'phone'     => $this->client->phone ?? null,
                'email'     => $this->client->email ?? null,
                'name'      => $this->client->clientDetail->name ?? null,
                'country'   => $this->client->clientDetail->country ?? null,
                'city'      => $this->client->clientDetail->city ?? null,
                'state'     => $this->client->clientDetail->state ?? null,
                'street'    => $this->client->clientDetail->street ?? null,
                'post_code' => $this->client->clientDetail->post_code ?? null,
            ],


            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }

}
