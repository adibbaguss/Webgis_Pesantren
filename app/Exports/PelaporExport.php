<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PelaporExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return User::where('user_role', 'pelapor')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Username',
            'Alamat Email',
            'Nomor Telepon',
            'Dibuat',
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

    public function map($user): array
    {
        // Kustomisasi urutan data di sini
        static $i = 1;
        return [
            $i++,
            $user->name,
            $user->username,
            $user->email,
            $user->phone_number,
            $user->created_at,
            $user->status,
        ];
    }
}
