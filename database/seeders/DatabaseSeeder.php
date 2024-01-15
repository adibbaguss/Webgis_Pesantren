<?php

namespace Database\Seeders;

use Database\Seeders\CategoryReportMadinSeeder;
use Database\Seeders\CategoryReportSeeder;
use Database\Seeders\FacilityMadinSeeder;
use Database\Seeders\FacilitySeeder;
use Database\Seeders\MadinSeeder;
use Database\Seeders\PonpesSeeder;
use Database\Seeders\SchoolSeeder;
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
            // ReportSeeder::class,
            // ReportHistorySeeder::class,
            FacilitySeeder::class,
            SchoolSeeder::class,
            MadinSeeder::class,
            CategoryReportMadinSeeder::class,
            FacilityMadinSeeder::class,
            //ReportMadinSeeder::class,
            //ReportHistoryMadinSeeder::class,
            // ActivitySeeder::class,
            // InstructorSeeder::class,
            // ImagePonpesSeeder::class,
            // StudentCountSeeder::class,
            // LearningSeeder::class,
        ]);
    }
}
