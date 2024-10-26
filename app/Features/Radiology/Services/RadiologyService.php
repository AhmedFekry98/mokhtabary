<?php

namespace App\Features\Radiology\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Radiology\Models\Radiology;
use App\Features\User\Models\User;

class RadiologyService
{
    private static $model = User::class;

    /**
     * Get All
     */
    public function getRadiologies()
    {
        try {
            $radiologies =  self::$model::whereHas('roles', function ($query)  {
                $query->where('name','radiology');
            })->paginate(10);

            return $radiologies;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getRadiologyById(string $radiologyId)
    {
        try {
            $radiology =  self::$model::whereHas('roles', function ($query)  {
                $query->where('name','radiology');
            })->find($radiologyId);

            if (! $radiology) return "No model with id $radiologyId";
            return $radiology;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateRadiologyById(string $radiologyId, TDO $tdo)
    {
        try {
            $updateData = collect(
                $tdo->all(true)
            )->except([
                'img'
            ])->toArray();

            // manobolate the data before update?

            $radiology =  $this->getRadiologyById($radiologyId);
            if (is_string($radiology)) return $radiology;

            $radiology->update($updateData);
            $radiology->radiologyDetail()->update($updateData);

            // update img lab
            $img = $tdo->img;
            if($img){
                $radiology->addMedia($img)
                ->toMediaCollection('users');
            }
            return $radiology;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteRadiologyById(string $radiologyId)
    {
        try {

            // get model to delete by id
            $radiology =  $this->getRadiologyById($radiologyId);
            if (is_string($radiology)) return $radiology;
            $deleted = $radiology->delete();

            return $radiology;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
