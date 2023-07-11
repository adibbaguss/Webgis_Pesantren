<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use App\Models\PonpesCount;
use App\Models\Report;
use App\Models\StudentCount;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data chart
        $chartData = $this->getChartData();

        // Mengambil data laporan
        $reports = Report::all();

        // Mengambil data Ponpes
        $ponpes = Ponpes::all();

        // Mengambil data Student Count
        $studentCount = $this->getStudentCount();

        // Mengirim data ke view
        return view('admin.dashboard', compact('chartData', 'reports', 'ponpes', 'studentCount'));
    }

    private function getChartData()
    {
        $data1 = PonpesCount::select('year')
            ->selectSub(function ($query) {
                $query
                    ->selectRaw('SUM(count)')
                    ->from('ponpes_count AS t2')
                    ->whereRaw('t2.year <= ponpes_count.year');
            }, 'total_count')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $data2 = PonpesCount::select('year')
            ->selectRaw('SUM(count) as count')
            ->groupBy('year')
            ->get();

        $chartData = [
            'labels' => $data1->pluck('year'),
            'total_count' => $data1->pluck('total_count'),
            'count' => $data2->pluck('count'),
        ];

        return $chartData;
    }

    private function getStudentCount()
    {
        $currentYear = Carbon::now()->year;
        $studentCount = StudentCount::where('year', $currentYear)
            ->selectRaw('SUM(male_resident_count + female_resident_count + male_non_resident_count + female_non_resident_count) as total_count')
            ->get();

        return $studentCount;
    }
}
