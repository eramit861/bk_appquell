<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttorneyAbTemplate extends Model
{
    protected $table = 'tbl_attorney_ab_template';
    protected $fillable = [
        'attorney_id','field_name','field_value','ab_data'
    ];
}
