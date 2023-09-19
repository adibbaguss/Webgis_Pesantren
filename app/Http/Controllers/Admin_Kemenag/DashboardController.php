<?php

namespace App\Http\Controllers\Admin_Kemenag;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
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
        $reports = Report::with('reportHistories')->get();

        // Mengambil data Ponpes
        $ponpes = Ponpes::all();

        // Mengambil data Student Count
        $studentCount = $this->getStudentCount();

        // Mengirim data ke view
        return view('admin_kemenag.dashboard', compact('chartData', 'reports', 'ponpes', 'studentCount', 'ponpes'));
    }

    private function getChartData()
    {
        $chartData = Ponpes::selectRaw('t1.tahun, t1.jumlah, SUM(t2.jumlah) AS total_count')
            ->from(function ($query) {
                $query->selectRaw('YEAR(standing_date) as tahun, COUNT(*) as jumlah')
                    ->from('ponpes')
                    ->groupBy('tahun')
                    ->orderBy('tahun', 'desc')
                    ->limit(10);
            }, 't1')
            ->joinSub(function ($query) {
                $query->selectRaw('YEAR(standing_date) as tahun, COUNT(*) as jumlah')
                    ->from('ponpes')
                    ->groupBy('tahun')
                    ->orderBy('tahun', 'desc') // Order by descending year
                    ->limit(10); // Limit to the last 10 years
            }, 't2', function ($join) {
                $join->on('t1.tahun', '>=', 't2.tahun');
            })
            ->groupBy('t1.tahun', 't1.jumlah')
            ->orderBy('t1.tahun', 'asc') // Order by descending year
            ->get();

        $chartData = [
            'labels' => $chartData->pluck('tahun'),
            'count' => $chartData->pluck('jumlah'),
            'total_count' => $chartData->pluck('total_count'),
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
