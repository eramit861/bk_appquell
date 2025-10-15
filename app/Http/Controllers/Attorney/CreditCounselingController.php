<?php

namespace App\Http\Controllers\Attorney;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use App\Helpers\ClientHelper;
use App\Models\AttorneyCompany;
use App\Models\AttorneyEmployerInformationToClient;
use App\Models\CountyFipsData;
use App\Models\CreditCounselingApiData;
use App\Models\User;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheExpense;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheProperty;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CreditCounselingController extends AttorneyController
{
    public function index(Request $request)
    {

        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];
            $user = User::where('id', $client_id)->first();
            $clientType = $user->client_type;
            $attorney_id = ClientHelper::getClientAttorneyId($client_id);

            $clientRecordData = self::getClientRecordData($user, $clientType, $attorney_id);
            $clientIncomeExpenseData = self::getClientIncomeExpenseData($user);
            $clientNetWorthData = self::getClientNetWorthData($user);

            $responseApi = CreditCounselingApiData::where(['client_id' => $client_id])->select(['username','clientRecordDataResponse','clientIncomeExpenseDataResponse','clientNetWorthDataResponse','certificateStatus'])->first();
            $clientRecordData['UserName'] = $responseApi->username ?? '';
            $clientIncomeExpenseData['UserName'] = $responseApi->username ?? '';
            $clientNetWorthData['UserName'] = $responseApi->username ?? '';

            $viewData = [
                'client_id' => $client_id,
                'clientType' => $clientType,
                'clientRecordData' => $clientRecordData,
                'clientIncomeExpenseData' => $clientIncomeExpenseData,
                'clientNetWorthData' => $clientNetWorthData,
                'responseApi' => $responseApi,
            ];

            $returnHTML = view('attorney.client.credit_counseling.popup')
                ->with($viewData)
                ->render();

            return response()->json(['success' => true, 'html' => $returnHTML]);
        }
    }

    public function getClientRecordData($user, $clientType, $attorney_id)
    {
        $client_id = Helper::validate_key_value('id', $user);
        $basic_info = CacheBasicInfo::getBasicInformationData($client_id, false, true);

        $BasicInfoPartA = empty(Helper::validate_key_value('BasicInfoPartA', $basic_info)) ? [] : Helper::validate_key_value('BasicInfoPartA', $basic_info);
        $basicInfo_AnyOtherName = (!empty($basic_info['BasicInfo_AnyOtherName'])) ? $basic_info['BasicInfo_AnyOtherName']->toArray() : [];
        $BasicInfoPartBData = empty(Helper::validate_key_value('BasicInfoPartB', $basic_info)) ? [] : Helper::validate_key_value('BasicInfoPartB', $basic_info);
        $attorneyCompany = AttorneyCompany::where(['attorney_id' => $attorney_id])->first();
        $attorney = User::where(['id' => $attorney_id, 'role' => 2])->first();


        $debtorSuffix = Helper::validate_key_value('suffix', $BasicInfoPartA, 'radio');
        $debtorDOB = Helper::validate_key_value('date_of_birth', $BasicInfoPartA);
        $debtorHasSSN = Helper::validate_key_value('has_security_number', $BasicInfoPartA, 'radio');
        $debtorSSNKey = ($debtorHasSSN == 0) ? 'security_number' : 'itin';

        $spouseSuffix = Helper::validate_key_value('suffix', $BasicInfoPartBData, 'radio');
        $spouseDOB = Helper::validate_key_value('date_of_birth', $BasicInfoPartBData);
        $spouseHasSSN = Helper::validate_key_value('has_security_number', $BasicInfoPartBData, 'radio');
        $spouseSSNKey = ($spouseHasSSN == 0) ? 'social_security_number' : 'itin';


        $data = [
            // User Credentials & Course Information
            'ReqUser' => 'bkquest',
            'ReqPass' => 'p03stI*N@25',
            'UserName' => '',
            'CourseType' => 'CC',
            'ClassType' => '1',
            'MarriedCourse' => ($clientType == 3) ? 'true' : 'false',
            // Personal Information
            'FirstName' => Helper::validate_key_value('name', $BasicInfoPartA),
            'MiddleInit' => strtoupper(substr(Helper::validate_key_value('middle_name', $BasicInfoPartA) ?? '', 0, 1)),
            'LastName' => Helper::validate_key_value('last_name', $BasicInfoPartA),
            'Suffix' => !empty($debtorSuffix) ? ArrayHelper::getSuffixArray($debtorSuffix) : '',
            'EMail' => Helper::validate_key_value('email', $user),
            'DOB' => date('m/d/Y', strtotime($debtorDOB)),
            'SSN' => substr(Helper::validate_key_value($debtorSSNKey, $BasicInfoPartA), -4),
            // Spouse Information
            'FirstNameSpouse' => ($clientType == 3) ? Helper::validate_key_value('name', $BasicInfoPartBData) : '',
            'MiddleInitSpouse' => ($clientType == 3) ? strtoupper(substr(Helper::validate_key_value('middle_name', $BasicInfoPartBData) ?? '', 0, 1)) : '',
            'LastNameSpouse' => ($clientType == 3) ? Helper::validate_key_value('last_name', $BasicInfoPartBData) : '',
            'SuffixSpouse' => ($clientType == 3 && !empty($spouseSuffix)) ? ArrayHelper::getSuffixArray($spouseSuffix) : '',
            'DOBSpouse' => ($clientType == 3 && !empty($spouseDOB)) ? date('m/d/Y', strtotime($spouseDOB)) : '',
            'SSNSpouse' => ($clientType == 3) ? substr(Helper::validate_key_value($spouseSSNKey, $BasicInfoPartBData), -4) : '',
            // Address & Contact Information
            'Address1' => Helper::validate_key_value('Address', $BasicInfoPartA),
            'Address2' => '',
            'City' => Helper::validate_key_value('City', $BasicInfoPartA),
            'State' => Helper::validate_key_value('state', $BasicInfoPartA),
            'Zip' => Helper::validate_key_value('zip', $BasicInfoPartA),
            'County' => CountyFipsData::get_county_name_by_id(Helper::validate_key_value('country', $BasicInfoPartA)),
            'FState' => Helper::validate_key_value('state', $BasicInfoPartA),
            'HomePhone' => Helper::validate_key_value('home', $basicInfo_AnyOtherName),
            'CellPhone' => Helper::validate_key_value('cell', $basicInfo_AnyOtherName),
            // Attorney & System Information
            'AttorneyName' => Helper::validate_key_value('name', $attorney),
            'AttorneyPhone' => Helper::validate_key_value('attorney_phone', $attorneyCompany),
            'AccessCode' => '',
            'District' => 0,
            'AttorneyEmail' => Helper::validate_key_value('email', $attorney),
            'BCase' => '',
            'AutoRegID' => 0,
            'CustID' => '',
            'SpCustID' => '',
        ];

        return $data;
    }

    public function getClientIncomeExpenseData($user)
    {

        $income_info = CacheIncome::getIncomeData($user->id);

        $debtormonthlyincome = empty(Helper::validate_key_value('debtormonthlyincome', $income_info)) ? [] : Helper::validate_key_value('debtormonthlyincome', $income_info);
        $debtorspousemonthlyincome = empty(Helper::validate_key_value('debtorspousemonthlyincome', $income_info)) ? [] : Helper::validate_key_value('debtorspousemonthlyincome', $income_info);

        $wagesData = Helper::validate_key_value('debtor_gross_wages_month', $debtormonthlyincome);
        $spousewagesData = Helper::validate_key_value('debtor_gross_wages_month', $debtorspousemonthlyincome);

        $expenses_info = CacheExpense::getExpenseData($user->id);
        $debtorExpenses = empty($expenses_info) ? [] : $expenses_info;
        $utilitiesData = Helper::validate_key_value('utilities', $debtorExpenses);
        $mortgagePropertyData = Helper::validate_key_value('mortgage_property', $debtorExpenses);
        $VehiclePymtsData = Helper::validate_key_value('installmentpayments_price', $debtorExpenses);
        $debtorMortgageRentalInsu = (Helper::validate_key_value('mortgage_property1', $debtorExpenses, 'radio') == 1) ? (float)Helper::validate_key_value('rental_insurance_price', $mortgagePropertyData) : '';
        $installment_payment_for_car = (Helper::validate_key_value('installment_payment_for_car', $debtorExpenses, 'radio') == 1) ? array_sum($VehiclePymtsData) : '';


        $spouse_expenses_info = CacheExpense::getExpenseData($user->id, true);
        $spouseExpenses = empty($spouse_expenses_info) ? [] : $spouse_expenses_info;
        $spouseutilitiesData = Helper::validate_key_value('utilities', $spouseExpenses);
        $spousemortgagePropertyData = Helper::validate_key_value('mortgage_property', $spouseExpenses);
        $spouseVehiclePymtsData = Helper::validate_key_value('installmentpayments_price', $spouseExpenses);
        $spouseMortgageRentalInsu = (Helper::validate_key_value('otherRealPropertyNotAddedSpouse', $spouseExpenses, 'radio') == 1) ? (float)Helper::validate_key_value('rental_insurance_price', $spousemortgagePropertyData) : '';
        $spouse_installment_payment_for_car = (Helper::validate_key_value('installment_payment_for_car', $spouseExpenses, 'radio') == 1) ? array_sum($spouseVehiclePymtsData) : '';



        $sumMortgageRentalInsu = '';
        if ($debtorMortgageRentalInsu > 0 && $spouseMortgageRentalInsu > 0) {
            $sumMortgageRentalInsu = $debtorMortgageRentalInsu + $spouseMortgageRentalInsu;
        } else {
            $sumMortgageRentalInsu = max($debtorMortgageRentalInsu, $spouseMortgageRentalInsu);
        }

        $totalInstallmentCar = '';
        if ($installment_payment_for_car > 0 && $spouse_installment_payment_for_car > 0) {
            $totalInstallmentCar = $installment_payment_for_car + $spouse_installment_payment_for_car;
        } else {
            $totalInstallmentCar = max($installment_payment_for_car, $spouse_installment_payment_for_car);
        }

        $totalNetIncome = 0;
        $debtorNetIncome = self::getNetIncome($user, 1, $debtormonthlyincome);
        $spouseNetIncome = self::getNetIncome($user, 2, $debtorspousemonthlyincome);

        $totalNetIncome = (float)$debtorNetIncome + (float)$spouseNetIncome;
        $data = [
            // User Information
            'UserName' => '',
            'ReqUser' => 'bkquest',
            'ReqPass' => 'p03stI*N@25',
            'CourseID' => 0, // currently on hold
            'CourseStatus' => 0, // currently on hold
            // Income
            'Wages' => ($totalNetIncome > 0 ? $totalNetIncome : (float)Helper::validate_key_value(1, $wagesData) + (float)Helper::validate_key_value(1, $spousewagesData)),
            'InterestDivs' => (float)self::getIncomeAverageAmount('royalties', 'royalties_month', $debtormonthlyincome) + (float)self::getIncomeAverageAmount('joints_royalties', 'joints_royalties_month', $debtorspousemonthlyincome),
            'InvestInc' => '',
            'SocSecInc' => (float)self::getIncomeAverageAmount('social_security', 'social_security_month', $debtormonthlyincome) + (float)self::getIncomeAverageAmount('joints_social_security', 'joints_social_security_month', $debtorspousemonthlyincome),
            'RetirePlan' => (float)self::getIncomeAverageAmount('retirement_income', 'retirement_income_month', $debtormonthlyincome) + (float)self::getIncomeAverageAmount('joints_retirement_income', 'joints_retirement_income_month', $debtorspousemonthlyincome),
            'UnemployComp' => (float)self::getIncomeAverageAmount('unemployment_compensation', 'unemployment_compensation_month', $debtormonthlyincome) + (float)self::getIncomeAverageAmount('joints_unemployment_compensation', 'joints_unemployment_compensation_month', $debtorspousemonthlyincome),
            'OtherInc1Name' => ((Helper::validate_key_value('other_sources', $debtormonthlyincome, 'radio') == 1) ? Helper::validate_key_value('other_options_income', $debtormonthlyincome) : '') .', '.  ((Helper::validate_key_value('joints_other_sources', $debtorspousemonthlyincome, 'radio') == 1) ? Helper::validate_key_value('joints_other_sources_of_income', $debtorspousemonthlyincome) : ''),
            'OtherInc1Amt' => (float)self::getIncomeAverageAmount('other_sources', 'other_sources_month', $debtormonthlyincome) + (float)self::getIncomeAverageAmount('joints_other_sources', 'joints_other_sources_month', $debtorspousemonthlyincome),
            'OtherInc2Name' => '',
            'OtherInc2Amt' => '',
            'OtherInc3Name' => '',
            'OtherInc3Amt' => '',
            'Inc_ChildSupport' => self::getIncomeAverageAmount('regular_contributions', 'regular_contributions_month', $debtormonthlyincome) + self::getIncomeAverageAmount('joints_regular_contributions', 'joints_regular_contributions_month', $debtorspousemonthlyincome),
            // Expense
            'Mtg_Rent' => Helper::validate_key_value('rent_home_mortage', $debtorExpenses),
            'PropTax' => '',
            'Home_RentIns' => $sumMortgageRentalInsu,
            'UtilElectric' => (float)Helper::validate_key_value('electricity_heating_price', $utilitiesData) + (float)Helper::validate_key_value('electricity_heating_price', $spouseutilitiesData),
            'UtilGas' => '',
            'Phone' => (float)Helper::validate_key_value('telephone_service_price', $utilitiesData) + (float)Helper::validate_key_value('telephone_service_price', $spouseutilitiesData),
            'Water' => (float)Helper::validate_key_value('water_sewerl_price', $utilitiesData) + (float)Helper::validate_key_value('water_sewerl_price', $spouseutilitiesData),
            'Garbage' => '',
            'Furnishings' => '',
            'HomeSecurity' => '',
            'VehiclePymts' => $totalInstallmentCar,
            'AutoInsur_Reg' => (float)Helper::validate_key_value('auto_insurance_price', $debtorExpenses) + (float)Helper::validate_key_value('auto_insurance_price', $spouseExpenses),
            'Fuel' => '',
            'VehMaint' => '',
            'PublicTrans' => (float)Helper::validate_key_value('transportation_price', $debtorExpenses) + (float)Helper::validate_key_value('transportation_price', $spouseExpenses),
            'Tolls' => '',
            'Groceries' => (float)Helper::validate_key_value('food_housekeeping_price', $debtorExpenses) + (float)Helper::validate_key_value('food_housekeeping_price', $spouseExpenses),
            'OutsideMeals' => '',
            'Snacks' => '',
            'Other' => ((Helper::validate_key_value('other_expense_available', $debtorExpenses, 'radio') == 1) ? (float)Helper::validate_key_value('other_expense_price', $debtorExpenses) : 0) + ((Helper::validate_key_value('other_expense_available', $spouseExpenses, 'radio') == 1) ? (float)Helper::validate_key_value('other_expense_value', $spouseExpenses) : 0),
            'Clothes' => (float)Helper::validate_key_value('laundry_price', $debtorExpenses) + (float)Helper::validate_key_value('laundry_price', $spouseExpenses),
            'Medical_Dental' => (float)Helper::validate_key_value('medical_dental_price', $debtorExpenses) + (float)Helper::validate_key_value('medical_dental_price', $spouseExpenses),
            'HairCare' => (float)Helper::validate_key_value('personal_care_price', $debtorExpenses) + (float)Helper::validate_key_value('personal_care_price', $spouseExpenses),
            'Toiletries' => '',
            'Hobbies' => '',
            'Vacation' => '',
            'Entertainment' => (float)Helper::validate_key_value('entertainment_price', $debtorExpenses) + (float)Helper::validate_key_value('entertainment_price', $spouseExpenses),
            'News_Mags' => '',
            'PhysFit' => '',
            'Cable_Stream' => '',
            'Internet' => '',
            'ProfServ' => '',
            'BankFees' => '',
            'WholeLife' => (float)Helper::validate_key_value('life_insurance_price', $debtorExpenses) + (float)Helper::validate_key_value('life_insurance_price', $spouseExpenses),
            'TermLife' => '',
            'OOP_HealthIns' => (float)Helper::validate_key_value('health_insurance_price', $debtorExpenses) + (float)Helper::validate_key_value('health_insurance_price', $spouseExpenses),
            'DisabilityIns' => '',
            'OthInsurance' => ((float)(Helper::validate_key_value('otherInsurance_notListed', $debtorExpenses, 'radio') == 1) ? (float)Helper::validate_key_value('other_insurance_price', $debtorExpenses) : 0) + ((float)(Helper::validate_key_value('otherInsNotListedSpouse', $spouseExpenses, 'radio') == 1) ? (float)Helper::validate_key_value('other_insurance_price', $spouseExpenses) : 0),
            'ChildCare' => (float)Helper::validate_key_value('childcare_price', $debtorExpenses) + (float)Helper::validate_key_value('childcare_price', $spouseExpenses),
            'Tuition' => '',
            'Allowances' => '',
            'OOP_HealthSavings' => '',
            'Mand_PayrollDeducts' => '',
            'CCPymts' => '',
            'Investments' => '',
            'Retirement' => '',
            'Payroll_MedIns' => '',
            'UnionDues' => (float)Helper::validate_key_value('union_dues_deducted', $debtormonthlyincome) + (float)Helper::validate_key_value('joints_union_dues_deducted', $debtorspousemonthlyincome),
            'Exp_ChildSupport' => ((Helper::validate_key_value('alimony_maintenance', $debtorExpenses, 'radio') == 1) ? (float)Helper::validate_key_value('alimony_price', $debtorExpenses) : 0) + ((Helper::validate_key_value('alimony_maintenance', $spouseExpenses, 'radio') == 1) ? (float)Helper::validate_key_value('alimony_price', $spouseExpenses) : 0),
            'StudentLoans' => '',
            'FoodAssist' => '',
            'CharitableCont' => (float)Helper::validate_key_value('charitablet_price', $debtorExpenses) + (float)Helper::validate_key_value('charitablet_price', $spouseExpenses),
            'Savings' => '',
            'Gifts' => '',
            'FederalTax' => '',
            'StateTax' => ((Helper::validate_key_value('taxbills_not_deducted', $debtorExpenses, 'radio') == 1) ? (float)Helper::validate_key_value('taxbills_price', $debtorExpenses) : 0) + ((Helper::validate_key_value('taxbills_not_deducted', $spouseExpenses, 'radio') == 1) ? (float)Helper::validate_key_value('taxbills_price', $spouseExpenses) : 0),
            'LocalTax' => '',
            'SalesTax' => '',
            'SSMedDeduct' => '',
        ];

        return  $data;
    }

    public static function getNetIncome($client, $clientType, $monthlyIncomeData)
    {
        $client_id = $client->id;

        $netIncomeKey = ($clientType == 1) ? 'debtor_take_home_pay' : 'joints_debtor_take_home_pay';
        $netIncome = Helper::validate_key_value($netIncomeKey, $monthlyIncomeData);
        $condition = [
            'client_id' => $client_id,
            'client_type' => $clientType,
            ];

        $data = AttorneyEmployerInformationToClient::where($condition)->get();
        $data = (isset($data) && !empty($data)) ? $data->toArray() : [];

        if (count($data) == 1) {

            $employer = reset($data);
            $frequency = Helper::validate_key_value('frequency', $employer, 'radio');
            $pay = (float)$netIncome;
            // Once a week
            if ($frequency == 1) {
                // Weekly: weekly pay x by 52 weeks divide it by 12 = $2,166.00 per month
                $netIncome = ($pay * 52) / 12;
            }
            // Every two weeks
            if ($frequency == 2) {
                // By weekly: To be more precise, you can multiply your biweekly pay by 26 (the number of paychecks per year) and then divide by 12 (the number of months in a year)
                $netIncome = ($pay * 26) / 12;
            }
            // Twice a month
            if ($frequency == 3) {
                // Twice a Month: Since semi-monthly pay means paying twice a month, and there are 12 months in a year, there are 12 * 2 = 24 pay periods per year. Divide the annual salary by 24
                $netIncome = $pay * 2;
            }
            // Once a month
            if ($frequency == 4) {
                // Monthly: System should be same as multiple employer
                $netIncome = $pay;
            }

        }

        // Round to 2 decimal places before returning
        return number_format((float)$netIncome, 2, '.', '');
    }

    public function getClientNetWorthData($user)
    {

        $propertyInfo = CacheProperty::getPropertyData($user->id, false, true);

        $financialassets = empty(Helper::validate_key_value('financialassets', $propertyInfo)) ? [] : Helper::validate_key_value('financialassets', $propertyInfo);
        $propertyhousehold = empty(Helper::validate_key_value('propertyhousehold', $propertyInfo)) ? [] : Helper::validate_key_value('propertyhousehold', $propertyInfo);
        $propertyresident = empty(Helper::validate_key_value('propertyresident', $propertyInfo)) ? [] : Helper::validate_key_value('propertyresident', $propertyInfo);
        $propertyvehicle = empty(Helper::validate_key_value('propertyvehicle', $propertyInfo)) ? [] : Helper::validate_key_value('propertyvehicle', $propertyInfo);

        $debtstax = CacheDebt::getDebtData($user->id);

        $debt_tax = Helper::validate_key_value('debt_tax', $debtstax, 'array');
        $back_tax_own = Helper::validate_key_value('back_tax_own', $debtstax, 'array');
        $tax_owned_state = Helper::validate_key_value('tax_owned_state', $debtstax, 'radio');

        $data = [
            // User Credentials
            'UserName' => '',
            'ReqUser' => 'bkquest',
            'ReqPass' => 'p03stI*N@25',
            "CourseID" => 0,
            "CourseStatus" => 0,
            "AsOfDate" => null,
            // Assets
            'Cash' => self::getFinancialAssetAmount('cash', $financialassets),
            'Checking' => self::getFinancialAssetAmountByAccType('bank', 1, $financialassets),
            'Savings' => self::getFinancialAssetAmountByAccType('bank', 2, $financialassets),
            'MMktAcct' => '',
            'CertDep' => self::getFinancialAssetAmountByAccType('bank', 4, $financialassets),
            'CSVLifeIns' => '',
            'ProfitShare' => '',
            'IRAs' => self::getFinancialAssetAmountByAccType('retirement_pension', 3, $financialassets, 'type_of_account'),
            'R401k' => self::getFinancialAssetAmountByAccType('retirement_pension', 1, $financialassets, 'type_of_account'),
            'SEPIRA' => '',
            'Keogh' => self::getFinancialAssetAmountByAccType('retirement_pension', 4, $financialassets, 'type_of_account'),
            'MoneyOwed2U' => self::getFinancialAssetAmount('alimony_child_support', $financialassets),
            'Stocks' => '',
            'MutualFd' => self::getFinancialAssetAmount('mutual_funds', $financialassets),
            'REInvest' => self::getFinancialAssetAmount('trusts_life_estates', $financialassets),
            'OtherInvest1Name' => '',
            'OtherInvest1Amt' => '',
            'OtherInvest2Name' => '',
            'OtherInvest2Amt' => '',
            'OtherInvest3Name' => '',
            'OtherInvest3Amt' => '',
            'Home' => self::getAllHomeAssetValue($propertyresident),
            'VacayProp' => '',
            'Vehicles' => self::getAllVehicleAssetValue($propertyvehicle),
            'Furn_Appl' => self::getHouseHoldAssetAmount('household_goods_furnishings', $propertyhousehold),
            'Jewel_Fur' => self::getHouseHoldAssetAmount('jewelry', $propertyhousehold),
            'Art' => '',
            'MiscProp' => '',
            'OtherProp' => '',
            // liabilities
            'HomeMtg' => self::getAllHomeMortgageAssetValue($propertyresident),
            'VacayMtg' => '',
            'PersLoans' => '',
            'VehicleLoans' => self::getAllVehicleMortgageAssetValue($propertyvehicle),
            'CreditCardBal' => self::getAllUnsecuredLoanByTypeAssetValue(2, $debt_tax),
            'EducationLoans' => self::getAllUnsecuredLoanByTypeAssetValue(5, $debt_tax),
            'InvestLoans' => '',
            'LifeInsLoans' => '',
            'OtherLiab' => '',
            'MedBills' => self::getAllUnsecuredLoanByTypeAssetValue(8, $debt_tax),
            'PaydayLoans' => '',
            'BackTaxes' => $tax_owned_state == 1 ? self::getAllBackTaxLoanAssetValue($back_tax_own) : 0,
            'MuniTickets' => '',
        ];

        return  $data;
    }

    private static function getHouseHoldAssetAmount($type, $data)
    {
        $amount = 0.00;
        if (empty($data)) {
            return $amount;
        }

        foreach ($data as $asset) {
            if (Helper::validate_key_value('type', $asset) == $type && Helper::validate_key_value('type_value', $asset, 'radio') == 1) {

                $type_data = Helper::validate_key_value('type_data', $asset);
                $type_data = json_decode($type_data, true);
                if (is_array($type_data)) {
                    $amount = $type_data[1];
                }
            }
        }

        return $amount;
    }


    private static function getAllHomeAssetValue($data)
    {
        $amount = 0.00;
        if (empty($data)) {
            return $amount;
        }

        foreach ($data as $asset) {
            if (Helper::validate_key_value('currently_lived', $asset, 'radio') == 1) {
                $estimated_property_value = Helper::validate_key_value('estimated_property_value', $asset);
                $amount += (float)$estimated_property_value;
            }
        }

        return $amount;
    }

    private static function getAllHomeMortgageAssetValue($data)
    {
        $amount = 0.00;
        if (empty($data)) {
            return $amount;
        }
        foreach ($data as $asset) {
            if (Helper::validate_key_value('currently_lived', $asset, 'radio') == 1 && Helper::validate_key_value('loan_own_type_property', $asset, 'radio') == 1) {
                $home_car_loan = json_decode(Helper::validate_key_value('home_car_loan', $asset), true);
                $loanAmount1 = Helper::validate_key_value('amount_own', $home_car_loan);
                $amount += (float)$loanAmount1;


                $home_car_loan2 = json_decode(Helper::validate_key_value('home_car_loan2', $asset), true);

                if (Helper::validate_key_value('additional_loan1', $home_car_loan2, 'radio') == 1) {
                    $loanAmount2 = Helper::validate_key_value('amount_own', $home_car_loan2);
                    $amount += (float)$loanAmount2;

                    $home_car_loan3 = json_decode(Helper::validate_key_value('home_car_loan3', $asset), true);
                    if (Helper::validate_key_value('additional_loan2', $home_car_loan3, 'radio') == 1) {
                        $loanAmount3 = Helper::validate_key_value('amount_own', $home_car_loan3);
                        $amount += (float)$loanAmount3;
                    }

                }
            }
        }

        return $amount;
    }

    private static function getAllVehicleAssetValue($data)
    {
        $amount = 0.00;
        if (empty($data)) {
            return $amount;
        }

        foreach ($data as $asset) {
            $estimated_property_value = Helper::validate_key_value('property_estimated_value', $asset);
            $amount += (float)$estimated_property_value;
        }

        return $amount;
    }


    private static function getAllVehicleMortgageAssetValue($data)
    {
        $amount = 0.00;
        if (empty($data)) {
            return $amount;
        }
        foreach ($data as $asset) {
            if (Helper::validate_key_value('loan_own_type_property', $asset, 'radio') == 1) {
                $vehicle_car_loan = json_decode(Helper::validate_key_value('vehicle_car_loan', $asset), true);
                $loanAmount1 = Helper::validate_key_value('amount_own', $vehicle_car_loan);
                $amount += (float)$loanAmount1;
            }
        }

        return $amount;
    }


    private static function getFinancialAssetAmount($type, $data)
    {

        if (empty($data)) {
            return 0.00;
        }

        foreach ($data as $asset) {
            if (Helper::validate_key_value('type', $asset) == $type && Helper::validate_key_value('type_value', $asset, 'radio') == 1) {

                $type_data = Helper::validate_key_value('type_data', $asset);
                $type_data = json_decode($type_data, true);
                if (is_array($type_data)) {
                    $property_value = Helper::validate_key_value('property_value', $type_data);
                    if (is_array($property_value)) {
                        $sum = array_sum($property_value);

                        return $sum;
                    } else {
                        return 0.00;
                    }
                } else {
                    return 0.00;
                }
            }
        }
    }

    private static function getAllUnsecuredLoanByTypeAssetValue($type, $data)
    {
        $amount = 0.00;
        if (empty($data)) {
            return $amount;
        }

        foreach ($data as $asset) {
            if (Helper::validate_key_value('cards_collections', $asset) == $type) {
                $amount_owned = Helper::validate_key_value('amount_owned', $asset);
                $amount += (float)$amount_owned;
            }
        }

        return $amount;
    }


    private static function getAllBackTaxLoanAssetValue($data)
    {
        $amount = 0.00;
        if (empty($data)) {
            return $amount;
        }
        foreach ($data as $asset) {
            $tax_total_due = Helper::validate_key_value('tax_total_due', $asset);
            $amount += (float)$tax_total_due;
        }

        return $amount;
    }
    private static function getFinancialAssetAmountByAccType($type, $accountTypeKey, $data, $accountTypeParentKey = 'account_type')
    {

        if (empty($data)) {
            return 0.00;
        }

        $amount = 0.00;

        foreach ($data as $asset) {
            if (
                Helper::validate_key_value('type', $asset) == $type &&
                Helper::validate_key_value('type_value', $asset, 'radio') == 1
            ) {
                $type_data = Helper::validate_key_value('type_data', $asset);
                $type_data = json_decode($type_data, true);

                if (is_array($type_data)) {
                    $account_type = Helper::validate_key_value($accountTypeParentKey, $type_data);
                    $property_value = Helper::validate_key_value('property_value', $type_data);

                    if (is_array($account_type) && is_array($property_value)) {
                        foreach ($account_type as $key => $value) {
                            if ($value == $accountTypeKey && isset($property_value[$key])) {
                                $amount += (float)$property_value[$key];
                            }
                        }
                    }
                }
            }
        }

        return $amount;
    }

    private static function getIncomeAverageAmount($radioKey, $arrayKey, $data)
    {
        if (Helper::validate_key_value($radioKey, $data, 'radio') == 1) {

            $amountArray = Helper::validate_key_value($arrayKey, $data);
            if (is_array($amountArray)) {
                $sum = array_sum($amountArray);
                $count = count($amountArray);
                $average = $count > 0 ? $sum / $count : 0;

                return number_format($average, 2);
            }
        }

        return 0.00;
    }

    public function save(Request $request)
    {

        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];

            $clientRecordData = Helper::validate_key_value('clientRecordData', $input);
            $clientIncomeExpenseData = Helper::validate_key_value('clientIncomeExpenseData', $input);
            $clientNetWorthData = Helper::validate_key_value('clientNetWorthData', $input);


            $priceFields = [
                'Wages', 'InterestDivs', 'InvestInc', 'SocSecInc', 'RetirePlan', 'UnemployComp',
                'OtherInc1Amt', 'OtherInc2Amt', 'OtherInc3Amt', 'Inc_ChildSupport', 'Mtg_Rent',
                'PropTax', 'Home_RentIns', 'UtilElectric', 'UtilGas', 'Phone', 'Water', 'Garbage',
                'Furnishings', 'HomeSecurity', 'VehiclePymts', 'AutoInsur_Reg', 'Fuel', 'VehMaint',
                'PublicTrans', 'Tolls', 'Groceries', 'OutsideMeals', 'Snacks', 'Other', 'Clothes',
                'Medical_Dental', 'HairCare', 'Toiletries', 'Hobbies', 'Vacation', 'Entertainment',
                'News_Mags', 'PhysFit', 'Cable_Stream', 'Internet', 'ProfServ', 'BankFees',
                'WholeLife', 'TermLife', 'OOP_HealthIns', 'DisabilityIns', 'OthInsurance',
                'ChildCare', 'Tuition', 'Allowances', 'OOP_HealthSavings', 'Mand_PayrollDeducts',
                'CCPymts', 'Investments', 'Retirement', 'Payroll_MedIns', 'UnionDues',
                'Exp_ChildSupport', 'StudentLoans', 'FoodAssist', 'CharitableCont', 'Savings',
                'Gifts', 'FederalTax', 'StateTax', 'LocalTax', 'SalesTax', 'SSMedDeduct'
            ];

            // Process the array
            foreach ($clientIncomeExpenseData as $key => &$value) {
                // Convert null to empty string
                if ($value === null) {
                    $value = "";
                }

                // Convert price fields to decimal
                if (in_array($key, $priceFields) && $value !== "" && is_numeric($value)) {
                    $value = (float)$value;
                }
            }

            $create_client_url = "https://www.acdcas.com/Handler/BKClientIntake.data";
            $clientRecordDataResponse = '';
            $client = new Client();
            $clientRecordDataResponse = $client->post($create_client_url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($clientRecordData)
            ]);

            $clientRecordDataResponse = json_decode($clientRecordDataResponse->getBody(), true);
            $clientUsername = '';
            $incExpResponse = '';
            $netWorthResponse = '';
            $statusResponse = '';

            if ($clientRecordDataResponse['RespStatus'] == 1) {
                $clientUsername = $clientRecordDataResponse['UserName'];
            }
            if ($clientUsername) {
                $income_expense_url = "https://www.acdcas.com/Handler/BKIncExp.data";
                $clientIncomeExpenseData['UserName'] = $clientUsername;
                $incExpResponse = $client->post($income_expense_url, [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode($clientIncomeExpenseData)
                ]);
                $incExpResponse = json_decode($incExpResponse->getBody(), true);

                $priceFields = [
                    'Cash', 'Checking', 'Savings', 'MMktAcct', 'CertDep', 'CSVLifeIns', 'ProfitShare',
                    'IRAs', 'R401k', 'SEPIRA', 'Keogh', 'MoneyOwed2U', 'Stocks', 'MutualFd', 'REInvest',
                    'OtherInvest1Amt', 'OtherInvest2Amt', 'OtherInvest3Amt', 'Home', 'VacayProp', 'Vehicles',
                    'Furn_Appl', 'Jewel_Fur', 'Art', 'MiscProp', 'OtherProp', 'HomeMtg', 'VacayMtg',
                    'PersLoans', 'VehicleLoans', 'CreditCardBal', 'EducationLoans', 'InvestLoans',
                    'LifeInsLoans', 'OtherLiab', 'MedBills', 'PaydayLoans', 'BackTaxes', 'MuniTickets'
                ];

                // Process the array
                foreach ($clientNetWorthData as $key => &$value) {
                    // Convert null to empty string
                    if ($value === null) {
                        $value = "";
                    }

                    // Convert price fields to decimal (float)
                    if (in_array($key, $priceFields) && $value !== "" && is_numeric($value)) {
                        $value = (float)$value;
                    }
                }

                $networth_url = "https://www.acdcas.com/Handler/BKNetWorth.data";
                $clientNetWorthData['UserName'] = $clientUsername;
                $netWorthResponse = $client->post($networth_url, [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode($clientNetWorthData)
                ]);
                $netWorthResponse = json_decode($netWorthResponse->getBody(), true);

                $statusApiJson = json_decode('{"ReqUser":"bkquest","ReqPass":"p03stI*N@25","CourseType":"CC"}', true);
                $statusapi_url = "https://www.acdcas.com/Handler/BKClientStatus.data";
                $statusApiJson['UserName'] = $clientUsername;
                $statusResponse = $client->post($statusapi_url, [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode($statusApiJson)
                ]);

                $statusResponse = json_decode($statusResponse->getBody(), true);
                if (isset($statusResponse['CourseCert']) && self::isValidPdfUrl($statusResponse['CourseCert']) && !empty($statusResponse['CourseCert'])) {
                    $fileresponse = Http::timeout(300)->get($statusResponse['CourseCert']);
                    if (!$fileresponse->successful()) {
                        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', "Failed to download file. HTTP status: " . $fileresponse->status());
                    }
                    \App\Models\ClientDocumentUploadedData::uploadCcCertificate($client_id, $fileresponse, $statusResponse);
                }
            }


            $dataToSave = [
                'client_id' => $client_id,
                'username' => $clientUsername > 0 ? $clientUsername : '',
                'status' => 0,
                'clientRecordDataJSON' => json_encode($clientRecordData),
                'clientRecordDataResponse' => json_encode($clientRecordDataResponse),
                'clientIncomeExpenseDataJSON' => json_encode($clientIncomeExpenseData),
                'clientIncomeExpenseDataResponse' => json_encode($incExpResponse),
                'clientNetWorthDataJSON' => json_encode($clientNetWorthData),
                'clientNetWorthDataResponse' => json_encode($netWorthResponse),
                'certificateStatus' => json_encode($statusResponse),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
            CreditCounselingApiData::updateOrCreate(["client_id" => $client_id], $dataToSave);

            return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('success', 'Data has been saved successfully.');

        }
    }
    private static function isValidPdfUrl($url)
    {
        // Check basic URL structure
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        return true;
    }


}
