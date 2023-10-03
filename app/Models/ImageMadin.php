<?php

namespace App\Models;

use App\Models\Madin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageMadin extends Model
{
    use HasFactory;

    protected $table = 'images_madin';

    protected $fillable = [
        'madin_id',
        'image_name',
        'type',
    ];

    public function madin()
    {
        return $this->belongsTo(Madin::class);
    }
}
