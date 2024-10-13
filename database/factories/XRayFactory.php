<?php

namespace database\factories;

use App\Features\Radiology\Models\XRay;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class XRayFactory extends Factory
{
    protected $model = XRay::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
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
