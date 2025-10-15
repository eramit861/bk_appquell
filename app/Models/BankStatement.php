<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankStatement extends Model
{
    protected $table = 'tbl_mastercard_bank_statement_pdf';
    protected $fillable = [
        'id',
        'client_id',
        'client_type',
        'customer_id',
        'account_id',
        'institute_id',
        'file_path',
        'month_year',
        'pdf_response_text',
        'created_at',
        'updated_at'
    ];
}
