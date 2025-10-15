<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAppointmentReminder extends Model
{
    protected $table = 'client_appointment_reminder_logs';
    public $timestamps = false;
    protected $fillable = [
        'client_id',
        'added_by',
        'data',
        'last_send',
        'reminder_time',
        'reminder_location',
        'created_at',
        'updated_at'
    ];

}
