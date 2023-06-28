<?php

namespace Database\Factories;

use Faker\Factory as faker;
use App\Models\CategoryReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryReport>
 */
class CategoryReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = faker::create();
        return [
            'name'=>$faker->name(),
        ];
    }
}
