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

        $this->call(LabSeeder::class);
        $this->call(RadiologySeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(DealSeeder::class);
        $this->call(ChatSystemSeeder::class);

    }
}
