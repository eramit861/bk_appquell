<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAbQuestions extends Model
{
    protected $table = 'tbl_client_ab_html_questions';
    protected $fillable = [
        'client_id','field_name','field_value','ab_data'
    ];
}
