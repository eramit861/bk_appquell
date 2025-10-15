<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExemptionList extends Model
{
    protected $table = 'tbl_exemption_list';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'state_name','district_id','exemption_type','exemption_description','exemption_statute','exemption_limit'
    ];

}
