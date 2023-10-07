<?php

namespace App\Http\Controllers\Admin_Kemenag\Madin;

use App\Exports\SdmMadinExport;
use App\Http\Controllers\Controller;
use App\Models\Madin;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class DataSdmController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;

        $madin = Madin::with(['studentCount_madin' => function ($query) use ($currentYear) {
            $query->where('year', $currentYear);
        }])
            ->orderBy('subdistrict')
            ->get();

        // Menghitung total instruktur laki-laki yang aktif
        $totalMaleInstructors = $madin->sum(function ($madin) {
            return $madin->instructors_madin->where('gender', 'Laki-laki')->where('status', 'active')->count();
        });

        // Menghitung total instruktur perempuan yang aktif
        $totalFemaleInstructors = $madin->sum(function ($madin) {
            return $madin->instructors_madin->where('gender', 'Perempuan')->where('status', 'active')->count();
        });

        $totalMaleStudent = $madin->sum(function ($madin) {
            return $madin->studentCount_madin->sum('male');
        });

        $totalFemaleStudent = $madin->sum(function ($madin) {
            return $madin->studentCount_madin->sum('female');
        });

        return view('admin_kemenag.madin.data_sdm_madin', compact(
            'madin',
            'currentYear',
            'totalMaleInstructors',
            'totalFemaleInstructors',
            'totalMaleStudent',
            'totalFemaleStudent',

        ));
    }

    public function exportXLSX()
    {
        return Excel::download(new SdmMadinExport, 'Data SDM Madin Kab.Batang-' . Carbon::now()->timestamp . '.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new SdmMadinExport, 'Data SDM Madin Kab.Batang-' . Carbon::now()->timestamp . '.csv');
    }

}
