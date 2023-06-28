<?php

namespace Database\Seeders;

use App\Models\StudentCount;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentCount::factory()->count(10)->create();
    }
}
