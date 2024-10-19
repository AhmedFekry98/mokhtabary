<?php

namespace database\seeders;

use App\Features\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RadiologyUnitTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $modeluser  = User::class;

//  create lab with details
       $createUser = $modeluser::create([
            'email'             => 'radiology@example.com',
            'phone'             => '2015xxxxxxxx'   ,
            'phone_verified_at' =>  now(),
            'password'          =>Hash::make('password'),
        ]);
            //  master lab
        $userDetail = $createUser->radiologyDetail()->create([
            'name'              => fake()->name(),
            'country'           => fake()->country(),
            'city'              => fake()->city(),
            'state'             => "qena",
            'street'            => "elmanaa",
            'post_code'         => fake()->postcode(),
            'description'       => fake()->text(100)
        ]);

        $createUser->assignRole('radiology');

//  add branch lab
        $createUserAsBranchs = [
            ['email' => 'radiologybranch@example.com', 'phone' => fake()->phoneNumber(), 'phone_verified_at' => now(), 'password' => Hash::make('password')],
            ['email' => fake()->email(), 'phone' => fake()->phoneNumber(), 'phone_verified_at' => now(), 'password' => Hash::make('password')],
            ['email' => fake()->email(), 'phone' => fake()->phoneNumber(), 'phone_verified_at' => now(), 'password' => Hash::make('password')],
        ];

        $branchs = [
            [
                'parent_id' => $userDetail->id, 'name' => fake()->name(), 'country' => fake()->country(), 'city' => fake()->city(),
                'state' => 'qena', 'street' => fake()->streetAddress(), 'post_code' => fake()->postcode(),
                'description' => fake()->text(100)  // Add the key 'description' here
            ],
            [
                'parent_id' => $userDetail->id, 'name' => fake()->name(), 'country' => fake()->country(), 'city' => fake()->city(),
                'state' => 'qena', 'street' => fake()->streetAddress(), 'post_code' => fake()->postcode(),
                'description' => fake()->text(100)  // Add the key 'description' here
            ],
            [
                'parent_id' => $userDetail->id, 'name' => fake()->name(), 'country' => fake()->country(), 'city' => fake()->city(),
                'state' => 'qena', 'street' => fake()->streetAddress(), 'post_code' => fake()->postcode(),
                'description' => fake()->text(100)  // Add the key 'description' here
            ],
        ];

        // createBranchs lab
        foreach ($createUserAsBranchs as $index => $createUserAsBranch) {
            $createUser = $modeluser::create($createUserAsBranch);
            $createUser->radiologyDetail()->create($branchs[$index]);  // Use $index without the +1
            $createUser->assignRole('radiologyBranch');
        }


    }
}
