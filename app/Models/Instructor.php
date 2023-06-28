<?php

namespace App\Models;

use App\Models\Ponpes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ponpes_id',
        'nik',
        'name',
        'gender',
        'expertise',
        'status',
    ];



    public function ponpes()
    {
        return $this->belongsTo(Ponpes::class);
    }
}
