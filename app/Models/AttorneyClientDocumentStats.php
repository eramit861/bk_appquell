<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttorneyClientDocumentStats extends Model
{
    protected $table = 'tbl_attorney_client_doc_stats';
    public $timestamps = false;
    protected $fillable = [
        'client_id',
        'file',
        'viewed_at',
        'created_at',
        'updated_at'
    ];

}
