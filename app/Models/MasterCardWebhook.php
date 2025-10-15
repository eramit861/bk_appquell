<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterCardWebhook extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_mastercard_webhook';
    public $timestamps = false;
}
