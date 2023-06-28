<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'ponpes_id',
        'name',
        'description',
    ];


    public function ponpes()
    {
        return $this->belongsTo(Ponpes::class);
    }
}
