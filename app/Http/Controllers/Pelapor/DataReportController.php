<?php

namespace App\Http\Controllers\Pelapor;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataReportController extends Controller
{
    public function index($id)
    {
        $reports = Report::select('reports.id', 'reports.reporting_code', 'reports.title', 'reports.description', 'category_report.name as category_name', 'ponpes.name as ponpes_name', 'users.name as user_name')
            ->join('category_report', 'reports.category_id', '=', 'category_report.id')
            ->join('ponpes', 'reports.ponpes_id', '=', 'ponpes.id')
            ->join('users', 'reports.user_id', '=', 'users.id')
            ->with('reportHistories')
            ->where('reports.user_id', '=', $id)
            ->get();

        $user_id = $id;

        return view('pelapor.data_report', compact('reports', 'user_id'));
    }

    public function delete(Request $request, $id)
    {
        // Temukan data report berdasarkan ID
        $report = Report::findOrFail($id);

        // Pastikan data yang ingin dihapus sesuai dengan user_id yang sedang terautentikasi
        if ($report->user_id == Auth::user()->id) {
            // Lakukan penghapusan
            $report->delete();

            return redirect()->back()->with('success', 'Data report berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus data report ini');
        }
    }
}
