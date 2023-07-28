<?php

namespace App\Models;

use App\Models\Ponpes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'facility';

    protected $fillable = [
        'ponpes_id',
        'name',
        'count',
    ];

    public function ponpes()
    {
        return $this->belongsTo(Ponpes::class);
    }
}
