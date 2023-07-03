<?php

namespace Database\Seeders;

use Database\Seeders\PonpesSeeder;
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
            // CategoryReportSeeder::class,
            // ReportSeeder::class,
            // ActivitySeeder::class,
            // InstructorSeeder::class,
            // ImagePonpesSeeder::class,
            // StudentCountSeeder::class,
            // LearningSeeder::class,
        ]);
    }
}
