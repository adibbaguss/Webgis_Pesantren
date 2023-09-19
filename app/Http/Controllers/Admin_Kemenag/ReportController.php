<?php

namespace App\Http\Controllers\Admin_Kemenag;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::select('reports.id', 'reports.reporting_code', 'reports.title', 'reports.description', 'category_report.name as category_name', 'ponpes.name as ponpes_name', 'users.name as user_name')
            ->join('category_report', 'reports.category_id', '=', 'category_report.id')
            ->join('ponpes', 'reports.ponpes_id', '=', 'ponpes.id')
            ->join('users', 'reports.user_id', '=', 'users.id')
            ->with('reportHistories')
            ->get();

        return view('admin_kemenag.data_report', compact('reports'));
    }

    // public function update(Request $request, $id)
    // {
    //     // Lakukan validasi data yang diupdate, misalnya:
    //     $request->validate([
    //         'status' => ['required', 'string', 'max:255'],
    //     ]);

    //     // Lakukan proses update data berdasarkan ID yang diterima
    //     // Misalnya, jika menggunakan model Eloquent:
    //     $reports = Report::find($id);
    //     $reports->status = $request->status;
    //     $reports->save();

    //     // Tindakan setelah berhasil mengupdate data

    //     return redirect()->back()->with('success', 'Kode Laporan ' . $reports->reporting_code . '  berhasil di perbaharui menjadi status : ' . $reports->status);
    // }

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
            $reportHistory = ReportHistory::create($validatedData);
        } catch (\Exception $e) {
            // Tangani kesalahan saat penyimpanan data
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }

        // Jika berhasil, redirect atau berikan respons sukses
        return redirect()->back()->with('success', 'Status laporan berhasil diperbaharui');
    }

    public function export()
    {
        return Excel::download(new ReportExport, 'Data Pelaporan Pesantren-' . Carbon::now()->timestamp . '.xlsx');
    }

}
