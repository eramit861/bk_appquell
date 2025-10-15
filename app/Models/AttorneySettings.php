<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;

class AttorneySettings extends Model
{
    protected $table = 'tbl_attorney_settings';
    public $timestamps = false;
    protected $fillable = [
        'attorney_id',
        'bank_statement_months',
        'attorney_enabled_bank_statment',
        'counseling_agency',
        'counseling_agency_site',
        'attorney_code',
        'created_at',
        'updated_at',
        'profit_loss_months',
        'brokerage_months',
        'enabled_detailed_property',
        'enable_text_msg_notification_email',
        'text_text_msg_notification_email',
        'notification_status',
        'transaction_pdf_enabled',
        'transaction_pdf_signature_enabled',
        'law_firm_management_enabled',
        'zip_in_schedule_structure',
        'custom_login_slug',
        'is_car_title_enabled',
        'is_rental_agreement_enabled',
        'is_associate',
        'tax_return_day_month',
        'is_debt_header_custom_enabled',
        'debt_header_custom_text',
        'is_confirm_prompt_enabled',
        'is_doc_upload_restriction_enabled',
        'is_current_partial_month_enabled',
    ];

    public static function getProfitLossMonths($attorney_id, $is_associate = 0)
    {
        $profit_loss_months = 6;
        if (!empty($attorney_id)) {
            $attorney_profile = self::where([ 'attorney_id' => $attorney_id, 'is_associate' => $is_associate ])->first();
            if (!empty($attorney_profile)) {
                $profit_loss_months = $attorney_profile->profit_loss_months;
            }
        }

        return $profit_loss_months;
    }

    public static function getBankStatmentMonths($attorney_id, $is_associate = 0)
    {
        $bank_statement_months = 6;
        if (!empty($attorney_id)) {
            $attorney_profile = self::where([ 'attorney_id' => $attorney_id, 'is_associate' => $is_associate ])->first();
            if (!empty($attorney_profile)) {
                $bank_statement_months = $attorney_profile->bank_statement_months;
            }
        }

        return $bank_statement_months;
    }

    public static function isEmailEnabled($id, $key, $client_id = '', $isAdmin = false)
    {
        if (empty($key) || empty($id)) {
            return false;
        }

        if (!empty($client_id)) {
            $user = \App\Models\User::where("id", $client_id)->select('*')->first();
            $id = $user->concierge_service == 1 ? 1 : $id;
        }

        $queryCondition = [ 'attorney_id' => $id ];
        if (!empty($isAdmin)) {
            $queryCondition = [ 'attorney_id' => $id, 'is_associate' => 0 ];
        }

        $attorneySettings = self::where($queryCondition)->select('notification_status')->first();
        if (!$attorneySettings || empty($attorneySettings->notification_status) || is_null($attorneySettings->notification_status)) {
            return true;
        }

        $notification_status = json_decode($attorneySettings->notification_status, true);

        return (Helper::validate_key_value($key, $notification_status, 'radio') == 1) ? true : false ;
    }

    public static function isLawFirmManagementEnabled($id)
    {
        if (empty($id)) {
            return false;
        }
        $attorneySettings = self::where(['attorney_id' => $id, 'is_associate' => 0])->select('law_firm_management_enabled')->first();

        return (Helper::validate_key_value('law_firm_management_enabled', $attorneySettings, 'radio') == 1) ? true : false ;
    }

    public static function getClientLoginUrl($attorneyId)
    {
        $attorneySettings = self::where(['attorney_id' => $attorneyId])->select('custom_login_slug')->first();
        $slug = Helper::validate_key_value('custom_login_slug', $attorneySettings) ?? '';
        $baseUrl = Request::getSchemeAndHttpHost();
        URL::forceRootUrl($baseUrl);
        URL::forceScheme('https'); // Optional: force https if your site uses it
        $clientLoginurl = route('client_login', ['attorney' => $slug]);

        return $clientLoginurl;
    }

    public static function isConfirmPromptEnabled($id)
    {
        if (empty($id)) {
            return false;
        }
        $attorneySettings = self::where(['attorney_id' => $id])->select('is_confirm_prompt_enabled')->first();

        return (Helper::validate_key_value('is_confirm_prompt_enabled', $attorneySettings, 'radio') == 1) ? true : false ;
    }

    public static function isDocumentUploadRestrictionEnabled($id)
    {
        if (empty($id)) {
            return false;
        }
        $attorneySettings = self::where(['attorney_id' => $id])->select('is_doc_upload_restriction_enabled')->first();

        return (Helper::validate_key_value('is_doc_upload_restriction_enabled', $attorneySettings, 'radio') == 1) ? true : false ;
    }

    public static function isCurrentPartialMonthEnabled($id)
    {
        if (empty($id)) {
            return false;
        }
        $attorneySettings = self::where(['attorney_id' => $id])->select('is_current_partial_month_enabled')->first();

        return (Helper::validate_key_value('is_current_partial_month_enabled', $attorneySettings, 'radio') == 1) ? true : false ;
    }

}
