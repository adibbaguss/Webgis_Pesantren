<?php

namespace App\Http\Controllers\Pelapor\Madin;

use App\Http\Controllers\Controller;
use App\Models\FacilityMadin;
use App\Models\Madin;
use Illuminate\Http\Request;

class MapFacilityController extends Controller
{
    private $attributeNames = [
        'mushola' => 'Mushola/Tempat Ibadah',
        'kelas_pengajaran' => 'Ruang Kelas',
        'perpustakaan' => 'Perpustakaan',
        'ruang_guru' => 'Ruang Guru',
        'fasilitas_audio_visual' => 'Fasilitas Audio Visual',
        'kamar_mandi' => 'kamar mandi',
        'ruangan_administrasi' => 'riamg administrasi',
    ];

    private $attributeTable = [
        'mushola',
        'kelas_pengajaran',
        'perpustakaan',
        'ruang_guru',
        'fasilitas_audio_visual',
        'kamar_mandi',
        'ruangan_administrasi',
    ];

    public function index()
    {
        $attributeNames = $this->attributeNames;
        $attributeTable = $this->attributeTable;
        $madin = Madin::with('facility_madin')->get();
        $facilities = FacilityMadin::all();

        return view('pelapor.madin.map_facility', compact('madin', 'facilities', 'attributeNames', 'attributeTable'));
    }

    public function search(Request $request)
    {
        $attribute = $request->input('attribute');

        // Check if the attribute is empty before executing the query
        if (!empty($attribute)) {
            $facilities = FacilityMadin::select('madin_id', $attribute)->get();
        } else {
            // Handle the case when no attribute is selected, e.g., show all facilities
            $facilities = FacilityMadin::all();
        }

        $attributeNames = $this->attributeNames;
        $attributeTable = $this->attributeTable;
        $madin = Madin::with('facility_madin')->get();
        return view('pelapor.madin.map_facility', compact('madin', 'facilities', 'attribute', 'attributeNames', 'attributeTable'));

    }

    // public function exportXLSX()
    // {
    //     return Excel::download(new FacilityExport, 'Data Fasilitas Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.xlsx');
    // }

    // public function exportCSV()
    // {
    //     return Excel::download(new FacilityExport, 'Data Fasilitas Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.csv');
    // }

}
