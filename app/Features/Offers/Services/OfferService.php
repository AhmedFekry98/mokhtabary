<?php

namespace App\Features\Offers\Services;

use App\Features\Lab\Models\LabTest;
use App\Features\Offers\Models\Offer;
use App\Features\Radiology\Models\RadiologyxRay;
use Graphicode\Standard\TDO\TDO;

class OfferService
{
    private static $model = Offer::class;

    private static $models = [
        'test' => LabTest::class,
        'xray' => RadiologyxRay::class,
    ];

   /**
     * Get All
     */
    public function getOffers()
    {
        try {
            $offers =  self::$model::get();

            return $offers;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storeOffer(TDO $tdo)
    {
        try {

            $creationData =$tdo->all();
            $offerType = $creationData['offer_type'];

            $offer =  self::$model::create($creationData);

            $offerType = $creationData['offer_type'];
            $modelClass = self::$models[$offerType] ?? null;

            foreach($creationData['offer'] as $offerItem){
                $offer->offerDetail()->create([
                    'offerable_id' => $offerItem['offerable_id'],
                    'offerable_type' => $modelClass,  // Dynamically set the model class
                ]);
            }

            return $offer;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getOfferById(string $offerId)
    {
        try {
            $offer =  self::$model::find($offerId);
            if (! $offer) return "No model with id $offerId";
            return $offer;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deleteOfferById(string $offerId)
    {
        try {

            // get model to delete by id
            $offer =  $this->getofferById($offerId);
            if (is_string($offer)) return $offer;
            $deleted = $offer->delete();

            return $offer;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
