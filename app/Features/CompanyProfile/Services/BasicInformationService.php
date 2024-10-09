<?php

namespace App\Features\CompanyProfile\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\CompanyProfile\Models\BasicInformation;

class BasicInformationService
{
    private static $model = BasicInformation::class;

  

    /**
     * Get One By Id
     */
    public function getBasicInformationById(string $basicInformationId = "1")
    {
        try {
            $basicInformation =  self::$model::find($basicInformationId);
            if (! $basicInformation) return "No model with id $basicInformationId";
            return $basicInformation;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    public function updateOrCreateBasicInformation( TDO $tdo,string $basicInformationId = "1")
    {
        try {
            $updateData = $tdo->all();
    
            $basicInformation = self::$model::updateOrCreate(['id' => $basicInformationId],$updateData);
    
            $logo = $tdo->logo ?? null;
            if ($logo) {
                $basicInformation->addMedia($logo)->toMediaCollection('logo');
                
            }
    
            return  $this->getBasicInformationById();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
