<?php

namespace App\Http\Controllers\Pelapor\Madin;

use App\Http\Controllers\Controller;
use App\Models\ReportMadin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataReportController extends Controller
{
    public function index($id)
    {
        $reports = ReportMadin::select('reports_madin.id', 'reports_madin.reporting_code', 'reports_madin.title', 'reports_madin.description', 'category_report_madin.name as category_name', 'madin.name as madin_name', 'users.name as user_name')
            ->join('category_report_madin', 'reports_madin.category_id', '=', 'category_report_madin.id')
            ->join('madin', 'reports_madin.madin_id', '=', 'madin.id')
            ->join('users', 'reports_madin.user_id', '=', 'users.id')
            ->with('reportHistoriesMadin')
            ->where('reports_madin.user_id', '=', $id)
            ->get();

        $user_id = $id;

        return view('pelapor.madin.data_report', compact('reports', 'user_id'));
    }

    public function delete(Request $request, $id)
    {
        // Temukan data report berdasarkan ID
        $report = ReportMadin::findOrFail($id);

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
