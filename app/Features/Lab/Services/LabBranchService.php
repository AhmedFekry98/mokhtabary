<?php

namespace App\Features\Lab\Services;

use App\Features\User\Models\User;
use Graphicode\Standard\TDO\TDO;

class LabBranchService
{
    private static $model = User::class;

    public function getLabBranchById(string $labBranchId)
    {
        try {
            $labBranch =  self::$model::whereHas('roles', function ($query)  {
                $query->where('name','labBranch');
            })->find($labBranchId);
            if (! $labBranch) return "No model with id $labBranchId";
            return $labBranch;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateLabById(string $labBranchId, TDO $tdo)
    {
        try {
            $updateData = collect(
                $tdo->all(true)
            )->except([
                'logo'
            ])->toArray();

            $labBranch=  $this->getLabBranchById($labBranchId);
            if (is_string($labBranch)) return $labBranch;

            $labBranch->update($updateData);
            $labBranch->labDetail()->update($updateData);

            return $labBranch;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteLabBranchById(string $labBranchId)
    {
        try {

            // get model to delete by id
            $labBranch =  $this->getLabBranchById($labBranchId);
            if (is_string($labBranch)) return $labBranch;
            $deleted = $labBranch->delete();

            return $labBranch;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}
