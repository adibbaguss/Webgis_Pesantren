<?php

namespace App\Http\Controllers\Pelapor;

use App\Helpers\RandomIdGenerator;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PonpesReportController extends Controller
{
    public function report(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'ponpes_id' => 'required',
            'user_id' => 'required',
            'category_id' => 'required|max:20|',
            'title' => 'required|string',
            'description' => 'required|string|max:254',
        ]);

        try {
            // Generate a reporting code
            $reporting_code = RandomIdGenerator::generateUniqueId();

            // Create a new report record
            $report = new Report([
                'ponpes_id' => $request->input('ponpes_id'),
                'user_id' => $request->input('user_id'),
                'category_id' => $request->input('category_id'),
                'reporting_code' => $reporting_code,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);

            // Save the report
            $report->save();

            // Create a new report history entry
            $reportHistory = new ReportHistory([
                'report_id' => $report->id,
                'date' => Carbon::now(),
                'information' => 'Laporan baru dibuat',

            ]);

            // Save the report history
            $reportHistory->save();

            // Redirect with a success message
            return redirect()->back()->with('success', 'Berhasil Melakukan Laporan');
        } catch (\Exception $e) {
            // Handle any exceptions here
            Session::flash('error', 'Gagal Melakukan Laporan: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal Melakukan Laporan: ' . $e->getMessage()]);
        }

    }
}
