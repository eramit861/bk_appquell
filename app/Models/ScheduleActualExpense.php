<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleActualExpense extends Model
{
    use HasFactory;
    protected $table = 'schedule_actual_expenses';
    public $timestamps = false;
    protected $fillable = [
        'judicial_district','multiplier','status','created_date','updated_date'
    ];
}
