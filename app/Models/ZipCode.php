<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    protected $table = 'tbl_zip_code';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'assign_forms' => 'array',
        "zip_code" => 'array',
    ];

}
