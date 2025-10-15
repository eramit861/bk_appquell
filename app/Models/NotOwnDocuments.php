<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotOwnDocuments extends Model
{
    use HasFactory;
    protected $table = 'tbl_not_own_documents';
    public $timestamps = false;
    protected $fillable = [
        'client_id','document_type','created_at','updated_at'
    ];
}
