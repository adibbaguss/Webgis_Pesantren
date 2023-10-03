<?php

namespace App\Models;

use App\Models\Madin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityMadin extends Model
{
    use HasFactory;

    protected $fillable = [
        'madin_id',
        'name',
        'description',
    ];

    public function madin()
    {
        return $this->belongsTo(Madin::class);
    }
}
