<?php

namespace App\Http\Controllers\Pelapor;

use App\Exports\PonpesExport;
use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataPonpesController extends Controller
{
    public function index()
    {
        $ponpes = Ponpes::all();

        return view('pelapor.data_ponpes', compact('ponpes'));

    }

    public function ponpesSearch(Request $request)
    {
        $query = $request->input('query');

        $ponpes = Ponpes::where('name', 'like', '%' . $query . '%')
            ->orWhere('city', 'like', '%' . $query . '%')
            ->orWhere('subdistrict', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->get();

        return view('pelapor.data_ponpes', compact('ponpes'));
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
