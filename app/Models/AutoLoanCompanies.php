<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class AutoLoanCompanies extends Model
{
    protected $table = 'tbl_auto_loan_companies';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'is_ocr_available','ocr_sample_image','alcomp_name','alcomp_address','alcomp_city','alcomp_state','alcomp_zip','alcomp_website','added_by_id','active_status'
    ];

    public static function addCreditorToAutoLoanList($loanData, $save_request_by_attorney, $attorney_id, $client_id)
    {
        $creditorName = Helper::validate_key_value('creditor_name', $loanData);

        if (isset($creditorName) && !empty($creditorName)) {
            $exists = AutoLoanCompanies::where("alcomp_name", "=", $creditorName)->exists();
            if (!$exists) {
                $added_by_id = $save_request_by_attorney ? $attorney_id : $client_id;
                $company = new AutoLoanCompanies();
                $company->alcomp_name = Helper::validate_key_value('creditor_name', $loanData);
                $company->alcomp_address = Helper::validate_key_value('creditor_name_addresss', $loanData);
                $company->alcomp_city = Helper::validate_key_value('creditor_city', $loanData);
                $company->alcomp_state = Helper::validate_key_value('creditor_state', $loanData);
                $company->alcomp_zip = Helper::validate_key_value('creditor_zip', $loanData);
                $company->alcomp_website = '';
                $company->is_ocr_available = '';
                $company->ocr_sample_image = '';
                $company->added_by_id = $added_by_id;
                $company->active_status = 0;
                $company->save();
            }
        }

        return true;
    }

}
