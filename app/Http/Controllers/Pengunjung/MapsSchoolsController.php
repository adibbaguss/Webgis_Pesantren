<?php

namespace App\Http\Controllers\Pengunjung;

use App\Exports\SchoolExport;
use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MapsSchoolsController extends Controller
{

    private $attributeNames = [
        'sd' => 'SD/MI',
        'smp' => 'SMP/MTs',
        'sma' => 'SMA/MA',
        'smk' => 'SMK',
        'pt' => 'Perguruan Tinggi',
    ];

    private $attributeTable = [
        'sd', 'smp', 'sma', 'smk', 'pt',
    ];

    private function countAttributes($ponpes)
    {
        $counts = [
            'sdCount' => 0,
            'smpCount' => 0,
            'smaCount' => 0,
            'smkCount' => 0,
            'ptCount' => 0,
        ];

        foreach ($ponpes as $ponpesModel) {
            $school = $ponpesModel->school;

            if (!empty($school->sd)) {
                $counts['sdCount']++;
            }

            if (!empty($school->smp)) {
                $counts['smpCount']++;
            }

            if (!empty($school->sma)) {
                $counts['smaCount']++;
            }

            if (!empty($school->smk)) {
                $counts['smkCount']++;
            }

            if (!empty($school->pt)) {
                $counts['ptCount']++;
            }
        }

        return $counts;
    }

    public function index()
    {

        $attributeNames = $this->attributeNames;
        $attributeTable = $this->attributeTable;
        $ponpes = Ponpes::with('school')->get()->sortBy('subdistrict');
        $schools = School::with('ponpes')->get();
        // dd($ponpes);

        // Add the code to count the attributes
        $counts = $this->countAttributes($ponpes);

        return view('pengunjung.map_school', compact('ponpes', 'attributeNames', 'attributeTable', 'counts', 'schools'));
    }

    public function search(Request $request)
    {
        $attribute = $request->input('attribute');

        // Check if the tingkat is empty before executing the query
        if (in_array($attribute, ['school', 'another_relationship'])) {
            $ponpes = Ponpes::with($attribute)->get()->sortBy('subdistrict');
        } else {
            // Handle the case when an invalid or unsupported attribute is provided
            // For example, you can show an error message or fallback to a default behavior.
            $ponpes = Ponpes::with('school')->get()->sortBy('subdistrict');
        }
        $schools = School::with('ponpes')->get();
        // Add the code to count the attributes
        $counts = $this->countAttributes($ponpes);

        $attributeNames = $this->attributeNames;
        $attributeTable = $this->attributeTable;
        return view('pengunjung.map_school', compact('ponpes', 'attribute', 'attributeNames', 'attributeTable', 'counts', 'schools'));

    }

    public function exportXLSX()
    {
        return Excel::download(new SchoolExport, 'Data Sekolah milik Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new SchoolExport, 'Data Sekolah milik Ponpes Kab.Batang-' . Carbon::now()->timestamp . '.csv');
    }

}
