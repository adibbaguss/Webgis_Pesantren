<?php

namespace App\Http\Controllers\Admin_Kemenag;

use App\Exports\SdmExport;
use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use App\Models\StudentCount;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class DataSdmController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;

        $ponpes = Ponpes::with(['studentCount' => function ($query) use ($currentYear) {
            $query->where('year', $currentYear);
        }])
            ->orderBy('subdistrict')
            ->get();

        // Menghitung total instruktur laki-laki yang aktif
        $totalMaleInstructors = $ponpes->sum(function ($ponpes) {
            return $ponpes->instructors->where('gender', 'Laki-laki')->where('status', 'active')->count();
        });

        // Menghitung total instruktur perempuan yang aktif
        $totalFemaleInstructors = $ponpes->sum(function ($ponpes) {
            return $ponpes->instructors->where('gender', 'Perempuan')->where('status', 'active')->count();
        });

        // Menghitung total santri mukim
        $studentCounts = StudentCount::where('year', $currentYear)->get();

        $totalMaleResidents = $studentCounts->sum('male_resident_count');

        // Menghitung total santriwati mukim
        $totalFemaleResidents = $studentCounts->sum('female_resident_count');

        // Menghitung total santri tidak mukim
        $totalMaleNonResidents = $studentCounts->sum('male_non_resident_count');

        // Menghitung total santriwati tidak mukim
        $totalFemaleNonResidents = $studentCounts->sum('female_non_resident_count');

        return view('admin_kemenag.data_sdm_ponpes', compact(
            'ponpes',
            'currentYear',
            'totalMaleInstructors',
            'totalFemaleInstructors',
            'totalMaleResidents',
            'totalFemaleResidents',
            'totalMaleNonResidents',
            'totalFemaleNonResidents'
        ));
    }

    public function exportXLSX()
    {
        return Excel::download(new SdmExport, 'Data SDM Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new SdmExport, 'Data SDM Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.csv');
    }

}
