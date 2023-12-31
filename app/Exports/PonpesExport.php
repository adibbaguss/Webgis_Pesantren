<?php

namespace App\Exports;

use App\Exports\PonpesExport;
use App\Models\Ponpes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PonpesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        return Ponpes::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'NSPP',
            'Nama Pesantren',
            'Kategori',
            'Pimpinan/Pengasuh',
            'Nomor Telepon',
            'Email',
            'Website',
            'Tahun Berdiri',
            'Luas Wilayah',
            'Luas Bangunan',
            'Kota/Kabupaten',
            'Kecamatan',
            'Kode Pos',
            'Alamat',
            'Latitude',
            'Longitude',
            'Status',
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
        // Kustomisasi urutan data di sini
        static $i = 1;
        return [
            $i++,
            $ponpes->nspp,
            $ponpes->name,
            $ponpes->category,
            $ponpes->pimpinan,
            $ponpes->phone_number,
            $ponpes->email,
            $ponpes->website,
            $ponpes->standing_date,
            $ponpes->surface_area,
            $ponpes->building_area,
            $ponpes->city,
            $ponpes->subdistrict,
            $ponpes->postal_code,
            $ponpes->address,
            $ponpes->latitude,
            $ponpes->longitude,
            $ponpes->status,

        ];
    }
}
