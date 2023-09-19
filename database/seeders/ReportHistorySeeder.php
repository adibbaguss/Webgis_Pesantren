<?php

namespace Database\Seeders;

use App\Models\ReportHistory;
use Illuminate\Database\Seeder;

class ReportHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportHistory::factory()->count(11)->create();
    }
}
