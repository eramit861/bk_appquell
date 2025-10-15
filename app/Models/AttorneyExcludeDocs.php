<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttorneyExcludeDocs extends Model
{
    protected $table = 'tbl_attorney_exclude_doc_types';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'attorney_id','doc_type_json','updated_at','is_associate','created_at'
    ];

}
