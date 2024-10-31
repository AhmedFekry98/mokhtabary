<?php

namespace App\Features\Order\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Retrieve the receiver based on the order type
        $receiver = $this->order_type == 'test' ?
        [
            'id'                => $this->receiver->id,    // module user
            'email'             => $this->receiver->email, // module user
            'phone'             => $this->receiver->phone, // module user
            'name'              => $this->receiver->labDetail->name, // model user function labDetail
            'country_info'      => $this->receiver->labDetail->country()->first(['id','name_ar','name_en']), // model user function labDetail
            'city_info'         => $this->receiver->labDetail->city()->first(['id','name_ar','name_en']), // model user function labDetail
            'governorate_info'  => $this->receiver->labDetail->governorate()->first(['id','name_ar','name_en']), // model user function labDetail
            'street'            => $this->receiver->labDetail->street, // model user function labDetail
            'description'       => $this->receiver->labDetail->description, // model user function labDetail

        ]
        :
        [
            'id'                => $this->receiver->id,    // module user
            'email'             => $this->receiver->email, // module user
            'phone'             => $this->receiver->phone, // module user
            'name'              => $this->receiver->radiologyDetail->name, // model user function radiologyDetail
            'country_info'      => $this->receiver->radiologyDetail->country()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'city_info'         => $this->receiver->radiologyDetail->city()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'governorate_info'  => $this->receiver->radiologyDetail->governorate()->first(['id','name_ar','name_en']), // model user function radiologyDetail
            'street'            => $this->receiver->radiologyDetail->street, // model user function radiologyDetail
            'description'       => $this->receiver->radiologyDetail->description, // model user function radiologyDetail

        ] ?? null;
       return [
            'receiver' => $receiver,
            'client' => [
                'id'                => $this->client->id,    // module user
                'email'             => $this->client->email, // module user
                'phone'             => $this->client->phone, // module user
                'name'              => $this->client->clientDetail->name, // model user function clientDetail
                'country_info'      => $this->client->clientDetail->country()->first(['id','name_ar','name_en']), // model user function clientDetail
                'city_info'         => $this->client->clientDetail->city()->first(['id','name_ar','name_en']), // model user function clientDetail
                'governorate_info'  => $this->client->clientDetail->governorate()->first(['id','name_ar','name_en']), // model user function clientDetail
                'street'            => $this->client->clientDetail->street, // model user function clientDetail
            ],
            'prescription_mediacl' => $this->prescriptionMediacl
       ];
    }
}

