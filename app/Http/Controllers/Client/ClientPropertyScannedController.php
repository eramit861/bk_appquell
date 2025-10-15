<?php

namespace App\Http\Controllers\Client;

use App\Helpers\AddressHelper;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\AutoLoanCompanies;
use App\Models\FinancialAffairs;
use App\Models\Mortgages;
use App\Models\UploadedOcrData;
use App\Services\Client\CacheProperty;
use App\Services\Client\CacheSOFA;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientPropertyScannedController extends Controller
{
    public function setup_scanned_property(Request $request)
    {
        $client_id = Auth::user()->id;
        if ($request->isMethod('post')) {
            $input = $request->all();
            $ocrId = $input['ocr_id'] ?? 0;
            if ($ocrId < 0) {
                return redirect()->back()->with('error', "Invalid request");
            }
            $account_number = $input['account_number'] ?? '';
            $amount_own = $input['amount_own'] ?? '';
            $loan_company = $input['loan_company'] ?? '';
            $address = $input['address'] ?? '';
            $city = $input['city'] ?? '';
            $state = $input['state'] ?? '';
            $zip = $input['zip'] ?? '';
            $monthly_payment = $input['monthly_payment'] ?? '';
            $vin_number = $input['vin_number'] ?? '';
            $selectedVehicle = $input['vehicle'] ?? 0;
            $past_due_amount = $input['past_due_amount'] ?? '';

            $propertData = [];
            $vehicle = [];
            if ($selectedVehicle > 0) {
                $PropertyData = CacheProperty::getPropertyData($client_id);
                $vehicle = Helper::validate_key_value('propertyvehicle', $PropertyData, 'array');
                $vehicle = !empty($vehicle) ? $vehicle->toArray() : [];
            }
            if ($selectedVehicle > 0 && !empty($vehicle)) {
                $propertData['property_year'] = $input['property_year'] ?? '';
                $propertData['property_make'] = $input['property_make'] ?? '';
                $propertData['property_model'] = $input['property_model'] ?? '';
                $propertData['property_other_info'] = $input['property_other_info'] ?? '';
                $propertData['vin_number'] = $vin_number;
                $masterData = ['alcomp_name' => $loan_company, 'alcomp_address' => $address, 'alcomp_city' => $city, 'alcomp_state' => $state, 'alcomp_zip' => $zip];
                AutoLoanCompanies::updateOrCreate($masterData, $masterData);
                $loan = ['past_due_amount' => $past_due_amount,'amount_own' => $amount_own, 'account_number' => $account_number, 'monthly_payment' => $monthly_payment, 'creditor_name' => $loan_company, 'creditor_name_addresss' => $address, 'creditor_city' => $city, 'creditor_state' => $state, 'creditor_zip' => $zip];
                $propertData['loan_own_type_property'] = 1;
                $propertData['vehicle_car_loan'] = json_encode($loan);
                if (!empty($propertData)) {
                    Auth::user()->clientsPropertyVehicle()->where(['client_id' => $client_id, 'id' => $vehicle['id']])->update($propertData);
                    UploadedOcrData::where(['id' => $ocrId])->update(['is_imported' => 1]);
                }
                // forget property cache
                CacheProperty::forgetPropertyCache($client_id);

                return redirect()->back()->with('success', 'Data has been updated successfully.');
            }
            if ($selectedVehicle == 0) {
                $masterData = ['alcomp_name' => $loan_company, 'alcomp_address' => $address, 'alcomp_city' => $city, 'alcomp_state' => $state, 'alcomp_zip' => $zip];
                AutoLoanCompanies::updateOrCreate($masterData, $masterData);
                $loan = ['past_due_amount' => $past_due_amount,'amount_own' => $amount_own, 'account_number' => $account_number, 'debt_incurred_date' => '', 'monthly_payment' => $monthly_payment, 'creditor_name' => $loan_company, 'creditor_name_addresss' => $address, 'creditor_city' => $city, 'creditor_state' => $state, 'creditor_zip' => $zip];
                $propertData['loan_own_type_property'] = 1;
                $propertData['own_any_property'] = 1;
                $propertData['client_id'] = $client_id;
                $propertData['property_year'] = $input['property_year'] ?? '';
                $propertData['property_make'] = $input['property_make'] ?? '';
                $propertData['property_model'] = $input['property_model'] ?? '';
                $propertData['property_other_info'] = $input['property_other_info'] ?? '';
                $propertData['vin_number'] = $vin_number ?? '';
                $propertData['vehicle_car_loan'] = json_encode($loan);
                Auth::user()->clientsPropertyVehicle()->create($propertData);
                UploadedOcrData::where(['id' => $ocrId])->update(['is_imported' => 1]);
                // forget property cache
                CacheProperty::forgetPropertyCache($client_id);

                return redirect()->back()->with('success', 'Data has been updated successfully.');
            }
        }
    }
    public function show_scanned_resident(Request $request)
    {
        $client_id = Auth::user()->id;
        if ($request->isMethod('post')) {
            $resident = CacheProperty::getPropertyData($client_id, true, false);
            $clientAddress = AddressHelper::getClientBasicAddress($client_id);
            $residentTypeArray = ['Current_Mortgage_Statement', 'Current_Mortgage_Statement_1_1', 'Current_Mortgage_Statement_2_1', 'Current_Mortgage_Statement_3_1', 'Current_Mortgage_Statement_1_2', 'Current_Mortgage_Statement_2_2','Current_Mortgage_Statement_3_2','Current_Mortgage_Statement_1_3','Current_Mortgage_Statement_2_3','Current_Mortgage_Statement_3_3','Current_Mortgage_Statement_1_4','Current_Mortgage_Statement_2_4','Current_Mortgage_Statement_3_4','Current_Mortgage_Statement_1_5','Current_Mortgage_Statement_2_5','Current_Mortgage_Statement_3_5'];
            $data = UploadedOcrData::where(['is_imported' => 0, 'client_id' => $client_id])->whereIn('document_type', $residentTypeArray)->get()->first();
            $data = $data->toArray() ? $data->toArray() : [];

            return view('client.resident_ocr_form', ['clientAddress' => $clientAddress,'resident' => $resident, 'data' => $data]);
        }
    }
    public function setup_scanned_resident(Request $request)
    {
        $client_id = Auth::user()->id;
        if ($request->isMethod('post')) {
            $input = $request->all();
            $resident = CacheProperty::getPropertyData($client_id, true, false);
            $propertyresident = $resident['propertyresident'];
            $ocrId = $input['ocr_id'] ?? 0;
            if ($ocrId < 0) {
                return redirect()->back()->with('error', "Invalid request");
            }

            $creditor_name = $input['creditor_name'] ?? '';
            $creditor_name_addresss = $input['creditor_name_addresss'] ?? '';
            $creditor_city = $input['creditor_city'] ?? '';
            $creditor_state = $input['creditor_state'] ?? '';
            $creditor_zip = $input['creditor_zip'] ?? '';

            $current_interest_rate = $input['current_interest_rate'] ?? '';
            $amount_own = $input['amount_own'] ?? '';
            $monthly_payment = $input['monthly_payment'] ?? '';
            $account_number = $input['account_number'] ?? '';
            $debt_incurred_date = $input['debt_incurred_date'] ?? '';
            $is_mortgage_three_months = $input['is_mortgage_three_months'] ?? 0;
            $payment_dates_1 = $input['payment_dates_1'] ?? '';
            $payment_dates_2 = $input['payment_dates_2'] ?? '';
            $payment_dates_3 = $input['payment_dates_3'] ?? '';
            $total_amount_paid = $input['total_amount_paid'] ?? '';
            $due_payment = $input['due_payment'] ?? '';

            $import_into_property = $input['import_into_property'] ?? 0;
            $mortgageNoandIndex = explode("_", $import_into_property);

            $i = 1;
            $property = [];
            foreach ($propertyresident as $val) {
                $property[$val['id']] = $val;
                if (isset($val['currently_lived']) && $val['currently_lived'] && $val['loan_own_type_property'] == 1) {
                    $loan1[$i] = json_decode($val['home_car_loan'], 1);
                    if (!empty($val['home_car_loan2'])) {
                        $loan2[$i] = json_decode($val['home_car_loan2'], 1);
                    }

                    if (!empty($val['home_car_loan3'])) {
                        $loan3[$i] = json_decode($val['home_car_loan3'], 1);
                    }
                }
                $i++;
            }

            $propertData = [];
            $is_this_primary_address = $input['is_this_primary_address'] ?? '';
            $mortgage_address = $input['mortgage_address'] ?? '';
            $mortgage_city = $input['mortgage_city'] ?? '';
            $mortgage_state = $input['mortgage_state'] ?? '';
            $mortgage_zip = $input['mortgage_zip'] ?? '';
            $mortgage_county = $input['mortgage_county'] ?? '';
            if (!$is_this_primary_address) {
                $propertData['not_primary_address'] = 1;
                $propertData['mortgage_address'] = $mortgage_address;
                $propertData['mortgage_city'] = $mortgage_city;
                $propertData['mortgage_state'] = $mortgage_state;
                $propertData['mortgage_zip'] = $mortgage_zip;
                $propertData['mortgage_county'] = $mortgage_county;
            }
            if ($import_into_property == 'new') {
                /** check if the add provision reached to max */
                $addedProperties = Auth::user()->clientsPropertyResident;
                if ($addedProperties->count() == 5) {
                    return redirect()->back()->with('error', 'You can only insert 5 properties.');
                }
                $loan1 = [
                    'loan_own_type_property' => 1,
                    'amount_own' => $amount_own,
                    'account_number' => $account_number,
                    'debt_incurred_date' => $debt_incurred_date,
                    'monthly_payment' => $monthly_payment,
                    'creditor_name' => $creditor_name,
                    'creditor_name_addresss' => $creditor_name_addresss,
                    'creditor_city' => $creditor_city,
                    'creditor_state' => $creditor_state,
                    'creditor_zip' => $creditor_zip,
                    'current_interest_rate' => $current_interest_rate,
                    'due_payment' => $due_payment,
                    'payment_tax_insurance' => 1,
                    'is_mortgage_three_months' => $is_mortgage_three_months,
                    'payment_dates_1' => $payment_dates_1,
                    'payment_dates_2' => $payment_dates_2,
                    'payment_dates_3' => $payment_dates_3,
                    'total_amount_paid' => $total_amount_paid,
                ];
                $propertData['loan_own_type_property'] = 1;
                $propertData['currently_lived'] = 1;
                $propertData['client_id'] = $client_id;
                $propertData['home_car_loan'] = json_encode($loan1);
                Auth::user()->clientsPropertyResident()->create($propertData);
            }

            $morgatgeData = [
                'mortgage_name' => $creditor_name,
                'mortgage_address' => $creditor_name_addresss,
                'mortgage_city' => $creditor_city,
                'mortgage_state' => $creditor_state,
                'mortgage_zip' => $creditor_zip,
            ];

            if (!empty($creditor_name)) {
                Mortgages::updateOrCreate($morgatgeData, $morgatgeData);
            }

            if (isset($input['borrower_address']) && !empty($input['borrower_address'])) {
                $addressItems = explode(",", $input['borrower_address']);
                if (!empty($addressItems)) {
                    $addressandCity = explode("\n", $addressItems[0]);
                    $borrowerAddress = $addressandCity[0] ?? '';
                    $borrowerName = $input['borrower_name'] ?? '';
                    $borrowerCity = $addressandCity[1] ?? '';
                    $stateandzip = array_filter(explode(" ", $addressItems[1]));
                    $borrowerstate = is_array($stateandzip) ? current($stateandzip) : '';
                    $creditorzip = is_array($stateandzip) ? end($stateandzip) : '';
                    $zipArray = explode("-", $creditorzip);
                    $borrowerzip = $zipArray[0] ?? '';

                    $morgatgeData = [
                        'mortgage_name' => $borrowerName,
                        'mortgage_address' => $borrowerAddress,
                        'mortgage_city' => $borrowerCity,
                        'mortgage_state' => $borrowerstate,
                        'mortgage_zip' => $borrowerzip,
                    ];

                    if (!empty($borrowerName)) {
                        Mortgages::updateOrCreate($morgatgeData, $morgatgeData);
                    }
                }
            }



            if ($import_into_property != 'new' && $mortgageNoandIndex[0] > 0) {
                $indexarray = explode("-", $mortgageNoandIndex[1]);
                $propertyIndex = $indexarray[1];
                $mortgage = "mortgage".$mortgageNoandIndex[0];

                switch ($mortgage) {
                    case 'mortgage1':
                        $loan1 = [
                            'loan_own_type_property' => 1,
                            'amount_own' => $amount_own,
                            'account_number' => $account_number,
                            'debt_incurred_date' => $debt_incurred_date,
                            'monthly_payment' => $monthly_payment,
                            'creditor_name' => $creditor_name,
                            'creditor_name_addresss' => $creditor_name_addresss,
                            'creditor_city' => $creditor_city,
                            'creditor_state' => $creditor_state,
                            'creditor_zip' => $creditor_zip,
                            'current_interest_rate' => $current_interest_rate,
                            'due_payment' => $due_payment,
                            'payment_tax_insurance' => 1,
                            'is_mortgage_three_months' => $is_mortgage_three_months,
                            'payment_dates_1' => $payment_dates_1,
                            'payment_dates_2' => $payment_dates_2,
                            'payment_dates_3' => $payment_dates_3,
                            'total_amount_paid' => $total_amount_paid,
                        ];

                        if (!empty($property[$propertyIndex])) {
                            $propertData['loan_own_type_property'] = 1;
                            $propertData['home_car_loan'] = json_encode($loan1);
                        }

                        break;

                    case 'mortgage2':
                        $loan2 = [
                            'additional_loan1' => 1,
                            'amount_own' => $amount_own,
                            'account_number' => $account_number,
                            'debt_incurred_date' => $debt_incurred_date,
                            'monthly_payment' => $monthly_payment,
                            'creditor_name' => $creditor_name,
                            'creditor_name_addresss' => $creditor_name_addresss,
                            'creditor_city' => $creditor_city,
                            'creditor_state' => $creditor_state,
                            'creditor_zip' => $creditor_zip,
                            'current_interest_rate' => $current_interest_rate,
                            'due_payment' => $due_payment,
                            'payment_tax_insurance' => 1,
                            'is_mortgage_three_months' => $is_mortgage_three_months,
                            'payment_dates_1' => $payment_dates_1,
                            'payment_dates_2' => $payment_dates_2,
                            'payment_dates_3' => $payment_dates_3,
                            'total_amount_paid' => $total_amount_paid,
                        ];
                        if (!empty($property[$propertyIndex])) {
                            $propertData['home_car_loan2'] = json_encode($loan2);
                        }
                        break;

                    case 'mortgage3':
                        $loan3 = [
                            'additional_loan2' => 1,
                            'amount_own' => $amount_own,
                            'account_number' => $account_number,
                            'debt_incurred_date' => $debt_incurred_date,
                            'monthly_payment' => $monthly_payment,
                            'creditor_name' => $creditor_name,
                            'creditor_name_addresss' => $creditor_name_addresss,
                            'creditor_city' => $creditor_city,
                            'creditor_state' => $creditor_state,
                            'creditor_zip' => $creditor_zip,
                            'current_interest_rate' => $current_interest_rate,
                            'due_payment' => $due_payment,
                            'payment_tax_insurance' => 1,
                            'is_mortgage_three_months' => $is_mortgage_three_months,
                            'payment_dates_1' => $payment_dates_1,
                            'payment_dates_2' => $payment_dates_2,
                            'payment_dates_3' => $payment_dates_3,
                            'total_amount_paid' => $total_amount_paid,
                        ];
                        if (!empty($property[$propertyIndex])) {
                            $propertData['home_car_loan3'] = json_encode($loan3);
                        }
                        break;
                    default:
                        # code...
                        break;
                }
                Auth::user()->clientsPropertyResident()->where(['client_id' => $client_id, 'id' => $propertyIndex])->update($propertData);

                // forget property cache
                CacheProperty::forgetPropertyCache($client_id);

            }


            $amount_still_owed = $input['amount_still_owed'] ?? '';

            UploadedOcrData::where(['id' => $ocrId])->update(['is_imported' => 1]);

            if ($is_mortgage_three_months == 1) {
                $final_input['primarily_consumer_debets'] = 1;
                $creditor = [
                    'creditor_address' => [$creditor_name],
                    'creditor_street' => [$creditor_name_addresss],
                    'creditor_city' => [$creditor_city],
                    'creditor_state' => [$creditor_state],
                    'creditor_zip' => [$creditor_zip],
                    'is_mortgage_three_months' => [$creditor_zip],
                    'payment_dates_1' => [$payment_dates_1],
                    'payment_dates_2' => [$payment_dates_2],
                    'payment_dates_3' => [$payment_dates_3],
                    'total_amount_paid' => [$total_amount_paid],
                    'amount_still_owed' => [$amount_still_owed],
                    'creditor_payment_for' => [1]
                ];
                $final_input['primarily_consumer_debets_data'] = json_encode($creditor);
                $final_input['client_id'] = $client_id;
                FinancialAffairs::updateOrCreate(['client_id' => $client_id], $final_input);
                // clear cache for client SOFA
                CacheSOFA::forgetSOFACache($client_id);
            }
        }

        return redirect()->back()->with('success', 'Data has been updated successfully.');
    }
    public function show_scanned_property(Request $request)
    {
        $client_id = Auth::user()->id;
        if ($request->isMethod('post')) {
            $input = $request->all();
            $ocrId = $input['ocr_id'] ?? 0;
            $resident = CacheProperty::getPropertyData($client_id, true, false);
            $vehcileDoTypeArray = ['Current_Auto_Loan_Statement', 'Current_Auto_Loan_Statement_1', 'Current_Auto_Loan_Statement_2','Current_Auto_Loan_Statement_3','Current_Auto_Loan_Statement_4', 'Other_Loan_Statement_1', 'Other_Loan_Statement_2'];
            $data = UploadedOcrData::where(['id' => $ocrId, 'client_id' => $client_id])->whereIn('document_type', $vehcileDoTypeArray)->get()->first();
            $data = $data->toArray() ? $data->toArray() : [];

            return view('client.property_ocr_form', ['resident' => $resident, 'data' => $data]);
        }
    }

}
