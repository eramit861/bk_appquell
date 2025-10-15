<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\DateTimeHelper;

class CrsCreditReport extends Model
{
    public const PENDING_CLIENT_REVIEW = 0;
    public const PENDING_CLIENT_APPROVE = 1;
    public const PENDING_CLIENT_DECLINED = 2;
    protected $guarded = [];
    protected $table = 'tbl_crs_report';
    public $timestamps = false;

    /* 	public function getUsers()
        {
            return $this->belongs(User::class,'user_id','id');
        }
        public function designer()
        {
            return $this->belongs(User::class,'designer','id');
        }
        public function assign_designer()
        {
            return $this->hasOne(User::class,'id','designer');
        } */

    public static function addCreditorToReport($loanData, $client_id)
    {
        if (!empty($loanData) && isset($loanData['creditor_name']) && !empty($loanData['creditor_name'])) {
            $dataTosave = [
                'client_id' => $client_id,
                'fullName' => Helper::validate_key_value('creditor_name', $loanData),
                'creditLiabilityAccountIdentifier' => Helper::validate_key_value('account_number', $loanData),
                'address' => Helper::validate_key_value('creditor_name_addresss', $loanData),
                'city' => Helper::validate_key_value('creditor_city', $loanData),
                'state' => Helper::validate_key_value('creditor_state', $loanData),
                'zip' => Helper::validate_key_value('creditor_zip', $loanData),
                'creditLoanType' => 10,
                'client_confirm' => Helper::NO,
                'creditLiabilityAccountOwnershipType' => isset($loanData['property_owned_by']) ? ($loanData['property_owned_by'] == 1 ? 'INDIVIDUAL' : 'JOINT') : '',
                'manual_added_by_client' => Helper::YES,
                'creditLiabilityUnpaidBalanceAmount' => Helper::validate_key_value('amount_own', $loanData),
                'creditLiabilityAccountReportedDate' => Helper::validate_key_value('debt_incurred_date', $loanData)
            ];
            CrsCreditReport::updateOrCreate($dataTosave, $dataTosave);
        }

        return true;
    }

    public static function addCreditorToReportFromVehicle($propertyVehicleFinal, $client_id)
    {
        if (!empty($propertyVehicleFinal)) {
            foreach ($propertyVehicleFinal as $car) {
                $ownAnyProperty = Helper::validate_key_value('own_any_property', $car, 'radio');
                $hasAnyLoan = Helper::validate_key_value('loan_own_type_property', $car, 'radio');
                if (isset($ownAnyProperty) && $ownAnyProperty == 1 && isset($hasAnyLoan) && $hasAnyLoan == 1) {
                    $vehicleCarLoan = Helper::validate_key_value('vehicle_car_loan', $car);
                    $loan = json_decode($vehicleCarLoan, 1);
                    $creditorName = Helper::validate_key_value('creditor_name', $loan);
                    if (!empty($loan) && isset($creditorName) && !empty($creditorName)) {
                        $dataTosave = [
                            'client_id' => $client_id,
                            'fullName' => $creditorName,
                            'creditLiabilityAccountIdentifier' => Helper::validate_key_value('account_number', $loan),
                            'address' => Helper::validate_key_value('creditor_name_addresss', $loan),
                            'city' => Helper::validate_key_value('creditor_city', $loan),
                            'state' => Helper::validate_key_value('creditor_state', $loan),
                            'zip' => Helper::validate_key_value('creditor_zip', $loan),
                            'creditLoanType' => 11,
                            'client_confirm' => Helper::NO,
                            'creditLiabilityAccountOwnershipType' => isset($loan['debt_owned_by']) ? ($loan['debt_owned_by'] == 1 ? 'INDIVIDUAL' : 'JOINT') : '',
                            'manual_added_by_client' => Helper::YES,
                            'creditLiabilityUnpaidBalanceAmount' => Helper::validate_key_value('amount_own', $loan),
                            'creditLiabilityAccountReportedDate' => Helper::validate_key_value('debt_incurred_date', $loan)
                        ];
                        CrsCreditReport::updateOrCreate($dataTosave, $dataTosave);
                    }
                }
            }
        }

        return true;
    }


    public static function getAiProcessedClientPendingReviewed($client_id)
    {
        $reports = CrsCreditReport::where('client_id', $client_id)
        ->where('is_ai_processed', 1)
        ->where('client_confirm', 0)
        ->orderBy('fullName', 'asc')
        ->get()->toArray();

        return $reports;
    }

    public static function isAiProcessedClientPendingExists($client_id)
    {
        return  CrsCreditReport::where('client_id', $client_id)
         ->where('is_ai_processed', 1)
         ->where('client_confirm', 0)
         ->exists();
    }

    public static function isAiProcessedClientConfirmedExists($client_id)
    {
        return  CrsCreditReport::where('client_id', $client_id)
         ->where('is_ai_processed', 1)
         ->where('client_confirm', 1)
         ->exists();
    }

    public static function isAiProcessedEverExists($client_id)
    {
        return  CrsCreditReport::where('client_id', $client_id)
         ->where('is_ai_processed', 1)
         ->exists();
    }


