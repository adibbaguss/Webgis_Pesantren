<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ponpes;
use App\Models\Report;
use Faker\Factory as faker;
use Illuminate\Support\Str;
use App\Models\CategoryReport;
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
        $faker = faker::create();
        return [
            'ponpes_id' => function () {
                return Ponpes::factory()->create()->id;
            },
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'category_id' => function () {
                return CategoryReport::factory()->create()->id;
            },
            'title' => $faker->sentence(2),
            'description' => $faker->text(100),
            'reporting_date' => $faker->date(),
            'status' => $faker->randomElement(['baru', 'dalam proses', 'selesai', 'ditolak']),
        ];
    }
}
