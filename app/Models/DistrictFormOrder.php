<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictFormOrder extends Model
{
    use HasFactory;
    protected $fillable = ['district_id', 'form_id', 'default_check', 'local_form_id', 'local_check',];
}
