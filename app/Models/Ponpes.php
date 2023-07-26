<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\Facility;
use App\Models\ImagePonpes;
use App\Models\Instructor;
use App\Models\Learning;
use App\Models\StudentCount;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponpes extends Model
{
    use HasFactory;
    protected $table = 'ponpes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'nspp',
        'name',
        'category',
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

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function facility()
    {
        return $this->hasMany(Facility::class);
    }

    public function learning()
    {
        return $this->hasMany(Learning::class);
    }

    public function instructors()
    {
        return $this->hasMany(Instructor::class);
    }

    public function images()
    {
        return $this->hasMany(ImagePonpes::class);
    }

    public function studentCount()
    {
        return $this->hasMany(StudentCount::class);
    }
}
