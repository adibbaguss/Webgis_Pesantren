<?php

namespace App\Exports;

use App\Models\Ponpes;
use App\Models\StudentCount;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SdmExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $currentYear = Carbon::now()->year;

        return Ponpes::with(['studentCount' => function ($query) use ($currentYear) {
            $query->where('year', $currentYear);
        }])
            ->orderBy('subdistrict')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NSPP',
            'Nama Pesantren',
            'Kecamatan',
            'Ustadz',
            'Ustadzah',
            'Santri Mukim',
            'Santriwati Mukim',
            'Santri Tidak Mukim',
            'Santriwati Tidak Mukim',
            'Total Pengajar',
            'Total Santri/wati Mukim',
            'Total Santri/wati Tidak Mukim',
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
            $ponpes->nspp,
            $ponpes->name,
            $ponpes->subdistrict,

            $ponpes->instructors->where('gender', 'Laki-laki')->where('status', 'active')->count() ? $ponpes->instructors->where('gender', 'Laki-laki')->where('status', 'active')->count() ?? '0' : '0',
            $ponpes->instructors->where('gender', 'Perempuan')->where('status', 'active')->count() ? $ponpes->instructors->where('gender', 'Perempuan')->where('status', 'active')->count() ?? '0' : '0',

            $ponpes->studentCount->sum('male_resident_count') ? $ponpes->studentCount->sum('male_resident_count') ?? '0' : '0',
            $ponpes->studentCount->sum('female_resident_count') ? $ponpes->studentCount->sum('female_resident_count') ?? '0' : '0',
            $ponpes->studentCount->sum('male_non_resident_count') ? $ponpes->studentCount->sum('male_non_resident_count') ?? '0' : '0',
            $ponpes->studentCount->sum('female_non_resident_count') ? $ponpes->studentCount->sum('female_non_resident_count') ?? '0' : '0',
            $ponpes->instructors->where('status', 'active')->count() ? $ponpes->instructors->where('status', 'active')->count() ?? '0' : '0',
            $ponpes->studentCount->sum('male_resident_count') + $ponpes->studentCount->sum('female_resident_count') ? $ponpes->studentCount->sum('male_resident_count') + $ponpes->studentCount->sum('female_resident_count') ?? '0' : '0',
            $ponpes->studentCount->sum('male_non_resident_count') + $ponpes->studentCount->sum('female_non_resident_count') ? $ponpes->studentCount->sum('male_non_resident_count') + $ponpes->studentCount->sum('female_non_resident_count') ?? '0' : '0',
        ];
    }

}
