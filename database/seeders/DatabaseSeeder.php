<?php

namespace Database\Seeders;

use Database\Seeders\CategoryReportSeeder;
use Database\Seeders\FacilitySeeder;
use Database\Seeders\PonpesSeeder;
use Database\Seeders\ReportHistorySeeder;
use Database\Seeders\ReportSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**ss
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PonpesSeeder::class,
            CategoryReportSeeder::class,
            ReportSeeder::class,
            ReportHistorySeeder::class,
            FacilitySeeder::class,
            // ActivitySeeder::class,
            // InstructorSeeder::class,
            // ImagePonpesSeeder::class,
            // StudentCountSeeder::class,
            // LearningSeeder::class,
        ]);
    }
}
