<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    protected $table = 'tbl_notification_template';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'attorney_id','noti_tenp_subject','noti_tenp_body','added_by','time_frame','created_at','updated_at'
    ];

    public const NOTLOGGEDINUSER = 'notloggedinuser';
    public const LOGGEDINUSER = 'loggedinuser';
}
