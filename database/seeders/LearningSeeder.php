<?php

namespace Database\Seeders;

use App\Models\Learning;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LearningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Learning::factory()->count(20)->create();
    }
}
