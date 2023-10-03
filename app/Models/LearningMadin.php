<?php

namespace App\Models;

use App\Models\Madin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningMadin extends Model
{
    use HasFactory;

    protected $table = 'learning_madin';

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
