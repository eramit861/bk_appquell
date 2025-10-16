<?php

namespace App\Helpers;

use App\Models\User;
use App\Services\Client\CacheBasicInfo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class Helper
{
    public const SUCCESS = 1;
    public const FAILED = 0;
    public const YES = 1;
    public const NO = 0;
    public const SUFFIX_SR = 1;
    public const SUFFIX_JR = 2;
    public const SUFFIX_II = 3;
    public const SUFFIX_III = 4;
    public const ACTIVE = 1;
    public const INACTIVE = 0;

    public const REMOVED = 9;
    public const MARRIED = 1;
    public const UNMARRIED = 0;

    public const SINGLE = 0;
    public const STATUS_MARRIED = 1;
    public const SEPERATED = 2;
    public const DIVORCED = 3;
    public const WIDOWED = 4;

    public const VEHICLE_CARS_TK = 1;
    public const VEHICLE_MOTORCYCLE = 2;
    public const VEHICLE_WATERCRAFT = 3;
    public const VEHICLE_AIRCRAFT = 4;
    public const VEHICLE_MOTOR_HOME = 5;
    public const VEHICLE_RECREATINAL_VEHICLE = 6;

    public const CHECKING_ACNT = 1;
    public const SAVING_ACNT = 2;
    public const CHECKING_SAVING_ACNT = 3;
    public const CERTIF_DEPT = 4;
    public const OTHER_FINANCIAL = 5;
    public const BROKERAGE_ACCOUNT = 6;
    public const CREDIT_UNION = 7;

    public const BEDROOM_FURNITURE = 1;
    public const COOKING_UTENSILS = 2;
    public const COOKWARE_POTS_AND_PANS = 3;
    public const DINING_ROOM_FURNITURE = 4;
    public const DRESSERS_NIGHTSTANDS = 5;
    public const LAMPS_AND_ACCESSORIES = 6;
    public const LAWN_MOVER = 7;
    public const LIVING_ROOM_FURNITURE = 8;
    public const MICROWAVE = 9;
    public const REFRIGERATOR = 10;
    public const SILVERWARE_FLATWARE = 11;
    public const STOVE_COOKING_UNIT = 12;
    public const TABLES_AND_CHAIRS = 13;
    public const WASHER_DRYER = 14;
    public const PLATES_CHINA = 15;

    public const CAMCORDER = 1;
    public const CELL_PHONES = 2;
    public const COMPACT_DISKS = 3;
    public const COMPUTER_PRINTERS = 4;
    public const COMPUTERS = 5;
    public const DESK_OFFICE_FURNITURE = 6;
    public const DVD_PLAYERS = 7;
    public const DVDS = 8;
    public const OTHER_COMPUTER_EQUIPMENT = 9;
    public const PHOTOGRAPHY_EQUIPMENT = 10;
    public const SATELLITE_DISKS = 11;
    public const STEREO_EQUIPMENT = 12;
    public const TELEVISION = 13;
    public const VCRS = 14;
    public const YARD_TOOLS_EQUIPMENTS = 15;

    public const ARTWORK = 1;
    public const ANTIQUES = 2;
    public const PIANO = 3;
    public const PAINTINGS_PRINTS = 4;
    public const MEMORABILIA = 5;
    public const COLLECTIBLES = 6;
    public const STAMPS = 7;
    public const COINS = 8;
    public const GOLD_SILVER_BULLION = 9;
    public const FIGURINES = 10;
    public const CARD_COLLECTIONS = 11;
    public const OTHER_COLLECTIONS = 12;

    public const SPORTS_EQUIPMENT = 1;
    public const PHOTOGRAPHIC_EQUIP = 2;
    public const EXERCISE_EQUIP = 3;
    public const BICYCLES = 4;
    public const POOL_TABLE_GAMING_EQUIP = 5;
    public const CARPENTRY_TOOLS = 6;
    public const MUSICAL_INSTRUMENTS = 7;
    public const PIANO_EQUIP = 8;
    public const OTHER_HOBBY_EQUIP = 9;

    public const FURS = 1;
    public const OTHER_JEWELRY_WATCHES = 2;
    public const WEDDING_RING = 3;

    public const ACT_TYPE_401K = 1;
    public const ACT_TYPE_PENSION_PLAN = 2;
    public const ACT_TYPE_IRA = 3;
    public const ACT_TYPE_KEOGH = 4;
    public const ACT_TYPE_ADDITIONAL = 5;
    public const ACT_TYPE_RETIREMENT = 6;

    public const SECURITY_ELECTRONIC = 1;
    public const SECURITY_GAS = 2;
    public const SECURITY_ON_RENTAL_UNIT = 3;
    public const SECURITY_PREPAID_RENT = 4;
    public const SECURITY_TELEPHONE = 5;
    public const SECURITY_WATER = 6;
    public const SECURITY_RENTAL_FURNITURE = 7;
    public const SECURITY_HEATING_OIL = 8;
    public const SECURITY_OTHER = 9;

    public const CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED = 1;
    public const CLIENT_TYPE_INDIVIDUAL_MARRIED = 2;
    public const CLIENT_TYPE_JOINT_MARRIED = 3;
    public const ANDROID_APP_URL = 'https://play.google.com/store/apps/details?id=com.bkassistant.scannerapp';
    public const IOS_APP_URL = 'https://apps.apple.com/us/app/bk-assistant/id1619964805';

    public const PAYROLL_ASSISTANT_TYPE_DEBTOR = 1;
    public const PAYROLL_ASSISTANT_TYPE_CODEBTOR = 2;
    public const PAYROLL_ASSISTANT_TYPE_BOTH = 3;

    public const BANK_STATEMENTS_DEBTOR = 1;
    public const BANK_STATEMENTS_CODEBTOR = 2;
    public const BANK_STATEMENTS_BOTH = 3;

    public const PROFIT_LOSS_ASSISTANT_TYPE_DEBTOR = 1;
    public const PROFIT_LOSS_ASSISTANT_TYPE_CODEBTOR = 2;
    public const PROFIT_LOSS_ASSISTANT_TYPE_BOTH = 3;

    public const CREDIT_REPORT_TYPE_DEBTOR = 1;
    public const CREDIT_REPORT_TYPE_CODEBTOR = 2;
    public const CREDIT_REPORT_TYPE_BOTH = 3;

    public const TEXT_SPACING_SINGLE = 1;
    public const TEXT_SPACING_TWO = 2;
    public const TEXT_SPACING_THREE = 3;

    public const FONT_SIZE_NORMAL = 1;
    public const FONT_SIZE_SMALL = 2;
    public const FONT_SIZE_MEDIUM = 3;
    public const FONT_SIZE_LARGE = 4;

    public const FONT_STYLE_NORMAL = 1;
    public const FONT_STYLE_UPPERCASE = 2;
    public const FONT_STYLE_CAPITALIZE = 3;
    public const FONT_STYLE_LOWERCASE = 4;
    public const DEBTOR_RESIDENTARRAY = ['Current_Mortgage_Statement_1_1', 'Current_Mortgage_Statement_2_1', 'Current_Mortgage_Statement_3_1', 'Current_Mortgage_Statement_1_2', 'Current_Mortgage_Statement_2_2', 'Current_Mortgage_Statement_3_2', 'Current_Mortgage_Statement_1_3', 'Current_Mortgage_Statement_2_3', 'Current_Mortgage_Statement_3_3', 'Current_Mortgage_Statement_1_4', 'Current_Mortgage_Statement_2_4', 'Current_Mortgage_Statement_3_4', 'Current_Mortgage_Statement_1_5', 'Current_Mortgage_Statement_2_5', 'Current_Mortgage_Statement_3_5'];
    public const CODEBTOR_VEHICLEARRAY = ['Current_Auto_Loan_Statement', 'Current_Auto_Loan_Statement_1', 'Current_Auto_Loan_Statement_2', 'Current_Auto_Loan_Statement_3', 'Current_Auto_Loan_Statement_4'];
    public const OTHERLOANARRAY = ['Other_Loan_Statement_1', 'Other_Loan_Statement_2'];
    public const DOCTYPE_NOT_OWN = [
        'Debtor_Pay_Stubs' => 'I did not receive any employment income over the last 7 months.',
        'Co_Debtor_Pay_Stubs' => 'I did not receive any employment income over the last 7 months.',
        'Insurance_Documents' => "I don't have any insurance",
        'Current_Mortgage_Statement_1_1' => " I don't have any mortgages",
        'Current_Auto_Loan_Statement_1' => "I don't have any Auto Loans"
    ];
    public const DOCTYPE_NOT_OWN_ATTORNEY = [
        'Debtor_Pay_Stubs' => 'Client selected no employment income over the last 7 months.',
        'Co_Debtor_Pay_Stubs' => 'Client selected no employment income over the last 7 months.',
        'Insurance_Documents' => "Client selected no insurance",
        'Current_Mortgage_Statement_1_1' => "Client selected no Mortgage Loans",
        'Current_Auto_Loan_Statement_1' => "Client selected no Auto Loans"
    ];

    public const OWNBY_FORM_VALUES = [2, 4];
    public const BASIC_INFO_DASHBOARD_VIDEO = 1;
    public const BASIC_INFO_STEP1_VIDEO = 2;
    public const BASIC_INFO_STEP2_VIDEO = 3;
    public const BASIC_INFO_STEP3_VIDEO = 4;
    public const BASIC_INFO_STEP4_VIDEO = 5;
    public const BASIC_INFO_STEP5_VIDEO = 6;
    public const BASIC_INFO_STEP6_VIDEO = 7;
    public const PROPERTY_DASHBOARD_VIDEO = 8;
    public const PROPERTY_STEP1_VIDEO = 9;
    public const PROPERTY_STEP2_VIDEO = 10;
    public const PROPERTY_STEP3_VIDEO = 11;
    public const PROPERTY_STEP4_VIDEO = 12;
    public const PROPERTY_STEP5_VIDEO = 13;
    public const PROPERTY_STEP6_VIDEO = 14;
    public const INCOME_DEBTOR_EMPLOYEE_VIDEO = 18;
    public const INCOME_CO_DEBTOR_EMPLOYEE_VIDEO = 19;
    public const INCOME_DEBTOR_INCOME_VIDEO = 20;
    public const INCOME_CO_DEBTOR_INCOME_VIDEO = 21;
    public const INCOME_PROFIT_LOSS_PDF_VIDEO = 22;
    public const INCOME_SPOUSE_PROFIT_LOSS_PDF_VIDEO = 23;
    public const EXPENSE_DEBTOR_VIDEO = 24;
    public const EXPENSE_CO_DEBTOR_VIDEO = 25;
    public const SOFA_TAB_VIDEO = 26;
    public const SOFA_TAB_VIDEO_STEP_2 = 70;
    public const SOFA_TAB_VIDEO_STEP_3 = 71;
    public const SOFA_TAB_VIDEO_1 = 48;
    public const SOFA_TAB_VIDEO_2 = 49;
    public const SOFA_TAB_VIDEO_3 = 50;
    public const SOFA_TAB_VIDEO_4 = 51;
    public const INVITE_CLIENT_VIDEO = 27;
    public const INVITE_DOCUMENT_REQUEST_POPUP = 117;
    public const CREDITOR_SELECT_VIDEO = 139;
    public const MAIN_DOCUMENT_TUTORIAL_VIDEO = 28;
    public const DRIVING_LIC_TUTORIAL_VIDEO = 29;
    public const MORTGAGE_LOAN_TUTORIAL_VIDEO = 30;
    public const AUTO_LOAN_TUTORIAL_VIDEO = 31;
    public const SSN_ITIN_TUTORIAL_VIDEO = 32;

    public const VEHICLE_REGISTRATION_VIDEO = 39;
    public const VEHICLE_INFORMATION_VIDEO = 40;
    public const LAST_YEAR_TAX_RETURN_VIDEO = 41;
    public const YEAR_BEFORE_TAX_RETURN_VIDEO = 42;
    public const MISC_DOCUMENT_VIDEO = 43;
    public const MISC_DOCUMENT_W2_VIDEO = 44;
    public const MISC_DOCUMENT_W2_YEAR_BEFORE_VIDEO = 45;
    public const MAIN_MOBILE_APP_VIDEO = 46;
    public const PAYSTUB_TUTORIAL_VIDEO = 47;

    public const GUIDE_PAGE_TUTORIAL_VIDEO = 33;

    public const LANDING_PAGE_MAIN_VIDEO = 34;
    public const LANDING_PAGE_AFTER_MAIN_VIDEO = 35;
    public const LANDING_PAGE_CREDITORS_VIDEO = 36;
    public const LANDING_PAGE_PAYROLL_VIDEO = 37;
    public const LANDING_PAGE_BANK_ASSIST_VIDEO = 85;
    public const LANDING_PAGE_FULLY_AUTOMATE_VIDEO = 86;
    public const LANDING_PAGE_FULL_APP_VIDEO = 38;


    public const ATTORNEY_DASHBOARD_VIDEO = 52;
    public const ATTORNEY_CLIENT_MANAGEMENT_VIDEO = 53;
    public const ATTORNEY_CLIENT_QUESTIONNAIRE_VIDEO = 54;
    public const ATTORNEY_UPLOAD_CLIENT_DOCUMENT_VIDEO = 55;
    public const ATTORNEY_SEND_RECEIVE_SIGNED_DOC_VIDEO = 56;
    public const ATTORNEY_UPLOAD_CREDIT_REPORT_VIDEO = 57;
    public const ATTORNEY_CREDITORS_CREDIT_REPORT_VIDEO = 58;
    public const ATTORNEY_PAYROLL_ASSISTANT_VIDEO = 59;
    public const ATTORNEY_SPOUSE_PAYROLL_ASSISTANT_VIDEO = 60;
    public const ATTORNEY_ADDITIOANL_DOCUMENT_UPLOAD = 61;
    public const ATTORNEY_CHAT_MANAGEMENT = 62;
    public const ATTORNEY_TRANSACTION_MANAGEMENT = 63;
    public const ATTORNEY_SETTINGS = 64;
    public const LANDING_PAGE_PRICING_PLAN_VIDEO = 65;
    public const ATTORNEY_SETTING_SUBSCRIPTION = 67;
    public const ATTORNEY_SETTING_PETITION_PREP = 68;
    public const ATTORNEY_SETTING_WELCOME_VIDEO = 69;
    public const ATTORNEY_NOTES_ADDED_BY_ATTORNEY_VIDEO = 118;


    public const ATTORNEY_CHAPTER_7_GUIDE = 72;
    public const ATTORNEY_CHAPTER_13_GUIDE = 73;
    public const ATTORNEY_SHORT_FORM_LISTING_VIDEO = 84;

    public const INCOME_DEBTOR_EMPLOYEE_WITH_PAYROLL_VIDEO = 74;
    public const INCOME_CO_DEBTOR_EMPLOYEE_WITH_PAYROLL_VIDEO = 75;

    public const LANDING_PAGE_SUBSCRIPTION_VIDEO = 66;
    public const PROPERTY_STEP4_CONTINUED_VIDEO = 76;

    public const FATYPE_ALIMONY = 1;
    public const FATYPE_MAINTENANCE = 2;
    public const FATYPE_SUPPORT = 3;
    public const FATYPE_DIVORCE_SETTLEMENT = 4;
    public const FATYPE_PROPERTY_SETTLEMENT = 5;
    public const FATYPE_SUPPORT_2 = 6;
    public const FATYPE_SUPPORT_3 = 7;

    public const PAYROLL_GUIDE_PAGE_TUTORIAL_VIDEO = 77;
    public const PAYROLL_ASSISTANT_STEP_BY_STEP_VIDEO = 78;

    public const VIDEO_LP1_VIDEO = 79;
    public const VIDEO_LP2_VIDEO = 80;
    public const VIDEO_LP3_VIDEO = 81;
    public const VIDEO_LP4_VIDEO = 82;
    public const VIDEO_LP5_VIDEO = 83;

    public const PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID = 87;
    public const CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID = 88;
    public const VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID = 89;

    public const DOCUMENT_PAGE_DESKTOP_VIDEO_GUIDE = 90;
    public const DOCUMENT_PAGE_IPHONE_VIDEO_GUIDE = 91;
    public const DOCUMENT_PAGE_ANDROID_VIDEO_GUIDE = 92;

    public const LANDING_PAGE_10_REASON_AUTOMATED_DOCUMENT_COLLECTION = 93;
    public const LANDING_PAGE_10_REASON_DYNAMIC_QUESTIONING = 94;

    public const LANDING_PAGE_10_REASON_DOCUMENT_MANAGMENT = 95;
    public const LANDING_PAGE_10_REASON_DETAILED_PROPERTY_TAB = 96;
    public const LANDING_PAGE_10_REASON_BUILT_IN_REVOLUTIONARY_FOLLOW_UP_SYSTEM = 97;
    public const LANDING_PAGE_10_REASON_COLLABORATIVE_CLIENT_ENGAGEMENT = 98;

    public const LANDING_PAGE_10_REASON_BUILT_IN_COMMON_CREDITOR_LISTS = 105;
    public const LANDING_PAGE_10_REASON_AUTOMATED_DOCUMENT_CONVERSION_TOPDF = 106;

    public const PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE = 99;
    public const CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE = 100;
    public const VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE = 101;

    public const PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE = 102;
    public const CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE = 103;
    public const VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE = 104;

    public const CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE = 133;
    public const CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID = 134;
    public const CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE = 135;
    public const PROPERTY_VIN_TUTORIAL = 116;

    public const LANDING_PAGE_BIG_TAB_VIDEO = 119;

    public const VIDEO_PROOF_OF_AUTO_INSURANCE = 120;

    public const VIDEO_OTHER_MISC_DOCUMENT = 121;

    public const VIDEO_SOCIAL_SECURITY_ANNUAL_AWARD_LETTER = 122;

    public const VIDEO_VA_BENEFIT_AWARD_LETTER = 123;

    public const VIDEO_UNEMPLOYMENT_CERTIFICATE = 124;

    public const YEAR_BEFORE_TWO_TAX_RETURN_VIDEO = 125;

    public const YEAR_BEFORE_THREE_TAX_RETURN_VIDEO = 126;

    public const VIDEO_RETIREMENT_DOCUMENT = 127;

    public const VIDEO_PRE_FILING_CC_DOCUMENT = 128;

    public const VIDEO_BANK_ACCOUNT_DOCUMENT = 129;

    public const VIDEO_PAYPAL_CASH_VENMO_ACCOUNT_DOCUMENT = 130;

    public const VIDEO_BROKERAGE_ACCOUNT_DOCUMENT = 131;

    public const VIDEO_LIFE_INSURANCE_DOCUMENT = 132;

    public const GROSS_BUSINESS_INCOME = 'gross_business_income';
    public const COST_OF_GOODS_SOLD = 'cost_of_goods_sold';
    public const ADVERTISING_EXPENSE = 'advertising_expense';
    public const SUBCONTRACTOR_PAY = 'subcontractor_pay';
    public const PROFESSIONAL_SERVICE = 'professional_service';
    public const CC_EXPENSE = 'cc_expense';
    public const EQUIPMENT_RENTAL_EXPENSE = 'equipment_rental_expense';
    public const INSURANCE_EXPENSE = 'insurance_expense';
    public const LICENSES_EXPENSE = 'licenses_expense';
    public const OFFICE_SUPPLIES_EXPENSE = 'office_supplies_expense';
    public const POSTAGE_EXPENSE = 'postage_expense';
    public const RENT_OFFICE_EXPENSE = 'rent_office_expense';
    public const BANK_FEE_AND_INTEREST = 'bank_fee_and_interest';
    public const SOFTWARE_AND_SUBSCRIPTION = 'software_and_subscription';
    public const SUPPLIES_MATERIAL_EXPENSE = 'supplies_material_expense';
    public const TRAVEL_EXPENSE = 'travel_expense';
    public const UTILITY_EXPENSE = 'utility_expense';
    public const VEHICLE_EXPENSE = 'vehicle_expense';
    public const OTHER_1 = 'other_1';
    public const OTHER_2 = 'other_2';
    public const OTHER_3 = 'other_3';

    public const CALENDY_CONCIERGE_APPOINTMENT_URL = 'https://calendly.com/bkquestionnaire/questionnaire-concierge-service';
    public const CALENDY_CONCIERGE_DOC_REVIEW_URL = 'https://calendly.com/bkquestionnaire/final-document-questionnaire-review';
    public const CALENDY_CONCIERGE_PROCESS_OVERVIEW_CALL_URL = 'https://calendly.com/bkquestionnaire/process-overview-call';
    public const CALENDY_BOOK_A_MEETING_URL = 'https://calendly.com/bkquestionnaire/consulltation';


    public const PROPERTY_FINANCIAL_ASSETS_QUE_KEYS = ['cash', 'bank', 'venmo_paypal_cash', 'brokerage_account', 'mutual_funds', 'government_corporate_bonds', 'traded_stocks', 'retirement_pension', 'security_deposits', 'annuities', 'education_ira', 'trusts_life_estates', 'patents_copyrights', 'licenses_franchises', 'tax_refunds'];
    public const PROPERTY_FINANCIAL_ASSETS_CONTINUTED_QUE_KEYS = ['alimony_child_support', 'unpaid_wages', 'life_insurance', 'insurance_policies', 'inheritances', 'injury_claims', 'other_claims', 'other_financial', 'is_business_property', 'is_farm_property'];


    public static function returnArrValue($arr, $key)
    {
        if ($key === null) {
            return $arr;
        } elseif (array_key_exists($key, $arr)) {
            return $arr[$key];
        } else {
            return '';
        }
    }

    public static function validate_value($string)
    {
        return (!empty($string)) ? $string : "";
    }

    public static function formatPrice($val, $numberFormat = 1, $displaySymbol = 1, $stringFormat = 0)
    {
        $val = (float) ($val);
        $currencyValue = 1;
        $currencySymbolLeft = '$';
        $currencySymbolRight = '';
        $val = $val * $currencyValue;
        $sign = '';
        if ($val < 0) {
            $val = abs($val);
            $sign = '-';
        }
        if ($numberFormat && !$stringFormat) {
            $val = number_format($val, 2);
        } else {
            $afterDecimal = $val - floor($val);
            $val = (0 < $afterDecimal ? number_format($val, 2, '.', '') : $val);
        }
        if ($stringFormat) {
            $val = static::numberStringFormat($val);
        }
        if ($displaySymbol) {
            $sign .= ' ';

            return trim($sign . $currencySymbolLeft . $val . $currencySymbolRight);
        }

        return trim($sign . $val);
    }
    public static function numberStringFormat($number)
    {
        $prefixes = 'KMGTPEZY';
        if ($number >= 1000) {
            for ($i = -1; $number >= 1000; ++$i) {
                $number = $number / 1000;
            }

            return floor($number) . $prefixes[$i];
        }

        return $number;
    }

    public static function validate_key_value($key, $string, $returnFormat = "", $allowComma = 0)
    {
        if (!empty($returnFormat) && isset($string[$key])) {
            return self::formatSwitchStatement($key, $string, $returnFormat, $allowComma);
        } else {
            return self::getDefaultValueForKeyValue($key, $string, $returnFormat);
        }
    }
    public static function validate_enable_disable($key, $string)
    {
        return ((empty($string) || (isset($string[$key]) && $string[$key] == 1)) || (!empty(empty($string)) && !isset($string[$key]))) ? "" : "(Attorney disabled this question)";
    }
    private static function formatSwitchStatement($key, $string, $returnFormat, $allowComma)
    {
        $value = '';
        switch ($returnFormat) {
            case 'float':
                $value = self::numberFormatWithComma($key, $string, $allowComma);
                break;
            case 'radio':
                $value = (int)$string[$key];
                break;
            case 'phone':
                $data = $string[$key];
                $value = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $data);
                break;
            case 'comma':
                $data = $string[$key];
                $value = number_format((float) $data, 2, '.', ',');
                break;
            case 'without-comma':
                $data = $string[$key];
                $value = str_replace(',', '', $data);
                break;
            case 'array':
                $value = (!empty($string[$key])) ? $string[$key] : [];
                break;
            case 'int':
                $value = (int)$string[$key];
                break;
            default:
                $value = number_format((float) $string[$key], 2, '.', '');
                break;
        }
        return $value;
    }
    private static function numberFormatWithComma($key, $string, $allowComma)
    {
        if (!$allowComma) {
            return number_format((float) $string[$key], 2, '.', '');
        } else {
            return number_format((float) $string[$key], 2, '.', ',');
        }
    }
    private static function getDefaultValueForKeyValue($key, $string, $returnFormat)
    {
        if (!empty($returnFormat) && $returnFormat == 'float') {
            return (!empty($string[$key])) ? $string[$key] : "0.00";
        }
        if (!empty($returnFormat) && $returnFormat == 'array') {
            return (!empty($string[$key])) ? $string[$key] : [];
        }
        if (!empty($returnFormat) && $returnFormat == 'radio') {
            return (!empty($string[$key])) ? ($string[$key] == '' ? 0 : (int)$string[$key]) : 0;
        }
        if (!empty($returnFormat) && $returnFormat == 'int') {
            return (!empty($string[$key])) ? (int)$string[$key] : '';
        }

        return (!empty($string[$key])) ? $string[$key] : "";
    }

    public static function priceFormt($value)
    {
        $value = preg_replace('/[\$,]/', '', $value);
        $value = floatval($value);
        $formatted = number_format($value, 2, '.', '');

        return $formatted === '0.00' ? '0.00' : $formatted;
    }


    public static function priceFormtWithComma($val)
    {
        $val = str_replace(',', '', $val);

        return isset($val) ? number_format((float) $val, 2, '.', ',') : 0.00;
    }


    public static function ssnFormt($data)
    {
        $ssn = preg_replace('/[^\d]/', '', $data);

        return preg_replace('/^(\d{3})(\d{2})(\d{4})$/', '$1-$2-$3', $ssn);
    }

    public static function validate_key_toggle($key, $string, $match)
    {
        return (isset($string[$key]) && $string[$key] == $match) ? "checked='checked'" : "";
    }

    public static function validate_key_toggle_active($key, $string, $match)
    {
        return (isset($string[$key]) && $string[$key] == $match) ? "active" : "";
    }

    public static function validate_key_option($key, $string, $match)
    {
        return (isset($string[$key]) && $string[$key] == $match) ? "selected='selected'" : "";
    }
    public static function validate_key_option_loop($key, $string, $k, $match)
    {
        return (isset($string[$key][$k]) && $string[$key][$k] == $match) ? "selected='selected'" : "";
    }

    public static function validate_key_loop_value_match($key, $string, $k, $match)
    {
        return (!empty($string[$key][$k])) && $string[$key][$k] == $match ? 1 : 0;

    }

    public static function validate_key_value_match($key, $string, $match)
    {
        return (!empty($string[$key])) && $string[$key] == $match ? 1 : 0;
    }

    public static function validate_key_loop_value($key, $string, $k)
    {
        return (!empty($string[$key][$k])) ? $string[$key][$k] : "";
    }
    public static function validate_key_loop_value_radio($key, $string, $k)
    {
        return (isset($string[$key][$k])) ? $string[$key][$k] : "";
    }
    public static function validate_key_array_value($k, $string, $key)
    {
        return (!empty($string[$key][$k])) ? $string[$key][$k] : "";
    }
    public static function validate_key_loop_value_exclude_comma($key, $string, $k)
    {
        return (!empty($string[$key][$k])) ? str_replace(",", "", $string[$key][$k]) : "";
    }
    public static function bciString($string)
    {
        return (isset($string) && !empty($string)) ? str_replace(",", "", $string) : '';
    }

    public static function formatArgylePrice($price)
    {
        //return $price != 0 ? number_format($price / 100, 2, ".", "") : 0;
        return $price != 0 ? number_format($price, 2, ".", "") : 0;
    }

    public static function validate_key_value_exclude_comma($key, $string)
    {
        return (isset($string[$key]) && !empty($string[$key])) ? str_replace(",", "", $string[$key]) : "";
    }
    public static function validate_key_loop_toggle($key, $string, $match, $k)
    {
        return (isset($string[$key][$k]) && $string[$key][$k] == $match) ? "checked='checked'" : "";
    }

    public static function validate_key_loop_toggle_active($key, $string, $match, $k)
    {
        return (isset($string[$key][$k]) && $string[$key][$k] == $match) ? "active" : "";
    }
    public static function validate_toggle($string, $match)
    {
        return (isset($string) && $string == $match) ? "checked='checked'" : "";
    }

    public static function key_hide_show($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 0) ? "hide-data" : "";
    }

    public static function key_hide_show_ownedby($key, $string)
    {
        return (isset($string[$key]) && in_array($string[$key], [2, 4])) ? "" : "hide-data";
    }

    public static function key_hide_show_v($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 1) ? "" : "hide-data";
    }

    public static function key_hide_show_v2($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 0) ? "" : "hide-data";
    }

    public static function hide_show($string)
    {
        return (isset($string) && $string == 0) ? "hide-data" : "";
    }
    public static function key_display($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 1) ? "Yes" : "No";
    }
    public static function key_display_reverse($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 1) ? "No" : "Yes";
    }
    public static function paralegal_key_display($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 1) ? "<span class='psucc'>OK</span>" : "<span class='gray'>N/A</span>";
    }

    public static function key_display_none_type($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 1) ? "" : "None";
    }

    public static function key_display_yesno_color($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 1) ? "Yes" : "No";
    }

    public static function key_display_attorney_ques($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 1) ? "<span class='font-weight-normal text-c-green'>Yes</span>" : "<span class='text-c-red text-bold'>None</span>";
    }

    public static function key_display_attorney_ques_plain($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 1) ? "Yes" : "None";
    }



    public static function key_display_none_type_reverse($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 1) ? "<span class='text-c-red text-bold'>None</span>" : "";
    }

    public static function keyDisplayRemoveYes($key, $string)
    {
        return (isset($string[$key]) && $string[$key] == 1) ? "" : ":None";
    }

    public static function current($val)
    {
        return is_array($val) ? current($val) : $val;
    }

    public static function valueFromObjectArray($key, $object, $k)
    {
        return (!empty($object->$key) && !empty($object->$key[$k])) ? $object->$key[$k] : "";
    }

    public static function valueFromObject($key, $object)
    {
        return (!empty($object->$key) && !empty($object->$key)) ? $object->$key : "";
    }

    public static function renderJsonError($msg)
    {
        return self::dieWithJsonData(0, ['msg' => $msg]);
    }

    public static function renderJsonSuccess($msg, $data = [])
    {
        return self::dieWithJsonData(self::SUCCESS, $data + ['msg' => $msg]);
    }

    public static function renderApiError($msg)
    {
        return ['message' => $msg, "status" => false] + ['data' => null];
    }

    public static function renderApiSuccess($msg, $data = [])
    {
        return $data + ['message' => $msg, "status" => true];
    }

    public static function dieWithJsonData($status, $data)
    {
        $data['status'] = "0";
        if ($status === self::SUCCESS) {
            $data['status'] = "1";
        } else {
            $data['status'] = $status;
        }

        return $data;
    }

    public static function getChapterName($key = null)
    {
        $arr = ['chapter7' => 'Chapter 7', 'chapter11' => 'Chapter 11', 'chapter12' => 'Chapter 12', 'chapter13' => 'Chapter 13'];

        return is_array(static::returnArrValue($arr, $key)) ? '' : static::returnArrValue($arr, $key);
    }


    public static function replaceNullWithEmptyString(&$item, $convertToString)
    {
        if ($convertToString == true) {
            if (is_array($item)) {
                array_walk_recursive($item, "self::replaceNullWithEmptyString", $convertToString);
            }
        }
    }

    public static function irsState($code)
    {
        $item = [
            'code' => 'PA',
            'address_heading' => 'Internal Revenue Service',
            'add1' => 'P.O. Box 7346',
            'add2' => 'Philadelphia, PA 19101',
            'city' => 'Philadelphia',
            'zip' => '19101'
        ];

        if ($code == null) {
            return $item;
        }
        if ($code == $item['code']) {
            return $item;
        }

        return [];
    }

    public static function lastchar($str)
    {
        $n = 4;
        $start = strlen($str) - $n;

        return substr($str, $start);
    }

    public static function getArrayByKey($key, $array)
    {
        foreach ($array as $doc) {
            if ($doc['document_type'] == $key) {
                return $doc;
            }
        }

        return [];
    }

    public static function getArrayByKeyArray($key, $arraylist, $name, $attorneyDocs, $clientDocs, $adminDocs)
    {

        $multipleUpload = \App\Models\ClientDocumentUploaded::MULTIPLE_DOC_ALLOWED_FOR;
        $multipleUpload = array_merge($multipleUpload, $attorneyDocs);
        $multipleUpload = array_merge($multipleUpload, $clientDocs);
        $multipleUpload = array_merge($multipleUpload, $adminDocs);
        $images = [];
        foreach ($arraylist as $doc) {
            if ($doc['document_type'] == $key) {
                if (in_array($key, $multipleUpload)) {
                    $doc['document_name'] = $name;
                    array_push($images, $doc);
                } else {
                    return $doc;
                }
            }
        }

        return $images;
    }

    public static function getUnreadNotificationCount()
    {
        $count = 0;
        if (Auth::user()->role == \App\Models\USER::CLIENT) {
            $count = Auth::user()->notifications_count;
        }

        return $count;
    }

    public static function getDocuments($clientType, $includeproperty = 0, $includesub = 0, $includemaster = 0, $includeBankAssistant = 0, $uploadScreenList = 0, $attorney_id = 0)
    {
        switch ($clientType) {
            case Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED:
                $docs = \App\Models\ClientDocumentUploaded::getNotMarriedDocuments($includesub, $includemaster, $includeBankAssistant, $uploadScreenList, $attorney_id);
                break;
            case Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED:
                $docs = \App\Models\ClientDocumentUploaded::getIndividualMarriedDocuments($includesub, $includemaster, $includeBankAssistant, $uploadScreenList, $attorney_id);
                break;
            case Helper::CLIENT_TYPE_JOINT_MARRIED:
                $docs = \App\Models\ClientDocumentUploaded::getJointMarriedDocuments($includesub, $includemaster, $includeBankAssistant, $uploadScreenList, $attorney_id);
                break;
            default:
                $docs = [];
                break;
        }

        if ($includeproperty && $uploadScreenList == 0) {
            $docs = $docs + self::propertyTypes();
        }

        return $docs;
    }

    public static function getAllDocumentTypes()
    {
        $documentTypes = self::getDocuments(3);
        $documentTypes['Current_Mortgage_Statement'] = 'Current Mortgage Statement(s)';
        $documentTypes['Current_Auto_Loan_Statement'] = 'Current Auto Loan Statement(s)';
        $documentTypes = $documentTypes + Helper::getMiscDocs();
        $documentTypes = $documentTypes + ['debtor_VA_Benefit_Award_Letter' => "VA Benefit Award Letter"];
        $documentTypes = $documentTypes + ['life_insurance' => "Life Insurance"];
        $documentTypes = $documentTypes + ['debtor_Social_Security_Annual_Award_Letter' => "Social Security Annual Award Letter"];
        $documentTypes = $documentTypes + ['Pre_Filing_Bankruptcy_Certificate_CCC' => 'Pre-Filing Bankruptcy Certificate(s)'];
        $documentTypes = $documentTypes + ['debtor_Unemployment_Payment_History_Last_7_Months' => 'Unemployment Certificate'];
        $documentTypes = $documentTypes + [\App\Models\ClientDocumentUploaded::OTHER_MISC_DOCUMENTS => "Debt(s)/Collection Statements"];
        $documentTypes = $documentTypes + ['retirement_pension' => "Retirement Statement"];

        return $documentTypes;
    }

    public static function getDocumentsForAttorneySide($clientType)
    {
        switch ($clientType) {
            case Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED:
                $docs = \App\Models\ClientDocumentUploaded::getNotMarriedDocumentsForAttorney();
                break;
            case Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED:
                $docs = \App\Models\ClientDocumentUploaded::getIndividualMarriedDocumentsForAttorney();
                break;
            case Helper::CLIENT_TYPE_JOINT_MARRIED:
                $docs = \App\Models\ClientDocumentUploaded::getJointMarriedDocumentsForAttorney();
                break;
            default:
                $docs = [];
                break;
        }

        return $docs;
    }

    public static function propertyTypes()
    {
        return self::getResidence() + self::getVehicle();
    }

    public static function getVehicle()
    {
        return \App\Models\ClientDocumentUploaded::getAutoloanKeyValue();
    }
    public static function getVehicleForAppSelection()
    {
        $vehicles = \App\Models\ClientDocumentUploaded::getAutoloanKeyValueForAppSelection();
        $keyvaluearray = [];
        foreach ($vehicles as $key => $val) {
            array_push($keyvaluearray, ['key' => $key, 'value' => $val]);
        }

        return $keyvaluearray;
    }

    public static function getResidence($includemaster = 0)
    {
        return \App\Models\ClientDocumentUploaded::getResidenceKeyValue($includemaster);
    }

    public static function getDocumentImage($key = null)
    {
        $arr = \App\Models\ClientDocumentUploaded::getDocumentTypes();

        return Helper::returnArrValue($arr, $key);
    }

    public static function getMiscDocs()
    {
        return \App\Models\ClientDocumentUploaded::getMiscDocs();
    }

    public static function getAllDocument($attorney_id = 0)
    {
        return \App\Models\ClientDocumentUploaded::getAllDocuments($attorney_id);
    }

    public static function Attachment_upload($request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'attachment' => 'required|mimes:jpg,jpeg,png|max:20480',
                'to_user_id' => 'required',
            ],
            [
                'attachment.required' => 'Please upload file.',
                'attachment.max' => 'Attachment size should not be greater than 20MB.',
                'attachment.mimes' => 'Attachment type should be jpg, jpeg, png.',
                'to_user_id.required' => 'Please enter to user id.',
            ]
        );

        if ($validate->fails()) {
            return response()->json(['message' => $validate->errors()->first()], 422);
        }
        $extension = '.' . $request->file('attachment')->getClientOriginalExtension();

        $destination_path = storage_path() . DIRECTORY_SEPARATOR . env('CHAT_STORAGE_FILE');
        $image_name = date('mdYHis') . rand(10, 1000) . uniqid() . $extension;

        $image = $request->file('attachment');
        $image->move($destination_path, $image_name);

        return response()->json(['message' => 'success', 'data' => $image_name], 200);
    }

    public static function client_chat_global()
    {
        $admin = \App\Models\User::first();
        $attorney = Auth::user();
        $pluck_attroney_clients_ids = \App\Models\Message::select('from_user_id')->where('to_user_id', $attorney->id)->groupby('from_user_id');
        $authUserId = $attorney->id;
        $clients = \App\Models\User::select(
            'users.id',
            'users.name',
            'users.role',
            'users.socket_id',
            'messages.message as message',
            'messages.sent_at',
            DB::raw("(CASE WHEN messages.type = 2 THEN 'Image' ELSE messages.message END ) AS 'message'"),
            DB::raw("(SELECT COUNT(*) FROM messages WHERE (messages.to_user_id = '$authUserId') AND (messages.from_user_id = users.id) AND messages.status = 1) as unread_count")
        )
            ->whereIn('users.id', $pluck_attroney_clients_ids)
            ->leftJoin('messages', function ($query) use ($authUserId) {
                $query->on('messages.id', DB::raw("(SELECT MAX(messages.id) FROM messages WHERE (messages.from_user_id = '$authUserId' OR messages.to_user_id = '$authUserId') AND (messages.from_user_id = users.id OR messages.to_user_id = users.id))"));
            })->orderBy('messages.sent_at', 'DESC')->get();

        return ['clients' => $clients, 'attorney' => $attorney, 'admin' => $admin];
    }

    public static function find_client_attorney_id()
    {
        $client_id = Auth::user()->id;
        $find_client_attorney = \App\Models\ClientsAttorney::whereClientId($client_id)->first();
        $find_attorney = \App\Models\ClientsAttorney::with('getuserattorney')->whereClientId($client_id)->first();
        if (!empty($find_attorney)) {
            $find_client_attorney['attorney_username'] = $find_attorney->getuserattorney->name;
        }

        return $find_client_attorney;
    }

    public static function AdminAttorneyChatListing()
    {
        $authUserId = Auth::user()->id;
        $attorney = \App\Models\User::select(
            'users.id',
            'users.name',
            'users.socket_id',
            'messages.message as message',
            'messages.sent_at',
            DB::raw("(CASE WHEN messages.type = 2 THEN 'Image' ELSE messages.message END ) AS 'message'"),
            DB::raw("(SELECT COUNT(*) FROM messages WHERE (messages.to_user_id = '$authUserId') AND (messages.from_user_id = users.id) AND messages.status = 1) as unread_count")
        )
            ->where('users.role', \App\Models\User::ATTORNEY)
            ->leftJoin('messages', function ($query) use ($authUserId) {
                $query
                    ->on('messages.id', DB::raw("(SELECT MAX(messages.id) FROM messages WHERE (messages.from_user_id = '$authUserId' OR messages.to_user_id = '$authUserId') AND (messages.from_user_id = users.id OR messages.to_user_id = users.id))"));
            })->orderBy('messages.sent_at', 'DESC')->get();

        return $attorney;
    }



    public static function getBankStatementsSelection($code = '')
    {
        $bankStatementArrayList = self::getBankStatementsArray();

        return self::createSelectionFromArray($bankStatementArrayList, $code);
    }

    public static function getProfitLossAssitantSelection($code = '')
    {
        $rollarrayList = self::getProfitLossAssistantArray();

        return self::createSelectionFromArray($rollarrayList, $code);
    }

    public static function getCreditReportSelection($code = '')
    {
        $rollarrayList = self::getCreditReportArray();

        return self::createSelectionFromArray($rollarrayList, $code);
    }

    public static function getBankStatementsArray($key = null)
    {
        $arr = [
            0 => "None",
            static::BANK_STATEMENTS_DEBTOR => "Debtor 1",
            static::BANK_STATEMENTS_CODEBTOR => "Debtor 2",
            static::BANK_STATEMENTS_BOTH => "Debtor 1 & 2 both"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getProfitLossAssistantArray($key = null)
    {
        $arr = [
            0 => "None",
            static::PROFIT_LOSS_ASSISTANT_TYPE_DEBTOR => "Debtor 1",
            static::PROFIT_LOSS_ASSISTANT_TYPE_CODEBTOR => "Debtor 2 - Spouse",
            static::PROFIT_LOSS_ASSISTANT_TYPE_BOTH => "Debtor 1 & 2"
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getCreditReportArray($key = null)
    {
        $arr = [
            0 => "None",
            static::CREDIT_REPORT_TYPE_DEBTOR => "Debtor 1",
            static::CREDIT_REPORT_TYPE_CODEBTOR => "Debtor 2 - Spouse",
            static::CREDIT_REPORT_TYPE_BOTH => "Debtor 1 & 2"
        ];

        return static::returnArrValue($arr, $key);
    }



    // Chat GLOBAL FUNCTIONS END

    public static function getTitleAndDescription()
    {
        $registerDesc = "";
        $registerTitle = "";

        if (request()->routeIs('register') && request()->package_id == 'standard') {
            $registerTitle = "Sign Up for Standard Plan - BK Assistant";
            $registerDesc = "Join BK Assistant's Standard platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.";
        } elseif (request()->routeIs('register') && request()->package_id == 'premium') {
            $registerTitle = "Sign Up for premium Plan - BK Assistant";
            $registerDesc = "Join BK Assistant's Premium platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.";
        } elseif (request()->routeIs('register') && request()->package_id == 'ultimate') {
            $registerTitle = "Sign Up for ultimate Plan - BK Assistant";
            $registerDesc = "Join BK Assistant's Ultimate platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.";
        } elseif (request()->routeIs('register') && request()->package_id == 'ultimateplus') {
            $registerTitle = "Sign Up for ultimate plus Plan - BK Assistant";
            $registerDesc = "Join BK Assistant's Ultimate Plus platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.";
        } elseif (request()->routeIs('register') && request()->package_id == 'premiumplus') {
            $registerTitle = "Sign Up for Premium Plus Plan - BK Assistant";
            $registerDesc = "Join BK Assistant's Premium Plus platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.";
        } elseif (request()->routeIs('register') && request()->package_id == 'black_label') {
            $registerTitle = "Sign Up for Black Label Plan - BK Assistant";
            $registerDesc = "Join BK Assistant's Black Label platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.";
        } elseif (request()->routeIs('register') && request()->package_id == 'basic_plus') {
            $registerTitle = "Sign Up for Standard Plus Plan - BK Assistant";
            $registerDesc = "Join BK Assistant's Standard Plus platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.";
        } elseif (request()->routeIs('register') && request()->package_id == 'payroll_assistant') {
            $registerTitle = "Sign Up for Payroll Assistant Plan - BK Assistant";
            $registerDesc = "Join BK Assistant's Payroll Assistant platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.";
        }

        if (request()->routeIs('register')) {
            return [
                "title" => $registerTitle ?? "BK Questionnaire: Register for insightful surveys",
                "description" => !empty($registerDesc) ? $registerDesc : "Discover BK Questionnaire: Register now to gain valuable insights. Join our platform and unlock a world of knowledge and answers to your burning questions.",
                "keywords" => "",
            ];
        } elseif (request()->routeIs('login')) {
            return [
                "title" => "Secure Attorney Login - BK Questionnaire",
                "description" => "Access your account or sign up for BK Questionnaire. Secure login for attorneys. Forgot password? Easily reset or create your account now.",
                "keywords" => "",
            ];
        } elseif (request()->routeIs('client_login') && request()::capture()->query('web')) {
            return [
                "title" => "Client Login Web Portal - BK Questionnaire",
                "description" => "Access your account securely with BK Assistant's client login web portal. Forgot password? Contact us for technical support at 1-888-356-5777 or text (949) 994-4190.",
                "keywords" => "",
            ];
        } elseif (request()->routeIs('client_login')) {
            return [
                "title" => "Client Login Portal - BK Questionnaire",
                "description" => "Access your account securely with BK Assistant's client login portal. Forgot password? Contact us for technical support at 1-888-356-5777 or text (949) 994-4190.",
                "keywords" => "",
            ];
        } elseif (request()->routeIs('pricing')) {
            return [
                "title" => "Our Pricing Plans - BK Questionnaire",
                "description" => "Check out our transparent pricing plans at BK Questionnaire, which offer comprehensive plans tailored to meet your needs and budget requirements.",
                "keywords" => "",
            ];
        } elseif (request()->routeIs('resources')) {
            return [
                "title" => "BK Questionnaire - Benefits",
                "description" => "Explore our wide range of valuable benefits at BK Questionnaire. Find insightful articles, guides, and tools to enhance your knowledge and expertise in various domains.",
                "keywords" => "",
            ];
        } elseif (request()->routeIs('about')) {
            return [
                "title" => "BK Questionnaire - About Us",
                "description" => "BK Questionnaire is a leading platform providing engaging and informative quizzes. Explore our website for exciting quizzes and test your knowledge today!",
                "keywords" => "",
            ];
        } elseif (request()->routeIs('terms_of_services')) {
            return [
                "title" => "Terms of Services | BK Assistant",
                "description" => "BK Assistant - Terms of Services",
                "keywords" => "",
            ];
        } elseif (request()->routeIs('password.request')) {
            return [
                "title" => "Reset Password | BK Assistant",
                "description" => "BK Assistant - Reset Password",
                "keywords" => "",
            ];
        } else {
            return [
                "title" => "Bankruptcy Software for Attorneys & Law Firms | Online Solutions",
                "description" => "Explore top bankruptcy filing software for attorneys. Streamline processes with our online bankruptcy questionnaire, forms, and solutions for law firms.",
                "keywords" => "Online Bankruptcy Attorney, Bankruptcy Filing Software, Bankruptcy Software for Attorneys, Bankruptcy Questionnaire, Bankruptcy Solutions, Bankruptcy Software, Bankruptcy Law Firm, Bankruptcy Forms",
            ];
        }
    }

    public static function dependent_relationship($relation = null)
    {
        $arrayList = [
            '1' => "Son",
            '2' => "Daughter",
            '3' => "Stepson",
            '4' => "Stepdaughter",
            '5' => "Foster Son",
            '6' => "Foster Daughter",
            '7' => "Nephew",
            '8' => "Niece",
            '9' => "Father",
            '10' => "Mother",
            '11' => "Brother",
            '12' => "Sister",
            '13' => "Grandson",
            '14' => "Granddaughter",
            '15' => "Grandfather",
            '16' => "Grandmother",
            '17' => "Uncle",
            '18' => "Aunt",
            '19' => "Son-In-Low",
            '20' => "Daughter-In-Low",
            '21' => "Father-In-Low",
            '22' => "Mother-In-Low",
            '23' => "Husband",
            '24' => "Wife",
            '25' => "Spouse"
        ];

        $list = '';
        foreach ($arrayList as $value) {
            $selected = !empty($relation) && $relation == $value ? 'selected' : '';
            $list .= "<option value='" . $value . "' " . $selected . ">" . $value . "</option>";
        }

        return $list;
    }

    public static function getVehiclesClientSelections($code = '')
    {

        $arrayList = [
            ['key' => self::VEHICLE_CARS_TK, 'label' => "Cars"],
            ['key' => self::VEHICLE_CARS_TK, 'label' => "Motorcycles"],
            ['key' => self::VEHICLE_CARS_TK, 'label' => "Vans"],
            ['key' => self::VEHICLE_CARS_TK, 'label' => "Trucks"],
            ['key' => self::VEHICLE_CARS_TK, 'label' => "Sport utility vehicles"],
            ['key' => self::VEHICLE_RECREATINAL_VEHICLE, 'label' => "Tractors"],
            ['key' => self::VEHICLE_RECREATINAL_VEHICLE, 'label' => "Watercraft"],
            ['key' => self::VEHICLE_RECREATINAL_VEHICLE, 'label' => "Motor homes"],
            ['key' => self::VEHICLE_RECREATINAL_VEHICLE, 'label' => "ATVs"],
            ['key' => self::VEHICLE_RECREATINAL_VEHICLE, 'label' => "Other vehicles"]
        ];

        $vlist = '';

        foreach ($arrayList as $vehicle) {
            $selected = !empty($code) && $code == $vehicle['key'] ? 'selected' : '';
            $vlist .= "<option value='" . $vehicle['key'] . "' data-label='" . $vehicle['label'] . "' " . $selected . ">" . $vehicle['label'] . "</option>";
        }

        return $vlist;
    }

    public static function getSourceOfIncomeArray($key = null)
    {
        $arr = [
            11 => 'None',
            1 => 'Alimony / Maintenance',
            2 => 'Child Support',
            3 => "Disability (EDD)",
            4 => "Early Retirement Distributions",
            5 => "Household Contributions",
            6 => 'Interest/Dividends',
            7 => 'Rental Income',
            8 => 'Retirement Income',
            9 => 'Social Security Benefits',
            10 => "VA Disability",
            -1 => 'Other',
        ];
        if ($key != "" || $key == null) {
            $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getIncomeEntries($spouse, $periodKey, $financialaffairsInfo)
    {
        $entries = [];

        for ($i = 0; $i < 3; $i++) {
            $suffix = $i == 0 ? '' : '_second';
            $amountKey = 'other_amount_' . $spouse . $periodKey . $suffix;
            $sourceKey = 'other_income_received_' . $spouse . $periodKey . $suffix;
            $sourceTextKey = $sourceKey . '_text';

            if (!empty(self::validate_key_value($amountKey, $financialaffairsInfo))) {
                $entries[] = [
                    'amount' => self::validate_key_value($amountKey, $financialaffairsInfo),
                    'source' => self::validate_key_value($sourceKey, $financialaffairsInfo),
                    'source_text' => self::validate_key_value($sourceTextKey, $financialaffairsInfo)
                ];
            }
        }

        return $entries;
    }

    public static function getSourceOfIncomeSelection($code = '')
    {
        $soiarrayList = self::getSourceOfIncomeArray();

        return self::createSelectionFromArray($soiarrayList, $code);
    }

    public static function createSelectionFromArray($arrayList, $code = '')
    {
        $list = '';
        foreach ($arrayList as $key => $value) {
            $selected = !empty($code) && $code == $key ? 'selected' : '';
            $list .= "<option value='" . $key . "' " . $selected . ">" . $value . "</option>";
        }

        return $list;
    }

    public static function setModelAndGetUpdateArray($modelData)
    {
        $finalUpdatedArray = [];
        if (!empty($modelData)) {
            foreach ($modelData->toArray() as $key => $value) {
                $data = [];
                if (is_array(json_decode($value, 1))) {
                    $data[$key] = json_decode($value, 1);
                    if (!empty($data[$key])) {
                        foreach ($data[$key] as $subKey => $subValue) {
                            $finalUpdatedArray[$subKey] = $subValue;
                        }
                    }
                } else {
                    $finalUpdatedArray[$key] = $value;
                }
            }
        }

        return $finalUpdatedArray;
    }

    public static function getFinacialAffairsUpdateArray($financialAffairs)
    {
        $financialAffairs = !empty($financialAffairs) ? $financialAffairs->toArray() : [];
        $finalUpdatedArray = [];

        foreach ($financialAffairs as $key => $value) {
            $decoded = json_decode($value, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                if (in_array($key, ['community_property_state', 'domestic_partner'])) {
                    $decoded = array_values($decoded);
                }

                foreach ($decoded as $jsonKey => $jsonData) {
                    if (is_array($jsonData)) {
                        $decoded[$jsonKey] = array_filter($jsonData, fn ($v) => $v !== null && $v !== '');
                    }
                }

                $finalUpdatedArray[$key] = $decoded;
            } else {
                $finalUpdatedArray[$key] = $value;
            }
        }

        return $finalUpdatedArray;
    }


    public static function getPlantype($key = null)
    {
        $arr = [
            100 => '',
            101 => '',
            102 => '',
            1 => ''
        ];

        if ($key == null) {
            return $arr;
        }

        return static::returnArrValue($arr, $key);
    }

    public static function dateOfBirthWithSlashFormat($date)
    {
        $dateOfBirth = '';
        $dob = explode("-", $date);
        if (!empty($dob) && $dob != "0000-00-00") {
            $y = $dob[0];
            $m = $dob[1];
            $d = $dob[2];
            $dateOfBirth = $m . "/" . $d . "/" . $y;
        }

        return $dateOfBirth;
    }

    public static function getMiscellaneousData($miscellaneous)
    {
        $miscellan_final = [];
        if (!empty($miscellaneous)) {
            foreach ($miscellaneous as $miscellan) {
                $ml_type_data = json_decode($miscellan['type_data'], 1);
                if (!empty($ml_type_data)) {
                    $miscellan['description'] = (!empty($ml_type_data['description'])) ? $ml_type_data['description'] : "";
                    $miscellan['property_value'] = (!empty($ml_type_data['property_value'])) ? $ml_type_data['property_value'] : "";
                    $miscellan['owned_by'] = (!empty($ml_type_data['owned_by'])) ? $ml_type_data['owned_by'] : "";
                }
                unset($miscellan['type_data']);
                $miscellan_final[$miscellan['type']] = $miscellan;
            }
        }

        $miscellaneous = (!empty($miscellan_final['miscellaneous'])) ? $miscellan_final['miscellaneous'] : [];

        return $miscellaneous;
    }

    public static function planTreatmentFirst($key = null)
    {
        $arr = [
            1 => "Inside Plan",
            2 => "Outside Plan",
            3 => "M. Payment N/A",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function planTreatmentSecond($key = null)
    {
        $arr = [
            1 => "Inside Plan",
            3 => "Past Due  N/A",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function planTreatmentFirstSelection($code = null)
    {
        $array = self::planTreatmentFirst();

        return self::createSelectionFromArray($array, $code);
    }

    public static function planTreatmentSecondSelection($code = null)
    {
        $array = self::planTreatmentSecond();

        return self::createSelectionFromArray($array, $code);
    }

    public static function commonCreditorPlaceholder($val)
    {
        $placeholder = '';
        $placeholder = strip_tags(html_entity_decode($val['creditor_name'], ENT_QUOTES, 'UTF-8'));
        $placeholder .= isset($val['creditor_address']) ? " (" . strip_tags(html_entity_decode($val['creditor_address'], ENT_QUOTES, 'UTF-8')) : '';
        $placeholder .= ", " . strip_tags(html_entity_decode($val['creditor_city'], ENT_QUOTES, 'UTF-8'));
        $placeholder .= ", " . strip_tags(html_entity_decode($val['creditor_state'], ENT_QUOTES, 'UTF-8'));
        $placeholder .= ", " . strip_tags(html_entity_decode($val['creditor_zip'], ENT_QUOTES, 'UTF-8'));
        $placeholder .= ")";

        return $placeholder;
    }

    public static function isQuestionnaireHidden()
    {
        if (empty(Auth::user()->client_payroll_assistant) && Auth::user()->hide_questionnaire) {
            return true;
        }

        return false;
    }

    public static function isTabEditable($tab)
    {
        $client_id = Auth::user()->id;

        // Check session for admin/attorney override first (no caching needed for this)
        $refreenceParent = Session::get('refrence_parent');
        $refreenceAdmin = Session::get('refrence_admin');
        if (@$refreenceParent > 0 || @$refreenceAdmin > 0) {
            /*Allow admin and its attorney to update client info*/
            return true;
        }

        // Cache key for this client's edit permissions
        $cacheKey = "tab_editable_{$client_id}_{$tab}";

        return Cache::remember($cacheKey, 120, function () use ($tab, $client_id) {
            $can_editable_info = \App\Models\FormsStepsCompleted::where(['client_id' => $client_id])
                ->select('can_edit_basic_info', 'can_edit_property', 'can_edit_debts', 'can_edit_income', 'can_edit_expenase', 'can_edit_sofa', 'can_edit', 'client_id')
                ->first();

            $can_editable = true;
            if (!empty($can_editable_info->can_edit) && $can_editable_info->can_edit == 1 && !empty($can_editable_info->client_id)) {
                $can_editable = true;
            }
            if (isset($can_editable_info->can_edit) && $can_editable_info->can_edit == 2 && !empty($can_editable_info->client_id)) {
                $can_editable = false;
            }

            return $can_editable == false && $can_editable_info->$tab == 0 ? false : true;
        });
    }

    public static function getTabByName($key = null)
    {
        $arr = [
            'can_edit_basic_info' => 'Basic Information',
            'can_edit_property' => 'Property',
            'can_edit_debts' => 'Debts',
            'can_edit_income' => 'Current Income',
            'can_edit_expenase' => 'Current Expenses',
            'can_edit_sofa' => 'Statement of Financial Affairs'
        ];

        return static::returnArrValue($arr, $key);
    }

    /**
     * Clear tab edit permissions cache when permissions change
     * Call this method when FormsStepsCompleted is updated
     */
    public static function clearTabEditCache($client_id, $tab = null)
    {
        if ($tab) {
            Cache::forget("tab_editable_{$client_id}_{$tab}");
        } else {
            // Clear all tab permissions for this client
            $tabs = ['can_edit_basic_info', 'can_edit_property', 'can_edit_debts', 'can_edit_income', 'can_edit_expenase', 'can_edit_sofa'];
            foreach ($tabs as $tabName) {
                Cache::forget("tab_editable_{$client_id}_{$tabName}");
            }
        }
    }

    public static function getRequestedTabByName($key = null)
    {
        $arr = [
            'basic_info' => 'Basic Information',
            'property' => 'Property',
            'debt' => 'Debts',
            'income' => 'Current Income',
            'expense' => 'Current Expenses',
            'sofa' => 'Statement of Financial Affairs'
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function isClientBelongsToAttorney($client_id, $attorney_id, $isAjax = false)
    {
        $role = \App\Models\User::where('id', $attorney_id)->value('role');
        if ($role == 1) {
            return true;
        }
        $isExist = \App\Models\ClientsAttorney::where(['attorney_id' => $attorney_id, 'client_id' => $client_id])->first();
        if (empty($isExist)) {
            return false;
        }

        return true;
    }

    public static function getSubJsonArray($data, $final_BasicInfo_PartRestD)
    {
        if (!empty($data)) {
            foreach ($data as $kkey => $vv) {
                $final_BasicInfo_PartRestD[$kkey] = $vv;
            }
        }

        return $final_BasicInfo_PartRestD;
    }

    public static function findMissing($a, $b, $n, $m)
    {

        $missing = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $m; $j++) {
                if ($a[$i] == $b[$j]) {
                    break;
                }
            }

            if ($j == $m) {
                $missing[] = $a[$i];
            }
        }

        return $missing;
    }

    public static function validate_doc_type($val, $removeDot = false)
    {
        $val = str_replace("-", "_", $val);
        $val = str_replace(["~", "^", "(", ")", "<", ">", "[", "]", "|", "/", ",", "&", "{", "}", "$", "@", "=", "+", "*", "#", "'", ";", "\\", "%", "?", ":", "!", "`", "’"], '', $val);
        $val = str_replace(["'", "\""], "", $val);
        if ($removeDot) {
            $val = str_replace(".", "", $val);
        }
        $val = str_replace(" ", "_", $val);

        return $val;
    }

    public static function getAttorneyEmailArray($userId)
    {
        $attorney = \App\Models\User::where('id', $userId)->first();
        $mail = [$attorney->email];
        if (!empty($attorney->attorney_notice_email_1)) {
            $mail[] = $attorney->attorney_notice_email_1;
        }
        if (!empty($attorney->attorney_notice_email_2)) {
            $mail[] = $attorney->attorney_notice_email_2;
        }

        return $mail;
    }

    public static function updateInstallmentPayments($installment = [], $keysToDelete = [])
    {
        $indexesToDelete = [];
        if (!isset($installment['installmentpayments_type'])) {
            return $indexesToDelete;
        }
        foreach ($installment['installmentpayments_type'] as $key => $value) {
            if (in_array($value, $keysToDelete)) {
                $indexesToDelete[] = $key;
            }
        }

        foreach ($indexesToDelete as $index) {
            unset($installment['installmentpayments_value'][$index]);
            unset($installment['installmentpayments_price'][$index]);
            unset($installment['installmentpayments_type'][$index]);
        }

        $installment['installmentpayments_value'] = array_values($installment['installmentpayments_value']);
        $installment['installmentpayments_price'] = array_values($installment['installmentpayments_price']);
        $installment['installmentpayments_type'] = array_values($installment['installmentpayments_type']);

        return $installment;
    }

    public static function updateAllLoanPayments($loan = [], $keysToDelete = [])
    {
        $indexesToDelete = [];
        if (!isset($loan['creditor_payment_for'])) {
            return [];
        }
        foreach ($loan['creditor_payment_for'] as $key => $value) {
            if (in_array($value, $keysToDelete)) {
                $indexesToDelete[] = $key;
            }
        }

        foreach ($indexesToDelete as $index) {
            unset($loan['creditor_address'][$index]);
            unset($loan['creditor_street'][$index]);
            unset($loan['creditor_city'][$index]);
            unset($loan['creditor_state'][$index]);
            unset($loan['creditor_zip'][$index]);
            unset($loan['payment_1'][$index]);
            unset($loan['payment_2'][$index]);
            unset($loan['payment_3'][$index]);
            unset($loan['payment_dates'][$index]);
            unset($loan['payment_dates2'][$index]);
            unset($loan['payment_dates3'][$index]);
            unset($loan['total_amount_paid'][$index]);
            unset($loan['amount_still_owed'][$index]);
            unset($loan['creditor_payment_for'][$index]);
        }


        $loan['creditor_address'] = isset($loan['creditor_address']) ? array_values($loan['creditor_address']) : [];
        $loan['creditor_street'] = isset($loan['creditor_street']) ? array_values($loan['creditor_street']) : [];
        $loan['creditor_city'] = isset($loan['creditor_city']) ? array_values($loan['creditor_city']) : [];
        $loan['creditor_state'] = isset($loan['creditor_state']) ? array_values($loan['creditor_state']) : [];
        $loan['creditor_zip'] = isset($loan['creditor_zip']) ? array_values($loan['creditor_zip']) : [];
        $loan['payment_1'] = isset($loan['payment_1']) ? array_values($loan['payment_1']) : [];
        $loan['payment_2'] = isset($loan['payment_2']) ? array_values($loan['payment_2']) : [];
        $loan['payment_3'] = isset($loan['payment_3']) ? array_values($loan['payment_3']) : [];
        $loan['payment_dates'] = isset($loan['payment_dates']) ? array_values($loan['payment_dates']) : [];
        $loan['payment_dates2'] = isset($loan['payment_dates2']) ? array_values($loan['payment_dates2']) : [];
        $loan['payment_dates3'] = isset($loan['payment_dates3']) ? array_values($loan['payment_dates3']) : [];
        $loan['total_amount_paid'] = isset($loan['total_amount_paid']) ? array_values($loan['total_amount_paid']) : [];
        $loan['amount_still_owed'] = isset($loan['amount_still_owed']) ? array_values($loan['amount_still_owed']) : [];
        $loan['creditor_payment_for'] = isset($loan['creditor_payment_for']) ? array_values($loan['creditor_payment_for']) : [];

        return $loan;
    }
    public static function updatePaymentsInDebtsData($debtsData = [])
    {
        if (!empty($debtsData) && !empty($debtsData['total_amount_paid'])) {
            if (empty($debtsData['payment_1'])) {
                for ($i = 0; $i < count($debtsData['total_amount_paid']); $i++) {
                    $debtsData['payment_1'][$i] = $debtsData['payment_1'][$i] ?? '';
                }
            }
            if (empty($debtsData['payment_2'])) {
                for ($i = 0; $i < count($debtsData['total_amount_paid']); $i++) {
                    $debtsData['payment_2'][$i] = $debtsData['payment_2'][$i] ?? '';
                }
            }
            if (empty($debtsData['payment_3'])) {
                for ($i = 0; $i < count($debtsData['total_amount_paid']); $i++) {
                    $debtsData['payment_3'][$i] = $debtsData['payment_3'][$i] ?? '';
                }
            }
        }

        return $debtsData;
    }


    public static function getAutoLoanStatementKeyArray()
    {
        return ['Current_Auto_Loan_Statement_1', 'Current_Auto_Loan_Statement_2', 'Current_Auto_Loan_Statement_3', 'Current_Auto_Loan_Statement_4', 'Other_Loan_Statement_1', 'Other_Loan_Statement_2'];
    }

    public static function getMortgageStatementKeyArray()
    {
        return ['Current_Mortgage_Statement_1_1', 'Current_Mortgage_Statement_2_1', 'Current_Mortgage_Statement_3_1', 'Current_Mortgage_Statement_1_2', 'Current_Mortgage_Statement_2_2', 'Current_Mortgage_Statement_3_2', 'Current_Mortgage_Statement_1_3', 'Current_Mortgage_Statement_2_3', 'Current_Mortgage_Statement_3_3', 'Current_Mortgage_Statement_1_4', 'Current_Mortgage_Statement_2_4', 'Current_Mortgage_Statement_3_4', 'Current_Mortgage_Statement_1_5', 'Current_Mortgage_Statement_2_5', 'Current_Mortgage_Statement_3_5'];
    }

    public static function getPendingDocType($client_id, $document_type)
    {
        $msg = '';
        if ($document_type === "Current_Auto_Loan_Statement") {
            $document_type_array = Helper::getAutoLoanStatementKeyArray();
            $msg = 'You have reach limit of Auto Loan Statement to upload additional statements upload under Additional or Unlisted Documents';
        }
        if ($document_type === "Current_Mortgage_Statement") {
            $document_type_array = Helper::getMortgageStatementKeyArray();
            $msg = 'You have reach limit of Mortgage Statement to upload additional statements upload under Additional or Unlisted Documents';
        }
        $client = \App\Models\User::where('id', '=', $client_id)->first();
        $uploadedDocsList = $client->clientDocumentUploaded->whereIn('document_type', $document_type_array)->toArray();
        $uploadedDocs = array_column($uploadedDocsList, 'document_type');
        $sortedUploadedDocs = array_values($uploadedDocs);
        sort($sortedUploadedDocs);
        $missingInSorted = array_diff($document_type_array, $sortedUploadedDocs);
        $response = [
            'status' => 'success',
            'firstMissingKey' => reset($missingInSorted),
            'msg' => $msg
        ];
        if (empty($missingInSorted)) {
            $response = [
                'status' => 'error',
                'firstMissingKey' => '',
                'msg' => $msg
            ];
        }

        return $response ?? [];
    }

    public static function getCodebtorAddress($client_id)
    {

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $basic = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $address = null;
        $city = null;
        $state = null;
        $zip = null;


        $middlename = !empty(Helper::validate_key_value('middle_name', $basic)) ? ' ' . Helper::validate_key_value('middle_name', $basic) : '';
        $name = Helper::validate_key_value('name', $basic) . $middlename . ' ' . Helper::validate_key_value('last_name', $basic);
        if (Helper::validate_key_value('spouse_different_address', $basic) == 1) {
            $address = Helper::validate_key_value('Address', $basic);
            $city = Helper::validate_key_value('City', $basic);
            $state = Helper::validate_key_value('state', $basic);
            $zip = Helper::validate_key_value('zip', $basic);
        } else {
            $basic = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
            $address = Helper::validate_key_value('Address', $basic);
            $city = Helper::validate_key_value('City', $basic);
            $state = Helper::validate_key_value('state', $basic);
            $zip = Helper::validate_key_value('zip', $basic);
        }

        return ['name' => $name, 'address' => $address, 'city' => $city, 'state' => $state, 'zip' => $zip];
    }

    public static function getUserFirstName($user)
    {
        return explode(' ', $user->name)[0];
    }

    public static function getOtherDeductionsArray()
    {
        return [
            1 => 'AD&D',
            2 => 'Cafeteria',
            3 => 'Child Life',
            4 => 'Company Stock',
            5 => 'Critical Illness',
            6 => 'Employee Life',
            7 => 'Flexible Spending Account',
            8 => 'Health Savings Acct.',
            9 => 'Long Term Disability',
            10 => 'Prepaid Legal',
            11 => 'Spouse Life',
            12 => 'Travel Expense(s)',
            13 => 'Wage Garnishment 1',
            14 => 'Wage Garnishment 2',
            15 => 'Wage Garnishment 3',
            16 => 'Other/not on list',
        ];

    }

    public static function getPayFrequencyLabel($key = null)
    {
        $arr = [
            1 => "Once a week",
            2 => "Every two weeks",
            3 => "Twice a month",
            4 => "Once a month",
            5 => "Other",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getCreditorCategories($key = null)
    {
        $arr = [
            1 => "Mortgage Address",
            2 => "Auto Loan Address",
            3 => "Credit Card Address",
            4 => "Collection Accounts/Other Main Addresses",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function searchForOverrideDate($payDate, $array = [], $empId)
    {
        if (!empty($array)) {
            foreach ($array as $key => $val) {
                if ($val['override_date'] == $payDate && $val['employer_id'] == $empId) {
                    return $val;
                }
            }
        }
    }

    public static function getCurrentAttorneyId()
    {
        $attorney_id = Auth::user()->id;
        if (!empty(Auth::user()->parent_attorney_id)) {
            $attorney_id = Auth::user()->parent_attorney_id;
        }

        return $attorney_id;
    }

    public static function getAttorneyIdByUserid($userId)
    {
        $user = User::find($userId);
        $attorney_id = $user->id;
        if (!empty($user->parent_attorney_id)) {
            $attorney_id = $user->parent_attorney_id;
        }

        return $attorney_id;
    }

    public static function getParalegalSelection($selectedParalegal, $excludeLawFirms = false)
    {

        if ($excludeLawFirms) {
            $paralegals = Auth::user()->paralegals->whereNull('paralegal_law_firm_id')->pluck('name', 'id');
        } else {
            $paralegals = Auth::user()->paralegals->pluck('name', 'id');
        }
        $paralegalsArray = [];
        if (!empty($paralegals)) {
            $paralegalsArray = $paralegals->toArray();
        }

        return Helper::createSelectionFromArray($paralegalsArray, $selectedParalegal);
    }

    public static function getParalegalLlabel($selectedParalegal, $excludeLawFirms = false)
    {

        if ($excludeLawFirms) {
            $paralegals = Auth::user()->paralegals->whereNull('paralegal_law_firm_id')->pluck('name', 'id');
        } else {
            $paralegals = Auth::user()->paralegals->pluck('name', 'id');
        }
        $paralegalsArray = [];
        if (!empty($paralegals)) {
            $paralegalsArray = $paralegals->toArray();
        }

        return ArrayHelper::returnArrValue($paralegalsArray, $selectedParalegal);

    }

    public static function splitName($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));

        return [$first_name, $last_name];
    }

    public static function validate_key_negative_class($key, $array, $match)
    {
        return isset($array[$key]) && $array[$key] == $match ? 'negative-price-field' : 'price-field';
    }

    public static function getUpdatedPayPalName($documentTypes)
    {
        if (!empty($documentTypes)) {
            foreach ($documentTypes as $key => $name) {
                if (in_array($key, ['paypal_account_1', 'paypal_account_2', 'paypal_account_3'])) {
                    $newName = str_replace('Pay Pal', 'PayPal', $name);
                    $newName = str_replace('Paypal', 'PayPal', $newName);
                    $documentTypes[$key] = $newName;
                }
            }
        }

        return $documentTypes;
    }

    public static function calculateAverage($allAmount)
    {
        if (empty($allAmount)) {
            return 0.0;
        }

        $sum = array_sum(array_map('floatval', $allAmount));

        $average = $sum / count($allAmount);

        return round($average, 2);
    }

    public static function matchStrings($string1, $string2)
    {
        $string1 = strtolower($string1);
        $string2 = strtolower($string2);
        $string1 = str_replace(' ', '', $string1);
        $string2 = str_replace(' ', '', $string2);

        return $string1 === $string2;

    }

    public static function getUcWordsString($string)
    {
        return ucwords(strtolower($string));
    }

    public static function getEncodedUcWordsString($data)
    {
        if (is_array($data)) {
            foreach ($data as &$value) {
                $value = ucwords(strtolower($value));
            }
        } else {
            $data = ucwords(strtolower($data));
        }

        return json_encode($data);
    }

    public static function removeUnderscores($input, $limit = true)
    {
        // Replace underscores with spaces
        $output = str_replace('_', ' ', $input);

        // If HTML tags are present, return the input as-is
        if ($input !== strip_tags($input)) {
            return $input;
        }

        // Replace multiple spaces with a single space
        $output = preg_replace('/\s+/', ' ', $output);

        // Trim any leading or trailing spaces
        $output = trim($output);

        // If limit is true, wrap the text to 40 characters per line
        if ($limit) {
            $output = wordwrap($output, 40, "<br>", true);
        }

        return $output;
    }

    public static function validate_slug_name($val)
    {
        // Replace all special characters with a single hyphen
        $val = str_replace(["~", ".", " ", "^", "(", ")", "<", ">", "[", "]", "|", "/", ",", "&", "{", "}", "$", "@", "=", "+", "*", "#", "'", ";", "\\", "%", "?", ":", "!", "`", "’", "\""], '-', $val);
        // Replace multiple hyphens with a single hyphen
        $val = preg_replace('/-+/', '-', $val);
        // Remove leading and trailing hyphens
        $val = trim($val, '-');
        $val = strtolower($val);

        return $val;
    }

    public static function checkSectionKeyExists($data, $checkKey)
    {
        return collect($data)->contains(function ($item) use ($checkKey) {
            return isset($item['section_name']) && $item['section_name'] === $checkKey;
        });
    }

    public static function getJsonDifferences($oldJson, $newJson, $sectionName = '')
    {
        $old = json_decode($oldJson, true) ?? [];
        $new = json_decode($newJson, true) ?? [];

        $differences = [];

        if ($sectionName == 'attorney-ques-info') {
            foreach ($new as $key => $newValue) {

                $oldValue = $old[$key] ?? null;

                if ($key === 'concierge_question') {

                    $oldConcierge = json_decode($oldValue, true) ?? [];
                    $newConcierge = json_decode($newValue, true) ?? [];

                    $attorney_id = self::getCurrentAttorneyId();

                    $questions = \App\Models\ConciergeAttorneyQuestions::where('attorney_id', $attorney_id)
                        ->get()
                        ->keyBy('id');

                    // Check added/changed
                    foreach ($newConcierge as $cqKey => $cqNewValue) {
                        $question = $questions->get($cqKey);
                        $cqOldValue = $oldConcierge[$cqKey] ?? null;
                        if ($cqNewValue !== $cqOldValue) {
                            $differences[$question['question'] . $key] = [
                                'old' => $cqOldValue,
                                'new' => $cqNewValue
                            ];
                        }
                    }

                    // Check removed
                    foreach ($oldConcierge as $cqKey => $cqOldValue) {
                        if (!array_key_exists($cqKey, $newConcierge)) {
                            $question = $questions->get($cqKey);
                            $differences[$question['question'] . $key] = [
                                'old' => $cqOldValue,
                                'new' => null
                            ];
                        }
                    }
                }
                // Normal comparison for other keys
                else {
                    // If different (and not both null/empty string)
                    if ($newValue !== $oldValue) {
                        $differences[$key] = [
                            'old' => $oldValue,
                            'new' => $newValue
                        ];
                    }
                }
            }
        } elseif (in_array($sectionName, ['secured-loan-info', 'vehicles-info'])) {
            foreach ($new as $key => $newValue) {
                $oldValue = $old[$key] ?? null;


                if (in_array($key, ['additional_liens_data', 'vehicle_details', 'codebtor_income_data'])) {
                    $oldItems = json_decode($oldValue, true) ?? [];
                    $newItems = json_decode($newValue, true) ?? [];

                    // Compare by index
                    foreach ($newItems as $index => $newItem) {
                        $oldItem = $oldItems[$index] ?? [];

                        foreach ($newItem as $field => $newFieldValue) {
                            $oldFieldValue = $oldItem[$field] ?? null;

                            // 🔹 Special handling for vehicle_car_loan
                            if ($field === 'vehicle_car_loan') {
                                $oldLoan = json_decode($oldFieldValue, true) ?? [];
                                $newLoan = json_decode($newFieldValue, true) ?? [];

                                foreach ($newLoan as $loanField => $newLoanValue) {
                                    $oldLoanValue = $oldLoan[$loanField] ?? null;
                                    if ($newLoanValue !== $oldLoanValue) {
                                        $differences["{$key}-{$index}-{$field}-{$loanField}"] = [
                                            'old' => $oldLoanValue,
                                            'new' => $newLoanValue
                                        ];
                                    }
                                }

                                // Removed loan fields
                                foreach ($oldLoan as $loanField => $oldLoanValue) {
                                    if (!array_key_exists($loanField, $newLoan)) {
                                        $differences["{$key}-{$index}-{$field}-{$loanField}"] = [
                                            'old' => $oldLoanValue,
                                            'new' => null
                                        ];
                                    }
                                }
                            }
                            // 🔹 Normal comparison
                            else {
                                if ($newFieldValue !== $oldFieldValue) {
                                    $differences["{$key}-{$index}-{$field}"] = [
                                        'old' => $oldFieldValue,
                                        'new' => $newFieldValue
                                    ];
                                }
                            }
                        }
                    }
                } else {
                    // Normal comparison
                    if ($newValue !== $oldValue) {
                        $differences[$key] = [
                            'old' => $oldValue,
                            'new' => $newValue
                        ];
                    }
                }
            }
        } elseif (in_array($sectionName, ['debtor-income-info', 'spouse-income-info'])) {
            foreach ($new as $key => $newValue) {
                $oldValue = $old[$key] ?? null;

                if (in_array($key, ['debtor_income_data', 'codebtor_income_data'])) {
                    $oldIncome = json_decode($oldValue, true) ?? [];
                    $newIncome = json_decode($newValue, true) ?? [];

                    foreach ($newIncome as $field => $newFieldValue) {
                        $oldFieldValue = $oldIncome[$field] ?? null;
                        if ($newFieldValue !== $oldFieldValue) {
                            $differences[$field] = [
                                'old' => $oldFieldValue,
                                'new' => $newFieldValue
                            ];
                        }
                    }

                    // Check for removed fields
                    foreach ($oldIncome as $field => $oldFieldValue) {
                        if (!array_key_exists($field, $newIncome)) {
                            $differences[$field] = [
                                'old' => $oldFieldValue,
                                'new' => null
                            ];
                        }
                    }
                } else {
                    // normal fallback comparison
                    if ($newValue !== $oldValue) {
                        $differences[$key] = [
                            'old' => $oldValue,
                            'new' => $newValue
                        ];
                    }
                }
            }
        } elseif ($sectionName == 'emergency-info') {
            $eAA = ArrayHelper::getEmergencyAssessmentArray();
            foreach ($new as $key => $newValue) {
                $oldValue = $old[$key] ?? null;

                if ($key === 'emergency_check') {
                    $oldChecks = json_decode($oldValue, true) ?? [];
                    $newChecks = json_decode($newValue, true) ?? [];

                    // Added/changed
                    foreach ($newChecks as $checkKey => $checkValue) {
                        $oldCheckValue = $oldChecks[$checkKey] ?? null;
                        if ($checkValue !== $oldCheckValue) {
                            $differences[$key . $eAA[$checkKey]] = [
                                'old' => $oldCheckValue,
                                'new' => $checkValue
                            ];
                        }
                    }

                    // Removed
                    foreach ($oldChecks as $checkKey => $oldCheckValue) {
                        if (!array_key_exists($checkKey, $newChecks)) {
                            $differences[$key . $eAA[$checkKey]] = [
                                'old' => $oldCheckValue,
                                'new' => null
                            ];
                        }
                    }
                } else {
                    // normal comparison
                    if ($newValue !== $oldValue) {
                        $differences[$key] = [
                            'old' => $oldValue,
                            'new' => $newValue
                        ];
                    }
                }
            }
        } elseif ($sectionName == 'discover-us-info') {
            $findUsArray = ArrayHelper::getFindUsArray();
            foreach ($new as $key => $newValue) {
                $oldValue = $old[$key] ?? null;

                if ($key === 'find_us') {
                    $oldFindUs = json_decode($oldValue, true) ?? [];
                    $newFindUs = json_decode($newValue, true) ?? [];

                    // Added/changed
                    foreach ($newFindUs as $findKey => $findValue) {
                        $oldFindValue = $oldFindUs[$findKey] ?? null;
                        if ($findValue !== $oldFindValue) {
                            $differences[$key . $findUsArray[$findKey]] = [
                                'old' => $oldFindValue,
                                'new' => $findValue
                            ];
                        }
                    }

                    // Removed
                    foreach ($oldFindUs as $findKey => $oldFindValue) {
                        if (!array_key_exists($findKey, $newFindUs)) {
                            $differences[$key . $findUsArray[$findKey]] = [
                                'old' => $oldFindValue,
                                'new' => null
                            ];
                        }
                    }
                } else {
                    // Normal comparison
                    if ($newValue !== $oldValue) {
                        $differences[$key] = [
                            'old' => $oldValue,
                            'new' => $newValue
                        ];
                    }
                }
            }
        } elseif ($sectionName == 'debtor-basic-info') {
            foreach ($new as $key => $newValue) {
                $oldValue = $old[$key] ?? null;

                if ($key === 'any_bankruptcy_filed_before_data') {
                    $oldBankruptcy = json_decode($oldValue, true) ?? [];
                    $newBankruptcy = json_decode($newValue, true) ?? [];

                    foreach ($newBankruptcy as $field => $newFieldValues) {
                        $oldFieldValues = $oldBankruptcy[$field] ?? [];

                        // Compare arrays field by field
                        foreach ($newFieldValues as $idx => $val) {
                            $oldVal = $oldFieldValues[$idx] ?? null;
                            if ($val !== $oldVal) {
                                $differences["{$key}-{$idx}-{$field}"] = [
                                    'old' => $oldVal,
                                    'new' => $val
                                ];
                            }
                        }

                        // Check for removed values
                        foreach ($oldFieldValues as $idx => $oldVal) {
                            if (!array_key_exists($idx, $newFieldValues)) {
                                $differences["{$key}-{$idx}-{$field}"] = [
                                    'old' => $oldVal,
                                    'new' => null
                                ];
                            }
                        }
                    }

                    // Check for removed fields
                    foreach ($oldBankruptcy as $field => $oldFieldValues) {
                        if (!array_key_exists($field, $newBankruptcy)) {
                            foreach ($oldFieldValues as $idx => $oldVal) {
                                $differences["{$key}-{$idx}-{$field}"] = [
                                    'old' => $oldVal,
                                    'new' => null
                                ];
                            }
                        }
                    }
                } else {
                    // Normal field comparison
                    if ($newValue !== $oldValue) {
                        $differences[$key] = [
                            'old' => $oldValue,
                            'new' => $newValue
                        ];
                    }
                }
            }
        } else {
            $differences = self::getDifferenceData($differences, $new, $old);
        }

        return $differences;
    }

    private static function getDifferenceData($differences, $new, $old): mixed
    {
        foreach ($new as $key => $newValue) {
            $oldValue = $old[$key] ?? null;

            // If different (and not both null/empty string)
            if ($newValue !== $oldValue) {
                $differences[$key] = [
                    'old' => $oldValue,
                    'new' => $newValue
                ];
            }
        }

        return $differences;
    }

    public static function getLogFieldValue($fieldType, $diffFor, $diff)
    {
        if ($fieldType == 'yes_no_reverse') {
            return (isset($diff[$diffFor]) && ($diff[$diffFor] == 1)) ? "No" : "Yes";
        }
        if ($fieldType == 'yes_no') {
            return (isset($diff[$diffFor]) && $diff[$diffFor] == 1) ? "Yes" : "No";
        }
        if ($fieldType == 'yes_no_custom_google') {
            return (isset($diff[$diffFor]) && $diff[$diffFor] == 1) ? "Yes / Some" : "No";
        }
        if ($fieldType == 'yes_no_custom_zoom') {
            return (isset($diff[$diffFor]) && $diff[$diffFor] == 1) ? "Comfortable with Zoom" : "Need Help with Zoom";
        }
        if (in_array($fieldType, ['added_not_added'])) {
            return (isset($diff[$diffFor]) && $diff[$diffFor] == 1) ? "Checked" : "Unchecked";
        }
        if (in_array($fieldType, ['checkbox_unsure', 'checkbox_unknown'])) {
            return (isset($diff[$diffFor]) && $diff[$diffFor] == 'on') ? "Checked" : "Unchecked";
        }
        if ($fieldType == 'price') {
            return '$ ' . self::priceFormtWithComma($diff[$diffFor]);
        }
        if ($fieldType == 'suffix') {
            return ($diff[$diffFor] == null) ? "None" : ArrayHelper::getSuffixArray($diff[$diffFor]);
        }
        if ($fieldType == 'county') {
            $county = \App\Models\CountyFipsData::get_county_name_by_id($diff[$diffFor]);

            return !empty($county) ? $county : 'empty';
        }
        if ($fieldType == 'martial_status') {
            return ArrayHelper::getMartialStatus($diff[$diffFor]);
        }

        return ($diff[$diffFor] == '' || $diff[$diffFor] == null) ? 'empty' : $diff[$diffFor];
    }

    // Handles integer numbers (e.g., "1000" => 1000)
    public static function getLotSize($variable)
    {
        $cleaned = preg_replace('/[^\d]/', '', $variable);

        return (int)$cleaned;
    }

    // Handles float numbers (e.g., "2.5 baths" => 2.5)
    public static function getBathSize($variable)
    {
        // Remove all characters except digits and dot
        $cleaned = preg_replace('/[^0-9.]/', '', $variable);

        // Convert to float, fallback to 0 if not numeric
        return is_numeric($cleaned) ? (float)$cleaned : null;
    }

}
