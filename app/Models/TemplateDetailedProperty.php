<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateDetailedProperty extends Model
{
    protected $table = 'tbl_detailed_property_template';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'attorney_id',
        'data_household_goods_furnishings_items',
        'data_electronics_items',
        'data_collectibles_items',
        'data_sports_items',
        'data_everyday_and_fine_jewelry_items',
        'data_everyday_clothing_items',
        'data_firearms_items',
        'created_at',
        'updated_at'
    ];

}
