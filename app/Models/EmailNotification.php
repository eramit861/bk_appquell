<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    protected $table = 'tbl_email_notifications';
    public $timestamps = false;
    protected $fillable = [ 'added_by', 'attorney_detail', 'notification_detail', 'created_at', 'updated_at' ];
}
