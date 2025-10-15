<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCardStatements extends Model
{
    use HasFactory;

    protected $table = 'tbl_mastercard_bank_statement_pdf';
    protected $fillable = [
        'client_id',
        'PDF_name',
        'client_type',
        'customer_id',
        'account_id',
        'file_path',
        'institute_id',
        'bank_last_digit',
        'month_year',
        'institute_name',
        'is_success',
    ];
}
