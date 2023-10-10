<?php

namespace App\Http\Controllers\Admin_Pesantren;

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
        // Find the admin_pesantren user by ID or throw a 404 error if not found
        $admin_pesantren = User::findOrFail($id);

        // Get the admin_pesantren's ID
        $admin_pesantren_id = $admin_pesantren->id;

        // Find the associated Ponpes by user_id
        $ponpes = Ponpes::where('user_id', $admin_pesantren_id)->first();

        // Check if $ponpes is null and handle it gracefully (e.g., redirect or display an error)
        if (!$ponpes) {
            return redirect()->route('belum.direlasikan'); // Replace with your error handling logic
        }

        // Get chart data
        $chartData = $this->getChartStudent($admin_pesantren_id);

        return view('admin_pesantren.dashboard', compact('ponpes', 'chartData'));
    }

    public function getChartStudent($admin_pesantren_id)
    {
        // Mengambil data Ponpes
        $ponpes = Ponpes::where('user_id', $admin_pesantren_id)->first();

        if (!$ponpes) {
            return null; // Handle the case where no Ponpes is found for the given user_id
        }

        // Retrieve data from the database based on the given ponpes_id
        $studentCounts = StudentCount::where('ponpes_id', $ponpes->id)
            ->where('year', Carbon::now()->year)
            ->groupBy('year')
            ->selectRaw('year,
                SUM(male_resident_count) as male_resident_count,
                SUM(female_resident_count) as female_resident_count,
                SUM(male_non_resident_count) as male_non_resident_count,
                SUM(female_non_resident_count) as female_non_resident_count')
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
