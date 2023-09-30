<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $table = 'schools';

    protected $fillable = [
        'ponpes_id',
        'sd',
        'smp',
        'sma',
        'smk',
        'pt',
    ];

    public function ponpes()
    {
        return $this->belongsTo(Ponpes::class);
    }
}
