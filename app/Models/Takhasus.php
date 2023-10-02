<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Takhasus extends Model
{
    use HasFactory;

    protected $table = 'takhasus';

    protected $fillable = [
        'ponpes_id',
        'name',
        'description',
    ];
}
