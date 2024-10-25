<?php

namespace Database\Seeders;

use App\Features\CompanyProfile\Models\Partner;
use App\Features\CompanyProfile\Models\Policy;
use App\Features\CompanyProfile\Models\QuestionAnswer;
use App\Features\CompanyProfile\Models\TermCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // craete 10 row
        for($i=0; $i<10; $i++ ){
            Policy::create([
                'policy' => fake()->text(200)
            ]);
        }

        // craete 10 row
        for($i=0; $i<10; $i++ ){
            TermCondition::create([
                'term_condition' => fake()->text(200)
            ]);
        }

        // craete 10 row
        for($i=0; $i<10; $i++ ){
            QuestionAnswer::create([
                'question' => fake()->text(100),
                'answer' => fake()->text(200)
            ]);
        }



    }
}
