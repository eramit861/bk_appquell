<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'tbl_template';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'attorney_id',
        'type',
        'data',
        'created_at',
        'updated_at'
    ];

}
