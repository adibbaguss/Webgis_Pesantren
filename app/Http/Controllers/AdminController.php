<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PonpesCount;
use App\Models\Report;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil data chart
        $chartData = $this->getChartData();

        // Mengambil data laporan
        $reports = Report::all();
        // Mengirim data ke view
        return view('admin.dashboard', compact('chartData', 'reports'));
    }

    private function getChartData()
    {
        $data1 = PonpesCount::select('year')
            ->selectSub(function ($query) {
                $query->selectRaw('SUM(count)')
                    ->from('ponpes_count AS t2')
                    ->whereRaw('t2.year <= ponpes_count.year');
            }, 'total_count')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $data2 = PonpesCount::select('count')->get();

        $chartData = [
            'labels' => $data1->pluck('year'),
            'total_count' => $data1->pluck('total_count'),
            'count' => $data2->pluck('count'),
        ];

        return $chartData;
    }

}
