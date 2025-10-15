<?php

namespace App\Helpers;

use App\Models\ClientDocumentUploaded;
use Illuminate\Support\Facades\Session;

class VideoHelper extends Helper
{
    public static function getVideoButtonLabel($key)
    {
        if (trim($key) === '') {
            return '';
        }
        $labelText = '';
        switch ($key) {
            case 'iphone':
                $labelText = '<span class="">Apple</span>';
                break;
            case 'android':
                $labelText = '<span class="text-success">Android</span>';
                break;
            case 'desktop_laptop':
                $labelText = '<span class="text-c-blue">Website</span>';
                break;
            default:
                $labelText = '';
                break;
        }

        return $labelText;
    }
    public static function getVideoTypes($key = null)
    {
        $arr = [
            'website' => 'Website Client Videos',
            'attorney' => 'Attorney Videos',
            'mobile' => "Mobile App Videos",
            'misc' => "Landing Page & Misc Videos",
            'payroll' => "Payroll Assistant Videos",
            'videolp' => "Video Landing pages Videos"
        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getVideoTitleTypes($key = null)
    {
        $arr = [
            'website' => 'Website and/or Mobile Client Videos',
            'attorney' => 'Attorney Videos',
            'mobile' => "Mobile App Videos",
            'misc' => "Landing Page & Misc Videos",
            'payroll' => "Payroll Assistant Videos"
        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getVideoTypesSelection($code = '')
    {
        $vtarrayList = self::getVideoTypes();

        return self::createSelectionFromArray($vtarrayList, $code);
    }


    public static function createSelectionFromWebsiteVideoArray($arrayList, $code = '')
    {
        $list = '';
        foreach ($arrayList as $key => $value) {
            if (!in_array($key, self::getVimeoCashAppVideos())) {
                $selected = !empty($code) && $code == $key ? 'selected' : '';
                $list .= "<option value='" . $key . "' " . $selected . ">" . $value . "</option>";
            }

        }

        $list .= "<optgroup label='CashApp, Vimeo, Paypal Videos'></optgroup>";
        foreach ($arrayList as $key => $value) {
            if (in_array($key, self::getVimeoCashAppVideos())) {
                $selected = !empty($code) && $code == $key ? 'selected' : '';
                $list .= "<option value='" . $key . "' " . $selected . ">" . $value . "</option>";
            }
        }

        return $list;
    }

    public static function getAllVideosTypes($key = null)
    {
        $arr = self::getWebsiteVideosTypes() + self::getMobileVideosTypes() + self::getAttorneyVideosTypes() + self::getMiscVideosTypes() + self::getPayrollVideosTypes() + self::getExtraLPVideosTypes();
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getBasicInfoVideos()
    {
        return [
            self::BASIC_INFO_STEP1_VIDEO,
            self::BASIC_INFO_STEP2_VIDEO,
            self::BASIC_INFO_STEP3_VIDEO,
            self::BASIC_INFO_STEP4_VIDEO,
            self::BASIC_INFO_STEP5_VIDEO
        ];
    }

    public static function getPropertyVodeos()
    {
        return [
            self::PROPERTY_DASHBOARD_VIDEO,
            self::PROPERTY_STEP1_VIDEO,
            self::PROPERTY_STEP2_VIDEO,
            self::PROPERTY_STEP3_VIDEO,
            self::PROPERTY_STEP4_CONTINUED_VIDEO,
            self::PROPERTY_STEP4_VIDEO,
            self::PROPERTY_STEP5_VIDEO,
            self::PROPERTY_STEP6_VIDEO,
            self::PROPERTY_VIN_TUTORIAL
        ];
    }

    public static function getClientDocumentPageVideos()
    {
        return [
            self::DOCUMENT_PAGE_DESKTOP_VIDEO_GUIDE,
            self::DOCUMENT_PAGE_IPHONE_VIDEO_GUIDE,
            self::DOCUMENT_PAGE_ANDROID_VIDEO_GUIDE,

            self::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE,
            self::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID,
            self::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE,
        ];
    }

    public static function getVimeoCashAppVideos()
    {
        return [
            self::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE,
            self::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID,
            self::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE,

            self::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE,
            self::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID,
            self::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE,

            self::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE,
            self::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID,
            self::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE,
        ];
    }

    public static function getDebtVideos()
    {
        return [
        ];
    }

    public static function getIncomeVideos()
    {
        return [
            self::INCOME_DEBTOR_EMPLOYEE_VIDEO,
            self::INCOME_CO_DEBTOR_EMPLOYEE_VIDEO,
            self::INCOME_DEBTOR_EMPLOYEE_WITH_PAYROLL_VIDEO,
            self::INCOME_CO_DEBTOR_EMPLOYEE_WITH_PAYROLL_VIDEO,
            self::INCOME_DEBTOR_INCOME_VIDEO,
            self::INCOME_CO_DEBTOR_INCOME_VIDEO,
            self::INCOME_PROFIT_LOSS_PDF_VIDEO,
            self::INCOME_SPOUSE_PROFIT_LOSS_PDF_VIDEO,
        ];
    }

    public static function getExpenseVideos()
    {
        return [
            self::EXPENSE_DEBTOR_VIDEO,
            self::EXPENSE_CO_DEBTOR_VIDEO,
        ];
    }

    public static function getSofaVideos()
    {
        return [
            self::SOFA_TAB_VIDEO,
            self::SOFA_TAB_VIDEO_STEP_2,
            self::SOFA_TAB_VIDEO_STEP_3,
            self::SOFA_TAB_VIDEO_1,
            self::SOFA_TAB_VIDEO_2,
            self::SOFA_TAB_VIDEO_3,
            self::SOFA_TAB_VIDEO_4
        ];
    }

    public static function getWebsiteVideosTypes($key = null)
    {
        $arr = [
           // self::BASIC_INFO_DASHBOARD_VIDEO => "Standard Information Dashboard",
            self::BASIC_INFO_STEP1_VIDEO => "Debtor's Basic Information (Dashboard)",
            self::BASIC_INFO_STEP2_VIDEO => "Co-Debtor's/Spouse's Information",
            self::BASIC_INFO_STEP3_VIDEO => "Prior and/or Pending Bankruptcy Cases",
            self::BASIC_INFO_STEP4_VIDEO => "Debtors Who Reside as Tenants of Residential Property",
            self::BASIC_INFO_STEP5_VIDEO => "Business Owned as a Sole Proprietor/Hazardous Property",
            self::PROPERTY_DASHBOARD_VIDEO => "Property Dashboard",
            self::PROPERTY_STEP1_VIDEO => "Property (Vehicle, Recreational)",
            self::PROPERTY_VIN_TUTORIAL => "Property Vehicle VIN Guide",
            self::PROPERTY_STEP2_VIDEO => "Personal and Household Items",
            self::PROPERTY_STEP3_VIDEO => "Financial Assets",
            self::PROPERTY_STEP4_CONTINUED_VIDEO => "Financial Assets Continued",
            self::PROPERTY_STEP4_VIDEO => "Business-Related Assets",
            self::PROPERTY_STEP5_VIDEO => "Farm and Commercial Fishing-Related Property",
            self::PROPERTY_STEP6_VIDEO => "Miscellaneous Property",
            self::INCOME_DEBTOR_EMPLOYEE_VIDEO => "Debtor's Employer Information",
            self::INCOME_CO_DEBTOR_EMPLOYEE_VIDEO => "Spouse's Employer Information",
            self::INCOME_DEBTOR_EMPLOYEE_WITH_PAYROLL_VIDEO => "Debtor's Employer Information (Payroll Assistant)",
            self::INCOME_CO_DEBTOR_EMPLOYEE_WITH_PAYROLL_VIDEO => "Spouse's Employer Information (Payroll Assistant)",
            self::INCOME_DEBTOR_INCOME_VIDEO => "Debtor's Current Monthly Income",
            self::INCOME_CO_DEBTOR_INCOME_VIDEO => "Spouse's Current Monthly Income",
            self::INCOME_PROFIT_LOSS_PDF_VIDEO => "Debtor's Monthly Profit/loss",
            self::INCOME_SPOUSE_PROFIT_LOSS_PDF_VIDEO => "Spouse's Monthly Profit/loss",
            self::EXPENSE_DEBTOR_VIDEO => "Debtor's Monthly Expenses",
            self::EXPENSE_CO_DEBTOR_VIDEO => "Separate Household Expenses",
            self::SOFA_TAB_VIDEO => "SOFA tab step 1 video",
            self::SOFA_TAB_VIDEO_STEP_2 => "SOFA tab step 2 video",
            self::SOFA_TAB_VIDEO_STEP_3 => "SOFA tab step 3 video",
            self::SOFA_TAB_VIDEO_1 => "SOFA tab Debtor's Income",
            self::SOFA_TAB_VIDEO_2 => "SOFA tab Spouse's Income",
            self::SOFA_TAB_VIDEO_3 => "SOFA tab Debtor's Income (Other than employment)",
            self::SOFA_TAB_VIDEO_4 => "SOFA tab Spouse's Income (Other than employment)",
            self::DOCUMENT_PAGE_IPHONE_VIDEO_GUIDE => "Document Video Guide For iPhone",
            self::DOCUMENT_PAGE_ANDROID_VIDEO_GUIDE => "Document Video Guide For Android",
            self::DOCUMENT_PAGE_DESKTOP_VIDEO_GUIDE => "Document Video Guide For Desktop",

            self::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE => "Paypal Bank statement Download Guide (Apple)",
            self::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID => "Paypal Bank statement Download Guide (Android)",
            self::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE => "Paypal Bank statement Download Guide (Website)",

            self::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE => "Cash App Bank statement Download Guide (Apple)",
            self::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID => "Cash App Bank statement Download Guide (Android)",
            self::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE => "Cash App Bank statement Download Guide (Website)",

            self::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE => "Venmo Bank statement Download Guide (Apple)",
            self::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID => "Venmo Bank statement Download Guide (Android)",
            self::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE => "Venmo Bank statement Download Guide (Website)",

            self::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE => "Credit Report statement Download Guide (Apple)",
            self::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID => "Credit Report statement Download Guide (Android)",
            self::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE => "Credit Report statement Download Guide (Website)",
        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }




    public static function getMobileVideosTypes($key = null)
    {
        $arr = [
            self::MAIN_MOBILE_APP_VIDEO => "Main Mobile app screen",
            self::MAIN_DOCUMENT_TUTORIAL_VIDEO => "Main Document Screen Tutorial",
            self::DRIVING_LIC_TUTORIAL_VIDEO => "Drivers Lic./Gov. ID Tutorial",
            self::SSN_ITIN_TUTORIAL_VIDEO => "Social Security Card/ITIN Tutorial",
            self::MORTGAGE_LOAN_TUTORIAL_VIDEO => "Mortgage loan Tutorial",
            self::AUTO_LOAN_TUTORIAL_VIDEO => "Auto loan Tutorial",
            self::VEHICLE_REGISTRATION_VIDEO => "Vehicle Registration Tutorial",
            self::VEHICLE_INFORMATION_VIDEO => "Vehicle Information Tutorial",
            self::VIDEO_PROOF_OF_AUTO_INSURANCE => 'Proof of Auto Insurance Tutorial',
            self::VIDEO_OTHER_MISC_DOCUMENT => 'Debt(s)/Collection Statements Tutorial',
            self::PAYSTUB_TUTORIAL_VIDEO => "Pay Stubs Tutorial",
            self::VIDEO_SOCIAL_SECURITY_ANNUAL_AWARD_LETTER => 'Social Security Annual Award Letter Tutorial',
            self::VIDEO_VA_BENEFIT_AWARD_LETTER => 'VA Benefit Award Letter Tutorial',
            self::VIDEO_UNEMPLOYMENT_CERTIFICATE => 'Unemployment Certificate Tutorial',
            self::LAST_YEAR_TAX_RETURN_VIDEO => 'Last Year Tax Returns - '.DateTimeHelper::getYearForTaxReturn(ClientDocumentUploaded::LAST_YR_TAX_RETURNS, '01/10').' Tutorial',
            self::YEAR_BEFORE_TAX_RETURN_VIDEO => 'Prior Year Tax Returns - '.DateTimeHelper::getYearForTaxReturn(ClientDocumentUploaded::PRIOR_YR_TAX_RETURNS, '01/10').' Tutorial',
            self::YEAR_BEFORE_TWO_TAX_RETURN_VIDEO => 'Prior Year Tax Returns - '.DateTimeHelper::getYearForTaxReturn(ClientDocumentUploaded::PRIOR_YR_TWO_TAX_RETURNS, '01/10').' Tutorial',
            self::YEAR_BEFORE_THREE_TAX_RETURN_VIDEO => 'Prior Year Tax Returns - '.DateTimeHelper::getYearForTaxReturn(ClientDocumentUploaded::PRIOR_YR_THREE_TAX_RETURNS, '01/10').' Tutorial',
            self::MISC_DOCUMENT_W2_VIDEO => 'W2 and or 1099 (Last Year) - '.date("Y", strtotime("-1 year")).' Tutorial',
            self::MISC_DOCUMENT_W2_YEAR_BEFORE_VIDEO => 'W2 and or 1099 (Year Before) - '.date("Y", strtotime("-2 year")).' Tutorial',
            self::VIDEO_RETIREMENT_DOCUMENT => 'Retirement Statement Tutorial',
            self::MISC_DOCUMENT_VIDEO => "Additional or Unlisted Documents Tutorial",
            self::VIDEO_PRE_FILING_CC_DOCUMENT => 'Pre-Filing Bankruptcy Certificate(s) Tutorial',
            self::VIDEO_BANK_ACCOUNT_DOCUMENT => 'Bank Statements Tutorial',
            self::VIDEO_PAYPAL_CASH_VENMO_ACCOUNT_DOCUMENT => 'PayPal, Cash App, Venmo Account Statements Tutorial',
            self::VIDEO_BROKERAGE_ACCOUNT_DOCUMENT => 'Brokerage Account Statements Tutorial',
            self::VIDEO_LIFE_INSURANCE_DOCUMENT => 'Life Insurance Tutorial',
        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getAttorneyVideosTypes($key = null)
    {
        $arr = [
            self::INVITE_CLIENT_VIDEO => 'Invite Client',
            self::ATTORNEY_DASHBOARD_VIDEO => 'Attorney Welcome Video',
            self::ATTORNEY_CLIENT_MANAGEMENT_VIDEO => 'Client Management',
            self::ATTORNEY_SHORT_FORM_LISTING_VIDEO => 'Short Form Questionnaire',
            self::ATTORNEY_CLIENT_QUESTIONNAIRE_VIDEO => 'Client Questionnaire',
            self::CREDITOR_SELECT_VIDEO => 'Creditor Select for import',
            self::ATTORNEY_NOTES_ADDED_BY_ATTORNEY_VIDEO => 'Notes Added by Attorney/Law Firm',
            self::ATTORNEY_UPLOAD_CLIENT_DOCUMENT_VIDEO => 'Upload Client Documents',
            self::INVITE_DOCUMENT_REQUEST_POPUP => 'Send Doc(s) Request',
            self::ATTORNEY_SEND_RECEIVE_SIGNED_DOC_VIDEO => 'Send/Receive Signed Docs',
            self::ATTORNEY_UPLOAD_CREDIT_REPORT_VIDEO => 'Upload Credit Report',
            self::ATTORNEY_CREDITORS_CREDIT_REPORT_VIDEO => 'Creditors (Credit Report)',
            self::ATTORNEY_PAYROLL_ASSISTANT_VIDEO => 'Payroll Assistant',
            self::ATTORNEY_SPOUSE_PAYROLL_ASSISTANT_VIDEO => 'Payroll Assistant (Spouse)',
            self::ATTORNEY_ADDITIOANL_DOCUMENT_UPLOAD => 'Document Management',
            self::ATTORNEY_TRANSACTION_MANAGEMENT => 'Transactions Management',
            self::LANDING_PAGE_PRICING_PLAN_VIDEO => "Attorney Subscription Plan Video",
            self::ATTORNEY_SETTINGS => 'Attorney Settings',
            self::ATTORNEY_SETTING_SUBSCRIPTION => 'Attorney settings Subscriptions',
            self::ATTORNEY_SETTING_PETITION_PREP => 'Attorney settings Petition Prep',
            self::ATTORNEY_SETTING_WELCOME_VIDEO => 'Attorney Settings Welcome Video',
            self::ATTORNEY_CHAPTER_7_GUIDE => 'Attorney Chapter 7 Guide Video',
            self::ATTORNEY_CHAPTER_13_GUIDE => 'Attorney Chapter 13 Guide Video',

        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getMiscVideosTypes($key = null)
    {
        $arr = [
            self::GUIDE_PAGE_TUTORIAL_VIDEO => "Guide Page Tutorial Video",
            self::LANDING_PAGE_10_REASON_AUTOMATED_DOCUMENT_COLLECTION => "#1 Automated Document Collection Video",
            self::LANDING_PAGE_10_REASON_DOCUMENT_MANAGMENT => "#2 Credit Counseling Certificates Video",
            self::LANDING_PAGE_10_REASON_BUILT_IN_REVOLUTIONARY_FOLLOW_UP_SYSTEM => "#3 Built in Revolutionary Follow Up System Video",
            self::LANDING_PAGE_10_REASON_BUILT_IN_COMMON_CREDITOR_LISTS => "#4 Built in Common Creditor Lists Video",
            self::LANDING_PAGE_10_REASON_DYNAMIC_QUESTIONING => "#5 Dynamic Questioning Video",
            self::LANDING_PAGE_10_REASON_DETAILED_PROPERTY_TAB => "#6 Detailed Property Personal Tab",
            self::LANDING_PAGE_10_REASON_COLLABORATIVE_CLIENT_ENGAGEMENT => "#7 Collaborative Client Engagement Video",
            self::LANDING_PAGE_10_REASON_AUTOMATED_DOCUMENT_CONVERSION_TOPDF => "#8 Automated Document Conversion to PDF",
            self::LANDING_PAGE_BIG_TAB_VIDEO => "Designed by a seasoned bankruptcy",
            self::LANDING_PAGE_AFTER_MAIN_VIDEO => "DEMO VIDEO on Landing Page"
        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getPayrollVideosTypes($key = null)
    {
        $arr = [
            self::PAYROLL_GUIDE_PAGE_TUTORIAL_VIDEO => "Guide Page Tutorial Video <b>(Payroll Assistant)</b>",
            self::PAYROLL_ASSISTANT_STEP_BY_STEP_VIDEO => "Step by Step Video <b>(Payroll Assistant)</b>",
        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getExtraLPVideosTypes($key = null)
    {
        $arr = [
            self::VIDEO_LP1_VIDEO => "Video Landing page 1",
            self::VIDEO_LP2_VIDEO => "Video Landing page 2",
            self::VIDEO_LP3_VIDEO => "Video Landing page 3",
            self::VIDEO_LP4_VIDEO => "Video Landing page 4",
            self::VIDEO_LP5_VIDEO => "Video Landing page 5"
        ];
        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }



    public static function getMobileVideoTypeSelection($code = '')
    {
        $mvarrayList = self::getMobileVideosTypes();

        return self::createSelectionFromArray($mvarrayList, $code);
    }

    public static function getWebVideoTypeSelection($code = '')
    {
        $mvtarrayList = self::getWebsiteVideosTypes();

        return self::createSelectionFromWebsiteVideoArray($mvtarrayList, $code);
    }



    public static function getAttorneyVideosTypeSelection($code = '')
    {
        $atvarrayList = self::getAttorneyVideosTypes();

        return self::createSelectionFromArray($atvarrayList, $code);
    }

    public static function getMiscVideosTypeSelection($code = '')
    {
        $atvarrayList = self::getMiscVideosTypes();

        return self::createSelectionFromArray($atvarrayList, $code);
    }

    public static function getPayrollVideosTypeSelection($code = '')
    {
        $atvarrayList = self::getPayrollVideosTypes();

        return self::createSelectionFromArray($atvarrayList, $code);
    }

    public static function getExtraLPVideosTypeSelection($code = '')
    {
        $atvarrayList = self::getExtraLPVideosTypes();

        return self::createSelectionFromArray($atvarrayList, $code);
    }



    public static function getAdminVideos()
    {
        $cacheKey = 'admin_videos';

        return cache()->remember($cacheKey, 60 * 60, function () {
            $videoArray = \App\Models\WebsiteVideo::select(
                'id',
                'section',
                'english_video',
                'spanish_video',
                'media_type',
                'webview_english_video',
                'webview_spanish_video',
                'iphone_english_video',
                'iphone_spanish_video'
            )
            ->groupBy("section")
            ->where("section", "!=", null)
            ->get()
            ->keyBy('section');

            return !empty($videoArray->toArray()) ? $videoArray->toArray() : [];
        });
    }


    public static function getAttorneyVideos($section)
    {
        $cacheKey = 'attorney_videos_' . $section;

        return cache()->remember($cacheKey, 60 * 60, function () use ($section) {
            $tutorial = \App\Models\WebsiteVideo::select('section', 'english_video', 'spanish_video')
                ->where("section", "=", $section)
                ->first();

            return [
                'en' => isset($tutorial['english_video']) && !empty($tutorial['english_video']) ? self::stopRelativeVideo($tutorial['english_video']) : '',
                'sp' => isset($tutorial['spanish_video']) && !empty($tutorial['spanish_video']) ? self::stopRelativeVideo($tutorial['spanish_video']) : ''
            ];
        });
    }

    public static function getVideos($tutorial, $forapps = false)
    {
        $videos = ['en' => isset($tutorial['english_video']) && !empty($tutorial['english_video']) ? self::stopRelativeVideo($tutorial['english_video']) : '', 'sp' => isset($tutorial['spanish_video']) && !empty($tutorial['spanish_video']) ? self::stopRelativeVideo($tutorial['spanish_video']) : ''];
        ;
        if ($forapps) {
            $videos = ['en' => isset($tutorial['english_video']) && !empty($tutorial['english_video']) ? self::stopRelativeVideo($tutorial['english_video']) : '', 'sp' => isset($tutorial['spanish_video']) && !empty($tutorial['spanish_video']) ? self::stopRelativeVideo($tutorial['spanish_video']) : '','ios_en' => isset($tutorial['iphone_english_video']) && !empty($tutorial['iphone_english_video']) ? self::stopRelativeVideo($tutorial['iphone_english_video']) : '', 'ios_sp' => isset($tutorial['iphone_spanish_video']) && !empty($tutorial['iphone_spanish_video']) ? self::stopRelativeVideo($tutorial['iphone_spanish_video']) : ''];
        }
        $web_view = Session::get('web_view');
        if (@$web_view && isset($tutorial['media_type']) && $tutorial['media_type'] == 'website') {
            $videos = ['en' => isset($tutorial['webview_english_video']) && !empty($tutorial['webview_english_video']) ? self::stopRelativeVideo($tutorial['webview_english_video']) : ($tutorial['english_video'] ?? ''), 'sp' => isset($tutorial['webview_spanish_video']) && !empty($tutorial['webview_spanish_video']) ? self::stopRelativeVideo($tutorial['webview_spanish_video']) : ($tutorial['spanish_video'] ?? '')];
        }

        return $videos;
    }

    public static function stopRelativeVideo($videourl = null)
    {
        if (str_contains($videourl, 'rel=0')) {
            return  $videourl;
        } elseif (str_contains($videourl, 'rel=1')) {
            return str_replace('rel=1', 'rel=0', $videourl);
        } elseif (str_contains($videourl, '?')) {
            return $videourl.'&rel=0';
        } else {
            return $videourl.'?rel=0';
        }
    }

    /**
     * @param $videoType
     * @return array|string[]
     */
    public static function getVideo($videoType): array
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[$videoType] ?? [];

        return VideoHelper::getVideos($tutorial);
    }

    public static function getTitleByKey($key = null)
    {
        $arr = [
            'A' => 'Basic Information',
            'B' => 'Property',
            'C' => 'Debts',
            'D' => 'Income',
            'E' => 'Expense',
            'F' => 'Sofa tab',
            'G' => 'Client Document',
            'H' => 'CashApp, Venmo, Paypal Videos'
        ];

        return static::returnArrValue($arr, $key);
    }
}
