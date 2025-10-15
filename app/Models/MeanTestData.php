<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeanTestData extends Model
{
    protected $table = 'tbl_mean_test_data';
    protected $fillable = [
        'client_id','mean_test_data','import_income'
    ];
}
