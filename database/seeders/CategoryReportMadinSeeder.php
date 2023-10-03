<?php

namespace Database\Seeders;

use App\Models\CategoryReportMadin;
use Illuminate\Database\Seeder;

class CategoryReportMadinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'name' => 'Kategori 1',
            ],
            [
                'name' => 'Kategori 2',
            ],
            [
                'name' => 'Kategori 3',
            ],
            [
                'name' => 'Kategori 4',
            ],

            [
                'name' => 'Lainnya',
            ],

        ];
        foreach ($category as $key => $value) {
            CategoryReportMadin::create($value);
        }
    }
}
