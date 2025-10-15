<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttorneyEditorData extends Model
{
    protected $table = 'tbl_attorney_html_editor_data';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'client_id','data','request_for_combined','pdf_request_placed_on','confirm_html_forms_json'
    ];

}
