<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePonpes extends Model
{
    use HasFactory;
    protected $table = 'images_ponpes';

    protected $fillable = [
        'ponpes_id',
        'image',
        'title',
        'type',
    ];

    public function ponpes()
    {
        return $this->belongsTo(Ponpes::class);
    }

}
