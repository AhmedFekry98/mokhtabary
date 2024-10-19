<?php

namespace App\Features\Radiology\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Radiology\Models\RadiologyBranch;
use App\Features\User\Models\User;

class RadiologyBranchService
{
    private static $model = User::class;


    /**
     * Get One By Id
     */
    public function getRadiologyBranchById(string $radiologyBranchId)
    {
        try {
            $radiologyBranch = self::$model::whereHas('roles', function ($query)  {
                $query->where('name','radiologyBranch');
            })->find($radiologyBranchId);

            if (! $radiologyBranch) return "No model with id $radiologyBranchId";
            return $radiologyBranch;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateRadiologyBranchById(string $radiologyBranchId, TDO $tdo)
    {
        try {
            $updateData = collect(
                $tdo->all(true)
            )->except([
                // ignore any key?
            ])->toArray();

            // manobolate the data before update?

            $radiologyBranch =  $this->getRadiologyBranchById($radiologyBranchId);
            if (is_string($radiologyBranch)) return $radiologyBranch;

            $radiologyBranch->update($updateData);
            $radiologyBranch->radiologyDetail()->update($updateData);

            // write any logic after update?

            return $radiologyBranch;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteRadiologyBranchById(string $radiologyBranchId)
    {
        try {

            // get model to delete by id
            $radiologyBranch =  $this->getRadiologyBranchById($radiologyBranchId);
            if (is_string($radiologyBranch)) return $radiologyBranch;
            $deleted = $radiologyBranch->delete();

            return $radiologyBranch;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
