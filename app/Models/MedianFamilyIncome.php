<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedianFamilyIncome extends Model
{
    use HasFactory;
    protected $table = 'median_family_incomes';
    public $timestamps = false;
    protected $fillable = [
        'state','one_earner','two_person','three_person','four_person','additional_person_amount','created_date','updated_date'
    ];

}
