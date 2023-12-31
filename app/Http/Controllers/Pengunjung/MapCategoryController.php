<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;

class MapCategoryController extends Controller
{
    // map view
    public function index()
    {
        $ponpes = Ponpes::all();

        $ponpes2 = Ponpes::all();
        $data = Ponpes::select('subdistrict')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Salafiyah (Tradisional)" THEN 1 ELSE 0 END) as salafiyah_count')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Khalafiyah (Modern)" THEN 1 ELSE 0 END) as khalafiyah_count')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Kombinasi" THEN 1 ELSE 0 END) as kombinasi_count')
            ->selectRaw('SUM(CASE WHEN category IN ("Pesantren Salafiyah (Tradisional)", "Pesantren Khalafiyah (Modern)", "Pesantren Kombinasi") THEN 1 ELSE 0 END) as Total')
            ->groupBy('subdistrict')
            ->get();

        return view('pengunjung.map_category', compact('ponpes', 'ponpes2', 'data'));
    }

    // public function exportXLSX()
    // {
    //     return Excel::download(new PonpesExport, 'Data Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.xlsx');
    // }

    // public function exportCSV()
    // {
    //     return Excel::download(new PonpesExport, 'Data Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.csv');
    // }
}
