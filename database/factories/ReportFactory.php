<?php

namespace Database\Factories;

use App\Helpers\RandomIdGenerator;
use App\Models\Report;
use Faker\Factory as faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $faker = faker::create();
        return [
            'ponpes_id' => $faker->numberBetween(1, 3),

            'user_id' => $faker->numberBetween(1, 3),

            'category_id' => $faker->numberBetween(1, 5),
            'reporting_code' => RandomIdGenerator::generateUniqueId(),
            'title' => $faker->sentence(2),
            'description' => $faker->text(100),
            'reporting_date' => $faker->date(),
            'status' => $faker->randomElement(['baru', 'dalam proses', 'selesai', 'ditolak']),
        ];
    }
}
