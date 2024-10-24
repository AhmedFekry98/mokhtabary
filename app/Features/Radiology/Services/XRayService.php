<?php

namespace App\Features\Radiology\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Radiology\Models\XRay;

class XRayService
{
    private static $model = XRay::class;

    /**
     * Get All
     */
    public function getXRays()
    {
        try {
            $xRays =  self::$model::paginate(10);

            return $xRays;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storeXRay(TDO $tdo)
    {
        try {
            $creationData = $tdo->all();

            // manobolate the data before creation?

            $xRay =  self::$model::create($creationData);

            // write any logic after creation?

            return $xRay;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getXRayById(string $xRayId)
    {
        try {
            $xRay =  self::$model::find($xRayId);
            if (! $xRay) return "No model with id $xRayId";
            return $xRay;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateXRayById(string $xRayId, TDO $tdo)
    {
        try {
            $updateData = $tdo->all();

            // manobolate the data before update?

            $xRay =  $this->getXRayById($xRayId);
            if (is_string($xRay)) return $xRay;
            $xRay->update($updateData);

            // write any logic after update?

            return $xRay;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteXRayById(string $xRayId)
    {
        try {

            // get model to delete by id
            $xRay =  $this->getXRayById($xRayId);
            if (is_string($xRay)) return $xRay;
            $deleted = $xRay->delete();

            return $xRay;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
