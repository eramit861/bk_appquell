<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutOfPocketHealthCareExpnses extends Model
{
    use HasFactory;
    protected $table = 'out_of_pocket_health_care_expnses';
    public $timestamps = false;
    protected $fillable = [
        'Age','Out_of_Pocket_Costs','created_date','updated_date'
    ];
}
