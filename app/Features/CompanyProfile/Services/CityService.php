<?php

namespace App\Features\CompanyProfile\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\CompanyProfile\Models\City;

class CityService
{
    private static $model = City::class;

    /**
     * Get All
     */
    // public function getCities()
    // {
    //     try {
    //         $cities =  self::$model::get();

    //         return $cities;
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    /**
     * Create One
     */
    public function storeCity(TDO $tdo)
    {
        try {
            $creationData = collect(
                $tdo->all(true)
            )->except([
                // ignore any key?
            ])->toArray();

            // manobolate the data before creation?

            $city =  self::$model::create($creationData);

            // write any logic after creation?

            return $city;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getCityById(string $cityId)
    {
        try {
            $city =  self::$model::find($cityId);
            if (! $city) return "No model with id $cityId";
            return $city;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update One By Id
     */
    // public function updateCityById(string $cityId, TDO $tdo)
    // {
    //     try {
    //         $updateData = collect(
    //             $tdo->all(true)
    //         )->except([
    //             // ignore any key?
    //         ])->toArray();

    //         // manobolate the data before update?

    //         $city =  $this->getCityById($cityId);
    //         if (is_string($city)) return $city;
    //         $city->update($updateData);

    //         // write any logic after update?

    //         return $city;
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    /**
     * Delete One By Id
     */
    public function deleteCityById(string $cityId)
    {
        try {

            // get model to delete by id
            $city =  $this->getCityById($cityId);
            if (is_string($city)) return $city;
            $deleted = $city->delete();

            return $city;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
