<?php

namespace App\Http\Controllers\Admin_Madin;

use App\Http\Controllers\Controller;
use App\Models\Madin;
use App\Models\StudentCountMadin;
use App\Models\User;
use Carbon\Carbon;

// Don't forget to import the StudentCount model

class DashboardController extends Controller
{
    public function index($id)
    {
        // Find the admin_madin user by ID or throw a 404 error if not found
        $admin_madin = User::findOrFail($id);

        // Get the admin_madin's ID
        $admin_madin_id = $admin_madin->id;

        // Find the associated madin by user_id
        $madin = Madin::where('user_id', $admin_madin_id)->first();

        // Check if $madin is null and handle it gracefully (e.g., redirect or display an error)
        if (!$madin) {
            return redirect()->route('belum.direlasikan'); // Replace with your error handling logic
        }

        // Get chart data
        $chartData = $this->getChartStudent($admin_madin_id);

        return view('admin_madin.dashboard', compact('madin', 'chartData'));
    }

    public function getChartStudent($admin_madin_id)
    {
        // Mengambil data madin
        $madin = Madin::where('user_id', $admin_madin_id)->first();

        if (!$madin) {
            return null; // Handle the case where no madin is found for the given user_id
        }

        // Retrieve data from the database based on the given madin_id
        $studentCounts_madin = StudentCountMadin::where('madin_id', $madin->id)
            ->where('year', Carbon::now()->year)
            ->groupBy('year')
            ->selectRaw('year,
                SUM(male) as male,
                SUM(female) as female')
            ->get();

        $chartStudent = [
            'labels' => $studentCounts_madin->pluck('year'),
            'male' => $studentCounts_madin->pluck('male'),
            'female' => $studentCounts_madin->pluck('female'),
        ];

        return $chartStudent;
    }

}
