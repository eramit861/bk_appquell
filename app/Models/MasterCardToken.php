<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterCardToken extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_matercard_token';
    public $timestamps = false;
}
