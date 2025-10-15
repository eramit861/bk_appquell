<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterCardTransactions extends Model
{
    protected $table = 'tbl_mastercard_transaction';
    protected $fillable = [
        'account_no',
        'institute_name',
        'institute_id',
        'client_id',
        'transaction_id',
        'amount',
        'account_id',
        'customer_id',
        'status',
        'description',
        'posted_date',
        'transaction_date',
        'created_date',
        'categorization',
        'investment_transaction_type',
        'transaction_json',
        'client_type',
        'is_imported',
        'is_imported_for'
    ];
}
