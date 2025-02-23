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
        $offerDitals =  $this->OfferDetail;

        $offerbale = [];
        $totalAfterPrice = 0; // To calculate the total afterPrice
        $receiver = null;
        $testNames = []; // Array to collect test names
        $type = null; // To store whether it's a test or xray
        $totalOfferPrice = 0;
        foreach($offerDitals as $offerDital ){
            $afterPrice = floatval($offerDital->offerable['after_price'] ?? 0);
            $offerPrice = floatval($offerDital->offerable['offer_price'] ?? 0);
            $totalAfterPrice += $afterPrice;
            $totalOfferPrice += $offerPrice;

             // Capture receiver details from the first package only
            if (!$receiver) {
                $receiver = [
                    // get data form user model
                        'receiver_id'   => $offerDital->offerable->radiology['id'] ?? $offerDital->offerable->lab['id'] ?? null, // id user
                        'email'         => $offerDital->offerable->radiology['email'] ?? $offerDital->offerable->lab['email'] ?? null,
                        'phone'         => $offerDital->offerable->radiology['phone'] ?? $offerDital->offerable->lab['phone'] ?? null,
                    // get data from function readiology or lab in user more details
                        'name'          => $offerDital->offerable->radiology->radiologyDetail['name']        ??$offerDital->offerable->lab->labDetail['name']         ?? null,
                        'country'       => $offerDital->offerable->radiology->radiologyDetail['country']     ??$offerDital->offerable->lab->labDetail['country']      ?? null,
                        'city'          => $offerDital->offerable->radiology->radiologyDetail['city']        ??$offerDital->offerable->lab->labDetail['city']         ?? null,
                        'state'         => $offerDital->offerable->radiology->radiologyDetail['state']       ??$offerDital->offerable->lab->labDetail['state']        ?? null,
                        'street'        => $offerDital->offerable->radiology->radiologyDetail['street']      ??$offerDital->offerable->lab->labDetail['street']       ?? null,
                        'post_code'     => $offerDital->offerable->radiology->radiologyDetail['post_code']   ??$offerDital->offerable->lab->labDetail['post_code']    ?? null,
                        'description'   => $offerDital->offerable->radiology->radiologyDetail['description'] ??$offerDital->offerable->lab->labDetail['description']  ?? null,
                        'role'         =>  $role = $offerDital->offerable->radiology->role->name ?? $offerDital->offerable->role->name ?? null,
                        'type'         =>  $role == 'lab' ? 'test' : 'xray',
                ];
            }

            $offerbale[] =  [
                // get labtest or radiologyXray with morph function

               'id'  => $offerDital->offerable['id'] ?? null,
               'contract_price'  => $offerDital->offerable['contract_price'] ?? null,
               'contract_price'  => $offerDital->offerable['contract_price'] ?? null,
               'beforePrice'     => $offerDital->offerable['before_price'] ?? null,
               'afterPrice'      => $offerDital->offerable['after_price'] ?? null,
               'offer_price'     => $offerDital->offerable['offer_price'] ?? null,
                //  get data xray or test
               'num_code'           => $offerDital->offerable->xRay['num_code'] ??  $offerDital->offerable->test['num_code'] ?? null,
               'code'               => $offerDital->offerable->xRay['code']     ??  $offerDital->offerable->test['code'] ?? null,
               'name_en'            => $offerDital->offerable->xRay['name_en']  ??  $offerDital->offerable->test['name_en'] ?? null,
               'name_ar'            => $offerDital->offerable->xRay['name_ar']  ??  $packageDital->packageable->test['name_ar'] ?? null,

            ];

            // Collect test/xray name and determine type
            if ($offerDital->offerable->xRay) {
                $name = $offerDital->offerable->xRay['name_en'] ?? null;
                $type = 'xray';
            } else {
                $name = $offerDital->offerable->test['name_en'] ?? null;
                $type = 'test';
            }
            if ($name) {
                $testNames[] = $name;
            }
        }

        $testNamesString = !empty($testNames) ? '(' . implode('-', $testNames) . ')' : '';
        $messagePrefix = $type === 'xray' ? 'Get a discount on x-rays ' : 'Get a discount on tests ';

        // Calculate discount percentage and ensure it's between 0 and 100
        $discountPercentage = round(($totalOfferPrice / $totalAfterPrice) * 100, 2);


        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'message' => $messagePrefix . $testNamesString,
            'total' => $totalOfferPrice,
            // 'totalAfterPrice' => $totalAfterPrice,
            'discount_percentage' => $discountPercentage,
            'receiver' => $receiver,
            'details' => $offerbale, // Renamed for clarity
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];

        return $response;

    }
}
