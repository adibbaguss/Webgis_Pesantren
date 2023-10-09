<?php

namespace App\Http\Controllers\Pengunjung;

use App\Exports\PonpesExport;
use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class MapViewController extends Controller
{
    // map view
    public function index()
    {
        $ponpes = Ponpes::all();

        return view('pengunjung.map_view', compact('ponpes'));
    }

    public function exportXLSX()
    {
        return Excel::download(new PonpesExport, 'Data Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new PonpesExport, 'Data Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.csv');
    }
}