    public function importintoCreditor($client_id, $report, $date, $debt_tax, $client_type)
    {

        if (!empty($debt_tax) && is_array($debt_tax) && count($debt_tax) > 125) {
            return response()->json(Helper::renderJsonError("Oops! Maximum 125 Debt taxes allowed."))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $creditLiabilityAccountOwnershipType = $report['creditLiabilityAccountOwnershipType'] ?? '';
        $owned_by = $this->getOwnBy($creditLiabilityAccountOwnershipType);

        $creditLiabilityType = $report['creditLoanType'] ?? '';
        $debt_type = '';

        switch (strtolower($creditLiabilityType)) {
            case 'credit card':             $debt_type = 2;
                break;
            case 'credit card purchases':   $debt_type = 2;
                break;
            case 'collection account':      $debt_type = 3;
                break;
            case 'educational':             $debt_type = 5;
                break;
            case 'education':               $debt_type = 5;
                break;
            case 'law suit':                $debt_type = 6;
                break;
            case 'cash advances':           $debt_type = 7;
                break;
            default: $debt_type = 4;
                break;
        }
        $datetosave = !empty($report['date_incurred']) ? $report['date_incurred'] : $date;
        $datetosave = !empty($datetosave) ? DateTimeHelper::formatToMonthYearFromAnyFormat($datetosave) : date('m/Y');
        $tax = [
            "cards_collections" => $debt_type,
            "creditor_name" => $report['fullName'],
            "amount_number" => Helper::lastchar($report['creditLiabilityAccountIdentifier']),
            "creditor_information" => $report['address'],
            "debt_date" => $datetosave,
            "creditor_city" => $report['city'],
            "creditor_state" => $report['state'],
            "creditor_zip" => $report['zip'],
            "amount_owned" => !empty(Helper::priceFormt($report['creditLiabilityPastDueAmount'])) ? Helper::priceFormt($report['creditLiabilityPastDueAmount']) : '0.00',
            "owned_by" => $owned_by,
            "original_creditor" => 1,
            "is_debt_three_months" => 0,
        ];

        if ($owned_by == 2 && $client_type == 3) {
            $codebtor = Helper::getCodebtorAddress($client_id);
            $tax['codebtor_creditor_name'] = $codebtor['name'];
            $tax['codebtor_creditor_name_addresss'] = $codebtor['address'];
            $tax['codebtor_creditor_city'] = $codebtor['city'];
            $tax['codebtor_creditor_state'] = $codebtor['state'];
            $tax['codebtor_creditor_zip'] = $codebtor['zip'];
        }

        return $tax;
    }

    private function getOwnBy($creditLiabilityAccountOwnershipType)
    {
        $owned_by = 1;
        switch (strtolower($creditLiabilityAccountOwnershipType)) {
            case 'debtor 1': $owned_by = 1;
                break;
            case 'debtor 2': $owned_by = 2;
                break;
            case 'debtor 1 and debtor 2': $owned_by = 3;
                break;
            default: break;
        }

        return $owned_by;
    }
    public static function addVehicleTitleFromVehicle($propertyVehicleFinal, $client_id)
    {
        $vehilceTitles = [];
        if (!empty($propertyVehicleFinal)) {
            foreach ($propertyVehicleFinal as $car) {
                $ownAnyProperty = Helper::validate_key_value('own_any_property', $car, 'radio');
                $hasAnyLoan = Helper::validate_key_value('loan_own_type_property', $car, 'radio');
                if (isset($ownAnyProperty) && $ownAnyProperty == 1 && isset($hasAnyLoan) && $hasAnyLoan == 0) {
                    $carYear = Helper::validate_key_value('property_year', $car);
                    $carMake = Helper::validate_key_value('property_make', $car);
                    $carModel = Helper::validate_key_value('property_model', $car);
                    $carStyle = Helper::validate_key_value('property_other_info', $car);
                    $document_type = $carYear.' '.$carMake.' '.$carModel.' '.$carStyle;
                    $documentName = Helper::validate_doc_type($document_type);
                    $document_type = "Title For ".$document_type;
                    $vehilceTitles[] = ['document_type' => $document_type, 'document_name' => $documentName];
                }
            }
        }

        if (empty($vehilceTitles)) {
            \App\Models\ClientDocuments::where([
                'client_id' => $client_id,
                'type' => 'vehicle_title'
            ])->delete();
        }
        if (!empty($vehilceTitles)) {
            $newNamesOfTypes = array_column($vehilceTitles, 'document_name');
            if (!empty($newNamesOfTypes)) {
                $documentNamesThatNeedTOdelete = \App\Models\ClientDocuments::where([
                    'client_id' => $client_id,
                    'type' => 'vehicle_title'
                ])->whereNotIn('document_name', $newNamesOfTypes)
                ->pluck('document_name')
                ->toArray();
                \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id])->whereIn('document_type', $documentNamesThatNeedTOdelete)->delete();
                \App\Models\ClientDocuments::where(['client_id' => $client_id, 'type' => 'vehicle_title'])->whereIn('document_name', $documentNamesThatNeedTOdelete)->delete();
            }
            if (!empty($vehilceTitles)) {
                foreach ($vehilceTitles as $title) {
                    \App\Models\ClientDocuments::updateOrCreate(['client_id' => $client_id,
                    'document_name' => $title['document_name']], [
                    'client_id' => $client_id,
                    'document_type' => $title['document_type'],
                    'document_name' => $title['document_name'],
                    'type' => 'vehicle_title',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                }
            }
        }
    }

    public static function getIsAllCreditorsImportedCount($client_id, $dType = 1)
    {

        if (!$client_id) {
            return '';
        }

        $report = self::where("client_id", $client_id);

        if ($dType == 1) {
            $report->where(function ($q) {
                $q->where('creditLiabilityAccountOwnershipType', 'Debtor 1')
                ->orWhere('creditLiabilityAccountOwnershipType', 'INDIVIDUAL');
            });
        }

        if ($dType == 2) {
            $report->where(function ($q) {
                $q->where('creditLiabilityAccountOwnershipType', 'Debtor 2');
            });
        }

        $totalCount = clone $report;
        $totalCount = $report->count();

        $report->where(function ($q) {
            $q->where('client_confirm', '')
            ->orWhere('client_confirm', '0');
        });

        return ['totalCount' => $totalCount, 'report' => $report->count()];
    }

}
