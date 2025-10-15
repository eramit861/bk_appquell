<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class ClientBasicInfoPartRest extends Model
{
    protected $guarded = [];
    protected $table = 'client_basic_info_part_rest';
    public $timestamps = false;

    public static function hasAnyBussiness($client_id)
    {
        $BasicInfo_PartRest = ClientBasicInfoPartRest::where('client_id', $client_id)->select(['used_business_ein'])->first();

        return (Helper::validate_key_value('used_business_ein', $BasicInfo_PartRest, 'radio') == 1);
    }

}
