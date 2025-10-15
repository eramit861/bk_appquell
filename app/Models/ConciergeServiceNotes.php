<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConciergeServiceNotes extends Model
{
    protected $table = 'tbl_concierge_service_notes';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'created_at',
        'updated_at',
        'client_id',
        'subject',
        'note',
        'attachment_file',
        'added_by_id'
    ];

}
