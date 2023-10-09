<?php

namespace Database\Factories;

use App\Helpers\RandomIdGenerator;
use App\Models\ReportMadin;
use Faker\Factory as faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportMadin>
 */
class ReportMadinFactory extends Factory
{
    protected $model = ReportMadin::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = faker::create();
        return [
            'madin_id' => 1,
            'user_id' => $faker->numberBetween(4, 5),
            'category_id' => $faker->numberBetween(1, 5),
            'reporting_code' => RandomIdGenerator::generateUniqueId(),
            'title' => $faker->sentence(2),
            'description' => $faker->text(100),
        ];
    }
}
