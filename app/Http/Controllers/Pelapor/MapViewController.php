<?php

namespace App\Http\Controllers\Pelapor;

use App\Exports\PonpesExport;
use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class MapViewController extends Controller
{
    // map view
    // map view
    public function index()
    {
        $ponpes = Ponpes::all();

        return view('pelapor.map_view', compact('ponpes'));
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
