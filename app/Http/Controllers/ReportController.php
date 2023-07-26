<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::select('reports.id', 'reports.reporting_code', 'reports.reporting_date', 'reports.title', 'reports.description', 'reports.status', 'category_report.name as category_name', 'ponpes.name as ponpes_name', 'users.name as user_name')
            ->join('category_report', 'reports.category_id', '=', 'category_report.id')
            ->join('ponpes', 'reports.ponpes_id', '=', 'ponpes.id')
            ->join('users', 'reports.user_id', '=', 'users.id')
            ->get();

        return view('admin.data_report', compact('reports'));
    }

    public function update(Request $request, $id)
    {
        // Lakukan validasi data yang diupdate, misalnya:
        $request->validate([
            'status' => ['required', 'string', 'max:255'],
        ]);

        // Lakukan proses update data berdasarkan ID yang diterima
        // Misalnya, jika menggunakan model Eloquent:
        $reports = Report::find($id);
        $reports->status = $request->status;
        $reports->save();

        // Tindakan setelah berhasil mengupdate data

        return redirect()->back()->with('success', 'Kode Laporan ' . $reports->reporting_code . '  berhasil di perbaharui menjadi status : ' . $reports->status);
    }

    public function export()
    {
        return Excel::download(new ReportExport, 'Data Pelaporan Pesantren-' . Carbon::now()->timestamp . '.xlsx');
    }

}
