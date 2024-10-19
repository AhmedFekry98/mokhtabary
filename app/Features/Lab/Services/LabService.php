<?php

namespace App\Features\Lab\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Lab\Models\Lab;
use App\Features\User\Models\User;

class LabService
{
    private static $model = User::class;

    /**
     * Get All
     */
    public function getLabs()
    {
        try {
            $labs = self::$model::whereHas('roles', function ($query)  {
                            $query->where('name','lab');
                        })->get();
            return $labs;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * Get One By Id
     */
    public function getLabById(string $labId)
    {
        try {
            $lab =  self::$model::whereHas('roles', function ($query)  {
                $query->where('name','lab');
            })->find($labId);
            if (! $lab) return "No model with id $labId";
            return $lab;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateLabById(string $labId, TDO $tdo)
    {
        try {
            $updateData = collect(
                $tdo->all(true)
            )->except([
                'logo'
            ])->toArray();

            $lab =  $this->getLabById($labId);
            if (is_string($lab)) return $lab;

            $lab->update($updateData);

            $lab->labDetail()->update($updateData);

            // update logo lab
            $logo = $tdo->logo;
            if($logo){
                $lab->addMedia($logo)
                ->toMediaCollection('users');
            }

            return $lab;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteLabById(string $labId)
    {
        try {

            // get model to delete by id
            $lab =  $this->getLabById($labId);
            if (is_string($lab)) return $lab;
            $deleted = $lab->delete();

            return $lab;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
