<?php

namespace Database\Seeders;

use App\Features\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LabUnitTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $modeluser  = User::class;

//  create lab with details
       $createUser = $modeluser::create([
            'email'             => 'lab@example.com',
            'phone'             => '201012182626'   ,
            'phone_verified_at' =>  now(),
            'password'          =>Hash::make('password'),
        ]);
            //  master lab
        $createUser->labDetail()->create([
            'name'              => fake()->name(),
            'country'           => fake()->country(),
            'city'              => fake()->city(),
            'state'             => "qena",
            'street'            => "elmanaa",
            'post_code'         => fake()->postcode(),
            'description'       => fake()->text(100)
        ]);

        $createUser->assignRole('lab');

//  add branch lab
        $createUserAsBranchs = [
            ['email' => 'labbranch@example.com', 'phone' => fake()->phoneNumber(), 'phone_verified_at' => now(), 'password' => Hash::make('password')],
            ['email' => fake()->email(), 'phone' => fake()->phoneNumber(), 'phone_verified_at' => now(), 'password' => Hash::make('password')],
            ['email' => fake()->email(), 'phone' => fake()->phoneNumber(), 'phone_verified_at' => now(), 'password' => Hash::make('password')],
        ];

        $branchs = [
            [
                'parent_id' => 1, 'name' => fake()->name(), 'country' => fake()->country(), 'city' => fake()->city(),
                'state' => 'qena', 'street' => fake()->streetAddress(), 'post_code' => fake()->postcode(),
                'description' => fake()->text(100)  // Add the key 'description' here
            ],
            [
                'parent_id' => 1, 'name' => fake()->name(), 'country' => fake()->country(), 'city' => fake()->city(),
                'state' => 'qena', 'street' => fake()->streetAddress(), 'post_code' => fake()->postcode(),
                'description' => fake()->text(100)  // Add the key 'description' here
            ],
            [
                'parent_id' => 1, 'name' => fake()->name(), 'country' => fake()->country(), 'city' => fake()->city(),
                'state' => 'qena', 'street' => fake()->streetAddress(), 'post_code' => fake()->postcode(),
                'description' => fake()->text(100)  // Add the key 'description' here
            ],
        ];

        // createBranchs lab
        foreach ($createUserAsBranchs as $index => $createUserAsBranch) {
            $createUser = $modeluser::create($createUserAsBranch);
            $createUser->labDetail()->create($branchs[$index]);  // Use $index without the +1
            $createUser->assignRole('labBranch');
        }


    }
}
