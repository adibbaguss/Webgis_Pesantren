<?php

namespace App\Models;

use App\Models\Ponpes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'facility';

    protected $fillable = [
        'ponpes_id',
        'asrama_lk',
        'asrama_pr',
        'masjid',
        'aula_kegiatan',
        'ruang_pembelajaran',
        'perpustakaan',
        'kantor_pengajar',
        'dapur',
        'kantin',
        'tempat_olahraga',
        'kamar_mandi',
        'ruang_kesehatan',
        'kamar_pengajar',
        'lab_komputer',
        'lapangan_pertanian',
        'lapangan_pertenakan',
        'laundry',
    ];

    // Inisialisasi nilai default 0
    protected $attributes = [
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
    ];

    public function ponpes()
    {
        return $this->belongsTo(Ponpes::class);
    }
}
