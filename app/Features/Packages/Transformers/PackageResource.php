<?php

namespace App\Features\Packages\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $packageDitals =  $this->packageDetail;

        $packagebale = [];
        $totalAfterPrice = 0; // To calculate the total afterPrice
        $receiver = null;
        foreach($packageDitals as $packageDital ){
            $afterPrice = $packageDital->packageable['after_price'] ?? 0; // Ensure you're accessing the right key for afterPrice
            $totalAfterPrice += $afterPrice;

             // Capture receiver details from the first package only
            if (!$receiver) {
                $receiver = [
                    // get data form user model
                        'receiver_id'   => $packageDital->packageable->radiology['id'] ?? $packageDital->packageable->lab['id'] ?? null, // id user
                        'email'         => $packageDital->packageable->radiology['email'] ?? $packageDital->packageable->lab['email'] ?? null,
                        'phone'         => $packageDital->packageable->radiology['phone'] ?? $packageDital->packageable->lab['phone'] ?? null,
                    // get data from function readiology or lab in user more details
                        'name'          => $packageDital->packageable->radiology->radiologyDetail['name']        ??$packageDital->packageable->lab->labDetail['name']         ?? null,
                        'country'       => $packageDital->packageable->radiology->radiologyDetail['country']     ??$packageDital->packageable->lab->labDetail['country']      ?? null,
                        'city'          => $packageDital->packageable->radiology->radiologyDetail['city']        ??$packageDital->packageable->lab->labDetail['city']         ?? null,
                        'state'         => $packageDital->packageable->radiology->radiologyDetail['state']       ??$packageDital->packageable->lab->labDetail['state']        ?? null,
                        'street'        => $packageDital->packageable->radiology->radiologyDetail['street']      ??$packageDital->packageable->lab->labDetail['street']       ?? null,
                        'post_code'     => $packageDital->packageable->radiology->radiologyDetail['post_code']   ??$packageDital->packageable->lab->labDetail['post_code']    ?? null,
                        'description'   => $packageDital->packageable->radiology->radiologyDetail['description'] ??$packageDital->packageable->lab->labDetail['description']  ?? null,
                        'role'         =>  $role = $packageDital->packageable->radiology->role->name ?? $packageDital->packageable->role->name ?? null,
                        'type'         =>  $role == 'lab' ? 'test' : 'xray',
                ];
            }

            $packagebale[] =  [
                // get labtest or radiologyXray with morph function
               'id'              => $packageDital->packageable['id'] ?? null,
               'contract_price'  => $packageDital->packageable['contract_price'] ?? null,
               'beforePrice'     => $packageDital->packageable['before_price'] ?? null,
               'afterPrice'      => $packageDital->packageable['after_price'] ?? null,

                //  get data xray or test
               'num_code'           => $packageDital->packageable->xRay['num_code'] ??  $packageDital->packageable->test['num_code'] ?? null,
               'code'               => $packageDital->packageable->xRay['code']     ??  $packageDital->packageable->test['code'] ?? null,
               'name_en'            => $packageDital->packageable->xRay['name_en']  ??  $packageDital->packageable->test['name_en'] ?? null,
               'name_ar'            => $packageDital->packageable->xRay['name_ar']  ??  $packageDital->packageable->test['name_ar'] ?? null,

            ];
        }

        $response = [
            'id' => $this->id,
            'name' => $this->name,

                    'total' => $totalAfterPrice,
                    'receiver' => $receiver,
                    'details' => $packagebale, // Renamed for clarity
                    'createdAt' => $this->created_at,
                    'updatedAt' => $this->updated_at,
        ];

        return $response;

    }

}
