<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Mortgages extends Model
{
    protected $table = 'tbl_mortgages';
    public $timestamps = false;
    protected $primaryKey = 'mortgage_id';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'mortgage_name','mortgage_address','mortgage_city','mortgage_state','mortgage_zip','mortgage_contact','added_by_id','active_status'
    ];

    public static function saveToMortgageCreditorTable($loanData, $save_request_by_attorney, $attorney_id, $client_id)
    {

        $exists = Mortgages::where("mortgage_name", "=", $loanData['creditor_name'])->exists();
        if (!$exists) {
            $added_by_id = $save_request_by_attorney ? $attorney_id : $client_id;
            $mortgage = new Mortgages();
            $mortgage->mortgage_name = Helper::validate_key_value('creditor_name', $loanData);
            $mortgage->mortgage_address = Helper::validate_key_value('creditor_name_addresss', $loanData);
            $mortgage->mortgage_city = Helper::validate_key_value('creditor_city', $loanData);
            $mortgage->mortgage_state = Helper::validate_key_value('creditor_state', $loanData);
            $mortgage->mortgage_zip = Helper::validate_key_value('creditor_zip', $loanData);
            $mortgage->mortgage_webiste = '';
            $mortgage->is_ocr_available = '';
            $mortgage->added_by_id = $added_by_id;
            $mortgage->active_status = 0;
            $mortgage->save();
        }

    }
}
