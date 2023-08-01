<?php

namespace Database\Seeders;

use App\Models\CategoryReport;
use Illuminate\Database\Seeder;

class CategoryReportSeeder extends Seeder
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
                'name' => 'Kebutuhan Akademis',
            ],
            [
                'name' => 'Kesehatan dan Sanitasi',
            ],
            [
                'name' => 'Kebutuhan Sarana dan Prasarana',
            ],
            [
                'name' => 'Keuangan dan Pengelolaan Dana',
            ],
            [
                'name' => 'Kegiatan Keagamaan dan Kebudayaan',
            ],
            [
                'name' => 'Lainnya',
            ],

        ];
        foreach ($category as $key => $value) {
            CategoryReport::create($value);
        }
    }
}
