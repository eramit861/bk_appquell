<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientApplicationPayment extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_client_application_payments';
    public $timestamps = false;

    /* 	public function getUsers()
        {
            return $this->belongs(User::class,'user_id','id');
        }
        public function designer()
        {
            return $this->belongs(User::class,'designer','id');
        }
        public function assign_designer()
        {
            return $this->hasOne(User::class,'id','designer');
        } */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'client_id');
    }

}
