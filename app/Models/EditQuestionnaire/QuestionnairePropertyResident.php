<?php

namespace App\Models\EditQuestionnaire;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClientsPropertyResident;
use App\Models\User;
use App\Models\Expenses;
use App\Models\FinancialAffairs;
use App\Models\Mortgages;
use App\Models\CrsCreditReport;
use App\Helpers\Helper;
use App\Models\ClientsAssociate;
use App\Services\Client\CacheExpense;
use App\Services\Client\CacheProperty;
use App\Services\Client\CacheSOFA;

class QuestionnairePropertyResident extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_property_resident';
    public $timestamps = false;

    public static function saveStepResident($client_id, $request, $save_request_by_attorney = false, $attorney_id = '')
    {
        // get all input data
        $input = $request->all();

        $propertyFinal = [];
        $propertyFinal = self::getResidentDetails($input, $propertyFinal);
        //
        $propertyFinal = self::addSecurityDepositToFinalPropertyArray($propertyFinal, $input);
        $hasRentedProperties = false;

        if (is_array($propertyFinal) && !empty($propertyFinal)) {
            $hasRentedProperties = in_array(0, array_column($propertyFinal, 'currently_lived'));
        }

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

        $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $settingsAttorneyId,'is_associate' => $is_associate])->select(['is_rental_agreement_enabled'])->first();
        $is_rental_agreement_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_rental_agreement_enabled', $attorneySettings, 'radio') : 0;


        if ($is_rental_agreement_enabled && $hasRentedProperties) {
            \App\Models\ClientDocuments::updateOrCreate(['client_id' => $client_id,
                'document_name' => 'rental_agreement'], [
                'client_id' => $client_id,
                'document_type' => 'Copy of Current Rental Agreement',
                'document_name' => 'rental_agreement',
                'type' => 'rental_agreement',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        if (!$hasRentedProperties) {
            \App\Models\ClientDocuments::where([
                'client_id' => $client_id,
                'type' => 'rental_agreement'
            ])->delete();
        }
        // add securityDeposits to property assets
        $securityDeposits = Helper::validate_key_value('security_deposits', $input) ?? [];
        if (!empty($securityDeposits)) {
            QuestionnairePropertyFinancialAssets::updateSecurityDepositsToPropertyFinancialAssetsFromPropertyResident($securityDeposits, $client_id, $save_request_by_attorney);
        }

        // Process loan details for all car loan keys
        $carLoanKeys = ['home_car_loan', 'home_car_loan2', 'home_car_loan3'];
        foreach ($carLoanKeys as $key) {
            $propertyFinal = self::getLoanDetails($propertyFinal, $input, $key);
        }

        // Calculate expenses
        $expense = self::calculateExpenses($propertyFinal, $input, $client_id);

        // save Financial Affairs Data
        if (!empty($propertyFinal)) {
            self::saveFinancialAffairsData($propertyFinal, $client_id, $save_request_by_attorney);
            // clear cache for client SOFA
            CacheSOFA::forgetSOFACache($client_id);
        }

        // update Expenses
        if (!empty($expense)) {
            $modelExpenses = $save_request_by_attorney ? (QuestionnaireExpenses::class) : (Expenses::class);
            $modelExpenses::updateOrCreate(['client_id' => $client_id], $expense);
            CacheExpense::forgetExpenseCache($client_id);
        }

        // add residents to creditor report
        self::addResidentCreditorsToReport($propertyFinal, $client_id, $save_request_by_attorney, $attorney_id);

        // add residents to creditor report
        self::updateOrCreatePropertyResident($propertyFinal, $client_id, $attorney_id, $save_request_by_attorney);

        // forget property cache
        CacheProperty::forgetPropertyCache($client_id);

        return true;
    }

    private static function getResidentDetails($input, $propertyFinal)
    {
        $propertyResident = Helper::validate_key_value('property_resident', $input);
        if (!empty($propertyResident)) {
            foreach ($propertyResident as $key => $values) {
                if (in_array($key, ['home_car_loan', 'home_car_loan2', 'home_car_loan3'])) {
                    continue; // Skip loan keys here
                }

                foreach ($values as $index => $value) {
                    if (in_array($key, ['property_description', 'eviction_pending_data'])) {
                        $value = json_encode($value); // Encode if necessary
                    }
                    $propertyFinal[$index][$key] = $value;
                }
            }
        }

        return $propertyFinal;
    }

    private static function addSecurityDepositToFinalPropertyArray($propertyFinal, $input)
    {
        $securityDeposits = Helper::validate_key_value('security_deposits', $input) ?? [];

        if (!empty($securityDeposits)) {
            foreach ($securityDeposits as $key => $depositData) {

                if (Helper::validate_key_value('type_value', $depositData, 'radio') != 1) {
                    $depositData['type_value'] = 0;
                }
                $propertyFinal[$key]['security_deposits'] = json_encode($depositData);
            }
        }

        return $propertyFinal;
    }


    private static function getLoanDetails($propertyFinal, $input, $loanKey)
    {
        $propertyResident = Helper::validate_key_value('property_resident', $input);
        if (!empty($propertyResident[$loanKey])) {
            foreach ($propertyResident[$loanKey] as $key => $values) {
                foreach ($values as $index => $value) {
                    $loanData[$index][$key] = $value ?? ""; // Assign value or default to empty string
                    $propertyFinal[$index][$loanKey] = json_encode($loanData[$index]); // Encode loan data
                }
            }
        }

        return $propertyFinal;
    }

    private static function calculateExpenses($propertyFinal, $input, $client_id)
    {
        $anotherEmitOfPrimaryProperty = 0;
        $primaryPropertyEmi = 0;
        $propertyResident = Helper::validate_key_value('property_resident', $input);

        // Process non-primary addresses
        if (!empty($propertyResident['not_primary_address'])) {
            foreach ($propertyResident['not_primary_address'] as $key => $val) {
                if ($val == 0) {
                    // Calculate primary property EMI
                    if (!empty($propertyResident['loan_own_type_property'][0])
                        && $propertyResident['loan_own_type_property'][0] == 1) {
                        $primaryPropertyEmi += (float) self::getLoanValue($propertyFinal, $key, 'home_car_loan', 'monthly_payment');
                    }

                    // Calculate additional loan EMIs
                    $anotherEmitOfPrimaryProperty += (float) self::calculateAdditionalLoans($propertyFinal, $key);
                }
            }
        }

        // Prepare expense array
        $expense = [];
        if (!empty($propertyResident['currently_lived'])) {
            if (current($propertyResident['currently_lived']) == 1) { // Own
                $expense['client_id'] = $client_id;
                $expense['rent_home_mortage'] = $primaryPropertyEmi;
            }
            if (current($propertyResident['currently_lived']) == 0) { // Rent
                $expense['client_id'] = $client_id;
                $expense['rent_home_mortage'] = current($propertyResident['rent']);
                \App\Models\User::mark_doc_not_own($client_id, 'Current_Mortgage_Statement_1_1');
            } else {
                \App\Models\NotOwnDocuments::where(['client_id' => $client_id, 'document_type' => 'Current_Mortgage_Statement_1_1'])->delete();
            }
        }

        if ($anotherEmitOfPrimaryProperty > 0) {
            $expense['client_id'] = $client_id;
            $expense['mortgage_payments'] = 1;
            $expense['mortgage_payments_pay'] = $anotherEmitOfPrimaryProperty;
        }

        return $expense;
    }

    private static function getLoanValue($propertyFinal, $key, $loanKey, $field)
    {
        if (!empty($propertyFinal[$key][$loanKey])) {
            $loanData = json_decode($propertyFinal[$key][$loanKey], true);
            if (json_last_error() === JSON_ERROR_NONE && !empty($loanData[$field])) {
                return $loanData[$field];
            }
        }

        return 0;
    }

    private static function calculateAdditionalLoans($propertyFinal, $key)
    {
        $additionalEmi = 0;
        $loanKeys = ['home_car_loan2', 'home_car_loan3'];
        foreach ($loanKeys as $loanKey) {
            if (!empty($propertyFinal[$key][$loanKey])) {
                $loanData = json_decode($propertyFinal[$key][$loanKey], true);
                if (json_last_error() === JSON_ERROR_NONE
                    && !empty($loanData['monthly_payment'])
                    && isset($loanData["additional_loan" . ($loanKey === 'home_car_loan2' ? '1' : '2')])
                    && $loanData["additional_loan" . ($loanKey === 'home_car_loan2' ? '1' : '2')] == 1) {
                    $additionalEmi += (float) $loanData['monthly_payment'];
                }
            }
        }

        return $additionalEmi;
    }

    private static function saveFinancialAffairsData($propertyFinal, $client_id, $save_request_by_attorney)
    {
        $user = User::where('id', $client_id)->first();
        $finacial_affairs = $user->getFinancialAffairs($save_request_by_attorney)->first();

        $final_finacial_affairs = Helper::getFinacialAffairsUpdateArray($finacial_affairs);
        $debtsData = $final_finacial_affairs['primarily_consumer_debets_data'] ?? [];

        $keysToDelete = [1];
        $debtsData = Helper::updateAllLoanPayments($debtsData, $keysToDelete);
        $debtsData = Helper::updatePaymentsInDebtsData($debtsData);
        foreach ($propertyFinal as $data) {
            foreach ($data as $key => $value) {
                if (isset($data['loan_own_type_property']) && $data['loan_own_type_property'] == 1) {
                    if (in_array($key, ['home_car_loan', 'home_car_loan2', 'home_car_loan3'])) {
                        $valueData = json_decode($value, 1);

                        if (($key == 'home_car_loan2' && (isset($valueData['additional_loan1']) && $valueData['additional_loan1'] != 1)) || ($key == 'home_car_loan3' && (isset($valueData['additional_loan2']) && $valueData['additional_loan2'] != 1))) {
                            continue;
                        }
                        if (Helper::validate_key_value('is_mortgage_three_months', $valueData) == 1 && Helper::validate_key_value('total_amount_paid', $valueData) >= 600) {
                            $debtsData['creditor_address'][] = Helper::validate_key_value('creditor_name', $valueData);
                            $debtsData['creditor_street'][] = Helper::validate_key_value('creditor_name_addresss', $valueData);
                            $debtsData['creditor_city'][] = Helper::validate_key_value('creditor_city', $valueData);
                            $debtsData['creditor_state'][] = Helper::validate_key_value('creditor_state', $valueData);
                            $debtsData['creditor_zip'][] = Helper::validate_key_value('creditor_zip', $valueData);
                            $debtsData['payment_dates'][] = Helper::validate_key_value('payment_dates_1', $valueData);
                            $debtsData['payment_dates2'][] = Helper::validate_key_value('payment_dates_2', $valueData);
                            $debtsData['payment_dates3'][] = Helper::validate_key_value('payment_dates_3', $valueData);
                            $debtsData['payment_1'][] = Helper::validate_key_value('payment_1', $valueData);
                            $debtsData['payment_2'][] = Helper::validate_key_value('payment_2', $valueData);
                            $debtsData['payment_3'][] = Helper::validate_key_value('payment_3', $valueData);
                            $debtsData['total_amount_paid'][] = Helper::validate_key_value('total_amount_paid', $valueData);
                            $debtsData['amount_still_owed'][] = Helper::validate_key_value('amount_own', $valueData);
                            $debtsData['creditor_payment_for'][] = "1";
                        }
                    }
                }
            }
        }
        $final_finacial_affairs['primarily_consumer_debets'] = 1;
        $final_finacial_affairs['client_id'] = $client_id;
        $final_finacial_affairs['primarily_consumer_debets_data'] = json_encode($debtsData);

        $model = $save_request_by_attorney ? (QuestionnaireFinancialAffairs::class) : (FinancialAffairs::class);

        $model::updateOrCreate(
            ["client_id" => $client_id],
            $final_finacial_affairs
        );

    }

    private static function addResidentCreditorsToReport($propertyFinal, $client_id, $save_request_by_attorney, $attorney_id)
    {
        if (!empty($propertyFinal)) {
            foreach ($propertyFinal as $property) {
                if (isset($property['currently_lived']) && $property['currently_lived'] == 1) {

                    if (isset($property['loan_own_type_property']) && $property['loan_own_type_property'] == 1) {

                        $loan = json_decode($property['home_car_loan'], 1);
                        Mortgages::saveToMortgageCreditorTable($loan, $save_request_by_attorney, $attorney_id, $client_id);

                        CrsCreditReport::addCreditorToReport($loan, $client_id);

                        $loan2 = json_decode($property['home_car_loan2'], 1);
                        if (isset($loan2['additional_loan1']) && $loan2['additional_loan1'] == 1) {
                            CrsCreditReport::addCreditorToReport($loan2, $client_id);
                        }

                        $loan3 = json_decode($property['home_car_loan3'], 1);
                        if (isset($loan3['additional_loan2']) && $loan3['additional_loan2'] == 1) {
                            CrsCreditReport::addCreditorToReport($loan3, $client_id);
                        }

                    }
                }
            }
        }
    }

    private static function updateOrCreatePropertyResident($propertyFinal, $client_id, $attorney_id, $save_request_by_attorney)
    {
        $abFormLineStart = QuestionnaireUser::get_AB_FORM_LINE_NUMBERS('resident_property');
        $abFormLineNo = '';
        if (!empty($propertyFinal)) {

            $function = $save_request_by_attorney ? 'questionnairePropertyResident' : 'clientsPropertyResident';
            $postedIds = array_column($propertyFinal, 'id');

            $user = User::where('id', $client_id)->first();
            // remove previous data
            $user->$function()->whereNotIn('id', $postedIds)->delete();

            $dateTime = date('Y-m-d H:i:s');

            // determine which model to use
            $model = $save_request_by_attorney ? (QuestionnairePropertyResident::class) : (ClientsPropertyResident::class);
            // add new data
            foreach ($propertyFinal as $dataToSave) {
                $abFormLineNo = ($abFormLineNo == '') ? ($abFormLineStart + .1) : ($abFormLineNo + .1);
                $dataToSave['client_id'] = $client_id;
                $dataToSave['form_ab_line_no'] = $abFormLineNo;
                $dataToSave['updated_on'] = $dateTime;

                $condition = [ 'id' => Helper::validate_key_value('id', $dataToSave) ];
                if (!$model::where($condition)->exists()) {
                    $dataToSave['created_on'] = $dateTime;
                }

                if ($save_request_by_attorney) {
                    $dataToSave['reviewed_by'] = $attorney_id;
                    $dataToSave['reviewed_on'] = $dateTime;
                }

                $model::updateOrCreate($condition, $dataToSave);

            }

            // forget property cache
            CacheProperty::forgetPropertyCache($client_id);
        }
    }

}
