<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortFormNotes extends Model
{
    protected $table = 'tbl_short_form_notes';
    public $timestamps = false;
    protected $fillable = [
        'questionnaire_id',
        'attorney_id',
        'subject',
        'notes',
        'created_at',
        'updated_at'
    ];

}
