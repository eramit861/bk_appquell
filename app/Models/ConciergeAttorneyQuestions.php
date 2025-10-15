<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConciergeAttorneyQuestions extends Model
{
    protected $table = 'tbl_concierge_attorney_question';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'attorney_id',
        'question',
        'created_at',
        'updated_at'
    ];

}
