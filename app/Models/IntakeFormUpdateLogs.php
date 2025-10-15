<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntakeFormUpdateLogs extends Model
{
    protected $table = 'tbl_intake_form_update_logs';
    public $timestamps = false;
    protected $fillable = [
        'form_id',
        'section_name',
        'old_json',
        'new_json',
        'added_by',
        'created_at',
        'updated_at',
    ];

}
