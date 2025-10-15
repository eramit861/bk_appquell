<?php

namespace App\Http\Controllers\Client;

use App\Helpers\ArrayHelper;
use App\Services\ClientService;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Support\Facades\URL;
use App\Helpers\ClientHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Traits\Common; // Trait
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Helpers\DateTimeHelper;
use App\Helpers\VideoHelper;
use App\Helpers\DocumentHelper;
use App\Models\AttorneySettings;
use App\Models\ClientsAssociate;
use App\Models\ParalegalSettings;
use Illuminate\Support\Facades\Log;
use App\Models\ClientDocuments;
use App\Models\ClientDocumentUploaded;
use App\Services\Client\CacheBasicInfo;
use Carbon\Carbon;

class ClientDocumentController extends Controller
{
    use Common;
    public function getClientDocument()
    {
        $client_id = Auth::user()->id;
        $client = \App\Models\User::where('id', '=', $client_id)->first();
        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
        $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
        if ($client->client_type == 2) {
            $spousename = "Non-Filing Spouse";
        }
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        $docsUploadInfo = ClientHelper::documentUploadInfo();
        $docs = [];
        $documentuploaded = @$docsUploadInfo['documentuploaded'];
        $attorneydocuments = @$docsUploadInfo['attorneydocuments'];

        $list = $docsUploadInfo['list'];
        $documentTypeList = Helper::getDocuments(Auth::user()->client_type, true, 1, 0, 1, 0, $attorney->attorney_id);
        $documentTypeList = $documentTypeList + [\App\Models\ClientDocumentUploaded::MISCELLANEOUS_DOCUMENTS => "Additional or Unlisted Documents"];
        /** Removing Mortgage loan docs if mortgage not added by client under residents */

        if (env('ENABLED_CLIENT_SIDE_CREDIT_REPORT', false) == true) {
            $creditReportEnabled = \App\Models\User::isCreditReportEnabledByClientId($client_id);
            if (isset($documentTypeList['Debtor_Creditor_Report']) && (!$creditReportEnabled['debtor'])) {
                unset($documentTypeList['Debtor_Creditor_Report']);
            }
            if (isset($documentTypeList['Co_Debtor_Creditor_Report']) && (!$creditReportEnabled['codebtor'])) {
                unset($documentTypeList['Co_Debtor_Creditor_Report']);
            }
        }


        $clientProperty = \App\Models\ClientsPropertyResident::where('client_id', $client_id)->where('currently_lived', '1')->get();

        $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentListWithHeading($clientProperty, true, false, $client_id);
        $mortgageUpdatedNames = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];
        $mortgageUpdatedNames = self::getFormatedMortgageUpdatedNames($mortgageUpdatedNames);


