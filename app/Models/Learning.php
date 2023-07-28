<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learning extends Model
{
    use HasFactory;

    protected $table = 'learning';

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
