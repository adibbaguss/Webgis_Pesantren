<?php

namespace App\Models;

use App\Models\Madin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityMadin extends Model
{
    use HasFactory;

    protected $table = 'facility_madin';

    protected $fillable = [
        'madin_id',
        'mushola',
        'kelas_pengajaran',
        'perpustakaan',
        'ruang_guru',
        'fasilitas_audio_visual',
        'kamar_mandi',
        'ruangan_administrasi',

    ];

    // Inisialisasi nilai default 0
    protected $attributes = [
        'mushola' => 0,
        'kelas_pengajaran' => 0,
        'perpustakaan' => 0,
        'ruang_guru' => 0,
        'fasilitas_audio_visual' => 0,
        'kamar_mandi' => 0,
        'ruangan_administrasi' => 0,
    ];

    public function madin()
    {
        return $this->belongsTo(Madin::class);
    }
}
