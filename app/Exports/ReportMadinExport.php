<?php

namespace App\Exports;

use App\Models\ReportMadin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportMadinExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ReportMadin::select(
            'rh.date as tanggal',
            'reports_madin.reporting_code as kode',
            'users.name as pelapor',
            'madin.name as madrasah',
            'category_report_madin.name as kategori',
            'reports_madin.title as judul',
            'reports_madin.description as deskripsi',

            'rh.status as status',
            'rh.information as keterangan'
        )
            ->join('category_report_madin', 'reports_madin.category_id', '=', 'category_report_madin.id')
            ->join('madin', 'reports_madin.madin_id', '=', 'madin.id')
            ->join('users', 'reports_madin.user_id', '=', 'users.id')
            ->leftJoin('report_histories_madin as rh', 'reports_madin.id', '=', 'rh.report_id')
            ->orderBy('tanggal') // Mengganti sortBy() menjadi orderBy() untuk mengurutkan hasil query
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Diubah',
            'Kode',
            'Nama Pelapor',
            'Madin/TPQ',
            'Kategori',
            'Judul',
            'Deskripsi',
            'Status Terakhir',
            'Keterangan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Define the border style for the entire data range
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN, // Set the border style to thin
                ],
            ],
        ];

        // Apply the style to the entire data range
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray($styleArray);

        return [
            1 => ['font' => ['bold' => true]], // Make the heading row bold
        ];
    }

    public function map($report): array
    {
        static $i = 1;
        return [
            $i++,
            $report->tanggal,
            $report->kode,
            $report->pelapor,
            $report->madrasah,
            $report->kategori,
            $report->judul,
            $report->deskripsi,
            $report->status,
            $report->keterangan,
        ];
    }

}
