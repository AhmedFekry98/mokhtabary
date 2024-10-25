<?php

namespace App\Features\CompanyProfile\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\CompanyProfile\Models\Partner;

class PartnerService
{
    private static $model = Partner::class;

    /**
     * Get All
     */
    public function getPartners()
    {
        try {
            $partners =  self::$model::get();

            return $partners;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storePartner(TDO $tdo)
    {
        try {
            $creationData = collect(
                $tdo->all(true)
            )->except([
              'img'
            ])->toArray();

            // manobolate the data before creation?

            $partner =  self::$model::create($creationData);

            // upload image
            if ($tdo->img) {
                $partner->addMedia($tdo->img)
                    ->toMediaCollection('partner');
            }

            return $partner;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getPartnerById(string $partnerId)
    {
        try {
            $partner =  self::$model::find($partnerId);
            if (! $partner) return "No model with id $partnerId";
            return $partner;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deletePartnerById(string $partnerId)
    {
        try {

            // get model to delete by id
            $partner =  $this->getPartnerById($partnerId);
            if (is_string($partner)) return $partner;
            $deleted = $partner->delete();

            return $deleted;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
