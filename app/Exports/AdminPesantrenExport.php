<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdminPesantrenExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::with('ponpes')
            ->where('user_role', 'admin pesantren')
            ->get();
    }
    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Username',
            'Alamat Email',
            'Nomor Telepon',
            'Pesantren',
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

    public function map($account): array
    {
        // Kustomisasi urutan data di sini
        static $i = 1;
        return [
            $i++,
            $account->name,
            $account->username,
            $account->email,
            $account->phone_number,
            $account->ponpes ? $account->ponpes->name : 'null',
            $account->created_at,
            $account->status,

        ];
    }
}
