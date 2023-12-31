<?php

namespace Database\Factories;

use App\Models\Ponpes;
use App\Models\Activity;
use Faker\Factory as faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = faker::create();
        return [
            'ponpes_id' => function () {
                return Ponpes::factory()->create()->id;
            },
            'name' => $faker->sentence(2),
            'description' => $faker->text(100),
        ];
    }
}
