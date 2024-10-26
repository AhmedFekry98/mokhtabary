<?php

namespace Database\Seeders;

use App\Features\Coupon\Models\Coupon;
use App\Features\Lab\Models\LabTest;
use App\Features\Offers\Models\Offer;
use App\Features\Packages\Models\Package;
use App\Features\Radiology\Models\RadiologyxRay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // coupons
        for($i=0; $i<10; $i++){
            Coupon::create([
                'code' => fake()->bothify('COUPON-####-???'),
                'discount_percentage' => fake()->numberBetween(5, 50),
                'expiration_date' => fake()->dateTimeBetween('now', '+1 year'), // Sets an expiration date up to one year in the future
                'is_active' => true, // Sets the coupon as active
            ]);
        }

        // packege

        for($i=0; $i<10; $i++){
            $package = Package::create([
                'name' =>fake()->name()
            ]);
        }

        $packages = Package::get();

        foreach($packages as $package){
            for($i=0; $i<10; $i++){
                $package->PackageDetail()->create([
                    'packageable_id'    => fake()->numberBetween(1, 9), // ID for LabTest or RadiologyxRay
                    'packageable_type'  => fake()->randomElement([LabTest::class, RadiologyxRay::class]), // Class names as strings
                    'package_id'        => $package->id,
                ]);
            }
        }

        //  offers
        for($i=0; $i<10; $i++){
            $offer = Offer::create([
                'name' =>fake()->name()
            ]);
        }

        $offers = Offer::get();

        foreach($offers as $offer){
            for($i=0; $i<10; $i++){
                $offer->OfferDetail()->create([
                    'offerable_id'    => fake()->numberBetween(1, 9), // ID for LabTest or RadiologyxRay
                    'offerable_type'  => fake()->randomElement([LabTest::class, RadiologyxRay::class]), // Class names as strings
                    'offer_id'        => $offer->id,
                ]);
            }
        }
    }
}

