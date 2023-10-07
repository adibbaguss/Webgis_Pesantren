<?php

namespace Database\Seeders;

use App\Models\ReportHistoryMadin;
use Illuminate\Database\Seeder;

class ReportHistoryMadinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportHistoryMadin::factory()->count(11)->create();
    }
}
