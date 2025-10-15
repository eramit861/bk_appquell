<?php

namespace App\Http\Controllers\Attorney;

use App\Helpers\ArrayHelper;
use App\Helpers\ClientHelper;
use App\Helpers\DateTimeHelper;
use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use App\Models\AttorneyDocuments;
use App\Models\AttorneyEmployerInformationToClient;
use App\Models\AttorneySettings;
use App\Models\ClientDocumentUploaded;
use App\Models\ClientsAssociate;
use App\Models\User;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheIncome;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentChecklistController extends AttorneyController
{
    public function index($client_id)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();

        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }

        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))
                ->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $user = User::find($client_id);

        $debtorLabel = "Debtor";
        $spouseLabel = "Co-Debtor";
        if ($user->client_type == 2) {
            $spouseLabel = "Non-Filing Spouse";
        }

        $BasicInfoPartA = $user->getBasicInfo(true);
        $BasicInfoPartB = $user->getBasicInfoPartB(true);

        $debtorname = Helper::validate_key_value('name', $BasicInfoPartA) . " " .
            Helper::validate_key_value('middle_name', $BasicInfoPartA) . " " .
            Helper::validate_key_value('last_name', $BasicInfoPartA);

        $spousename = Helper::validate_key_value('name', $BasicInfoPartB) . " " .
            Helper::validate_key_value('middle_name', $BasicInfoPartB) . " " .
            Helper::validate_key_value('last_name', $BasicInfoPartB);

        $documentTypes = [
                ClientDocumentUploaded::DRIVING_LIC,
                ClientDocumentUploaded::CO_DEBTOR_DRIVING_LIC,
                ClientDocumentUploaded::SOCIAL_SECURITY_CARD,
                ClientDocumentUploaded::CO_DEBTOR_SECURITY_CARD,
        ];


        $uploadedDocs = ClientDocumentUploaded::where('client_id', $client_id)->where(function ($query) {
            $query->orWhere('document_status', 1)
                ->orWhere('added_by_attorney', 1);
        });
        $debtorLicense = (clone $uploadedDocs)->whereIn('document_type', [
                ClientDocumentUploaded::DRIVING_LIC,
                ClientDocumentUploaded::SOCIAL_SECURITY_CARD,
            ])->groupBy('id')->get();

        $coDebtorLicense = (clone $uploadedDocs)->whereIn('document_type', [
                ClientDocumentUploaded::CO_DEBTOR_DRIVING_LIC,
                ClientDocumentUploaded::CO_DEBTOR_SECURITY_CARD,
            ])->groupBy('id')->get();

        $debtorCreditReport = (clone $uploadedDocs)->whereIn('document_type', [
                'Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report'
            ])->groupBy('id')->get();

        $debtorLicense = count($debtorLicense) == 2 ? 'checked' : '';
        $coDebtorLicense = count($coDebtorLicense) == 2 ? 'checked' : '';
        $debtorCreditReport = $debtorCreditReport ? 'checked' : '';

        $propertyResident = $user->getPropertyResident(true)->toArray();
        $propertyVehicle = $user->getPropertyVehicle(true)->toArray();
        $propertyVehicle = self::getPropertyVehicleAcceptedStatus($propertyVehicle, $uploadedDocs);

        $propertyFAData = $user->getPropertyFinancialAssets(true, ['bank', 'venmo_paypal_cash', 'brokerage_account']);
        $propertyFAData = (isset($propertyFAData) && !empty($propertyFAData)) ? $propertyFAData->toArray() : [];

        $propertyRPData = $user->getPropertyFinancialAssets(true, ['retirement_pension']);
        $propertyRPData = (isset($propertyRPData) && !empty($propertyRPData)) ? $propertyRPData->toArray() : [];

        $propertyLIData = $user->getPropertyFinancialAssets(true, ['life_insurance']);
        $propertyLIData = (isset($propertyLIData) && !empty($propertyLIData)) ? $propertyLIData->toArray() : [];

        $reviwedData = \App\Models\ClientQuestionnaireReview::where('client_id', $client_id);

        $propertyReviwed = (clone $reviwedData)->where('reviewed_for', 'property')->first();
        $propertyReviwed = !empty($propertyReviwed) ? $propertyReviwed->toArray() : [];
        $propertyReviwed = !empty($propertyReviwed) ? $propertyReviwed['reviewed_status'] : 0;

        $debtReviwed = (clone $reviwedData)->where('reviewed_for', 'debt')->first();
        $debtReviwed = !empty($debtReviwed) ? $debtReviwed->toArray() : [];
        $debtReviwed = !empty($debtReviwed) ? $debtReviwed['reviewed_status'] : 0;

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

        $attorneySettings = AttorneySettings::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->select(['bank_statement_months', 'attorney_enabled_bank_statment'])->first();
        $bankStatementMonths = !empty($attorneySettings) ? Helper::validate_key_value('bank_statement_months', $attorneySettings) : '';
        $uploadedDocs = ClientDocumentUploaded::where('client_id', $client_id);
        $bankAccounts = self::getBankAccountsData($propertyFAData, $uploadedDocs, $bankStatementMonths);


        $retirementAccounts = self::getRetirementPensionData($propertyRPData, $uploadedDocs);
        $lifeInsuranceAccounts = self::getLifeInsuranceData($propertyLIData, $uploadedDocs);

        $debtstax = CacheDebt::getDebtData($client_id);
        $domesticSupport = Helper::validate_key_value('domestic_support', $debtstax, 'radio');

        $attorney_id = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);

        $debtorEmployer = AttorneyEmployerInformationToClient::where(['attorney_id' => $attorney_id, 'client_id' => $client_id, 'client_type' => 1])->pluck('employer_name')->all();
        $spouseEmployer = AttorneyEmployerInformationToClient::where(['attorney_id' => $attorney_id, 'client_id' => $client_id, 'client_type' => 2])->pluck('employer_name')->all();
        $debtorEmployer = self::getEmployerWithMonths($debtorEmployer);
        $spouseEmployer = self::getEmployerWithMonths($spouseEmployer);

        $incomeData = CacheIncome::getIncomeData($client_id);
        $debtorIncomeTabData = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');
        $debtorBussinessIncome = Helper::validate_key_value('operation_business', $debtorIncomeTabData, 'radio') == 1 ? "Yes" : "NA";
        $spouseIncomeTabData = Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');
        $spouseBussinessIncome = Helper::validate_key_value('joints_operation_business', $spouseIncomeTabData, 'radio') == 1 ? "Yes" : "NA";

        $lastYear = date("Y", strtotime("-1 year"));
        $yearBefore = date("Y", strtotime("-2 year"));
        $uploadedDocs = ClientDocumentUploaded::where('client_id', $client_id)->where(function ($query) {
            $query->orWhere('document_status', 1)
                ->orWhere('added_by_attorney', 1);
        });
        $taxesLastYear = (clone $uploadedDocs)->whereIn('document_type', [  'Last_Year_Tax_Returns' ])->groupBy('id')->exists();
        $taxesLastYear = $taxesLastYear ? 'checked' : '';
        $taxesYearBefore = (clone $uploadedDocs)->whereIn('document_type', [  'Prior_Year_Tax_Returns' ])->groupBy('id')->exists();
        $taxesYearBefore = $taxesYearBefore ? 'checked' : '';
        $w2LastYear = (clone $uploadedDocs)->whereIn('document_type', [  'W2_Last_Year' ])->groupBy('id')->exists();
        $w2LastYear = $w2LastYear ? 'checked' : '';
        $w2YearBefore = (clone $uploadedDocs)->whereIn('document_type', [  'W2_Year_Before' ])->groupBy('id')->exists();
        $w2YearBefore = $w2YearBefore ? 'checked' : '';

        $attorneydocuments = AttorneyDocuments::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->pluck('document_name')->all();

        $isConciergeClient = (isset($user) && !empty($user)) ? $user->concierge_service : 0 ;

        $excludedSubjects = [
            'Questionnaire Sections Reviewed',
            'Questionnaire Basic Information Reviewed',
            'Questionnaire Property Reviewed',
            'Questionnaire Vehicles Reviewed',
            'Questionnaire Debts Reviewed',
            'Questionnaire Real Property Reviewed',
            'Questionnaire Property - Financial Assets 1 Reviewed',
            'Questionnaire Property - Financial Assets Continued Reviewed',
            'Questionnaire Property - Personal and Household Items Reviewed',
            'Questionnaire Property - Business-Related Assets Reviewed',
            'Questionnaire Property - Farm and Commercial Fishing-Related Reviewed',
            'Requested Documents From Client(s)'
        ];

        $notes = \App\Models\ConciergeServiceNotes::where([
                'client_id' => $client_id,
                'added_by_id' => $attorney_id
            ])
            ->whereNotIn('subject', $excludedSubjects)
            ->orderBy('id', 'asc')
            ->get();

        $notes = !empty($notes) ? $notes->toArray() : [];

        $details = [
            'debtorLabel' => $debtorLabel,
            'spouseLabel' => $spouseLabel,
            'debtorName' => $debtorname,
            'spouseName' => $spousename,
            'debtorLicense' => $debtorLicense,
            'coDebtorLicense' => $coDebtorLicense,
            'debtorCreditReport' => $debtorCreditReport,
            'propertyResident' => $propertyResident,
            'propertyVehicle' => $propertyVehicle,
            'propertyReviwed' => $propertyReviwed,
            'debtReviwed' => $debtReviwed,
            'bankAccounts' => $bankAccounts,
            'retirementAccounts' => $retirementAccounts,
            'domesticSupport' => $domesticSupport,
            'lifeInsuranceAccounts' => $lifeInsuranceAccounts,
            'debtorEmployer' => $debtorEmployer,
            'spouseEmployer' => $spouseEmployer,
            'debtorBussinessIncome' => $debtorBussinessIncome,
            'spouseBussinessIncome' => $spouseBussinessIncome,
            'lastYear' => $lastYear,
            'yearBefore' => $yearBefore,
            'taxesLastYear' => $taxesLastYear,
            'taxesYearBefore' => $taxesYearBefore,
            'w2LastYear' => $w2LastYear,
            'w2YearBefore' => $w2YearBefore,
            'attorneydocuments' => $attorneydocuments,
            'notes' => $notes,
        ];

        $pdf = PDF::loadView('attorney.client.checklist.document_checklist', compact('details'));

        return $pdf->download('document_checklist.pdf');
    }

    public static function getPropertyVehicleAcceptedStatus($propertyVehicle, $uploadedDocs)
    {

        // $clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentList($id);
        // $vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];
        // $status = (clone $uploadedDocs)->whereIn('document_type', [ 'Current_Auto_Loan_Statement_1' ])->get();

        return $propertyVehicle;
    }


    public static function getEmployerWithMonths($debtorEmployer)
    {

        $monthString = '(';
        $currentDate = date('Y-m-d');
        // Loop through the last 6 months
        for ($i = 1; $i < 7; $i++) {
            // Calculate the date for the current iteration
            $month = date('Y-m', strtotime("-$i months", strtotime($currentDate)));
            $year = date('Y', strtotime("-$i months", strtotime($currentDate)));
            $month_name = date("M", strtotime("-$i months", strtotime($currentDate)));

            $monthString .= ' '.$month_name.' '.$year.',';
        }
        $monthString .= ')';
        $monthString = str_replace(',)', ' )', $monthString);

        foreach ($debtorEmployer as $key => $name) {
            $debtorEmployer[$key] = $name. ' <small>' .$monthString. '</small>';
        }

        return $debtorEmployer;
    }

    public static function getBankAccountsData($propertyFAData, $uploadedDocs, $bankStatementMonths)
    {
        $accounts = [];

        foreach ($propertyFAData as $value) {
            $type_data = Helper::validate_key_value('type_data', $value);
            $typeData = !empty($type_data) ? json_decode($type_data, true) : [];

            $accType = Helper::validate_key_value('account_type', $typeData);
            $personal_business_account = Helper::validate_key_value('personal_business_account', $typeData);

            $description = Helper::validate_key_value('description', $typeData);
            $accNo = Helper::validate_key_value('last_4_digits', $typeData);

            if (in_array($value['type'], ['bank']) && !empty($personal_business_account)) {
                foreach ($personal_business_account as $index => $acc) {

                    $bank_statement_month_nos = ($acc == 2) ? 6 : $bankStatementMonths;
                    $docKey = str_replace(' ', '_', Helper::validate_key_value($index, $description)).'_ending_with_'.Helper::validate_key_value($index, $accNo);

                    $status = (clone $uploadedDocs)->whereIn('document_type', [ $docKey ])->get();


                    $month = self::getUploadedMonthsString($bank_statement_month_nos, $status);

                    $statusChecked = (strpos($month, 'red') !== false) ? '' : 'checked';

                    $accounts[] = [
                            'name' => Helper::validate_key_value($index, $description),
                            'no' => Helper::validate_key_value($index, $accNo),
                            'status' => $statusChecked,
                            'months' => $month,
                    ];
                }
            }



            if (in_array($value['type'], ['venmo_paypal_cash','brokerage_account']) && !empty($accType)) {
                foreach ($accType as $index => $acc) {

                    $bank_statement_month_nos = $bankStatementMonths;

                    $status = (clone $uploadedDocs)->whereIn('document_type', [ $acc ])->get();
                    $month = self::getUploadedMonthsString($bank_statement_month_nos, $status);
                    $statusChecked = (strpos($month, 'red') !== false) ? '' : 'checked';

                    $accounts[] = [
                            'name' => ArrayHelper::getAccountKeyValue($acc),
                            'no' => '',
                            'status' => $statusChecked,
                            'months' => $month,
                    ];
                }
            }


        }

        return $accounts;
    }

    public static function getUploadedMonthsString($bank_statement_month_nos, $status)
    {
        $statement_month_array = DateTimeHelper::getBankStatementShortMonthArray($bank_statement_month_nos);

        $status = (isset($status) && !empty($status)) ? $status->toArray() : [];

        $missing_months = '(';
        foreach ($statement_month_array as $month_key => $month_value) {
            $found = false;
            foreach ($status as $object) {
                if ($object['document_month'] === $month_key) {
                    $found = true;
                    $missing_months .= ' <small style="color: green;">'.$month_value.'</small>,';
                    break;
                }
            }
            if (!$found) {
                $missing_months .= ' <small style="color: red;">'.$month_value . '</small>,';
            }
        }
        $missing_months .= ')';
        $missing_months = str_replace(',)', ' )', $missing_months);

        return $missing_months;
    }

    public static function getRetirementPensionData($propertyRPData, $uploadedDocs)
    {
        $accounts = [];

        foreach ($propertyRPData as $value) {
            $type_data = Helper::validate_key_value('type_data', $value);
            $typeData = !empty($type_data) ? json_decode($type_data, true) : [];
            $accType = Helper::validate_key_value('type_of_account', $typeData);
            $description = Helper::validate_key_value('description', $typeData);

            if (in_array($value['type'], ['retirement_pension']) && !empty($accType)) {
                foreach ($accType as $index => $acc) {
                    $descriptionstring = Helper::validate_doc_type(strtolower(Helper::validate_key_value($index, $description)), true);
                    $documentType = $acc;
                    $selectString = ClientHelper::accountTypeArrayForDoc($documentType);
                    $documentName = strtolower(Helper::validate_doc_type($selectString, true).'_'.$descriptionstring.'_retirement_pension');
                    $status = (clone $uploadedDocs)->whereIn('document_type', [ $documentName ])->exists();
                    $accounts[] = [
                            'name' => Helper::validate_key_value($index, $description),
                            'status' => $status ? 'checked' : '',
                    ];
                }
            }

        }

        return $accounts;
    }

    public static function getLifeInsuranceData($propertyLIData, $uploadedDocs)
    {
        $accounts = [];

        foreach ($propertyLIData as $key => $value) {
            $type_data = Helper::validate_key_value('type_data', $value);
            $typeData = !empty($type_data) ? json_decode($type_data, true) : [];
            $accType = Helper::validate_key_value('account_type', $typeData);
            $typeOfAccount = Helper::validate_key_value('type_of_account', $typeData);

            if (in_array($value['type'], ['life_insurance']) && !empty($accType)) {
                foreach ($accType as $index => $acc) {
                    $status = '';
                    if (in_array($acc, ['Whole', 'Universal'])) {
                        $document_type = Helper::validate_key_value($index, $typeOfAccount).': Whole Life Policy';
                        $document_name = str_replace(" ", "_", $document_type);
                        $document_name = Helper::validate_doc_type($document_name, true);
                        $status = (clone $uploadedDocs)->whereIn('document_type', [ $document_name ])->exists();
                        $status = $status ? 'checked' : '';
                    }
                    $accounts[] = [
                            'name' => Helper::validate_key_value($index, $typeOfAccount),
                            'type' => $acc,
                            'status' => $status,
                    ];
                }
            }

        }

        return $accounts;
    }
}
