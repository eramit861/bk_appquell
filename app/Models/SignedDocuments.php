<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignedDocuments extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_signed_documents';
    public $timestamps = false;
}
