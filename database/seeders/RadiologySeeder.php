<?php

namespace Database\Seeders;

use App\Features\Radiology\Models\XRay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RadiologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        XRay::factory(10)->create();
    }
}
