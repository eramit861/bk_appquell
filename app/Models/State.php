<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'tbl_state';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'state_code','state_name','state_status'
    ];
    public function domesticaddress()
    {
        return $this->belongsTo(DomesticAddress::class, 'address_state', 'state_code');
    }

}
