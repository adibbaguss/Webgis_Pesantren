<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 55;

        for ($i = 1; $i <= $count; $i++) {
            Facility::create([
                'ponpes_id' => $i,
                'asrama_lk' => 0,
                'asrama_pr' => 0,
                'masjid' => 0,
                'aula_kegiatan' => 0,
                'ruang_pembelajaran' => 0,
                'perpustakaan' => 0,
                'kantor_pengajar' => 0,
                'dapur' => 0,
                'kantin' => 0,
                'tempat_olahraga' => 0,
                'kamar_mandi' => 0,
                'ruang_kesehatan' => 0,
                'kamar_pengajar' => 0,
                'lab_komputer' => 0,
                'lapangan_pertanian' => 0,
                'lapangan_pertenakan' => 0,
                'laundry' => 0,
            ]);
        }
    }
}
