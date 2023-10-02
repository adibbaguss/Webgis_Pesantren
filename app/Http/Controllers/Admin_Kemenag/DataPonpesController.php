<?php

namespace App\Http\Controllers\Admin_Kemenag;

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
        $ponpes = Ponpes::orderBy('name')->get();

        return view('admin_kemenag.data_ponpes', compact('ponpes'));

    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $ponpes = Ponpes::where('name', 'like', '%' . $query . '%')
            ->orWhere('city', 'like', '%' . $query . '%')
            ->orWhere('subdistrict', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->orderBy('name')
            ->get();

        return view('admin_kemenag.data_ponpes', compact('ponpes'));
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
