<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FillingInformation extends Model
{
    protected $table = 'tbl_filling_information';
    protected $fillable = [
        'client_id','basic_info','summary_of_schedule','meantest_information','import_to_system'
    ];
}
