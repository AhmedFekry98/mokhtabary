<?php

namespace Database\Seeders;

use App\Features\CompanyProfile\Models\City;
use App\Features\CompanyProfile\Models\Country;
use App\Features\CompanyProfile\Models\Governorate;
use App\Features\Lab\Models\LabTest;
use App\Features\Lab\Models\Test;
use App\Features\User\Models\LabDetail;
use App\Features\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         Test::factory(1000)->create();

        // Create 10 lab
        for ($i = 0; $i < 10; $i++) {
            $county      = Country::first();
            $governorate = Governorate::inRandomOrder()->first();
            $city        = City::inRandomOrder()->first();
           $lab = User::create([
                'email'             => fake()->unique()->safeEmail(),
                'phone'             => fake()->unique()->phoneNumber(),
                'phone_verified_at' => now(),
                'password'          => Hash::make('password'),
            ]);
            //  more details
            $lab->labDetail()->create([
                'name'              => fake()->name(),
                'country_id'        => $county->id,
                'governorate_id'    => $governorate->id,
                'city_id'           => $city->id,
                'street'            => fake()->streetAddress(),
                'description'       => fake()->text(100)
            ]);

            $lab->assignRole('lab');


            //  add priceng to test lab

            $tests = Test::inRandomOrder()->take(10)->get();

            foreach ($tests as $test) {
                // Check if LabTest entry already exists for this lab and test
                $existingLabTest = LabTest::where('test_id', $test->id)->where('lab_id', $lab->id)->first();
                if (!$existingLabTest) {
                    LabTest::create([
                        'test_id'        => $test->id,
                        'lab_id'         => $lab->id,
                        'contract_price' => fake()->numberBetween(100, 300),
                        'before_price'   => fake()->numberBetween(300, 400),
                        'after_price'    => fake()->numberBetween(100, 300),
                        'offer_price'    => fake()->numberBetween(50, 60),
                    ]);
                }
            }
        }

        // get user where role lab to create branchis
        $labs = User::whereHas('roles', function ($query)  {
            $query->where('name','lab');
        })->get();

        foreach($labs as $lab){
            // create 10 branch each lab
            // get id lab from lab details to make parent for branch
            $labDetails = LabDetail::where('lab_id',$lab->id)->first();
            for($i = 0; $i < 10; $i++){
                $county      = Country::first();
                $governorate = Governorate::inRandomOrder()->first();
                $city        = City::inRandomOrder()->first();
                $labBranch = User::create([
                    'email'             => fake()->unique()->safeEmail(),
                    'phone'             => fake()->unique()->phoneNumber(),
                    'phone_verified_at' => now(),
                    'password'          => Hash::make('password'),
                ]);
                //  more details
                $labBranch->labDetail()->create([
                    'parent_id'         => $labDetails->id,
                    'name'              => fake()->name(),
                    'country_id'        => $county->id,
                    'governorate_id'    => $governorate->id,
                    'city_id'           => $city->id,
                    'street'            => fake()->streetAddress(),
                    'description'       => fake()->text(100)
                ]);

                $labBranch->assignRole('labBranch');
            }
        }


    }
}
