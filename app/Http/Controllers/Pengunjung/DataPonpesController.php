<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use Illuminate\Http\Request;

class DataPonpesController extends Controller
{
    public function index()
    {
        $ponpes = Ponpes::orderBy('name')->get();

        return view('pengunjung.data_ponpes', compact('ponpes'));

    }

    public function ponpesSearch(Request $request)
    {
        $query = $request->input('query');

        $ponpes = Ponpes::where('name', 'like', '%' . $query . '%')
            ->orWhere('city', 'like', '%' . $query . '%')
            ->orWhere('subdistrict', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->orderBy('name')
            ->get();

        return view('pengunjung.data_ponpes', compact('ponpes'));
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
