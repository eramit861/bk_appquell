<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\AddressHelper;
use App\Helpers\Helper;
use App\Models\PayStubs;
use Illuminate\Http\Request;
use App\Helpers\DateTimeHelper;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheProperty;

class MeanTestPopupController extends AttorneyController
{
    public function mean_test_popup_reset(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            \App\Models\MeanTestData::where(['client_id' => $client_id])->delete();

            return response()->json(Helper::renderJsonSuccess("Mean test reset to Client questionnaire successfully", []))
            ->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function mean_test_popup(Request $request)
    {
        $input = $request->all();
        $parent = $input['parent'] ?? 'official_form';
        $client_id = $input['client_id'];
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($client_id == 0) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $user = \App\Models\User::where('id', $client_id)->first();

        $meantestData = \App\Models\MeanTestData::where('client_id', $client_id)->first();
        $client = $this->getClientData($client_id);
        $savedData = \App\Models\AttorneyEditorData::where('client_id', $client_id)->select('suppliment_form')->first();
        $editorData = \App\Models\AttorneyEditorData::where('client_id', $client_id)->select('data')->first();
        $savedData['client_type'] = $client->client_type;
        $income_info = CacheIncome::getIncomeData($client_id);
        $paystub = new PayStubs();

        $debtorpaysData = $paystub->getPaystubByType($client_id, 'self');
        $debtorpaysData = $this->formatDebtorStubs($debtorpaysData);
        // $debtorpaysData = null;

        $paystub = new PayStubs();
        $spousepaysData = $paystub->getPaystubByType($client_id, 'spouse');
        $spousepaysData = $this->formatDebtorStubs($spousepaysData);

        $PropertyData = CacheProperty::getPropertyData($client_id);
        $mortgageDetails = Helper::validate_key_value('propertyresident', $PropertyData, 'array');
        $vehicleMortgage = Helper::validate_key_value('propertyvehicle', $PropertyData, 'array');

        $dynamicPdfData = \App\Models\AttorneyClientHtml::where('client_id', $client_id)->select(['form_id','data'])->get()->pluck('data', 'form_id');
        $mTestA2 = isset($dynamicPdfData['122a_2']) && !empty($dynamicPdfData['122a_2']) ? json_decode($dynamicPdfData['122a_2'], 1) : null;
        $mTestA1 = isset($dynamicPdfData['122a_1']) && !empty($dynamicPdfData['122a_1']) ? json_decode($dynamicPdfData['122a_1'], 1) : null;
        $mTestA1Data = [ 'mTestA1Q12' => Helper::validate_key_value(base64_encode('12B'), $mTestA1), 'mTestA1Q13' => Helper::validate_key_value(base64_encode('13C'), $mTestA1)];

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $BasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $state_name = !empty($BasicInfoPartA->state) ? AddressHelper::getSelectedStateName($BasicInfoPartA->state) : '';
        $statearr = explode("(", $state_name);
        $state_name = isset($statearr[0]) ? trim($statearr[0]) : '';

        return view('attorney.official_form.mean_test_popup', [
                'address' => $BasicInfoPartA,
                'parent' => $parent,
                'countyList' => \App\Models\CountyFipsData::get_county_by_state_name($state_name),
                'editorData' => $editorData, 'meantestData' => $meantestData,'mTestA2' => $mTestA2,'mTestA1Data' => $mTestA1Data,'client_id' => $client_id, 'debtorpaysData' => $debtorpaysData, 'spousepaysData' => $spousepaysData, 'income_info' => $income_info, 'savedData' => $savedData,'mortgages' => $mortgageDetails,'vehicleMortgage' => $vehicleMortgage]);
    }

    private function formatDebtorStubs($debtorpaysData)
    {
        if (!empty($debtorpaysData[0])) {
            $debtorpaysData = $debtorpaysData->toArray();
            $montYears = DateTimeHelper::getMonthYearArray();

            foreach ($montYears as $m => $v) {
                if (!in_array($m, array_column($debtorpaysData, 'pay_period_end'))) {
                    array_push($debtorpaysData, ['pay_period_end' => $m, 'gross_pay_amount' => 0, 'total_taxes' => 0, 'total_deductions' => 0]);
                }
            }

            usort($debtorpaysData, function ($a, $b) {
                return $b['pay_period_end'] <=> $a['pay_period_end'];
            });

            return $debtorpaysData;

        }
    }

    public function mean_test_popup_import_income(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $isExists = \App\Models\MeanTestData::where(['client_id' => $client_id])->exists();
            if ($isExists) {
                \App\Models\MeanTestData::where(['client_id' => $client_id])->update(['import_income' => 1]);
            }

            return response()->json(Helper::renderJsonSuccess("Data save Successfully!", []))
            ->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function mean_test_popup_save(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            unset($input['fIsAjax']);
            unset($input['fOutMode']);
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $household_size = $input['household_size'];
            $statecounty = $input['statecounty'];
            $dataTosave = ['mean_test_data' => json_encode($input)];
            if (isset($input['import_income']) && !empty($input['import_income'])) {
                $dataTosave['import_income'] = 1;
            }
            $this->updateHouseHoldInEditorTable($client_id, $household_size, $statecounty);
            \App\Models\MeanTestData::updateOrCreate([
                'client_id' => $client_id,
            ], $dataTosave);

            return response()->json(Helper::renderJsonSuccess("Data save Successfully!", []))
                ->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    private function updateHouseHoldInEditorTable($client_id, $household_size, $selected_county)
    {
        $saveData = \App\Models\AttorneyEditorData::where('client_id', $client_id)->first();
        $saveData = !empty($saveData) ? $saveData->toArray() : [];
        $saveData = isset($saveData['data']) ? json_decode($saveData['data'], 1) : [];
        $saveData['household_size'] = $household_size;
        $saveData['selected_county'] = $selected_county;
        \App\Models\AttorneyEditorData::updateOrCreate(['client_id' => $client_id], ['data' => json_encode($saveData)]);
    }

}
