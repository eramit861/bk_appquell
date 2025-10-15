<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeductionList extends Model
{
    protected $table = 'tbl_deduction_list';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = ['deduction_label', 'deduction_type','deduction_added_by','created_at','updated_at'];

}
