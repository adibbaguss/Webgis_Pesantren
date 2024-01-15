<?php

namespace Database\Factories;

use App\Helpers\RandomIdGenerator;
use App\Models\Report;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();

        return [
            'ponpes_id' => 1,
            'user_id' => 3,
            'category_id' => $faker->numberBetween(1, 5),
            'reporting_code' => RandomIdGenerator::generateUniqueId(),
            'title' => $faker->sentence(2),
            'description' => $faker->text(100),
        ];
    }
}
