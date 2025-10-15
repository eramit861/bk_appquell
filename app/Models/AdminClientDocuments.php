<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminClientDocuments extends Model
{
    protected $table = 'tbl_admin_client_documents';
    public $timestamps = false;
    protected $fillable = [
        'client_id',
        'document_name',
        'document_type',
        'added_by',
        'created_at',
        'updated_at'
    ];

}
