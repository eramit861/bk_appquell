<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonMortgageHousingUtilities extends Model
{
    use HasFactory;
    protected $table = 'non_mortgage_housing_utilities';
    public $timestamps = false;
    protected $fillable = [
        'state','county','FIPS_Code','OnePerson_amount','TwoPerson_amount','ThreePerson_amount','FourPerson_amount','FiveorMorePerson_amount','created_date','updated_date'
    ];
}
