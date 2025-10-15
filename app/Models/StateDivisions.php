<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateDivisions extends Model
{
    protected $table = 'tbl_state_divisions';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'state_code','division_name','id_in_jubliee'
    ];

    public static function getDivisions($state_code)
    {
        $divisions = StateDivisions::where('state_code', $state_code)->select(['id','division_name','id_in_jubliee'])->get();

        return !empty($divisions) ? $divisions->toArray() : [];
    }

    public static function getIdInJubliee($id)
    {
        $divisions = StateDivisions::where('id', $id)->select(['id','id_in_jubliee'])->first();

        return !empty($divisions) ? $divisions->toArray() : [];
    }

}
