<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDocumentGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type',
        'original_name',
        's3_path',
        'file_extension',
        'file_size',
        'mime_type'
    ];
}
