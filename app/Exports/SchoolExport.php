<?php

namespace App\Exports;

use App\Models\Ponpes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SchoolExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Ponpes::orderBy('subdistrict')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pesantren',
            'Kecamatan',
            'SD/MI',
            'SMP/MTs',
            'SMA/MA',
            'SMK',
            'Perguruan Tinggi',
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

    public function columnFormats(): array
    {
        return [
            'B' => '0', // Format column B (NSPP) as a number
            // Add more columns as needed, following the same pattern
        ];
    }

    public function map($ponpes): array
    {
        // Initialize the counter to 0
        static $i = 0;

        // Increment the counter
        $i++;

        return [
            $i,
            $ponpes->name,
            $ponpes->subdistrict,
            $ponpes->school ? $ponpes->school->sd ?? '' : '', // Check if $ponpes->school is not null
            $ponpes->school ? $ponpes->school->smp ?? '' : '',
            $ponpes->school ? $ponpes->school->sma ?? '' : '',
            $ponpes->school ? $ponpes->school->smk ?? '' : '',
            $ponpes->school ? $ponpes->school->pt ?? '' : '',

        ];
    }

}
