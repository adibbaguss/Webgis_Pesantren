<?php

namespace Database\Factories;

use App\Models\Ponpes;
use Faker\Factory as faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
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
            'nik' => $faker->unique()->randomNumber(8),
            'name' => $faker->name,
            'gender' => $faker->randomElement(['Male', 'Female']),
            'expertise' => $faker->sentence(1),
            'status' => $faker->randomElement(['active', 'non-active']),
        ];
    }
}
