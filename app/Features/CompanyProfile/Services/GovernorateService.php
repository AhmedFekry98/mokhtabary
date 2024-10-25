<?php

namespace App\Features\CompanyProfile\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\CompanyProfile\Models\Governorate;

class GovernorateService
{
    private static $model = Governorate::class;

    /**
     * Get All
     */
    public function getGovernorates()
    {
        try {
            $governorates =  self::$model::paginate(10);

            return $governorates;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storeGovernorate(TDO $tdo)
    {
        try {
            $creationData = collect(
                $tdo->all(true)
            )->except([
                // ignore any key?
            ])->toArray();

            // manobolate the data before creation?

            $governorate =  self::$model::create($creationData);

            // write any logic after creation?

            return $governorate;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getGovernorateById(string $governorateId)
    {
        try {
            $governorate =  self::$model::find($governorateId);
            if (! $governorate) return "No model with id $governorateId";
            return $governorate;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateGovernorateById(string $governorateId, TDO $tdo)
    {
        try {
            $updateData = collect(
                $tdo->all(true)
            )->except([
                // ignore any key?
            ])->toArray();

            // manobolate the data before update?

            $governorate =  $this->getGovernorateById($governorateId);
            if (is_string($governorate)) return $governorate;
            $governorate->update($updateData);

            // write any logic after update?

            return $governorate;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteGovernorateById(string $governorateId)
    {
        try {

            // get model to delete by id
            $governorate =  $this->getGovernorateById($governorateId);
            if (is_string($governorate)) return $governorate;
            $deleted = $governorate->delete();

            return $governorate;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
