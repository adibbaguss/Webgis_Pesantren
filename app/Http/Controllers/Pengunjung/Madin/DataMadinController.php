<?php

namespace App\Http\Controllers\Pengunjung\Madin;

use App\Exports\MadinExport;
use App\Http\Controllers\Controller;
use App\Models\Madin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataMadinController extends Controller
{
    public function index()
    {
        $madin = Madin::orderBy('name')->get();

        return view('pengunjung.madin.data_madin', compact('madin'));

    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $madin = Madin::where('name', 'like', '%' . $query . '%')
            ->orWhere('city', 'like', '%' . $query . '%')
            ->orWhere('subdistrict', 'like', '%' . $query . '%')
            ->orderBy('name')
            ->get();

        return view('pengunjung.madin.data_madin', compact('madin'));
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
