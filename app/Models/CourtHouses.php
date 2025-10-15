<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtHouses extends Model
{
    protected $table = 'tbl_courthouses';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'courthouse_name','courthouse_address','courthouse_city','courthouse_state','courthouse_zip','courthouse_contact'
    ];

}
