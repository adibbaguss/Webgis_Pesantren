<?php

namespace App\Exports;

use App\Models\Madin;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SdmMadinExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $currentYear = Carbon::now()->year;

        return Madin::with(['studentCount_madin' => function ($query) use ($currentYear) {
            $query->where('year', $currentYear);
        }])
            ->orderBy('subdistrict')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NSDT',
            'Nama Madin/TPQ',
            'Kecamatan',
            'Ustadz',
            'Ustadzah',
            'Murid (LK)',
            'Murid (PR)',
            'Total Pengajar',
            'Total Murid',
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
            'B' => '0', // Format column B (nsdt) as a number
            // Add more columns as needed, following the same pattern
        ];
    }

    public function map($madin): array
    {
        // Initialize the counter to 0
        static $i = 0;

        // Increment the counter
        $i++;

        return [
            $i,
            $madin->nsdt,
            $madin->name,
            $madin->subdistrict,

            $madin->instructors_madin->where('gender', 'Laki-laki')->where('status', 'active')->count() ? $madin->instructors_madin->where('gender', 'Laki-laki')->where('status', 'active')->count() ?? '0' : '0',
            $madin->instructors_madin->where('gender', 'Perempuan')->where('status', 'active')->count() ? $madin->instructors_madin->where('gender', 'Perempuan')->where('status', 'active')->count() ?? '0' : '0',

            $madin->studentCount_madin->sum('male') ? $madin->studentCount_madin->sum('male') ?? '0' : '0',
            $madin->studentCount_madin->sum('female') ? $madin->studentCount_madin->sum('female') ?? '0' : '0',
            $madin->studentCount_madin->sum('male_non_resident_count') ? $madin->studentCount_madin->sum('male_non_resident_count') ?? '0' : '0',
            $madin->studentCount_madin->sum('female_non_resident_count') ? $madin->studentCount_madin->sum('female_non_resident_count') ?? '0' : '0',
            $madin->instructors_madin->where('status', 'active')->count() ? $madin->instructors_madin->where('status', 'active')->count() ?? '0' : '0',
            $madin->studentCount_madin->sum('male') + $madin->studentCount_madin->sum('female') ? $madin->studentCount_madin->sum('male') + $madin->studentCount_madin->sum('female') ?? '0' : '0',
        ];
    }

}
