<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttorneyExcludeDocsPerClient extends Model
{
    protected $table = 'tbl_att_exclude_doc_per_client';
    public $timestamps = false;
    protected $fillable = [
        'client_id',
        'attorney_id',
        'doc_type_json',
        'created_at',
        'updated_at'
    ];
}
