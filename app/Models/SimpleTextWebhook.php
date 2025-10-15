<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimpleTextWebhook extends Model
{
    protected $table = 'tbl_simpletext_message_webhook';
    public $timestamps = false;
    protected $fillable = [
        'client_id',
        'seen_by_admin',
        'seen_by_attorney',
        'json',
        'created_at',
        'updated_at'
    ];

}
