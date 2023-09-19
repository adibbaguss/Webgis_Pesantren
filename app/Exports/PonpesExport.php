<?php

namespace App\Exports;

use App\Exports\PonpesExport;
use App\Models\Ponpes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PonpesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
        // Define the border style for the headings
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];

        // Apply the style to the entire heading row (row 1)
        $sheet->getStyle('A1:R1')->applyFromArray($styleArray);

        return [
            1 => ['font' => ['bold' => true]], // Make the heading row bold
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
