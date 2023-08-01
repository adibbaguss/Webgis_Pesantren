<?php

namespace App\Http\Controllers\Viewer;

use App\Helpers\RandomIdGenerator;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        // input

        $reporting_code = RandomIdGenerator::generateUniqueId();
        $report = new Report([
            'ponpes_id' => $request->input('ponpes_id'),
            'user_id' => $request->input('user_id'),
            'category_id' => $request->input('category_id'),
            'reporting_code' => $reporting_code,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'reporting_date' => Carbon::now(),
        ]);

        // Save
        $report->save();
        // dd($report);

        return redirect()->back()->with('success', 'Berhasil Melakukan Laporan');
    }

}
