<?php

namespace Database\Seeders;

use App\Models\FacilityMadin;
use Illuminate\Database\Seeder;

class FacilityMadinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 3;

        for ($i = 1; $i <= $count; $i++) {
            FacilityMadin::create([
                'madin_id' => $i,
                'mushola' => 0,
                'kelas_pengajaran' => 0,
                'perpustakaan' => 0,
                'ruang_guru' => 0,
                'fasilitas_audio_visual' => 0,
                'kamar_mandi' => 0,
                'ruangan_administrasi' => 0,
            ]);
        }
    }
}