        $clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentList($client_id, true);
        $vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];

        $documentTypeList = array_merge($documentTypeList, $mortgageUpdatedNames);
        $documentTypeList = array_merge($documentTypeList, $vehicleUpdatedNames);


        $documentTypeList = $this->setPaystuAccordintToDebtor($documentTypeList, Auth::user()->client_payroll_assistant, Auth::user()->client_type, Auth::user()->client_subscription, 1);
        $documentTypeList = $this->addBankStatementTypeFilter($documentTypeList, Auth::user()->client_bank_statements, Auth::user()->client_profit_loss_assistant, Auth::user()->client_type, Auth::user()->client_subscription, 1);

        $documentTypeList = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $documentTypeList, true);


        $response = ClientDocuments::pay_check_calculation($client_id);

        // Process both debtor and codebtor using one call
        $debtorPayCheckData = !empty($response['debtorPayCheckData'])
            ? self::formatPayCheckData($response['debtorPayCheckData'])
            : [];

        $codebtorPayCheckData = !empty($response['codebtorPayCheckData'])
            ? self::formatPayCheckData($response['codebtorPayCheckData'])
            : [];



        $clientDocs = \App\Models\ClientDocuments::getClientDocumentList($client_id, null, true);
        $life_insurance = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'life_insurance');
        $requestedDocs = \App\Models\AdminClientRequestedDocuments::getRequestedDocuments($client_id);
        $requestedDocList = [];

        if (!empty($clientDocs)) {
            $requestedDocList = array_merge($requestedDocList, $clientDocs);
        }
        if (!empty($requestedDocs)) {
            $requestedDocList = array_merge($requestedDocList, $requestedDocs);
        }
        if (!empty($life_insurance)) {
            $requestedDocList = array_merge($requestedDocList, $life_insurance);
        }

        $requestedDocList = array_merge($requestedDocList, [\App\Models\ClientDocumentUploaded::OTHER_MISC_DOCUMENTS => "Debt(s)/Collection Statements"]);
        $requestedDocList = array_merge($requestedDocList, [\App\Models\ClientDocumentUploaded::VEHICLE_REGISTRATION => "Vehicle Registration"]);
        $requestedDocList = array_merge($requestedDocList, [\App\Models\ClientDocumentUploaded::INSURANCE_DOCUMENTS => "Proof of Auto Insurance"]);
        //array_merge(array_keys($requestedDocList),['Other_Misc_Documents', 'Vehicle_Registration', 'Insurance_Documents']);

        $requestedDocList = ClientHelper::getUpdatedLabelName($debtorname, $spousename, $requestedDocList, true);

        $requested_doc_available = 0;
        $videos = VideoHelper::getAdminVideos();

        if (!empty($requestedDocList)) {
            $requestedDocList = $this->getClientDocumentArray($requestedDocList, $documentuploaded, $list, $videos, $client_id);
            $requested_doc_available = 1;
        }
        $docs = $this->getClientDocumentArray($documentTypeList, $documentuploaded, $list, $videos, $client_id);
        $mainTutorial = $videos[Helper::MAIN_DOCUMENT_TUTORIAL_VIDEO] ?? [];
        $mainVideo = ['en' => $mainTutorial['english_video'] ?? '', 'sp' => $mainTutorial['spanish_video'] ?? '','ios_en' => $mainTutorial['iphone_english_video'] ?? '', 'ios_sp' => $mainTutorial['iphone_spanish_video'] ?? ''];

        $signdocObject = [
            'enable_upload' => 0,
            'doc_list' => null,
        ];

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney->attorney_id;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

        $excludeDocs = \App\Models\AttorneyExcludeDocs::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->first();
        $excludeDocs = !empty(json_decode($excludeDocs)) && !empty($excludeDocs->doc_type_json) ? json_decode($excludeDocs->doc_type_json, 1) : [];
        // array_push($excludeDocs, 'Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report');


        $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->select(['bank_statement_months'])->first();
        $bank_statement_months = !empty($attorneySettings) ? Helper::validate_key_value('bank_statement_months', $attorneySettings) : '';
        $statement_month_array = DateTimeHelper::getBankStatementMonthArray($bank_statement_months);
        $arrayDocs = [];
        foreach ($statement_month_array as $key => $listd) {
            $arrayDocs[] = ['key' => $key, 'value' => $listd];
        }

        $updatedList = [];
        if (!empty($excludeDocs)) {
            foreach ($docs as $key => $doc) {
                if (!in_array($doc['type'], $excludeDocs)) {
                    array_push($updatedList, $doc);
                }
            }
        } else {
            $updatedList = $docs;
        }
        $notOwned = \App\Models\NotOwnDocuments::where('client_id', $client_id)->select('document_type')->get();
        $notOwned = !empty($notOwned) ? array_column($notOwned->toArray(), 'document_type') : [];
        if ($requested_doc_available) {
            $updatedList[] = ['tutorial_video' => $mainVideo, 'is_attorney_doc' => 0, 'using_common_video' => true, 'company_label' => '', 'document_enable_reupload' => '', 'document_status' => '', 'document_decline_reason' => '', 'sample_img' => '', 'type' => 'requested_documents', 'title' => 'Requested Documents', "ocr_needed" => false, "is_uploaded" => false, 'category' => 2];
        }



        $debtorList = [];

        foreach ($updatedList as $item) {
            if (in_array($item['type'], ['Debtor_Pay_Stubs', 'Drivers_License', 'Social_Security_Card', 'Debtor_Creditor_Report'])) {
                $debtorList[] = $item;
            }
        }
        $securedLoans = [];
        $documentlisttoexlude = $mortgageUpdatedNames;
        $documentlisttoexlude1 = array_merge($documentlisttoexlude, $vehicleUpdatedNames);
        $documentlisttoexlude2 = array_merge($documentlisttoexlude1, []);

        foreach ($updatedList as $item) {
            if (in_array($item['type'], array_keys($documentlisttoexlude2))) {
                $securedLoans[] = $item;
            }
        }

        $spouseDocArray = ['Co_Debtor_Pay_Stubs', 'Co_Debtor_Drivers_License', 'Co_Debtor_Social_Security_Card', 'Co_Debtor_Creditor_Report'];
        $codebtorDocs = [];
        foreach ($updatedList as $item) {
            if (in_array($item['type'], $spouseDocArray)) {
                $codebtorDocs[] = $item;
            }
        }

        $attorneydocuments = array_merge($attorneydocuments, ['Miscellaneous_Documents' => 'Additional or Unlisted Documents']);
        $docs = $this->addAttorneyDocumentToList($docs, $attorneydocuments, $documentuploaded, $list, '', $videos);
        $attorneyDocs = [];
        foreach ($docs as $item) {
            if (in_array($item['type'], array_keys($attorneydocuments))) {
                $attorneyDocs[] = $item;
            }
        }


        $coDebHeading = $spousename . " Document List";
        if ($client->client_type == 2) {
            $coDebHeading = "Non-Filing Spouse Pay Stubs";
        }

        $documentlisttoexlude = ['Last_Year_Tax_Returns', 'Prior_Year_Tax_Returns', 'Prior_Year_Two_Tax_Returns', 'Prior_Year_Three_Tax_Returns', 'W2_Last_Year', 'W2_Year_Before'];
        $taxReturnDocs = [];
        foreach ($updatedList as $item) {
            if (in_array($item['type'], $documentlisttoexlude)) {
                $taxReturnDocs[] = $item;
            }
        }


        $categoriesBasedList = [];
        $categoriesBasedList[] = ['category_heading' => $debtorname . " Document List", 'sub_heading' => '', 'list' => $debtorList];
        if (!empty($codebtorDocs)) {
            $categoriesBasedList[] = ['category_heading' => $coDebHeading, 'sub_heading' => '', 'list' => $codebtorDocs]; // Also fixed $debtorList to $codebtorDocs here
        }

        if (!empty($securedLoans)) {
            $categoriesBasedList[] = ['category_heading' => 'Secured Loan Documents', 'sub_heading' => '', 'list' => $securedLoans];
        }

        if (!empty($attorneyDocs)) {
            $categoriesBasedList[] = ['category_heading' => 'Additional Attorney Docs', 'sub_heading' => '', 'list' => $attorneyDocs];
        }

        if (!empty($taxReturnDocs)) {
            $categoriesBasedList[] = ['category_heading' => 'Tax Returns', 'sub_heading' => 'You must upload Copies of your Federal (IRS) AND State Filed Tax Returns', 'list' => $taxReturnDocs];
        }

        if (!empty($requestedDocList)) {
            $categoriesBasedList[] = ['category_heading' => 'Requested Documents', 'sub_heading' => '', 'list' => $requestedDocList];
        }

        $dots = ['documents' => ['category_based_list' => $categoriesBasedList, 'title' => 'Document List', 'sign_document' => $signdocObject, 'not_own_document_types' => $notOwned, 'requestedDocList' => $requestedDocList, 'requested_doc_available' => $requested_doc_available,'list' => $updatedList,'auto_loan_companies' => ClientService::getAutoloanCompanies(),'mortgage_loan_companies' => ClientService::getMortgagesCompanies(), 'document_video' => $mainVideo,'auto_loan_types' => Helper::getVehicleForAppSelection(), 'bank_statement_months' => $arrayDocs,'debtorPayCheckData' => $debtorPayCheckData,'codebtorPayCheckData' => $codebtorPayCheckData]];

        return response()->json(Helper::renderApiSuccess('Document list', ['data' => $dots]), 200);
    }

    public function mark_not_owned(Request $request)
    {
        $client_id = Auth::id();
        $input = $request->all();
        $document_type = $input['document_type'];

        if (!\App\Models\NotOwnDocuments::where([
            'client_id' => $client_id,
            'document_type' => $document_type
        ])->exists()) {
            \App\Models\User::mark_doc_not_own($client_id, $document_type);
        } else {
            \App\Models\User::mark_doc_own($client_id, $document_type);
        }

        return response()->json(
            Helper::renderApiSuccess(
                'Document status has been updated successfully.',
                ['data' => null]
            ),
            200
        );
    }

    private static function formatPayCheckData(array $payCheckData): array
    {
        $result = [];

        foreach ($payCheckData as $emp) {
            usort(
                $emp['pay_dates'],
                fn ($a, $b) =>
                Carbon::parse($b['pay_date'])->timestamp <=> Carbon::parse($a['pay_date'])->timestamp
            );

            $dates_list = array_map(function ($date) {
                $date['pay_date'] = date('m/d/Y', strtotime($date['pay_date']));

                return $date;
            }, $emp['pay_dates']);

            $result[] = [
                'employer_name' => $emp['emp_data']['employer_name'],
                'employer_id' => $emp['emp_data']['id'],
                'employer_pay_frequency' => $emp['clientFrequency'],
                'pay_dates' => $dates_list
            ];
        }

        return $result;
    }

    /**
     * @param $documentTypeList
     * @param $documentuploaded
     * @param $list
     * @param $videos
     * @return array
     */
    private function getClientDocumentArray($documentTypeList, $documentuploaded, $list, $videos, $client_id)
    {
        $docs = [];
        $bankDocs = ClientDocuments::getClientDocumentList($client_id, 'bank');
        $venmoPaypalCashDocs = ClientDocuments::getClientDocumentList($client_id, 'venmo_paypal_cash');
        $brokerageAccountDocs = ClientDocuments::getClientDocumentList($client_id, 'brokerage_account');
        $lifeInsuDocs = ClientDocuments::getClientDocumentList($client_id, 'life_insurance');
        $retirementPensionDocs = ClientDocuments::getClientDocumentList($client_id, 'retirement_pension');

        $docsKeysByType = [
                'bankDocs' => $bankDocs,
                'venmoPaypalCashDocs' => $venmoPaypalCashDocs,
                'brokerageAccountDocs' => $brokerageAccountDocs,
                'lifeInsuDocs' => $lifeInsuDocs,
                'retirementPensionDocs' => $retirementPensionDocs,
            ];

        foreach ($documentTypeList as $key => $document) {
            if (in_array($key, ['Miscellaneous_Documents',"bank_assistant_debtor",'bank_assistant_codebtor'])) {
                continue;
            }
            $is_uploaded = $this->checkIfUploaded($key, $documentuploaded);

            $media = Helper::getDocumentImage($key);
            $data = Helper::getArrayByKey($key, $list);
            $video = $this->getDocumentTypeVideos($key, $videos, $docsKeysByType);

            $usingcommonvideo = false;
            $addCommonVideoToDocuments = ClientDocumentUploaded::getAttorneyDocuments($client_id);
            unset($addCommonVideoToDocuments[ClientDocumentUploaded::PRE_FILLING_CCC]);

            if (in_array($key, $addCommonVideoToDocuments)) {
                $mainTutorial = $videos[Helper::MAIN_DOCUMENT_TUTORIAL_VIDEO] ?? [];
                $video = [
                    'en' => $mainTutorial['english_video'] ?? '',
                    'sp' => $mainTutorial['spanish_video'] ?? '',
                    'ios_en' => $mainTutorial['iphone_english_video'] ?? '',
                    'ios_sp' => $mainTutorial['iphone_spanish_video'] ?? ''
                ];
                $usingcommonvideo = true;
            }

            $ocrNeeded = $this->ifOcrNeeded($key);
            $linktowebview = '';
            $docs[] = ['tutorial_video' => $video, 'payroll_login_link' => $linktowebview, 'is_attorney_doc' => 0, 'using_common_video' => $usingcommonvideo, 'company_label' => $this->getCompanyLabelByType($key), 'document_enable_reupload' => $data['document_enable_reupload'] ?? '', 'document_status' => $data['document_status'] ?? '', 'document_decline_reason' => $data['document_decline_reason'] ?? '', 'sample_img' => Helper::validate_key_value('sample', $media), "ocr_needed" => $ocrNeeded, 'type' => $key, 'title' => $document, "is_uploaded" => $is_uploaded, 'category' => 1];

        }

        return $docs;
    }

    private static function getloginLink($type)
    {
        $token = \App\Models\LoginToken::where(['user_id' => Auth::user()->id])->select('token')->first();
        $expiredAt = now()->addMinutes(150000);
        $link = URL::temporarySignedRoute('verify-login', $expiredAt, [
            'token' => $token->token,
            'type' => $type
        ]);

        return $link;
    }

    private function isValidDocument($key, $is_uploaded)
    {
        $isValid = false;
        if (in_array($key, array_keys(\App\Models\ClientDocumentUploaded::getResidenceKeyValue(1)))) {
            if (($key != 'Current_Mortgage_Statement_1_1') && $this->returnFlag($is_uploaded)) {
                $isValid = true;
            }
        } elseif (in_array($key, array_keys(\App\Models\ClientDocumentUploaded::getAutoloanKeyValue(1)))) {
            if (($key != 'Current_Auto_Loan_Statement_1') && $this->returnFlag($is_uploaded)) {
                $isValid = true;
            }
        }

        return $isValid;
    }

    private function addAttorneyDocumentToList($docs, $attorneydocuments, $documentuploaded, $list, $companyLabel, $videos)
    {
        $attorneydocuments = array_merge($attorneydocuments, ['Miscellaneous_Documents' => 'Additional or Unlisted Documents']);
        if (!empty($attorneydocuments)) {
            foreach ($attorneydocuments as $key => $val) {
                $is_uploaded = $this->checkIfUploaded($key, @$documentuploaded);
                $media = Helper::getDocumentImage($key);
                $sampleimg = isset($media['sample']) && !empty($media['sample']) ? $media['sample'] : '';
                $data = Helper::getArrayByKey($key, $list);
                $mainTutorial = $videos[Helper::MAIN_DOCUMENT_TUTORIAL_VIDEO] ?? [];
                $video = ['en' => $mainTutorial['english_video'] ?? '', 'sp' => $mainTutorial['spanish_video'] ?? '','ios_en' => $mainTutorial['iphone_english_video'] ?? '', 'ios_sp' => $mainTutorial['iphone_spanish_video'] ?? ''];
                $attDocType = Helper::validate_doc_type($key);
                $docs[] = ['tutorial_video' => $video,'is_attorney_doc' => 1, 'using_common_video' => true, 'company_label' => $companyLabel, 'document_enable_reupload' => $data['document_enable_reupload'] ?? '', 'document_status' => $data['document_status'] ?? '', 'document_decline_reason' => $data['document_decline_reason'] ?? '', 'sample_img' => $sampleimg, 'type' => $attDocType, 'title' => $val, "ocr_needed" => false, "is_uploaded" => $is_uploaded, 'category' => 2];
            }
        }

        return $docs;
    }

    private function returnFlag($isuploaded)
    {
        if (!$isuploaded) {
            return true;
        }
    }

    private function getDocumentTypeVideos($key, $videos, $docsKeysByType)
    {
        $video = ['en' => '', 'sp' => ''];

        $map = [
            [[ClientDocumentUploaded::DRIVING_LIC, ClientDocumentUploaded::CO_DEBTOR_DRIVING_LIC], Helper::DRIVING_LIC_TUTORIAL_VIDEO], // Drivers Lic./Gov. ID Tutorial
            [[ClientDocumentUploaded::SOCIAL_SECURITY_CARD, ClientDocumentUploaded::CO_DEBTOR_SECURITY_CARD], Helper::SSN_ITIN_TUTORIAL_VIDEO], // Social Security Card/ITIN Tutorial
            [[ClientDocumentUploaded::VEHICLE_INFORMATION], Helper::VEHICLE_INFORMATION_VIDEO], // Vehicle Information Tutorial
            [[ClientDocumentUploaded::VEHICLE_REGISTRATION], Helper::VEHICLE_REGISTRATION_VIDEO], // Vehicle Registration Tutorial
            [[ClientDocumentUploaded::INSURANCE_DOCUMENTS], Helper::VIDEO_PROOF_OF_AUTO_INSURANCE], // Proof of Auto Insurance Tutorial
            [[ClientDocumentUploaded::OTHER_MISC_DOCUMENTS], Helper::VIDEO_OTHER_MISC_DOCUMENT], // Debt(s)/Collection Statements Tutorial
            [[ClientDocumentUploaded::DEBTOR_PAY_STUB, ClientDocumentUploaded::CO_DEBTOR_PAY_STUB], Helper::PAYSTUB_TUTORIAL_VIDEO], // Paystub Tutorial
            [[ClientDocumentUploaded::DEBTOR_SOCIAL_SECURITY_ANNUAL_AWARD_LETTER, ClientDocumentUploaded::CODEBTOR_SOCIAL_SECURITY_ANNUAL_AWARD_LETTER], Helper::VIDEO_SOCIAL_SECURITY_ANNUAL_AWARD_LETTER], // Social Security Annual Award Letter Tutorial
            [[ClientDocumentUploaded::DEBTOR_VA_BENEFIT_AWARD_LETTER, ClientDocumentUploaded::CODEBTOR_VA_BENEFIT_AWARD_LETTER], Helper::VIDEO_VA_BENEFIT_AWARD_LETTER], // VA Benefit Award Letter Tutorial
            [[ClientDocumentUploaded::DEBTOR_UNEMPLOYMENT_PAYMENT_HISTORY, ClientDocumentUploaded::CODEBTOR_UNEMPLOYMENT_PAYMENT_HISTORY], Helper::VIDEO_UNEMPLOYMENT_CERTIFICATE], // Unemployment Certificate Tutorial
            [[ClientDocumentUploaded::LAST_YR_TAX_RETURNS], Helper::LAST_YEAR_TAX_RETURN_VIDEO], // Last Year Tax Returns - Tutorial
            [[ClientDocumentUploaded::PRIOR_YR_TAX_RETURNS], Helper::YEAR_BEFORE_TAX_RETURN_VIDEO], // Prior Year Tax Returns One - Tutorial
            [[ClientDocumentUploaded::PRIOR_YR_TWO_TAX_RETURNS], Helper::YEAR_BEFORE_TWO_TAX_RETURN_VIDEO], // Prior Year Tax Returns Two - Tutorial
            [[ClientDocumentUploaded::PRIOR_YR_THREE_TAX_RETURNS], Helper::YEAR_BEFORE_THREE_TAX_RETURN_VIDEO], // Prior Year Tax Returns Three - Tutorial
            [[ClientDocumentUploaded::W2_LAST_YEAR], Helper::MISC_DOCUMENT_W2_VIDEO], // W2 and or 1099 (Last Year) - Tutorial
            [[ClientDocumentUploaded::W2_YEAR_BEFORE], Helper::MISC_DOCUMENT_W2_YEAR_BEFORE_VIDEO], // W2 and or 1099 (Year Before) - Tutorial
            [[ClientDocumentUploaded::MISCELLANEOUS_DOCUMENTS], Helper::MISC_DOCUMENT_VIDEO], // Additional or Unlisted Documents Tutorial
            [[ClientDocumentUploaded::PRE_FILLING_CCC], Helper::VIDEO_PRE_FILING_CC_DOCUMENT], // Pre-Filing Bankruptcy Certificate(s) Tutorial
        ];

        foreach ($map as [$keys, $helperConst]) {
            if (in_array($key, $keys)) {
                return VideoHelper::getVideos($videos[$helperConst] ?? [], true);
            }
        }

        $groupedChecks = [
            'retirementPensionDocs' => Helper::VIDEO_RETIREMENT_DOCUMENT, // Retirement Statement Tutorial
            'bankDocs' => Helper::VIDEO_BANK_ACCOUNT_DOCUMENT, // Bank Statements Tutorial
            'venmoPaypalCashDocs' => Helper::VIDEO_PAYPAL_CASH_VENMO_ACCOUNT_DOCUMENT, // PayPal, Cash App, Venmo Account Statements Tutorial
            'brokerageAccountDocs' => Helper::VIDEO_BROKERAGE_ACCOUNT_DOCUMENT, // Brokerage Account Statements Tutorial
            'lifeInsuDocs' => Helper::VIDEO_LIFE_INSURANCE_DOCUMENT, // Life Insurance Tutorial
        ];

        foreach ($groupedChecks as $group => $helperConst) {
            if (array_key_exists($key, $docsKeysByType[$group] ?? [])) {
                return VideoHelper::getVideos($videos[$helperConst] ?? [], true);
            }
        }

        // Mortgage loan Tutorial
        if (str_starts_with($key, 'Current_Mortgage_Statement')) {
            return VideoHelper::getVideos($videos[Helper::MORTGAGE_LOAN_TUTORIAL_VIDEO] ?? [], true);
        }
        // Auto loan Tutorial
        if (str_starts_with($key, 'Current_Auto_Loan_Statement') || str_starts_with($key, 'Other_Loan_Statement')) {
            return VideoHelper::getVideos($videos[Helper::AUTO_LOAN_TUTORIAL_VIDEO] ?? [], true);
        }
        // Pay Stubs Tutorial
        if (in_array($key, ClientDocumentUploaded::getPaystubTypes())) {
            return VideoHelper::getVideos($videos[Helper::PAYSTUB_TUTORIAL_VIDEO] ?? [], true);
        }

        return $video;
    }

    private function ifOcrNeeded($key)
    {
        $ocrNeeded = true;
        if (in_array($key, [\App\Models\ClientDocumentUploaded::DEBTOR_PAY_STUB, \App\Models\ClientDocumentUploaded::CO_DEBTOR_PAY_STUB,'bank_assistant_debtor','bank_assistant_codebtor'])) {
            $ocrNeeded = false;
        }

        return $ocrNeeded;
    }

    private function getCompanyLabelByType($key)
    {
        $companyLabel = '';
        if (in_array($key, Helper::DEBTOR_RESIDENTARRAY)) {
            $companyLabel = 'Mortgage Company';
        }
        if (in_array($key, Helper::CODEBTOR_VEHICLEARRAY)) {
            $companyLabel = 'Auto Loan Company';
        }
        if (in_array($key, Helper::OTHERLOANARRAY)) {
            $companyLabel = 'Other Loan Company';
        }

        return $companyLabel;
    }


    public function signed_document(Request $request)
    {
        $client_id = Auth::user()->id;
        $attorney_id = self::getClientAttorneyId($client_id);
        try {
            if ($request->isMethod('post')) {
                if ($request->hasFile('document_file')) {
                    $files = $request->file('document_file');
                    foreach ($files as $file) {
                        app(ClientService::class)->updateSignedDocument($file, $client_id);
                    }
                    $client = \App\Models\User::where('id', $client_id)->first();
                    $attorney = \App\Models\User::where("id", $attorney_id)->first();
                    if (AttorneySettings::isEmailEnabled($attorney_id, 'attorney_signed_document_sent_by_client_mail')) {
                        $sendTo = ParalegalSettings::getMailSendToId($client_id, $attorney->email, !empty(Auth::user()->parent_attorney_id));
                        Mail::to($sendTo)->send(new \App\Mail\SignedDocToAttorneyMail($attorney->name, $client->name, $client_id));
                    }
                }
                if ($request->ajax()) {
                    return response()->json(Helper::renderApiSuccess('Document has been sent successfully.', ['data' => null]), 200);
                } else {
                    return redirect()->back()->with('success', 'Document has been sent successfully.');
                }
            } else {
                if ($request->ajax()) {
                    return response()->json(Helper::renderApiError('Not a valid request.', ['data' => null]), 200);
                } else {
                    abort(200, 'Not a valid request.');
                }
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(Helper::renderApiError($e->getMessage(), ['data' => null]), 200);
            } else {
                return redirect()->back()->with('error', $e->getMessage());
            }

        }
    }

    protected function getClientAttorneyId($client_id)
    {
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        $attorney_id = Auth::user()->id;
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }

        return $attorney_id;
    }

    public function update_attorney_doc_view_status(Request $request)
    {
        if ($request->isMethod('post')) {

            $input = $request->all();
            $client_id = Helper::validate_key_value('client_id', $input);
            $file_name = Helper::validate_key_value('file_name', $input);
            $stat_exists = \App\Models\AttorneyClientDocumentStats::where(["client_id" => $client_id, "file" => $file_name])->exists();

            if (!$stat_exists) {
                \App\Models\AttorneyClientDocumentStats::create([
                    'client_id' => $client_id,
                    'file' => $file_name,
                    'viewed_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $attorney_id = self::getClientAttorneyId($client_id);
                $filesArray = explode("/", $file_name);
                $fileNAme = is_array($filesArray) ? end($filesArray) : '';
                $client = \App\Models\User::where('id', $client_id)->select(['email','name'])->first();
                $attorney = \App\Models\User::where("id", $attorney_id)->select(['email','name'])->first();
                if (AttorneySettings::isEmailEnabled($attorney_id, 'attorney_signed_document_viewed_by_client_mail')) {
                    $sendTo = ParalegalSettings::getMailSendToId($client_id, $attorney->email, !empty(Auth::user()->parent_attorney_id));
                    Mail::to($sendTo)->send(new \App\Mail\SignDocViewStatEmail($client, $attorney->name, $fileNAme, $client_id));
                }
            }

        }
    }

    public function signed_document_api(Request $request)
    {
        $client_id = Auth::user()->id;
        if ($request->isMethod('post')) {
            $file = $request->file('signed_document');
            $errors = DocumentHelper::validateFile($file);
            if (!empty($errors)) {
                return response()->json(Helper::renderApiError(current($errors), ['data' => null]), 200);
            }

            app(ClientService::class)->updateSignDocument($request, $client_id);

            return response()->json(Helper::renderApiSuccess('Document has been sent successfully.', ['data' => null]), 200);

        } else {
            return response()->json(Helper::renderApiError('Not a valid request.', ['data' => null]), 200);
        }
    }

    public function getSubDocument(Request $request)
    {
        $input = $request->all();
        if (empty($input['document_type'])) {
            return response()->json(Helper::renderApiError('Document type required', ['data' => null]), 200);
        }
        $docsUploadInfo = ClientHelper::documentUploadInfo('', '', '', false, true);
        $docs = [];
        $client_id = Auth::user()->id;
        if ($input['document_type'] == 'Miscellaneous_Documents') {
            $miscDocs = Helper::getMiscDocs();
            $docs = $this->getMiscDocsArray($miscDocs, $docsUploadInfo, $client_id);
        }
        if ($input['document_type'] == 'requested_documents') {
            $clientDocs = \App\Models\ClientDocuments::getClientDocumentList($client_id, null, true);
            $requestedDocs = \App\Models\AdminClientRequestedDocuments::getRequestedDocuments($client_id);
            $requestedDocList = [];
            if (!empty($clientDocs)) {
                $requestedDocList = array_merge($requestedDocList, $clientDocs);
            }
            if (!empty($requestedDocs)) {
                $requestedDocList = array_merge($requestedDocList, $requestedDocs);
            }

            $BIData = CacheBasicInfo::getBasicInformationData($client_id);
            $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
            $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

            $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
            $spousename = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
            $requestedDocList = ClientHelper::getUpdatedLabelName($debtorname, $spousename, $requestedDocList, true);

            $docs = $this->getMiscDocsArray($requestedDocList, $docsUploadInfo, $client_id);
        }
        $dots = ['documents' => ['title' => 'Document List', 'list' => $docs]];

        return response()->json(Helper::renderApiSuccess('Document list', ['data' => $dots]), 200);
    }

    private function getMiscDocsArray($miscDocs, $docsUploadInfo, $client_id)
    {
        $documentuploaded = @$docsUploadInfo['documentuploaded'];
        $list = $docsUploadInfo['list'];
        $docs = [];

        $bankDocs = ClientDocuments::getClientDocumentList($client_id, 'bank');
        $venmoPaypalCashDocs = ClientDocuments::getClientDocumentList($client_id, 'venmo_paypal_cash');
        $brokerageAccountDocs = ClientDocuments::getClientDocumentList($client_id, 'brokerage_account');
        $lifeInsuDocs = ClientDocuments::getClientDocumentList($client_id, 'life_insurance');
        $retirementPensionDocs = ClientDocuments::getClientDocumentList($client_id, 'retirement_pension');

        $docsKeysByType = [
                'bankDocs' => $bankDocs,
                'venmoPaypalCashDocs' => $venmoPaypalCashDocs,
                'brokerageAccountDocs' => $brokerageAccountDocs,
                'lifeInsuDocs' => $lifeInsuDocs,
                'retirementPensionDocs' => $retirementPensionDocs,
            ];
        $videos = VideoHelper::getAdminVideos();

        foreach ($miscDocs as $key => $document) {
            $is_uploaded = false;
            if (in_array($key, @$documentuploaded)) {
                $is_uploaded = true;
            }

            $video = $this->getDocumentTypeVideos($key, $videos, $docsKeysByType);

            $data = Helper::getArrayByKey($key, $list);
            $media = Helper::getDocumentImage($key);
            $sampleimg = isset($media['sample']) && !empty($media['sample']) ? $media['sample'] : '';
            $docs[] = [
                'type' => $key,
                'document_enable_reupload' => $data['document_enable_reupload'] ?? '',
                'document_status' => $data['document_status'] ?? '',
                'document_decline_reason' => $data['document_decline_reason'] ?? '',
                'tutorial_video' => $video,
                'sample_img' => $sampleimg,
                'title' => $document,
                'ocr_needed' => false,
                "is_uploaded" => $is_uploaded,
                'category' => 2
            ];
        }

        return $docs;
    }

    private function documentValidation($input)
    {
        if (empty($input['document_type'])) {
            abort(200, 'Document type required.');
        }
        if (isset($input['date_of_birth'])) {
            if (false == DateTimeHelper::validateDateFormat($input['date_of_birth'])) {
                abort(200, 'Invalid date format, please try input MM/DD/YYYY.');
            }
        }
        if (isset($input['license_expiry_date'])) {
            if (false == DateTimeHelper::validateDateFormat($input['license_expiry_date'])) {
                abort(200, 'Invalid date format, please try input MM/DD/YYYY.');
            }
        }
    }
    private function updateDriverDoc($request, $client_id, $documentType)
    {
        $input = $request->all();
        if ($request->hasFile('front_image') && $request->file('front_image')->getSize() > 0) {
            $this->uploadDocument($request, $client_id, $documentType);
        } else {
            abort(200, 'Document is required.');
        }

        $json = json_encode($input);
        $data = [
            'client_type' => Auth::user()->client_type,
            'document_type' => $documentType,
            'client_id' => Auth::user()->id
        ];
        \App\Models\UploadedOcrData::updateOrCreate($data, [
            'data' => $json,
            'is_imported' => 0
        ]);
    }

    private function updateCoDriverDoc($request, $client_id, $documentType)
    {
        $input = $request->all();
        if ($request->hasFile('front_image') && $request->file('front_image')->getSize() > 0) {
            $this->uploadDocument($request, $client_id, $documentType);
        } else {
            abort(200, 'Document is required.');
        }
        $json = json_encode($input);
        $data = [
            'client_type' => Auth::user()->client_type,
            'document_type' => $documentType,
            'client_id' => Auth::user()->id
        ];
        \App\Models\UploadedOcrData::updateOrCreate($data, [
            'data' => $json,
            'is_imported' => 0
        ]);
    }

    public function updateVehicleDoc($request, $client_id)
    {
        $input = $request->all();
        $vehicle_type = $input['vehicle_type'] ?? '';
        $vehicleTypes = Helper::getVehicle();
        if ($vehicle_type == '' || !in_array($vehicle_type, array_keys($vehicleTypes))) {
            abort(200, 'Please select auto loan statement.');
        }
        $vinNumber = $input['vinNumber'] ?? '';
        if (empty($vinNumber)) {
            abort(200, 'Invalid Vin Number.');
        }
        $vinResponse = ClientHelper::vinFromCarmd($vinNumber);
        if (empty($vinResponse)) {
            abort(200, 'Vin number is not valid.');
        }
        $data = [
            'client_type' => Auth::user()->client_type,
            'document_type' => $vehicle_type,
            'client_id' => $client_id
        ];
        \App\Models\UploadedOcrData::updateOrCreate($data, [
            'vin_data' => json_encode($vinResponse),
            'vin_number' => $vinNumber,
            'is_imported' => 0
        ]);
        $upload_documets = [
            'client_id' => $client_id,
            'document_type' => $vehicle_type,
            'document_file' => $vinNumber,
            'mime_type' => ''
        ];
        \App\Models\ClientDocumentUploaded::create($upload_documets);
    }

    private function updateOtherDoc($request, $client_id, $documentType)
    {
        if (empty($documentType) || $documentType == 'undefined') {
            abort(200, 'Document Type is required.');
        }
        $input = $request->all();
        $file = $request->file('image');
        $errors = DocumentHelper::validateFile($file);
        if (!empty($errors)) {
            abort(200, current($errors));
        }
        $extension_from_mime_type = DocumentHelper::getExtensionFromMimeType($file->getMimeType());
        $extension = !empty($file->getClientOriginalExtension()) ? $file->getClientOriginalExtension() : $extension_from_mime_type;

        $newName = $request->document_name ?? '';
        $document_month = $request->document_month ?? null;
        $document_paystub_date = $request->document_paystub_date ?? null;
        $employer_id = $request->employer_id ?? null;
        $document_paystub_date_toname = '';
        if (!empty($document_paystub_date)) {
            $document_paystub_date_toname = str_replace('/', '.', $document_paystub_date);
        }

        if (in_array($request->document_type, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])) {
            if (!preg_match('/^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}$/', $document_paystub_date)) {
                abort(200, 'Pay date must be in MM/DD/YYYY format.');
            }
            Log::info('Client id'.$client_id.' sending employer id : ' . $employer_id);
            if (empty($employer_id)) {
                abort(200, 'Employer is required.');
            }
        }

        if (in_array($request->document_type, ['Last_Year_Tax_Returns','Prior_Year_Tax_Returns','Prior_Year_Two_Tax_Returns','Prior_Year_Three_Tax_Returns'])) {
            $data = \App\Models\ClientDocumentUploaded::updatePreviousTaxFilesNames($request->document_type, $client_id, '', true);
            $docNo = Helper::validate_key_value('docNo', $data);
            $year = Helper::validate_key_value('year', $data);
            $nameToBeUpdated = Helper::validate_doc_type($year . ' Tax Page ' . $docNo);

            // Create a new instance of UploadedFile with the updated original name
            $file = new UploadedFile(
                $file->getPathname(), // The file's full path
                $nameToBeUpdated, // The new original name
                $file->getMimeType(), // The file's MIME type
                $file->getError(), // The file's error code
                true // Whether the file was uploaded via HTTP POST (defaults to true)
            );
        }


        $bankDocsArray = \App\Models\ClientDocuments::getAllBankDocumentKeysList($client_id);

        if (in_array($request->document_type, $bankDocsArray) && isset($request->document_month) && !empty($request->document_month)) {
            $file = \App\Models\ClientDocumentUploaded::updateBankFilesNamesForSingleUpload($request->all(), $client_id);
        }

        $docId = \App\Models\ClientDocumentUploaded::storeClientSideDocument($client_id, $file, $documentType, $newName, 0, 0, $extension, false, $document_month, $document_paystub_date_toname);
        if (is_array(($docId)) && isset($docId['status']) && $docId['status'] == false) {
            abort(200, $docId['message']);
        }
        if (in_array($request->document_type, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']) && $employer_id > 0) {
            $input['client_id'] = $client_id;
            $input['paystub_date'] = [$document_paystub_date];
            \App\Models\PayStubs::dummyPaystubEntry($input, $docId);
        }
        $this->miscdocUpload($documentType);
    }



    private function miscdocUpload($documentType)
    {
        $client_id = Auth::user()->id;

        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        $attorneyId = Helper::validate_key_value('attorney_id', $attorney ? $attorney->toArray() : []);

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $settingsAttorneyId = $ClientsAssociateId ?: $attorneyId;
        $is_associate = $ClientsAssociateId ? 1 : 0;

        $attorneyUser = AttorneySettings::where([
            'attorney_id' => $settingsAttorneyId,
            'is_associate' => $is_associate
        ])->select('tax_return_day_month')->first();
        $taxDay = Helper::validate_key_value('tax_return_day_month', $attorneyUser ? $attorneyUser->toArray() : []);

        $taxesdoc = \App\Models\ClientDocumentUploaded::getMiscDocsForAttorneyDocumentScreen($attorneyId);

        $year = '';
        $label = '';

        switch ($documentType) {
            case \App\Models\ClientDocumentUploaded::W2_LAST_YEAR:
                $year = date("Y", strtotime("-1 year"));
                break;
            case \App\Models\ClientDocumentUploaded::W2_YEAR_BEFORE:
                $year = date("Y", strtotime("-2 year"));
                break;
            case \App\Models\ClientDocumentUploaded::LAST_YR_TAX_RETURNS:
            case \App\Models\ClientDocumentUploaded::PRIOR_YR_TAX_RETURNS:
                $year = DateTimeHelper::getYearForTaxReturn($documentType, $taxDay);
                break;
        }

        if (!empty($year) && isset($taxesdoc[$documentType])) {
            $label = $taxesdoc[$documentType];
            $miscdata = ['type' => $label, 'year' => $year];
            $json = json_encode($miscdata);
            $data = [
                'client_type' => Auth::user()->client_type,
                'document_type' => $documentType,
                'client_id' => $client_id
            ];
            \App\Models\UploadedOcrData::updateOrCreate($data, [
                'data' => $json,
                'is_imported' => 0
            ]);
        }
    }


    public function updateDocument(Request $request)
    {
        try {

            $client_id = Auth::user()->id;
            $input = $request->all();
            $this->documentValidation($input);
            $documentType = $input['document_type'];
            Log::info('Uploading app side document for type : ' . $documentType);

            switch ($documentType) {
                case \App\Models\ClientDocumentUploaded::DRIVING_LIC:
                    $this->updateDriverDoc($request, $client_id, $documentType);
                    break;
                case \App\Models\ClientDocumentUploaded::CO_DEBTOR_DRIVING_LIC:
                    $this->updateCoDriverDoc($request, $client_id, $documentType);
                    break;
                case \App\Models\ClientDocumentUploaded::VEHICLE_INFORMATION:
                    $this->updateVehicleDoc($request, $client_id);
                    break;
                default:
                    $this->updateOtherDoc($request, $client_id, $documentType);
                    break;
            }

            \App\Models\NotOwnDocuments::where(['client_id' => $client_id, 'document_type' => $documentType])->delete();

            return response()->json(Helper::renderApiSuccess('Document has been successfully uploaded!', ['data' => null]), 200);

        } catch (\Exception $e) {
            return response()->json(
                Helper::renderApiError(
                    $e->getMessage(),
                    ['data' => null]
                ),
                200
            );
        }
    }

    private function uploadDocument($request, $client_id, $documentType)
    {
        if (empty($documentType) || $documentType == 'undefined') {
            return response()->json(Helper::renderJsonError("Document Type is required."))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $file = $request->file('front_image');
        $allowedfileExtension = ArrayHelper::getAllowedFileExtensionArray();
        $mime_type = $file->getMimeType();
        $parts = explode('/', $mime_type);
        $extension_from_mime_type = '';
        if (count($parts) === 2) {
            $extension_from_mime_type = $parts[1];
        }
        $extension = !empty($file->getClientOriginalExtension()) ? $file->getClientOriginalExtension() : $extension_from_mime_type;
        if (!in_array(strtolower($extension), $allowedfileExtension)) {
            return response()->json(Helper::renderJsonError("Uploaded document extension is not valid."))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($file->getSize() == 0) {
            return response()->json(Helper::renderJsonError('Uploaded document size is 0 bytes, please check and upload again.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $docId = \App\Models\ClientDocumentUploaded::storeClientSideDocument($client_id, $file, $documentType, '', 0, 0, $extension);
        if (is_array(($docId)) && isset($docId['status']) && $docId['status'] == false) {
            return response()->json(Helper::renderJsonError($docId['message']))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    /**
     * @param $client_id
     * @param $documentType
     * @param $basic
     * @param $licenseNumberKey
     * @return array
     */
    private function getDrivingDoc($client_id, $documentType, $basic, $licenseNumberKey): array
    {
        $drivingDocumentUploaded = $this->getDocumentUploaded($client_id, $documentType);
        $dateOfBirth = !empty($basic['date_of_birth']) ? Helper::dateOfBirthWithSlashFormat($basic['date_of_birth']) : '';
        $result = [];
        foreach ($drivingDocumentUploaded as $doc) {
            $path = !empty($doc) ? asset($doc['document_file']) : '';
            if ($doc['is_uploaded_to_s3'] == 1) {
                $path = Storage::disk('s3')->temporaryUrl($doc['document_file'], now()->addDays(2));
            }

            $result[] = [
                'id' => $doc['id'] ?? '',
                "front_image" => $path,
                "first_name" => $basic['name'] ?? '',
                "middle_name" => $basic['middle_name'] ?? '',
                "last_name" => $basic['last_name'] ?? '',
                "date_of_birth" => $dateOfBirth,
                "license_expiry_date" => $basic['license_expiry_date'] ?? '',
                "city" => $basic['City'] ?? '',
                "state" => $basic['state'] ?? '',
                "address" => $basic['Address'] ?? '',
                "zip" => $basic['zip'] ?? '',
                "license_number" => $basic[$licenseNumberKey] ?? ''
            ];
        }

        return $result;
    }

    /**
     * @param $client_id
     * @param $documentType
     * @return array
     */
    private function getVehicleDoc($client_id, $documentType): array
    {
        $documentUploaded = $this->getDocumentUploaded($client_id, $documentType);
        $result = [];
        foreach ($documentUploaded as $doc) {
            $result[] = [
                'id' => $doc['id'],
                "image" => null,
                "vinNumber" => $doc['document_file'],
                'document_status' => $doc['document_status'],
                'document_decline_reason' => $doc['document_decline_reason'],
                'document_enable_reupload' => $doc['document_enable_reupload']
            ];
        }

        return $result;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDocument(Request $request)
    {
        $client_id = Auth::user()->id;
        $input = $request->all();
        if (empty($input['document_type'])) {
            return response()->json(Helper::renderApiError('Document Type is required', ['data' => null]), 200);
        }
        $documentType = $input['document_type'];
        $BIData = CacheBasicInfo::getBasicInformationData($client_id);

        if ($documentType == ClientDocumentUploaded::DRIVING_LIC) {
            $info = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
            $documents = $this->getDrivingDoc($client_id, $documentType, $info, 'license_number');
        } elseif ($documentType == ClientDocumentUploaded::CO_DEBTOR_DRIVING_LIC) {
            $info = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
            $documents = $this->getDrivingDoc($client_id, $documentType, $info, 'part2_driving_license');
        } elseif ($documentType == ClientDocumentUploaded::VEHICLE_INFORMATION) {
            $documents = $this->getVehicleDoc($client_id, $documentType);
        } else {
            $documents = $this->getCommonDocumentArray($client_id, $documentType);
        }
        $docName = implode(" ", explode("_", $documentType));

        return response()->json(
            Helper::renderApiSuccess(
                $docName,
                [
                    'data' => ['documents' => $documents]
                ]
            ),
            200
        );
    }

    private function getDocumentUploaded($client_id, $documentType)
    {
        $documentUploaded = \App\Models\ClientDocumentUploaded::where("client_id", $client_id)
            ->where('document_type', $documentType)->orderby('updated_on', 'desc')->get();
        $this->checkDocumentArray($documentUploaded);

        return $documentUploaded->toArray();
    }

    private function checkDocumentArray($documentuploaded)
    {
        if (empty($documentuploaded)) {
            return response()->json(Helper::renderApiError('Document not found', ['data' => null]), 200);
        }
    }

    private function getCommonDocumentArray($client_id, $documentType)
    {
        $isSingleFile = true;
        $attorneyDocs = \App\Models\ClientDocumentUploaded::getAttorneyDocuments($client_id);
        $clientDocs = \App\Models\ClientDocuments::getClientDocs($client_id);

        $flattenedArray = [];
        if (!empty($clientDocs)) {
            foreach ($clientDocs as $category) {
                foreach ($category as $key => $value) {
                    $flattenedArray[$key] = $value;
                }
            }
        }

        if (in_array($documentType, \App\Models\ClientDocumentUploaded::MULTIPLE_DOC_ALLOWED_FOR) || in_array($documentType, array_keys($attorneyDocs)) || in_array($documentType, array_keys($flattenedArray))) {
            $isSingleFile = false;
            $documentUploaded = $this->getDocumentUploaded($client_id, $documentType);
        } else {
            $documentUploaded = \App\Models\ClientDocumentUploaded::where("client_id", $client_id)
                ->where('document_type', $documentType)
                ->orderby('updated_on', 'desc')->first();
            $documentUploaded = !empty($documentUploaded) ? $documentUploaded : [];
        }
        $this->checkDocumentArray($documentUploaded);

        return $this->setCommonResposneForList($documentUploaded, $isSingleFile);
    }

    private function setCommonResposneForList($documentuploaded, $onedocOnly = false)
    {
        $res = [];
        $path = "";

        if (!empty($documentuploaded)) {
            if (!$onedocOnly) {
                foreach ($documentuploaded as $doc) {
                    $path = !empty($doc) ? asset($doc['document_file']) : '';
                    if (!empty($doc) && $doc['is_uploaded_to_s3'] == 1) {
                        $path = Storage::disk('s3')->temporaryUrl($doc['document_file'], now()->addDays(2));
                    }

                    $pay_date = $doc['document_paystub_date'];
                    $display_date = $pay_date;
                    $dates = explode(".", $pay_date);
                    if (!empty($pay_date) && isset($dates[0]) && isset($dates[1]) && isset($dates[2])) {
                        $month = $dates[0];
                        $day = $dates[1];
                        $year = $dates[2];
                        $pay_date = $month.'/'. $day.'/'.$year;
                        $display_date = date('M d, Y', strtotime($year.'-'. $month.'-'.$day));
                    }
                    $res[] = ['id' => $doc['id'], "image" => $path, 'document_status' => $doc['document_status'], 'document_decline_reason' => $doc['document_decline_reason'], 'document_enable_reupload' => $doc['document_enable_reupload'], 'pay_date' => $pay_date, 'display_date' => $display_date];
                }
            } else {
                $doc = $documentuploaded;
                $path = !empty($doc) ? asset($doc['document_file']) : '';
                if (!empty($doc) && $doc['is_uploaded_to_s3'] == 1) {
                    $path = Storage::disk('s3')->temporaryUrl($doc['document_file'], now()->addDays(2));
                }

                $pay_date = $doc['document_paystub_date'];
                $dates = explode(".", $pay_date);
                $display_date = $pay_date;
                if (!empty($pay_date) && isset($dates[0]) && isset($dates[1]) && isset($dates[2])) {
                    $month = $dates[0];
                    $day = $dates[1];
                    $year = $dates[2];
                    $display_date = date('M d, Y', strtotime($year.'-'. $month.'-'.$day));
                    $pay_date = $month.'/'. $day.'/'.$year;

                }
                $res[] = ['id' => $doc['id'], "image" => $path, 'document_status' => $doc['document_status'], 'document_decline_reason' => $doc['document_decline_reason'], 'document_enable_reupload' => $doc['document_enable_reupload'], 'pay_date' => $pay_date, 'display_date' => $display_date];
            }
        }

        return $res;
    }

    public function deleteDocument(Request $request)
    {
        $input = $request->all();
        $client_id = Auth::user()->id;
        $documentType = Helper::validate_key_value('document_type', $input);
        $recordId = Helper::validate_key_value('id', $input);
        if (empty($documentType)) {
            return response()->json(Helper::renderApiError('Document Type is required', ['data' => null]), 200);
        }
        if (empty($recordId)) {
            return response()->json(Helper::renderApiError('Record Id is required', ['data' => null]), 200);
        }
        if ($documentType == \App\Models\ClientDocumentUploaded::DRIVING_LIC) {
            $documentuploaded = \App\Models\ClientDocumentUploaded::where("client_id", $client_id)->where('document_type', $documentType)->where('id', $recordId)->first();
            if (empty($documentuploaded)) {
                return response()->json(Helper::renderApiError('Document not found', ['data' => null]), 200);
            }
            $documentuploaded = $documentuploaded->toArray();
            /** Unlink front image */
            if (Storage::disk('s3')->exists($documentuploaded['document_file'])) {
                Storage::disk('s3')->delete($documentuploaded['document_file']);
            }
            /** Delete record from table */
            \App\Models\ClientDocumentUploaded::where('id', $recordId)->delete();
        } else {
            $documentuploaded = \App\Models\ClientDocumentUploaded::where("client_id", $client_id)->where('document_type', $documentType)->where('id', $recordId)->first();
            if (empty($documentuploaded)) {
                return response()->json(Helper::renderApiError('Document not found', ['data' => null]), 200);
            }
            if (Storage::disk('s3')->exists($documentuploaded['document_file'])) {
                if ($documentType != 'Vehicle_Information') {
                    Storage::disk('s3')->delete($documentuploaded['document_file']);
                }
            }

            if (in_array($documentType, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])) {
                \App\Models\PayStubs::where(['document_id' => $recordId, 'client_id' => $client_id])->delete();
            }
            \App\Models\ClientDocumentUploaded::where('id', $recordId)->delete();
            $subject = "Document Deleted By ".Auth::user()->name;
            $note = "Document ".$documentType.' '.$documentuploaded['updated_name'].' is deleted via mobile app by client '.Auth::user()->name;
            \App\Models\ConciergeServiceNotes::create(['client_id' => $client_id, 'subject' => $subject,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"),'note' => $note,'added_by_id' => 1]);
        }
        \App\Models\UploadedOcrData::where(['client_id' => $client_id, 'document_type' => $documentType])->delete();

        return response()->json(Helper::renderApiSuccess('Document deleted successfully', ['data' => null]), 200);
    }

    public function client_doc_see($type, $client_id)
    {
        $docData = \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id, 'document_type' => $type])->get();

        $docDataArray = $docData->toArray();

        if (empty($docDataArray)) {
            return redirect()->back()->with('error', 'Document not uploaded yet.');
        }

        if (count($docDataArray) === 1) {
            return $this->downloadSingleFile($docDataArray[0]);
        }

        return $this->downloadZipFile($client_id, $docDataArray);
    }

    public function downloadSingleFile($docData)
    {
        $paths = basename($docData['document_file']);
        $fname = explode('.', $paths);
        $updatedName = !empty($docData["updated_name"]) ? rtrim($docData["updated_name"], '.') : $paths;
        $ext = array_pop($fname);
        $filename = $updatedName . '.' . $ext;

        if ($docData["is_uploaded_to_s3"] == 1) {
            if (!Storage::disk('s3')->exists($docData['document_file'])) {
                return redirect()->back()->with('error', 'File does not exists.');
            }

            return redirect(Storage::disk('s3')->temporaryUrl(
                $docData['document_file'],
                now()->addDays(2),
                ['ResponseContentDisposition' => 'attachment;filename=' . rawurlencode($filename)]
            ));
        }

        if ($docData["is_uploaded_to_s3"] == 0) {
            if (!File::exists(public_path() . '/' . $docData['document_file'])) {
                return redirect()->back()->with('error', 'File does not exists.');
            }

            return DocumentHelper::generatePDFFile($filename, $docData['document_file']);
        }
    }

    public function downloadZipFile($client_id, $docDataArray)
    {
        $filePath = app(\App\Models\DoctoZipFileScheduler::class)->getZipFileforClient($client_id, $docDataArray, true);
        $clientDir = base_path("public/documents/". $client_id);
        //shell_exec('chmod -R 777 '.$clientDir);
        if (isset($filePath) && !empty($filePath)) {
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File does not exists.');
            }
            $filename = 'Client_Document_Uploads.zip';
            DocumentHelper::generateZipFile($filename, $filePath);
            DocumentHelper::flushS3Temp($client_id);
        }
    }

    public static function getFormatedMortgageUpdatedNames($mortgageUpdatedNames)
    {
        $primary = [];
        $nonPrimary = [];

        foreach ($mortgageUpdatedNames as $key => $value) {
            if (strpos($key, 'Current_Mortgage_Statement_') === 0) {
                if (strpos($value, 'Primary Residence ') === 0) {
                    $primary[$key] = $value;
                } elseif (strpos($value, 'Non-Primary Residence ') === 0) {
                    $nonPrimary[$key] = $value;
                }
            }
        }

        return $primary + $nonPrimary;
    }

}
