<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountyFipsData extends Model
{
    protected $table = 'tbl_county_fips';
    public $timestamps = true;
    protected $fillable = [
        'state_id','state_name','county_name','fips_code','fips_division'
    ];


    public static function get_county_by_state_name($statename)
    {
        $countyByStateName = \App\Models\CountyFipsData::where('state_name', $statename)->select(['id', 'county_name'])->get();
        $countyByStateName = !empty($countyByStateName) ? $countyByStateName->toArray() : [];

        return $countyByStateName;

    }
    public static function get_county_name_by_id($id)
    {
        $name = \App\Models\CountyFipsData::where('id', $id)->select('county_name')->first();
        $name = !empty($name) ? $name->toArray() : [];

        return $name['county_name'] ?? '';

    }
}
