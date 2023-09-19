<?php

namespace App\Models;

use App\Models\CategoryReport;
use App\Models\Ponpes;
use App\Models\ReportHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'ponpes_id',
        'user_id',
        'category_id',
        'reporting_code',
        'title',
        'description',
        'reporting_date',
        'status',
    ];

    // Relasi dengan model Ponpes
    public function ponpes()
    {
        return $this->belongsTo(Ponpes::class, 'ponpes_id');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan model CategoryReport
    public function category()
    {
        return $this->belongsTo(CategoryReport::class, 'category_id');
    }

    public function reportHistories()
    {
        return $this->hasMany(ReportHistory::class, 'report_id');
    }
}
