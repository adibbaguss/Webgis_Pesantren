<?php

namespace Database\Seeders;

use App\Models\CategoryReport;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryReport::factory()->count(5)->create();
    }
}
