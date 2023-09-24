<?php

namespace App\Http\Controllers\Admin_Kemenag;

use App\Exports\FacilityExport;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Ponpes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MapsFacilityController extends Controller
{
    private $attributeNames = [
        'asrama_lk' => 'Asrama Laki-laki',
        'asrama_pr' => 'Asrama Perempuan',
        'masjid' => 'Masjid/Mushola',
        'aula_kegiatan' => 'Aula Kegiatan',
        'ruang_pembelajaran' => 'Ruang Pembelajaran',
        'perpustakaan' => 'Perpustakaan',
        'kantor_pengajar' => 'Kantor Pengajar',
        'dapur' => 'Dapur',
        'kantin' => 'Kantin',
        'tempat_olahraga' => 'Tempat Olahraga',
        'kamar_mandi' => 'Kamar Mandi',
        'ruang_kesehatan' => 'Ruang Kesehatan',
        'kamar_pengajar' => 'Kamar Pengajar',
        'lab_komputer' => 'Lab Komputer',
        'lapangan_pertanian' => 'Lapangan Pertanian',
        'lapangan_pertenakan' => 'Lapangan Pertenakan',
        'laundry' => 'Laundry',
    ];

    private $attributeTable = [
        'asrama_lk', 'asrama_pr', 'masjid', 'aula_kegiatan', 'ruang_pembelajaran', 'perpustakaan', 'kantor_pengajar', 'dapur', 'kantin', 'tempat_olahraga', 'kamar_mandi', 'ruang_kesehatan', 'kamar_pengajar', 'lab_komputer', 'lapangan_pertanian', 'lapangan_pertenakan', 'laundry',
    ];

    public function index()
    {
        $attributeNames = $this->attributeNames;
        $attributeTable = $this->attributeTable;
        $ponpes = Ponpes::with('facility')->get();
        $facilities = Facility::all();

        return view('admin_kemenag.map_facility', compact('ponpes', 'facilities', 'attributeNames', 'attributeTable'));
    }

    public function search(Request $request)
    {
        $attribute = $request->input('attribute');

        // Check if the attribute is empty before executing the query
        if (!empty($attribute)) {
            $facilities = Facility::select('ponpes_id', $attribute)->get();
        } else {
            // Handle the case when no attribute is selected, e.g., show all facilities
            $facilities = Facility::all();
        }

        $attributeNames = $this->attributeNames;
        $attributeTable = $this->attributeTable;
        $ponpes = Ponpes::with('facility')->get();
        return view('admin_kemenag.map_facility', compact('ponpes', 'facilities', 'attribute', 'attributeNames', 'attributeTable'));

    }

    public function exportXLSX()
    {
        return Excel::download(new FacilityExport, 'Data Fasilitas Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new FacilityExport, 'Data Fasilitas Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.csv');
    }

}
