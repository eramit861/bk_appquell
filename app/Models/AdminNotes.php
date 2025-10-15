<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotes extends Model
{
    protected $table = 'tbl_admin_notes';
    public $timestamps = false;
    protected $fillable = [
        'adm_id',
        'client_id',
        'note',
        'created_at',
        'updated_at'
    ];

}
