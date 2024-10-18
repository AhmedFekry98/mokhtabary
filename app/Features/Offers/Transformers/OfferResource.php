<?php

namespace App\Features\Offers\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $packageDitals =  $this->packageDetail;

        $offerbale = [];
        $totalAfterPrice = 0; // To calculate the total afterPrice
        $receiver = null;
        foreach($packageDitals as $packageDital ){
            $afterPrice = $packageDital->offerable['after_price'] ?? 0; // Ensure you're accessing the right key for afterPrice
            $totalAfterPrice += $afterPrice;

             // Capture receiver details from the first package only
            if (!$receiver) {
                $receiver = [
                    // get data form user model
                        'email'         => $packageDital->offerable->radiology['email'] ?? $packageDital->offerable->lab['email'] ?? null,
                        'phone'         => $packageDital->offerable->radiology['phone'] ?? $packageDital->offerable->lab['phone'] ?? null,
                    // get data from function readiology or lab in user more details
                        'name'          => $packageDital->offerable->radiology->radiologyDetail['name']        ??$packageDital->offerable->lab->labDetail['name']         ?? null,
                        'country'       => $packageDital->offerable->radiology->radiologyDetail['country']     ??$packageDital->offerable->lab->labDetail['country']      ?? null,
                        'city'          => $packageDital->offerable->radiology->radiologyDetail['city']        ??$packageDital->offerable->lab->labDetail['city']         ?? null,
                        'state'         => $packageDital->offerable->radiology->radiologyDetail['state']       ??$packageDital->offerable->lab->labDetail['state']        ?? null,
                        'street'        => $packageDital->offerable->radiology->radiologyDetail['street']      ??$packageDital->offerable->lab->labDetail['street']       ?? null,
                        'post_code'     => $packageDital->offerable->radiology->radiologyDetail['post_code']   ??$packageDital->offerable->lab->labDetail['post_code']    ?? null,
                        'description'   => $packageDital->offerable->radiology->radiologyDetail['description'] ??$packageDital->offerable->lab->labDetail['description']  ?? null,
                ];
            }

            $offerbale[] =  [
                // get labtest or radiologyXray with morph function
               'contract_price'  => $packageDital->offerable['contract_price'] ?? null,
               'beforePrice'     => $packageDital->offerable['contract_price'] ?? null,
               'afterPrice'      => $packageDital->offerable['contract_price'] ?? null,
               'contract_price'  => $packageDital->offerable['contract_price'] ?? null,
                //  get data xray or test
               'num_code'           => $packageDital->offerable->xRay['num_code'] ??  $packageDital->offerable->test['num_code'] ?? null,
               'code'               => $packageDital->offerable->xRay['code']     ??  $packageDital->offerable->test['code'] ?? null,
               'name_en'            => $packageDital->offerable->xRay['name_en']  ??  $packageDital->offerable->test['name_en'] ?? null,
               'name_ar'            => $packageDital->offerable->xRay['name_ar']  ??  $packageDital->packageable->test['name_ar'] ?? null,

            ];
        }

        $response = [
            'id' => $this->id,
            'name' => $this->name,

                    'totale' => $totalAfterPrice,
                    'receiver' => $receiver,
                    'details' => $offerbale, // Renamed for clarity
                    'createdAt' => $this->created_at,
                    'updatedAt' => $this->updated_at,
        ];

        return $response;

    }
}
