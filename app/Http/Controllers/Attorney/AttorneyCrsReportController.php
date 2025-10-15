<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use App\Helpers\AddressHelper;
use App\Models\ClientsPropertyResident;
use App\Models\ClientsPropertyVehicle;
use App\Models\DebtsTax;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheProperty;
use Illuminate\Http\Request;

class AttorneyCrsReportController extends AttorneyController
{
    public function import_schedule(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $id = $input['id'];
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $import_type = $input['import_type'];
            if ($client_id < 1 || empty($import_type) || $id < 1) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $report = \App\Models\CrsCreditReport::where(["client_id" => $client_id, 'id' => $id])->first()->toArray();
            if (empty($report)) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            return $this->importByCondition($client_id, $import_type, $id, $report, $input);

        }
    }

    private function importByCondition($client_id, $import_type, $id, $report, $input)
    {
        if ($id > 0) {
            \App\Models\CrsCreditReport::where('id', $id)->update(['is_imported' => 1]);
        }
        $clientAddress = AddressHelper::getClientBasicAddress($client_id);
        $PropertyData = CacheProperty::getPropertyData($client_id);

        switch ($import_type) {
            case 'Mortgage':
                $propertyresident = Helper::validate_key_value('propertyresident', $PropertyData, 'array');
                $propertyresident = !empty($propertyresident) ? $propertyresident->toArray() : [];

                return view('attorney.client.import-d-property', ['report_id' => $id, 'client_id' => $client_id,'propertyresident' => $propertyresident, 'clientAddress' => $clientAddress]);
                break;
            case 'Auto':
                $propertyvehicle = Helper::validate_key_value('propertyvehicle', $PropertyData, 'array');
                $propertyvehicle = !empty($propertyvehicle) ? $propertyvehicle->toArray() : [];

                return view('attorney.client.import-d-vehicle', ['report_id' => $id, 'client_id' => $client_id,'propertyvehicle' => $propertyvehicle]);
                break;
            case 'Installment Loan':
                $propertyresident = Helper::validate_key_value('propertyresident', $PropertyData, 'array');
                $propertyresident = !empty($propertyresident) ? $propertyresident->toArray() : [];

                $propertyvehicle = Helper::validate_key_value('propertyvehicle', $PropertyData, 'array');
                $propertyvehicle = !empty($propertyvehicle) ? $propertyvehicle->toArray() : [];

                return view('attorney.client.import-d-installment', ['report_id' => $id, 'client_id' => $client_id,'propertyvehicle' => $propertyvehicle,'propertyresident' => $propertyresident, 'clientAddress' => $clientAddress]);
                break;
            case 'State Taxes':
                $brokenDate = explode("/", $report['date_incurred']);
                $y = isset($brokenDate[1]) && !empty($brokenDate[1]) ? $brokenDate[1] : date('Y');
                $this->saveStateTaxes($report, $client_id, $y);

                return response()->json(Helper::renderJsonSuccess("Record Imported Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
                break;
            case 'Federal Taxes':
                $brokenDate = explode("/", $report['date_incurred']);
                $y = isset($brokenDate[1]) && !empty($brokenDate[1]) ? $brokenDate[1] : date('Y');
                $this->saveFedralTax($report, $client_id, $y);

                return response()->json(Helper::renderJsonSuccess("Record Imported Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
                break;
            case 'DSO':
                $this->dsoTaxData($report, $client_id);

                return response()->json(Helper::renderJsonSuccess("Record Imported Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
                break;
            case 'F Debt Tab':
                $date = $input['date_incurred'] ?? '';
                $this->saveFtabData($report, $client_id, $date);

                return response()->json(Helper::renderJsonSuccess("Record Imported Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
                break;
            default:
                # code...
                break;
        }
    }

    public function import_schedule_d(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $propertyIndex = $input['propertyIndex'];
            $mortgage = $input['mortgage'];
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $report_id = $input['report_id'] ?? 0;
            if ($report_id > 0) {
                \App\Models\CrsCreditReport::where('id', $report_id)->update(['is_imported' => 1]);
            }
            $manual = $input['manual'] ?? 0;
            $data = $this->importMortageCompany($client_id, $input, $report_id, $manual);
            $report = $data['report'];
            $date = $data['date'];
            $property = $data['property'];

            switch ($mortgage) {
                case 'mortgage1':
                    $loan1 = $this->getLoanObject($report, $client_id, $date);
                    if (!empty($property[$propertyIndex])) {
                        $propertData = [];
                        $propertData['loan_own_type_property'] = 1;
                        $propertData['home_car_loan'] = json_encode($loan1);
                    }
                    break;
                case 'mortgage2':
                    $loan2 = $this->getLoanObject($report, $client_id, $date);
                    if (!empty($property[$propertyIndex])) {
                        $propertData = [];
                        $loan2['additional_loan1'] = 1;
                        $propertData['home_car_loan2'] = json_encode($loan2);
                    }
                    break;

                case 'mortgage3':
                    $loan3 = $this->getLoanObject($report, $client_id, $date);
                    if (!empty($property[$propertyIndex])) {
                        $propertData = [];
                        $loan3['additional_loan2'] = 1;
                        $propertData['home_car_loan3'] = json_encode($loan3);
                    }
                    break;
                default:
                    # code...
                    break;
            }
            ClientsPropertyResident::where(['client_id' => $client_id, 'id' => $propertyIndex])->update($propertData);

            // forget property cache
            CacheProperty::forgetPropertyCache($client_id);

            return response()->json(Helper::renderJsonSuccess("Record Updates Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
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

    private function getLoanObject($report, $client_id, $date)
    {
        $user = \App\Models\User::where('id', $client_id)->first();
        $creditLiabilityAccountOwnershipType = $report['creditLiabilityAccountOwnershipType'] ?? '';
        $owned_by = $this->getOwnBy($creditLiabilityAccountOwnershipType);
        $loan = [
            'additional_loan1' => 1,
            'amount_own' => $report['creditLiabilityUnpaidBalanceAmount'],
            'account_number' => Helper::lastchar($report['creditLiabilityAccountIdentifier']),
            'debt_incurred_date' => $date,
            'monthly_payment' => $report['creditLiabilityMonthlyPaymentAmount'],
            'creditor_name' => $report['fullName'],
            'creditor_name_addresss' => $report['address'],
            'creditor_city' => $report['city'],
            'creditor_state' => $report['state'],
            'creditor_zip' => $report['zip'],
            'payment_tax_insurance' => 1,
            'property_owned_by' => $owned_by
        ];
        if ($owned_by == 2 && $user->client_type == 3) {
            $codebtor = Helper::getCodebtorAddress($client_id);
            $loan['codebtor_creditor_name'] = $codebtor['name'];
            $loan['codebtor_creditor_name_addresss'] = $codebtor['address'];
            $loan['codebtor_creditor_city'] = $codebtor['city'];
            $loan['codebtor_creditor_state'] = $codebtor['state'];
            $loan['codebtor_creditor_zip'] = $codebtor['zip'];
        }

        return $loan;

    }

    private function importMortageCompany($client_id, $input, $report_id, $manual)
    {
        $propertyData = CacheProperty::getPropertyData($client_id);
        $propertyresident = Helper::validate_key_value('propertyresident', $propertyData, 'array');
        $propertyresident = !empty($propertyresident) ? $propertyresident->toArray() : [];

        $property = $this->getPropertyArray($propertyresident);

        $date = '';
        if (!$manual) {
            $report = \App\Models\CrsCreditReport::where('id', $report_id)->first()->toArray();
            if (empty($report)) {
                return response()->json(Helper::renderJsonError("Invalid Request!"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $morgatgeData = $this->getMortageDataFromReport($report);
            \App\Models\Mortgages::updateOrCreate($morgatgeData, $morgatgeData);
            $date = $report['date_incurred'];
        }

        if ($manual) {
            $report = $this->getReportFromData($input);
            $morgatgeData = $this->getMortageDataFromReport($report);
            \App\Models\Mortgages::updateOrCreate($morgatgeData, $morgatgeData);
            $date = $input['date_incurred'] ?? '';
        }

        return ['date' => $date, 'report' => $report, 'property' => $property];
    }

    private function getPropertyArray($propertyresident)
    {
        $property = [];
        foreach ($propertyresident as $val) {
            $property[$val['id']] = $val;
        }

        return $property;
    }

    private function getMortageDataFromReport($report)
    {
        return [
            'mortgage_name' => $report['fullName'],
            'mortgage_address' => $report['address'],
            'mortgage_city' => $report['city'],
            'mortgage_state' => $report['state'],
            'mortgage_zip' => $report['zip'],
        ];
    }

    private function getReportFromData($input)
    {
        return [
                'creditLiabilityAccountIdentifier' => isset($input['account']) && !empty($input['account']) ? Helper::lastchar($input['account']) : '',
                'creditLiabilityUnpaidBalanceAmount' => $input['amount'] ?? '',
                'creditLiabilityMonthlyPaymentAmount' => 0,
                'fullName' => $input['name'] ?? '',
                'address' => $input['street'] ?? '',
                'city' => $input['city'] ?? '',
                'state' => $input['state'] ?? '',
                'amount' => $input['amount'] ?? '',
                'zip' => $input['zip'] ?? ''
            ];
    }

    public function import_schedule_d_vehicle(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $propertyIndex = $input['propertyIndex'];
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $report_id = $input['report_id'] ?? 0;
            $manual = $input['manual'] ?? 0;
            if ($report_id > 0) {
                \App\Models\CrsCreditReport::where('id', $report_id)->update(['is_imported' => 1]);
            }

            $PropertyData = CacheProperty::getPropertyData($client_id);
            $propertyvehicle = Helper::validate_key_value('propertyvehicle', $PropertyData, 'array');
            $propertyvehicle = !empty($propertyvehicle) ? $propertyvehicle->toArray() : [];

            $propertyv = $this->getPropertyVehicleArray($propertyvehicle);
            $this->importLoanComp($report_id, $client_id, $propertyv, $propertyIndex, $input, $manual);

            return response()->json(Helper::renderJsonSuccess("Record Imported Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    private function importLoanComp($report_id, $client_id, $propertyv, $propertyIndex, $input, $manual)
    {
        if (!$manual) {
            $report = \App\Models\CrsCreditReport::where('id', $report_id)->first()->toArray();
            if (empty($report)) {
                return response()->json(Helper::renderJsonError("Invalid Request!"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $masterData = [
            'alcomp_name' => $report['fullName'],
            'alcomp_address' => $report['address'],
            'alcomp_city' => $report['city'],
            'alcomp_state' => $report['state'],
            'alcomp_zip' => $report['zip'],
        ];
            \App\Models\AutoLoanCompanies::updateOrCreate($masterData, $masterData);
            $date = $report['date_incurred'];
        }

        if ($manual) {
            $report = [
                'creditLiabilityAccountIdentifier' => isset($input['account']) && !empty($input['account']) ? Helper::lastchar($input['account']) : '',
                'creditLiabilityUnpaidBalanceAmount' => $input['amount'] ?? '',
                'creditLiabilityMonthlyPaymentAmount' => 0,
                'fullName' => $input['name'] ?? '',
                'address' => $input['street'] ?? '',
                'city' => $input['city'] ?? '',
                'state' => $input['state'] ?? '',
                'amount' => $input['amount'] ?? '',
                'zip' => $input['zip'] ?? ''
            ];
            $masterData = [
                'alcomp_name' => $report['fullName'],
                'alcomp_address' => $report['address'],
                'alcomp_city' => $report['city'],
                'alcomp_state' => $report['state'],
                'alcomp_zip' => $report['zip'],
            ];
            \App\Models\AutoLoanCompanies::updateOrCreate($masterData, $masterData);
            $date = $input['date_incurred'] ?? '';
        }

        $loan = [
            'amount_own' => $report['creditLiabilityUnpaidBalanceAmount'],
            'account_number' => Helper::lastchar($report['creditLiabilityAccountIdentifier']),
            'debt_incurred_date' => $date,
            'monthly_payment' => $report['creditLiabilityMonthlyPaymentAmount'],
            'creditor_name' => $report['fullName'],
            'creditor_name_addresss' => $report['address'],
            'creditor_city' => $report['city'],
            'creditor_state' => $report['state'],
            'creditor_zip' => $report['zip']
        ];
        $propertData = [];
        if (!empty($propertyv[$propertyIndex])) {
            $propertData['loan_own_type_property'] = 1;
            $propertData['vehicle_car_loan'] = json_encode($loan);
        }
        if (!empty($propertData)) {
            ClientsPropertyVehicle::where(['client_id' => $client_id, 'id' => $propertyIndex])->update($propertData);
        }
        // forget property cache
        CacheProperty::forgetPropertyCache($client_id);
    }

    private function getPropertyVehicleArray($propertyvehicle)
    {
        $i = 1;
        $propertyv = [];
        foreach ($propertyvehicle as $vehicle) {
            $propertyv[$vehicle['id']] = $vehicle;
            $i++;
        }

        return $propertyv;
    }

    public function manual_save_creditors(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $import_type = $input['import_type'];
            if ($client_id < 1 || empty($import_type)) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $manual = $input['manual'] ?? 0;
            if ($manual) {
                $report = [
                    'creditLiabilityAccountIdentifier' => isset($input['account']) && !empty($input['account']) ? Helper::lastchar($input['account']) : '',
                    'creditLiabilityUnpaidBalanceAmount' => $input['amount'] ?? '',
                    'creditLiabilityMonthlyPaymentAmount' => 0,
                    'fullName' => $input['name'] ?? '',
                    'address' => $input['street'] ?? '',
                    'city' => $input['city'] ?? '',
                    'state' => $input['state'] ?? '',
                    'amount' => $input['amount'] ?? '',
                    'zip' => $input['zip'] ?? '',
                    'creditLiabilityPastDueAmount' => 0,
                ];
                $date = $input['date_incurred'] ?? '';
            }

            switch ($import_type) {
                case 'State Taxes':
                    $brokenDate = explode("/", $date);
                    $y = (is_array($brokenDate) && count($brokenDate) == 3) ? $brokenDate[2] : $brokenDate[1];
                    $report['creditLiabilityPastDueAmount'] = $input['amount'];
                    $this->saveStateTaxes($report, $client_id, $y);
                    break;
                case 'Federal Taxes':
                    $brokenDate = explode("/", $date);
                    $y = (is_array($brokenDate) && count($brokenDate) == 3) ? $brokenDate[2] : $brokenDate[1];
                    $report['creditLiabilityPastDueAmount'] = $input['amount'];
                    $this->saveFedralTax($report, $client_id, $y);
                    break;
                case 'DSO':
                    $report['creditLiabilityPastDueAmount'] = $input['amount'];
                    $this->dsoTaxData($report, $client_id);
                    break;
                case 'F Debt Tab':
                    $report['creditLiabilityPastDueAmount'] = $input['amount'];
                    $this->saveFtabData($report, $client_id, $date);
                    break;
                default:
                    # code...
                    break;
            }

            return response()->json(Helper::renderJsonSuccess("Creditor Imported Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    private function saveStateTaxes($report, $client_id, $y)
    {
        $user = \App\Models\User::where('id', $client_id)->first();
        $debtstax = CacheDebt::getDebtData($client_id);
        $backtaxes = Helper::validate_key_value('back_tax_own', $debtstax, 'array');

        if (!empty($backtaxes) && is_array($backtaxes) && count($backtaxes) >= 6) {
            return response()->json(Helper::renderJsonError("Oops! Maximum 6 State taxes allowed."))->header('Content-Type: application/json;', 'charset=utf-8');
        } else {
            $backtaxes = !empty($backtaxes) ? $backtaxes : [];
            $creditLiabilityAccountOwnershipType = $report['creditLiabilityAccountOwnershipType'] ?? '';
            $owned_by = $this->getOwnBy($creditLiabilityAccountOwnershipType);
            $cleanedAmount = Helper::priceFormt($report['creditLiabilityPastDueAmount']);
            $y = !isset($y) ? date('Y') : $y;
            $tax = [
                'debt_state' => $report['state'],
                'tax_whats_year' => $y,
                'tax_total_due' => (float) $cleanedAmount,
                'owned_by' => $owned_by,
                "is_back_tax_state_three_months" => 0
            ];
            if ($owned_by == 2 && $user->client_type == 3) {
                $codebtor = Helper::getCodebtorAddress($client_id);
                $tax['codebtor_creditor_name'] = $codebtor['name'];
                $tax['codebtor_creditor_name_addresss'] = $codebtor['address'];
                $tax['codebtor_creditor_city'] = $codebtor['city'];
                $tax['codebtor_creditor_state'] = $codebtor['state'];
                $tax['codebtor_creditor_zip'] = $codebtor['zip'];
            }
            array_push($backtaxes, $tax);
            $row = [];
            $row['tax_owned_state'] = 1;
            $row['client_id'] = $client_id;
            $row['back_tax_own'] = json_encode($backtaxes);
            DebtsTax::updateOrCreate(['client_id' => $client_id], $row);

            // clear cache for client debt
            CacheDebt::forgetDebtCache($client_id);

            return response()->json(Helper::renderJsonSuccess("Record Imported Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    private function saveFedralTax($report, $client_id, $y)
    {
        $user = \App\Models\User::where('id', $client_id)->first();
        $row = [];
        $creditLiabilityAccountOwnershipType = $report['creditLiabilityAccountOwnershipType'] ?? '';
        $owned_by = $this->getOwnBy($creditLiabilityAccountOwnershipType);

        if ($owned_by == 2 && $user->client_type == 3) {
            $codebtor = Helper::getCodebtorAddress($client_id);
            $row['tax_irs_codebtor_creditor_name'] = $codebtor['name'];
            $row['tax_irs_codebtor_creditor_name_addresss'] = $codebtor['address'];
            $row['tax_irs_codebtor_creditor_city'] = $codebtor['city'];
            $row['tax_irs_codebtor_creditor_state'] = $codebtor['state'];
            $row['tax_irs_codebtor_creditor_zip'] = $codebtor['zip'];
        }

        $row['tax_irs_state'] = $report['state'];
        $row['tax_owned_irs'] = 1;
        $row['tax_irs'] = json_encode(["is_back_tax_irs_three_months" => 0,"payment_1" => null,"payment_dates_1" => date('m/Y', strtotime('-3 month')),"payment_2" => null,"payment_dates_2" => date('m/Y', strtotime('-2 month')),"payment_3" => null,"payment_dates_3" => date('m/Y', strtotime('-1 month')),"total_amount_paid" => null]);
        $y = !isset($y) ? date('Y') : $y;
        $row['tax_irs_whats_year'] = $y;
        $row['tax_irs_total_due'] = Helper::priceFormt($report['creditLiabilityPastDueAmount']);
        $row['tax_irs_owned_by'] = $owned_by;
        $row['client_id'] = $client_id;
        DebtsTax::updateOrCreate(['client_id' => $client_id], $row);

        // clear cache for client debt
        CacheDebt::forgetDebtCache($client_id);

        return response()->json(Helper::renderJsonSuccess("Record Imported Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    private function dsoTaxData($report, $client_id)
    {
        $debtstax = CacheDebt::getDebtData($client_id);
        $domestic_tax = Helper::validate_key_value('domestic_tax', $debtstax, 'array');

        if (!empty($domestic_tax) && is_array($domestic_tax) && count($domestic_tax) >= 5) {
            return response()->json(Helper::renderJsonError("Oops! Maximum 5 Domestic taxes allowed."))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $dso = [
            "domestic_address_state" => $report['state'],
            "domestic_support_name" => $report['fullName'],
            "domestic_support_address" => $report['address'],
            "domestic_support_city" => $report['city'],
            "creditor_state" => $report['state'],
            "domestic_support_zipcode" => $report['zip'],
            "domestic_support_monthlypay" => $report['creditLiabilityMonthlyPaymentAmount'],
            "domestic_support_past_due" => Helper::priceFormt($report['creditLiabilityPastDueAmount']),
            "domestic_support_account" => isset($report['creditLiabilityAccountIdentifier']) && !empty($report['creditLiabilityAccountIdentifier']) ? $report['creditLiabilityAccountIdentifier'] : '',
            "is_domestic_support_three_months" => 0
        ];
        array_push($domestic_tax, $dso);
        $row = [];
        $row['domestic_support'] = 1;
        $row['client_id'] = $client_id;
        $row['domestic_tax'] = json_encode($domestic_tax);
        DebtsTax::updateOrCreate(['client_id' => $client_id], $row);

        // clear cache for client debt
        CacheDebt::forgetDebtCache($client_id);

        return response()->json(Helper::renderJsonSuccess("Record Imported Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    private function saveFtabData($report, $client_id, $date)
    {
        $user = \App\Models\User::where('id', $client_id)->first();
        $debtstax = CacheDebt::getDebtData($client_id);
        $debt_tax = Helper::validate_key_value('debt_tax', $debtstax, 'array');
        if (!is_array($debt_tax)) {
            $debt_tax = [];
        }
        $crsObj = new \App\Models\CrsCreditReport();
        $new_tax = $crsObj->importintoCreditor($client_id, $report, $date, $debt_tax, $user->client_type);
        array_push($debt_tax, $new_tax);
        $row = [];
        $row['debt_tax'] = json_encode($debt_tax);
        $row['client_id'] = $client_id;
        $row['does_not_have_additional_creditor'] = 1;
        DebtsTax::updateOrCreate(['client_id' => $client_id], $row);

        // clear cache for client debt
        CacheDebt::forgetDebtCache($client_id);

        return response()->json(Helper::renderJsonSuccess("Record Imported Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function manual_add_resident_form(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $validatedData = $this->validateReportRequest($input);
            $client_id = $validatedData['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $report_id = $validatedData['report_id'];

            return view('attorney.client.add_resident_form', ['client_id' => $client_id,'report_id' => $report_id]);
        }
    }

    public function manual_resident_setup(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $validatedData = $this->validateReportRequest($input);
            $client_id = $validatedData['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $report_id = $validatedData['report_id'];
            if ($report_id > 0) {
                \App\Models\CrsCreditReport::where('id', $report_id)->update(['is_imported' => 1]);
            }
            $propertyFinal = [];
            if (!empty($input['property_resident'])) {
                foreach ($input['property_resident'] as $key => $values) {
                    $i = 0;
                    foreach ($values as $val) {
                        $propertyFinal[$i][$key] = $val;
                        $i++;
                    }
                }
            }
            $this->saveResidentLoans($propertyFinal, $client_id, $report_id);
            $msg = 'Creditor Imported to Newly Added Property.';
            $msg = ($report_id == 0) ? "New property added successfully." : $msg;

            // forget property cache
            CacheProperty::forgetPropertyCache($client_id);

            return redirect()->route('attorney_edit_client_report', $client_id)->with('success', $msg);
        }
    }

    private function saveResidentLoans($propertyFinal, $client_id, $report_id)
    {
        $loan1 = $this->getLoanObjetFromReport($report_id);
        if (!empty($propertyFinal)) {
            foreach ($propertyFinal as $val) {
                $val['client_id'] = $client_id;
                if (!empty($loan1)) {
                    $val['loan_own_type_property'] = 1;
                    $val['home_car_loan'] = json_encode($loan1);
                }
                unset($val['report_id']);
                ClientsPropertyResident::create($val);
            }
        }
    }

    private function getLoanObjetFromReport($report_id)
    {
        $loan1 = [];
        if ($report_id > 0) {
            $report = \App\Models\CrsCreditReport::where('id', $report_id)->first()->toArray();
            $date = $report['date_incurred'];
            $loan1 = [
                'loan_own_type_property' => 1,
                'amount_own' => $report['creditLiabilityUnpaidBalanceAmount'],
                'account_number' => Helper::lastchar($report['creditLiabilityAccountIdentifier']),
                'debt_incurred_date' => $date,
                'monthly_payment' => $report['creditLiabilityMonthlyPaymentAmount'],
                'creditor_name' => $report['fullName'],
                'creditor_name_addresss' => $report['address'],
                'creditor_city' => $report['city'],
                'creditor_state' => $report['state'],
                'creditor_zip' => $report['zip'],
                'payment_tax_insurance' => 1
            ];
        }

        return $loan1;
    }

    public function manual_add_vehicle_form(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $validatedData = $this->validateReportRequest($input);
            $client_id = $validatedData['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $report_id = $validatedData['report_id'];

            return view('attorney.client.add_vehicle_form', ['client_id' => $client_id,'report_id' => $report_id]);
        }
    }

    public function manual_vehicle_setup(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $validatedData = $this->validateReportRequest($input);
            $client_id = $validatedData['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return redirect()->back()->with('error', 'Invalid request.');
            }
            $report_id = $validatedData['report_id'];
            if ($report_id > 0) {
                \App\Models\CrsCreditReport::where('id', $report_id)->update(['is_imported' => 1]);
            }
            $propery_vehicle_final = [];
            if (!empty($input['property_vehicle'])) {
                foreach ($input['property_vehicle'] as $key => $values) {
                    $i = 0;
                    foreach ($values as $val) {
                        $propery_vehicle_final[$i][$key] = (isset($val)) ? $val : "";
                        $i++;
                    }
                }
            }

            $this->storeVehicleData($propery_vehicle_final, $client_id, $report_id);
            $msg = 'Creditor Imported to Newly Added Property.';
            $msg = $report_id == 0 ? "New property added successfully." : $msg;

            // forget property cache
            CacheProperty::forgetPropertyCache($client_id);

            return redirect()->route('attorney_edit_client_report', $client_id)->with('success', $msg);
        }
    }

    private function storeVehicleData($propery_vehicle_final, $client_id, $report_id)
    {
        $loan1 = $this->getLoanObjetFromReport($report_id);
        if (isset($propery_vehicle_final)) {
            foreach ($propery_vehicle_final as $val) {
                if (!empty($loan1)) {
                    $val['loan_own_type_property'] = 1;
                    $val['vehicle_car_loan'] = json_encode($loan1);
                }

                $val['client_id'] = $client_id;
                ClientsPropertyVehicle::create($val);
            }
        }
    }

    private function validateReportRequest($input)
    {
        $report_id = $input['report_id'] ?? 0;
        $client_id = $input['client_id'] ?? 0;
        $this->validClient($client_id);
        if (!$this->validReport($client_id, $report_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return ['client_id' => $client_id, 'report_id' => $report_id];
    }

    public function common_creditors_search(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $keyword = urldecode($input["keyword"]);
            $json = \App\Models\MasterCreditor::autosuggest($keyword);

            return response()->json(Helper::renderApiSuccess('Result', ['data' => $json]), 200);
        }
    }
}
