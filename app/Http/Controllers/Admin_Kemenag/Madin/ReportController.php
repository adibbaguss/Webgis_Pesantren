<?php

namespace App\Http\Controllers\Admin_Kemenag\Madin;

use App\Exports\ReportMadinExport;
use App\Http\Controllers\Controller;
use App\Models\ReportHistoryMadin;
use App\Models\ReportMadin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $reports = ReportMadin::select('reports_madin.id', 'reports_madin.reporting_code', 'reports_madin.title', 'reports_madin.description', 'category_report_madin.name as category_name', 'madin.name as madin_name', 'users.name as user_name')
            ->join('category_report_madin', 'reports_madin.category_id', '=', 'category_report_madin.id')
            ->join('madin', 'reports_madin.madin_id', '=', 'madin.id')
            ->join('users', 'reports_madin.user_id', '=', 'users.id')
            ->with('reportHistoriesMadin')
            ->get();

        return view('admin_kemenag.madin.data_report', compact('reports'));
    }

    public function update_status(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'report_id' => 'required|integer',
            'status' => 'required|in:baru,dalam proses,selesai,ditolak',
            'information' => 'required|string',
        ]);

        $validatedData['date'] = now();

        try {
            // Simpan data ke dalam tabel report_histories
            $reportHistory = ReportHistoryMadin::create($validatedData);
        } catch (\Exception $e) {
            // Tangani kesalahan saat penyimpanan data
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }

        // Jika berhasil, redirect atau berikan respons sukses
        return redirect()->back()->with('success', 'Status laporan berhasil diperbaharui');
    }

    public function export()
    {
        return Excel::download(new ReportMadinExport, 'Data Pelaporan Madin-' . Carbon::now()->timestamp . '.xlsx');
    }

}
