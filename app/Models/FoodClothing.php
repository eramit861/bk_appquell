<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodClothing extends Model
{
    use HasFactory;
    protected $table = 'food_clothing';
    public $timestamps = false;
    protected $fillable = [
        'Expense_Type','OnePersonCost','TwoPersonCost','ThreePersonCost','FourPersonCost','AdditionalPersonCost','created_date','updated_date'
    ];
}
