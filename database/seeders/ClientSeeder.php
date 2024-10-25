<?php

namespace Database\Seeders;

use App\Features\CompanyProfile\Models\City;
use App\Features\CompanyProfile\Models\Country;
use App\Features\CompanyProfile\Models\Governorate;
use App\Features\User\Models\FamilyDetail;
use App\Features\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 lab
        for ($i = 0; $i < 10; $i++) {
            $county      = Country::first();
            $governorate = Governorate::inRandomOrder()->first();
            $city        = City::inRandomOrder()->first();
            $client = User::create([
                'email'             => fake()->unique()->safeEmail(),
                'phone'             => fake()->unique()->phoneNumber(),
                'phone_verified_at' => now(),
                'password'          => Hash::make('password'),
            ]);
            //  more details
            $client->clientDetail()->create([
                'name'              => fake()->name(),
                'country_id'        => $county->id,
                'governorate_id'    => $governorate->id,
                'city_id'           => $city->id,
                'street'            => fake()->streetAddress(),
            ]);

            $client->assignRole('client');
        }
        // get user where role lab to create branchis
        $clients = User::whereHas('roles', function ($query)  {
            $query->where('name','client');
        })->get();

        // create family for client
        foreach($clients as $client){
            for($i = 0; $i < 10; $i++){
                $county      = Country::first();
                $governorate = Governorate::inRandomOrder()->first();
                $city        = City::inRandomOrder()->first();

                //  famil model create
                FamilyDetail::create([
                    'client_id'         => $client->id,
                    'name'              => fake()->name(),
                    'country_id'        => $county->id,
                    'governorate_id'    => $governorate->id,
                    'city_id'           => $city->id,
                    'street'            => fake()->streetAddress(),
                    'email'             => fake()->unique()->safeEmail(),
                    'phone'             => fake()->unique()->phoneNumber(),
                ]);
            }
        }

    }
}
