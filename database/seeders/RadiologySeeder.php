<?php

namespace Database\Seeders;

use App\Features\CompanyProfile\Models\City;
use App\Features\CompanyProfile\Models\Country;
use App\Features\CompanyProfile\Models\Governorate;
use App\Features\Radiology\Models\RadiologyxRay;
use App\Features\Radiology\Models\XRay;
use App\Features\User\Models\RadiologyDetail;
use App\Features\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RadiologySeeder extends Seeder
{

    public function run(): void
    {

        XRay::factory(1000)->create();

        // Create 10 radiology
        for ($i = 0; $i < 10; $i++) {
            $county      = Country::first();
            $governorate = Governorate::inRandomOrder()->first();
            $city        = City::inRandomOrder()->first();
           $radiology = User::create([
                'email'             => fake()->unique()->safeEmail(),
                'phone'             => fake()->unique()->phoneNumber(),
                'phone_verified_at' => now(),
                'password'          => Hash::make('password'),
            ]);
            //  more details
            $radiology->radiologyDetail()->create([
                'name'              => fake()->name(),
                'country_id'        => $county->id,
                'governorate_id'    => $governorate->id,
                'city_id'           => $city->id,
                'street'            => fake()->streetAddress(),
                'description'       => fake()->text(100)
            ]);

            $radiology->assignRole('radiology');


            $xRays = XRay::inRandomOrder()->take(10)->get();

            foreach ($xRays as $xRay) {
                // Check if RadiologyxRay entry already exists for this lab and test
                $existingRadiologyxRay = RadiologyxRay::where('x_ray_id', $xRay->id)->where('radiology_id', $radiology->id)->first();
                if (!$existingRadiologyxRay) {
                    RadiologyxRay::create([
                        'x_ray_id'       => $xRay->id,
                        'radiology_id'   => $radiology->id,
                        'contract_price' => fake()->numberBetween(100, 300),
                        'before_price'   => fake()->numberBetween(300, 400),
                        'after_price'    => fake()->numberBetween(100, 300),
                        'offer_price'    => fake()->numberBetween(50, 60),
                    ]);
                }
            }
        }

        // get user where role radiology to create branchis
        $radiologys = User::whereHas('roles', function ($query)  {
            $query->where('name','radiology');
        })->get();

        foreach($radiologys as $radiology){
            // create 10 branch each radiology
            // get id radiology from radiology details to make parent for branch
            $radiologyDetails = RadiologyDetail::where('radiology_id',$radiology->id)->first();
            for($i = 0; $i < 10; $i++){
                $county             = Country::first();
                $governorate        = Governorate::inRandomOrder()->first();
                $city               = City::inRandomOrder()->first();
                $radiologyBranch  = User::create([
                    'email'             => fake()->unique()->safeEmail(),
                    'phone'             => fake()->unique()->phoneNumber(),
                    'phone_verified_at' => now(),
                    'password'          => Hash::make('password'),
                ]);
                //  more details
                $radiologyBranch->radiologyDetail()->create([
                    'parent_id'         => $radiologyDetails->id,
                    'name'              => fake()->name(),
                    'country_id'        => $county->id,
                    'governorate_id'    => $governorate->id,
                    'city_id'           => $city->id,
                    'street'            => fake()->streetAddress(),
                    'description'       => fake()->text(100)
                ]);

                $radiologyBranch->assignRole('radiologyBranch');
            }
        }


    }
}
