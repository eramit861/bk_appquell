<?php

namespace App\Models\EditQuestionnaire;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use App\Helpers\ArrayHelper;
use App\Models\User;
use App\Models\ClientDocuments;
use App\Models\ClientDocumentUploaded;
use App\Models\ClientsPropertyFinancialAssets;
use App\Models\IncomeDebtorMonthlyIncome;
use App\Models\IncomeDebtorSpouseMonthlyIncome;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheProperty;

class QuestionnairePropertyFinancialAssets extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_property_financial_assets';
    public $timestamps = false;

    public static function savePropertyFinancialAssetsFromBasicInfoStep3($client_id, $input, $fromAttorney = false)
    {
        $inputData = Helper::validate_key_value('used_business_ein_data', $input);

        if (!empty($inputData)) {

            $dateTime = date('Y-m-d H:i:s');

            $model = $fromAttorney ? (QuestionnairePropertyFinancialAssets::class) : (ClientsPropertyFinancialAssets::class);
            $partRest = Helper::validate_key_value('part_rest', $input);

            $businessData = $inputData;
            $usedBusinessEin = Helper::validate_key_value('used_business_ein', $partRest, 'radio');
            $jsonData = json_encode([
                    'description' => !empty(Helper::validate_key_value('own_business_name', $businessData)) ? Helper::validate_key_value('own_business_name', $businessData) : [],
                    'type_of_account' => !empty(Helper::validate_key_value('type_of_account', $businessData)) ? Helper::validate_key_value('type_of_account', $businessData) : [],
                    'property_value' => !empty(Helper::validate_key_value('property_value', $businessData)) ? Helper::validate_key_value('property_value', $businessData) : [],
                ]);

            $dataToSave = [
                    'client_id' => $client_id,
                    'type' => 'traded_stocks',
                    'type_value' => $usedBusinessEin,
                    'type_data' => $usedBusinessEin ? $jsonData : '',
                    'form_ab_line_no' => '',
                    'created_on' => $dateTime,
                    'updated_on' => $dateTime,
                ];

            $model::where(["client_id" => $client_id, 'type' => 'traded_stocks'])->delete();
            $model::where(["client_id" => $client_id])->create($dataToSave);

            // forget property cache
            CacheProperty::forgetPropertyCache($client_id);
        }

        return true;
    }

    public static function updateSecurityDepositsToPropertyFinancialAssetsFromPropertyResident($securityDeposits, $client_id, $save_request_by_attorney)
    {
        if (!empty($securityDeposits)) {
            $hasDepositData = false;

            $type_data = [
                "description" => [],
                "type_of_account" => [],
                "property_value" => []
            ];

            // To keep track of indexes for summing and grouping
            $accountIndexMap = [];

            foreach ($securityDeposits as $key => $depositData) {
                if (isset($depositData['type_value']) && $depositData['type_value'] == 1) {
                    if (isset($depositData['data']) && is_array($depositData['data'])) {
                        $data = $depositData['data'];

                        foreach ($data['type_of_account'] as $index => $typeOfAccount) {
                            $description = $data['description'][$index] ?? '';
                            $propertyValue = $data['property_value'][$index] ?? 0;

                            // Check if this `type_of_account` already exists in the final array
                            if (!isset($accountIndexMap[$typeOfAccount])) {
                                // New account type, initialize it
                                $accountIndexMap[$typeOfAccount] = count($type_data['type_of_account']);
                                $type_data['type_of_account'][] = $typeOfAccount;
                                $type_data['description'][] = $description;
                                $type_data['property_value'][] = (float)Helper::priceFormt($propertyValue);
                            } else {
                                // Existing account type, update the description and property value
                                $existingIndex = $accountIndexMap[$typeOfAccount];
                                $type_data['description'][$existingIndex] .= ", " . $description;
                                $type_data['property_value'][$existingIndex] += (float)Helper::priceFormt($propertyValue);
                            }
                        }
                        $hasDepositData = true;
                    }
                }
            }

            // Convert property values to strings for consistency
            $type_data['property_value'] = array_map(function ($value) {
                return number_format($value, 2, '.', '');
            }, $type_data['property_value']);

            $dateTime = date('Y-m-d H:i:s');
            $dataToSave = [
                    'client_id' => $client_id,
                    'type' => 'security_deposits',
                    'type_value' => 0,
                    'type_data' => json_encode($type_data),
                    'created_on' => $dateTime,
                    'updated_on' => $dateTime,
                    'form_ab_line_no' => ''
                ];

            if ($hasDepositData) {
                $dataToSave['type_value'] = 1;
            }

            $model = $save_request_by_attorney ? (QuestionnairePropertyFinancialAssets::class) : (ClientsPropertyFinancialAssets::class);
            $model::where(["client_id" => $client_id, 'type' => 'security_deposits'])->delete();
            $model::create($dataToSave);

            // forget property cache
            CacheProperty::forgetPropertyCache($client_id);
        }
    }

    public static function saveStepFinancialAssets($client_id, $request, $save_request_by_attorney = false, $attorney_id = '')
    {
        // get all input data
        $input = $request->except('_token');

        $user = User::find($client_id);

        // save property Financial Assets
        self::updateOrCreateFinancialAssets($input, $client_id, $save_request_by_attorney, $attorney_id, $user);

        //update financial affair data
        QuestionnaireFinancialAffairs::updateFinancialAffairsFromPropertyFinancialAssets($input, $client_id, $save_request_by_attorney);

        // forget property cache
        CacheProperty::forgetPropertyCache($client_id);
    }


    private static function updateOrCreateFinancialAssets($input, $client_id, $save_request_by_attorney, $attorney_id, $user)
    {
        $abFormLineStart = QuestionnaireUser::get_AB_FORM_LINE_NUMBERS('financial_assets_continue');
        $abFormLineNo = '';
        if (!empty($input)) {

            if (isset($input['client_id']) && !empty($input['client_id'])) {
                unset($input['client_id']);
            }
            unset($input['list_all_financial_accounts']);
            unset($input['list_all_financial_accounts_data']);

            unset($input['all_property_transfer_10_year']);
            unset($input['all_property_transfer_10_year_data']);

            $dateTime = date('Y-m-d H:i:s');
            foreach ($input as $type => $dataToSave) {
                $abFormLineNo = ($abFormLineNo == '') ? ($abFormLineStart) : ($abFormLineNo + 1);

                $dataToSave['client_id'] = $client_id;
                $dataToSave['form_ab_line_no'] = $abFormLineNo;
                $dataToSave['updated_on'] = $dateTime;
                $dataToSave['created_on'] = $dateTime;

                // add or delete entry in ClientDocuments
                if (in_array($type, ['bank', 'venmo_paypal_cash', 'brokerage_account'])) {
                    self::updateDocsInRequestedDoc($client_id, $type, $dataToSave);
                    if (Helper::validate_key_value('type_value', $dataToSave, 'radio') == 0) {
                        $dataToSave['type_data'] = json_encode([]);
                        // delete entry from ClientDocuments
                        ClientDocuments::where(['client_id' => $client_id,'type' => $type])->delete();
                    } else {
                        // add entry to ClientDocuments
                        self::addNewEntryInClientDocuments($client_id, $dataToSave, $type);
                    }
                }

                if ($type == 'retirement_pension') {
                    if (Helper::validate_key_value('type_value', $dataToSave, 'radio') == 0) {
                        $val['type_data'] = json_encode([]);
                        ClientDocuments::where(['client_id' => $client_id,'type' => $type])->delete();
                    } else {
                        self::createEntryInClientDocumentsForRetirement($client_id, $dataToSave, $type, $user);
                    }
                }

                if (in_array($type, ['venmo_paypal_cash', 'brokerage_account'])) {
                    $dataToSave['form_ab_line_no'] = 17;
                }

                self::updateOrCreatePropertyFinancialAssetsData($type, $dataToSave, $user, $client_id, $save_request_by_attorney, $attorney_id, $dateTime);

            }
        }
    }

    public static function updateDocsInRequestedDoc($client_id, $type, $dataToSave)
    {
        $PropertyData = CacheProperty::getPropertyData($client_id);
        $financialAssets = Helper::validate_key_value('financialassets', $PropertyData, 'array');
        $financialAssets = ClientsPropertyFinancialAssets::getDataByAssetType($financialAssets, $type);

        $typeData = Helper::validate_key_value('type_data', $financialAssets);

        if (isset($typeData) && !empty($typeData)) {
            $savedNames = json_decode($typeData, true);
            $account_type = Helper::validate_key_value('account_type', $savedNames) ?? [];
            $savedNamesArray = self::getSavedNamesArray($type, $savedNames, $account_type);
            $newNamesArray = self::getNewNamesArray($type, $dataToSave, $account_type);
            foreach ($savedNamesArray as $index => $old_type) {
                $old_type = str_replace(" ", "_", $old_type);
                $old_type = Helper::validate_doc_type($old_type);
                $savedNamesArray[$index] = $old_type;
            }
            foreach ($newNamesArray as $index => $old_type) {
                $old_type = str_replace(" ", "_", $old_type);
                $old_type = Helper::validate_doc_type($old_type);
                $newNamesArray[$index] = $old_type;
            }
            $deletedElements = [];
            $deletedElements = array_diff($savedNamesArray, $newNamesArray);
            if (Helper::validate_key_value('type_value', $dataToSave, 'radio') == 0) {
                $deletedElements = $savedNamesArray;
            }
            if (!empty($deletedElements)) {
                foreach ($deletedElements as $document_type) {
                    \App\Models\AdminClientRequestedDocuments::deleteTypeinRequDocs($client_id, $document_type);
                }
            }
        }
    }

    public static function addNewEntryInClientDocuments($client_id, $dataToSave, $type)
    {
        $PropertyData = CacheProperty::getPropertyData($client_id);
        $financialAssets = Helper::validate_key_value('financialassets', $PropertyData, 'array');
        $financialAssets = ClientsPropertyFinancialAssets::getDataByAssetType($financialAssets, $type);

        $typeData = Helper::validate_key_value('type_data', $financialAssets);

        // update or delete documents entry
        self::updateOrDeleteDocumentsEntry($typeData, $type, $dataToSave, $client_id);

        // update or create entry to ClientDocuments
        self::updateClientDocumentsEntry($dataToSave, $type, $client_id);

    }

    private static function updateOrDeleteDocumentsEntry($typeData, $type, $dataToSave, $client_id)
    {
        if (isset($typeData) && !empty($typeData)) {

            $savedNames = json_decode($typeData, 1);
            $account_type = Helper::validate_key_value('account_type', $savedNames) ?? [];

            $savedNamesArray = self::getSavedNamesArray($type, $savedNames, $account_type);
            $newNamesArray = self::getNewNamesArray($type, $dataToSave, $account_type);

            // delete entry from ClientDocuments
            ClientDocuments::where(['client_id' => $client_id, 'type' => $type])->delete();

            foreach ($savedNamesArray as $index => $old_type) {
                if (isset($newNamesArray[$index]) && !empty($newNamesArray[$index])) {

                    $old_type = str_replace(" ", "_", $old_type);
                    $old_type = Helper::validate_doc_type($old_type);

                    $new_type = str_replace(" ", "_", $newNamesArray[$index]);
                    $new_type = Helper::validate_doc_type($new_type, true);

                    // update document_type to ClientDocumentUploaded
                    ClientDocumentUploaded::where(['client_id' => $client_id,'document_type' => $old_type])->update(['document_type' => $new_type]);
                }
            }
        }
    }

    private static function getSavedNamesArray($type, $savedNames, $account_type)
    {
        $savedNamesArray = [];

        $savedNamesDescription = Helper::validate_key_value('description', $savedNames);
        if (isset($savedNamesDescription) && !empty($savedNamesDescription)) {
            $propertyValue = Helper::validate_key_value('property_value', $savedNames);

            foreach ($savedNamesDescription as $i => $des) {
                if (isset($propertyValue[$i]) && !empty($propertyValue[$i])) {
                    $savedNamesArray[] = ($type == 'venmo_paypal_cash')
                                            ? Helper::validate_key_value($i, $account_type)
                                            : $des.' ending with '.($savedNames['last_4_digits'][$i] ?? '') ;
                }
            }
        }

        return $savedNamesArray;
    }

    private static function getNewNamesArray($type, $dataToSave, $account_type)
    {
        $NewNamesArray = [];

        $data = Helper::validate_key_value('data', $dataToSave);
        $dataDescription = Helper::validate_key_value('description', $data);
        if (isset($dataDescription) && !empty($dataDescription)) {

            $lastFourDigitsArray = Helper::validate_key_value('last_4_digits', $data) ?? [];

            foreach ($dataDescription as $key => $newDesc) {
                if (empty($newDesc)) {
                    continue;
                }

                $last4d = $lastFourDigitsArray[$key] ?? '';
                $descDummy = ($type === 'venmo_paypal_cash')
                                ? Helper::validate_key_value($key, $account_type)
                                : (!empty($last4d) ? $newDesc . ' ending with ' . $last4d : '');

                if (!empty($descDummy)) {
                    $NewNamesArray[] = $descDummy ;
                }
            }
        }

        return $NewNamesArray;
    }

    private static function updateClientDocumentsEntry($dataToSave, $type, $client_id)
    {
        if (empty($dataToSave)) {
            return ;
        }

        $data = Helper::validate_key_value('data', $dataToSave) ?? [];

        $description = Helper::validate_key_value('description', $data) ?? [];
        $accountNo = Helper::validate_key_value('last_4_digits', $data) ?? [];
        $accountType = Helper::validate_key_value('account_type', $data) ?? [];
        $personalBusinessAccount = Helper::validate_key_value('personal_business_account', $data) ?? [];

        if ($type == 'bank') {
            $business_name = Helper::validate_key_value('business_name', $data) ?? [];
        }
        foreach ($description as $index => $name) {
            $last4di = Helper::validate_key_value($index, $accountNo);
            if ($type == 'venmo_paypal_cash') {

                if (!empty($name)) {
                    $nameToSave = Helper::validate_key_value($index, $accountType);
                    $doctype = str_replace(" ", "_", ($nameToSave));
                    $doctype = Helper::validate_doc_type($nameToSave, true);
                    $updatedName = ArrayHelper::getPropertyAccountName($nameToSave, $name);
                    $updatedName = str_replace('Paypal', 'PayPal', $updatedName);

                    ClientDocuments::updateOrCreate(['client_id' => $client_id, 'document_name' => $doctype], [ 'client_id' => $client_id, 'document_name' => $doctype, 'document_type' => $updatedName, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'type' => $type]);
                }
            } else {
                if (!empty($name) && !empty($last4di)) {

                    $nameToSave = $name.' ending with '.$last4di;
                    $doctype = str_replace(" ", "_", ($nameToSave));
                    $doctype = Helper::validate_doc_type($nameToSave, true);

                    $bank_account_type = '';
                    if ($type == 'bank') {
                        $bank_account_type = Helper::validate_key_value($index, $personalBusinessAccount);

                        $nameToSave = !empty(Helper::validate_key_value($index, string: $business_name)) && ($bank_account_type == 2) ? $nameToSave. ' ('.Helper::validate_key_value($index, $business_name).')' : $nameToSave;
                    }
                    ClientDocuments::updateOrCreate(['client_id' => $client_id, 'document_type' => $nameToSave], [ 'client_id' => $client_id, 'document_name' => $doctype, 'document_type' => $nameToSave, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'type' => $type, 'bank_account_type' => $bank_account_type]);
                }
            }
        }

    }


    private static function updateOrCreatePropertyFinancialAssetsData($type, $dataToSave, $user, $client_id, $save_request_by_attorney, $attorney_id, $dateTime)
    {
        $dataToSave['client_id'] = $client_id;
        if (in_array($type, haystack: ['is_business_property', 'is_farm_property'])) {
            self::updateOrCreateBusinessAssetsData($type, $dataToSave, $user, $save_request_by_attorney, $attorney_id, $dateTime);
        } else {
            self::updateOrCreateFinancialAssetsData($dataToSave, $user, $client_id, $save_request_by_attorney, $attorney_id, $dateTime);
        }
    }

    private static function updateOrCreateBusinessAssetsData($type, $dataToSave, $user, $save_request_by_attorney, $attorney_id, $dateTime)
    {
        $model = ($type == 'is_business_property')
                ? $user->clientsPropertyBusinessAssets()
                : $user->clientsPropertyFarmCommercial();

        $data = [
                    'type' => $type,
                    'type_value' => Helper::validate_key_value('type_value', $dataToSave, 'radio'),
                    'type_data' => ''
                ];

        if ($save_request_by_attorney) {
            $model = ($type == 'is_business_property')
                ? $user->questionnairePropertyBusinessAssets()
                : $user->questionnairePropertyFarmCommercial();
        }

        $model->updateOrCreate([ 'client_id' => $dataToSave['client_id'] ], $data);

        // forget property cache
        CacheProperty::forgetPropertyCache($dataToSave['client_id']);
    }

    private static function updateOrCreateFinancialAssetsData($dataToSave, $user, $client_id, $save_request_by_attorney, $attorney_id, $dateTime)
    {
        $type_value = Helper::validate_key_value('type_value', $dataToSave, 'radio');

        $dataToSave['type_data'] = (isset($type_value) && $type_value == 1) ? json_encode($dataToSave['data']) : json_encode([]);

        $type = Helper::validate_key_value('type', $dataToSave);

        if (!empty($type)) {

            // unset unwanted data
            unset($dataToSave['data']);
            unset($dataToSave['id']);

            if (isset($type_value)) {

                $function = 'clientsPropertyFinancialAssets';

                if ($save_request_by_attorney) {
                    $function = 'questionnairePropertyFinancialAssets';
                    $dataToSave['reviewed_by'] = $attorney_id;
                    $dataToSave['reviewed_on'] = $dateTime;
                }

                $user->$function()->where(["client_id" => $client_id, 'type' => $type])->delete();

                $user->$function()->create($dataToSave);

                // forget property cache
                CacheProperty::forgetPropertyCache($client_id);
            }
        }
    }

    public static function saveStepFinancialAssetsContinued($client_id, $request, $save_request_by_attorney = false, $attorney_id = '')
    {
        // get all input data
        $input = $request->except('_token');

        $user = User::find($client_id);

        // save property Financial Assets
        self::updateOrCreateFinancialAssetsContinued($input, $client_id, $save_request_by_attorney, $attorney_id, $user);

        //update financial affair data
        // QuestionnaireFinancialAffairs::updateFinancialAffairsFromPropertyFinancialAssets($input, $client_id, $save_request_by_attorney);

        // forget property cache
        CacheProperty::forgetPropertyCache($client_id);

    }

    public static function createEntryInIncomeTabData($data, $client_id, $save_request_by_attorney)
    {
        if (empty($data)) {
            return;
        }

        $owedTypes = Helper::validate_key_value('owed_type', $data);
        $monthlyAmounts = Helper::validate_key_value('monthly_amount', $data);
        $dataFor = Helper::validate_key_value('data_for', $data);

        $SSBenefitD1 = 0;
        $hasSSBenefitD1 = false;
        $VABenefitD1 = 0;
        $hasVABenefitD1 = false;
        $umpBenefitD1 = 0;
        $hasUmpBenefitD1 = false;
        $SSBenefitD2 = 0;
        $hasSSBenefitD2 = false;
        $VABenefitD2 = 0;
        $hasVABenefitD2 = false;
        $umpBenefitD2 = 0;
        $hasUmpBenefitD2 = false;

        foreach ($owedTypes as $index => $owedType) {
            $monthlyAmount = isset($monthlyAmounts[$index]) ? floatval($monthlyAmounts[$index]) : 0;
            $debtorType = Helper::validate_key_value($index, $dataFor);

            if ($owedType == '7') {
                if ($debtorType == 'debtor') {
                    $SSBenefitD1 += $monthlyAmount;
                    $hasSSBenefitD1 = true;
                }
                if ($debtorType == 'codebtor') {
                    $SSBenefitD2 += $monthlyAmount;
                    $hasSSBenefitD2 = true;
                }
            }

            if ($owedType == '8') {
                if ($debtorType == 'debtor') {
                    $VABenefitD1 += $monthlyAmount;
                    $hasVABenefitD1 = true;
                }
                if ($debtorType == 'codebtor') {
                    $VABenefitD2 += $monthlyAmount;
                    $hasVABenefitD2 = true;
                }
            }

            if ($owedType == '10') {
                if ($debtorType == 'debtor') {
                    $umpBenefitD1 += $monthlyAmount;
                    $hasUmpBenefitD1 = true;
                }
                if ($debtorType == 'codebtor') {
                    $umpBenefitD2 += $monthlyAmount;
                    $hasUmpBenefitD2 = true;
                }
            }

        }

        $monthlyIncomeD1Model = $save_request_by_attorney ? (QuestionnaireIncomeDebtorMonthlyIncome::class) : (IncomeDebtorMonthlyIncome::class);
        $monthlyIncomeD2Model = $save_request_by_attorney ? (QuestionnaireIncomeDebtorSpouseMonthlyIncome::class) : (IncomeDebtorSpouseMonthlyIncome::class);

        $condition = [ 'client_id' => $client_id ];

        if ($hasSSBenefitD1) {
            $monthlyIncomeD1Model::updateOrCreate($condition, [ 'client_id' => $client_id,'social_security' => 1, 'same_social_security_income' => 1, 'social_security_month' => json_encode([1 => $SSBenefitD1]) ]);
        }
        if ($hasVABenefitD1) {
            $monthlyIncomeD1Model::updateOrCreate($condition, [ 'client_id' => $client_id,'other_sources' => 1, 'same_other_sources_income' => 1, 'other_sources_month' => json_encode([1 => $VABenefitD1]), 'other_options_income' => 'VA Benefits' ]);
        }
        if ($hasUmpBenefitD1) {
            $monthlyIncomeD1Model::updateOrCreate($condition, [ 'client_id' => $client_id,'unemployment_compensation' => 1, 'same_unemployement_compensation_income' => 1, 'unemployment_compensation_month' => json_encode([1 => $umpBenefitD1]) ]);
        }
        if ($hasSSBenefitD2) {
            $monthlyIncomeD2Model::updateOrCreate($condition, [ 'client_id' => $client_id,'joints_social_security' => 1, 'joints_same_social_security_income' => 1, 'joints_social_security_month' => json_encode([1 => $SSBenefitD2]) ]);
        }
        if ($hasVABenefitD2) {
            $monthlyIncomeD2Model::updateOrCreate($condition, [ 'client_id' => $client_id,'joints_other_sources' => 1, 'joints_same_other_sources_income' => 1, 'joints_other_sources_month' => json_encode([1 => $VABenefitD2]), 'joints_other_sources_of_income' => 'VA Benefits' ]);
        }
        if ($hasUmpBenefitD2) {
            $monthlyIncomeD2Model::updateOrCreate($condition, [ 'client_id' => $client_id,'joints_unemployment_compensation' => 1, 'joints_same_unemployement_compensation' => 1, 'joints_unemployment_compensation_month' => json_encode([1 => $umpBenefitD2]) ]);
        }

        CacheIncome::forgetIncomeCache($client_id);
    }

    public static function createEntryInClientDocumentsForUnpaidWages($clientId, $dataToSave, $type)
    {
        if (isset($dataToSave) && !empty($dataToSave) && Helper::validate_key_value('type_value', $dataToSave, 'radio') == 1) {

            $data = Helper::validate_key_value('data', $dataToSave) ?? [] ;
            $owed_type = Helper::validate_key_value('owed_type', $data) ?? [] ;
            $data_for = Helper::validate_key_value('data_for', $data) ?? [] ;
            $dateTime = date('Y-m-d H:i:s');

            foreach ($owed_type as $index => $type) {
                if (in_array($type, [7, 8, 10])) {
                    $name = "";
                    switch ($type) {
                        case 7:    $name = "Social Security Annual Award Letter";
                            break;
                        case 8:    $name = "VA Benefit Award Letter";
                            break;
                        case 10:   $name = "Unemployment Payment History (Last 7 Months)";
                            break;
                    }

                    $document_type = "%".Helper::validate_key_value($index, $data_for)."% ".$name;
                    $document_name = str_replace(" ", "_", $document_type);
                    $document_name = Helper::validate_doc_type($document_name, true);
                    $document_type = ucfirst($document_type);
                    ClientDocuments::updateOrCreate(
                        [ 	'client_id' => $clientId, 'document_name' => $document_name 	],
                        [
                            'client_id' => $clientId,
                            'document_name' => $document_name,
                            'document_type' => $document_type,
                            'created_at' => $dateTime,
                            'updated_at' => $dateTime,
                            'type' => 'unpaid_wages'
                        ]
                    );

                }
            }
        }
    }

    public static function createEntryInClientDocumentsForLifeInsurance($clientId, $dataToSave, $type, $user, $save_request_by_attorney)
    {
        $lifeInsuranceData = $user->getPropertyFinancialAssets($save_request_by_attorney, Helper::PROPERTY_FINANCIAL_ASSETS_CONTINUTED_QUE_KEYS)->where('type', '=', $type)->first();
        $lifeInsuranceData = !empty($lifeInsuranceData) ? $lifeInsuranceData->toArray() : [];

        $typeData = Helper::validate_key_value('type_data', $lifeInsuranceData);

        if (isset($typeData) && !empty($typeData)) {
            $savedData = json_decode($typeData, 1);

            $savedNamesArray = self::getSavedNamesArrayForLifeInsurance($savedData);
            $NewNamesArray = self::getNewNamesArrayForLifeInsurance($dataToSave);

            ClientDocuments::where(['client_id' => $clientId, 'type' => $type])->delete();

            foreach ($savedNamesArray as $ind => $old_type) {
                if (isset($NewNamesArray[$ind]) && !empty($NewNamesArray[$ind])) {
                    $old_type = str_replace(" ", "_", $old_type);
                    $old_type = Helper::validate_doc_type($old_type);
                    $new_type = str_replace(" ", "_", $NewNamesArray[$ind]);
                    $new_type = Helper::validate_doc_type($new_type, true);
                    ClientDocumentUploaded::where(['client_id' => $clientId,'document_type' => $old_type])->update(['document_type' => ucfirst($new_type)]);
                }
            }
        }
        if (!empty($dataToSave)) {

            $data = Helper::validate_key_value('data', $dataToSave) ?? [];
            $account_type = Helper::validate_key_value('account_type', $data) ?? [];
            $names = Helper::validate_key_value('type_of_account', $data) ?? [];

            foreach ($names as $index => $name) {
                $acc_type = strtolower(Helper::validate_key_value($index, $account_type));
                if ($acc_type === 'whole') {
                    $document_type = $name.': Whole Life Policy';
                    $document_name = str_replace(" ", "_", $document_type);
                    $document_name = Helper::validate_doc_type($document_name, true);
                    $document_type = ucfirst($document_type);
                    $dataToUpdate = [
                                        'client_id' => $clientId,
                                        'document_name' => $document_name,
                                        'document_type' => $document_type,
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                        'type' => $type
                                    ];

                    ClientDocuments::updateOrCreate(['client_id' => $clientId, 'document_name' => $document_name], $dataToUpdate);

                }
                if ($acc_type === 'universal') {
                    $document_type = $name.': Universal Life Policy';
                    $document_name = str_replace(" ", "_", $document_type);
                    $document_name = Helper::validate_doc_type($document_name, true);
                    $document_type = ucfirst($document_type);

                    $dataToUpdate = [
                                        'client_id' => $clientId,
                                        'document_name' => $document_name,
                                        'document_type' => $document_type,
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                        'type' => $type
                                    ];

                    ClientDocuments::updateOrCreate(['client_id' => $clientId, 'document_name' => $document_name], $dataToUpdate);
                }
            }
        }
    }

    private static function getSavedNamesArrayForLifeInsurance($savedData)
    {
        $savedNamesArray = [];

        $typeOfAccount = Helper::validate_key_value('type_of_account', $savedData);

        if (isset($typeOfAccount) && !empty($typeOfAccount)) {
            $accountType = Helper::validate_key_value('account_type', $savedData) ?? [];
            $propertyValue = Helper::validate_key_value('property_value', $savedData) ?? [];

            foreach ($typeOfAccount as $index => $companyName) {
                if (isset($propertyValue[$index]) && !empty($propertyValue[$index])) {
                    $acc_type = strtolower(Helper::validate_key_value($index, $accountType));
                    if ($acc_type === 'whole') {
                        $savedNamesArray[] = $companyName.': Whole Life Policy';
                    }
                    if ($acc_type === 'universal') {
                        $savedNamesArray[] = $companyName.': Universal Life Policy';
                    }
                }
            }
        }

        return $savedNamesArray;
    }

    private static function getNewNamesArrayForLifeInsurance($dataToSave)
    {
        $NewNamesArray = [];

        $data = Helper::validate_key_value('data', $dataToSave);
        $typeOfAccount = Helper::validate_key_value('type_of_account', $data);

        if (isset($typeOfAccount) && !empty($typeOfAccount)) {

            $propertyValue = Helper::validate_key_value('property_value', $data);
            $accountType = Helper::validate_key_value('account_type', $data);

            foreach ($typeOfAccount as $key => $newCompanyName) {
                if (isset($propertyValue[$key]) && !empty($propertyValue[$key]) && !empty($newCompanyName)) {
                    $acc_type = strtolower(Helper::validate_key_value($key, $accountType));
                    if ($acc_type === 'whole') {
                        $NewNamesArray[] = ucfirst($newCompanyName).': Whole Life Policy';
                    }
                    if ($acc_type === 'universal') {
                        $NewNamesArray[] = ucfirst($newCompanyName).': Universal Life Policy';
                    }
                }
            }
        }


        return $NewNamesArray;
    }

    private static function updateOrCreateFinancialAssetsContinued($input, $client_id, $save_request_by_attorney, $attorney_id, $user)
    {
        $abFormLineStart = QuestionnaireUser::get_AB_FORM_LINE_NUMBERS('financial_assets');
        $abFormLineNo = '';
        if (!empty($input)) {

            if (isset($input['client_id']) && !empty($input['client_id'])) {
                unset($input['client_id']);
            }

            $dateTime = date('Y-m-d H:i:s');

            foreach ($input as $type => $dataToSave) {
                $abFormLineNo = ($abFormLineNo == '') ? ($abFormLineStart) : ($abFormLineNo + 1);

                $dataToSave['client_id'] = $client_id;
                $dataToSave['form_ab_line_no'] = $abFormLineNo;
                $dataToSave['updated_on'] = $dateTime;
                $dataToSave['created_on'] = $dateTime;

                if (in_array($type, [ 'life_insurance', 'insurance_policies' ])) {
                    $abFormLineNo = 31;
                }

                $typeValue = Helper::validate_key_value('type_value', $dataToSave, 'radio');

                if (($type === 'unpaid_wages') && ($typeValue == 1)) {
                    $data = Helper::validate_key_value('data', $dataToSave);
                    self::createEntryInIncomeTabData($data, $client_id, $save_request_by_attorney);
                    self::createEntryInClientDocumentsForUnpaidWages($client_id, $dataToSave, $type);
                }
                if (($type === 'unpaid_wages') && ($typeValue == 0)) {
                    $dataToSave['type_data'] = json_encode([]);
                    ClientDocuments::where([ 'client_id' => $client_id, 'type' => $type ])->delete();
                }

                if (($type === 'life_insurance') && ($typeValue == 0)) {
                    $dataToSave['type_data'] = json_encode([]);
                    ClientDocuments::where([ 'client_id' => $client_id, 'type' => $type ])->delete();
                }

                if (($type === 'life_insurance') && ($typeValue == 1)) {
                    self::createEntryInClientDocumentsForLifeInsurance($client_id, $dataToSave, $type, $user, $save_request_by_attorney);
                }

                if ($type == 'other_financial') {
                    QuestionnairePropertyMiscellaneous::updatePropertyMiscellaneousFromPropertyFinancialAssetsContinued($input, $user, $client_id, $attorney_id, $save_request_by_attorney);
                }

                $dataToSave['form_ab_line_no'] = $abFormLineNo;

                self::updateOrCreatePropertyFinancialAssetsData($type, $dataToSave, $user, $client_id, $save_request_by_attorney, $attorney_id, $dateTime);

            }

            // forget property cache
            CacheProperty::forgetPropertyCache($client_id);
        }

    }


    /** Adding retirement pension*/
    public static function createEntryInClientDocumentsForRetirement($clientId, $val, $type_for, $user)
    {
        $financialAssets = optional($user->clientsPropertyFinancialAssets->where('type', $type_for)->first())->toArray() ?? [];

        if (!empty($financialAssets['type_data'])) {
            $savedNames = json_decode($financialAssets['type_data'], true);
            $savedNamesArray = ClientsPropertyFinancialAssets::formatDocumentNames($savedNames);
            $newNamesArray = ClientsPropertyFinancialAssets::formatDocumentNames($val['data'] ?? []);

            ClientDocuments::where(['client_id' => $clientId, 'type' => $type_for])->delete();

            ClientsPropertyFinancialAssets::updateDocumentTypes($clientId, $savedNamesArray, $newNamesArray);
        }

        ClientsPropertyFinancialAssets::insertNewDocuments($clientId, $val['data'] ?? [], $type_for);

        // forget property cache
        CacheProperty::forgetPropertyCache($clientId);
    }

}
