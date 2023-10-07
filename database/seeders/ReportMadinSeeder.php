<?php

namespace Database\Seeders;

use App\Models\ReportMadin;
use Illuminate\Database\Seeder;

class ReportMadinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportMadin::factory()->count(11)->create();
    }
}
