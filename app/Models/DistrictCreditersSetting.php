<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictCreditersSetting extends Model
{
    use HasFactory;

    public function district()
    {
        return $this->belongsTo('App\Models\ZipCode', 'destrict_id', 'id')->withDefault();
    }
}
