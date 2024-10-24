<?php

namespace App\Features\Client\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\User\Models\FamilyDetail;

class FamilyService
{
    private static $model = FamilyDetail::class;

    /**
     * Get One By Id
     */
    public function getFamilyById(string $familyId)
    {
        try {
            $family =  self::$model::find($familyId);
            if (! $family) return "No model with id $familyId";
            return $family;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateFamilyById(string $familyId, TDO $tdo)
    {
        try {
            $updateData = collect(
                $tdo->all(true)
            )->except([
                // ignore any key?
            ])->toArray();

            // manobolate the data before update?

            $family =  $this->getFamilyById($familyId);
            if (is_string($family)) return $family;
            $family->update($updateData);

            // write any logic after update?

            return $family;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteFamilyById(string $familyId)
    {
        try {

            // get model to delete by id
            $family =  $this->getFamilyById($familyId);
            if (is_string($family)) return $family;
            $deleted = $family->delete();

            return $deleted;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
