<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use App\Helpers\AddressHelper;
use App\Helpers\DateTimeHelper;
use App\Models\PayStubs;
use App\Helpers\DocumentHelper;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ArrayHelper;
use App\Helpers\VideoHelper;
use App\Models\Debts;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheExpense;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheProperty;
use App\Services\Client\CacheSOFA;
use Illuminate\Http\Request;

class JubileeImportController extends AttorneyController
{
    protected static $LiableParties = [];

    public static function addDataToLiableParties($data)
    {
        self::$LiableParties[] = $data;
    }
    public function jubliee_import_popup(Request $request)
    {
        $client_id = $request->client_id;

        return view('modal.common.creditor_select_for_import_popup')
            ->with([
                'client_id' => $client_id,
                'formRoute' => route('download_jubliee_import', ['id' => $client_id]),
                'formLabel' => 'Select Creditors to Import Into - Jubliee Pro',
                'invite_video' => VideoHelper::getAttorneyVideos(Helper::CREDITOR_SELECT_VIDEO),
                'creditors' => Debts::getAllDebtCreditorsByType($client_id),
                'submitLabel' => 'Import All Creditors To Jubilee',
                'submitWithBalanceLabel' => 'Import Only Creditors with Balances To Jubilee'
            ]);
    }

    public function index(Request $request, $client_id)
    {
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        if (empty($client_id)) {
            return redirect()->back()->with('error', 'Please download later, something going wrong.');
        }
        $user = \App\Models\User::where('id', $client_id)->first();
        $basic_info = CacheBasicInfo::getBasicInformationData($client_id, false, true);
        $BasicInfoPartA = empty(Helper::validate_key_value('BasicInfoPartA', $basic_info)) ? [] : Helper::validate_key_value('BasicInfoPartA', $basic_info);
        $basicInfo_AnyOtherName = (!empty($basic_info['BasicInfo_AnyOtherName'])) ? $basic_info['BasicInfo_AnyOtherName']->toArray() : [];

        $authUserName = str_replace(' ', '_', $user->name);

        $clientname = !empty($BasicInfoPartA) ? Helper::validate_key_value('name', $BasicInfoPartA).'_'.Helper::validate_key_value('last_name', $BasicInfoPartA) : $authUserName;
        $debtorName = Helper::validate_key_value('name', $BasicInfoPartA).' '.Helper::validate_key_value('middle_name', $BasicInfoPartA).' '.Helper::validate_key_value('last_name', $BasicInfoPartA);

        $pre_path = "/jubliee-files/" . $client_id;
        $main_path = public_path() . $pre_path;
        $this->checkOrCreateDir($main_path);
        $fileName = $main_path.'/'.$clientname . '.json';
        $baseContent = ['Chapter' => 1];  // 1 - Chapter 7, 2 - Chapter 11, 3 - Chapter 12, 4 - Chapter 13, 0 - All Chapters

        $dfileName = $pre_path.'/'.$clientname . '.json';

        $property_info = CacheProperty::getPropertyData($client_id, false, true);
        $property_info_resident = $property_info['propertyresident'];

        // User Object
        $arrayasset = [];
        $ownedRealEstatePropertiesObject = [];
        $ownedVehiclesObject = [];
        // OwnedRealEstateProperties Object
        $ownedRealEstatePropertiesObject = self::getOwnedRealEstatePropertiesObject($property_info_resident, $BasicInfoPartA);

        $propertyIndex = count($ownedRealEstatePropertiesObject);
        //$baseContent = $baseContent+  $ownedRealEstatePropertiesObject['OwnedRealEstateProperties'];
        // OwnedVehicles Object
        $ownedVehiclesObject = self::getOwnedVehiclesObject($property_info['propertyvehicle'], $propertyIndex);
        //$baseContent = $baseContent+$ownedVehiclesObject['OwnedVehicles'];
        $arrayassets = array_merge($ownedRealEstatePropertiesObject, $ownedVehiclesObject);
        $assetsCount = count($arrayassets);
        $arrayassets = self::getHouseholdItemsObject($property_info, $arrayassets, $assetsCount, $client_id);

        $baseContent['Case_Assets'] = $arrayassets;

        $debtstax = CacheDebt::getDebtData($client_id);
        $final_debtstax = $debtstax;
        $final_debtstax = Debts::removeSelectedCreditorDebts($request, $final_debtstax, false);

        $arraydebts = [];
        $arraydebts = self::getAllDebts($final_debtstax, $client_id, $property_info, $BasicInfoPartA);

        $baseContent['Case_Debts'] = $arraydebts;
        $divisonId = self::getDivisionId($BasicInfoPartA);
        $baseContent['DivisionId'] = $divisonId;
        $sofaData = [];
        $financialAffairData = CacheSOFA::getSOFAData($client_id);
        $sofaData = self::getSOFAData($financialAffairData, $debtorName);
        $baseContent['SOFA'] = $sofaData;

        $client_attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->select('attorney_id')->first();
        $client_attorney = (!empty($client_attorney)) ? $client_attorney : [];
        $attorney_id = $client_attorney->attorney_id;

        $income_info = CacheIncome::getIncomeData($client_id);
        $expenses_info = CacheExpense::getExpenseData($client_id);
        $debtorBudgetData = [];
        $debtorBudgetData = self::getDebtorBudgetData($user, $income_info, $expenses_info, $attorney_id);

        $baseContent['Debtor1Budget'] = $debtorBudgetData;
        $baseContent['Debtor1Dependents'] = self::getDependentsData($expenses_info);
        $baseContent['Debtor1Businesses'] = self::getBusinessesData($financialAffairData, 0);

        if ($user->client_type != Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED) {
            $debtorBudgetData2 = [];
            $spouse_expenses_info = CacheExpense::getExpenseData($client_id, true);
            $debtorBudgetData2 = self::getDebtor2BudgetData($user, $income_info, $spouse_expenses_info, $attorney_id);
            $baseContent['Debtor2Budget'] = $debtorBudgetData2;
            $baseContent['Debtor2Dependents'] = self::getDependentsData($spouse_expenses_info);
            $baseContent['Debtor2Businesses'] = self::getBusinessesData($financialAffairData, 1);
        }

        $allDebts = Debts::removeSelectedCreditorDebts($request, $debtstax, true);

        $noticingPartiesData = self::getNoticingPartiesData($request, $financialAffairData, $baseContent, $allDebts);
        $baseContent['NoticingParties'] = $noticingPartiesData['NoticingParties'] ?? [];
        $baseContent['NoticingPartyPairs'] = $noticingPartiesData['NoticingPartyPairs'] ?? [];
        foreach ($baseContent['Case_Debts'] as $key => &$debt) {
            if (isset($debt['RelationData'])) {
                unset($debt['RelationData']);
            }
        }

        $baseContent['LiableParties'] = self::getLiablePartiesData();
        $baseContent['LiablePartyPairs'] = self::getLiablePartyPairsData();

        $basicInfo_AnyOtherName = (!empty($basic_info['BasicInfo_AnyOtherName'])) ? $basic_info['BasicInfo_AnyOtherName']->toArray() : [];
        $pripmaryClient = self::getPrimaryClient($client_id, $BasicInfoPartA, $basicInfo_AnyOtherName);
        $baseContent = $baseContent + $pripmaryClient;

        $BasicInfoPartBData = empty(Helper::validate_key_value('BasicInfoPartB', $basic_info)) ? [] : Helper::validate_key_value('BasicInfoPartB', $basic_info);
        if ($user->client_type == Helper::CLIENT_TYPE_JOINT_MARRIED && !empty($BasicInfoPartBData)) {
            // FilingPerson Object
            $jointClient = self::getJointClient($client_id, $BasicInfoPartBData);
            $baseContent = $baseContent + $jointClient;
        }
        if ($user->client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED) {
            // Non-filling spouse data Object
            $jointClient = self::getSepearteClient();
            $baseContent = $baseContent + $jointClient;
        }

        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $attorney_company = (!empty($attorney_company)) ? $attorney_company->toArray() : [];
        $baseContent = $baseContent + self::getAttorneyAddress($attorney_company);

        $baseContent['Documents'] = \App\Models\ClientDocuments::getClientUploadedDocArray($user, $client_id, $attorney_id);

        $BasicInfoPartC = empty(Helper::validate_key_value('BasicInfo_PartC', $basic_info)) ? [] : Helper::validate_key_value('BasicInfo_PartC', $basic_info);

        $tenants = self::getTenantsObject($property_info_resident);
        $baseContent['Tenants'] = $tenants;

        $bankruptcyCases = self::getBankruptcyCases($BasicInfoPartC);
        $baseContent['BankruptcyCases'] = $bankruptcyCases;

        DocumentHelper::generateJsonFile($baseContent, $fileName);

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('download_url', url($dfileName));
    }

    private static function getAttorneyAddress($company)
    {
        if (empty($company)) {
            return;
        }

        return [
             "Attorney" => [
                 "Address" => [
                     "Street1" => $company['attorney_address'].(isset($company['attorney_address2']) && !empty($company['attorney_address2']) ? ', '.$company['attorney_address2'] : ''),
                     "City" => $company['attorney_city'],
                     "Zip" => $company['attorney_zip'],
                     "StateId" => 0,
                     "IsMailingAddress" => true,
                     "StateAbb" => $company['attorney_state']
                 ],
             "Email" => ['Value' => Auth::user()->email],
             "Phone" => ['Value' => $company['attorney_phone']]
             ]
         ];

    }

    private static function getDebtorBudgetData($user, $income_info, $expenses_info, $attorney_id)
    {
        $debtormonthlyincome = (!empty($income_info['debtormonthlyincome'])) ? $income_info['debtormonthlyincome'] : [];

        $incomes = [];

        $frequency = self::getFrequencyForJubliee(Helper::validate_key_value('often_get_paid', $debtormonthlyincome, 'radio'));
        $type = 'self';

        $isDWagesOn = Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome);
        $other_deduction = $isDWagesOn == 1 && isset($debtormonthlyincome['other_deduction']) ? $debtormonthlyincome['other_deduction'] : 0.00;
        $other_deduction = is_array($other_deduction) ? array_sum($other_deduction) : $other_deduction;
        $incomes = self::getDeductionArray($user, $type, $frequency, $attorney_id) ?? [];

        $businessIncome = self::getbusinessIncomeArray($debtormonthlyincome, $frequency, $type);
        if (!empty($businessIncome)) {
            array_push($incomes, $businessIncome);
        }

        // 3 Rental Income
        $rentalIncome = self::getIncomeArraySimilar('Rental Property', 3, 'RealPropertyIncomes', 'RealPropertyExpenses', $frequency, $debtormonthlyincome, 'rent_real_property', 'same_rent_income', 'rent_real_property_month');
        if (!empty($rentalIncome)) {
            array_push($incomes, $rentalIncome);
        }

        // 4 Interest and Dividends
        $interestAndDividends = self::getIncomeArraySimilar('Interest and Dividends', 4, 'Incomes', '', $frequency, $debtormonthlyincome, 'royalties', 'same_royalty_income', 'royalties_month');
        if (!empty($interestAndDividends)) {
            array_push($incomes, $interestAndDividends);
        }

        // 5 Family Support Income
        // $familySupportIncome = [];
        // array_push($incomes,$familySupportIncome);

        // 6 Child Support Income
        $childSupportIncome = self::getIncomeArraySimilar('Child Support Income', 6, 'Incomes', '', $frequency, $debtormonthlyincome, 'regular_contributions', 'same_regular_contribution_income', 'regular_contributions_month');
        if (!empty($childSupportIncome)) {
            array_push($incomes, $childSupportIncome);
        }

        // 7 Social Security Income
        $socialSecurityIncome = self::getIncomeArraySimilar('Social Security Income', 7, 'Incomes', '', $frequency, $debtormonthlyincome, 'social_security', 'same_social_security_income', 'social_security_month');
        if (!empty($socialSecurityIncome)) {
            array_push($incomes, $socialSecurityIncome);
        }

        // 8 Disability Income
        // $disabilityIncome = [];
        // array_push($incomes,$disabilityIncome);

        // 9 Pension or Retirement Income
        $pensionOrRetirementIncome = self::getIncomeArraySimilar('Pension or Retirement Income', 9, 'Incomes', '', $frequency, $debtormonthlyincome, 'retirement_income', 'same_retirement_income', 'retirement_income_month');
        if (!empty($pensionOrRetirementIncome)) {
            array_push($incomes, $pensionOrRetirementIncome);
        }

        // 10 Unemployment Compensation
        $unemploymentCompensation = self::getIncomeArraySimilar('Unemployment Compensation', 10, 'Incomes', '', $frequency, $debtormonthlyincome, 'unemployment_compensation', 'same_unemployement_compensation_income', 'unemployment_compensation_month');
        if (!empty($unemploymentCompensation)) {
            array_push($incomes, $unemploymentCompensation);
        }

        // 11 Other Government Assistance
        $otherGovernmentAssistance = self::getIncomeArraySimilar(Helper::validate_key_value('government_assistance_specify', $debtormonthlyincome), 11, 'Incomes', '', $frequency, $debtormonthlyincome, 'government_assistance', 'same_government_assistance_income', 'government_assistance_month');
        if (!empty($otherGovernmentAssistance)) {
            array_push($incomes, $otherGovernmentAssistance);
        }

        // 99 Others
        $otherIncome = self::getIncomeArraySimilar(Helper::validate_key_value('other_options_income', $debtormonthlyincome), 99, 'Incomes', '', $frequency, $debtormonthlyincome, 'other_sources', 'same_other_sources_income', 'other_sources_month');
        if (!empty($otherIncome)) {
            array_push($incomes, $otherIncome);
        }

        $income = [
            "Incomes" => $incomes,
            "HomeExpenses" => self::getHomeExpensesArray($expenses_info),
            "InstallmentExpenses" => self::getInstallmentExpensesArray($expenses_info),
            "HouseholdExpenses" => self::getHouseholdExpensesArray($expenses_info),
            "IncomeDeductions" => [],
            "BusinessExpenses" => self::getBusinessExpensesArray(),
        ];

