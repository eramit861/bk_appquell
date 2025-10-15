<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateTrustee extends Model
{
    protected $table = 'tbl_state_trustee';
    public $timestamps = false;
    protected $fillable = [
        'state_code','trustee_name'
    ];

    public static function getTrustee($state_code)
    {
        $trustee = StateTrustee::where('state_code', $state_code)->select(['id','trustee_name'])->get();

        return !empty($trustee) ? $trustee->toArray() : [];
    }

}
