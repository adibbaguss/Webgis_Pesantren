<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportHistory extends Model
{
    use HasFactory;
    protected $table = 'report_histories';

    protected $fillable = [
        'report_id',
        'date',
        'status',
        'information',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }
}
