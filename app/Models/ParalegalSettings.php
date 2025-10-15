<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class ParalegalSettings extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_paralegal_settings';
    public $timestamps = false;

    public static function getEnabledMenuItems($id)
    {

        $paralegal = ParalegalSettings::where(['paralegal_id' => $id])->first();
        $paralegal = !empty($paralegal) ? $paralegal->toArray() : [];

        $enabled_menu_items = Helper::validate_key_value('enabled_menu_items', $paralegal);
        $enabled_menu_items = json_decode($enabled_menu_items, true) ?? [];

        return $enabled_menu_items;
    }

    public static function getMailSendToId($client_id, $attorneyMail, $isParalegal)
    {
        if (!$isParalegal) {
            return $attorneyMail;
        }

        $ClientParalegal = ClientParalegal::where('client_id', $client_id);
        $sendTo = $attorneyMail;
        if ($ClientParalegal->exists()) {
            $paralegal_id = $ClientParalegal->first()->paralegal_id;

            $paralegal = ParalegalSettings::where(['paralegal_id' => $paralegal_id])->first();
            $paralegal = !empty($paralegal) ? $paralegal->toArray() : [];

            $send_all_mails_to_attorney = Helper::validate_key_value('send_all_mails_to_attorney', $paralegal, 'radio');

            if ($send_all_mails_to_attorney == 0) {
                $paralegalDetails = User::where('id', $paralegal_id)->first();
                $sendTo = $paralegalDetails->email;
            }
        }

        return $sendTo;
    }
}
