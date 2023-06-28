<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'email',
        'name',
        'photo_profil',
        'phone_number',
        'user_type',
        'email_verified_at',
        'remember_token',
    ];
}
