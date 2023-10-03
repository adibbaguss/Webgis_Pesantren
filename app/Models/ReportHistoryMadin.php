<?php

namespace App\Models;

use App\Models\ReportMadin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportHistoryMadin extends Model
{
    use HasFactory;
    protected $table = 'report_histories_madin';

    protected $fillable = [
        'report_id',
        'date',
        'status',
        'information',
    ];

    public function report()
    {
        return $this->belongsTo(ReportMadin::class, 'report_id');
    }
}