        return $income;
    }

    private static function getDebtor2BudgetData($user, $income_info, $expenses_info, $attorney_id)
    {
        $debtorspousemonthlyincome = (!empty($income_info['debtorspousemonthlyincome'])) ? $income_info['debtorspousemonthlyincome'] : [];

        $incomes = [];

        $frequency = self::getFrequencyForJubliee(Helper::validate_key_value('joints_often_get_paid', $debtorspousemonthlyincome, 'radio'));
        $type = 'spouse';

        $isWagesOn = Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome);
        $other_deduction = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_other_deduction']) ? $debtorspousemonthlyincome['joints_other_deduction'] : 0.00;
        $other_deduction = is_array($other_deduction) ? array_sum($other_deduction) : $other_deduction;
        $incomes = self::getDeductionArray($user, $type, $frequency, $attorney_id) ?? [];

        $businessIncome = self::getbusinessIncomeArray($debtorspousemonthlyincome, $frequency, $type);
        if (!empty($businessIncome)) {
            array_push($incomes, $businessIncome);
        }

        // 3 Rental Income
        $rentalIncome = self::getIncomeArraySimilar('Rental Property', 3, 'RealPropertyIncomes', 'RealPropertyExpenses', $frequency, $debtorspousemonthlyincome, 'joints_rent_real_property', 'joints_same_rent_income', 'joints_rent_real_property_month');
        if (!empty($rentalIncome)) {
            array_push($incomes, $rentalIncome);
        }

        // 4 Interest and Dividends
        $interestAndDividends = self::getIncomeArraySimilar('Interest and Dividends', 4, 'Incomes', '', $frequency, $debtorspousemonthlyincome, 'joints_royalties', 'joints_same_royalty_income', 'joints_royalties_month');
        if (!empty($interestAndDividends)) {
            array_push($incomes, $interestAndDividends);
        }

        // 5 Family Support Income
        // $familySupportIncome = [];
        // array_push($incomes,$familySupportIncome);

        // 6 Child Support Income
        $childSupportIncome = self::getIncomeArraySimilar('Child Support Income', 6, 'Incomes', '', $frequency, $debtorspousemonthlyincome, 'joints_regular_contributions', 'joints_same_contribution_income', 'joints_regular_contributions_month');
        if (!empty($childSupportIncome)) {
            array_push($incomes, $childSupportIncome);
        }

        // 7 Social Security Income
        $socialSecurityIncome = self::getIncomeArraySimilar('Social Security Income', 7, 'Incomes', '', $frequency, $debtorspousemonthlyincome, 'joints_social_security', 'joints_same_social_security_income', 'joints_social_security_month');
        if (!empty($socialSecurityIncome)) {
            array_push($incomes, $socialSecurityIncome);
        }

        // 8 Disability Income
        // $disabilityIncome = [];
        // array_push($incomes,$disabilityIncome);

        // 9 Pension or Retirement Income
        $pensionOrRetirementIncome = self::getIncomeArraySimilar('Pension or Retirement Income', 9, 'Incomes', '', $frequency, $debtorspousemonthlyincome, 'joints_retirement_income', 'joints_same_retirement_income', 'joints_retirement_income_month');
        if (!empty($pensionOrRetirementIncome)) {
            array_push($incomes, $pensionOrRetirementIncome);
        }

        // 10 Unemployment Compensation
        $unemploymentCompensation = self::getIncomeArraySimilar('Unemployment Compensation', 10, 'Incomes', '', $frequency, $debtorspousemonthlyincome, 'joints_unemployment_compensation', 'joints_same_unemployement_compensation', 'joints_unemployment_compensation_month');
        if (!empty($unemploymentCompensation)) {
            array_push($incomes, $unemploymentCompensation);
        }

        // 11 Other Government Assistance
        $otherGovernmentAssistance = self::getIncomeArraySimilar(Helper::validate_key_value('government_assistance_specify', $debtorspousemonthlyincome), 11, 'Incomes', '', $frequency, $debtorspousemonthlyincome, 'government_assistance', 'joints_same_government_assistance_income', 'government_assistance_month');
        if (!empty($otherGovernmentAssistance)) {
            array_push($incomes, $otherGovernmentAssistance);
        }

        // 99 Others
        $otherIncome = self::getIncomeArraySimilar(Helper::validate_key_value('joints_other_sources_of_income', $debtorspousemonthlyincome), 99, 'Incomes', '', $frequency, $debtorspousemonthlyincome, 'joints_other_sources', 'joints_same_other_sources_income', 'joints_other_sources_month');
        if (!empty($otherIncome)) {
            array_push($incomes, $otherIncome);
        }


        $income = [
            "Incomes" => $incomes,
            "HomeExpenses" => self::getHomeExpensesArray($expenses_info),
            "InstallmentExpenses" => self::getInstallmentExpensesArray($expenses_info),
            "HouseholdExpenses" => self::getHouseholdExpensesArray($expenses_info, true),
            "IncomeDeductions" => [],
            "BusinessExpenses" => self::getBusinessExpensesArray(),
        ];

        return $income;
    }

    private static function getDeductionArray($user, $type, $frequency, $attorney_id)
    {

        $paystub = new PayStubs();
        $debtorpaysData = $paystub->getPaystubByTypeForJubliee($user['id'], $type);
        $empTypeNum = 'debtor';

        if ($type == 'spouse') {
            $empTypeNum = 'codebtor';
        }

        $allEmployer = \App\Models\AttorneyEmployerInformationToClient::getEmployerList($user['id'], $attorney_id, $empTypeNum);
        $debtorpaysData = self::createPaysDataArray($allEmployer, $debtorpaysData);

        $employerData = \App\Models\AttorneyEmployerInformationToClient::where(['client_id' => $user['id'], 'attorney_id' => $attorney_id, 'client_type' => ($type == 'spouse' ? 2 : 1) ]);
        $incomes = [];
        if (!empty($debtorpaysData)) {
            foreach ($debtorpaysData as $employerId => $paydataList) {
                $debtoerincomes = [];
                $deducationofthismonth = [];
                $empObj = clone $employerData;
                $empData = $empObj->where(['id' => $employerId])->first();
                $empData = isset($empData) && !empty($empData) ? $empData->toArray() : [];
                if (!empty($empData)) {

                    foreach ($paydataList as $paydata) {
                        $employer_occupation = Helper::validate_key_value('employer_occupation', $paydata);
                        $employment_duration = Helper::validate_key_value('employment_duration', $paydata);
                        $employer_address = Helper::validate_key_value('employer_address', $paydata);
                        $employer_city = Helper::validate_key_value('employer_city', $paydata);
                        $employer_state = Helper::validate_key_value('employer_state', $paydata);
                        $employer_zip = Helper::validate_key_value('employer_zip', $paydata);
                        $frequency = !empty($paydata['frequency']) ? self::getFrequencyForJubliee($paydata['frequency']) : $frequency;
                        $amount = (isset($paydata['regular_pay_amount']) && !empty($paydata['regular_pay_amount'])) ? $paydata['regular_pay_amount'] : $paydata['gross_pay_amount'];

                        if ($amount <= 0) {
                            continue;
                        }

                        if (!isset($paydata['payment_date']) && empty($paydata['payment_date'])) {
                            $UseForBudget1 = self::getUseForBudgetValue($paydata['payment_date']);
                            array_push($debtoerincomes, [
                                "Id" => 0,
                                "Type" => 0,
                                "CheckDate" => $paydata['payment_date'] ?? '',
                                "Amount" => (float)Helper::priceFormt($amount),
                                "Frequency" => 5,
                                "Overtime" => (float)Helper::priceFormt(Helper::validate_key_value('overtime_pay_amount', $paydata)),
                                "Deductions" => [],
                                "UseForBudget" => $UseForBudget1
                            ]);
                        }
                        if (isset($paydata['payment_date']) && !empty($paydata['payment_date'])) {
                            $first_day_this_month = $paydata['payment_date'];
                            $UseForBudget = false;
                            //$first_day_this_month = date('Y-m-01', strtotime($paydate));
                            if (isset($paydata['deductions']) && !empty($paydata['deductions'])) {
                                $deductions = json_decode($paydata['deductions'], 1);
                                foreach ($deductions as $ded) {
                                    $deducationofthismonth[$first_day_this_month][$ded['name']][] = $ded['amount'];
                                }
                            }

                            $Taxes = Helper::validate_key_value('total_taxes', $paydata);
                            $deductionsArray = [
                                // [  "Id" => 0,  "Type" => 2,    "Amount" => (float)Helper::priceFormt($Taxes)                               ],
                                // [  "Id" => 0,  "Type" => 10,   "Amount" => (float)Helper::priceFormt($mandatory_contribution)              ],
                                // [  "Id" => 0,  "Type" => 11,   "Amount" => (float)Helper::priceFormt($voluntary_contribution)              ],
                                // [  "Id" => 0,  "Type" => 12,   "Amount" => (float)Helper::priceFormt($required_repayment)                  ],
                                // [  "Id" => 0,  "Type" => 20,   "Amount" => (float)Helper::priceFormt($union_dues)                          ]
                            ];

                            $taxesArray = Helper::validate_key_value('taxes', $paydata);
                            if (!empty($taxesArray)) {
                                $taxesArray = json_decode($taxesArray, true);
                                $otherTaxAmount = 0;
                                $dedArray = [];
                                foreach ($taxesArray as $data) {
                                    if (self::checkEqualText($data['name'], 'Federal Income Tax')) {
                                        array_push($dedArray, [  "Id" => 0,  "Type" => 2,  "Amount" => (float)Helper::priceFormt($data['amount']) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($data['name'], 'State Income Tax')) {
                                        array_push($dedArray, [  "Id" => 0,  "Type" => 3,  "Amount" => (float)Helper::priceFormt($data['amount']) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($data['name'], 'Medicare Tax')) {
                                        array_push($dedArray, [  "Id" => 0,  "Type" => 5,  "Amount" => (float)Helper::priceFormt($data['amount']) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($data['name'], 'Social Security Tax')) {
                                        array_push($dedArray, [  "Id" => 0,  "Type" => 4,  "Amount" => (float)Helper::priceFormt($data['amount']) ?? 0.00  ]);
                                    } else {
                                        $otherTaxAmount = $otherTaxAmount + ((float)Helper::priceFormt($data['amount']) ?? 0.00);
                                    }
                                }
                                if ($otherTaxAmount > 0) {
                                    // other taxes
                                    // array_push($dedArray, [  "Id" => 0,  "Type" => 6,  "Amount" => (float)Helper::priceFormt($otherTaxAmount??0.00)]);
                                }

                                $typeSums = [];

                                // Sum amounts for each type
                                foreach ($dedArray as $item) {
                                    $type = $item["Type"];
                                    $dedamount = $item["Amount"];

                                    if (!isset($typeSums[$type])) {
                                        $typeSums[$type] = 0;
                                    }

                                    $typeSums[$type] += $dedamount;
                                }

                                // Create new array with unique types and summed amounts
                                $deductionsArray = [];

                                foreach ($typeSums as $type => $dedamounta) {
                                    $deductionsArray[] = ["Id" => 0, "Type" => $type, "Amount" => $dedamounta];
                                }


                            }

                            if (!empty($deducationofthismonth) && isset($deducationofthismonth[$first_day_this_month])) {

                                foreach ($deducationofthismonth[$first_day_this_month] as $key => $val) {

                                    if (in_array(strtolower($key), ['401k (vol. retirement ded.)'])) {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 11,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } elseif (strtolower($key) === 'pension (mandatory ret. ded.)') {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 10,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($key, 'Mandatory Retirement')) {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 10,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($key, 'Voluntary Retirement')) {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 11,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($key, 'Retirement Loan Repayment')) {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 12,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($key, 'Life Insurance')) {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 30,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($key, 'Health Insurance')) {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 60,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($key, 'Disability Insurance')) {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 61,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($key, 'Health Savings Account')) {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 62,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($key, 'Child Support')) {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 40,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($key, 'Alimony')) {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 41,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } elseif (self::checkEqualText($key, 'Union Dues')) {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 20,  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    } else {
                                        array_push($deductionsArray, [  "Id" => 0,  "Type" => 99,   "Other" => $key ?? '',  "Amount" => (float)Helper::priceFormt(array_sum($val)) ?? 0.00  ]);
                                    }
                                }
                            }

                            $UseForBudget = self::getUseForBudgetValue($first_day_this_month);
                            $frequencyValue = '';
                            switch ($frequency) {
                                case 1: $frequencyValue = 'Weekly';
                                    break;
                                case 2: $frequencyValue = 'BiWeekly';
                                    break;
                                case 3: $frequencyValue = 'SemiMonthly';
                                    break;
                                case 4: $frequencyValue = 'Monthly';
                                    break;
                            }

                            array_push($debtoerincomes, [
                                "Id" => 0,
                                "Type" => 0,
                                "CheckDate" => $first_day_this_month,
                                // gross pay attorney side
                                "Amount" => (float)Helper::priceFormt($amount),
                                "Frequency" => !empty($frequencyValue) ? $frequencyValue : 'Monthly',
                                "Overtime" => (float)Helper::priceFormt(Helper::validate_key_value('overtime_pay_amount', $paydata)),
                                "Deductions" => $deductionsArray,
                                "UseForBudget" => $UseForBudget
                            ]);
                        }
                    }

                    $employerName = Helper::validate_key_value('employer_name', $empData);
                    $employer_address = Helper::validate_key_value('employer_address', $empData);
                    $employer_city = Helper::validate_key_value('employer_city', $empData);
                    $employer_state = Helper::validate_key_value('employer_state', $empData);
                    $employer_zip = Helper::validate_key_value('employer_zip', $empData);
                    $employment_duration = Helper::validate_key_value('employment_duration', $empData);
                    $employer_occupation = Helper::validate_key_value('employer_occupation', $empData);

                    $employdetail = [
                        "Id" => 0,
                        "EmploymentDetails" => self::getEmployerObject($frequency, $employerName, $employer_address, $employer_city, $employer_state, $employer_zip, $employment_duration, $employer_occupation),
                        "Type" => 1,
                        "EmploymentIncomes" => $debtoerincomes
                    ];


                    array_push($incomes, $employdetail);
                }
            }
        }

        return $incomes;
    }



    private static function checkEqualText($key, $checkWith)
    {
        $key = str_replace(' ', '', $key);
        $key = strtolower($key);
        $checkWith = str_replace(' ', '', $checkWith);
        $checkWith = strtolower($checkWith);

        return ($key === $checkWith);
    }

    private static function getUseForBudgetValue($payDate)
    {
        $UseForBudget = false;
        $date = \Carbon\Carbon::now();
        $LastMonth = $date->copy()->subMonth();
        $SecondLastMonth = $date->copy()->subMonths(2);
        $first_day_this_month_date = \Carbon\Carbon::createFromFormat('m/d/Y', $payDate);
        $isLastMonth = $first_day_this_month_date->month === $LastMonth->month;
        $isSecondLastMonth = $first_day_this_month_date->month === $SecondLastMonth->month;

        if ($isLastMonth || $isSecondLastMonth) {
            $UseForBudget = true;
        }

        return $UseForBudget;
    }

    //
    private static function getEmployerObject($frequency, $employerName, $employer_address, $employer_city, $employer_state, $employer_zip, $employment_duration, $employer_occupation)
    {
        return [
            "Title" => $employer_occupation,
            "Frequency" => (int)$frequency,
            "CustomEmploymentLength" => $employment_duration,
            "LengthOfEmployment" => (object)[],
            "EmploymentLength" => $employment_duration,
            "Employer" => [
                "Id" => 0,
                "DisplayName" => $employerName,
                "Name" => $employerName,
                "Type" => 2,
                "Address" => [
                    "Id" => 0,
                    "Type" => 0,
                    "Street1" => $employer_address,
                    "Street2" => '',
                    "City" => $employer_city,
                    "StateId" => '',
                    "StateAbb" => $employer_state,
                    "Zip" => $employer_zip,
                    "IsPreferred" => false,
                    "DoNotContact" => false,
                ],
                "Email" => [
                    "Id" => 0,
                    "Type" => 0,
                    "IsPreferred" => false,
                    "DoNotContact" => false,
                    "UseForNotifications" => false
                ],
                "Phone" => [
                    "Id" => 0,
                    "Type" => 0,
                    "IsPreferred" => false,
                    "DoNotContact" => false,
                    "UseForNotifications" => false
                ]
            ]
                ];
    }
    private static function createPaysDataArray($allEmployer, $payData)
    {
        $payData = isset($payData) && !empty($payData) ? $payData->toArray() : [];
        $newArray = [];
        if (!empty($allEmployer)) {
            foreach ($allEmployer as $key => $employer) {
                $employerPayData = array_filter($payData, function ($pay) use ($employer) {
                    return $pay['employer_id'] == $employer['id'];
                });

                $newArray[$employer['id']] = array_values($employerPayData);
            }
        }

        return $newArray;
    }

    private static function getbusinessIncomeArray($debtormonthlyincome, $frequency, $type)
    {
        $businessIncomeObj = [];
        $operation_business = 'operation_business';
        if ($type == 'spouse') {
            $operation_business = 'joints_operation_business';
        }
        if (isset($debtormonthlyincome[$operation_business]) && $debtormonthlyincome[$operation_business] == 1 && is_array($debtormonthlyincome['income_profit_loss']) && count($debtormonthlyincome['income_profit_loss']) > 0) {

            $total6month = 0;
            $debtorTotalOperatingExpense = 0;
            $totalgross = 0;
            $income_profit_loss = $debtormonthlyincome['income_profit_loss'];
            // $profit_loss_type = current($income_profit_loss['profit_loss_type']);
            $i = 1;

            if (isset($income_profit_loss['profit_loss_type'])) {
                $income_profit_loss = [$income_profit_loss];
            } else {
                $income_profit_loss = DateTimeHelper::getIncomeDescArray($income_profit_loss);
            }
            foreach ($income_profit_loss as $profit) {
                if ($i > 6) {
                    continue;
                }
                if (isset($profit['profit_loss_month']) && !empty($profit['profit_loss_month'])) {
                    $debtorTotalOperatingExpense = $debtorTotalOperatingExpense + $profit['total_expense'];
                    $totalgross = $totalgross + Helper::validate_key_value('gross_business_income', $profit, 'float');
                    $total6month = $total6month + Helper::validate_key_value('total_profit_loss', $profit, 'float');
                    $checkdate = date("Y-m-d", strtotime('01-'.Helper::validate_key_value('profit_loss_month', $profit)));
                    $object = [
                                    "Id" => 0,
                                    "Type" => 0,
                                    "CheckDate" => $checkdate,
                                    "Amount" => (float)Helper::priceFormt(Helper::validate_key_value('gross_business_income', $profit, 'float')),
                                    //"Frequency" => $frequency,
                                    "BusinessExpenses" => [
                                        ["BusinessType" => 1,  "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('', $profit, 'float')], //Ordinary and necessary expense
                                        ["BusinessType" => 2,  "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('', $profit, 'float')], //Net Employee Payroll (Other than debtor)
                                        ["BusinessType" => 3,  "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('', $profit, 'float')], //Payroll Taxes
                                        ["BusinessType" => 4,  "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('', $profit, 'float')], //Unemployment Taxes
                                        ["BusinessType" => 5,  "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('', $profit, 'float')], //Worker's Compensation
                                        ["BusinessType" => 6,  "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('', $profit, 'float')], //Other Taxes
                                        ["BusinessType" => 7,  "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('supplies_material_expense', $profit, 'float')], //Inventory Purchases (Including raw materials)
                                        ["BusinessType" => 8,  "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('', $profit, 'float')], //Purchase of Feed/Fertilizer/Seed/Spray
                                        ["BusinessType" => 9,  "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('', $profit, 'float')], //Rent (Other than debtor's principal residence)
                                        ["BusinessType" => 10, "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('utility_expense', $profit, 'float')], //Utilities
                                        ["BusinessType" => 11, "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('office_supplies_expense', $profit, 'float')], //Office Expenses and Supplies
                                        ["BusinessType" => 12, "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('rent_office_expense', $profit, 'float')], //Repairs and Maintenance
                                        ["BusinessType" => 13, "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('vehicle_expense', $profit, 'float')], //Vehicle Expenses
                                        ["BusinessType" => 14, "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('travel_expense', $profit, 'float')], //Travel and Entertainment
                                        ["BusinessType" => 15, "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('equipment_rental_expense', $profit, 'float')], //Equipment Rental and Leases
                                        ["BusinessType" => 16, "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('professional_service', $profit, 'float')], //Legal/Accounting/Other Professional Fees
                                        ["BusinessType" => 17, "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('insurance_expense', $profit, 'float')], //Insurance
                                        ["BusinessType" => 18, "Id" => 0, "Type" => 1, "CurrentMonthAmount" => (float)Helper::validate_key_value('', $profit, 'float')], //Employee Benefits (e.g., pension, medical, etc.)
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => 'Cost of goods sold', "CurrentMonthAmount" => (float)Helper::validate_key_value('cost_of_goods_sold', $profit, 'float')], // Other Expenses //Cost of goods sold
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => 'Marketing and Advertising', "CurrentMonthAmount" => (float)Helper::validate_key_value('advertising_expense', $profit, 'float')], // Other Expenses //Marketing and Advertising
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => 'Credit/Debit Card', "CurrentMonthAmount" => (float)Helper::validate_key_value('cc_expense', $profit, 'float')], // Other Expenses //Credit/Debit Card
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => 'Licenses/Permits', "CurrentMonthAmount" => (float)Helper::validate_key_value('licenses_expense', $profit, 'float')], // Other Expenses //Licenses/Permits
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => 'Postage and Delivery', "CurrentMonthAmount" => (float)Helper::validate_key_value('postage_expense', $profit, 'float')], // Other Expenses //Postage and Delivery
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => 'Subcontractor Pay', "CurrentMonthAmount" => (float)Helper::validate_key_value('subcontractor_pay', $profit, 'float')], // Other Expenses //Subcontractor Pay
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => 'Bank Fees and Interest', "CurrentMonthAmount" => (float)Helper::validate_key_value('bank_fee_and_interest', $profit, 'float')], // Other Expenses //Bank Fees and Interest
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => 'Software and Subscriptions', "CurrentMonthAmount" => (float)Helper::validate_key_value('software_and_subscription', $profit, 'float')], //Software and Subscriptions
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => Helper::validate_key_value('other_expense_name1', $profit), "CurrentMonthAmount" => (float)Helper::validate_key_value('other_1', $profit, 'float')], //Other Expenses
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => Helper::validate_key_value('other_expense_name2', $profit), "CurrentMonthAmount" => (float)Helper::validate_key_value('other_2', $profit, 'float')], //Other Expenses
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => Helper::validate_key_value('other_expense_name3', $profit), "CurrentMonthAmount" => (float)Helper::validate_key_value('other_3', $profit, 'float')], //Other Expenses
                                        ["BusinessType" => 99, "Id" => 0, "Type" => 1, "Other" => Helper::validate_key_value('other_expense_name4', $profit), "CurrentMonthAmount" => (float)Helper::validate_key_value('other_4', $profit, 'float')], //Other Expenses
                                    ]
                                ];
                    if ($profit['profit_loss_type'] == '1') {
                        for ($i = 1; $i <= 6; $i++) {
                            $newDate = $object['CheckDate'];
                            if ($i != 1) {
                                $newDate = date('Y-m-d', strtotime($newDate . ' -1 month'));
                            }
                            $object['CheckDate'] = $newDate;
                            array_push($businessIncomeObj, $object);
                        }
                    } else {
                        array_push($businessIncomeObj, $object);
                    }
                    $i++;
                }
            }
        }
        $businessName = !empty($income_profit_loss) ? (Helper::validate_key_value('name_of_business', current($income_profit_loss))) : '';
        $businessIncome = [
                                "Id" => 0,
                                "Description" => $businessName,
                                "Type" => 2,
                                "BusinessIncomes" => $businessIncomeObj
                            ];

        return $businessIncome;
    }

    private static function getIncomeArraySimilar($rentDescription, $incomeType, $incomeKeyName, $expenseKeyName, $frequency, $income, $propertyKey, $sameIncomeKey, $arrayKey)
    {

        $array = [];
        $object = [];

        if (isset($income[$propertyKey]) && ($income[$propertyKey] == 1)) {
            $propertyPerMonth = $income[$arrayKey] ?? [];
            // for same each month
            if (isset($income[$sameIncomeKey]) && ($income[$sameIncomeKey] == 1)) {
                for ($i = 1; $i < 7; $i++) {
                    $currentDate = date('01-m-Y');
                    $month = date('m-d-Y', strtotime("-$i months", strtotime($currentDate)));
                    $singleMonthArray = [
                                    "Id" => 0,
                                    "Type" => 0,
                                    "CheckDate" => $month,
                                    "Amount" => (float)current($propertyPerMonth),
                                    "Frequency" => !empty($frequency) ? $frequency : 'Monthly',

                                ];
                    if (!empty($expenseKeyName)) {
                        $singleMonthArray[$expenseKeyName] = [ [ "AssetType" => 1, "Id" => 0, "Type" => 2 ] ];
                    }
                    $object[] = $singleMonthArray;
                }
            }
            // for different each month
            if (isset($income[$sameIncomeKey]) && ($income[$sameIncomeKey] == 0)) {
                $i = 1;
                foreach ($propertyPerMonth as $index => $amount) {
                    $currentDate = date('01-m-Y');
                    $month = date('m-d-Y', strtotime("-$i months", strtotime($currentDate)));
                    $singleMonthArray = [
                                    "Id" => 0,
                                    "Type" => 0,
                                    "CheckDate" => $month,
                                    "Amount" => (float)$amount,
                                    "Frequency" => !empty($frequency) ? $frequency : 'Monthly',
                                ];
                    if (!empty($expenseKeyName)) {
                        $singleMonthArray[$expenseKeyName] = [ [ "AssetType" => 1, "Id" => 0, "Type" => 2 ] ];
                    }
                    $object[] = $singleMonthArray;
                    $i++;
                }
            }

            $array = [
                "Id" => 0,
                "Description" => $rentDescription,
                "Type" => $incomeType,
                $incomeKeyName => $object
            ];

        }


        return $array;
    }

    // private static function getrentalIncomeArray($rental_amount, $frequency){
    //     $rentalIncome = [
    //                         "Id" => 0,
    //                         "Description" => "Rental Property",
    //                         "Type" => 3,
    //                         "RealPropertyIncomes" => [
    //                             [
    //                                 "Id" => 0,
    //                                 "Type" => 0,
    //                                 "CheckDate" => date('Y-m-d H:i:s'),
    //                                 "Amount" => (float)$rental_amount,
    //                                 "Frequency" => $frequency,
    //                                 /////////////////////////////////////////////////////
    //                                 "RealPropertyExpenses" => [
    //                                     [
    //                                         "AssetType" => 1,
    //                                         "Id" => 0,
    //                                         "Type" => 2
    //                                     ]
    //                                 ]
    //                             ]
    //                         ]
    //                     ];
    //     return $rentalIncome;
    // }

    // private static function getCommonIncomeArray( $description, $type, $amount, $frequency, $otherDescription = '' ){
    //     $getCommonIncomeArray = [];
    //     if(empty($otherDescription)){
    //         $getCommonIncomeArray = [
    //                                     "Id" => 0,
    //                                     "Description" => $description,
    //                                     "Type" => $type,
    //                                     "Incomes" => [ ["Id" => 0, "Type" => 0, "CheckDate" => date('Y-m-d H:i:s'), "Amount" => $amount, "Frequency" => $frequency  ] ]
    //                                 ];
    //     }else{
    //         $getCommonIncomeArray = [
    //                                     "Id" => 0,
    //                                     "Description" => $description,
    //                                     "Type" => $type,
    //                                     "Incomes" => [ ["Id" => 0, "Type" => 0, "CheckDate" => date('Y-m-d H:i:s'), "Amount" => $amount, "Frequency" => $frequency, "Other" => $otherDescription ] ]
    //                                 ];
    //     }
    //     return $getCommonIncomeArray;
    // }

    // private static function getotherIncomeArray($other_amount){
    //     $otherIncome =  [
    //                         "Id" => 0,
    //                         "Description" => "Other Income",
    //                         "Type" => 99,
    //                         "Incomes" => [
    //                             [
    //                                 "Id" => 0,
    //                                 "Type" => 99,
    //                                 "CheckDate" => date('Y-m-d H:i:s'),
    //                                 "Amount" => (float)Helper::priceFormt($other_amount),
    //                                 "Frequency" => 5
    //                             ]
    //                         ],
    //                     ];
    //     return $otherIncome;
    // }


    private static function getHomeExpensesArray($expenses_info)
    {
        // HomeExpenses: Type: 4
        $homeExpenses = [
            // 1: Rental or home ownership expenses
            [
                "Type" => 4,
                "CurrentMonthAmount" => (float)Helper::priceFormt(Helper::validate_key_value('rent_home_mortage', $expenses_info)) ?? 0.00,
                "HomeExpenseType" => 1,
                "AreTaxesIncluded" => false,
                "IsPropertyInsuranceIncluded" => false
            ],
            // 2: Additional mortgage payments
            [
                "Type" => 4,
                "CurrentMonthAmount" => (float)Helper::priceFormt(Helper::validate_key_value('mortgage_payments_pay', $expenses_info)) ?? 0.00,
                "HomeExpenseType" => 2,
                "AreTaxesIncluded" => false,
                "IsPropertyInsuranceIncluded" => false
            ]
        ];

        return $homeExpenses;
    }

    private static function getInstallmentExpensesArray($expenses_info)
    {
        // InstallmentExpenses: Type: 5
        $installmentExpenses = [];

        if (Helper::validate_key_value('installment_payment_for_car', $expenses_info) == 1) {
            $price_array = $expenses_info['installmentpayments_price'];
            $other_value = $expenses_info['installmentpayments_value'];
            if (is_array($price_array)) {
                for ($i = 0; $i < count($price_array); $i++) {

                    if (isset($expenses_info['installmentpayments_type'][$i])) {
                        $installmentPrice = (float)Helper::priceFormt($price_array[$i]) ?? 0.00;
                        $installmentType = 1;
                        switch ($expenses_info['installmentpayments_type'][$i]) {
                            case 1: $installmentType = 1;
                                break;
                            case 2: $installmentType = 2;
                                break;
                            case 3: $installmentType = 3;
                                break;
                            case 4: $installmentType = 4;
                                break;
                            case 5: $installmentType = 5;
                                break;
                            case 6: $installmentType = 6;
                                break;
                            case 7: $installmentType = 99;
                                break;
                        }
                        if (empty($other_value[$i])) {
                            $installmentArray = [ "Type" => 3, "CurrentMonthAmount" => $installmentPrice, "InstallmentType" => $installmentType ];
                        }
                        if (!empty($other_value[$i])) {
                            $installmentArray = [ "Type" => 3, "CurrentMonthAmount" => $installmentPrice, "Other" => $other_value[$i], "InstallmentType" => $installmentType ];
                        }
                    }
                    array_push($installmentExpenses, $installmentArray);
                }
            }
        }

        return $installmentExpenses;
    }

    private static function getHouseholdExpensesArray($expenses_info, $forSpouse = false)
    {
        $householdExpenses = [];
        // Real Estate Taxes
        if (Helper::validate_key_value('real_estate_taxes', $expenses_info, "radio") == 0) {
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('estate_taxes_pay', $expenses_info, "float") ?? 0.0,              "HouseHoldType" => 1   ];
        }
        // Property, homeowner's, or renter's insurance
        if (Helper::validate_key_value('amount_include_property', $expenses_info, "radio") == 0) {
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('amount_include_property_pay', $expenses_info, "float") ?? 0.0,   "HouseHoldType" => 2   ];
        }
        // Home maintenance, repair, and upkeep expenses
        if (Helper::validate_key_value('amount_include_home', $expenses_info, "radio") == 0) {
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('amount_include_home_pay', $expenses_info, "float") ?? 0.0,       "HouseHoldType" => 3   ];
        }
        // Homeowner's association or condominium dues
        if (Helper::validate_key_value('amount_include_homeowner', $expenses_info, "radio") == 0) {
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('amount_include_homeowner_pay', $expenses_info, "float") ?? 0.0,  "HouseHoldType" => 4   ];
        }

        $utilities = (!empty($expenses_info['utilities'])) ? $expenses_info['utilities'] : [];
        // Electricity, heat, natural gas
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('electricity_heating_price', $utilities, "float") ?? 0.00,          "HouseHoldType" => 5   ];
        // Water, sewer, garbage collection
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('water_sewerl_price', $utilities, "float") ?? 0.00,                 "HouseHoldType" => 6   ];
        // Telephone, cell phone, Internet, satellite, and cable services
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('telephone_service_price', $utilities, "float") ?? 0.00,            "HouseHoldType" => 7   ];
        // Other Utilities
        if (Helper::validate_key_value('utility_bills', $expenses_info, "radio") == 1) {
            $otherutilityDescription = Helper::validate_key_value('monthly_utilities_bills', $expenses_info) ?? '';
            $otherutility = Helper::validate_key_value('monthly_utilities_value', $expenses_info) ?? [];
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => $otherutility[0] ?? 0.0, "Other" => $otherutilityDescription,                                                         "HouseHoldType" => 8   ];
        }
        // Food and housekeeping supplies
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('food_housekeeping_price', $expenses_info, "float") ?? 0.0,       "HouseHoldType" => 9   ];
        // Childcare and children's education costs
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('childcare_price', $expenses_info, "float") ?? 0.0,               "HouseHoldType" => 10  ];
        // Clothing, laundry, and dry cleaning
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('laundry_price', $expenses_info, "float") ?? 0.0,                 "HouseHoldType" => 11  ];
        // Personal care products and services
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('personal_care_price', $expenses_info, "float") ?? 0.0,           "HouseHoldType" => 12  ];
        // Medical and dental expenses
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('medical_dental_price', $expenses_info, "float") ?? 0.0,          "HouseHoldType" => 13  ];
        // Transportation: gas, maintenance, bus or train fare
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('transportation_price', $expenses_info, "float") ?? 0.0,          "HouseHoldType" => 14  ];
        // Entertainment, clubs, recreation, newspapers, magazines, and books
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('entertainment_price', $expenses_info, "float") ?? 0.0,           "HouseHoldType" => 15  ];
        // Charitable contributions and religious donations
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('charitablet_price', $expenses_info, "float") ?? 0.0,             "HouseHoldType" => 16  ];
        //  Life Insurance
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('life_insurance_price', $expenses_info, "float") ?? 0.0,          "HouseHoldType" => 17  ];
        // Health Insurance
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('health_insurance_price', $expenses_info, "float") ?? 0.0,        "HouseHoldType" => 18  ];
        // Vehicle Insurance
        $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('auto_insurance_price', $expenses_info, "float") ?? 0.0,          "HouseHoldType" => 19  ];
        // Other Insurance
        if ((!$forSpouse && Helper::validate_key_value('otherInsurance_notListed', $expenses_info, "radio") == 1) ||
            ($forSpouse && Helper::validate_key_value('otherInsNotListedSpouse', $expenses_info, "radio") == 1)) {
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('other_insurance_price', $expenses_info, "float") ?? 0.0, "Other" => Helper::validate_key_value('other_insurance_value', $expenses_info) ?? '',   "HouseHoldType" => 20  ];
        }
        // Taxes
        if (Helper::validate_key_value('taxbills_not_deducted', $expenses_info, "radio") == 1) {
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('taxbills_price', $expenses_info, "float") ?? 0.0, "Other" => Helper::validate_key_value('taxbills_value', $expenses_info) ?? '',                 "HouseHoldType" => 21  ];
        }
        // Alimony, maintenance, and support payments
        if (Helper::validate_key_value('alimony_maintenance', $expenses_info, "radio") == 1) {
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('alimony_price', $expenses_info, "float") ?? 0.0,                 "HouseHoldType" => 22  ];
        }
        // Other support payments
        if ((!$forSpouse && Helper::validate_key_value('paymentforsupport_dependents_n', $expenses_info, "radio") == 1) ||
            ($forSpouse && Helper::validate_key_value('PaymentsforadditionaldepSpouse', $expenses_info, "radio") == 1)) {
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('payments_dependents_price', $expenses_info, "float") ?? 0.0, "Other" => Helper::validate_key_value('payments_dependents_value', $expenses_info) ?? '',      "HouseHoldType" => 23  ];
        }
        // Mortgage on other property
        if ((!$forSpouse && Helper::validate_key_value('mortgage_property1', $expenses_info, "radio") == 1) ||
            ($forSpouse && Helper::validate_key_value('otherRealPropertyNotAddedSpouse', $expenses_info, "radio") == 1)) {
            $mortgage_property = (!empty($expenses_info['mortgage_property'])) ? $expenses_info['mortgage_property'] : [];
            // Other Real Estate Taxes
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('tax', $mortgage_property, "float") ?? 0.00,                        "HouseHoldType" => 24  ];
            // Other Property, homeowner's, or renter's insurance
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('rental_insurance_price', $mortgage_property, "float") ?? 0.00,     "HouseHoldType" => 25  ];
            // Other Home maintenance, repair, and upkeep expenses
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('home_maintenance_price', $mortgage_property, "float") ?? 0.00,     "HouseHoldType" => 26  ];
            // Other Homeowner's association or condominium dues
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('condominium_price', $mortgage_property, "float") ?? 0.00,          "HouseHoldType" => 27  ];
            // Mortgages on other property
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('other_real_estate_price', $mortgage_property, "float") ?? 0.00,    "HouseHoldType" => 28  ];
        }

        // Other
        if (Helper::validate_key_value('other_expense_available', $expenses_info, "radio") == 1) {
            $householdExpenses[] = [ "Type" => 3,  "CurrentMonthAmount" => Helper::validate_key_value('other_expense_price', $expenses_info, "float") ?? 0.0, "Other" => Helper::validate_key_value('other_expense_specify', $expenses_info) ?? '',  "HouseHoldType" => 99  ];
        }

        return $householdExpenses;
    }

    private static function getBusinessExpensesArray()
    {
        // BusinessExpenses: Type: 1
        $businessExpenses = [
                                // 1: Ordinary and necessary expense
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 1     ],
                                // 2: Net Employee Payroll (Other than debtor)
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 2     ],
                                // 3: Payroll Taxes
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 3     ],
                                // 4: Unemployment Taxes
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 4     ],
                                // 5: Worker's Compensation
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 5     ],
                                // 6: Other Taxes
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 6     ],
                                // 7: Inventory Purchases (Including raw materials)
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 7     ],
                                // 8: Purchase of Feed/Fertilizer/Seed/Spray
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 8     ],
                                // 9: Rent (Other than debtor's principal residence)
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 9     ],
                                // 10: Utilities
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 10    ],
                                // 11: Office Expenses and Supplies
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 11    ],
                                // 12: Repairs and Maintenance
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 12    ],
                                // 13: Vehicle Expenses
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 13    ],
                                // 14: Travel and Entertainment
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 14    ],
                                // 15: Equipment Rental and Leases
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 15    ],
                                // 16: Legal/Accounting/Other Professional Fees
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 16    ],
                                // 17: Insurance
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 17    ],
                                // 18: Employee Benefits (e.g., pension, medical, etc.)
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 18    ],
                                // 19: Payments to be Made Directly by Debtor to Secured Creditors for Pre-Petition Business Debts
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 19    ],
                                // 99: Other
                                [   "Type" => 1,    "CurrentMonthAmount" => 0.00,   "BusinessType" => 99    ]
                            ];

        return $businessExpenses;
    }

    private static function getAllDebts($final_debtstax, $client_id, $property_info, $BasicInfoPartA)
    {

        if (!empty($final_debtstax)) {
            $ssnLastFour = '';
            if (!empty($BasicInfoPartA) && !empty($BasicInfoPartA->security_number)) {
                $ssnLastFour = substr($BasicInfoPartA->security_number, -4);
            }

            $secureDetbs = self::getSecuredDebts($client_id, $property_info, $BasicInfoPartA, $final_debtstax);
            $unsecuredDebts = self::getUnSecuredDebts($final_debtstax, $secureDetbs);
            $priorityDebts = self::getPriorityDebts($final_debtstax, $unsecuredDebts, $ssnLastFour);

            return $priorityDebts;
        }

        return [];
    }

    private static function getSecuredDebts($client_id, $property_info, $BasicInfoPartA, $final_debtstax)
    {
        $propertyresident = $property_info['propertyresident']->toArray();
        $propertyvehicle = $property_info['propertyvehicle']->toArray();
        $creditors = [];
        $property = 1;

        foreach ($propertyresident as $val) {
            $propertyName = '';
            $clientAddress = '';
            if (!empty($BasicInfoPartA)) {
                $clientAddress .= $BasicInfoPartA['Address'] ?? '';
                $clientAddress .= ', ' . $BasicInfoPartA['City'] ?? '';
                $clientAddress .= ', ' . $BasicInfoPartA['state'] ?? '';
                $clientAddress .= ', ' . $BasicInfoPartA['zip'] ?? '';
            }
            if ($val['currently_lived'] && $val['loan_own_type_property'] == 1) {
                $newloan = json_decode($val['home_car_loan'], 1);
                if ($val['not_primary_address'] == 0) {
                    $propertyName = $clientAddress;
                } else {
                    $propertyName .= $val['mortgage_address'];
                    $propertyName .= ', ' . $val['mortgage_city'];
                    $propertyName .= ', ' . $val['mortgage_state'];
                    $propertyName .= ', ' . $val['mortgage_zip'];
                }

                $newloan['describe_secure_claim'] = $propertyName;
                $newloan['property_type'] = 'd';
                $newloan['debt_owned_by'] = isset($val['property_owned_by']) ? $val['property_owned_by'] : '';
                $newloan['debt_amount_due'] = $newloan['amount_own'];
                $newloan['retain_above_property'] = $val['retain_above_property'];
                $newloan['property_value'] = $val['estimated_property_value'];
                $newloan['partc_amount'] = ($newloan['amount_own'] > $val['estimated_property_value']) ? ($newloan['amount_own'] - $val['estimated_property_value']) : '0.00';
                $newloan['account_number'] = Helper::lastchar($newloan['account_number'] ?? '');
                $newloan['order'] = 1;
                $newloan['property'] = $property;

                $creditors[] = $newloan;

                if (!empty($val['home_car_loan2'])) {
                    $newloan = json_decode($val['home_car_loan2'], 1);
                    $newloan['describe_secure_claim'] = $propertyName;
                    $newloan['debt_amount_due'] = $newloan['amount_own'];
                    $newloan['property_value'] = $val['estimated_property_value'];
                    $newloan['partc_amount'] = ($newloan['amount_own'] > $val['estimated_property_value']) ? ($newloan['amount_own'] - $val['estimated_property_value']) : '0.00';
                    $newloan['account_number'] = Helper::lastchar($newloan['account_number'] ?? '');
                    $newloan['retain_above_property'] = $val['retain_above_property'];
                    $newloan['property_type'] = 'd';
                    $newloan['debt_owned_by'] = isset($val['property_owned_by']) ? $val['property_owned_by'] : '';
                    $newloan['order'] = 2;
                    $newloan['property'] = $property;
                    if (isset($newloan['additional_loan1']) && !empty($newloan['creditor_name']) && $newloan['additional_loan1'] == 1) {
                        array_push($creditors, $newloan);
                    }
                }
                if (!empty($val['home_car_loan3'])) {
                    $newloan = json_decode($val['home_car_loan3'], 1);
                    $newloan['describe_secure_claim'] = $propertyName;
                    $newloan['debt_amount_due'] = $newloan['amount_own'];
                    $newloan['property_value'] = $val['estimated_property_value'];
                    $newloan['partc_amount'] = ($newloan['amount_own'] > $val['estimated_property_value']) ? ($newloan['amount_own'] - $val['estimated_property_value']) : '0.00';
                    $newloan['retain_above_property'] = $val['retain_above_property'];
                    $newloan['property_type'] = 'd';
                    $newloan['account_number'] = Helper::lastchar($newloan['account_number'] ?? '');
                    $newloan['debt_owned_by'] = isset($val['property_owned_by']) ? $val['property_owned_by'] : '';
                    $newloan['order'] = 3;
                    $newloan['property'] = $property;
                    if (isset($newloan['additional_loan2']) && !empty($newloan['creditor_name']) && $newloan['additional_loan2'] == 1) {
                        array_push($creditors, $newloan);
                    }
                }
                $property++;
            }
        }

        $ri = 0;
        $vi = 0;
        $vehicleIndex = $property;
        foreach ($propertyvehicle as $vehicle) {
            $cod = ['codebtor_creditor_name' => $vehicle['codebtor_creditor_name'] ?? '', 'codebtor_creditor_name_addresss' => $vehicle['codebtor_creditor_name_addresss'] ?? '', 'codebtor_creditor_city' => $vehicle['codebtor_creditor_city'] ?? '', 'codebtor_creditor_state' => $vehicle['codebtor_creditor_state'] ?? '', 'codebtor_creditor_zip' => $vehicle['codebtor_creditor_zip'] ?? '', 'part' => 1];
            if ($vehicle['own_any_property'] && $vehicle['loan_own_type_property'] == 1 && isset($vehicle['vehicle_car_loan'])) {
                if (!empty($creditors)) {
                    $vehicle_name = '';
                    $loan = json_decode($vehicle['vehicle_car_loan'], 1);
                    $vehicle_name = ArrayHelper::getVehiclesTypeArray($vehicle['property_type']);
                    if ((Helper::validate_key_value('property_type', $vehicle) == 6)) {
                        $ri++;
                        $vehicle_name = $vehicle_name . " " . $ri;
                    } else {
                        $vi++;
                        $vehicle_name = $vehicle_name . " " . $vi;
                    }

                    $vehicle_name .= ', ' . $vehicle['property_year'];
                    $vehicle_name .= ', ' . $vehicle['property_make'];
                    $vehicle_name .= ', ' . $vehicle['property_model'];
                    $vehicle_name .= ', ' . $vehicle['property_mileage'];
                    $vehicle_name .= ', ' . $vehicle['property_other_info'];
                    if (!empty($vehicle['vin_number'])) {
                        $vehicle_name .= ', Vin # ' . $vehicle['vin_number'];
                    }
                    $loan['account_number'] = Helper::lastchar($loan['account_number'] ?? '');
                    $loan['describe_secure_claim'] = $vehicle_name;
                    $loan['property_type'] = 'v';
                    $loan['debt_owned_by'] = $vehicle['own_by_property'];
                    $loan['debt_amount_due'] = $loan['amount_own'];
                    $loan['property_value'] = $vehicle['property_estimated_value'];
                    $loan['partc_amount'] = ($loan['amount_own'] > $vehicle['property_estimated_value']) ? ((float)$loan['amount_own'] - (float)$vehicle['property_estimated_value']) : '0.00';
                    $loan['retain_above_property'] = $vehicle['retain_above_property'];
                    $loan['vehicle_type'] = $vehicle['property_type'];
                    $loan['order'] = 1;
                    $loan['property'] = $vehicleIndex;
                    // data for codebtor
                    $loan['property_owned_by'] = $vehicle['own_by_property'];
                    $loan['codebtor_creditor_name'] = $vehicle['codebtor_creditor_name'];
                    $loan['codebtor_creditor_name_addresss'] = $vehicle['codebtor_creditor_name_addresss'];
                    $loan['codebtor_creditor_city'] = $vehicle['codebtor_creditor_city'];
                    $loan['codebtor_creditor_state'] = $vehicle['codebtor_creditor_state'];
                    $loan['codebtor_creditor_zip'] = $vehicle['codebtor_creditor_zip'];

                    if (!empty($loan['creditor_name'])) {
                        array_push($creditors, $loan);
                    }
                } else {
                    $vehicle_name2 = '';
                    $loan = json_decode($vehicle['vehicle_car_loan'], 1);
                    $vehicle_name2 = ArrayHelper::getVehiclesTypeArray($vehicle['property_type']);
                    if ((Helper::validate_key_value('property_type', $vehicle) == 6)) {
                        $ri++;
                        $vehicle_name2 = $vehicle_name2 . " " . $ri;
                    } else {
                        $vi++;
                        $vehicle_name2 = $vehicle_name2 . " " . $vi;
                    }

                    $vehicle_name2 .= ', ' . $vehicle['property_year'];
                    $vehicle_name2 .= ', ' . $vehicle['property_make'];
                    $vehicle_name2 .= ', ' . $vehicle['property_model'];
                    $vehicle_name2 .= ', ' . $vehicle['property_mileage'];
                    $vehicle_name2 .= ', ' . $vehicle['property_other_info'];
                    if (!empty($vehicle['vin_number'])) {
                        $vehicle_name2 .= ', Vin # ' . $vehicle['vin_number'];
                    }
                    $loan['describe_secure_claim'] = $vehicle_name2;
                    $loan['property_type'] = 'v';
                    $loan['account_number'] = Helper::lastchar($loan['account_number'] ?? '');
                    $loan['debt_owned_by'] = $vehicle['own_by_property'];
                    $loan['debt_amount_due'] = $loan['amount_own'];
                    $loan['retain_above_property'] = $vehicle['retain_above_property'];
                    $loan['property_value'] = $vehicle['property_estimated_value'];
                    $loan['partc_amount'] = ($loan['amount_own'] > $vehicle['property_estimated_value']) ? ((float)$loan['amount_own'] - (float)$vehicle['property_estimated_value']) : '0.00';
                    $loan['vehicle_type'] = $vehicle['property_type'];
                    $loan['order'] = 1;
                    $loan['property'] = $vehicleIndex;
                    $creditors[] = $loan;
                }
                $vehicleIndex++;
            }

        }

        $additionaCreditor = [];
        $additional_liens = (Helper::validate_key_value('additional_liens', $final_debtstax) == 1) ? $final_debtstax['additional_liens_data'] : [];
        if (!empty($additional_liens)) {
            foreach ($additional_liens as $additional) {
                $additionaCreditor = [  'creditor_name' => $additional['domestic_support_name'] ?? '',
                                        'creditor_name_addresss' => $additional['domestic_support_address'] ?? '',
                                        'creditor_city' => $additional['domestic_support_city'] ?? '',
                                        'creditor_state' => $additional['creditor_state'] ?? '',
                                        'creditor_zip' => $additional['domestic_support_zipcode'] ?? '',
                                        'account_number' => Helper::lastchar($additional['additional_liens_account'] ?? ''),
                                        'debt_incurred_date' => $additional['additional_liens_date'] ?? '',
                                        'debt_amount_due' => $additional['additional_liens_due'] ?? '',
                                        'describe_secure_claim' => $additional['describe_secure_claim'] ?? '',
                                        'debt_owned_by' => $additional['owned_by'] ?? '',
                                         // data for codebtor
                                        "property_owned_by" => $additional['owned_by'] ?? '',
                                        "codebtor_creditor_name" => Helper::validate_key_value('codebtor_creditor_name', $additional),
                                        "codebtor_creditor_name_addresss" => Helper::validate_key_value('codebtor_creditor_name_addresss', $additional),
                                        "codebtor_creditor_city" => Helper::validate_key_value('codebtor_creditor_city', $additional),
                                        "codebtor_creditor_state" => Helper::validate_key_value('codebtor_creditor_state', $additional),
                                        "codebtor_creditor_zip" => Helper::validate_key_value('codebtor_creditor_zip', $additional),
                                    ];
                array_push($creditors, $additionaCreditor);
            }
        }


        $debts = [];
        $credits = [];
        if (!empty($creditors)) {
            foreach ($creditors as $tax) {
                $arrearage_amount = '';
                if (array_key_exists("vehicle_type", $tax)) {
                    $arrearage_amount = Helper::validate_key_value('past_due_amount', $tax, 'float');
                } else {
                    $arrearage_amount = Helper::validate_key_value('due_payment', $tax, 'float');
                }
                $credit = [
                    'address_line2' => '',
                    'address_line1' => Helper::validate_key_value('creditor_name_addresss', $tax),
                    'creditor_name' => Helper::validate_key_value('creditor_name', $tax),
                    'state' => Helper::validate_key_value('creditor_state', $tax),
                    'city' => Helper::validate_key_value('creditor_city', $tax),
                    'zip' => Helper::validate_key_value('creditor_zip', $tax),
                    'type_desc' => Helper::validate_key_value('describe_secure_claim', $tax),
                    'account_number' => Helper::validate_key_value('account_number', $tax),
                    'year' => Helper::validate_key_value('debt_incurred_date', $tax),
                    'property_value' => Helper::validate_key_value('property_value', $tax, 'float'),
                    'arrearage_amount' => $arrearage_amount,
                    'total_claim' => Helper::validate_key_value('amount_own', $tax, 'float'),
                    'monthly_payment' => Helper::validate_key_value('monthly_payment', $tax, 'float'),
                    'order' => Helper::validate_key_value('order', $tax),
                    'property' => Helper::validate_key_value('property', $tax),
                    'who_ensured_debt' => Helper::validate_key_value('property_owned_by', $tax),
                     // data for codebtor
                    "property_owned_by" => Helper::validate_key_value('property_owned_by', $tax, 'radio'),
                    "codebtor_creditor_name" => Helper::validate_key_value('codebtor_creditor_name', $tax),
                    "codebtor_creditor_name_addresss" => Helper::validate_key_value('codebtor_creditor_name_addresss', $tax),
                    "codebtor_creditor_city" => Helper::validate_key_value('codebtor_creditor_city', $tax),
                    "codebtor_creditor_state" => Helper::validate_key_value('codebtor_creditor_state', $tax),
                    "codebtor_creditor_zip" => Helper::validate_key_value('codebtor_creditor_zip', $tax),
                ];
                array_push($credits, $credit);
            }
        }
        // resident, vehicle, secured
        $debts = [];
        $debtId = 1;
        foreach ($credits as $debt) {
            $duedate = $debt['year'] ?? 0;
            $date = isset($debt['year']) && !empty($debt['year']) ? explode('/', $debt['year']) : [];
            if (isset($date[2]) && !empty($date[2])) {
                $duedate = $date[2];
            }
            $dbts = [
                'Id' => $debtId,
                "Type" => 1,
                    // "Value" => (float)Helper::validate_key_value('property_value',$debt,'float',false),
                "Value" => (float)Helper::validate_key_value('total_claim', $debt, 'float', false),
                "Description" => Helper::validate_key_value('type_desc', $debt),
                "AcquiredOn" => Helper::validate_key_value('year', $debt),
                "AccNo" => Helper::validate_key_value('account_number', $debt),
                "InterestRate" => 0.00,
                    // "ArrearageValue" => (float)Helper::validate_key_value('total_claim',$debt,'float',false),
                "ArrearageValue" => (float)Helper::validate_key_value('arrearage_amount', $debt, 'float', false),
                "PaymentAmount" => (float)Helper::validate_key_value('monthly_payment', $debt, 'float', false),
                "PaymentDueDate" => (int)$duedate
            ];
            $creditor = [
                "Name" => Helper::validate_key_value('creditor_name', $debt),
                "Address" => [
                "Street1" => Helper::validate_key_value('address_line1', $debt),
                "Street2" => Helper::validate_key_value('address_line2', $debt),
                "City" => Helper::validate_key_value('city', $debt),
                "Zip" => Helper::validate_key_value('zip', $debt),
                "StateId" => 0,
                "StateAbb" => Helper::validate_key_value('state', $debt)
                ],
                "Email" => [ "Value" => "" ],
                "Phone" => [ "Value" => "" ]
            ];


            $debts[] = [
                "Debt" => $dbts,
                "Liens" => [
                    [
                    "AmountChanged" => true,
                    "AutoCalculateChanged" => true,
                    "AssetOrder" => $debt['order'] ?? 0,
                    "DebtId" => $debtId ?? 0,
                    "AssetId" => $debt['property'] ?? 0,
                    "AutoCalculate" => true
                    ]
                ],
                "Creditor" => $creditor
                    ];

            if (in_array(Helper::validate_key_value('property_owned_by', $debt, 'radio'), Helper::OWNBY_FORM_VALUES)) {
                $codebtorArray = [
                    'Name' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name', $debt)) ,
                    'Address1' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name_addresss', $debt)) ,
                    'City' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_city', $debt)) ,
                    'State' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_state', $debt)) ,
                    'Zip' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_zip', $debt)) ,
                    'DebtId' => $debtId ,
                    'LPId' => ''
                ];
                self::addDataToLiableParties($codebtorArray);
            }
            $debtId++;
        }

        return $debts;
    }

    private static function getUnSecuredDebts($final_debtstax, $secured)
    {
        $debtTaxes = [];
        if (!empty($final_debtstax['debt_tax']) && count($final_debtstax['debt_tax']) > 0) {
            $debtTaxes = $final_debtstax['debt_tax'];
        }
        $collect_type = ArrayHelper::getDebtCardSelectionsForAttorney();
        $taxes = [];
        $debtId = count($secured);
        foreach ($debtTaxes as $tax) {
            $taxObj = [
                    'address_line2' => '',
                    'address_line1' => Helper::validate_key_value('creditor_information', $tax),
                    'creditor_name' => Helper::validate_key_value('creditor_name', $tax),
                    'state' => Helper::validate_key_value('creditor_state', $tax),
                    'city' => Helper::validate_key_value('creditor_city', $tax),
                    'zip' => Helper::validate_key_value('creditor_zip', $tax),
                    'type' => Helper::validate_key_value('cards_collections', $tax, 'radio'),
                    'type_desc' => $collect_type[Helper::validate_key_value('cards_collections', $tax, 'radio')] ?? '',
                    'account_number' => Helper::validate_key_value('amount_number', $tax),
                    'year' => Helper::validate_key_value('debt_date', $tax),
                    'total_claim' => Helper::validate_key_value('amount_owned', $tax, 'float'),
                    'who_ensured_debt' => Helper::validate_key_value('owned_by', $tax),
                        // data for codebtor
                    'property_owned_by' => Helper::validate_key_value('owned_by', $tax),
                    'codebtor_creditor_name' => Helper::validate_key_value('codebtor_creditor_name', $tax),
                    'codebtor_creditor_name_addresss' => Helper::validate_key_value('codebtor_creditor_name_addresss', $tax),
                    'codebtor_creditor_city' => Helper::validate_key_value('codebtor_creditor_city', $tax),
                    'codebtor_creditor_state' => Helper::validate_key_value('codebtor_creditor_state', $tax),
                    'codebtor_creditor_zip' => Helper::validate_key_value('codebtor_creditor_zip', $tax),
                ];

            if (Helper::validate_key_value('original_creditor', $tax, 'radio') == '0') {
                $taxObj['original_creditor'] = Helper::validate_key_value('original_creditor', $tax, 'radio');
                $taxObj['second_creditor_name'] = Helper::validate_key_value('second_creditor_name', $tax);
            }
            array_push($taxes, $taxObj);
        }
        $debts = [];
        if (!empty($taxes)) {
            foreach ($taxes as $debt) {
                $debtId++;
                $duedate = $debt['year'] ?? 0;
                $date = isset($debt['year']) && !empty($debt['year']) ? explode('/', $debt['year']) : [];
                if (isset($date[2]) && !empty($date[2])) {
                    $duedate = $date[2];
                }
                $debts = [
                    "SpecialTreatmentType" => (Helper::validate_key_value('type', $debt) == 5) ? 1 : 99,
                    "Debt" => [
                        "Id" => $debtId,
                        "Type" => 2,

                        "Value" => (float)Helper::validate_key_value('total_claim', $debt, 'float', false),
                        "Description" => Helper::validate_key_value('type_desc', $debt),
                        "AcquiredOn" => Helper::validate_key_value('year', $debt),
                        "AccNo" => Helper::validate_key_value('account_number', $debt),
                        "InterestRate" => 0.00,
                        "PaymentAmount" => (float)Helper::validate_key_value('total_claim', $debt, 'float', false),
                        "PaymentDueDate" => (int)$duedate
                    ],
                        "Creditor" => [
                            "Name" => Helper::validate_key_value('creditor_name', $debt),
                            "Address" => [
                            "Street1" => Helper::validate_key_value('address_line1', $debt),
                            "Street2" => Helper::validate_key_value('address_line2', $debt),
                            "City" => Helper::validate_key_value('city', $debt),
                            "Zip" => Helper::validate_key_value('zip', $debt),
                            "StateId" => 0,
                            "StateAbb" => Helper::validate_key_value('state', $debt)
                            ],
                            "Email" => [ "Value" => "" ],
                            "Phone" => [ "Value" => "" ]
                        ]
                    ];

                if (Helper::validate_key_value('type', $debt) != 5) {
                    $debts['NatureOfLienOther'] = Helper::validate_key_value('type_desc', $debt);
                }
                if (Helper::validate_key_value('original_creditor', $debt, 'radio') == '0') {
                    $debts['RelationData']['Id'] = $debtId;
                    $debts['RelationData']['original_creditor'] = Helper::validate_key_value('original_creditor', $debt, 'radio');
                    $debts['RelationData']['second_creditor_name'] = Helper::validate_key_value('second_creditor_name', $debt);
                }
                if (in_array(Helper::validate_key_value('property_owned_by', $debt, 'radio'), Helper::OWNBY_FORM_VALUES)) {
                    $codebtorArray = [
                        'Name' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name', $debt)) ,
                        'Address1' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name_addresss', $debt)) ,
                        'City' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_city', $debt)) ,
                        'State' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_state', $debt)) ,
                        'Zip' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_zip', $debt)) ,
                        'DebtId' => $debtId ,
                        'LPId' => ''
                    ];
                    self::addDataToLiableParties($codebtorArray);
                }
                array_push($secured, $debts);
            }
        }

        return $secured;
    }

    private static function getPriorityDebts($final_debtstax, $unsec, $ssnLastFour)
    {
        //2.1 only
        $taxes = [];
        if (isset($final_debtstax['back_tax_own']) && is_array($final_debtstax['back_tax_own'])) {
            foreach ($final_debtstax['back_tax_own'] as $backtaxowned) {
                $statecode = Helper::validate_key_value('debt_state', $backtaxowned);
                if (!empty($statecode)) {
                    $btitem = AddressHelper::getStateTaxAddress($statecode);
                    $tax = [
                        'address_line2' => $btitem['add2'] ?? '',
                        'address_line1' => $btitem['add1'] ?? '',
                        'creditor_name' => $btitem['address_heading'] ?? '',
                        'state' => $statecode,
                        'city' => $btitem['city'] ?? '',
                        'zip' => $btitem['zip'] ?? '',
                        'type_desc' => "State Back Taxes",
                        'account_number' => $ssnLastFour ?? '',
                        'year' => DateTimeHelper::convertYearsToEndOfYear(Helper::validate_key_value('tax_whats_year', $backtaxowned)),
                        'total_claim' => Helper::validate_key_value('tax_total_due', $backtaxowned, 'float'),
                        'priority_amount' => Helper::validate_key_value('tax_total_due', $backtaxowned, 'float'),
                        'unpariority_amount' => Helper::validate_key_value('tax_total_due', $backtaxowned, 'float'),
                        'who_ensured_debt' => Helper::validate_key_value('owned_by', $backtaxowned),
                        // data for codebtor
                        'property_owned_by' => Helper::validate_key_value('owned_by', $backtaxowned),
                        'codebtor_creditor_name' => Helper::validate_key_value('codebtor_creditor_name', $backtaxowned),
                        'codebtor_creditor_name_addresss' => Helper::validate_key_value('codebtor_creditor_name_addresss', $backtaxowned),
                        'codebtor_creditor_city' => Helper::validate_key_value('codebtor_creditor_city', $backtaxowned),
                        'codebtor_creditor_state' => Helper::validate_key_value('codebtor_creditor_state', $backtaxowned),
                        'codebtor_creditor_zip' => Helper::validate_key_value('codebtor_creditor_zip', $backtaxowned),
                        ];
                    array_push($taxes, $tax);

                }
            }
        }
        if (Helper::validate_key_value('tax_owned_irs', $final_debtstax) == 1 && isset($final_debtstax['tax_irs_state']) && !empty($final_debtstax['tax_irs_state'])) {
            //2.1 only
            $statecode = Helper::validate_key_value('tax_irs_state', $final_debtstax);
            $btitem = Helper::irsState($statecode);
            $tax = [
                 'creditor_name' => $btitem['address_heading'] ?? '',
                 'address_line1' => $btitem['add1'] ?? '',
                 'address_line2' => $btitem['add2'] ?? '',
                 'city' => $btitem['city'] ?? '',
                 'state' => $statecode,
                 'zip' => $btitem['zip'] ?? '',
                 'type_desc' => "IRS Tax",
                 'account_number' => $ssnLastFour ?? '',
                 'year' => DateTimeHelper::convertYearsToEndOfYear(Helper::validate_key_value('tax_irs_whats_year', $final_debtstax)),
                 'total_claim' => Helper::validate_key_value('tax_irs_total_due', $final_debtstax, 'float'),
                 'priority_amount' => Helper::validate_key_value('tax_irs_total_due', $final_debtstax, 'float'),
                 'unpariority_amount' => Helper::validate_key_value('tax_irs_total_due', $final_debtstax, 'float'),
                 'who_ensured_debt' => Helper::validate_key_value('tax_irs_owned_by', $final_debtstax),
                 // data for codebtor
                 'property_owned_by' => Helper::validate_key_value('tax_irs_owned_by', $final_debtstax),
                 'codebtor_creditor_name' => Helper::validate_key_value('tax_irs_codebtor_creditor_name', $final_debtstax),
                 'codebtor_creditor_name_addresss' => Helper::validate_key_value('tax_irs_codebtor_creditor_name_addresss', $final_debtstax),
                 'codebtor_creditor_city' => Helper::validate_key_value('tax_irs_codebtor_creditor_city', $final_debtstax),
                 'codebtor_creditor_state' => Helper::validate_key_value('tax_irs_codebtor_creditor_state', $final_debtstax),
                 'codebtor_creditor_zip' => Helper::validate_key_value('tax_irs_codebtor_creditor_zip', $final_debtstax),
                ];
            array_push($taxes, $tax);
        }


        if (Helper::validate_key_value('domestic_support', $final_debtstax) == 1 && !empty($final_debtstax['domestic_tax']) && count($final_debtstax['domestic_tax']) > 0) {
            //2.1 only
            foreach ($final_debtstax['domestic_tax'] as $efdomestic) {
                $statecode = Helper::validate_key_value('domestic_address_state', $efdomestic);
                $tax = [
                    'creditor_name' => Helper::validate_key_value('domestic_support_name', $efdomestic),
                     'address_line1' => Helper::validate_key_value('domestic_support_address', $efdomestic),
                     'address_line2' => '',
                     'city' => Helper::validate_key_value('domestic_support_city', $efdomestic),
                     'state' => Helper::validate_key_value('creditor_state', $efdomestic),
                     'zip' => Helper::validate_key_value('domestic_support_zipcode', $efdomestic),
                     'year' => Helper::validate_key_value('tax_whats_year', $efdomestic),
                     'account_number' => Helper::validate_key_value('domestic_support_account', $efdomestic),
                     'total_claim' => Helper::validate_key_value('domestic_support_past_due', $efdomestic, 'float'),
                     'priority_amount' => Helper::validate_key_value('domestic_support_monthlypay', $efdomestic, 'float'),
                     'unpariority_amount' => Helper::validate_key_value('domestic_support_monthlypay', $efdomestic, 'float'),
                     'who_ensured_debt' => Helper::validate_key_value('owned_by', $efdomestic),
                     'type_desc' => "Domestic support Tax",
                    ];
                array_push($taxes, $tax);
            }
        }

        $debts = [];
        $debtId = count($unsec);
        foreach ($taxes as $debt) {
            $debtId++;
            $duedate = $debt['year'] ?? 0;
            $date = isset($debt['year']) && !empty($debt['year']) ? explode('/', $debt['year']) : [];
            if (isset($date[2]) && !empty($date[2])) {
                $duedate = $date[2];
            }
            $debts = [

                "Debt" => [
                    "Id" => $debtId,
                    "Type" => 3,
                    "Value" => (float)Helper::validate_key_value('total_claim', $debt, 'float', false),
                    "Description" => Helper::validate_key_value('type_desc', $debt),
                    "AcquiredOn" => Helper::validate_key_value('year', $debt),
                    "AccNo" => Helper::validate_key_value('account_number', $debt),
                    "InterestRate" => 0.00,
                    "PaymentAmount" => (float)0.00,
                    // "PaymentAmount" => (float)Helper::validate_key_value('total_claim',$debt,'float',false),
                    "PaymentDueDate" => (int)$duedate
                ],
                    "Creditor" => [
                        "Name" => Helper::validate_key_value('creditor_name', $debt),
                        "Address" => [
                        "Street1" => Helper::validate_key_value('address_line1', $debt),
                        "Street2" => Helper::validate_key_value('address_line2', $debt),
                        "City" => Helper::validate_key_value('city', $debt),
                        "Zip" => Helper::validate_key_value('zip', $debt),
                        "StateId" => 0,
                        "StateAbb" => Helper::validate_key_value('state', $debt)
                        ],
                        "Email" => [ "Value" => "" ],
                        "Phone" => [ "Value" => "" ]
                    ]
                ];
            if (in_array(Helper::validate_key_value('property_owned_by', $debt, 'radio'), Helper::OWNBY_FORM_VALUES)) {
                $codebtorArray = [
                    'Name' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name', $debt)) ,
                    'Address1' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name_addresss', $debt)) ,
                    'City' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_city', $debt)) ,
                    'State' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_state', $debt)) ,
                    'Zip' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_zip', $debt)) ,
                    'DebtId' => $debtId ,
                    'LPId' => ''
                ];
                self::addDataToLiableParties($codebtorArray);
            }
            array_push($unsec, $debts);
        }

        return $unsec;

    }
    // User Object Function
    private static function getPrimaryClient($client_id, $BasicInfoPartA, $basicInfo_AnyOtherName)
    {

        $user = \App\Models\User::where("id", $client_id)->first();
        $ssn1 = Helper::validate_key_value('security_number', $BasicInfoPartA);
        $userObj['PrimaryClient'] = [
            "Address" => [
                "Street1" => Helper::validate_key_value('Address', $BasicInfoPartA),
                "City" => Helper::validate_key_value('City', $BasicInfoPartA),
                "Zip" => Helper::validate_key_value('zip', $BasicInfoPartA),
                "StateId" => 0,
                "StateAbb" => Helper::validate_key_value('state', $BasicInfoPartA)
            ],

            "Email" => ['Value' => $user['email']],
            "Phone" => ['Value' => Helper::validate_key_value('cell', $basicInfo_AnyOtherName)],
            "DateOfBirth" => Helper::validate_key_value('date_of_birth', $basicInfo_AnyOtherName),
            "SocialNumber" => str_replace("-", "", $ssn1),
            "PersonName" => ['FirstName' => Helper::validate_key_value('name', $BasicInfoPartA),'LastName' => Helper::validate_key_value('last_name', $BasicInfoPartA),'MiddleName' => Helper::validate_key_value('middle_name', $BasicInfoPartA)]
        ];

        return  $userObj;
    }

    // FilingPerson Object Function
    private static function getJointClient($client_id, $BasicInfoPartB)
    {
        $ssn = Helper::validate_key_value('social_security_number', $BasicInfoPartB);
        $userObj['JointClient'] = [
            "Address" => [
                "Street1" => Helper::validate_key_value('Address', $BasicInfoPartB),
                "City" => Helper::validate_key_value('City', $BasicInfoPartB),
                "Zip" => Helper::validate_key_value('zip', $BasicInfoPartB),
                "StateId" => 0,
                "StateAbb" => Helper::validate_key_value('state', $BasicInfoPartB)
            ],

            "Email" => ['Value' => ''],
            "Phone" => ['Value' => Helper::validate_key_value('part2_phone', $BasicInfoPartB)],
            "DateOfBirth" => Helper::validate_key_value('part2_dob', $BasicInfoPartB),
            "SocialNumber" => str_replace("-", "", $ssn),
            "PersonName" => ['FirstName' => Helper::validate_key_value('name', $BasicInfoPartB),'LastName' => Helper::validate_key_value('last_name', $BasicInfoPartB),'MiddleName' => Helper::validate_key_value('middle_name', $BasicInfoPartB)]
        ];

        return  $userObj;
    }

    private static function getSepearteClient()
    {
        $userObj['NonFilingSpouse'] = [
            "Address" => [
                "Street1" => '',
                "City" => '',
                "Zip" => '',
                "StateId" => 0,
                "StateAbb" => ''
            ],

            "Email" => ['Value' => ''],
            "Phone" => ['Value' => ''],
            "DateOfBirth" => '',
            "SocialNumber" => '',
            "PersonName" => ['FirstName' => "Non-Filing",'LastName' => 'Spouse','MiddleName' => '']
        ];

        return  $userObj;
    }



    // OwnedRealEstateProperties Object Function
    private static function getOwnedRealEstatePropertiesObject($property_info_resident, $BasicInfoPartA)
    {
        $ownedRealEstateProperties = [];
        $index = 1;
        foreach ($property_info_resident as $propertyResident) {
            if ($propertyResident['currently_lived']) {

                if ($propertyResident['not_primary_address'] == 0) {
                    $clientAddress1 = Helper::validate_key_value('Address', $BasicInfoPartA);
                    $clientCity = Helper::validate_key_value('City', $BasicInfoPartA);
                    $clientState = Helper::validate_key_value('state', $BasicInfoPartA);
                    $clientZip = Helper::validate_key_value('zip', $BasicInfoPartA);

                } else {
                    $clientAddress1 = Helper::validate_key_value('mortgage_address', $propertyResident);
                    $clientCity = Helper::validate_key_value('mortgage_city', $propertyResident);
                    $clientState = Helper::validate_key_value('mortgage_state', $propertyResident);
                    $clientZip = Helper::validate_key_value('mortgage_zip', $propertyResident);
                }
                $propertyType = Helper::validate_key_value('property', $propertyResident);
                $type = "IsSingleFamily";
                if ($propertyType == 1) {
                    $type = "IsSingleFamily";
                }
                if ($propertyType == 2) {
                    $type = "IsDuplex";
                }
                if ($propertyType == 3) {
                    $type = "IsCondo";
                }
                if ($propertyType == 4) {
                    $type = "IsManufactured";
                }
                if ($propertyType == 5) {
                    $type = "IsLand";
                }
                if ($propertyType == 6) {
                    $type = "IsInvestmentProperty";
                }
                if ($propertyType == 7) {
                    $type = "IsTimeshare";
                }
                if ($propertyType == 8) {
                    $type = "IsOther";
                }
                $ownedRealEstateProperties[] =
                    [
                        "NatureOfInterest" => "[Nature of Interest]",
                        "Asset" => [
                            "Id" => $index,
                            "CategoryId" => 1,
                            "Type" => 1,
                            $type => 1,
                            "Value" => (float)Helper::validate_key_value('estimated_property_value', $propertyResident),
                            "BookValue" => 0.00,
                            "Description" => "Home",
                            "AcquiredOn" => "",
                            "PropertyAddress" => [
                                "Street1" => $clientAddress1,
                                "Street2" => "",
                                "City" => $clientCity,
                                "StateAbb" => $clientState,
                                "Zip" => $clientZip,
                                "StateId" => ''
                            ],
                            "HWJC" => "N/A"
                        ]
                    ];
                $index++;
            }

        }

        return $ownedRealEstateProperties;
    }

    // OwnedVehicles Object Function
    private static function getOwnedVehiclesObject($propertyvehicle, $propertyIndex)
    {
        $OwnedVehicles = [];
        $vehicleIndex = $propertyIndex + 1;
        foreach ($propertyvehicle as $propertyVec) {
            if (Helper::validate_key_value('own_any_property', $propertyVec) == 1) {
                $loan = [];
                if (($propertyVec['loan_own_type_property'] == 1) && isset($propertyVec['vehicle_car_loan'])) {
                    $loan = json_decode($propertyVec['vehicle_car_loan'], 1);
                }
                $OwnedVehicles[] = ["NatureOfInterest" => "[Nature of Interest]",
                        "Asset" => [
                            "Id" => $vehicleIndex,
                            "CategoryId" => 2,
                            "Type" => Helper::validate_key_value('property_type', $propertyVec) == 1 ? 3 : 4,
                            "Value" => (float)Helper::validate_key_value('property_estimated_value', $propertyVec),
                            "BookValue" => 0.00,
                            "ExtendedDescription" => Helper::validate_key_value('vin_number', $propertyVec),
                            "AcquiredOn" => Helper::validate_key_value('debt_incurred_date', $loan),
                            "Make" => Helper::validate_key_value('property_make', $propertyVec),
                            "Model" => Helper::validate_key_value('property_model', $propertyVec),
                            "Mileage" => Helper::validate_key_value('property_mileage', $propertyVec),
                            "Year" => Helper::validate_key_value('property_year', $propertyVec),
                            "HWJC" => "N/A"
                        ]
                    ];
                $vehicleIndex++;
            }
        }

        return $OwnedVehicles;
    }



    // HouseholdItems Object Function
    private static function getHouseholdItemsObject($property_info, $propAsstets = [], $assetsIndex, $client_id)
    {
        $assetsIndex = $assetsIndex + 1;
        $propertyhousehold = $property_info['propertyhousehold'];

        if (!empty($propertyhousehold)) {
            foreach ($propertyhousehold as $household) {
                $type_data = json_decode($household['type_data'], 1);
                if (!empty($type_data)) {
                    $household['description'] = (!empty($type_data[0])) ? $type_data[0] : "";
                    $household['property_value'] = (!empty($type_data[1])) ? $type_data[1] : "";
                    $household['owned_by'] = (!empty($type_data['owned_by'])) ? $type_data['owned_by'] : "";
                }
                $household['array_data'] = (!empty($type_data)) ? $type_data : [];
                unset($household['type_data']);
                $hholdfinal[$household['type']] = $household;
            }
        }
        $financialassets = $property_info['financialassets'];
        if (!empty($financialassets)) {
            foreach ($financialassets as $financial) {
                $type_data = json_decode($financial['type_data'], 1);
                if (!empty($type_data)) {
                    $financial['account_type'] = (!empty($type_data['account_type'])) ? $type_data['account_type'] : "";

                    if ($financial['type'] == "retirement_pension" || $financial['type'] == "security_deposits") {
                        $financial['account_type'] = (!empty($type_data['type_of_account'])) ? $type_data['type_of_account'] : "";
                    }

                    $financial['description'] = (!empty($type_data['description'])) ? $type_data['description'] : "";
                    $financial['property_value'] = (isset($type_data['property_value']) && !empty($type_data['property_value'])) ? $type_data['property_value'] : "";
                    $financial['owned_by'] = (!empty($type_data['owned_by'])) ? $type_data['owned_by'] : "";

                    if (in_array($financial['type'], ['bank','brokerage_account'])) {
                        $financial['last_4_digits'] = (!empty($type_data['last_4_digits'])) ? $type_data['last_4_digits'] : "";
                    }
                    if ($financial['type'] == "tax_refunds") {
                        $financial['year'] = (!empty($type_data['year'])) ? $type_data['year'] : "";
                    }
                    if ($financial['type'] == "unpaid_wages") {
                        $financial['owed_type'] = (isset($type_data['owed_type']) && !empty($type_data['owed_type'])) ? $type_data['owed_type'] : "";
                        $financial['data_for'] = (isset($type_data['data_for']) && !empty($type_data['data_for'])) ? $type_data['data_for'] : "";
                        $financial['monthly_amount'] = (isset($type_data['monthly_amount']) && !empty($type_data['monthly_amount'])) ? $type_data['monthly_amount'] : "";
                        $financial['unknown'] = (isset($type_data['unknown']) && !empty($type_data['unknown'])) ? $type_data['unknown'] : "";
                    }
                    if ($financial['type'] == "life_insurance") {
                        $financial['description'] = (!empty($type_data['type_of_account'])) ? $type_data['type_of_account'] : "";
                        $financial['beneficiary'] = (!empty($type_data['description'])) ? $type_data['description'] : "";
                        $financial['current_value'] = (isset($type_data['current_value']) && !empty($type_data['current_value'])) ? $type_data['current_value'] : "";
                        $financial['unknown'] = (isset($type_data['unknown']) && !empty($type_data['unknown'])) ? $type_data['unknown'] : "";
                    }
                    if ($financial['type'] == "insurance_policies") {
                        $financial['description'] = (!empty($type_data['type_of_account'])) ? $type_data['type_of_account'] : "";
                        $financial['beneficiary'] = (!empty($type_data['description'])) ? $type_data['description'] : "";
                        $financial['unknown'] = (isset($type_data['unknown']) && !empty($type_data['unknown'])) ? $type_data['unknown'] : "";
                    }
                }
                unset($financial['type_data']);
                $financial_assests[$financial['type']] = $financial;
            }
        }

        $household_goods = (!empty($hholdfinal['household_goods_furnishings'])) ? $hholdfinal['household_goods_furnishings'] : [];

        $electronics = (!empty($hholdfinal['electronics'])) ? $hholdfinal['electronics'] : [];
        $collectibles = (!empty($hholdfinal['collectibles'])) ? $hholdfinal['collectibles'] : [];
        $sports = (!empty($hholdfinal['sports'])) ? $hholdfinal['sports'] : [];
        $firearms = (!empty($hholdfinal['firearms'])) ? $hholdfinal['firearms'] : [];
        $clothing = (!empty($hholdfinal['clothing'])) ? $hholdfinal['clothing'] : [];
        $jewelry = (!empty($hholdfinal['jewelry'])) ? $hholdfinal['jewelry'] : [];
        $pets = (!empty($hholdfinal['pets'])) ? $hholdfinal['pets'] : [];
        $health_aids = (!empty($hholdfinal['health_aids'])) ? $hholdfinal['health_aids'] : [];

        $cash = (!empty($financial_assests['cash'])) ? $financial_assests['cash'] : [];
        $bank = (!empty($financial_assests['bank'])) ? $financial_assests['bank'] : [];
        $venmo_paypal_cash = (!empty($financial_assests['venmo_paypal_cash'])) ? $financial_assests['venmo_paypal_cash'] : [];
        $brokerage_account = (!empty($financial_assests['brokerage_account'])) ? $financial_assests['brokerage_account'] : [];
        $mutual_funds = (!empty($financial_assests['mutual_funds'])) ? $financial_assests['mutual_funds'] : [];
        $traded_stocks = (!empty($financial_assests['traded_stocks'])) ? $financial_assests['traded_stocks'] : [];
        $government_corporate_bonds = (!empty($financial_assests['government_corporate_bonds'])) ? $financial_assests['government_corporate_bonds'] : [];
        $retirement_pension = (!empty($financial_assests['retirement_pension'])) ? $financial_assests['retirement_pension'] : [];
        $security_deposits = (!empty($financial_assests['security_deposits'])) ? $financial_assests['security_deposits'] : [];
        $annuities = (!empty($financial_assests['annuities'])) ? $financial_assests['annuities'] : [];
        $education_ira = (!empty($financial_assests['education_ira'])) ? $financial_assests['education_ira'] : [];
        $trusts_life_estates = (!empty($financial_assests['trusts_life_estates'])) ? $financial_assests['trusts_life_estates'] : [];
        $patents_copyrights = (!empty($financial_assests['patents_copyrights'])) ? $financial_assests['patents_copyrights'] : [];
        $licenses_franchises = (!empty($financial_assests['licenses_franchises'])) ? $financial_assests['licenses_franchises'] : [];
        $tax_refunds = (!empty($financial_assests['tax_refunds'])) ? $financial_assests['tax_refunds'] : [];
        $alimony_child_support = (!empty($financial_assests['alimony_child_support'])) ? $financial_assests['alimony_child_support'] : [];
        $unpaid_wages = (!empty($financial_assests['unpaid_wages'])) ? $financial_assests['unpaid_wages'] : [];
        $life_insurance = (!empty($financial_assests['life_insurance'])) ? $financial_assests['life_insurance'] : [];
        $insurance_policies = (!empty($financial_assests['insurance_policies'])) ? $financial_assests['insurance_policies'] : [];
        $inheritances = (!empty($financial_assests['inheritances'])) ? $financial_assests['inheritances'] : [];
        $injury_claims = (!empty($financial_assests['injury_claims'])) ? $financial_assests['injury_claims'] : [];
        //$other_claims = (!empty($financial_assests['other_claims'])) ? $financial_assests['other_claims'] : [];
        //$other_financial = (!empty($financial_assests['other_financial'])) ? $financial_assests['other_financial'] : [];


        $propAsstets = self::getAssetsJson($household_goods, $propAsstets, 7);
        $propAsstets = self::getAssetsJson($electronics, $propAsstets, 8);


        $propAsstets = self::getAssetsJson($collectibles, $propAsstets, 9);
        $propAsstets = self::getAssetsJson($sports, $propAsstets, 10);
        $propAsstets = self::getAssetsJson($firearms, $propAsstets, 11);
        $propAsstets = self::getAssetsJson($clothing, $propAsstets, 12);


        $propAsstets = self::getAssetsJson($jewelry, $propAsstets, 13);


        $propAsstets = self::getAssetsJson($pets, $propAsstets, 14);
        $propAsstets = self::getAssetsJson($health_aids, $propAsstets, 15);

        $propAsstets = self::getFinancialAssetsJson($cash, $propAsstets, 17);
        $propAsstets = self::getFinancialAssetsSubtypeJson($bank, $propAsstets, 18);

        $propAsstets = self::getFinancialAssetsVenmoBrokerageSubtypeJson($venmo_paypal_cash, $propAsstets, 18, 24);
        $propAsstets = self::getFinancialAssetsVenmoBrokerageSubtypeJson($brokerage_account, $propAsstets, 18);

        $propAsstets = self::getFinancialAssetsJson($mutual_funds, $propAsstets, 38);
        $propAsstets = self::getFinancialAssetsJson($traded_stocks, $propAsstets, 39); //interests in businesses
        $propAsstets = self::getFinancialAssetsJson($government_corporate_bonds, $propAsstets, 40); //Bonds And Other
        $propAsstets = self::getFinancialAssetsSubtypeJson($retirement_pension, $propAsstets, 41); //Retirement
        $propAsstets = self::getFinancialAssetsSubtypeJson($security_deposits, $propAsstets, 25); //Security deposits and prepayments
        $propAsstets = self::getFinancialAssetsJson($annuities, $propAsstets, 48);
        $propAsstets = self::getFinancialAssetsJson($education_ira, $propAsstets, 49);
        $propAsstets = self::getFinancialAssetsJson($trusts_life_estates, $propAsstets, 50);
        $propAsstets = self::getFinancialAssetsJson($patents_copyrights, $propAsstets, 51);
        $propAsstets = self::getFinancialAssetsJson($licenses_franchises, $propAsstets, 55);
        $propAsstets = self::getFinancialAssetsSubtypeJson($tax_refunds, $propAsstets, 59);
        $propAsstets = self::getFinancialAssetsSubtypeJson($alimony_child_support, $propAsstets, 63);
        $propAsstets = self::getFinancialAssetsJson($unpaid_wages, $propAsstets, 69);
        $propAsstets = self::getFinancialAssetsJson($life_insurance, $propAsstets, 71);
        $propAsstets = self::getFinancialAssetsJson($insurance_policies, $propAsstets, 71);
        $propAsstets = self::getFinancialAssetsJson($inheritances, $propAsstets, 72);
        $propAsstets = self::getFinancialAssetsJson($injury_claims, $propAsstets, 73);
        //$propAsstets = self::getFinancialAssetsJson($other_claims,$propAsstets,74);
        //$propAsstets = self::getFinancialAssetsJson($other_financial,$propAsstets,75);

        $businessassets = $property_info['businessassets'];
        // dump($businessassets);
        $final = [];
        if (!empty($businessassets)) {
            foreach ($businessassets as $business) {
                $b_type_data = json_decode($business['type_data'], 1);
                if (!empty($b_type_data)) {
                    $business['description'] = (!empty($b_type_data['description'])) ? $b_type_data['description'] : "";
                    $business['property_value'] = (!empty($b_type_data['property_value'])) ? $b_type_data['property_value'] : "";
                    $business['owned_by'] = (!empty($b_type_data['owned_by'])) ? $b_type_data['owned_by'] : "";
                    $business['type_of_account'] = (!empty($b_type_data['type_of_account'])) ? $b_type_data['type_of_account'] : "";

                }
                unset($business['type_data']);
                $final[$business['type']] = $business;
            }
        }

        $commissions = (!empty($final['commissions'])) ? $final['commissions'] : [];
        $office_equipment = (!empty($final['office_equipment'])) ? $final['office_equipment'] : [];
        $machinery_fixtures = (!empty($final['machinery_fixtures'])) ? $final['machinery_fixtures'] : [];
        $business_inventory = (!empty($final['business_inventory'])) ? $final['business_inventory'] : [];
        $interests = (!empty($final['interests'])) ? $final['interests'] : [];
        $customer_mailing = (!empty($final['customer_mailing'])) ? $final['customer_mailing'] : [];
        $other_business = (!empty($final['other_business'])) ? $final['other_business'] : [];
        $assetsIndex = count($propAsstets) + 1;
        $propAsstets = self::getBusinessAssetsJson($commissions, $propAsstets, 77);
        $propAsstets = self::getBusinessAssetsJson($office_equipment, $propAsstets, 78);
        $propAsstets = self::getBusinessAssetsJson($machinery_fixtures, $propAsstets, 82);
        $propAsstets = self::getBusinessAssetsJson($business_inventory, $propAsstets, 87);
        $propAsstets = self::getBusinessAssetsArrayJson($interests, $propAsstets, 88);
        $assetsIndex = count($propAsstets) + 1;
        $propAsstets = self::getBusinessAssetsJson($customer_mailing, $propAsstets, 89);
        $propAsstets = self::getBusinessAssetsArrayJson($other_business, $propAsstets, 90);


        $farmAssets = $property_info['farmcommercial'];
        $farmFinal = [];
        if (!empty($farmAssets)) {
            foreach ($farmAssets as $farm) {
                $farm_type_data = json_decode($farm['type_data'], 1);
                if (!empty($farm_type_data)) {
                    $farm['description'] = (!empty($farm_type_data['description'])) ? $farm_type_data['description'] : "";
                    $farm['property_value'] = (!empty($farm_type_data['property_value'])) ? $farm_type_data['property_value'] : "";
                    $farm['owned_by'] = (!empty($farm_type_data['owned_by'])) ? $farm_type_data['owned_by'] : "";
                    $farm['type_of_account'] = (!empty($farm_type_data['type_of_account'])) ? $farm_type_data['type_of_account'] : "";

                }
                unset($farm['type_data']);
                $farmFinal[$farm['type']] = $farm;
            }
        }


        $farm_animals = (!empty($farmFinal['farm_animals'])) ? $farmFinal['farm_animals'] : [];
        $crops = (!empty($farmFinal['crops'])) ? $farmFinal['crops'] : [];
        $fishing_equipment = (!empty($farmFinal['fishing_equipment'])) ? $farmFinal['fishing_equipment'] : [];
        $fishing_supplies = (!empty($farmFinal['fishing_supplies'])) ? $farmFinal['fishing_supplies'] : [];
        $fishing_property = (!empty($farmFinal['fishing_property'])) ? $farmFinal['fishing_property'] : [];

        $propAsstets = self::getFarmAssetsJson($farm_animals, $propAsstets, 92);
        $propAsstets = self::getFarmAssetsJson($crops, $propAsstets, 93);
        $propAsstets = self::getFarmAssetsJson($fishing_equipment, $propAsstets, 94);
        $propAsstets = self::getFarmAssetsJson($fishing_supplies, $propAsstets, 95);
        $propAsstets = self::getFarmAssetsJson($fishing_property, $propAsstets, 96);


        $otherAssets = $property_info['miscellaneous'];
        $otherFinal = [];
        if (!empty($otherAssets)) {
            foreach ($otherAssets as $other) {
                $other_type_data = json_decode($other['type_data'], 1);
                if (!empty($other_type_data)) {
                    $other['description'] = (!empty($other_type_data['description'])) ? $other_type_data['description'] : "";
                    $other['property_value'] = (!empty($other_type_data['property_value'])) ? $other_type_data['property_value'] : "";
                    $other['owned_by'] = (!empty($other_type_data['owned_by'])) ? $other_type_data['owned_by'] : "";
                    $other['type_of_account'] = (!empty($other_type_data['type_of_account'])) ? $other_type_data['type_of_account'] : "";

                }
                unset($other['type_data']);
                $otherFinal[$other['type']] = $other;
            }
        }

        $miscellaneous = (!empty($otherFinal['miscellaneous'])) ? $otherFinal['miscellaneous'] : [];

        $propAsstets = self::getOtherAssetsJson($miscellaneous, $propAsstets, 99);

        return $propAsstets;
    }




    private static function getAssetsJson($property, $totalassets = [], $type = "")
    {
        $asset = [];
        $assetsIndex = count($totalassets) + 1;
        $assetType = 3;
        if (Helper::validate_key_value('type_value', $property) == 1) {
            $asset = [
                "NatureOfInterest" => "[Nature of Interest]",
                "Asset" => [
                    "Id" => $assetsIndex,
                    "CategoryId" => 6,
                    "Type" => $type,
                    "Value" => (float)Helper::validate_key_value('property_value', $property),
                    "BookValue" => 0.00,
                    "Description" => Helper::validate_key_value('description', $property),
                    "AcquiredOn" => "",
                    "HWJC" => "N/A"
                ]
            ];
            array_push($totalassets, $asset);
        }

        return $totalassets;

    }

    private static function getFinancialAssetsJson($property, $totalassets = [], $type = '')
    {
        $asset = [];
        $assetsIndex = count($totalassets) + 1;
        if (Helper::validate_key_value('type_value', $property) == 1) {
            $i = 0;
            $key = 'property_value';
            if (in_array($type, [71,72])) {
                $key = 'description';
            }
            if (in_array($type, [69])) {
                $key = 'owed_type';
            }
            if (is_array(Helper::validate_key_value($key, $property)) && !empty(Helper::validate_key_value($key, $property))) {
                $dataFull = Helper::validate_key_value($key, $property);
                foreach ($dataFull as $val) {
                    $assetObj = [
                        "Id" => $assetsIndex,
                        "CategoryId" => 16,
                        "Type" => $type,
                        "Value" => (float)Helper::validate_key_loop_value('property_value', $property, $i),
                        "BookValue" => 0.00,
                        "Description" => Helper::validate_key_value('type', $property) == 'cash' ? "Cash" : Helper::validate_key_loop_value('description', $property, $i),
                        "AcquiredOn" => "",
                        "HWJC" => "N/A"
                    ];
                    if ($type == 71) {
                        $assetObj["ExtendedDescription"] = Helper::validate_key_loop_value('beneficiary', $property, $i);
                        $assetObj["IsValueUnknown"] = (Helper::validate_key_loop_value('unknown', $property, $i) == 1) ? true : false;
                    }
                    if ($type == 69) {
                        $assetObj["IsValueUnknown"] = (Helper::validate_key_loop_value('unknown', $property, $i) == 1) ? true : false;
                        $description = ArrayHelper::getPropertyFinancialOwedTypeArray(Helper::validate_key_loop_value('owed_type', $property, $i));
                        $description .= (Helper::validate_key_loop_value('data_for', $property, $i) == 'debtor') ? '; Debtor recieves $' : '' ;
                        $description .= (Helper::validate_key_loop_value('data_for', $property, $i) == 'codebtor') ? '; Co-Debtor recieves $' : '' ;
                        $description .= ((float)Helper::validate_key_loop_value('monthly_amount', $property, $i) > 0) ? (float)Helper::priceFormt((float)Helper::validate_key_loop_value('monthly_amount', $property, $i)) .' per month' : '0.00 per month' ;
                        $assetObj["Description"] = $description;
                    }
                    $asset = [
                        "NatureOfInterest" => "[Nature of Interest]",
                        "Asset" => $assetObj
                    ];
                    if (is_array($totalassets)) {
                        array_push($totalassets, $asset);
                    }
                    $assetsIndex++;
                    $i++;
                }
            }
        }

        return $totalassets;
    }

    private static function getFinancialAssetsSubtypeJson($property, $totalassets = [], $type = '')
    {
        $asset = [];
        $assetsIndex = count($totalassets) + 1;
        $subType = "";
        if (Helper::validate_key_value('type_value', $property) == 1) {
            $i = 0;
            $key = 'account_type';
            if ($type == 59) {
                $key = 'description';
            }
            if (is_array(Helper::validate_key_value($key, $property)) && !empty(Helper::validate_key_value($key, $property))) {
                foreach (Helper::validate_key_value($key, $property) as $val) {
                    $subType = self::getSubType($property, $i, $type);
                    $assetObj = [
                        "Id" => $assetsIndex,
                        "CategoryId" => 16,
                        "Type" => $type,
                        "SubType" => $subType,
                        "Value" => (float)Helper::validate_key_loop_value('property_value', $property, $i),
                        "BookValue" => 0.00,
                        "Description" => Helper::validate_key_value('type', $property) == 'cash' ? "Cash" : Helper::validate_key_loop_value('description', $property, $i),
                        "AcquiredOn" => "",
                        "HWJC" => "N/A",
                        "IsValueUnknown" => false
                    ];
                    if ($type == 18) {
                        $assetObj["ExtendedDescription"] = Helper::validate_key_loop_value('last_4_digits', $property, $i);
                    }
                    if ($type == 59) {
                        $assetObj["Year"] = Helper::validate_key_loop_value('year', $property, $i);
                    }
                    $asset = [
                        "NatureOfInterest" => "[Nature of Interest]",
                        "Asset" => $assetObj
                    ];
                    if (is_array($totalassets)) {
                        array_push($totalassets, $asset);
                    }
                    $assetsIndex++;
                    $i++;
                }
            }
        }

        return $totalassets;
    }

    private static function getFinancialAssetsVenmoBrokerageSubtypeJson($property, $totalassets = [], $type = '', $subTypeMain = '')
    {
        $asset = [];
        $assetsIndex = count($totalassets) + 1;
        $subType = "";
        if (Helper::validate_key_value('type_value', $property) == 1) {
            $i = 0;
            $key = 'account_type';
            if ($type == 59) {
                $key = 'description';
            }
            if (is_array(Helper::validate_key_value($key, $property)) && !empty(Helper::validate_key_value($key, $property))) {
                foreach (Helper::validate_key_value($key, $property) as $val) {

                    $subType = self::getSubType($property, $i, $type);
                    $description = Helper::validate_key_value('type', $property) == 'cash' ? "Cash" : Helper::validate_key_loop_value('description', $property, $i);
                    if (!empty($subTypeMain)) {
                        $description = Helper::validate_key_loop_value('account_type', $property, $i);
                        $description = ucwords(str_replace('_', ' ', $description));
                    }
                    $assetObj = [
                        "Id" => $assetsIndex,
                        "CategoryId" => 16,
                        "Type" => $type,
                        "SubType" => 24,
                        "SubType" => !empty($subTypeMain) ? $subTypeMain : $subType,
                        "Value" => (float)Helper::validate_key_loop_value('property_value', $property, $i),
                        "BookValue" => 0.00,
                        "Description" => $description,
                        "AcquiredOn" => "",
                        "HWJC" => "N/A",
                        "IsValueUnknown" => false,
                        "ExtendedDescription" => Helper::validate_key_loop_value('last_4_digits', $property, $i)
                    ];
                    $asset = [
                        "NatureOfInterest" => "[Nature of Interest]",
                        "Asset" => $assetObj
                    ];
                    if (is_array($totalassets)) {
                        array_push($totalassets, $asset);
                    }
                    $assetsIndex++;
                    $i++;
                }
            }
        }

        return $totalassets;
    }

    private static function getSubType($property, $i, $type = "")
    {
        $accType = Helper::validate_key_loop_value('account_type', $property, $i);
        $subType = "";
        switch ($type) {
            case (18):
                switch ($accType) {
                    case (1): $subType = 19;
                        break;
                    case (2): $subType = 20;
                        break;
                    case (3): $subType = "";
                        break;
                    case (4): $subType = 21;
                        break;
                    case (5): $subType = 24;
                        break;
                    case (6): $subType = 23;
                        break;
                    case (7): $subType = "";
                        break;
                }
                break;
            case (41):
                switch ($accType) {
                    case (1): $subType = 42;
                        break;
                    case (2): $subType = 43;
                        break;
                    case (3): $subType = 44;
                        break;
                    case (4): $subType = 46;
                        break;
                    case (5): $subType = 47;
                        break;
                    case (6): $subType = 45;
                        break;
                }
                break;
            case (26):
                switch ($accType) {
                    case (1): $subType = 27;
                        break;
                    case (2): $subType = 28;
                        break;
                    case (3): $subType = 29;
                        break;
                    case (4): $subType = 30;
                        break;
                    case (5): $subType = 36;
                        break;
                    case (6): $subType = 31;
                        break;
                    case (7): $subType = 32;
                        break;
                    case (8): $subType = 33;
                        break;
                    case (9): $subType = 34;
                        break;
                }
                break;
            case (59):
                switch ($i) {
                    case (0): $subType = 60;
                        break;
                    case (1): $subType = 61;
                        break;
                    case (2): $subType = 62;
                        break;
                }
                break;
            case (63):
                switch ($accType) {
                    case (1): $subType = 64;
                        break;
                    case (2): $subType = 65;
                        break;
                    case (3): $subType = 66;
                        break;
                    case (4): $subType = 67;
                        break;
                    case (5): $subType = 68;
                        break;
                }
                break;
        }

        return $subType;
    }

    private static function getBusinessAssetsJson($bizproperty, $finalassets = [], $type = "")
    {
        $asset = [];
        $assetsIndex = count($finalassets) + 1;
        if (Helper::validate_key_value('type_value', $bizproperty) == 1) {
            $asset = [
                "NatureOfInterest" => "[Nature of Interest]",
                "Asset" => [
                    "Id" => $assetsIndex,
                    "CategoryId" => 76,
                    "Type" => $type,
                    "Value" => (float)Helper::validate_key_value('property_value', $bizproperty),
                    "BookValue" => 0.00,
                    "Description" => Helper::validate_key_value('description', $bizproperty),
                    "AcquiredOn" => "",
                    "HWJC" => "N/A"
                ]
            ];

            if (is_array($finalassets)) {
                array_push($finalassets, $asset);
            }
        }

        return $finalassets;

    }

    private static function getBusinessAssetsArrayJson($busproperty, $finassets = [], $type = 42)
    {
        $asset = [];
        $assetsIndex = count($finassets) + 1;
        if (Helper::validate_key_value('type_value', $busproperty) == 1) {
            $i = 0;
            if (is_array(Helper::validate_key_value('property_value', $busproperty))) {
                foreach (Helper::validate_key_value('property_value', $busproperty) as $val) {
                    $asset = [
                        "NatureOfInterest" => "[Nature of Interest]",
                        "Asset" => [
                        "Id" => $assetsIndex,
                        "CategoryId" => 76,
                        "Type" => $type,
                        "Value" => (float)Helper::validate_key_loop_value('property_value', $busproperty, $i),
                        "BookValue" => 0.00,
                        "Description" => Helper::validate_key_loop_value('description', $busproperty, $i),
                        "AcquiredOn" => "",
                        "HWJC" => "N/A"
                    ]
                    ];
                    if (is_array($finassets)) {
                        array_push($finassets, $asset);
                    }
                    $i++;
                    $assetsIndex++;
                }
            }

        }

        return $finassets;
    }

    private static function getFarmAssetsJson($property, $totalassets = [], $type = "")
    {
        $asset = [];
        $assetsIndex = count($totalassets) + 1;
        $assetType = 3;
        if (Helper::validate_key_value('type_value', $property) == 1) {
            $asset = [
                "NatureOfInterest" => "[Nature of Interest]",
                "Asset" => [
                    "Id" => $assetsIndex,
                    "CategoryId" => 91,
                    "Type" => $type,
                    "Value" => (float)Helper::validate_key_value('property_value', $property),
                    "BookValue" => 0.00,
                    "Description" => Helper::validate_key_value('description', $property),
                    "AcquiredOn" => "",
                    "HWJC" => "N/A"
                ]
            ];
            array_push($totalassets, $asset);
        }

        return $totalassets;

    }

    private static function getOtherAssetsJson($property, $totalassets = [], $type = "")
    {
        $asset = [];
        $assetsIndex = count($totalassets) + 1;
        if (Helper::validate_key_value('type_value', $property) == 1) {
            $i = 0;
            if (is_array(Helper::validate_key_value('property_value', $property))) {
                foreach (Helper::validate_key_value('property_value', $property) as $val) {
                    $asset = [
                        "NatureOfInterest" => "[Nature of Interest]",
                        "Asset" => [
                        "Id" => $assetsIndex,
                        "CategoryId" => 99,
                        "Type" => $type,
                        "Value" => (float)Helper::validate_key_loop_value('property_value', $property, $i),
                        "BookValue" => 0.00,
                        "Description" => Helper::validate_key_loop_value('description', $property, $i),
                        "AcquiredOn" => "",
                        "HWJC" => "N/A"
                    ]
                    ];
                    if (is_array($totalassets)) {
                        array_push($totalassets, $asset);
                    }
                    $i++;
                    $assetsIndex++;
                }
            }

        }

        return $totalassets;

    }

    private static function getDivisionId($BasicInfoPartA)
    {
        $divisonId = 0;
        if (empty($BasicInfoPartA)) {
            return $divisonId;
        }
        $countyId = $BasicInfoPartA['country'];
        $countyFipsId = \App\Models\CountyFipsData::where('id', $countyId)->select('fips_division')->first();
        $countyFipsId = $countyFipsId['fips_division'] ?? 0;
        if ($countyFipsId > 0) {
            $divisonId = \App\Models\StateDivisions::where(['id' => $countyFipsId])->select('id_in_jubliee')->first();
            $divisonId = $divisonId['id_in_jubliee'] ?? 0;
        }

        return $divisonId;
    }

    private static function getSOFAData($sofaData, $debtorName)
    {
        $data = [];
        array_push($data, ["RelatedDates" => (object)[]]);



        $DebtTransactions = self::getSOFADebtTransaction($sofaData);
        $InsiderDebtTransactions = self::getSOFAInsiderDebtTransaction($sofaData);
        $Lawsuits = self::getSOFALawsuits($sofaData);
        $PropertyActions = self::getSOFAPropertyActions($sofaData);
        $Assignments = self::getSOFAAssignments($sofaData);
        $GiftTransactions = self::getSOFAGiftTransactions($sofaData);
        $LossTransactions = self::getSOFALossTransactions($sofaData);
        $DebtCounselingTransactions = self::getSOFADebtCounselingTransactions($sofaData, $debtorName);
        $OtherTransactions = self::getSOFAOtherTransactions($sofaData);
        $SOFASetoffs = self::getSOFASOFASetoffs($sofaData);
        $Incomes = self::getSOFAIncomes($sofaData);
        $PriorAddresses = self::getSOFAPriorAddresses($sofaData);
        $BankAccounts = self::getSOFABankAccounts($sofaData);
        $SafeDepositAccounts = self::getSOFASafeDepositAccounts($sofaData);
        $StorageAccounts = self::getSOFAStorageAccounts($sofaData);
        $ThirdPartyAccounts = self::getSOFAThirdPartyAccounts($sofaData);
        $Environmentals = self::getSOFAEnvironmentals($sofaData);
        $BusinessRelations = self::getSOFABusinessRelations($sofaData);
        $BusinessInventories = [[
                                    "SupervisorName" => [
                                        "PrefixForDisplay" => "",
                                        "SuffixForDisplay" => "",
                                        "FirstMiddle" => "",
                                        "LastNameSuffix" => ""
                                    ]
                                ]];
        $BusinessOfficers = [ [ "Period" => (object)[] ] ];
        $BusinessWithdrawals = [ [ "SOFATransactionType" => 23 ] ];
        $BusinessOthers = [ (object)[] ];
        $HealthcareBankruptcies = [ (object)[] ];

        return [
            "DebtTransactions" => $DebtTransactions, //Q6
            "InsiderDebtTransactions" => $InsiderDebtTransactions, //Q7, Q8
            "Lawsuits" => $Lawsuits, //Q9
            "PropertyActions" => $PropertyActions, //Q10
            "Assignments" => $Assignments, // Q12 guess
            "GiftTransactions" => $GiftTransactions, // Q13, Q14
            "LossTransactions" => $LossTransactions, // Q15
            "DebtCounselingTransactions" => $DebtCounselingTransactions, // Q16
            "OtherTransactions" => $OtherTransactions, // Q18
            "SOFASetoffs" => $SOFASetoffs, // Q11
            "Incomes" => $Incomes, // Q4, Q5
            "PriorAddresses" => $PriorAddresses, //Q2
            "BankAccounts" => $BankAccounts, // Q20
            "SafeDepositAccounts" => $SafeDepositAccounts, // Q21
            "StorageAccounts" => $StorageAccounts, // Q22,
            "ThirdPartyAccounts" => $ThirdPartyAccounts, // Q23
            "Environmentals" => $Environmentals, // Q24, Q25, Q26
            "BusinessRelations" => $BusinessRelations, // Q28
            "BusinessInventories" => $BusinessInventories, //
            "BusinessOfficers" => $BusinessOfficers, //
            "BusinessWithdrawals" => $BusinessWithdrawals, //
            "BusinessOthers" => $BusinessOthers, //
            "HealthcareBankruptcies" => $HealthcareBankruptcies, //
        ];
    }

    private static function getSOFADebtTransaction($sofaData)
    {
        $DebtTransactions = [];
        if (Helper::validate_key_value('primarily_consumer_debets', $sofaData, 'radio') == 1) {
            $consumer_debts_data = Helper::validate_key_value('primarily_consumer_debets_data', $sofaData, 'array');
            $debtCount = isset($consumer_debts_data['creditor_address']) && is_array($consumer_debts_data['creditor_address']) ? count($consumer_debts_data['creditor_address']) : 0;
            for ($i = 0; $i < $debtCount; $i++) {
                if (Helper::validate_key_loop_value("total_amount_paid", $consumer_debts_data, $i) >= 600) {
                    $debt_type = (int)Helper::validate_key_loop_value('creditor_payment_for', $consumer_debts_data, $i);
                    $debt_type = $debt_type == 5 ? 7 : $debt_type;
                    $debt_type = $debt_type == 6 ? 99 : $debt_type;
                    $DebtTransactionsArray = [
                                                "DebtType" => $debt_type,
                                                "SOFATransactionType" => 8,
                                                "Description" => "",
                                                "Balance" => Helper::validate_key_loop_value("amount_still_owed", $consumer_debts_data, $i),
                                                "SOFAPeriodType" => 1,
                                                "Recipient" => [
                                                    "DisplayName" => Helper::validate_key_loop_value("creditor_address", $consumer_debts_data, $i),
                                                    "Address" => [ "IsMailingAddress" => true ],
                                                    "Email" => [ "Value" => "" ],
                                                    "Phone" => [ "Value" => "" ]
                                                ],
                                                "Payments" => [
                                                    [
                                                        "Date" => Helper::validate_key_loop_value("payment_dates", $consumer_debts_data, $i),
                                                        "Amount" => Helper::validate_key_loop_value("payment_1", $consumer_debts_data, $i),
                                                        "Description" => ""
                                                    ],
                                                    [
                                                        "Date" => Helper::validate_key_loop_value("payment_dates2", $consumer_debts_data, $i),
                                                        "Amount" => Helper::validate_key_loop_value("payment_2", $consumer_debts_data, $i),
                                                        "Description" => ""
                                                    ],
                                                    [
                                                        "Date" => Helper::validate_key_loop_value("payment_dates3", $consumer_debts_data, $i),
                                                        "Amount" => Helper::validate_key_loop_value("payment_3", $consumer_debts_data, $i),
                                                        "Description" => ""
                                                    ]
                                                ],
                                                "RecipientAddress" => [ "IsMailingAddress" => true ]
                                            ];

                    if (is_array($DebtTransactions)) {
                        array_push($DebtTransactions, $DebtTransactionsArray);
                    }
                }
            }
        }

        return $DebtTransactions;
    }

    private static function getSOFAInsiderDebtTransaction($sofaData)
    {
        $InsiderDebtTransactions = [];
        if (Helper::validate_key_value('payment_past_one_year', $sofaData, 'radio') == 1) {
            $insider_debts_data = Helper::validate_key_value('past_one_year_data', $sofaData, 'array');
            $insiderDebtCount = count($insider_debts_data['creditor_address_past_one_year']);
            for ($i = 0; $i < $insiderDebtCount; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("creditor_state_past_one_year", $insider_debts_data, $i);
                $InsiderDebtTransactionsArray = [
                                                    "IsInsiderDebt" => true,
                                                    "Relationship" => "",
                                                    "SOFATransactionType" => 9,
                                                    "Description" => Helper::validate_key_loop_value("past_one_year_payment_reason", $insider_debts_data, $i),
                                                    "Balance" => Helper::validate_key_loop_value("past_one_year_amount_still_owed", $insider_debts_data, $i),
                                                    "Recipient" => [
                                                        "DisplayName" => Helper::validate_key_loop_value("creditor_address_past_one_year", $insider_debts_data, $i),
                                                        "Address" => [ "IsMailingAddress" => true ],
                                                        "Email" => [ "Value" => "" ],
                                                        "Phone" => [ "Value" => "" ]
                                                    ],
                                                    "Payments" => [
                                                        [
                                                            "Date" => Helper::validate_key_loop_value("past_one_year_payment_dates", $insider_debts_data, $i),
                                                            "Amount" => Helper::validate_key_loop_value("past_one_year_total_amount_paid", $insider_debts_data, $i),
                                                            "Description" => Helper::validate_key_loop_value("past_one_year_payment_reason", $insider_debts_data, $i)
                                                        ],
                                                        [
                                                            "Date" => Helper::validate_key_loop_value("past_one_year_payment_dates2", $insider_debts_data, $i),
                                                            "Amount" => Helper::validate_key_loop_value("past_one_year_total_amount_paid", $insider_debts_data, $i),
                                                            "Description" => Helper::validate_key_loop_value("past_one_year_payment_reason", $insider_debts_data, $i)
                                                        ],
                                                        [
                                                            "Date" => Helper::validate_key_loop_value("past_one_year_payment_dates3", $insider_debts_data, $i),
                                                            "Amount" => Helper::validate_key_loop_value("past_one_year_total_amount_paid", $insider_debts_data, $i),
                                                            "Description" => Helper::validate_key_loop_value("past_one_year_payment_reason", $insider_debts_data, $i)
                                                        ]
                                                    ],
                                                    "RecipientName" => Helper::validate_key_loop_value("creditor_address_past_one_year", $insider_debts_data, $i),
                                                    "RecipientAddress" => [
                                                                            "Street1" => Helper::validate_key_loop_value("creditor_street_past_one_year", $insider_debts_data, $i),
                                                                            "City" => Helper::validate_key_loop_value("creditor_city_past_one_year", $insider_debts_data, $i),
                                                                            "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                                                            "Zip" => Helper::validate_key_loop_value("creditor_zip_past_one_year", $insider_debts_data, $i),
                                                                            "IsMailingAddress" => true
                                                                        ],
                                                ];
                if (is_array($InsiderDebtTransactions)) {
                    array_push($InsiderDebtTransactions, $InsiderDebtTransactionsArray);
                }
            }
        }
        // for Q8
        if (Helper::validate_key_value('transfers_property', $sofaData, 'radio') == 1) {
            $data = Helper::validate_key_value('transfers_property_data', $sofaData, 'array');
            $count = count($data['total_amount_paid_transfers_property']);
            for ($i = 0; $i < $count; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("creditor_state_transfers_property", $data, $i);
                $propertyTransferDataArray = [
                                "IsInsiderDebt" => false,
                                "Relationship" => "",
                                "SOFATransactionType" => 9,
                                "Description" => Helper::validate_key_loop_value("payment_reason_transfers_property", $data, $i),
                                "Balance" => Helper::validate_key_loop_value("amount_still_owed_transfers_property", $data, $i),
                                "Payments" => [
                                    [
                                        "Date" => Helper::validate_key_loop_value("payment_dates_transfers_property", $data, $i),
                                        "Amount" => Helper::validate_key_loop_value("total_amount_paid_transfers_property", $data, $i),
                                    ],
                                    [
                                        "Date" => Helper::validate_key_loop_value("payment_dates_transfers_property2", $data, $i),
                                        "Amount" => Helper::validate_key_loop_value("total_amount_paid_transfers_property", $data, $i),
                                    ],
                                    [
                                        "Date" => Helper::validate_key_loop_value("payment_dates_transfers_property3", $data, $i),
                                        "Amount" => Helper::validate_key_loop_value("total_amount_paid_transfers_property", $data, $i),
                                    ]
                                ],
                                "RecipientName" => Helper::validate_key_loop_value("creditor_address_transfers_property", $data, $i),
                                "RecipientAddress" => [
                                    "Street1" => Helper::validate_key_loop_value("creditor_street_transfers_property", $data, $i),
                                    "City" => Helper::validate_key_loop_value("creditor_city_transfers_property", $data, $i),
                                    "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                    "Zip" => Helper::validate_key_loop_value("creditor_zip_transfers_property", $data, $i),
                                    "IsMailingAddress" => true
                                ],
                            ];

                if (is_array($InsiderDebtTransactions)) {
                    array_push($InsiderDebtTransactions, $propertyTransferDataArray);
                }
            }
        }

        return $InsiderDebtTransactions;
    }

    private static function getSOFALawsuits($sofaData)
    {
        $Lawsuit = [];
        if (Helper::validate_key_value('list_lawsuits', $sofaData, 'radio') == 1) {
            $list_lawsuits_data = Helper::validate_key_value('list_lawsuits_data', $sofaData, 'array');
            $lawsuiteDataCount = count($list_lawsuits_data['case_number']);
            for ($i = 0; $i < $lawsuiteDataCount; $i++) {
                $LawsuitArray = [
                                    "CaseNumber" => Helper::validate_key_loop_value_exclude_comma("case_number", $list_lawsuits_data, $i),
                                    "CaseTitle" => Helper::validate_key_loop_value_exclude_comma("case_title", $list_lawsuits_data, $i),
                                    "Status" => (int)Helper::validate_key_loop_value('disposition', $list_lawsuits_data, $i),
                                    "Court" => [
                                        "DisplayName" => Helper::validate_key_loop_value_exclude_comma("agency_location", $list_lawsuits_data, $i),
                                        "Address" => [ "IsMailingAddress" => true ],
                                        "Email" => [ "Value" => "" ],
                                        "Phone" => [ "Value" => "" ]
                                    ],
                                    "SOFALegalActionType" => 12,
                                    "Description" => Helper::validate_key_loop_value_exclude_comma("case_nature", $list_lawsuits_data, $i),
                                ];
                if (is_array($Lawsuit)) {
                    array_push($Lawsuit, $LawsuitArray);
                }
            }
        }

        return $Lawsuit;
    }

    private static function getSOFAPropertyActions($sofaData)
    {
        $PropertyActions = [];
        if (Helper::validate_key_value('property_repossessed', $sofaData, 'radio') == 1) {
            $property_repossessed_data = Helper::validate_key_value('property_repossessed_data', $sofaData, 'array');
            $PropertyActionsDataCount = count($property_repossessed_data['creditor_address']);
            for ($i = 0; $i < $PropertyActionsDataCount; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("creditor_state", $property_repossessed_data, $i);
                $address = Helper::validate_key_loop_value_exclude_comma("creditor_address", $property_repossessed_data, $i);
                $addressStreet = Helper::validate_key_loop_value_exclude_comma("creditor_street", $property_repossessed_data, $i);
                $address .= !empty($addressStreet) ? ', '.$addressStreet : '';
                $PropertyActionsArray = [
                                            "PropertyActionType" => Helper::validate_key_loop_value('what_happened', $property_repossessed_data, $i),
                                            "Value" => (float)Helper::validate_key_loop_value('property_repossessed_value', $property_repossessed_data, $i),
                                            "SOFALegalActionType" => 13,
                                            "Description" => Helper::validate_key_loop_value('creditor_Property', $property_repossessed_data, $i),
                                            "Date" => Helper::validate_key_loop_value('property_repossessed_date', $property_repossessed_data, $i),
                                            "PartyName" => Helper::validate_key_loop_value('creditor_address', $property_repossessed_data, $i),
                                            "PartyAddress" => [
                                                "Street1" => $address ?? '',
                                                "Unit" => '',
                                                "City" => Helper::validate_key_loop_value('creditor_city', $property_repossessed_data, $i),
                                                "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                                "Zip" => Helper::validate_key_loop_value('creditor_zip', $property_repossessed_data, $i),
                                                "IsMailingAddress" => true
                                            ]
                                        ];
                if (is_array($PropertyActions)) {
                    array_push($PropertyActions, $PropertyActionsArray);
                }
            }
        }

        return $PropertyActions;
    }

    private static function getSOFAAssignments($sofaData)
    {
        $Assignments = [];
        if (Helper::validate_key_value('court_appointed', $sofaData, 'radio') == 1) {
            $AssignmentsArray = [
                                    "SOFALegalActionType" => 15,
                                    "PartyName" => "Custodian Name",
                                    "PartyAddress" => [ "IsMailingAddress" => true ]
                                ];

            if (is_array($Assignments)) {
                array_push($Assignments, $AssignmentsArray);
            }
        }

        return $Assignments;
    }

    private static function getSOFAGiftTransactions($sofaData)
    {
        $GiftTransaction = [];
        if (Helper::validate_key_value('list_any_gifts', $sofaData, 'radio') == 1) {
            $list_any_gifts_data = Helper::validate_key_value('list_any_gifts_data', $sofaData, 'array');
            $GiftTransactionDataCount = count($list_any_gifts_data['recipient_address']);
            for ($i = 0; $i < $GiftTransactionDataCount; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("creditor_state", $list_any_gifts_data, $i);
                $GiftTransactionArray = [
                                            "GiftType" => 1,
                                            "Relationship" => Helper::validate_key_loop_value_exclude_comma("relationship", $list_any_gifts_data, $i),
                                            "SOFATransactionType" => 17,
                                            "RecipientName" => Helper::validate_key_loop_value_exclude_comma("recipient_address", $list_any_gifts_data, $i),
                                            "Payments" => [
                                                [
                                                    "Date" => Helper::validate_key_loop_value_exclude_comma("gifts_date_from", $list_any_gifts_data, $i),
                                                    "Amount" => Helper::validate_key_loop_value_exclude_comma("gifts_value1", $list_any_gifts_data, $i),
                                                    "Description" => Helper::validate_key_loop_value_exclude_comma("gifts", $list_any_gifts_data, $i)
                                                ],
                                                [
                                                    "Date" => Helper::validate_key_loop_value_exclude_comma("gifts_date_to", $list_any_gifts_data, $i),
                                                    "Amount" => Helper::validate_key_loop_value_exclude_comma("gifts_value", $list_any_gifts_data, $i),
                                                    "Description" => Helper::validate_key_loop_value_exclude_comma("gifts", $list_any_gifts_data, $i)
                                                ]
                                            ],
                                            "RecipientAddress" => [
                                                "Street1" => Helper::validate_key_loop_value('creditor_street', $list_any_gifts_data, $i),
                                                "Unit" => '',
                                                "City" => Helper::validate_key_loop_value('creditor_city', $list_any_gifts_data, $i),
                                                "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                                "Zip" => Helper::validate_key_loop_value('creditor_zip', $list_any_gifts_data, $i),
                                                "IsMailingAddress" => true
                                            ]
                                        ];
                if (is_array($GiftTransaction)) {
                    array_push($GiftTransaction, $GiftTransactionArray);
                }
            }
        }
        if (Helper::validate_key_value('gifts_charity', $sofaData, 'radio') == 1) {
            $gifts_charity_data = Helper::validate_key_value('gifts_charity_data', $sofaData, 'array');
            $GiftsCharityDataCount = count($gifts_charity_data['charity_address']);
            for ($i = 0; $i < $GiftsCharityDataCount; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("charity_state", $gifts_charity_data, $i);
                $GiftsCharityArray = [
                                        "GiftType" => 2,
                                        "Relationship" => "Relationship to Debtor",
                                        "SOFATransactionType" => 18,
                                        "RecipientName" => Helper::validate_key_loop_value_exclude_comma("charity_address", $gifts_charity_data, $i),
                                        "Payments" => [
                                            [
                                                "Date" => Helper::validate_key_loop_value_exclude_comma("charity_contribution_date", $gifts_charity_data, $i),
                                                "Amount" => Helper::validate_key_loop_value_exclude_comma("charity_contribution_value", $gifts_charity_data, $i),
                                                "Description" => Helper::validate_key_loop_value_exclude_comma("charity_contribution", $gifts_charity_data, $i)
                                            ],
                                            [
                                                "Date" => Helper::validate_key_loop_value_exclude_comma("charity_contribution_date1", $gifts_charity_data, $i),
                                                "Amount" => Helper::validate_key_loop_value_exclude_comma("charity_contribution_value1", $gifts_charity_data, $i),
                                                "Description" => Helper::validate_key_loop_value_exclude_comma("charity_contribution", $gifts_charity_data, $i)
                                            ]
                                        ],
                                        "RecipientAddress" => [
                                            "Street1" => Helper::validate_key_loop_value('charity_street', $gifts_charity_data, $i),
                                            "Unit" => '',
                                            "City" => Helper::validate_key_loop_value('charity_city', $gifts_charity_data, $i),
                                            "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                            "Zip" => Helper::validate_key_loop_value('charity_zip', $gifts_charity_data, $i),
                                            "IsMailingAddress" => true
                                        ]
                                     ];
                if (is_array($GiftTransaction)) {
                    array_push($GiftTransaction, $GiftsCharityArray);
                }
            }
        }

        return $GiftTransaction;
    }

    private static function getSOFALossTransactions($sofaData)
    {
        $LossTransactions = [];
        if (Helper::validate_key_value('losses_from_fire', $sofaData, 'radio') == 1) {
            $losses_from_fire_data = Helper::validate_key_value('losses_from_fire_data', $sofaData, 'array');
            $LossTransactionsDataCount = count($losses_from_fire_data['loss_description']);
            for ($i = 0; $i < $LossTransactionsDataCount; $i++) {
                $LossTransactionsArray = [
                                            "InsuranceCoverage" => Helper::validate_key_loop_value_exclude_comma("transferred_description", $losses_from_fire_data, $i),
                                            "SOFATransactionType" => 19,
                                            "Description" => Helper::validate_key_loop_value_exclude_comma("loss_description", $losses_from_fire_data, $i),
                                            "Balance" => Helper::validate_key_loop_value_exclude_comma("loss_amount_payment", $losses_from_fire_data, $i),
                                            "Date" => Helper::validate_key_loop_value_exclude_comma("loss_date_payment", $losses_from_fire_data, $i)
                                        ];
                if (is_array($LossTransactions)) {
                    array_push($LossTransactions, $LossTransactionsArray);
                }
            }
        }

        return $LossTransactions;
    }

    private static function getSOFADebtCounselingTransactions($sofaData, $debtorName)
    {
        $DebtCounselingTransactions = [];
        if (Helper::validate_key_value('property_transferred', $sofaData, 'radio') == 1) {
            $property_transferred_data = Helper::validate_key_value('property_transferred_data', $sofaData, 'array');
            $DebtCounselingTransactionsDataCount = count($property_transferred_data['person_paid']);
            for ($i = 0; $i < $DebtCounselingTransactionsDataCount; $i++) {
                $address = Helper::validate_key_loop_value("person_paid_street", $property_transferred_data, $i);
                $address .= !empty($address) ? ', '.Helper::validate_key_loop_value("person_paid_address_line2", $property_transferred_data, $i) : '';
                $stateCode = Helper::validate_key_loop_value_exclude_comma("person_paid_state", $property_transferred_data, $i);
                $DebtCounselingTransactionsArray = [
                                                        "PaymentMadeBy" => Helper::validate_key_loop_value_exclude_comma("person_made_payment", $property_transferred_data, $i),
                                                        "CounselingType" => 1,
                                                        "SOFATransactionType" => 21,
                                                        "Description" => Helper::validate_key_loop_value_exclude_comma("person_email_or_website", $property_transferred_data, $i),
                                                        "RecipientName" => Helper::validate_key_loop_value_exclude_comma("person_paid", $property_transferred_data, $i),
                                                        "Payments" => [
                                                        [
                                                            "Date" => Helper::validate_key_loop_value_exclude_comma("property_transferred_date", $property_transferred_data, $i),
                                                            "Amount" => Helper::validate_key_loop_value_exclude_comma("property_transferred_payment", $property_transferred_data, $i),
                                                            "Description" => Helper::validate_key_loop_value_exclude_comma("property_transferred_value", $property_transferred_data, $i)
                                                        ]
                                                        ],
                                                        "RecipientAddress" => [
                                                            "Street1" => $address,
                                                            "Unit" => '',
                                                            "City" => Helper::validate_key_loop_value('person_paid_city', $property_transferred_data, $i),
                                                            "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                                            "Zip" => Helper::validate_key_loop_value('person_paid_zip', $property_transferred_data, $i),
                                                            "IsMailingAddress" => true
                                                        ]
                                                    ];
                if (is_array($DebtCounselingTransactions)) {
                    array_push($DebtCounselingTransactions, $DebtCounselingTransactionsArray);
                }
            }
        }
        if (Helper::validate_key_value('property_transferred_creditors', $sofaData, 'radio') == 1) {
            $property_transferred_creditors_data = Helper::validate_key_value('property_transferred_creditors_data', $sofaData, 'array');
            $DataCount = count($property_transferred_creditors_data['person_paid_address']);
            for ($i = 0; $i < $DataCount; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("person_paid_state", $property_transferred_creditors_data, $i);
                $PropertyTransferredArray = [
                                                "PaymentMadeBy" => $debtorName,
                                                "CounselingType" => 2,
                                                "SOFATransactionType" => 22,
                                                "Description" => Helper::validate_key_loop_value_exclude_comma("property_transfer_value", $property_transferred_creditors_data, $i),
                                                "RecipientName" => Helper::validate_key_loop_value_exclude_comma("person_paid_address", $property_transferred_creditors_data, $i),
                                                "Payments" => [
                                                    [
                                                        "Date" => Helper::validate_key_loop_value_exclude_comma("property_transfer_date", $property_transferred_creditors_data, $i),
                                                        "Amount" => Helper::validate_key_loop_value_exclude_comma("property_transfer_amount_payment", $property_transferred_creditors_data, $i),
                                                        "Description" => Helper::validate_key_loop_value_exclude_comma("property_transfer_value", $property_transferred_creditors_data, $i)
                                                    ],
                                                    [
                                                        "Date" => Helper::validate_key_loop_value_exclude_comma("property_transfer_date2", $property_transferred_creditors_data, $i),
                                                        "Amount" => Helper::validate_key_loop_value_exclude_comma("property_transfer_amount_payment2", $property_transferred_creditors_data, $i),
                                                        "Description" => Helper::validate_key_loop_value_exclude_comma("property_transfer_value", $property_transferred_creditors_data, $i)
                                                    ]
                                                ],
                                                "RecipientAddress" => [
                                                    "Street1" => Helper::validate_key_loop_value('person_paid_street', $property_transferred_creditors_data, $i),
                                                    "Unit" => '',
                                                    "City" => Helper::validate_key_loop_value('person_paid_city', $property_transferred_creditors_data, $i),
                                                    "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                                    "Zip" => Helper::validate_key_loop_value('person_paid_zip', $property_transferred_creditors_data, $i),
                                                    "IsMailingAddress" => true
                                                ]
                                            ];
                if (is_array($DebtCounselingTransactions)) {
                    array_push($DebtCounselingTransactions, $PropertyTransferredArray);
                }
            }
        }

        return $DebtCounselingTransactions;
    }

    private static function getSOFAOtherTransactions($sofaData)
    {
        $OtherTransactions = [];
        if (Helper::validate_key_value('Property_all', $sofaData, 'radio') == 1) {
            $property_all_data = Helper::validate_key_value('Property_all_data', $sofaData, 'array');
            $OtherTransactionsDataCount = count($property_all_data['name']);
            for ($i = 0; $i < $OtherTransactionsDataCount; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("state", $property_all_data, $i);
                $OtherTransactionsArray = [
                                                "Relationship" => Helper::validate_key_loop_value_exclude_comma("relationship_to_you", $property_all_data, $i),
                                                "SOFATransactionType" => 23,
                                                "Description" => Helper::validate_key_loop_value_exclude_comma("property_exchange", $property_all_data, $i),
                                                "SOFAPeriodType" => 4,
                                                "RecipientName" => Helper::validate_key_loop_value_exclude_comma("name", $property_all_data, $i),
                                                "Payments" => [
                                                    [
                                                        "Date" => Helper::validate_key_loop_value_exclude_comma("property_transfer_date", $property_all_data, $i),
                                                        "Amount" => '',
                                                        "Description" => Helper::validate_key_loop_value_exclude_comma("property_transfer_value", $property_all_data, $i)
                                                    ]
                                                ],
                                                "RecipientAddress" => [
                                                    "Street1" => Helper::validate_key_loop_value('street_number', $property_all_data, $i),
                                                    "Unit" => '',
                                                    "City" => Helper::validate_key_loop_value('city', $property_all_data, $i),
                                                    "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                                    "Zip" => Helper::validate_key_loop_value('zip', $property_all_data, $i),
                                                    "IsMailingAddress" => true
                                                ]
                                            ];
                if (is_array($OtherTransactions)) {
                    array_push($OtherTransactions, $OtherTransactionsArray);
                }
            }
        }
        if (Helper::validate_key_value('all_property_transfer_10_year', $sofaData, 'radio') == 1) {
            $all_property_transfer_10_year_data = Helper::validate_key_value('all_property_transfer_10_year_data', $sofaData, 'array');
            $propertyTransferDataCount = count($all_property_transfer_10_year_data['trust_name']);
            for ($i = 0; $i < $propertyTransferDataCount; $i++) {
                $PropertyTransferArray = [
                                                "SOFATransactionType" => 24,
                                                "Description" => Helper::validate_key_loop_value_exclude_comma("trust_name", $all_property_transfer_10_year_data, $i),
                                                "SOFAPeriodType" => 5,
                                                "Payments" => [
                                                    [
                                                        "Date" => Helper::validate_key_loop_value_exclude_comma("10year_property_transfer_date", $all_property_transfer_10_year_data, $i),
                                                        "Description" => Helper::validate_key_loop_value_exclude_comma("10year_property_transfer", $all_property_transfer_10_year_data, $i)
                                                    ],
                                                ]
                                            ];
                if (is_array($OtherTransactions)) {
                    array_push($OtherTransactions, $PropertyTransferArray);
                }
            }
        }

        return $OtherTransactions;
    }

    private static function getSOFASOFASetoffs($sofaData)
    {
        $SetoffsCreditor = [];
        if (Helper::validate_key_value('setoffs_creditor', $sofaData, 'radio') == 1) {
            $setoffs_creditor_data = Helper::validate_key_value('setoffs_creditor_data', $sofaData, 'array');
            $SetoffsCreditorDataCount = count($setoffs_creditor_data['creditors_address']);
            for ($i = 0; $i < $SetoffsCreditorDataCount; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("creditor_state", $setoffs_creditor_data, $i);
                $SetoffsCreditorArray = [
                                            "AccountNumber" => Helper::validate_key_loop_value_exclude_comma("account_number", $setoffs_creditor_data, $i),
                                            "Value" => (float)Helper::validate_key_loop_value_exclude_comma("amount_data", $setoffs_creditor_data, $i),
                                            "SOFALegalActionType" => 14,
                                            "Description" => Helper::validate_key_loop_value_exclude_comma("creditors_action", $setoffs_creditor_data, $i),
                                            "Date" => Helper::validate_key_loop_value_exclude_comma("date_action", $setoffs_creditor_data, $i),
                                            "PartyName" => Helper::validate_key_loop_value_exclude_comma("creditors_address", $setoffs_creditor_data, $i),
                                            "PartyAddress" => [
                                                "Street1" => Helper::validate_key_loop_value('creditor_street', $setoffs_creditor_data, $i),
                                                "Unit" => '',
                                                "City" => Helper::validate_key_loop_value('creditor_city', $setoffs_creditor_data, $i),
                                                "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                                "Zip" => Helper::validate_key_loop_value('creditor_zip', $setoffs_creditor_data, $i),
                                                "IsMailingAddress" => true
                                                ]
                                        ];
                if (is_array($SetoffsCreditor)) {
                    array_push($SetoffsCreditor, $SetoffsCreditorArray);
                }
            }
        }

        return $SetoffsCreditor;
    }

    private static function getSOFAIncomes($sofaData)
    {
        $Incomes = [];
        if (Helper::validate_key_value('total_amount_income', $sofaData) == 1) {
            $Incomes = self::getSOFAIncomesArray($Incomes, $sofaData, 'total_amount_this_year', 'total_amount_this_year_income', 1, 1);
            $Incomes = self::getSOFAIncomesArray($Incomes, $sofaData, 'total_amount_last_year', 'total_amount_last_year_income', 1, 2);
            $Incomes = self::getSOFAIncomesArray($Incomes, $sofaData, 'total_amount_lastbefore_year', 'total_amount_lastbefore_year_income', 1, 3);
        }
        if (Helper::validate_key_value('total_amount_income_spouse', $sofaData) == 1) {
            $Incomes = self::getSOFAIncomesArray($Incomes, $sofaData, 'total_amount_spouse_this_year', 'total_amount_spouse_this_year_income', 2, 1);
            $Incomes = self::getSOFAIncomesArray($Incomes, $sofaData, 'total_amount_spouse_last_year', 'total_amount_spouse_last_year_income', 2, 2);
            $Incomes = self::getSOFAIncomesArray($Incomes, $sofaData, 'total_amount_spouse_lastbefore_year', 'total_amount_spouse_lastbefore_year_income', 2, 3);
        }


        if (Helper::validate_key_value('other_income_received_income', $sofaData) == 1) {
            $currentYearArrayD1 = Helper::validate_key_value('other_income_received_this_year', $sofaData, 'array');
            if (is_array($currentYearArrayD1)) {
                for ($i = 0; $i < count($currentYearArrayD1); $i++) {
                    $incomeObject = self::getSOFAOtherIncomesArray($sofaData, $i, 'other_amount_this_year_income', 'other_income_received_this_year', 1, 1);
                    $Incomes[] = $incomeObject;
                }
            }

            $lastYearArrayD1 = Helper::validate_key_value('other_income_received_last_year', $sofaData, 'array');
            if (is_array($lastYearArrayD1)) {
                for ($i = 0; $i < count($lastYearArrayD1); $i++) {
                    $incomeObject = self::getSOFAOtherIncomesArray($sofaData, $i, 'other_amount_last_year_income', 'other_income_received_last_year', 1, 2);
                    $Incomes[] = $incomeObject;
                }
            }
            $lastBeforeYearArrayD1 = Helper::validate_key_value('other_income_received_lastbefore_year', $sofaData, 'array');
            if (is_array($lastBeforeYearArrayD1)) {
                for ($i = 0; $i < count($lastBeforeYearArrayD1); $i++) {
                    $incomeObject = self::getSOFAOtherIncomesArray($sofaData, $i, 'other_amount_lastbefore_year_income', 'other_income_received_lastbefore_year', 1, 3);
                    $Incomes[] = $incomeObject;
                }
            }

            $currentYearArrayD2 = Helper::validate_key_value('other_income_received_spouse_this_year', $sofaData, 'array');
            if (is_array($currentYearArrayD2)) {
                for ($i = 0; $i < count($currentYearArrayD2); $i++) {
                    $incomeObject = self::getSOFAOtherIncomesArray($sofaData, $i, 'other_amount_spouse_this_year_income', 'other_income_received_spouse_this_year', 2, 1);
                    $Incomes[] = $incomeObject;
                }
            }
            $lastYearArrayD2 = Helper::validate_key_value('other_income_received_spouse_last_year', $sofaData, 'array');
            if (is_array($lastYearArrayD2)) {
                for ($i = 0; $i < count($lastYearArrayD2); $i++) {
                    $incomeObject = self::getSOFAOtherIncomesArray($sofaData, $i, 'other_amount_spouse_last_year_income', 'other_income_received_spouse_last_year', 2, 2);
                    $Incomes[] = $incomeObject;
                }
            }
            $lastBeforeYearArrayD2 = Helper::validate_key_value('other_income_received_spouse_lastbefore_year', $sofaData, 'array');
            if (is_array($lastBeforeYearArrayD2)) {
                for ($i = 0; $i < count($lastBeforeYearArrayD2); $i++) {
                    $incomeObject = self::getSOFAOtherIncomesArray($sofaData, $i, 'other_amount_spouse_lastbefore_year_income', 'other_income_received_spouse_lastbefore_year', 2, 3);
                    $Incomes[] = $incomeObject;
                }
            }
        }

        return $Incomes;
    }

    private static function getSOFAIncomesArray($Incomes, $mainDataArray, $incomeTypeKey = '', $amountKey = '', $debtorType = '', $periodType = '')
    {
        $data = [];
        $data1 = [];
        $data2 = [];
        if (isset($mainDataArray[$amountKey.'_extra']) && $mainDataArray[$amountKey.'_extra'] != null) {
            $typeA = $mainDataArray[$incomeTypeKey];
            $typeB = $mainDataArray[$incomeTypeKey.'_extra'];
            $amountA = (float)Helper::validate_key_value($amountKey, $mainDataArray);
            $amountB = (float)Helper::validate_key_value($amountKey.'_extra', $mainDataArray);
            $totalAmount = $amountA + $amountB;
            // case same
            if ($typeA == $typeB) {
                $data = [
                    "SOFAIncomeType" => 5,
                    "AmountAsDecimal" => $totalAmount,
                    "IncomeType" => $typeA == 1 ? 1 : 2,
                    "DebtorType" => $debtorType,
                    "Amount" => (int)($totalAmount),
                    "Description" => "Income",
                    "PeriodType" => $periodType
                ];
                array_push($Incomes, $data);
            }
            if ($typeA != $typeB) {
                $data1 = [
                    "SOFAIncomeType" => 5,
                    "AmountAsDecimal" => Helper::validate_key_value($amountKey, $mainDataArray),
                    "IncomeType" => Helper::validate_key_value($incomeTypeKey, $mainDataArray) == 1 ? 1 : 2,
                    "DebtorType" => $debtorType,
                    "Amount" => (int)(Helper::validate_key_value($amountKey, $mainDataArray)),
                    "Description" => "Income",
                    "PeriodType" => $periodType
                ];
                array_push($Incomes, $data1);
                $data2 = [
                    "SOFAIncomeType" => 5,
                    "AmountAsDecimal" => Helper::validate_key_value($amountKey.'_extra', $mainDataArray),
                    "IncomeType" => Helper::validate_key_value($incomeTypeKey.'_extra', $mainDataArray) == 1 ? 1 : 2,
                    "DebtorType" => $debtorType,
                    "Amount" => (int)(Helper::validate_key_value($amountKey.'_extra', $mainDataArray)),
                    "Description" => "Income",
                    "PeriodType" => $periodType
                ];
                array_push($Incomes, $data2);
            }

        } else {
            $data = [
                "SOFAIncomeType" => 5,
                "AmountAsDecimal" => Helper::validate_key_value($amountKey, $mainDataArray),
                "IncomeType" => Helper::validate_key_value($incomeTypeKey, $mainDataArray) == 1 ? 1 : 2,
                "DebtorType" => $debtorType,
                "Amount" => (int)(Helper::validate_key_value($amountKey, $mainDataArray)),
                "Description" => "Income",
                "PeriodType" => $periodType
            ];
            array_push($Incomes, $data);
        }

        return $Incomes;
    }

    private static function getSOFAOtherIncomesArray($mainDataArray, $index, $amountKey = '', $descriptionKey = '', $debtorType = '', $periodType = '')
    {

        $amount = Helper::validate_key_value($amountKey, $mainDataArray, 'array');
        $description = Helper::validate_key_value($descriptionKey, $mainDataArray, 'array');

        return  [
            "SOFAIncomeType" => 5,
            "AmountAsDecimal" => (float)Helper::validate_key_value($index, $amount),
            "IncomeType" => 3,
            "DebtorType" => $debtorType,
            "Amount" => (int)(Helper::validate_key_value($index, $amount)),
            "Description" => Helper::getSourceOfIncomeArray(Helper::validate_key_value($index, $description)),
            "PeriodType" => $periodType,
        ];
    }

    private static function getSOFAPriorAddresses($sofaData)
    {
        $PriorAddresses = [];
        if (empty($sofaData)) {
            return $PriorAddresses;
        }
        if (Helper::validate_key_value('list_every_address', $sofaData, 'radio') != 1) {
            $prior_addresses_data = Helper::validate_key_value('prev_address', $sofaData, 'array');
            if (!empty($prior_addresses_data)) {
                $prior_addresses_data_count = count($prior_addresses_data['creditor_street']);
                for ($i = 0; $i < $prior_addresses_data_count; $i++) {
                    $DebtorType = Helper::validate_key_loop_value_exclude_comma("debtor", $prior_addresses_data, $i);
                    $DebtorType = strtolower($DebtorType);
                    if ($DebtorType == "debtor 1") {
                        $DebtorType = 1;
                    } elseif ($DebtorType == "debtor 2") {
                        $DebtorType = 2;
                    } elseif ($DebtorType == "both") {
                        $DebtorType = 3;
                    }
                    $DebtorType = empty($DebtorType) ? 1 : $DebtorType;
                    $stateCode = Helper::validate_key_loop_value_exclude_comma("creditor_state", $prior_addresses_data, $i);
                    $PriorAddressesArray = [
                                                "Address" => "",
                                                "DebtorType" => $DebtorType,
                                                "Street1" => Helper::validate_key_loop_value_exclude_comma("creditor_street", $prior_addresses_data, $i),
                                                "Street2" => "",
                                                "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                                "City" => Helper::validate_key_loop_value_exclude_comma("creditor_city", $prior_addresses_data, $i),
                                                "Zip" => Helper::validate_key_loop_value_exclude_comma("creditor_zip", $prior_addresses_data, $i),
                                                "ResidedOnFrom" => Helper::validate_key_loop_value_exclude_comma("from", $prior_addresses_data, $i),
                                                "ResidedOnTo" => Helper::validate_key_loop_value_exclude_comma("to", $prior_addresses_data, $i)
                                            ];
                    if (is_array($PriorAddresses)) {
                        array_push($PriorAddresses, $PriorAddressesArray);
                    }
                }
            }
        }

        return $PriorAddresses;
    }

    private static function getSOFABankAccounts($sofaData)
    {
        $BankAccounts = [];
        if (Helper::validate_key_value('list_all_financial_accounts', $sofaData, 'radio') == 1) {
            $bank_accounts_data = Helper::validate_key_value('list_all_financial_accounts_data', $sofaData, 'array');
            $bank_accounts_data_count = count($bank_accounts_data['institution_name']);
            for ($i = 0; $i < $bank_accounts_data_count; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("state", $bank_accounts_data, $i);
                $BankAccountsArray = [
                                        "SOFAAccountType" => 26,
                                        "PartyName" => Helper::validate_key_loop_value_exclude_comma("institution_name", $bank_accounts_data, $i),
                                        "AccountNumber" => Helper::validate_key_loop_value_exclude_comma("account_number", $bank_accounts_data, $i),
                                        "PartyAddress" => [
                                            "Street1" => Helper::validate_key_loop_value('street_number', $bank_accounts_data, $i),
                                            "Unit" => '',
                                            "City" => Helper::validate_key_loop_value('city', $bank_accounts_data, $i),
                                            "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                            "Zip" => Helper::validate_key_loop_value('zip', $bank_accounts_data, $i),
                                            "IsMailingAddress" => true
                                        ],
                                        "AccountType" => Helper::validate_key_loop_value_exclude_comma("type_of_account", $bank_accounts_data, $i),
                                        "Date" => Helper::validate_key_loop_value_exclude_comma("date_account_closed", $bank_accounts_data, $i),
                                        "Value" => (float)Helper::validate_key_loop_value_exclude_comma("last_balance", $bank_accounts_data, $i),
                                    ];
                if (is_array($BankAccounts)) {
                    array_push($BankAccounts, $BankAccountsArray);
                }
            }
        }

        return $BankAccounts;
    }

    private static function getSOFASafeDepositAccounts($data)
    {
        $SafeDepositAccounts = [];
        if (Helper::validate_key_value('list_safe_deposit', $data, 'radio') == 1) {
            $safe_deposit_data = Helper::validate_key_value('list_safe_deposit_data', $data, 'array');
            $safe_deposit_data_count = count($safe_deposit_data['name']);
            for ($i = 0; $i < $safe_deposit_data_count; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("state", $safe_deposit_data, $i);
                $boStateCode = Helper::validate_key_loop_value_exclude_comma("bo_state", $safe_deposit_data, $i);
                $Obj = [
                            "SOFAAccountType" => 27,
                            "PartyName" => Helper::validate_key_loop_value_exclude_comma("name", $safe_deposit_data, $i),
                            "PartyAddress" => [
                                "Street1" => Helper::validate_key_loop_value('street_number', $safe_deposit_data, $i),
                                "Unit" => '',
                                "City" => Helper::validate_key_loop_value('city', $safe_deposit_data, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                "Zip" => Helper::validate_key_loop_value('zip', $safe_deposit_data, $i),
                                "IsMailingAddress" => true
                            ],
                            "AssociatedPartyName" => Helper::validate_key_loop_value_exclude_comma("bo_name", $safe_deposit_data, $i),
                            "AssociatedPartyAddress" => [
                                "Street1" => Helper::validate_key_loop_value('bo_street_number', $safe_deposit_data, $i),
                                "Unit" => '',
                                "City" => Helper::validate_key_loop_value('bo_city', $safe_deposit_data, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($boStateCode),
                                "Zip" => Helper::validate_key_loop_value('bo_zip', $safe_deposit_data, $i),
                                "IsMailingAddress" => true
                            ],
                            "HasAccess" => (int)Helper::validate_key_loop_value_exclude_comma("still_have_safe_deposite", $safe_deposit_data, $i),
                            "Description" => Helper::validate_key_loop_value_exclude_comma("contents", $safe_deposit_data, $i),
                        ];
                if (is_array($SafeDepositAccounts)) {
                    array_push($SafeDepositAccounts, $Obj);
                }
            }
        }

        return $SafeDepositAccounts;
    }

    private static function getSOFAStorageAccounts($data)
    {
        $StorageAccounts = [];
        if (Helper::validate_key_value('other_storage_unit', $data, 'radio') == 1) {
            $storage_unit = Helper::validate_key_value('other_storage_unit_data', $data, 'array');
            $storage_unit_count = count($storage_unit['name']);
            for ($i = 0; $i < $storage_unit_count; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("state", $storage_unit, $i);
                $bdStateCode = Helper::validate_key_loop_value_exclude_comma("bd_state", $storage_unit, $i);
                $Obj = [
                            "SOFAAccountType" => 28,
                            "PartyName" => Helper::validate_key_loop_value_exclude_comma("name", $storage_unit, $i),
                            "PartyAddress" => [
                                "Street1" => Helper::validate_key_loop_value('street_number', $storage_unit, $i),
                                "Unit" => '',
                                "City" => Helper::validate_key_loop_value('city', $storage_unit, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                "Zip" => Helper::validate_key_loop_value('zip', $storage_unit, $i),
                                "IsMailingAddress" => true
                            ],
                            "AssociatedPartyName" => Helper::validate_key_loop_value_exclude_comma("bd_name", $storage_unit, $i),
                            "AssociatedPartyAddress" => [
                                "Street1" => Helper::validate_key_loop_value('bd_street_number', $storage_unit, $i),
                                "Unit" => '',
                                "City" => Helper::validate_key_loop_value('bd_city', $storage_unit, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($bdStateCode),
                                "Zip" => Helper::validate_key_loop_value('bd_zip', $storage_unit, $i),
                                "IsMailingAddress" => true
                            ],
                            "HasAccess" => (int)Helper::validate_key_loop_value_exclude_comma("still_have_storage_unit", $storage_unit, $i),
                            "Description" => Helper::validate_key_loop_value_exclude_comma("contents", $storage_unit, $i),
                        ];
                if (is_array($StorageAccounts)) {
                    array_push($StorageAccounts, $Obj);
                }
            }
        }

        return $StorageAccounts;
    }

    private static function getSOFAThirdPartyAccounts($data)
    {
        $ThirdPartyAccounts = [];
        if (Helper::validate_key_value('list_property_you_hold', $data, 'radio') == 1) {
            $property_you_hold = Helper::validate_key_value('list_property_you_hold_data', $data, 'array');
            $property_you_hold_count = count($property_you_hold['name']);
            for ($i = 0; $i < $property_you_hold_count; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("state", $property_you_hold, $i);
                $relatedStateCode = Helper::validate_key_loop_value_exclude_comma("location_state", $property_you_hold, $i);
                $Obj = [
                            "SOFAAccountType" => 29,
                            "PartyName" => Helper::validate_key_loop_value_exclude_comma("name", $property_you_hold, $i),
                            "PartyAddress" => [
                                "Street1" => Helper::validate_key_loop_value('street_number', $property_you_hold, $i),
                                "Unit" => '',
                                "City" => Helper::validate_key_loop_value('city', $property_you_hold, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                "Zip" => Helper::validate_key_loop_value('zip', $property_you_hold, $i),
                                "IsMailingAddress" => true
                            ],
                            "RelatedAddress" => [
                                "Street1" => Helper::validate_key_loop_value('location_street_number', $property_you_hold, $i),
                                "Unit" => '',
                                "City" => Helper::validate_key_loop_value('location_city', $property_you_hold, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($relatedStateCode),
                                "Zip" => Helper::validate_key_loop_value('location_zip', $property_you_hold, $i),
                                "IsMailingAddress" => true
                            ],
                            "Description" => Helper::validate_key_loop_value_exclude_comma("property_desc", $property_you_hold, $i),
                            "Value" => (int)Helper::validate_key_loop_value_exclude_comma("property_value", $property_you_hold, $i),
                        ];
                if (is_array($ThirdPartyAccounts)) {
                    array_push($ThirdPartyAccounts, $Obj);
                }
            }
        }

        return $ThirdPartyAccounts;
    }

    private static function getSOFAEnvironmentals($data)
    {
        $environmentals = [];
        // Q24
        $q24Data = [];
        if (Helper::validate_key_value('list_noticeby_gov', $data, 'radio') == 1) {
            $q24_data = Helper::validate_key_value('list_noticeby_gov_data', $data, 'array');
            $q24_data_count = count($q24_data['name']);
            for ($i = 0; $i < $q24_data_count; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("state", $q24_data, $i);
                $partyStateCode = Helper::validate_key_loop_value_exclude_comma("gov_state", $q24_data, $i);
                $Obj = [
                            "Type" => 2,
                            "SOFALegalActionType" => 31,
                            "SiteName" => Helper::validate_key_loop_value_exclude_comma("name", $q24_data, $i),
                            "SiteAddress" => [
                                "Street1" => Helper::validate_key_loop_value('street_number', $q24_data, $i),
                                "Unit" => "",
                                "City" => Helper::validate_key_loop_value('city', $q24_data, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                "Zip" => Helper::validate_key_loop_value('zip', $q24_data, $i),
                                "IsMailingAddress" => true
                            ],
                            "PartyName" => Helper::validate_key_loop_value_exclude_comma("gov_name", $q24_data, $i),
                            "PartyAddress" => [
                                "Street1" => Helper::validate_key_loop_value('gov_street_number', $q24_data, $i),
                                "Unit" => "",
                                "City" => Helper::validate_key_loop_value('gov_city', $q24_data, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($partyStateCode),
                                "Zip" => Helper::validate_key_loop_value('gov_zip', $q24_data, $i),
                                "IsMailingAddress" => true
                            ],
                            "Date" => Helper::validate_key_loop_value('notice_date', $q24_data, $i),
                            "Description" => Helper::validate_key_loop_value('environmental_law', $q24_data, $i)
                        ];
                if (is_array($q24Data)) {
                    array_push($q24Data, $Obj);
                }
            }
        }
        // Q25
        $q25Data = [];
        if (Helper::validate_key_value('list_environment_law', $data, 'radio') == 1) {
            $q25_data = Helper::validate_key_value('list_environment_law_data', $data, 'array');
            $q25_data_count = count($q25_data['name']);
            for ($i = 0; $i < $q25_data_count; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("state", $q25_data, $i);
                $partyStateCode = Helper::validate_key_loop_value_exclude_comma("gov_state", $q25_data, $i);
                $Obj = [
                            "Type" => 3,
                            "SOFALegalActionType" => 32,
                            "SiteName" => Helper::validate_key_loop_value_exclude_comma("name", $q25_data, $i),
                            "SiteAddress" => [
                                "Street1" => Helper::validate_key_loop_value('street_number', $q25_data, $i),
                                "Unit" => "",
                                "City" => Helper::validate_key_loop_value('city', $q25_data, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                "Zip" => Helper::validate_key_loop_value('zip', $q25_data, $i),
                                "IsMailingAddress" => true
                            ],
                            "PartyName" => Helper::validate_key_loop_value_exclude_comma("gov_name", $q25_data, $i),
                            "PartyAddress" => [
                                "Street1" => Helper::validate_key_loop_value('gov_street_number', $q25_data, $i),
                                "Unit" => "",
                                "City" => Helper::validate_key_loop_value('gov_city', $q25_data, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($partyStateCode),
                                "Zip" => Helper::validate_key_loop_value('gov_zip', $q25_data, $i),
                                "IsMailingAddress" => true
                            ],
                            "Date" => Helper::validate_key_loop_value('notice_date', $q25_data, $i),
                            "Description" => Helper::validate_key_loop_value('environment_law_know', $q25_data, $i)
                        ];
                if (is_array($q25Data)) {
                    array_push($q25Data, $Obj);
                }
            }
        }
        // Q26
        $q26Data = [];
        if (Helper::validate_key_value('list_judicial_proceedings', $data, 'radio') == 1) {
            $q26_data = Helper::validate_key_value('list_judicial_proceedings_data', $data, 'array');
            $q26_data_count = count($q26_data['name']);
            for ($i = 0; $i < $q26_data_count; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("", $q26_data, $i);
                $partyStateCode = Helper::validate_key_loop_value_exclude_comma("state", $q26_data, $i);
                $Obj = [
                            "Type" => 1,
                            "SOFALegalActionType" => 33,
                            "Status" => (int)Helper::validate_key_loop_value('case_status', $q26_data, $i),
                            "PartyName" => Helper::validate_key_loop_value_exclude_comma("name", $q26_data, $i),
                            "PartyAddress" => [
                                "Street1" => Helper::validate_key_loop_value('street_number', $q26_data, $i),
                                "Unit" => "",
                                "City" => Helper::validate_key_loop_value('city', $q26_data, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($partyStateCode),
                                "Zip" => Helper::validate_key_loop_value('zip', $q26_data, $i),
                                "IsMailingAddress" => true
                            ],
                            "CaseTitle" => Helper::validate_key_loop_value('case_name', $q26_data, $i),
                            "CaseNumber" => Helper::validate_key_loop_value('case_number', $q26_data, $i),
                            "Description" => Helper::validate_key_loop_value('case_nature', $q26_data, $i)
                        ];
                if (is_array($q26Data)) {
                    array_push($q26Data, $Obj);
                }
            }
        }

        $dataArrays = [$q24Data, $q25Data, $q26Data];
        foreach ($dataArrays as $dataArray) {
            if (!empty($dataArray)) {
                $environmentals = array_merge($environmentals, $dataArray);
            }
        }

        return $environmentals;
    }

    private static function getSOFABusinessRelations($data)
    {
        $businessRelations = [];
        if (Helper::validate_key_value('list_financial_institutions', $data, 'radio') == 1) {
            $business_relation_data = Helper::validate_key_value('list_financial_institutions_data', $data, 'array');
            $business_relation_data_count = count($business_relation_data['name']);
            for ($i = 0; $i < $business_relation_data_count; $i++) {
                $stateCode = Helper::validate_key_loop_value_exclude_comma("state", $business_relation_data, $i);
                $Obj = [
                            "Type" => 42,
                            "Name" => Helper::validate_key_loop_value_exclude_comma("name", $business_relation_data, $i),
                            "Address" => [
                                "Street1" => Helper::validate_key_loop_value('street_number', $business_relation_data, $i),
                                "Unit" => "",
                                "City" => Helper::validate_key_loop_value('city', $business_relation_data, $i),
                                "StateId" => AddressHelper::getStateCodeForJubliee($stateCode),
                                "Zip" => Helper::validate_key_loop_value('zip', $business_relation_data, $i),
                                "IsMailingAddress" => true
                            ],
                            "StartOn" => Helper::validate_key_loop_value('date_issued', $business_relation_data, $i)
                        ];
                if (is_array($businessRelations)) {
                    array_push($businessRelations, $Obj);
                }
            }
        }

        return $businessRelations;
    }

    private static function getDependentsData($info)
    {
        if (isset($info) && !empty($info)) {
            $data = [];
            if (Helper::validate_key_value('any_dependents', $info, 'radio') == 1) {
                $dependent_relationship = Helper::validate_key_value('dependent_relationship', $info);
                $dependent_age = Helper::validate_key_value('dependent_age', $info);
                $dependent_live_with = Helper::validate_key_value('dependent_live_with', $info);
                foreach ($dependent_relationship as $i => $relationship) {
                    $roleId = 51; // 51 - Other
                    if (in_array(strtolower($relationship), ['husband', 'wife', 'spouse'])) {
                        $roleId = 27; // 27 - Spouse
                    }
                    if (in_array(strtolower($relationship), ['son', 'daughter', 'stepson', 'stepdaughter', 'foster son', 'foster daughter'])) {
                        $roleId = 28; // 28 - Child
                    }
                    if (in_array(strtolower($relationship), ['father', 'mother', 'father-in-low', 'mother-in-low'])) {
                        $roleId = 29; // 29 - Parent
                    }
                    if (in_array(strtolower($relationship), ['nephew', 'niece', 'grandson', 'granddaughter', 'grandfather', 'grandmother', 'uncle', 'aunt', 'son-in-low', 'daughter-in-low'])) {
                        $roleId = 30; // 30 - Relative
                    }
                    if (in_array(strtolower($relationship), ['brother', 'sister'])) {
                        $roleId = 48; // 48 - Sibling
                    }
                    $livesWithParent = (Helper::validate_key_value($i, $dependent_live_with) == 1) ? true : false ;
                    $dataObject = [
                                        "Name" => [
                                            "FirstName" => "",
                                            "LastName" => "",
                                            "MiddleName" => ""
                                        ],
                                        "AgeType" => 0, // if want to use DOB instead of Age, set AgeType = 1
                                        "Age" => Helper::validate_key_value($i, $dependent_age),
                                        "DateOfBirth" => "", // available if AgeType = 1, format '12/12/1990'
                                        "RoleId" => $roleId, // 27 - Spouse, 28 - Child, 29 - Parent, 30 - Relative, 48 - Sibling, 51 - Other
                                        "LivesWithParent" => $livesWithParent
                                    ];

                    if ($roleId == 51) {
                        $dataObject["Other"] = "";  // Available when RoleId = 51
                    }
                    if (is_array($data)) {
                        array_push($data, $dataObject);
                    }
                }
            }

            return $data;
        }

        return null;
    }

    private static function getBusinessesData($sofaData, $debtorType)
    {
        $data = [];
        $businessData = Helper::validate_key_value('list_nature_business_data', $sofaData, 'array');
        if (isset($businessData) && !empty($businessData) && is_array($businessData)) {

            if (isset($businessData['own_business_selection'])) {
                foreach ($businessData['own_business_selection'] as $i => $type) {

                    if ($type == $debtorType) {

                        $companyType = 99;
                        switch (Helper::validate_key_loop_value('type', $businessData, $i)) {
                            case 1: $companyType = 99;
                                break;
                            case 2: $companyType = 2;
                                break;
                            case 3: $companyType = 1;
                                break;
                            case 4: $companyType = 3;
                                break;
                        }

                        $natureOfBusiness = '';
                        if (Helper::validate_key_loop_value('type', $businessData, $i) == 3) {
                            switch (Helper::validate_key_loop_value('type', $businessData, $i)) {
                                case 1: $natureOfBusiness = 1;
                                    break;
                                case 2: $natureOfBusiness = 2;
                                    break;
                                case 3: $natureOfBusiness = 4;
                                    break;
                                case 4: $natureOfBusiness = 5;
                                    break;
                                case 5: $natureOfBusiness = 98;
                                    break;
                            }
                        }

                        $companyDetails = [
                            "Type" => $companyType, // 1 - Sole Proprietorship, 2 - Corporation, 3 - Partnership, 99 - Other
                            "IsSmallBusiness" => false,
                            "IsSubChapterV" => false,
                            "EstablishedOn" => Helper::validate_key_loop_value('operation_date', $businessData, $i),
                            "AccountantName" => Helper::validate_key_loop_value('business_accountant', $businessData, $i)
                        ];
                        if ($natureOfBusiness) {
                            $companyDetails["NatureOfBusiness"] = $natureOfBusiness; // 1 - Health Care Business, 2 - Single Asset Real Estate, 3 - Railroad, 4 - Stockbroker, 5 - Commodity Broker, 6 - Clearing Bank, 98 - Other/None of the above
                            if ($natureOfBusiness == 98) {
                                $companyDetails["NatureOfBusinessOther"] = Helper::validate_key_loop_value('business_nature', $businessData, $i);  // available if "NatureOfBusiness" = 98
                            }
                        }
                        if (Helper::validate_key_loop_value('business_still_open', $businessData, $i) !== '1') {
                            $companyDetails["ClosedOn"] = Helper::validate_key_loop_value('operation_date2', $businessData, $i);
                        }
                        $company = [
                            "DisplayName" => Helper::validate_key_loop_value('name', $businessData, $i),
                            "Address" => [
                                    "Street1" => Helper::validate_key_loop_value('street_number', $businessData, $i),
                                    "City" => Helper::validate_key_loop_value('city', $businessData, $i),
                                    "Zip" => Helper::validate_key_loop_value('zip', $businessData, $i),
                                    "StateId" => 0,
                                    "IsMailingAddress" => true,
                                    "StateAbb" => Helper::validate_key_loop_value('state', $businessData, $i)
                                ],
                            "CompanyDetails" => $companyDetails
                        ];
                        if (Helper::validate_key_loop_value('doesntHaveEin', $businessData, $i) !== '1') {
                            $company["SocialNumber"] = Helper::validate_key_loop_value('eiin', $businessData, $i); // EIN
                        }
                        $isCurrentSoleProprietor = ($companyType == 1) ? true : false;
                        $dataObject = [
                            "Title" => Helper::validate_key_loop_value('name', $businessData, $i),
                            "Company" => $company,
                            "IsOfficerOfCorporation" => false,
                            "IsBusinessTradeName" => false,
                            "IsCurrentSoleProprietor" => $isCurrentSoleProprietor,
                            "IncludeOnSOFA" => true
                        ];
                        if ($isCurrentSoleProprietor) {
                            $dataObject["Alias"] = 99;  // Alias available if "IsCurrentSoleProprietor" is true (2 - dba, 3 - fdba, 99 - n/a)
                        }

                        if (is_array($data)) {
                            array_push($data, $dataObject);
                        }
                    }
                }
            }


        }

        return $data;
    }

    private static function getNoticingPartiesData($request, $sofaData, $baseContent, $allDebts)
    {

        if (empty($allDebts)) {
            return [];
        }

        $data = [];
        $i = 1;

        // Process unsecured debts
        if (Helper::validate_key_value('does_not_have_additional_creditor', $allDebts) == "1") {
            $unsecuredDebts = Helper::validate_key_value('debt_tax', $allDebts);
            $unsecuredDebts = json_decode($unsecuredDebts, true);
            $unsecuredCheckedNp = $request->input('unsecured_np', []);
            foreach ($unsecuredDebts as $debtKey => $debt) {
                $originalCreditor = Helper::validate_key_value('original_creditor', $debt);
                if ($originalCreditor != '1' && is_array($unsecuredCheckedNp) && array_key_exists($debtKey, $unsecuredCheckedNp)) {
                    $object = [
                        "Id" => $i,
                        "CompanyName" => Helper::validate_key_value('second_creditor_name', $debt),
                        "Address" => [
                            "Street1" => Helper::validate_key_value('second_creditor_information', $debt),
                            "City" => Helper::validate_key_value('second_creditor_city', $debt),
                            "Zip" => Helper::validate_key_value('second_creditor_zip', $debt),
                            "StateId" => 0,
                            "IsMailingAddress" => true,
                            "StateAbb" => Helper::validate_key_value('second_creditor_state', $debt),
                        ],
                        "Phone" => ["Value" => ""],
                        "AccNo" => Helper::validate_key_value('amount_number', $debt)
                    ];
                    $data[] = $object;
                    $i++;
                }
            }
        }

        $pairs = [];
        $debts = $baseContent['Case_Debts'];

        // Create a mapping of creditor names to debt IDs
        $creditorNameMap = [];
        foreach ($debts as $debt) {
            if (isset($debt['RelationData'])) {
                $creditorName = $debt['RelationData']['second_creditor_name'];
                $debtId = $debt['RelationData']['Id'];
                $creditorNameMap[] = [
                    "debtId" => $debtId,
                    "creditorName" => $creditorName,
                ];
            }

        }

        // Iterate over the unsecured debts and find the corresponding DebtId based on the creditor name
        foreach ($data as $party) {
            $companyName = $party['CompanyName'];
            $debtId = '';
            foreach ($creditorNameMap as $map) {
                if ($map['creditorName'] === $companyName) {
                    $debtId = $map['debtId'];
                    break;
                }
            }
            if (!empty($debtId)) {
                $object = [
                    "DebtId" => $debtId,
                    "NPId" => $party['Id']
                ];
                $pairs[] = $object;
            }
        }

        // Process domestic support debts
        $dsoData = [];
        if (Helper::validate_key_value('domestic_support', $allDebts) == "1") {
            $domesticDebts = Helper::validate_key_value('domestic_tax', $allDebts);
            $domesticDebts = json_decode($domesticDebts, true);
            $domesticSupportCheckedNp = $request->input('domestic_support_np', []);

            foreach ($domesticDebts as $debtKey => $debt) {
                if (array_key_exists($debtKey, $domesticSupportCheckedNp)) {
                    $domesticSupportCheckedNpData = Helper::validate_key_value($debtKey, $domesticSupportCheckedNp, 'array');

                    $domesticAddress = AddressHelper::getDomesticAddressStatesList(Helper::validate_key_value('domestic_address_state', $debt));
                    if (is_array($domesticSupportCheckedNpData) && array_key_exists(0, $domesticSupportCheckedNpData)) {
                        $objectA = [
                            "Id" => $i,
                            "CompanyName" => Helper::validate_key_value('address_name', $domesticAddress),
                            "Address" => [
                                "Street1" => Helper::validate_key_value('address_street', $domesticAddress),
                                "City" => Helper::validate_key_value('address_city', $domesticAddress),
                                "Zip" => Helper::validate_key_value('address_zip', $domesticAddress),
                                "StateId" => 0,
                                "IsMailingAddress" => true,
                                "StateAbb" => Helper::validate_key_value('address_state', $domesticAddress),
                            ],
                            "Phone" => ["Value" => ""],
                            "AccNo" => Helper::validate_key_value('domestic_support_account', $debt)
                        ];
                        $data[] = $objectA;
                        $dsoData[] = $objectA;
                        $i++;
                    }
                    if (is_array($domesticSupportCheckedNpData) && array_key_exists(1, $domesticSupportCheckedNpData)) {
                        $objectB = [
                            "Id" => $i,
                            "CompanyName" => Helper::validate_key_value('notify_address_name', $domesticAddress),
                            "Address" => [
                                "Street1" => Helper::validate_key_value('notify_address_street', $domesticAddress),
                                "City" => Helper::validate_key_value('notify_address_city', $domesticAddress),
                                "Zip" => Helper::validate_key_value('notify_address_zip', $domesticAddress),
                                "StateId" => 0,
                                "IsMailingAddress" => true,
                                "StateAbb" => Helper::validate_key_value('address_state', $domesticAddress),
                            ],
                            "Phone" => ["Value" => ""],
                            "AccNo" => Helper::validate_key_value('domestic_support_account', $debt)
                        ];
                        $data[] = $objectB;
                        $dsoData[] = $objectB;
                        $i++;
                    }
                }
            }
        }

        // Create a mapping of domestic support account numbers to debt IDs
        $AccNoMapDso = [];
        foreach ($debts as $debt) {
            if ($debt['Debt']['Description'] == 'Domestic support Tax') {
                $AccNo = $debt['Debt']['AccNo'];
                $debtId = $debt['Debt']['Id'];
                $AccNoMapDso[] = [
                    "debtId" => $debtId,
                    "AccNo" => $AccNo,
                ];
            }
        }

        // Iterate over the domestic support debts and find the corresponding DebtId based on the account number
        foreach ($dsoData as $party) {
            $AccNo = $party['AccNo'];
            $debtId = '';
            foreach ($AccNoMapDso as $map) {
                if ($map['AccNo'] === $AccNo) {
                    $debtId = $map['debtId'];
                    break;
                }
            }
            if (!empty($debtId)) {
                $object = [
                    "DebtId" => $debtId,
                    "NPId" => $party['Id']
                ];
                $pairs[] = $object;
            }
        }


        $lawsuitDebtData = [];

        foreach ($debts as $debt) {
            if (isset($debt['Debt'])) {
                if (isset($debt['Debt']['Description']) && $debt['Debt']['Description'] == 'Law Suit') {
                    $creditorName = $debt['Creditor']['Name'];
                    $debtId = $debt['Debt']['Id'];
                    $AccNo = $debt['Debt']['AccNo'];
                    $lawsuitDebtData[] = [
                        "debtId" => $debtId,
                        "creditorName" => $creditorName,
                        "AccNo" => $AccNo,
                    ];
                }
            }
        }

        usort($lawsuitDebtData, function ($a, $b) {
            return strnatcasecmp($a['creditorName'], $b['creditorName']);
        });
        $lawsuitDebtData = array_values($lawsuitDebtData);

        $Lawsuits = self::getLawsuitsForNoticingParties($sofaData);
        if (!empty($Lawsuits)) {
            foreach ($Lawsuits as $key => $lawsuitData) {
                $relatedTo = Helper::validate_key_value('related_to', $lawsuitData, 'radio');
                $agencyLocation = Helper::validate_key_value('agency_location', $lawsuitData);
                if (isset($relatedTo) && !empty($agencyLocation)) {
                    $debtId = isset($lawsuitDebtData[$relatedTo]['debtId']) ? $lawsuitDebtData[$relatedTo]['debtId'] : '';
                    $lawsuitObject = [
                        "Id" => $i,
                        "CompanyName" => Helper::validate_key_value('agency_location', $lawsuitData),
                        "Address" => [
                            "Street1" => Helper::validate_key_value('agency_street', $lawsuitData),
                            "City" => Helper::validate_key_value('agency_city', $lawsuitData),
                            "Zip" => Helper::validate_key_value('agency_zip', $lawsuitData),
                            "StateId" => 0,
                            "IsMailingAddress" => true,
                            "StateAbb" => Helper::validate_key_value('agency_state', $lawsuitData),
                        ],
                        "Phone" => ["Value" => ""],
                        "AccNo" => Helper::validate_key_value('case_number', $lawsuitData),
                    ];
                    $data[] = $lawsuitObject;

                    if (!empty($debtId)) {
                        $object = [
                            "DebtId" => $debtId,
                            "NPId" => $i
                        ];
                        $pairs[] = $object;
                    }
                    $i++;
                }
            }
        }

        $returnData = [
                            "NoticingParties" => $data,
                            "NoticingPartyPairs" => $pairs
                        ];

        return $returnData;
    }

    private static function getLawsuitsForNoticingParties($sofaData)
    {
        $Lawsuit = [];
        if (Helper::validate_key_value('list_lawsuits', $sofaData, 'radio') == 1) {
            $list_lawsuits_data = Helper::validate_key_value('list_lawsuits_data', $sofaData, 'array');
            foreach ($list_lawsuits_data as $key => $values) {
                foreach ($values as $index => $value) {
                    $Lawsuit[$index][$key] = $value;
                }
            }
        }

        return $Lawsuit;
    }

    private static function getLiablePartiesData()
    {
        $liableParties = self::$LiableParties;
        $parties = [];
        if (!empty($liableParties)) {
            $LPId = 1;
            foreach ($liableParties as $key => $party) {
                $sampleObject = [
                        "Id" => $LPId,
                        "PersonName" => Helper::validate_key_value('Name', $party),
                        "Address" => [
                            "Street1" => Helper::validate_key_value('Address1', $party),
                            "City" => Helper::validate_key_value('City', $party),
                            "Zip" => Helper::validate_key_value('Zip', $party),
                            "StateId" => AddressHelper::getStateCodeForJubliee(Helper::validate_key_value('State', $party)),
                            "IsMailingAddress" => true,
                            "StateAbb" => Helper::validate_key_value('State', $party)
                        ],
                        "Phone" => [
                            "Value" => ""
                        ],
                        "Email" => [
                            "Value" => ""
                        ]
                ];
                if (Helper::validate_key_value('DebtId', $party, 'radio')) {
                    self::$LiableParties[$key]['LPId'] = $LPId;
                }

                array_push($parties, $sampleObject);

                $LPId++;
            }
        }

        return $parties;
    }

    private static function getLiablePartyPairsData()
    {
        $liableParties = self::$LiableParties;
        $pairs = [];
        if (!empty($liableParties)) {
            foreach ($liableParties as $key => $party) {
                $sampleObject = [
                        "DebtId" => Helper::validate_key_value('DebtId', $party, 'radio'), // DebtId = Case_Debts.Debt.Id
                        "LPId" => Helper::validate_key_value('LPId', $party, 'radio') // LPId = LiableParties.Id
                ];
                array_push($pairs, $sampleObject);
            }
        }

        return $pairs;
    }

    private static function getBankruptcyCases($partCData)
    {
        $cases = [];

        if (!isset($partCData) && empty($partCData)) {
            return $cases;
        }

        $partCData = self::finalBasicInfoPartC($partCData);

        if (Helper::validate_key_value('pending_pior_cases', $partCData, 'radio') != 1) {
            return $cases;
        }

        // Add LastEightYears cases to $cases array,
        $cases = self::getCasesLastEightYearsObject($partCData, $cases);
        // Add Pending cases to $cases array,
        $cases = self::getCasesPendingObject($partCData, $cases);
        // Add EverFiled cases to $cases array,
        $cases = self::getEverFiledObject($partCData, $cases);

        return $cases;
    }

    private static function finalBasicInfoPartC($BasicInfo_PartC)
    {
        $final_BasicInfo_PartC = [];
        if (!empty($BasicInfo_PartC)) {
            foreach ($BasicInfo_PartC->toArray() as $k => $v) {
                if (is_array($v)) {
                    $adata[$k] = $v;
                    $final_BasicInfo_PartC[$k] = $adata[$k];
                } else {
                    $final_BasicInfo_PartC[$k] = $v;
                }
            }
        }

        return $final_BasicInfo_PartC;
    }

    private static function getCasesLastEightYearsObject($data, $cases)
    {
        if (Helper::validate_key_value('filed_bankruptcy_case_last_8years', $data, 'radio') != 1) {
            return $cases;
        }

        $filedState = Helper::validate_key_value('case_filed_state', $data);
        if (!empty($filedState) && is_array($filedState)) {

            $caseNo = Helper::validate_key_value('case_number', $data);
            $dateFiled = Helper::validate_key_value('date_filed', $data);
            $wasDismissed = Helper::validate_key_value('is_case_dismissed', $data);
            foreach ($filedState as $key => $value) {

                $sample =
                    [
                        "Id" => "",
                        "DebtorName" => "",
                        "Type" => 1,
                        "CaseNumber" => Helper::validate_key_value($key, $caseNo),
                        "CaseStatus" => (Helper::validate_key_value($key, $wasDismissed, 'radio') == 1) ? 4 : 1, // 4 for dismissed and 1 for filed
                        "Relationship" => "",
                        "FiledOn" => date("Y-m-d", strtotime(Helper::validate_key_value($key, $dateFiled))),
                        "stateId" => self::getStateIdByDistrictName(Helper::validate_key_value($key, $filedState)),
                        "DistrictId" => "",
                        "DivisionId" => "",
                    ];
                array_push($cases, $sample);
            }
        }

        return $cases;
    }

    private static function getCasesPendingObject($data, $cases)
    {
        if (Helper::validate_key_value('any_bankruptcy_cases_pending', $data, 'radio') != 1) {
            return $cases;
        }

        $pendingCasesData = Helper::validate_key_value('any_bankruptcy_cases_pending_data', $data);
        if (!empty($pendingCasesData) && is_array($pendingCasesData)) {
            $debtorName = Helper::validate_key_value('debator_name', $pendingCasesData);
            $relationship = Helper::validate_key_value('your_relationship', $pendingCasesData);
            $partnerCaseNumber = Helper::validate_key_value('partner_case_number', $pendingCasesData);
            $partnerDateFiled = Helper::validate_key_value('partner_date_filed', $pendingCasesData);
            $district = Helper::validate_key_value('district', $pendingCasesData);
            foreach ($debtorName as $key => $value) {
                $sample =
                    [
                        "Id" => "",
                        "DebtorName" => Helper::validate_key_value($key, $debtorName),
                        "Type" => 2,
                        "CaseNumber" => Helper::validate_key_value($key, $partnerCaseNumber),
                        "CaseStatus" => 2, // for pending
                        "Relationship" => Helper::validate_key_value($key, $relationship),
                        "FiledOn" => date("Y-m-d", strtotime(Helper::validate_key_value($key, $partnerDateFiled))),
                        "stateId" => self::getStateIdByDistrictName(Helper::validate_key_value($key, $district)),
                        "DistrictId" => "",
                        "DivisionId" => "",
                    ];
                array_push($cases, $sample);
            }
        }

        return $cases;
    }

    private static function getEverFiledObject($data, $cases)
    {
        if (Helper::validate_key_value('bankruptcy_filed_before', $data, 'radio') != 1) {
            return $cases;
        }

        $everFiledData = Helper::validate_key_value('any_bankruptcy_filed_before_data', $data);
        if (!empty($everFiledData) && is_array($everFiledData)) {
            $caseName = Helper::validate_key_value('case_name', $everFiledData);
            $dateFiled = Helper::validate_key_value('data_field', $everFiledData);
            $caseNo = Helper::validate_key_value('case_numbers', $everFiledData);
            $dateDischarged = Helper::validate_key_value('date_discharged', $everFiledData);
            $districtIfKnown = Helper::validate_key_value('district_if_known', $everFiledData);
            foreach ($caseName as $key => $value) {
                $sample =
                    [
                        "Id" => "",
                        "DebtorName" => "",
                        "Type" => "",
                        "CaseNumber" => Helper::validate_key_value($key, $caseNo),
                        "CaseStatus" => 5, // for discharged
                        "Relationship" => "",
                        "FiledOn" => date("Y-m-d", strtotime(Helper::validate_key_value($key, $dateFiled))),
                        "stateId" => self::getStateIdByDistrictName(Helper::validate_key_value($key, $districtIfKnown)),
                        "DistrictId" => "",
                        "DivisionId" => "",
                    ];
                array_push($cases, $sample);
            }
        }

        return $cases;
    }

    private static function getStateIdByDistrictName($name)
    {
        if (empty($name)) {
            return "";
        }
        $short_name = \App\Models\Districts::where('district_name', $name)->first();
        if (!isset($short_name) && empty($short_name)) {
            return "";
        }

        return AddressHelper::getStateCodeForJubliee(AddressHelper::getStateCodeByStateNameForJubliee($short_name->short_name));
    }

    private static function getTenantsObject($data)
    {
        if (empty($data)) {
            return [];
        }

        $rentData = $data->where('currently_lived', 0)->first();
        if (!isset($rentData) && empty($rentData)) {
            return [];
        }

        $rentData = $rentData->toArray();

        $tenants = [
            "Debtor1Rents" => Helper::validate_key_value('currently_lived', $rentData, 'radio') == 0,
        ];

        if (Helper::validate_key_value('eviction_pending', $rentData, 'radio') == 1) {
            $pendingData = Helper::validate_key_value('eviction_pending_data', $rentData);

            $tenants = [
                "Debtor1Rents" => true,
                "Debtor1LandlordHasJudgement" => true,
            ];

            if (!empty($pendingData)) {
                $pendingData = json_decode($pendingData, true);
                $tenants['LandlordName'] = Helper::validate_key_value('Name', $pendingData);
                $tenants['LandlordAddress'] = [
                    "Street1" => Helper::validate_key_value('Address', $pendingData),
                    "City" => Helper::validate_key_value('City', $pendingData),
                    "Zip" => Helper::validate_key_value('Zip', $pendingData),
                    "StateId" => AddressHelper::getStateCodeForJubliee(Helper::validate_key_value('State', $pendingData)),
                ];
            }
        }

        return $tenants;
    }

    public static function getFrequencyForJubliee($value)
    {
        if ($value == 1) {
            return 2;
        } elseif ($value == 2) {
            return 3;
        } elseif ($value == 3) {
            return 4;
        } elseif ($value == 4) {
            return 5;
        } elseif ($value == 5) {
            return 99;
        }
    }

}
