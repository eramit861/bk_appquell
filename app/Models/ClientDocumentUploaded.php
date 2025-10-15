<?php

namespace App\Models;

use App\Helpers\ArrayHelper;
use App\Helpers\ClientHelper;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestedDocUploaded;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use ConvertApi\ConvertApi;
use App\Helpers\DateTimeHelper;
use App\Helpers\DocumentHelper;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheProperty;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ClientDocumentUploaded extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_client_document_uploaded';
    public $timestamps = false;

    public const DRIVING_LIC = "Drivers_License";
    public const CO_DEBTOR_DRIVING_LIC = "Co_Debtor_Drivers_License";
    public const SOCIAL_SECURITY_CARD = "Social_Security_Card";
    public const CO_DEBTOR_SECURITY_CARD = "Co_Debtor_Social_Security_Card";

    public const DEBTOR_PAY_STUB = "Debtor_Pay_Stubs";

    public const CO_DEBTOR_PAY_STUB = "Co_Debtor_Pay_Stubs";

    public const CURRENT_AUTO_LOAN_STMT = "Current_Auto_Loan_Statement";
    public const CURRENT_MORTGAGE_STMT = "Current_Mortgage_Statement";
    public const VEHICLE_REGISTRATION = "Vehicle_Registration";
    public const VEHICLE_INFORMATION = "Vehicle_Information";

    public const LAST_YR_TAX_RETURNS = "Last_Year_Tax_Returns";
    public const PRIOR_YR_TAX_RETURNS = "Prior_Year_Tax_Returns";
    public const PRIOR_YR_TWO_TAX_RETURNS = "Prior_Year_Two_Tax_Returns";
    public const PRIOR_YR_THREE_TAX_RETURNS = "Prior_Year_Three_Tax_Returns";
    public const MISCELLANEOUS_DOCUMENTS = "Miscellaneous_Documents";
    public const DEBTOR_CREDITOR_REPORT = "Debtor_Creditor_Report";
    public const CO_DEBTOR_CREDITOR_REPORT = "Co_Debtor_Creditor_Report";


    public const W2_LAST_YEAR = "W2_Last_Year";
    public const W2_YEAR_BEFORE = "W2_Year_Before";
    public const INSURANCE_DOCUMENTS = "Insurance_Documents";
    public const OTHER_MISC_DOCUMENTS = "Other_Misc_Documents";
    public const UNSECURED_DEBTS = "Unsecured_Debts";
    public const INCOME_DOCS_FOR_DEBTOR = "Income_Docs_For_Debtor";
    public const DEBTORS_TAXES = "Debtor_Taxes";
    public const POST_SUBMISSION_DOCUMENTS = "Post_submission_documents";
    public const PRE_FILLING_CCC = "Pre_Filing_Bankruptcy_Certificate_CCC";
    public const DEBTOR_SOCIAL_SECURITY_ANNUAL_AWARD_LETTER = "debtor_Social_Security_Annual_Award_Letter";
    public const CODEBTOR_SOCIAL_SECURITY_ANNUAL_AWARD_LETTER = "codebtor_Social_Security_Annual_Award_Letter";
    public const DEBTOR_VA_BENEFIT_AWARD_LETTER = "debtor_VA_Benefit_Award_Letter";
    public const CODEBTOR_VA_BENEFIT_AWARD_LETTER = "codebtor_VA_Benefit_Award_Letter";
    public const DEBTOR_UNEMPLOYMENT_PAYMENT_HISTORY = "debtor_Unemployment_Payment_History_Last_7_Months";
    public const CODEBTOR_UNEMPLOYMENT_PAYMENT_HISTORY = "codebtor_Unemployment_Payment_History_Last_7_Months";

    public const STATUS_PENDING = 0;
    public const STATUS_APPROVE = 1;
    public const STATUS_DECLINE = 2;
    public const STATUS_DELETED = 3;

    public const DOCUMENT_ENABLE_REUPLOAD = 1;

    public const MULTIPLE_DOC_ALLOWED_FOR = [
        self::VEHICLE_REGISTRATION,
        self::VEHICLE_INFORMATION,
        self::OTHER_MISC_DOCUMENTS,
        self::INSURANCE_DOCUMENTS,
        self::LAST_YR_TAX_RETURNS,
        self::PRIOR_YR_TAX_RETURNS,
        self::PRIOR_YR_TWO_TAX_RETURNS,
        self::PRIOR_YR_THREE_TAX_RETURNS,
        self::W2_LAST_YEAR,
        self::W2_YEAR_BEFORE,
        self::DEBTOR_PAY_STUB,
        self::CO_DEBTOR_PAY_STUB,
        self::DEBTOR_CREDITOR_REPORT,
        self::CO_DEBTOR_CREDITOR_REPORT,
        self::MISCELLANEOUS_DOCUMENTS,
        'Current_Mortgage_Statement',
        'Current_Auto_Loan_Statement',
        self::POST_SUBMISSION_DOCUMENTS

    ];

    public const MULTIPLE_DOC_NOT_ALLOWED_FOR = [
        self::DRIVING_LIC,
        self::CO_DEBTOR_DRIVING_LIC,
        self::SOCIAL_SECURITY_CARD,
        self::CO_DEBTOR_SECURITY_CARD
    ];


    public static function getNotMarriedDocuments($includeSub = 1, $includemaster = 0, $includeBankStatement = 0, $uploadScreenList = 0, $attorney_id = 0)
    {
        $array = [
            self::DRIVING_LIC => "Debtor’s Drivers Lic./Gov. ID",
            self::SOCIAL_SECURITY_CARD => "Debtor’s Social Security Card/ITIN",
        ];

        if ($includeSub) {

            if ($includeBankStatement == 1) {
                $array = $array + ['bank_assistant_debtor' => "Debtor’s Bank Statement Assistant"];
            }
            if ($uploadScreenList === 1) {
                $array['Current_Mortgage_Statement'] = 'Current Mortgage Statement(s)';
                $array['Current_Auto_Loan_Statement'] = 'Current Auto Loan Statement(s)';
            }
            if ($uploadScreenList === 0) {
                $array = $array + Helper::getResidence($includemaster);
                $array = $array + self::getAutoloanKeyValue($includemaster);
            }
            $array = $array + [self::DEBTOR_CREDITOR_REPORT => "Debtor Credit Reports"];
            $array = $array + [self::OTHER_MISC_DOCUMENTS => "Debt(s)/Collection Statements"];
            $array = $array + self::getDebtorPaystubKeyValue();
        }
        $array3 = self::getCommonDocument($attorney_id);

        return $array + $array3;
    }

    public static function getNotMarriedDocumentsForAttorney()
    {
        $array = [
            'card_type_docs' => [
                self::DRIVING_LIC => "Debtor’s Drivers Lic./Gov. ID",
                self::SOCIAL_SECURITY_CARD => "Debtor’s Social Security Card/ITIN",
            ]
        ];

        $array = $array + Helper::getResidence(1);
        $array = $array + self::getAutoloanKeyValue(1);
        $array = $array + [self::VEHICLE_REGISTRATION => "Vehicle Registration",self::INSURANCE_DOCUMENTS => "Proof of Auto Insurance"];
        $array = $array + [self::UNSECURED_DEBTS => "Unsecured Debts:", self::DEBTOR_CREDITOR_REPORT => "Debtor Credit Reports", self::OTHER_MISC_DOCUMENTS => "Debt(s)/Collection Statements"];
        $array = $array + [self::INCOME_DOCS_FOR_DEBTOR => "Income Docs for Debtor(s):"] + self::getDebtorPaystubKeyValue();

        //$array3 = self::getCommonDocumentForAttorney($attorney_id);
        return $array;
    }

    public static function getIndividualMarriedDocumentsForAttorney()
    {
        $array = [
            'card_type_docs' =>
                [
                self::DRIVING_LIC => "Debtor’s Drivers Lic./Gov. ID",
                self::SOCIAL_SECURITY_CARD => "Debtor’s Social Security Card/ITIN",
            ]
        ];
        $array = $array + self::getResidenceKeyValue(1);
        $array = $array + self::getAutoloanKeyValue(1);
        $array = $array + [self::VEHICLE_REGISTRATION => "Vehicle Registration",self::INSURANCE_DOCUMENTS => "Proof of Auto Insurance"];
        $array = $array + [self::UNSECURED_DEBTS => "Unsecured Debts:", self::DEBTOR_CREDITOR_REPORT => "Debtor Credit Reports", self::OTHER_MISC_DOCUMENTS => "Debt(s)/Collection Statements"];
        $array = $array + [self::INCOME_DOCS_FOR_DEBTOR => "Income Docs for Debtor(s):"] + self::getDebtorPaystubKeyValue() + self::getNonFillingSpousePayStub();

        return $array;
    }

    public static function getJointMarriedDocumentsForAttorney()
    {
        $array = [
            'card_type_docs' => [
            self::DRIVING_LIC => "Debtor’s Drivers Lic./Gov. ID",
            self::SOCIAL_SECURITY_CARD => "Debtor’s Social Security Card/ITIN",
            self::CO_DEBTOR_DRIVING_LIC => "Co-Debtor’s Drivers Lic./Gov. ID",
            self::CO_DEBTOR_SECURITY_CARD => "Co-Debtor’s Social Security Card/ITIN"
            ]
        ];
        $array = $array + self::getResidenceKeyValue(1);
        $array = $array + self::getAutoloanKeyValue(1);
        $array = $array + [self::VEHICLE_REGISTRATION => "Vehicle Registration",self::INSURANCE_DOCUMENTS => "Proof of Auto Insurance"];
        $array = $array + [self::UNSECURED_DEBTS => "Unsecured Debts:", self::DEBTOR_CREDITOR_REPORT => "Debtor Credit Reports", self::CO_DEBTOR_CREDITOR_REPORT => "Co-Debtor Credit Reports", self::OTHER_MISC_DOCUMENTS => "Debt(s)/Collection Statements"];
        $array = $array + [self::INCOME_DOCS_FOR_DEBTOR => "Income Docs for Debtor(s):"] + self::getDebtorPaystubKeyValue() + self::getCoDebtorPaystubKeyValue();

        return $array;
    }

    public static function getCommonDocumentForAttorney($attorney_id = 0)
    {

        $attorney = AttorneySettings::where('attorney_id', $attorney_id)
    ->select('tax_return_day_month')
    ->first()
    ?? new AttorneySettings(['tax_return_day_month' => '01/10']);

        $commonArray = [
            // self::VEHICLE_INFORMATION => "Vehicle Information",
            self::DEBTORS_TAXES => "Debtor(s) Taxes:",
            self::LAST_YR_TAX_RETURNS => "Last Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::LAST_YR_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_TWO_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_TWO_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_THREE_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_THREE_TAX_RETURNS, $attorney->tax_return_day_month),
            self::W2_LAST_YEAR => "W2 and or 1099 (Last Year) - ".date("Y", strtotime("-1 year")),
            self::W2_YEAR_BEFORE => "W2 and or 1099 (Year Before) - ".date("Y", strtotime("-2 year")),


           ];

        return $commonArray;
    }

    public static function getCommonDocument($attorney_id = 0)
    {

        $attorney = AttorneySettings::where('attorney_id', $attorney_id)
            ->select('tax_return_day_month')
            ->first()
            ?? new AttorneySettings(['tax_return_day_month' => '01/10']);

        $commonArray = [
            // self::VEHICLE_REGISTRATION => "Vehicle Registration",
            // self::VEHICLE_INFORMATION => "Vehicle Information",
            self::LAST_YR_TAX_RETURNS => "Last Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::LAST_YR_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_TWO_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_TWO_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_THREE_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_THREE_TAX_RETURNS, $attorney->tax_return_day_month),
            self::W2_LAST_YEAR => "W2 and or 1099 (Last Year) - ".date("Y", strtotime("-1 year")),
            self::W2_YEAR_BEFORE => "W2 and or 1099 (Year Before) - ".date("Y", strtotime("-2 year")),
            self::INSURANCE_DOCUMENTS => "Proof of Auto Insurance",

        ];

        return $commonArray;
    }

    public static function getDebtorPaystubKeyValue()
    {
        return  [self::DEBTOR_PAY_STUB => "Debtor Pay Stubs (Past 7 Months)",
         ];
    }

    public static function getCoDebtorPaystubKeyValue()
    {
        return  [
            self::CO_DEBTOR_PAY_STUB => "Co-Debtor Pay Stubs (Past 7 Months)",
     ];
    }

    public static function getNonFillingSpousePayStub()
    {
        return [
            self::CO_DEBTOR_PAY_STUB => "Non-Filing Spouse Pay Stubs (Past 7 Months)",
        ];
    }

    public static function getCardTypeArray()
    {
        return ['Drivers_License','Co_Debtor_Drivers_License','Social_Security_Card','Co_Debtor_Social_Security_Card'];
    }

    public static function getAutoloanKeyValue($includemaster = 0)
    {
        $array = [
        "Current_Auto_Loan_Statement" => "Current Auto Loan Statements",
        "Current_Auto_Loan_Statement_1" => "Current Auto Loan Statement 1",
        "Current_Auto_Loan_Statement_2" => "Current Auto Loan Statement 2",
        "Current_Auto_Loan_Statement_3" => "Current Auto Loan Statement 3",
        "Current_Auto_Loan_Statement_4" => "Current Auto Loan Statement 4",
        "Other_Loan_Statement_1" => "Other Loan Statement 1",
        "Other_Loan_Statement_2" => "Other Loan Statement 2"
    ];
        if ($includemaster == 0) {
            unset($array['Current_Auto_Loan_Statement']);

            return $array;
        }

        return $array;
    }

    public static function getAutoloanKeyValueForAppSelection()
    {
        return [ "Current_Auto_Loan_Statement_1" => "Vehicle 1",
         "Current_Auto_Loan_Statement_2" => "Vehicle 2",
         "Current_Auto_Loan_Statement_3" => "Vehicle 3",
         "Current_Auto_Loan_Statement_4" => "Vehicle 4",
         "Other_Loan_Statement_1" => "Recreational 1",
         "Other_Loan_Statement_2" => "Recreational 2"
    ];
    }



    public static function getResidenceKeyValue($includemaster = 0)
    {

        $array = [
            "Current_Mortgage_Statement" => "Current Mortgage Statements",
            "Current_Mortgage_Statement_1_1" => "Current Mortgage Statement 1 of 1",
            "Current_Mortgage_Statement_2_1" => "Current Mortgage Statement 2 of 1",
            "Current_Mortgage_Statement_3_1" => "Current Mortgage Statement 3 of 1",

            "Current_Mortgage_Statement_1_2" => "Current Mortgage Statement 1 of 2",
            "Current_Mortgage_Statement_2_2" => "Current Mortgage Statement 2 of 2",
            "Current_Mortgage_Statement_3_2" => "Current Mortgage Statement 3 of 2",

            "Current_Mortgage_Statement_1_3" => "Current Mortgage Statement 1 of 3",
            "Current_Mortgage_Statement_2_3" => "Current Mortgage Statement 2 of 3",
            "Current_Mortgage_Statement_3_3" => "Current Mortgage Statement 3 of 3",

            "Current_Mortgage_Statement_1_4" => "Current Mortgage Statement 1 of 4",
            "Current_Mortgage_Statement_2_4" => "Current Mortgage Statement 2 of 4",
            "Current_Mortgage_Statement_3_4" => "Current Mortgage Statement 3 of 4",

            "Current_Mortgage_Statement_1_5" => "Current Mortgage Statement 1 of 5",
            "Current_Mortgage_Statement_2_5" => "Current Mortgage Statement 2 of 5",
            "Current_Mortgage_Statement_3_5" => "Current Mortgage Statement 3 of 5",
        ];
        if ($includemaster == 0) {
            unset($array['Current_Mortgage_Statement']);

            return $array;
        }

        return $array;
    }

    public static function getIndividualMarriedDocuments($includeSub = 1, $includemaster = 0, $includeBankStatement = 0, $uploadScreenList = 0, $attorney_id = 0)
    {
        $array = [
            self::DRIVING_LIC => "Debtor’s Drivers Lic./Gov. ID",
            self::SOCIAL_SECURITY_CARD => "Debtor’s Social Security Card/ITIN",
        ];

        if ($includeSub) {

            if ($includeBankStatement == 1) {
                $array = $array + ['bank_assistant_debtor' => "Debtor’s Bank Statement Assistant",'bank_assistant_codebtor' => "Co-Debtor’s Bank Statement Assistant"];
            }
            if ($uploadScreenList === 1) {
                $array['Current_Mortgage_Statement'] = 'Current Mortgage Statement(s)';
                $array['Current_Auto_Loan_Statement'] = 'Current Auto Loan Statement(s)';
            }
            if ($uploadScreenList === 0) {
                $array = $array + self::getResidenceKeyValue($includemaster);
                $array = $array + self::getAutoloanKeyValue($includemaster);
            }
            $array = $array + [self::DEBTOR_CREDITOR_REPORT => "Debtor Credit Reports"];
            $array = $array + [self::OTHER_MISC_DOCUMENTS => "Debt(s)/Collection Statements"];
            $array = $array + self::getDebtorPaystubKeyValue() + self::getNonFillingSpousePayStub();
        }

        return $array + self::getCommonDocument($attorney_id);
    }

    public static function getJointMarriedDocuments($includeSub = 1, $includemaster = 0, $includeBankStatement = 0, $uploadScreenList = 0, $attorney_id = 0)
    {
        $array = [
            self::DRIVING_LIC => "Debtor’s Drivers Lic./Gov. ID",
            self::SOCIAL_SECURITY_CARD => "Debtor’s Social Security Card/ITIN",
            self::CO_DEBTOR_DRIVING_LIC => "Co-Debtor’s Drivers Lic./Gov. ID",
            self::CO_DEBTOR_SECURITY_CARD => "Co-Debtor’s Social Security Card/ITIN"
        ];

        if ($includeSub) {
            if ($includeBankStatement == 1) {
                $array = $array + ['bank_assistant_debtor' => "Debtor’s Bank Statement Assistant",'bank_assistant_codebtor' => "Co-Debtor’s Bank Statement Assistant"];
            }
            if ($uploadScreenList === 1) {
                $array['Current_Mortgage_Statement'] = 'Current Mortgage Statement(s)';
                $array['Current_Auto_Loan_Statement'] = 'Current Auto Loan Statement(s)';
            }
            if ($uploadScreenList === 0) {
                $array = $array + self::getResidenceKeyValue($includemaster);
                $array = $array + self::getAutoloanKeyValue($includemaster);
            }
            $array = $array + [self::DEBTOR_CREDITOR_REPORT => "Debtor Credit Reports",self::CO_DEBTOR_CREDITOR_REPORT => "Co-Debtor Credit Reports"];
            $array = $array + [self::OTHER_MISC_DOCUMENTS => "Debt(s)/Collection Statements"];
            $array = $array + self::getDebtorPaystubKeyValue() + self::getCoDebtorPaystubKeyValue();
        }

        return $array + self::getCommonDocument($attorney_id);
    }


    public static function getAllDocuments($attorney_id = 0)
    {
        $attorney = AttorneySettings::where('attorney_id', $attorney_id)
    ->select('tax_return_day_month')
    ->first()
    ?? new AttorneySettings(['tax_return_day_month' => '01/10']);

        return  [
            self::DRIVING_LIC => "Debtor’s Drivers Lic./Gov. ID",
            self::CO_DEBTOR_DRIVING_LIC => "Co-Debtor’s Drivers Lic./Gov. ID",
            self::SOCIAL_SECURITY_CARD => "Debtor’s Social Security Card/ITIN",
            self::CO_DEBTOR_SECURITY_CARD => "Co-Debtor’s Social Security Card/ITIN",

            self::CURRENT_AUTO_LOAN_STMT => "Current Auto Loan Statement",
            self::CURRENT_MORTGAGE_STMT => "Current Mortgage Statement",
            self::DEBTOR_CREDITOR_REPORT => "Debtor Credit Reports",
            self::CO_DEBTOR_CREDITOR_REPORT => "Co-Debtor Credit Reports",
            self::DEBTOR_PAY_STUB => "Debtor Pay Stubs",
            self::CO_DEBTOR_PAY_STUB => "Co-Debtor Pay Stubs",
            // self::VEHICLE_REGISTRATION => "Vehicle Registration",
            // self::VEHICLE_INFORMATION => "Vehicle Information",

            self::LAST_YR_TAX_RETURNS => "Last Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::LAST_YR_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_TWO_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_TWO_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_THREE_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_THREE_TAX_RETURNS, $attorney->tax_return_day_month),
            self::MISCELLANEOUS_DOCUMENTS => "Additional or Unlisted Documents",
        ];
    }

    public static function getMiscDocs()
    {
        return [
            self::MISCELLANEOUS_DOCUMENTS => "Additional or Unlisted Documents"
        ];
    }

    public static function getMiscDocsForAttorneyDocumentScreen($attorney_id = 0)
    {
        $attorney = AttorneySettings::where('attorney_id', $attorney_id)
    ->select('tax_return_day_month')
    ->first()
    ?? new AttorneySettings(['tax_return_day_month' => '01/10']);

        return [
            self::W2_LAST_YEAR => "W2 and or 1099 (Last Year) - ".date("Y", strtotime("-1 year")),
            self::W2_YEAR_BEFORE => "W2 and or 1099 (Year Before) - ".date("Y", strtotime("-2 year")),
            self::INSURANCE_DOCUMENTS => "Proof of Auto Insurance",
            self::OTHER_MISC_DOCUMENTS => "Debt(s)/Collection Statements",
            self::LAST_YR_TAX_RETURNS => "Last Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::LAST_YR_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_TWO_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_TWO_TAX_RETURNS, $attorney->tax_return_day_month),
            self::PRIOR_YR_THREE_TAX_RETURNS => "Prior Year Tax Returns - ".DateTimeHelper::getYearForTaxReturn(self::PRIOR_YR_THREE_TAX_RETURNS, $attorney->tax_return_day_month),
        ];
    }

    public static function getPaystubTypes()
    {
        $debtor = array_keys(self::getDebtorPaystubKeyValue());
        $codebtor = array_keys(self::getCoDebtorPaystubKeyValue());
        $nonfilling = array_keys(self::getNonFillingSpousePayStub());

        return $debtor + $codebtor + $nonfilling;
    }

    public static function getNonFillingCodebtorPaystub()
    {
        return array_keys(self::getNonFillingSpousePayStub());
    }

    public static function getCodebtorPaystub()
    {
        return array_keys(self::getCoDebtorPaystubKeyValue());
    }

    public static function getDebtorPaystub()
    {
        return array_keys(self::getDebtorPaystubKeyValue());
    }

    public static function getDocumentTypes()
    {
        return [
            self::DRIVING_LIC => ["sample" => url('assets/img/driver_license_light.png'),"img" => url('assets/img/driver_license_light.png'),'size' => '', 'video1' => 'https://www.youtube.com/embed/W55GygNJCEg', 'video2' => "https://www.youtube.com/embed/Z4ujgDx6teY", 'svg' => 'license.svg'],
            self::CO_DEBTOR_DRIVING_LIC => ["sample" => url('assets/img/driver_license_light.png'),"img" => url('assets/img/driver_license_light.png'), 'size' => '', 'video1' => 'https://www.youtube.com/embed/W55GygNJCEg', 'video2' => "https://www.youtube.com/embed/Z4ujgDx6teY", 'svg' => 'license.svg'],
            self::SOCIAL_SECURITY_CARD => ["sample" => url('assets/img/credit-card.png'),"img" => url('assets/img/credit-card.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/QIL2RGvdyek", 'video2' => "https://www.youtube.com/embed/Q7rpc5wdY0g", 'svg' => 'card.svg'],
            self::CO_DEBTOR_SECURITY_CARD => ["sample" => url('assets/img/credit-card.png'),"img" => url('assets/img/credit-card.png'), 'size' => '','video1' => "https://www.youtube.com/embed/QIL2RGvdyek", 'video2' => "https://www.youtube.com/embed/Q7rpc5wdY0g", 'svg' => 'card.svg'],
            self::DEBTOR_PAY_STUB => ["img" => url('assets/img/finance.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/ysuJge2uwjY", 'video2' => "https://www.youtube.com/embed/MM5yNXHMzFg", 'svg' => 'paystub.svg'],
            self::CO_DEBTOR_PAY_STUB => ["img" => url('assets/img/finance.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/ysuJge2uwjY", 'video2' => "https://www.youtube.com/embed/MM5yNXHMzFg", 'svg' => 'paystub.svg'],
            self::CURRENT_MORTGAGE_STMT => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_1_1" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_2_1" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_3_1" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_1_2" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_2_2" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_3_2" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_1_3" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_2_3" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_3_3" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_1_4" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_2_4" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_3_4" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_1_5" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_2_5" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            "Current_Mortgage_Statement_3_5" => ["img" => url('assets/img/home_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/FEQMs9DhXtY", 'video2' => "https://www.youtube.com/embed/Ejmu1tBAPr8", 'svg' => 'home_loan.svg'],
            self::CURRENT_AUTO_LOAN_STMT => ["img" => url('assets/img/car_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/j-YbFrVDEEI", 'video2' => "https://www.youtube.com/embed/1fAp3bm1G4Y", 'svg' => 'car_loan.svg'],
            "Current_Auto_Loan_Statement_1" => ["img" => url('assets/img/car_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/j-YbFrVDEEI", 'video2' => "https://www.youtube.com/embed/1fAp3bm1G4Y", 'svg' => 'car_loan.svg'],
            "Current_Auto_Loan_Statement_2" => ["img" => url('assets/img/car_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/j-YbFrVDEEI", 'video2' => "https://www.youtube.com/embed/1fAp3bm1G4Y", 'svg' => 'car_loan.svg'],
            "Current_Auto_Loan_Statement_3" => ["img" => url('assets/img/car_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/j-YbFrVDEEI", 'video2' => "https://www.youtube.com/embed/1fAp3bm1G4Y", 'svg' => 'car_loan.svg'],
            "Current_Auto_Loan_Statement_4" => ["img" => url('assets/img/car_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/j-YbFrVDEEI", 'video2' => "https://www.youtube.com/embed/1fAp3bm1G4Y", 'svg' => 'car_loan.svg'],
            "Other_Loan_Statement_1" => ["img" => url('assets/img/car_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/j-YbFrVDEEI", 'video2' => "https://www.youtube.com/embed/1fAp3bm1G4Y", 'svg' => 'car_loan.svg'],
            "Other_Loan_Statement_2" => ["img" => url('assets/img/car_loan.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/j-YbFrVDEEI", 'video2' => "https://www.youtube.com/embed/1fAp3bm1G4Y", 'svg' => 'car_loan.svg'],
            self::VEHICLE_REGISTRATION => ["img" => url('assets/img/vehical.png'), 'size' => '', 'video1' => "", 'video2' => "", 'svg' => 'vehicle_info.svg'],
            self::VEHICLE_INFORMATION => ["img" => url('assets/img/vehicle_info.png'), 'size' => '', 'video1' => "", 'video2' => "", 'svg' => 'vehicle_info.svg'],
            self::PRIOR_YR_TAX_RETURNS => ["sample" => url('assets/img/tax_return.png'),"img" => url('assets/img/tax_return.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/v1bzuyyMjxw", 'video2' => "https://www.youtube.com/embed/23JHyOGkqbQ", 'svg' => 'tax_return.svg'],
            self::LAST_YR_TAX_RETURNS => ["sample" => url('assets/img/tax_return.png'),"img" => url('assets/img/tax_return.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/v1bzuyyMjxw", 'video2' => "https://www.youtube.com/embed/23JHyOGkqbQ", 'svg' => 'tax_return.svg'],
            self::PRIOR_YR_TWO_TAX_RETURNS => ["sample" => url('assets/img/tax_return.png'),"img" => url('assets/img/tax_return.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/v1bzuyyMjxw", 'video2' => "https://www.youtube.com/embed/23JHyOGkqbQ", 'svg' => 'tax_return.svg'],
            self::PRIOR_YR_THREE_TAX_RETURNS => ["sample" => url('assets/img/tax_return.png'),"img" => url('assets/img/tax_return.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/v1bzuyyMjxw", 'video2' => "https://www.youtube.com/embed/23JHyOGkqbQ", 'svg' => 'tax_return.svg'],
            self::MISCELLANEOUS_DOCUMENTS => ["img" => url('assets/img/misc_file.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/qzy1wbK4yNE", 'video2' => "https://www.youtube.com/embed/koIGfZ_YYAU", 'svg' => 'misc_docs.svg'],
            self::W2_LAST_YEAR => ["sample" => url('assets/img/w2_file.png'),"img" => url('assets/img/w2_file.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/qzy1wbK4yNE", 'video2' => "https://www.youtube.com/embed/koIGfZ_YYAU", 'svg' => 'w2_form.svg'],
            self::W2_YEAR_BEFORE => ["sample" => url('assets/img/w2_file.png'),"img" => url('assets/img/w2_file.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/qzy1wbK4yNE", 'video2' => "https://www.youtube.com/embed/koIGfZ_YYAU", 'svg' => 'w2_form.svg'],
            self::INSURANCE_DOCUMENTS => ["img" => url('assets/img/insurance_report.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/qzy1wbK4yNE", 'video2' => "https://www.youtube.com/embed/koIGfZ_YYAU", 'svg' => 'insurance.svg'],
            self::DEBTOR_CREDITOR_REPORT => ["img" => url('assets/img/misc_file.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/qzy1wbK4yNE", 'video2' => "https://www.youtube.com/embed/koIGfZ_YYAU", 'svg' => 'credit_report.svg'],
            self::CO_DEBTOR_CREDITOR_REPORT => ["img" => url('assets/img/misc_file.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/qzy1wbK4yNE", 'video2' => "https://www.youtube.com/embed/koIGfZ_YYAU", 'svg' => 'credit_report.svg'],
            self::OTHER_MISC_DOCUMENTS => ["img" => url('assets/img/misc_file.png'), 'size' => '', 'video1' => "https://www.youtube.com/embed/qzy1wbK4yNE", 'video2' => "https://www.youtube.com/embed/koIGfZ_YYAU", 'svg' => 'misc_docs.svg'],
        ];
    }

    public static function download_combined_tax_return($client_id, $documentsToCombine)
    {
        //$docDirepath = public_path().'/documents/';
        // $command = 'sudo chown -R ubuntu:www-data '.$docDirepath;
        //$command2 = 'sudo chmod -R 775 '.$docDirepath;
        //shell_exec($command);
        //shell_exec($command2);
        $pdfarray = [];
        $index = 'A';
        $savedFileName = 'combined_files.pdf';
        $firstDocument = public_path().'/documents/'.$client_id.'/'.$savedFileName;

        foreach ($documentsToCombine as $key => $doc) {
            if (in_array($doc['document_type'], ["Debtor_Pay_Stubs","Co_Debtor_Pay_Stubs"])) {
                $dates = explode(".", $doc['document_paystub_date']);
                if (isset($dates[0]) && isset($dates[1]) && isset($dates[2])) {
                    $month = $dates[0];
                    $day = $dates[1];
                    $year = $dates[2];
                    $thisdate = $year.'/'. $month.'/'.$day;
                    $thisdate = strtotime($thisdate);
                    $documentsToCombine[$key]['compare_date'] = $thisdate;
                }
            }
        }
        usort($documentsToCombine, function ($a, $b) {
            if (isset($b['compare_date']) && isset($a['compare_date'])) {
                return $b['compare_date'] <=> $a['compare_date'];
            }
        });

        $clientDocs = \App\Models\ClientDocuments::getClientDocumentList($client_id);
        foreach ($documentsToCombine as $key1 => $doc) {
            if (in_array($doc['document_type'], array_keys($clientDocs))) {
                $thisdate = 1;
                $dates = explode("-", $doc['document_month']);
                if (isset($dates[0]) && isset($dates[1])) {
                    $month = $dates[0];
                    $year = $dates[1];
                    $thisdate = $year.'/'. $month.'/01';
                    $thisdate = strtotime($thisdate);
                    $documentsToCombine[$key1]['compare_month_date'] = $thisdate;
                }
            }
        }
        usort($documentsToCombine, function ($a, $b) {
            if (isset($b['compare_month_date']) && isset($a['compare_month_date'])) {
                return $b['compare_month_date'] <=> $a['compare_month_date'];
            }
        });

        foreach ($documentsToCombine as $document) {
            if ($document['is_uploaded_to_s3'] == 1) {
                $urlTemp = DocumentHelper::s3toTemp($client_id, $document['document_file']) ?? '';
                if (!empty($urlTemp)) {
                    $pdfarray[$index] = $urlTemp;
                }
            }
            $index++;
        }

        if (empty($pdfarray)) {
            return false;
        }
        $pdf = \App\Models\PdfData::commonPdfGenerateScript($pdfarray);
        foreach ($pdfarray as $key => $val) {
            $pdf->cat(1, 'end', $key);
        }

        $pdf->saveAs($firstDocument);
        DocumentHelper::flushS3Temp($client_id);
        if (file_exists($firstDocument)) {
            DocumentHelper::generatePDFFile($savedFileName, $firstDocument);
        } else {
            Log::error("Combined PDF file not found: $firstDocument");

            return false;
        }

        return true;
    }
    public static function getTaxYearArray()
    {
        return  [
             ClientDocumentUploaded::LAST_YR_TAX_RETURNS,
             ClientDocumentUploaded::PRIOR_YR_TAX_RETURNS,
             ClientDocumentUploaded::PRIOR_YR_TWO_TAX_RETURNS,
             ClientDocumentUploaded::PRIOR_YR_THREE_TAX_RETURNS
         ];
    }
    public static function getTaxDocumentById($id = null)
    {
        $list = self::getTaxYearArray();

        return isset($list[$id]) ? $list[$id] : $list;
    }

    public static function storeClientSideDocument($client_id, $file, $documentType, $newName = '', $added_by_attorney = 0, $defaultStatus = 0, $extension = '', $ignoreValidation = false, $document_month = '', $document_paystub_date = '', $selected_debtor = "")
    {
        try {
            $store_path = "documents/" . $client_id;
            $imageName = $file->getClientOriginalName();
            $mime_type = $file->getMimeType();
            $imageName = pathinfo($imageName, PATHINFO_FILENAME);
            $imageName = Helper::validate_doc_type($imageName);
            $updatedImageName = $imageName;
            $user = User::where(['id' => $client_id])->select(['id', 'email', 'name', 'client_type'])->first();
            $allowedTypes = ArrayHelper::getAllowedFileExtensionArray();
            $extension = DocumentHelper::getExtensionFromFile($file, $allowedTypes);
            if (!empty($newName)) {
                $updatedImageName = Helper::validate_doc_type($newName);
                $imageName = $updatedImageName;
            }
            if (strtolower($extension) != "pdf") {
                $origionalName = $file->getClientOriginalName();
                if (!DocumentHelper::hasExtension($file->getClientOriginalName())) {
                    $origionalName .= '.' . $extension;
                }
                $path = self::convertImageToPDF($client_id, $file, $updatedImageName, $origionalName, $extension, $documentType);
                if (isset($path['status']) && !$path['status']) {
                    return ['status' => false, 'message' => 'Failed to convert image to PDF.'];
                } else {
                    $path = $path['file_path'];
                }
            } else {
                $path = $file->store($store_path, 's3');
            }

            $errorPathLength = DocumentHelper::validatePath($path);
            if ($errorPathLength) {
                return ['status' => false, 'message' => $errorPathLength];
            }

            // Notification for requested docs
            if (!$added_by_attorney) {
                $requestedDocs = \App\Models\AdminClientRequestedDocuments::getRequestedDocumentsAddedBy($client_id);
                if (!empty($requestedDocs['added_by'])) {
                    $requesteddocments = $requestedDocs['requestedDocuments'];
                    $documentTypes = array_keys($requesteddocments);
                    if (in_array($documentType, $documentTypes)) {
                        $documentName = $requesteddocments[$documentType] ?? $documentType;
                        $addedByDetails = User::where(['id' => $requestedDocs['added_by']])->select(['email', 'name'])->first();
                        $added_by_email = $addedByDetails->email ?? '';
                        try {
                            $attorney_id = self::getClientAttorneyId($client_id);
                            if (AttorneySettings::isEmailEnabled($attorney_id, 'attorney_client_sent_requested_doc_mail')) {
                                $sendTo = ParalegalSettings::getMailSendToId($client_id, $added_by_email, !empty(Auth::user()->parent_attorney_id));
                                Mail::to($sendTo)->send(new RequestedDocUploaded($user, $addedByDetails->name, $documentName));
                            }
                        } catch (\Exception $e) {
                            // Log but don't block upload
                            Log::error('RequestedDocUploaded mail error: ' . $e->getMessage());
                        }
                    }
                }
            }

            $maxSortOrder = ClientDocumentUploaded::where(['client_id' => $client_id, 'document_type' => $documentType])->max('sort_order');
            $sort_order = (isset($maxSortOrder) && !empty($maxSortOrder)) ? $maxSortOrder + 1 : 0;

            $mime_type = 'application/pdf';
            $url = Storage::disk('s3')->url($path);
            if (!empty($document_paystub_date)) {
                $imageName = $document_paystub_date;
            }

            $finalImageName = self::getFinalImageNameByDocumentType($documentType, $user, $client_id, $imageName, $selected_debtor);

            $upload_documents = [
                'client_id' => $client_id,
                'updated_name' => DocumentHelper::validate_doc_name($finalImageName),
                'document_file' => $path,
                'document_month' => $document_month,
                'document_paystub_date' => $document_paystub_date,
                'is_uploaded_to_s3' => 1,
                'file_s3_url' => $url,
                'mime_type' => $mime_type,
                'document_type' => $documentType,
                'added_by_attorney' => $added_by_attorney,
                'document_status' => $defaultStatus,
                'sort_order' => $sort_order
            ];

            if (in_array($documentType, self::MULTIPLE_DOC_NOT_ALLOWED_FOR)) {
                $object = ClientDocumentUploaded::updateOrCreate(['client_id' => $client_id, 'document_type' => $documentType], $upload_documents);
            } else {
                $object = ClientDocumentUploaded::create($upload_documents);
            }

            self::clearTempDirs($client_id);

            return $object->id;
        } catch (\Exception $e) {
            Log::error('Error in storeClientSideDocument: ' . $e->getMessage());

            return ['status' => false, 'message' => 'Failed to upload document. ' . $e->getMessage()];
        }
    }

    protected static function getClientAttorneyId($client_id)
    {
        $attorney_id = null;
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }

        return $attorney_id;
    }

    public static function convertImageToPDF($client_id, $file, $filename, $origianlname, $origionalEx, $documentType, $clientSignedDocument = false, $attSignedDocumentPath = '')
    {
        // create temp file
        $clientDir = public_path() . '/documents/' . $client_id;

        if (!\File::exists($clientDir)) {
            \File::makeDirectory($clientDir, 0777, true, true);
        }

        $tempFilepath = public_path() . '/documents/' . $client_id . '/imgtempdirec';
        if (!file_exists($tempFilepath)) {
            \File::makeDirectory($tempFilepath, 0777, true, true);
        }

        $file->move($tempFilepath, (!empty($origianlname) ? $origianlname : $file->getClientOriginalName()));

        $timestamp = '';
        $filename = DocumentHelper::sanitizePdfFilename($filename);
        $newname = rtrim($filename, '.') . ".$timestamp.pdf";

        $targetdir = public_path() . '/documents/' . $client_id . '/imgtopdfconverted';

        if (!file_exists($targetdir)) {
            \File::makeDirectory($targetdir, 0777, true, true);
        }

        $document_file = $targetdir . '/' . $newname;

        // Convert API: Convert the image to PDF
        ConvertApi::setApiCredentials(env('CONVERTAPI_TOKEN'));

        $file_path = $tempFilepath . '/' . (!empty($origianlname) ? $origianlname : $file->getClientOriginalName());

        try {
            $startTime = microtime(true);
            $timeoutSeconds = 300; // 5 minutes

            if (strtolower($origionalEx) != "pdf") {
                $result = null;
                $exception = null;

                // Timeout check for ConvertApi::convert
                try {
                    $result = ConvertApi::convert(
                        'pdf',
                        [
                            'File' => $file_path,
                        ],
                        $origionalEx,
                    );
                } catch (\Exception $e) {
                    $exception = $e;
                }

                $elapsed = microtime(true) - $startTime;
                if ($elapsed > $timeoutSeconds) {
                    throw new \Exception("ConvertApi conversion exceeded 300 seconds timeout.");
                }
                if ($exception) {
                    throw $exception;
                }
                if (empty($result->getFiles())) {
                    throw new \Exception("ConvertApi did not return any files.");
                }

                $result->getFiles()[0]->save($document_file);
                $file_path = $document_file;
            }

            // compress PDF only for certain document types.
            if (in_array($documentType, [ClientDocumentUploaded::DEBTOR_PAY_STUB, ClientDocumentUploaded::CO_DEBTOR_PAY_STUB, ClientDocumentUploaded::DEBTOR_CREDITOR_REPORT, ClientDocumentUploaded::CO_DEBTOR_CREDITOR_REPORT])) {
                $compressStart = microtime(true);
                $result = null;
                $exception = null;

                try {
                    $result = ConvertApi::convert('compress', [
                        'File' => $file_path,
                        'ImageQuality' => "85",
                        "RemoveEmbeddedFiles" => false,
                        "RemoveDuplicates" => true,
                        "RemovePieceInformation" => true,
                        "RemoveMetadata" => true,
                        "RemoveUnusedResources" => true,
                    ], 'pdf');
                } catch (\Exception $e) {
                    $exception = $e;
                }

                $elapsed = microtime(true) - $startTime;
                if ($elapsed > $timeoutSeconds) {
                    throw new \Exception("ConvertApi compression exceeded 300 seconds timeout.");
                }
                if ($exception) {
                    throw $exception;
                }
                if (empty($result->getFiles())) {
                    throw new \Exception("ConvertApi compression did not return any files.");
                }
                $result->getFiles()[0]->save($document_file);
            }
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "Failed to convert or compress file: " .$e->getMessage()];
        }

        if (!file_exists($document_file) && strtolower($origionalEx) == "pdf") {
            $document_file = $file_path;
        }

        $extension = pathinfo($newname, PATHINFO_EXTENSION); // Get file extension
        $uniqueName = \Str::uuid() . '.' . $extension; // Generates something like "f47ac10b-58cc-4372-a567-0e02b2c3d479.jpg"
        $s3_path = 'documents/' . $client_id . '/' . $uniqueName;

        if ($clientSignedDocument) {
            $uniqueName = $newname;
            $s3_path = 'client/' . $client_id . '/signed_document/' . $uniqueName;
        }
        if (!empty($attSignedDocumentPath)) {
            $uniqueName = $newname;
            $s3_path = $attSignedDocumentPath . '/' . $uniqueName;
        }

        \Log::info('Compressed file path=' . $s3_path);
        if (file_exists($document_file)) {
            Storage::disk('s3')->put($s3_path, fopen($document_file, 'r+'));
        } else {
            \File::deleteDirectory($tempFilepath);

            return ['status' => false, 'message' => "Converted file not found: ".$document_file];
        }

        // clean up temporary files
        \File::deleteDirectory($tempFilepath);

        // Always return either the S3 path (string) or an array with status false and error message

        return ['status' => true, 'file_path' => $s3_path];
    }

    public static function getAttorneyDocuments($client_id)
    {
        $client = User::where('id', $client_id)->first();
        $client_attorney_id = ($client->ClientsAttorneybyclient->exists()) ? $client->ClientsAttorneybyclient->attorney_id : 0;
        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $client_attorney_id;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attorneydocuments = \App\Models\AttorneyDocuments::where(['attorney_id' => $settingsAttorneyId , 'is_associate' => $is_associate])->pluck('document_name', 'document_type')->all();
        $attorneyCommonDocuments = \App\Models\ClientDocuments::getClientDocs($client_id, 'attorney_common_doc');
        $attorneydocuments = array_merge($attorneydocuments, $attorneyCommonDocuments);

        return $attorneydocuments;
    }

    public static function clearTempDirs($client_id)
    {
        $dir1 = public_path().'/documents/'.$client_id.'/'.'imgtempdirec';
        $dir2 = public_path().'/documents/'.$client_id.'/imgtopdfconverted';
        $dir3 = public_path().'/documents/'.$client_id.'/'.'doctempDir';
        $dir4 = public_path().'/documents/'.$client_id.'/converted';
        if (File::exists($dir1)) {
            File::deleteDirectory($dir1);
        }
        if (File::exists($dir2)) {
            File::deleteDirectory($dir2);
        }
        if (File::exists($dir3)) {
            File::deleteDirectory($dir3);
        }
        if (File::exists($dir4)) {
            File::deleteDirectory($dir4);
        }
    }

    public static function updateTaxFilesNames($files, $type, $client_id, $attorney_id = '')
    {

        $data = self::updatePreviousTaxFilesNames($type, $client_id, $attorney_id, true);

        $docNo = Helper::validate_key_value('docNo', $data);
        $year = Helper::validate_key_value('year', $data);

        $updatedFiles = [];
        foreach ($files as $file) {
            $nameToBeUpdated = Helper::validate_doc_type($year . ' Tax Page ' . $docNo);
            $nameToBeUpdated = $nameToBeUpdated . '.' . $file->getClientOriginalExtension();
            // Create a new instance of UploadedFile with the updated original name
            $newFile = new UploadedFile(
                $file->getPathname(), // The file's full path
                $nameToBeUpdated, // The new original name
                $file->getMimeType(), // The file's MIME type
                $file->getError(), // The file's error code
                true // Whether the file was uploaded via HTTP POST (defaults to true)
            );

            $updatedFiles[] = $newFile;
            $docNo++;
        }

        return $updatedFiles;

    }

    public static function updatePreviousTaxFilesNames($type, $client_id, $attorney_id = '', $returnData = false)
    {

        if (empty($attorney_id)) {
            $client_attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->select('attorney_id')->first();
            $client_attorney = (!empty($client_attorney)) ? $client_attorney : [];
            $attorney_id = $client_attorney->attorney_id;
        }

        $attorney = AttorneySettings::where('attorney_id', $attorney_id)
    ->select('tax_return_day_month')
    ->first()
    ?? new AttorneySettings(['tax_return_day_month' => '01/10']);

        $alreadyUploadDocs = \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id, 'document_type' => $type])
                                ->select('id', 'document_type', 'updated_name')
                                ->orderBy('sort_order', 'asc')
                                ->orderBy('id', 'asc')
                                ->get();
        $alreadyUploadDocs = (isset($alreadyUploadDocs) && !empty($alreadyUploadDocs)) ? $alreadyUploadDocs->toArray() : [];

        $docNo = 1;

        $year = "";
        switch ($type) {
            case 'Last_Year_Tax_Returns':           $year = DateTimeHelper::getYearForTaxReturn("Last_Year_Tax_Returns", $attorney->tax_return_day_month);
                break;
            case 'Prior_Year_Tax_Returns':          $year = DateTimeHelper::getYearForTaxReturn("Prior_Year_Tax_Returns", $attorney->tax_return_day_month);
                break;
            case 'Prior_Year_Two_Tax_Returns':      $year = DateTimeHelper::getYearForTaxReturn("Prior_Year_Two_Tax_Returns", $attorney->tax_return_day_month);
                break;
            case 'Prior_Year_Three_Tax_Returns':    $year = DateTimeHelper::getYearForTaxReturn("Prior_Year_Three_Tax_Returns", $attorney->tax_return_day_month);
                break;
        }

        if (!empty($alreadyUploadDocs)) {
            foreach ($alreadyUploadDocs as $index => $document) {
                $nameToBeUpdated = Helper::validate_doc_type($year . ' Tax Page ' . $docNo);
                $alreadyUploadDocs = \App\Models\ClientDocumentUploaded::where(['id' => $document['id'], 'client_id' => $client_id, 'document_type' => $type])->update(['sort_order' => $index, 'updated_name' => $nameToBeUpdated]);
                $docNo++;
            }
        }

        if ($returnData) {
            return ['docNo' => $docNo, 'year' => $year];
        }
    }


    public static function updateBankFilesNames($request, $client_id)
    {

        $fileMonths = Helper::validate_key_value('statement_month', $request);
        $files = Helper::validate_key_value('document_file', $request);
        $type = Helper::validate_key_value('document_type', $request);

        $monthCounters = self::updatePreviousBankFilesNames($type, $client_id, true);
        $updatedFiles = [];
        foreach ($files as $index => $file) {

            if (!file_exists($file->getPathname()) || !is_readable($file->getPathname())) {
                \Log::warning('Skipped unreadable or non-existent file in updateBankFilesNames', [
                    'client_id' => $client_id,
                    'file_path' => $file->getPathname(),
                    'index' => $index,
                ]);
                continue;
            }

            try {
                $mimeType = $file->getMimeType();
            } catch (\Exception $e) {
                \Log::error('Failed to get mime type in updateBankFilesNames', [
                    'client_id' => $client_id,
                    'file_path' => $file->getPathname(),
                    'index' => $index,
                    'error' => $e->getMessage()
                ]);
                continue;
            }

            try {
                $month = \Carbon\Carbon::createFromFormat('m-Y', $fileMonths[$index])->format('F');
            } catch (\Exception $e) {
                $month = 'Current Month Stmt';
            }

            if (!isset($monthCounters[$month])) {
                $monthCounters[$month] = 1;
            } else {
                $monthCounters[$month]++;
            }

            $nameToBeUpdated = $month . ' ' . $monthCounters[$month];

            $newFile = new UploadedFile(
                $file->getPathname(),
                $nameToBeUpdated,
                $mimeType,
                $file->getError(),
                false // Ensure false for actual file uploads
            );

            $updatedFiles[] = $newFile;
        }

        return $updatedFiles;
    }

    public static function updateBankFilesNamesForSingleUpload($request, $client_id)
    {
        $fileMonths = Helper::validate_key_value('document_month', $request);
        $files = Helper::validate_key_value('image', $request);

        $type = Helper::validate_key_value('document_type', $request);

        $monthCounters = self::updatePreviousBankFilesNames($type, $client_id, true);

        // Ensure $files and $fileMonths are arrays
        if (!is_array($files)) {
            $files = [$files];
            $fileMonths = [$fileMonths];
        }


        $updatedFiles = [];

        foreach ($files as $index => $file) {

            if (!file_exists($file->getPathname()) || !is_readable($file->getPathname())) {
                \Log::warning('Skipped unreadable or non-existent file in updateBankFilesNamesForSingleUpload', [
                    'client_id' => $client_id,
                    'file_path' => $file->getPathname(),
                    'index' => $index,
                ]);
                continue;
            }

            try {
                $mimeType = $file->getMimeType();
            } catch (\Exception $e) {
                \Log::error('Failed to get mime type in updateBankFilesNamesForSingleUpload', [
                    'client_id' => $client_id,
                    'file_path' => $file->getPathname(),
                    'index' => $index,
                    'error' => $e->getMessage()
                ]);
                continue;
            }

            try {
                $month = \Carbon\Carbon::createFromFormat('m-Y', $fileMonths[$index])->format('F');
            } catch (\Exception $e) {
                continue;
            }

            if (!isset($monthCounters[$month])) {
                $monthCounters[$month] = 1;
            } else {
                $monthCounters[$month]++;
            }

            $nameToBeUpdated = $month . ' ' . $monthCounters[$month];

            $newFile = new UploadedFile(
                $file->getPathname(),
                $nameToBeUpdated,
                $mimeType,
                $file->getError(),
                false // Ensure false for actual file uploads
            );


            $updatedFiles[] = $newFile;

        }

        // Return a single file object if there's only one file, otherwise return an array
        return count($updatedFiles) === 1 ? $updatedFiles[0] : $updatedFiles;
    }


    public static function updatePreviousBankFilesNames($type, $client_id, $returnData = false)
    {

        $monthCounters = [];
        $alreadyUploadDocs = \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id, 'document_type' => $type])
                ->select('id', 'document_month', 'document_type', 'updated_name')
                ->orderBy('sort_order', 'asc')
                ->orderBy('id', 'asc')
                ->get();
        $alreadyUploadDocs = (isset($alreadyUploadDocs) && !empty($alreadyUploadDocs)) ? $alreadyUploadDocs->toArray() : [];


        foreach ($alreadyUploadDocs as &$doc) {
            $monthFormatted = '';

            try {
                $monthFormatted = \Carbon\Carbon::createFromFormat('m-Y', $doc['document_month'])->format('F');
            } catch (\Exception $e) {
                continue;
            }

            if (!isset($monthCounters[$monthFormatted])) {
                $monthCounters[$monthFormatted] = 1;
            } else {
                $monthCounters[$monthFormatted]++;
            }

            $doc['updated_name'] = $monthFormatted . ' ' . $monthCounters[$monthFormatted];

            \App\Models\ClientDocumentUploaded::where('id', $doc['id'])
                ->update(['updated_name' => $doc['updated_name']]);
        }

        if ($returnData) {
            return $monthCounters;
        }
    }

    public static function getDocumentForCombine($employer_id, $client_id, $docType, $selectedIds)
    {
        $taxDocs = [];
        if ($employer_id > 0) {

            $taxDocumentsQuery = DB::table('tbl_client_document_uploaded as cdu')
                ->join('tbl_pinwheel_paystub as pps', function ($join) {
                    $join->on('cdu.client_id', '=', 'pps.client_id')->on('cdu.id', '=', 'pps.document_id');
                })
                ->where([
                    ['cdu.client_id', '=', $client_id],
                    ['cdu.mime_type', '=', 'application/pdf'],
                    ['cdu.document_type', '=', $docType],
                    ['pps.employer_id', '=', $employer_id]
                ])
                ->orderBy('cdu.sort_order', 'asc')
                ->groupBy('pps.document_id')
                ->select(['cdu.*','pps.employer_id','pps.document_id']);


            if (!empty($selectedIds)) {
                $taxDocumentsQuery->whereIn('cdu.id', $selectedIds);
            }
            if ($docType == 'Debtor_Pay_Stubs' || $docType == 'Co_Debtor_Pay_Stubs') {
                $taxDocumentsQuery->orderByRaw("STR_TO_DATE(cdu.document_paystub_date, '%m.%d.%Y') DESC");
            }
            $taxDocs = $taxDocumentsQuery->get();
            $taxDocs = json_decode(json_encode($taxDocs), true);
        } else {
            if ($docType != 'secured_docs') {
                $taxDocumentsQuery = ClientDocumentUploaded::where(['client_id' => $client_id,'mime_type' => 'application/pdf'])->where('document_type', $docType)->orderby('sort_order', 'asc');
            }
            if ($docType == 'secured_docs') {
                $taxDocumentsQuery = ClientDocumentUploaded::where(['client_id' => $client_id,'mime_type' => 'application/pdf'])->orderby('sort_order', 'asc');
            }
            if (!empty($selectedIds)) {
                $taxDocumentsQuery->whereIn('id', $selectedIds);
            }
            if ($docType == 'Debtor_Pay_Stubs' || $docType == 'Co_Debtor_Pay_Stubs') {
                $taxDocumentsQuery->orderByRaw("STR_TO_DATE(document_paystub_date, '%m.%d.%Y') DESC");
            }
            $taxDocs = $taxDocumentsQuery->get();
            $taxDocs = !empty($taxDocs) ? $taxDocs->toArray() : [];
        }

        return $taxDocs;
    }


    public static function show_client_documents_download_popup($request)
    {

        $input = $request->all();
        $client_id = Helper::validate_key_value('client_id', $input, 'radio');
        $doc_type = Helper::validate_key_value('doc_type', $input);

        $alreadyUploadedDocs = ClientDocumentUploaded::where(['client_id' => $client_id, 'document_type' => $doc_type])
                                ->select('id', 'document_type', 'updated_name', 'document_file')
                                ->orderBy('sort_order', 'asc')
                                ->orderBy('id', 'asc')
                                ->get();
        $alreadyUploadedDocs = (isset($alreadyUploadedDocs) && !empty($alreadyUploadedDocs)) ? $alreadyUploadedDocs->toArray() : [];

        return view('client.client_documents_download_popup', [ 'alreadyUploadedDocs' => $alreadyUploadedDocs, 'doc_type' => $doc_type, 'client_id' => $client_id ]);
    }



    public static function remove_single_client_document($request)
    {
        $input = $request->all();
        $client_id = Helper::validate_key_value('client_id', $input, 'radio');
        $doc_id = Helper::validate_key_value('doc_id', $input, 'radio');
        $doc_type = Helper::validate_key_value('doc_type', $input);

        $document = ClientDocumentUploaded::where([
            'client_id' => $client_id,
            'id' => $doc_id,
            'document_type' => $doc_type
        ])->first();

        if (empty($document)) {
            return response()->json(Helper::renderJsonError('Something went wrong.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        if (!empty($document->document_file) && !Storage::disk('s3')->exists($document->document_file)) {
            \App\Models\ClientDocumentUploaded::where('id', $doc_id)->delete();
            \App\Models\ClientDocumentUploaded::where(['relate_to_document' => $doc_id])->update(['relate_to_document' => 0]);
            if (in_array($doc_type, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])) {
                \App\Models\PayStubs::where([
                    'client_id' => $client_id,
                    'document_id' => $doc_id
                ])->delete();
            }

            return response()->json(Helper::renderJsonSuccess('Document deleted successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        DB::beginTransaction();
        try {
            // Delete from UploadedOcrData
            \App\Models\UploadedOcrData::where([
                'client_id' => $client_id,
                'id' => $doc_id
            ])->delete();

            // Delete from PayStubs if applicable
            if (in_array($doc_type, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])) {
                \App\Models\PayStubs::where([
                    'client_id' => $client_id,
                    'document_id' => $doc_id
                ])->delete();
            }

            // Add concierge service note
            $subject = "Document Deleted By " . Auth::user()->name;
            $note = "Document $doc_type " . $document->updated_name . " is deleted via My Document page by client " . Auth::user()->name;
            \App\Models\ConciergeServiceNotes::create([
                'client_id' => $client_id,
                'subject' => $subject,
                'note' => $note,
                'added_by_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Delete main document and update related
            \App\Models\ClientDocumentUploaded::where('id', $doc_id)->delete();
            \App\Models\ClientDocumentUploaded::where(['relate_to_document' => $doc_id])->update(['relate_to_document' => 0]);

            DB::commit();

            // Now attempt to delete from S3
            self::deleteFileFromS3($document->document_file, $doc_type);
            self::createNotificationForClient($client_id, $doc_type);

            return response()->json(Helper::renderJsonSuccess('Document deleted successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting client document: ' . $e->getMessage());

            return response()->json(Helper::renderJsonError('Error deleting document. Please try again.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    private static function deleteFileFromS3($filePath, $doctype)
    {
        if (!empty($filePath) && Storage::disk('s3')->exists($filePath)) {
            if ($doctype !== 'Vehicle_Information') {
                Storage::disk('s3')->delete($filePath);
            }
        }
    }


    private static function createNotificationForClient($client_id, $doctype)
    {
        $user = User::where('id', $client_id)->select('name')->first();

        $notif_body = "document has been deleted by ".$user->name."!";
        $notif_body = str_replace("_", " ", $doctype.' '.$notif_body);
        $data = [
            'client_id' => $client_id,
            'unotification_body' => $notif_body,
            'unotification_date' => date("Y-m-d H:i:s"),
            'unotification_is_read' => 0,
            'unotification_type' => \App\Models\Notifications::DOCUMENT_TYPE,
            'unotification_data' => json_encode(['document_status' => \App\Models\ClientDocumentUploaded::STATUS_DELETED, 'file_url' => '', 'document_enable_reupload' => 1,'document_type' => $doctype]),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        \App\Models\Notifications::create($data);
    }

    public static function create_thumbnails($document_ids, $client_id)
    {
        //
        $responce = [];
        foreach ($document_ids as $key => $document_id) {
            $document = ClientDocumentUploaded::where(['id' => $document_id])
            ->whereIn('is_generated_thumbnails', [0, 1, 3])->first();
            if (empty($document)) {
                continue;
            }
            ClientDocumentUploaded::where('id', $document_id)->update(['is_generated_thumbnails' => 1]);
            $pdf_document = $document->document_file;
            $newname = basename($pdf_document, ".pdf");
            $download_path = public_path().'/documents/temp_downloaded';
            try {
                if (!file_exists($download_path)) {
                    File::makeDirectory($download_path, 0777, true, true);
                }
                $contents = Storage::disk('s3')->get($pdf_document);
                file_put_contents($download_path.'/'.$newname.'.pdf', $contents);

                ConvertApi::setApiCredentials(env('CONVERTAPI_TOKEN'));
                $pngs = ConvertApi::convert('png', [
                    'File' => $download_path.'/'.$newname.'.pdf',
                ], 'pdf');
                $final_png_arr = [];
                foreach ($pngs->getFiles() as $key => $png) {
                    $extension = pathinfo($newname, PATHINFO_EXTENSION); // Get file extension
                    $newname = Str::uuid() . '.' . $extension; // Generates something like "f47ac10b-58cc-4372-a567-0e02b2c3d479.jpg"
                    $s3_path = 'documents/'.$client_id.'/'.$newname."_".$key.".png";
                    $url = $png->getUrl();
                    $file_content = file_get_contents($url);
                    if ($file_content) {
                        Storage::disk('s3')->put($s3_path, $file_content);
                    }
                    $final_png_arr[] = $s3_path;
                }

                if (file_exists($download_path.'/'.$newname.'.pdf')) {
                    unlink($download_path.'/'.$newname.'.pdf');
                }
                ClientDocumentUploaded::where('id', $document_id)->update(['thumbnails' => json_encode($final_png_arr), 'is_generated_thumbnails' => 2]);
                $responce[$document_id] = $final_png_arr;
            } catch (\Exception $e) {
                Log::info("error generating thumbnail:".$e->getMessage());
                if (file_exists($download_path.'/'.$newname.'.pdf')) {
                    unlink($download_path.'/'.$newname.'.pdf');
                }
                ClientDocumentUploaded::where('id', $document_id)->update(['is_generated_thumbnails' => 3]);
            }
        }

        return $responce;
    }

    public static function getFinalImageNameByDocumentType($documentType, $user, $client_id, $imageName, $selected_debtor)
    {
        $finalName = '';

        if (in_array($documentType, [self::DRIVING_LIC, self::CO_DEBTOR_DRIVING_LIC, self::SOCIAL_SECURITY_CARD, self::CO_DEBTOR_SECURITY_CARD])) {
            $finalName = self::getFinalNameForIdDocs($documentType, $imageName, $user);
        }
        if (in_array($documentType, [self::DEBTOR_SOCIAL_SECURITY_ANNUAL_AWARD_LETTER, self::DEBTOR_VA_BENEFIT_AWARD_LETTER, self::DEBTOR_UNEMPLOYMENT_PAYMENT_HISTORY, self::CODEBTOR_SOCIAL_SECURITY_ANNUAL_AWARD_LETTER, self::CODEBTOR_VA_BENEFIT_AWARD_LETTER, self::CODEBTOR_UNEMPLOYMENT_PAYMENT_HISTORY])) {
            $finalName = ArrayHelper::getUpdatedOtherIncomeTypeName($user->client_type, $documentType);
        }
        if (in_array($documentType, [self::W2_LAST_YEAR, self::W2_YEAR_BEFORE])) {
            $finalName = $imageName . ' W-2 - '. $selected_debtor;
        }
        if (in_array($documentType, [self::PRE_FILLING_CCC])) {
            $finalName = 'Credit Counseling Certificate';
        }
        if (str_starts_with($documentType, 'Mortgage_property_value')
            || str_starts_with($documentType, self::CURRENT_MORTGAGE_STMT)) {
            $finalName = self::getFinalNameForResidenceDocs($documentType, $imageName, $client_id);
        }

        $isYear = preg_match('/^\d{4}/', $documentType);
        $year = (int)substr($documentType, 0, 4);
        $currentYear = (int)date("Y");

        $isValidYear = $year >= 1900 && $year <= $currentYear;

        if (str_starts_with($documentType, 'Vehicle_Registration')
            || str_starts_with($documentType, 'Autoloan_property_value')
            || str_starts_with($documentType, 'Current_Auto_Loan_Statement')
            || str_starts_with($documentType, 'Other_Loan_Statement')
            || ($isYear && $isValidYear)) {
            $finalName = self::getFinalNameForVehicleDocs($documentType, $imageName, $client_id, $user, ($isYear && $isValidYear));
        }
        $retirement_pension_docs = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'retirement_pension');
        if (in_array($documentType, array_keys($retirement_pension_docs))) {
            $finalName = self::getFinalNameForRetirementDocs($documentType, $imageName, $retirement_pension_docs);
        }

        return !empty($finalName) ? $finalName : $imageName;
    }

    public static function getFinalNameForIdDocs($documentType, $imageName, $user)
    {
        $finalName = '';

        $BIData = CacheBasicInfo::getBasicInformationData($user->id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
        if ($user->client_type == 2) {
            $spousename = "Non-Filing Spouse";
        }

        switch ($documentType) {
            case self::DRIVING_LIC:
                $finalName = $debtorname.' Drivers LicGov ID';
                break;
            case self::CO_DEBTOR_DRIVING_LIC:
                $finalName = $spousename.' Drivers LicGov ID';
                break;
            case self::SOCIAL_SECURITY_CARD:
                $finalName = $debtorname.' Social Security CardITIN';
                break;
            case self::CO_DEBTOR_SECURITY_CARD:
                $finalName = $spousename.' Social Security CardITIN';
                break;
        }

        return !empty($finalName) ? $finalName : $imageName;
    }

    public static function getFinalNameForResidenceDocs($documentType, $imageName, $client_id)
    {
        $clientPropertyData = CacheProperty::getPropertyData($client_id);
        $clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
        $clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];
        $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentListWithHeading($clientProperty, true, false, $client_id);
        $mortgageUpdatedNames = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];
        $tempName = !empty($mortgageUpdatedNames) && is_array($mortgageUpdatedNames) ? Helper::validate_key_value($documentType, $mortgageUpdatedNames) : '';
        $tempName = self::removeUnwantedSymbols($tempName);

        return !empty($tempName) ? $tempName : $imageName;
    }

    public static function getFinalNameForVehicleDocs($documentType, $imageName, $client_id, $user, $isTitleDoc)
    {
        $attorney_id = self::getClientAttorneyId($client_id);
        $excludeDocs = DocumentUploadedData::getExcludedDocs($attorney_id, $client_id, $user);
        $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $attorney_id])->select(['bank_statement_months', 'attorney_enabled_bank_statment', 'is_car_title_enabled'])->first();
        $is_car_title_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_car_title_enabled', $attorneySettings, 'radio') : 0;
        $vehicle_title = $is_car_title_enabled ? \App\Models\ClientDocuments::getClientDocumentList($client_id, 'vehicle_title') : [];

        if ($isTitleDoc) {
            $vehicleUpdatedNames = $vehicle_title;
        } else {
            $clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentListWithHeading($client_id, true, !empty($vehicle_title), !in_array(self::VEHICLE_REGISTRATION, $excludeDocs));
            $vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];
        }
        $tempName = !empty($vehicleUpdatedNames) && is_array($vehicleUpdatedNames) ? Helper::validate_key_value($documentType, $vehicleUpdatedNames) : '';
        $tempName = self::removeUnwantedSymbols($tempName);

        return !empty($tempName) ? $tempName : $imageName;
    }

    public static function getFinalNameForRetirementDocs($documentType, $imageName, $retirement_pension_docs)
    {
        $finalName = '';

        $tempName = Helper::validate_key_value($documentType, $retirement_pension_docs);
        if (!empty($tempName)) {
            $finalName = preg_replace('/\s+/', ' ', $tempName);              // Replace multiple whitespace with a single space
            $finalName = str_replace('/', '', $finalName);                        // Remove all slashes
            $finalName = str_replace('.', '', $finalName);                        // Remove all dots
            $finalName = preg_replace('/^[^:]*:\s*/', '', $finalName);       // Remove everything before the first colon (inclusive)
            $finalName = str_replace(':', '', $finalName);                        // Remove remaining colons
        }

        return !empty($finalName) ? $finalName : $imageName;
    }

    public static function removeUnwantedSymbols($tempName)
    {
        $tempName = preg_replace('/\s+/', ' ', $tempName);   // Replace multiple whitespace with a single space
        $tempName = str_replace('/', '', $tempName);              // Remove all slashes
        $tempName = str_replace('.', '', $tempName);              // Remove all dots
        $tempName = str_replace(':', '', $tempName);              // Remove all colons

        return $tempName;
    }

}
