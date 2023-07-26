<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;

class MapViewController extends Controller
{
    public function index()
    {
        $ponpes = Ponpes::all();

        $ponpes2 = Ponpes::all();
        $data = Ponpes::select('subdistrict')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Salafiyah" THEN 1 ELSE 0 END) as salafiyah_count')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Khalafiyah" THEN 1 ELSE 0 END) as khalafiyah_count')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Kombinasi" THEN 1 ELSE 0 END) as kombinasi_count')
            ->selectRaw('SUM(CASE WHEN category IN ("Pesantren Salafiyah", "Pesantren Khalafiyah", "Pesantren Kombinasi") THEN 1 ELSE 0 END) as Total')
            ->groupBy('subdistrict')
            ->get();

        return view('admin.map_view', compact('ponpes', 'ponpes2', 'data'));
    }
}
