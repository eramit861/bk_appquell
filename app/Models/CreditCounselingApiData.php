<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCounselingApiData extends Model
{
    protected $table = 'tbl_credit_counseling_api_data';
    public $timestamps = false;
    protected $fillable = [
        'client_id',
        'username',
        'status',
        'clientRecordDataJSON',
        'clientRecordDataResponse',
        'clientIncomeExpenseDataJSON',
        'clientIncomeExpenseDataResponse',
        'clientNetWorthDataJSON',
        'clientNetWorthDataResponse',
        'certificateStatus',
        'created_at',
        'updated_at'
    ];

}
