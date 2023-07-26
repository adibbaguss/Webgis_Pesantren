<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }
    public function headings(): array
    {
        return [
            'No',
            'Role',
            'Nama',
            'Username',
            'Alamat Email',
            'Nomor Telepon',
            'Dibuat',
        ];
    }

    public function map($account): array
    {
        // Kustomisasi urutan data di sini
        static $i = 1;
        return [
            $i++,
            $account->user_role,
            $account->name,
            $account->username,
            $account->email,
            $account->phone_number,
            $account->created_at,

        ];
    }
}
