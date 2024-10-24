<?php

namespace Database\Seeders;

use App\Features\User\Models\FamilyDetail;
use App\Features\User\Models\Role;
use App\Features\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CientUnitTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modeluser  = User::class;

        //  create client with details
               $createUser = $modeluser::create([
                    'email'             => 'client@example.com',
                    'phone'             => '2016xxxxxxxx'   ,
                    'phone_verified_at' =>  now(),
                    'password'          =>Hash::make('password'),
                ]);
                    //  master client
                $userDetail = $createUser->clientDetail()->create([
                    'name'              => fake()->name(),
                    'country'           => fake()->country(),
                    'city'              => fake()->city(),
                    'state'             => "qena",
                    'street'            => "elmanaa",
                    'post_code'         => fake()->postcode(),
                ]);

                $createUser->assignRole('client');

                // add family
                $families = [
                    [
                        'client_id' => $createUser->id, 'name' => fake()->name(), 'country' => fake()->country(), 'city' => fake()->city(),
                        'state' => 'qena', 'street' => fake()->streetAddress(), 'post_code' => fake()->postcode(),
                        'phone' => fake()->phoneNumber(), 'email' => fake()->email()
                    ],
                    [
                        'client_id' => $createUser->id, 'name' => fake()->name(), 'country' => fake()->country(), 'city' => fake()->city(),
                        'state' => 'qena', 'street' => fake()->streetAddress(), 'post_code' => fake()->postcode(),
                        'phone' => fake()->phoneNumber(), 'email' => fake()->email()
                    ],
                    [
                        'client_id' => $createUser->id, 'name' => fake()->name(), 'country' => fake()->country(), 'city' => fake()->city(),
                        'state' => 'qena', 'street' => fake()->streetAddress(), 'post_code' => fake()->postcode(),
                        'phone' => fake()->phoneNumber(), 'email' => fake()->email()
                    ],

                ];

                // createBranchs lab
                foreach ($families as $index => $family) {
                    FamilyDetail::create($family);
                }
    }
}
