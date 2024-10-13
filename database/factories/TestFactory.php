<?php

namespace database\factories;

use App\Features\Lab\Models\Test;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    protected $model = Test::class;

    public function definition(): array
    {
        
        return [
            'num_code' => fake()->unique()->numberBetween(5000, 100000),
            'code'     => fake()->unique()->word(),
            'name_en'  => fake()->name(),
            'name_ar'  => fake()->name(),
        ];
    }
}
