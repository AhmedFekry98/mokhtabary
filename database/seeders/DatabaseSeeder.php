<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder  extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(LabUnitTestSeeder::class);
        $this->call(RadiologyUnitTestSeeder::class);
        $this->call(CientUnitTestSeeder::class);
        $this->call(LabSeeder::class);
        $this->call(RadiologySeeder::class);

    }
}
