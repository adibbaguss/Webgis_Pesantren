<?php

namespace App\Http\Controllers\Pengunjung\Madin;

use App\Exports\MadinExport;
use App\Http\Controllers\Controller;
use App\Models\Madin;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class MapViewController extends Controller
{
    public function index()
    {
        $madin = Madin::all();

        return view('pengunjung.madin.map_view', compact('madin'));
    }

    public function exportXLSX()
    {
        return Excel::download(new MadinExport, 'Data Madin Kab.Batang-' . Carbon::now()->timestamp . '.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new MadinExport, 'Data Madin Kab.Batang-' . Carbon::now()->timestamp . '.csv');
    }
}
