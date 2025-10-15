<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttorneyClientHtml extends Model
{
    protected $table = 'tbl_html_default_local_forms';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'form_id','client_id','data','created_at','updated_at'
    ];

    public static function deleteHtmlData($client_id)
    {
        \App\Models\AttorneyClientHtml::where('client_id', $client_id)->delete();
    }

}
