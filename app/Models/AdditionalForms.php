<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalForms extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_additional_forms';
    public $timestamps = false;


    public static function getUrlByDistrictId($districtId)
    {
        $form = AdditionalForms::where('district_id', $districtId)->first();
        $form = !empty($form) ? $form->toArray() : [];

        return $form['additional_form_url'] ?? '';
    }
}
