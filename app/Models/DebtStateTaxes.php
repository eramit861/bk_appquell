<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DebtStateTaxes extends Model
{
    protected $table = 'tbl_debt_state_taxes';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'stax_name','stax_address1','stax_address2','stax_address3','stax_city','stax_state','stax_zip','stax_contact'
    ];

}
