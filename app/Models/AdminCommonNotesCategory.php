<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminCommonNotesCategory extends Model
{
    protected $table = 'tbl_common_notes_category';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'category',
        'created_at',
        'updated_at'
    ];

}
