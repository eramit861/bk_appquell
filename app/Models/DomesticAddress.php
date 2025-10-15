<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomesticAddress extends Model
{
    protected $table = 'tbl_domestic_support_addresses';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'address_name','address_street','address_state'
    ];
    public function state()
    {
        return $this->hasOne(State::class, 'state_code', 'address_state');
    }

}
