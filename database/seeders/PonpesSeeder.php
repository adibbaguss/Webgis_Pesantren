<?php

namespace Database\Seeders;

use App\Models\Ponpes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PonpesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ponpes::factory()->count(10)->create();
    }
}
