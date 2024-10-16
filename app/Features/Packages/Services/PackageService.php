<?php

namespace App\Features\Packages\Services;

use App\Features\Lab\Models\LabTest;

use Graphicode\Standard\TDO\TDO;
use App\Features\Packages\Models\Package;
use App\Features\Radiology\Models\RadiologyxRay;
use App\Features\Radiology\Models\XRay;

class PackageService
{
    private static $model = Package::class;

    private static $models = [
        'test' => LabTest::class,
        'xray' => RadiologyxRay::class,
    ];
    /**
     * Get All
     */
    public function getPackages()
    {
        try {
            $packages =  self::$model::get();

            return $packages;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create One
     */
    public function storePackage(TDO $tdo)
    {
        try {

            $creationData =$tdo->all();
            $packageType = $creationData['package_type'];

            $package =  self::$model::create($creationData);

            $packageType = $creationData['package_type'];
            $modelClass = self::$models[$packageType] ?? null;

            foreach($creationData['package'] as $packageItem){
                $package->packageDetail()->create([
                    'packageable_id' => $packageItem['packageable_id'],
                    'packageable_type' => $modelClass,  // Dynamically set the model class
                ]);
            }

            return $package;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get One By Id
     */
    public function getPackageById(string $packageId)
    {
        try {
            $package =  self::$model::find($packageId);
            if (! $package) return "No model with id $packageId";
            return $package;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete One By Id
     */
    public function deletePackageById(string $packageId)
    {
        try {

            // get model to delete by id
            $package =  $this->getPackageById($packageId);
            if (is_string($package)) return $package;
            $deleted = $package->delete();

            return $package;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
