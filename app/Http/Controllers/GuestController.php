<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use App\Models\StudentCount;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // map view
    public function index()
    {
        $ponpes = Ponpes::all();

        $ponpes2 = Ponpes::all();
        $data = Ponpes::select('subdistrict')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Salafiyah" THEN 1 ELSE 0 END) as salafiyah_count')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Khalafiyah" THEN 1 ELSE 0 END) as khalafiyah_count')
            ->selectRaw('SUM(CASE WHEN category = "Pesantren Kombinasi" THEN 1 ELSE 0 END) as kombinasi_count')
            ->selectRaw('SUM(CASE WHEN category IN ("Pesantren Salafiyah", "Pesantren Khalafiyah", "Pesantren Kombinasi") THEN 1 ELSE 0 END) as Total')
            ->groupBy('subdistrict')
            ->get();

        return view('guest.map_view', compact('ponpes', 'ponpes2', 'data'));
    }

    // data ponpes
    public function dataPonpes()
    {
        $ponpes = Ponpes::all();

        return view('guest.data_ponpes', compact('ponpes'));

    }

    public function ponpesSearch(Request $request)
    {
        $query = $request->input('query');

        $ponpes = Ponpes::where('name', 'like', '%' . $query . '%')
            ->orWhere('city', 'like', '%' . $query . '%')
            ->orWhere('subdistrict', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->get();

        return view('guest.data_ponpes', compact('ponpes'));
    }

    public function ponpesView($id)
    {
        // Mengambil data ponpes berdasarkan ID
        $ponpes = Ponpes::with('activities', 'facility', 'learning', 'instructors', 'images', 'studentCount', )
            ->find($id);
        // $user = User::all();

        if ($ponpes) {
            $activities = $ponpes->activities;
            $facility = $ponpes->facility;
            $learning = $ponpes->learning;
            $instructors = $ponpes->instructors;
            $image = $ponpes->images;
            $studentCount = $ponpes->studentCount->sortBy('year');

            $jumbotronImage = $image->where('type', 'jumbotron')->first();
            $regulerImages = $image->where('type', 'reguler');

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            // dd($studentCount);
            return view('guest.ponpes_view', compact('ponpes', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'jumbotronImage', 'regulerImages'));

        } else {
            abort(404);
        }
    }

    // statitik data
    public function ponpesStatistik()
    {
        $ponpes = Ponpes::all();

        $ChartDataPonpes = $this->getChartDataPonpes();
        $ChartDataJumlahPonpes = $this->getChartDataJumlahPonpes();
        $ChartDataStudent = $this->getChartDataStudent();

        return view('guest.data_statistik', compact('ponpes', 'ChartDataPonpes', 'ChartDataJumlahPonpes', 'ChartDataStudent'));
    }

    private function getChartDataPonpes()
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
            ->orderBy('year', 'desc') // Order by descending year
            ->limit(10) // Limit to the last 10 years
            ->get();

        // Reverse the order of retrieved data to make it ascending
        $reversedData = $data->reverse();

        $chartDataStudent = [
            'labels' => $reversedData->pluck('year'),
            'male_resident_count' => $reversedData->pluck('male_resident_count'),
            'female_resident_count' => $reversedData->pluck('female_resident_count'),
            'male_non_resident_count' => $reversedData->pluck('male_non_resident_count'),
            'female_non_resident_count' => $reversedData->pluck('female_non_resident_count'),
            'total' => $reversedData->pluck('total'),
        ];

        return $chartDataStudent;
    }

    // ponpes report guest

    // private function ponpesReport()
    // {
    //     return Redirect::route('login')->with('error', 'Anda Harus Login Terlebih Dahulu');
    // }
}
