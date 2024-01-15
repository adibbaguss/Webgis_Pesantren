<?php

namespace Database\Seeders;

use App\Models\Madin;
use Illuminate\Database\Seeder;

class MadinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Madin::factory()->count(11)->create();
    }

}
