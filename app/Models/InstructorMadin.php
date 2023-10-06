<?php

namespace App\Models;

use App\Models\Madin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorMadin extends Model
{
    use HasFactory;

    protected $table = 'instructors_madin';

    protected $fillable = [
        'madin_id',
        'nik',
        'name',
        'gender',
        'expertise',
        'status',
    ];

    public function madin()
    {
        return $this->belongsTo(Madin::class);
    }
}
