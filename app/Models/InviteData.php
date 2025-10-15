<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteData extends Model
{
    protected $table = 'tbl_invite_data';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'client_id',
        'client_hash',
        'created_at',
        'updated_at'
    ];
}
