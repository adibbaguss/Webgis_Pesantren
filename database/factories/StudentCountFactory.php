<?php

namespace Database\Factories;

use App\Models\Ponpes;
use Faker\Factory as faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentCount>
 */
class StudentCountFactory extends Factory
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
            'ponpes_id' => function () {
                return Ponpes::factory()->create()->id;
            },
            'year' => $faker->numberBetween(2000,2023),
            'male_resident_count' => $faker->numberBetween(0,100),
            'female_resident_count' => $faker->numberBetween(0,100),
            'male_non_resident_count' => $faker->numberBetween(0,100),
            'female_non_resident_count' => $faker->numberBetween(0,100),
        ];
    }
}
