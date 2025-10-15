<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationIncome extends Model
{
    use HasFactory;
    protected $table = 'transportation_incomes';
    public $timestamps = false;
    protected $fillable = [
        'region','one_car_cost','two_car_cost','created_at','updated_at'
    ];

}
