<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'media_type',
        'english_video_type',
        'english_video',
        'spanish_video_type',
        'spanish_video',
        'status'
    ];
}
