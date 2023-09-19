<?php

namespace Database\Factories;

use App\Models\ReportHistory;
use Faker\Factory as faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportHistory>
 */
class ReportHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ReportHistory::class;
    private static $reportId = 1;

    public function definition()
    {
        $faker = Faker::create();

        return [
            'report_id' => self::$reportId++,
            'date' => $faker->date(),
            'status' => 'baru',
            'information' => 'Laporan Masuk',
        ];
    }
}
