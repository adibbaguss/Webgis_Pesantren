<?php

namespace Database\Seeders;

use App\Models\ImagePonpes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImagePonpesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImagePonpes::factory()->count(20)->create();
    }
}
