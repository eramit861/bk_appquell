<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'tbl_user_notifications';
    public $timestamps = false;
    public const DOCUMENT_TYPE = 'DOCUMENT_TYPE';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'client_id','unotification_body','unotification_date','unotification_is_read','unotification_type','unotification_data','created_at','updated_at'
    ];

}
