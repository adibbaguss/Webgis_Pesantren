<?php

namespace App\Models;

use App\Models\Madin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCountMadin extends Model
{
    use HasFactory;

    protected $table = 'student_count_madin';

    protected $fillable = [
        'madin_id',
        'year',
        'male',
        'female',
    ];

    public function madin()
    {
        return $this->belongsTo(Madin::create());
    }
}
