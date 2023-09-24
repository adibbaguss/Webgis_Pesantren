<?php

namespace App\Exports;

use App\Models\Facility;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FacilityExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Facility::get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NSPP',
            'Nama Pesantren',
            'Asrama Laki-laki',
            'Asrama Perempuan',
            'Masjid/Mushola',
            'Aula Kegiatan',
            'Ruang Pembelajaran',
            'Perpustakaan',
            'Kantor Pengajar',
            'Dapur',
            'Kantin',
            'Tempat Olahraga',
            'Kamar Mandi',
            'Ruang Kesehatan',
            'Kamar Pengajar',
            'Lab Komputer',
            'Lapangan Pertanian',
            'Lapangan Pertenakan',
            'Laundry',

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
        $sheet->getStyle('A1:S1')->applyFromArray($styleArray);

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
            $facility->ponpes->nspp,
            $facility->ponpes->name,
            (string) $facility->asrama_lk,
            (string) $facility->asrama_pr,
            (string) $facility->masjid,
            (string) $facility->aula_kegiatan,
            (string) $facility->ruang_pembelajaran,
            (string) $facility->perpustakaan,
            (string) $facility->kantor_pengajar,
            (string) $facility->dapur,
            (string) $facility->kantin,
            (string) $facility->tempat_olahraga,
            (string) $facility->kamar_mandi,
            (string) $facility->ruang_kesehatan,
            (string) $facility->kamar_pengajar,
            (string) $facility->lab_komputer,
            (string) $facility->lapangan_pertanian,
            (string) $facility->lapangan_pertenakan,
            (string) $facility->laundry,
        ];
    }

}
