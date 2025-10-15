<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientsAttorney extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_clients_attorney';
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

    public function getuserclient()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }
    public function getuserattorney()
    {
        return $this->belongsTo(User::class, 'attorney_id', 'id');
    }
}
