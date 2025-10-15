<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LawFirmAssociate extends Model
{
    protected $table = 'tbl_attorney_associated_law_firms';
    public $timestamps = false;
    protected $fillable = [
        'attorney_id',
        'firstName',
        'lastName',
        'email',
        'phone_no',
        'created_at',
        'updated_at',
    ];

}
