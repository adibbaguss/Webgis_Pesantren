<?php

namespace App\Http\Controllers;

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

        return view('admin.data_ponpes', compact('ponpes'));

    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $ponpes = Ponpes::where('name', 'like', '%' . $query . '%')
            ->orWhere('city', 'like', '%' . $query . '%')
            ->orWhere('subdistrict', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->get();

        return view('admin.data_ponpes', compact('ponpes'));
    }

    public function export()
    {
        return Excel::download(new PonpesExport, 'Data Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.xslx');
    }

    public function exportCSV()
    {
        return Excel::download(new PonpesExport, 'Data Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.csv');
    }
}
