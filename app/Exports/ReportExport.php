<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Report::select(
            'rh.date as tanggal',
            'reports.reporting_code as kode',
            'users.name as pelapor',
            'ponpes.name as pesantren',
            'category_report.name as kategori',
            'reports.title as judul',
            'reports.description as deskripsi',

            'rh.status as status',
            'rh.information as keterangan'
        )
            ->join('category_report', 'reports.category_id', '=', 'category_report.id')
            ->join('ponpes', 'reports.ponpes_id', '=', 'ponpes.id')
            ->join('users', 'reports.user_id', '=', 'users.id')
            ->leftJoin('report_histories as rh', 'reports.id', '=', 'rh.report_id')
            ->get()
            ->sortBy('tanggal');
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Diubah',
            'Kode',
            'Nama Pelapor',
            'Pesantren',
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
            $report->pesantren,
            $report->kategori,
            $report->judul,
            $report->deskripsi,
            $report->status,
            $report->keterangan,
        ];
    }

}
