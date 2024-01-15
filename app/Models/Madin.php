<?php

namespace App\Models;

use App\Models\ActivityMadin;
use App\Models\FacilityMadin;
use App\Models\ImageMadin;
use App\Models\InstructorMadin;
use App\Models\LearningMadin;
use App\Models\StudentCountMadin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Madin extends Model
{
    use HasFactory;
    protected $table = 'madin';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'nsdt',
        'name',
        'phone_number',
        'website',
        'email',
        'standing_date',
        'photo_profil',
        'pimpinan',
        'surface_area',
        'building_area',
        'city',
        'subdistrict',
        'postal_code',
        'address',
        'latitude',
        'longitude',
        'status',
    ];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activities_madin()
    {
        return $this->hasMany(ActivityMadin::class);
    }

    public function facility_madin()
    {
        return $this->hasMany(FacilityMadin::class);
    }

    public function learning_madin()
    {
        return $this->hasMany(LearningMadin::class);
    }

    public function instructors_madin()
    {
        return $this->hasMany(InstructorMadin::class);
    }

    public function images_madin()
    {
        return $this->hasMany(ImageMadin::class);
    }

    public function studentCount_madin()
    {
        return $this->hasMany(StudentCountMadin::class);
    }
}
