<?php

namespace App\Http\Controllers\Admin_Kemenag;

use App\Http\Controllers\Controller;
use App\Models\Madin;
use App\Models\Ponpes;
use App\Models\Report;
use App\Models\ReportMadin;
use App\Models\StudentCount;
use App\Models\StudentCountMadin;
use App\Models\User;
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

        $madin = Madin::all();

        $studnetCountMadin = $this->getStudentCountMadin();

        $reportsMadin = ReportMadin::with('reportHistoriesMadin')->get();

        $chartDataMadin = $this->getChartDataMadin();

        $user = User::all();

        // Mengirim data ke view
        return view('admin_kemenag.dashboard', compact('chartData', 'chartDataMadin', 'reports', 'ponpes', 'madin', 'studentCount', 'reportsMadin', 'user'));
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

    private function getStudentCountMadin()
    {
        $currentYear = Carbon::now()->year;
        $studentCountMadin = StudentCountMadin::where('year', $currentYear)
            ->selectRaw('SUM(male +  female) as total_count')
            ->get();

        return $studentCountMadin;
    }

    private function getChartDataMadin()
    {
        $chartDataMadin = Madin::selectRaw('t1.tahun, t1.jumlah, SUM(t2.jumlah) AS total_count')
            ->from(function ($query) {
                $query->selectRaw('YEAR(standing_date) as tahun, COUNT(*) as jumlah')
                    ->from('madin')
                    ->groupBy('tahun')
                    ->orderBy('tahun', 'desc')
                    ->limit(10);
            }, 't1')
            ->joinSub(function ($query) {
                $query->selectRaw('YEAR(standing_date) as tahun, COUNT(*) as jumlah')
                    ->from('madin')
                    ->groupBy('tahun')
                    ->orderBy('tahun', 'desc') // Order by descending year
                    ->limit(10); // Limit to the last 10 years
            }, 't2', function ($join) {
                $join->on('t1.tahun', '>=', 't2.tahun');
            })
            ->groupBy('t1.tahun', 't1.jumlah')
            ->orderBy('t1.tahun', 'asc') // Order by descending year
            ->get();

        $chartDataMadin = [
            'labels' => $chartDataMadin->pluck('tahun'),
            'count' => $chartDataMadin->pluck('jumlah'),
            'total_count' => $chartDataMadin->pluck('total_count'),
        ];

        return $chartDataMadin;
    }
}
