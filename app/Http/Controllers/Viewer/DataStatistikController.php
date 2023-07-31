<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use App\Models\StudentCount;

class DataStatistikController extends Controller
{
    public function index()
    {
        $ponpes = Ponpes::all();

        $ChartDataPonpes = $this->getChartDataPonpes();
        $ChartDataJumlahPonpes = $this->getChartDataJumlahPonpes();
        $ChartDataStudent = $this->getChartDataStudent();

        return view('viewer.data_statistik', compact('ponpes', 'ChartDataPonpes', 'ChartDataJumlahPonpes', 'ChartDataStudent'));
    }

    private function getChartDataPonpes()
    {
        $chartData = Ponpes::selectRaw('t1.tahun, t1.jumlah, SUM(t2.jumlah) AS total_count')
            ->from(function ($query) {
                $query->selectRaw('YEAR(standing_date) as tahun, COUNT(*) as jumlah')
                    ->from('ponpes')
                    ->groupBy('tahun');
            }, 't1')
            ->joinSub(function ($query) {
                $query->selectRaw('YEAR(standing_date) as tahun, COUNT(*) as jumlah')
                    ->from('ponpes')
                    ->groupBy('tahun');
            }, 't2', function ($join) {
                $join->on('t1.tahun', '>=', 't2.tahun');
            })
            ->groupBy('t1.tahun', 't1.jumlah')
            ->orderBy('t1.tahun')
            ->get();

        $ChartDataPonpes = [
            'labels' => $chartData->pluck('tahun'),
            'count' => $chartData->pluck('jumlah'),
            'total_count' => $chartData->pluck('total_count'),
        ];

        return $ChartDataPonpes;
    }

    private function getChartDataJumlahPonpes()
    {
        $data = Ponpes::select('subdistrict')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Salafiyah" THEN 1 ELSE 0 END) as salafiyah_count')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Khalafiyah" THEN 1 ELSE 0 END) as khalafiyah_count')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Kombinasi" THEN 1 ELSE 0 END) as kombinasi_count')
            ->selectRaw('SUM(CASE WHEN category IN ("Pesantren Salafiyah", "Pesantren Khalafiyah", "Pesantren Kombinasi") THEN 1 ELSE 0 END) as Total')
            ->groupBy('subdistrict')
            ->get();

        $ChartDataJumlahPonpes = [
            'labels' => $data->pluck('subdistrict'),
            'salafiyah' => $data->pluck('salafiyah_count'),
            'khalafiyah' => $data->pluck('khalafiyah_count'),
            'kombinasi' => $data->pluck('kombinasi_count'),
            'total' => $data->pluck('Total'),
        ];

        return $ChartDataJumlahPonpes;
    }

    private function getChartDataStudent()
    {
        $data = StudentCount::select('year')
            ->selectRaw('SUM(male_resident_count) AS male_resident_count')
            ->selectRaw('SUM(female_resident_count) AS female_resident_count')
            ->selectRaw('SUM(male_non_resident_count) AS male_non_resident_count')
            ->selectRaw('SUM(female_non_resident_count) AS female_non_resident_count')
            ->selectRaw('SUM(male_resident_count + male_non_resident_count + female_resident_count + female_non_resident_count) as total')
            ->groupBy('year')
            ->get();

        $chartDataStudent = [
            'labels' => $data->pluck('year'),
            'male_resident_count' => $data->pluck('male_resident_count'),
            'female_resident_count' => $data->pluck('female_resident_count'),
            'male_non_resident_count' => $data->pluck('male_non_resident_count'),
            'female_non_resident_count' => $data->pluck('female_non_resident_count'),
            'total' => $data->pluck('total'),
        ];

        return $chartDataStudent;
    }

}
