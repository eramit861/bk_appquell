<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttorneyCompany extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_attorney_company';
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
    public function getuserattorney()
    {
        return $this->belongsTo(User::class, 'attorney_id', 'id');
    }

    public static function getLoggedInAttorneyLogo($attorney_id)
    {
        if (empty($attorney_id)) {
            return '';
        }
        $attorney_company = AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $company_logo = !empty($attorney_company->company_logo) ? $attorney_company->company_logo : '';

        return $company_logo;
    }
}
