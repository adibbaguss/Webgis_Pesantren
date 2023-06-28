<?php

namespace Database\Seeders;

use App\Models\CategoryReport;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PonpesSeeder;
use Database\Seeders\ReportSeeder;
use Database\Seeders\ActivitySeeder;
use Database\Seeders\LearningSeeder;
use Database\Seeders\InstructorSeeder;
use Database\Seeders\ImagePonpesSeeder;
use Database\Seeders\StudentCountSeeder;
use Database\Seeders\CategoryReportSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            ActivitySeeder::class,
            InstructorSeeder::class,
            ImagePonpesSeeder::class,
            StudentCountSeeder::class,
            LearningSeeder::class,
        ]);
    }
}
