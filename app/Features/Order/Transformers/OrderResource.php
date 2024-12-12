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
        $data = parent::toArray($request); //$request
        // return $data;


        return [
            "id"        => $this->id ?? null,
            "patient_name"   => $this->patient_name ?? null,
            "orderType" => $this->order_type ?? null,
            "delivery"  => $this->delivery == 0 ? 'No' : 'Yes',
            "visit"     => $this->visit == 0 ? 'No' : 'Yes',
            "status"    => $this->status ?? null,
            "receiver"  => [
                'id'                => $this->receiver->id ?? null,
                'email'             => $this->receiver->email ?? null,
                'phone'             => $this->receiver->phone ?? null,
                'name'              => $this->receiver->labDetail->name ?? $this->receiver->radiologyDetail->name ?? null,
                'country_info'      => ($this->receiver->labDetail && $this->receiver->labDetail->country()) ? $this->receiver->labDetail->country()->first(['id','name_ar','name_en']) : (($this->receiver->radiologyDetail && $this->receiver->radiologyDetail->country()) ? $this->receiver->radiologyDetail->country()->first(['id','name_ar','name_en']) : null),
                'city_info'         => ($this->receiver->labDetail && $this->receiver->labDetail->city()) ? $this->receiver->labDetail->city()->first(['id','name_ar','name_en']) : (($this->receiver->radiologyDetail && $this->receiver->radiologyDetail->city()) ? $this->receiver->radiologyDetail->city()->first(['id','name_ar','name_en']) : null),
                'governorate_info'  => ($this->receiver->labDetail && $this->receiver->labDetail->governorate()) ? $this->receiver->labDetail->governorate()->first(['id','name_ar','name_en']) : (($this->receiver->radiologyDetail && $this->receiver->radiologyDetail->governorate()) ? $this->receiver->radiologyDetail->governorate()->first(['id','name_ar','name_en']) : null),
                'street'            => $this->receiver->labDetail->street ?? $this->receiver->radiologyDetail->street ?? null,
                'description'       => $this->receiver->labDetail->description ?? $this->receiver->radiologyDetail->description ?? null,
                'role'              => $this->receiver->role->name ?? null,
                'branch'            => $this->branch->labDetail ?? $this->branch->radiologyDetail,
            ],

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
            "order_info" => $this->order_type === 'test' ?
                $this->testOrder->map(function($testOrder) {
                    return [
                        'id' => $testOrder->id ?? null,
                        'numCode' => $testOrder->labTest->test->num_code ?? null,
                        'code' => $testOrder->labTest->test->code ?? null,
                        'nameEn' => $testOrder->labTest->test->name_en ?? null,
                        'nameAr' => $testOrder->labTest->test->name_ar ?? null,
                        'contractPrice' => $testOrder->labTest->contract_price ?? null,
                        'beforePrice' => $testOrder->labTest->before_price ?? null,
                        'afterPrice' => $testOrder->labTest->after_price ?? null,
                        'offerPrice' => $testOrder->labTest->offer_price ?? null,
                    ];
                }) : ($this->order_type === 'xray' ?
                    $this->xrayOrder->map(function($xrayOrder) {
                        return [
                            'id' => $xrayOrder->id ?? null,
                            'numCode' => $xrayOrder->radiologyXRay->xRay->num_code ?? null,
                            'code' => $xrayOrder->radiologyXRay->xRay->code ?? null,
                            'nameEn' => $xrayOrder->radiologyXRay->xRay->name_en ?? null,
                            'nameAr' => $xrayOrder->radiologyXRay->xRay->name_ar ?? null,
                            'contractPrice' => $xrayOrder->radiologyXRay->contract_price ?? null,
                            'beforePrice' => $xrayOrder->radiologyXRay->before_price ?? null,
                            'afterPrice' => $xrayOrder->radiologyXRay->after_price ?? null,
                            'offerPrice' => $xrayOrder->radiologyXRay->offer_price ?? null,
                        ];
                    }) : null),
            "created_at" => $this->created_at?? null,
            "updated_at" => $this->updated_at?? null,
        ];
    }

}
