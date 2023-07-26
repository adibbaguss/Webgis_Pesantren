<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Report::select('reports.id', 'reports.reporting_code', 'reports.reporting_date', 'reports.title', 'reports.description', 'reports.status', 'category_report.name as category_name', 'ponpes.name as ponpes_name', 'users.name as user_name')
            ->join('category_report', 'reports.category_id', '=', 'category_report.id')
            ->join('ponpes', 'reports.ponpes_id', '=', 'ponpes.id')
            ->join('users', 'reports.user_id', '=', 'users.id')
            ->get();
    }
    public function headings(): array
    {
        return [
            'No',
            'Kode Pelaporan',
            'Tanggal Masuk',
            'Palapor',
            'Pesantren',
            'Kategori',
            'Judul',
            'Deskripsi',
            'Status',
        ];
    }

    public function map($report): array
    {
        // Kustomisasi urutan data di sini
        static $i = 1;
        return [
            $i++,
            $report->reporting_code,
            $report->reporting_date,
            $report->user_name,
            $report->ponpes_name,
            $report->category_name,
            $report->title,
            $report->description,
            $report->status,

        ];
    }
}
