<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponpes extends Model
{
    use HasFactory;
    protected $table = 'ponpes';

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
}
