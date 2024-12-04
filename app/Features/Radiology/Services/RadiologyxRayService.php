<?php

namespace App\Features\Radiology\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Radiology\Models\RadiologyxRay;
use App\Features\Radiology\Models\XRay;
use App\Features\User\Models\User;

class RadiologyxRayService
{
    private static $model = RadiologyxRay::class;
    /**
     * Get All useing radiologyId = user_id with role master radiology
     */
    public function getRadiologyxRays(string $radiologyId)
    {

        $radiology = User::find($radiologyId);


        $xRay =XRay::with(['radiologyxRay' => function($query) use ($radiologyId) {
            $query->where('radiology_id', $radiologyId);
        }])->paginate(10); // You can adjust the number of items per page

        // Return the paginated results as a resource collection
        return [
            'radiology_info' => $radiology,
            'xray' => $xRay,
        ];

    }

    /**
     * Create One
     */
    public function updateOrCreateRadiologyxRay(TDO $tdo)
    {

        try {
            $creationData = collect($tdo->all(true))->except([
                // exclude any keys if needed
            ])->toArray();
            // Define the matching criteria for the "x_ray_id" and "radiology_id" columns
            $matchingCriteria = [
                'x_ray_id' => $creationData['x_ray_id'],
                'radiology_id'  => $creationData['radiology_id'],
            ];

            // Remove the matching criteria from the creation data as they are used for finding the record
            $updateData = collect($creationData)->except(['x_ray_id', 'radiology_id'])->toArray();

            // Use updateOrCreate to either update the record if it exists or create a new one
            $radiologyxRay = self::$model::updateOrCreate($matchingCriteria, $updateData);


            // Perform any additional logic after the record is created/updated
            return $radiologyxRay;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getRadiologyxRayById(string $radiologyxRayId)
    {
        try {
            $radiologyxRay =  self::$model::find($radiologyxRayId);
            if (! $radiologyxRay) return "No model with id $radiologyxRayId";
            return $radiologyxRay;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * get test for lab useing multi ids for xray_ids and radiology_id
     */

    public function getRadiologyxRayByIds(string $radiologyId , array $ids)
    {
       try {
           $radiologyxRay = self::$model::where('radiology_id',$radiologyId)->whereIn('x_ray_id', $ids)->get();
           if (! $radiologyxRay) return "No model with id $radiologyId or $ids";
           return $radiologyxRay;
       } catch (\Exception $e) {
           return $e->getMessage();
       }
    }
}
