<?php

namespace App\Exports;

use App\Models\FacilityMadin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FacilityMadinExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return FacilityMadin::get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NSDT',
            'Nama Madin/TPQ',
            'Mushola/Tempat Ibadah',
            'Ruang Kelas',
            'Perpustakaan',
            'Ruang Guru',
            'Fasilitas Audio Visual',
            'Kamar Mandi',
            'Ruamg Administrasi',

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

    public function map($facility): array
    {
        // Initialize the counter to 0
        static $i = 0;

        // Increment the counter
        $i++;

        return [
            $i,
            $facility->madin->nsdt,
            $facility->madin->name,
            (string) $facility->mushola,
            (string) $facility->kelas_pengajaran,
            (string) $facility->perpustakaan,
            (string) $facility->ruang_guru,
            (string) $facility->fasilitas_audio_visual,
            (string) $facility->kamar_mandi,
            (string) $facility->ruangan_administrasi,
        ];
    }

}
