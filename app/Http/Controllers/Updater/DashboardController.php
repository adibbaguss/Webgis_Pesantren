<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use App\Models\StudentCount;
use App\Models\User;
use Carbon\Carbon;

// Don't forget to import the StudentCount model

class DashboardController extends Controller
{
    public function index($id)
    {
        $updater = User::findOrFail($id);
        $updater_id = $updater->id;

        // Mengambil data Ponpes
        $ponpes = Ponpes::all()->where('user_id', $updater_id)->first();

        // Get chart data
        $chartData = $this->getChartStudent($updater_id);

        return view('updater.dashboard', compact('ponpes', 'chartData'));
    }

    public function getChartStudent($updater_id)
    {
        // Mengambil data Ponpes
        $ponpes = Ponpes::all()->where('user_id', $updater_id)->first();

        // Retrieve data from the database based on the given ponpes_id
        $studentCounts = StudentCount::where('ponpes_id', $ponpes->id)
            ->where('year', Carbon::now()->year)
            ->get();

        $chartStudent = [
            'labels' => $studentCounts->pluck('year'),
            'male_resident_count' => $studentCounts->pluck('male_resident_count'),
            'female_resident_count' => $studentCounts->pluck('female_resident_count'),
            'male_non_resident_count' => $studentCounts->pluck('male_non_resident_count'),
            'female_non_resident_count' => $studentCounts->pluck('female_non_resident_count'),
        ];

        return $chartStudent;
    }
}
