<?php

namespace App\Models;

use App\Models\CategoryReportMadin;
use App\Models\Madin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportMadin extends Model
{
    use HasFactory;

    protected $table = 'reports_madin';

    protected $fillable = [
        'madin_id',
        'user_id',
        'category_id',
        'reporting_code',
        'title',
        'description',
        'reporting_date',
        'status',
    ];

    // Relasi dengan model madin
    public function madin()
    {
        return $this->belongsTo(Madin::class, 'madin_id');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan model CategoryReport
    public function categoryMadin()
    {
        return $this->belongsTo(CategoryReportMadin::class, 'category_id');
    }

    public function reportHistoriesMadin()
    {
        return $this->hasMany(ReportHistoryMadin::class, 'report_id');
    }
}
