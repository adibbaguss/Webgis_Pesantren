<?php

namespace App\Models;

use App\Models\Ponpes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCount extends Model
{
    use HasFactory;

    protected $table = 'student_count';

    protected $fillable = [
        'ponpes_id',
        'year',
        'male_resident_count',
        'female_resident_count',
        'male_non_resident_count',
        'female_non_resident_count',
    ];

    public function ponpes()
    {
        return $this->belongsTo(Ponpes::create());
    }
}
