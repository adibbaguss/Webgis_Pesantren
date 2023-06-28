<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryReport extends Model
{
    use HasFactory;

    protected $table = 'category_report'; // Menentukan nama tabel yang digunakan oleh model

    protected $fillable = [
        'name',
    ];
}
