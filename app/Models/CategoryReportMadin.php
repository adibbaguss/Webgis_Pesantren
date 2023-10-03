<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryReportMadin extends Model
{
    use HasFactory;

    protected $table = 'category_report_madin'; // Menentukan nama tabel yang digunakan oleh model

    protected $fillable = [
        'name',
    ];
}
