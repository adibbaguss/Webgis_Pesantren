<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PonpesCount extends Model
{
    use HasFactory;

    protected $table = 'ponpes_count';

    protected $fillable = [
        'year',
        'count',
    ];
}
