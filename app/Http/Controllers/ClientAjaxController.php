<?php

namespace App\Http\Controllers;

use App\Helpers\AddressHelper;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use App\Helpers\DateTimeHelper;
use App\Helpers\ArrayHelper;
use App\Helpers\Helper;
use App\Models\AttorneyEmployerInformationToClient;
use App\Models\AttorneySettings;
use App\Models\ClientsAssociate;
use Illuminate\Http\Request;
use App\Models\FormsStepsCompleted;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheIncome;

class ClientAjaxController extends Controller
{
    public function client_profit_loss_setup(Request $request)
    {
        $client_id = Auth::user()->id;
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_income')) {
            return response()->json([
                'status' => 0,
                'msg' => "You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen."
            ], 200);
        }
        $input = $request->all();
        $postedData = $input['income_profit_loss'];
        $existingData = $this->getProfitLossOfclient($client_id);
        $additional = $request->get('additional');
        if (!empty($additional)) {
            $existingData = $existingData['income_profit_loss_' .$additional ] ?? '';
        } else {
            $existingData = $existingData['income_profit_loss'] ?? '';
        }

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

        $profitLossMainData = $this->getProfitLossOfMonthData($existingData, $postedData, $attProfitLossMonths);
        if (!empty($request->get('additional'))) {
            Auth::user()
                ->incomeDebtorMonthlyIncome()
                ->updateOrCreate(
                    ['client_id' => $client_id],
                    ['profit_loss_business_name_'. $additional => $profitLossMainData['businessName'],
                        'operation_business' => 1,
                        'company_income_'. $additional => true,
                        'income_profit_loss_'.$additional => json_encode($profitLossMainData['dataToBeSaved'])
                    ]
                );
        } else {
            Auth::user()
                ->incomeDebtorMonthlyIncome()
                ->updateOrCreate(
                    ['client_id' => $client_id],
                    ['profit_loss_business_name' => $profitLossMainData['businessName'],
                        'operation_business' => 1,
                        'income_profit_loss' => json_encode($profitLossMainData['dataToBeSaved'])
                    ]
                );
        }

        CacheIncome::forgetIncomeCache($client_id);

        return response()->json(Helper::renderJsonSuccess(
            $profitLossMainData['msg'],
            [
                'formurl' => route('client_profit_loss_popup'),
                'profit_loss_type' => $postedData['profit_loss_type'],
                'profit_loss_month' => $profitLossMainData['nextMonth']
            ]
        ))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function client_profit_loss_joint_setup(Request $request)
    {
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_income')) {
            return response()->json([
                'status' => 0,
                'msg' => "You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen."
            ], 200);
        }
        $client_id = Auth::user()->id;
        $input = $request->all();
        $postedData = $input['income_profit_loss'];
        $existingData = $this->getProfitLossOfJoinclient($client_id);
        $additional = $request->get('additional');
        if (!empty($additional)) {
            $existingData = $existingData['income_profit_loss_' .$additional ] ?? '';
        } else {
            $existingData = $existingData['income_profit_loss'] ?? '';
        }

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

        $profitLossJointData = $this->getProfitLossOfMonthData($existingData, $postedData, $attProfitLossMonths);
        if (!empty($request->get('additional'))) {
            Auth::user()
                ->incomeDebtorSpouseMonthlyIncome()
                ->updateOrCreate(
                    ['client_id' => $client_id],
                    ['profit_loss_business_name_'. $additional => $profitLossJointData['businessName'],
                        'joints_operation_business' => 1,
                        'company_income_'. $additional => true,
                        'income_profit_loss_'.$additional => json_encode($profitLossJointData['dataToBeSaved'])
                    ]
                );
        } else {
            Auth::user()
                ->incomeDebtorSpouseMonthlyIncome()
                ->updateOrCreate(
                    [
                    'client_id' => $client_id
                ],
                    [
                        'profit_loss_business_name' => $profitLossJointData['businessName'],
                        'joints_operation_business' => 1,
                        'income_profit_loss' => json_encode($profitLossJointData['dataToBeSaved'])
                    ]
                );
        }

        CacheIncome::forgetIncomeCache($client_id);

        return response()->json(Helper::renderJsonSuccess(
            $profitLossJointData['msg'],
            [
                'formurl' => route('client_profit_loss_popup_joint'),
                'profit_loss_type' => $postedData['profit_loss_type'],
                'profit_loss_month' => $profitLossJointData['nextMonth']
            ]
        ))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function remove_client_additional_profit_loss_popup(Request $request)
    {
        $client_id = Auth::user()->id;
        $existingData = $this->getProfitLossOfclient($client_id);
        $additional = $request->get('additional');
        if (!empty($existingData) && !empty($additional)) {
            Auth::user()
                ->incomeDebtorMonthlyIncome()
                ->updateOrCreate(
                    ['client_id' => $client_id],
                    ['profit_loss_business_name_'.$additional => "",
                        'operation_business' => 1,
                        'company_income_'.$additional => false,
                        'income_profit_loss_'.$additional => ""
                    ]
                );
            CacheIncome::forgetIncomeCache($client_id);
        }

        return response()->json(['success' => true, 'msg' => "Successfully Deleted Additional Company"]);
    }

    public function remove_client_additional_profit_loss_popup_joint(Request $request)
    {
        $client_id = Auth::user()->id;
        $existingData = $this->getProfitLossOfclient($client_id);
        $additional = $request->get('additional');
        if (!empty($existingData) && !empty($additional)) {
            Auth::user()
                ->incomeDebtorSpouseMonthlyIncome()
                ->updateOrCreate(
                    ['client_id' => $client_id],
                    ['profit_loss_business_name_'.$additional => "",
                        'joints_operation_business' => 1,
                        'company_income_'.$additional => false,
                        'income_profit_loss_'.$additional => ""
                    ]
                );
            CacheIncome::forgetIncomeCache($client_id);
        }

        return response()->json(['success' => true, 'msg' => "Successfully Deleted Additional Company"]);
    }

    public function client_profit_loss_popup_joint(Request $request)
    {
        $client_id = Auth::user()->id;

        $origionalAttorneyId = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $origionalAttorneyId;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

        $finalDebtorMonthlyIncomeJoint = $this->getProfitLossOfJoinclient($client_id);
        $displayJointData = $this->getUpdatedProfitLossCommonData($finalDebtorMonthlyIncomeJoint, $request, $attProfitLossMonths);

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $jointBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $jointBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $formData = FormsStepsCompleted::where("client_id", $client_id)
            ->select('step6', 'can_edit', 'updated_on')
            ->first();

        $formData = !empty($formData) ? $formData->toArray() : $formData;
        $new_date = '';
        if (!empty($formData) && $formData['step6'] == 1 && $formData['can_edit'] == 2) {
            $date = $formData['updated_on'];
            $timestamp = strtotime($date);
            $new_date = date('m/d/Y', $timestamp);
        }
        $additional = $request->get('additional');
        $existing_type = $request->get('existing_type');

        $majorLawProfitLossLabels = ArrayHelper::getMajotLawFirmProfitLossLabels($origionalAttorneyId);

        $returnHTML = view('client.questionnaire.income.profit_loss_joint')
            ->with(['majorLawProfitLossLabels' => $majorLawProfitLossLabels, 'attProfitLossMonths' => $attProfitLossMonths, 'BasicInfoPartA' => $jointBasicInfoPartA, 'BasicInfo_PartB' => $jointBasicInfoPartB, 'income_profit_loss' => $displayJointData, 'final_date' => $new_date, 'additional' => $additional, 'existing_type' => $existing_type])
            ->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }
    private function getProfitLossOfJoinclient($client_id)
    {
        $incomeData = CacheIncome::getIncomeData($client_id);

        return Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');
    }

    public function client_profit_loss_popup(Request $request)
    {
        $client_id = Auth::user()->id;
        $origionalAttorneyId = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $origionalAttorneyId;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);
        $final_debtormonthlyincome = $this->getProfitLossOfclient($client_id);
        $displayData = $this->getUpdatedProfitLossCommonData($final_debtormonthlyincome, $request, $attProfitLossMonths);

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $BasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $BasicInfo_PartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $fdata = FormsStepsCompleted::where("client_id", $client_id)->select('step6', 'can_edit', 'updated_on')->first();
        $fdata = !empty($fdata) ? $fdata->toArray() : [];
        $new_date = '';
        if (!empty($fdata) && $fdata['step6'] == 1 && $fdata['can_edit'] == 2) {
            $date = $fdata['updated_on'];
            $timestamp = strtotime($date);
            $new_date = date('m/d/Y', $timestamp);
        }
        $majorLawProfitLossLabels = ArrayHelper::getMajotLawFirmProfitLossLabels($origionalAttorneyId);

        $additional = $request->get('additional');
        $existing_type = $request->get('existing_type');
        $returnHTML = view('client.questionnaire.income.profit_loss')->with(['majorLawProfitLossLabels' => $majorLawProfitLossLabels,'attProfitLossMonths' => $attProfitLossMonths, 'BasicInfoPartA' => $BasicInfoPartA, 'BasicInfo_PartB' => $BasicInfo_PartB, 'income_profit_loss' => $displayData, 'final_date' => $new_date, 'additional' => $additional, 'existing_type' => $existing_type])->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    private function getUpdatedProfitLossCommonData($final_debtormonthlyincome, $request, $attProfitLossMonths)
    {
        $displayData = AddressHelper::getProfitLossCommonData($final_debtormonthlyincome, $request);
        $months = DateTimeHelper::getFullMonthYearArrayForProfitLoss($attProfitLossMonths);
        $input = $request->all();
        if (Helper::validate_key_value('profit_loss_type', $displayData) == 1) {
            reset($months);
            $displayData['profit_loss_month'] = key($months);
        } else {
            if (!empty(Helper::validate_key_value('for_month', $input))) {
                $displayData['profit_loss_month'] = Helper::validate_key_value('for_month', $input);
            }
        }

        return $displayData;
    }

    private function getProfitLossOfclient($client_id)
    {
        $incomeData = CacheIncome::getIncomeData($client_id);

        return Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');
    }
    private function finalDebtorMonthlyIncomeArray($debtormonthlyincome)
    {
        $debtormonthlyincome = (!empty($debtormonthlyincome)) ? $debtormonthlyincome->toArray() : [];
        $final_debtormonthlyincome = [];
        if (!empty($debtormonthlyincome)) {
            foreach ($debtormonthlyincome as $k => $v) {
                if (is_array(json_decode($v, 1))) {
                    $final_debtormonthlyincome[$k] = json_decode($v, 1);
                } else {
                    $final_debtormonthlyincome[$k] = $v;
                }
            }
        }

        return $final_debtormonthlyincome;
    }
    private function validateProfitLossExistingData($postedData, $dataToBeSaved, $existingData)
    {
        if ($postedData['profit_loss_type'] == 1 && isset($existingData[0]['profit_loss_type']) && $existingData[0]['profit_loss_type'] == 2) {
            $dataToBeSaved = $postedData;
        }
        if ($postedData['profit_loss_type'] == 2 && isset($existingData['profit_loss_type']) && $existingData['profit_loss_type'] == 1) {
            $dataToBeSaved = [$postedData];
        }
        if ($postedData['profit_loss_type'] == 1 && isset($existingData['profit_loss_type']) && $existingData['profit_loss_type'] == 1) {
            $dataToBeSaved = $postedData;
        }

        return $dataToBeSaved;
    }

    private function profitLossOfMonthDataFromExistingData($postedData, $dataToBeSaved, $existingData)
    {
        if ($postedData['profit_loss_type'] == 2 && isset($existingData[0]['profit_loss_type'])) {
            /** that means now they want to update or add months data */
            $new = true;
            foreach ($existingData as $month) {
                if ($month['profit_loss_month'] == $postedData['profit_loss_month']) {
                    $new = false;
                    $month = $postedData;
                }
                $dataToBeSaved[] = $month;
            }
            if ($new) {
                $dataToBeSaved[] = $postedData;
            }
        }

        return $this->validateProfitLossExistingData($postedData, $dataToBeSaved, $existingData);
    }

    private function getProfileLossMessage($postedData): string
    {
        $msg = 'Saved successfully';
        $monthName = !empty($postedData['profit_loss_month']) ? $postedData['profit_loss_month'] : '';
        if ($postedData['profit_loss_type'] == 2 && $monthName != '') {
            $dates = explode("-", $monthName);
            $month = $dates[0];
            $year = $dates[1];
            $month_name = date("F", mktime(0, 0, 0, (int)$month, 10));
            $msg = 'Saved successfully for month '.$month_name.', '. $year;
        }

        return $msg;
    }

    private function getBusinessNameAndNextMonth($postedData, $businessName, $attProfitLossMonths): array
    {
        $months = DateTimeHelper::getMonthArrayForProfitLoss(null, $attProfitLossMonths);
        $i = 1;
        $nextMonth = '';
        $monthKeys = array_keys($months);
        foreach ($monthKeys as $key) {
            if ($i == 1 && $key == $postedData['profit_loss_month']) {
                $businessName = $postedData['name_of_business'];
            }
            if (empty($nextMonth)) {
                if ($i == 2) {
                    $nextMonth = $key;
                }
                if ($key == $postedData['profit_loss_month']) {
                    $i++;
                }
            }
        }

        return compact('businessName', 'nextMonth');
    }

    private function getProfitLossOfMonthData($existingData, $postedData, $attProfitLossMonths): array
    {
        $dataToBeSaved = [];
        $businessName = '';
        if (!empty($existingData)) {
            $dataToBeSaved = $this->profitLossOfMonthDataFromExistingData($postedData, $dataToBeSaved, $existingData);
        } else {
            $dataToBeSaved = $postedData;
            /** When first time saving months data */
            if ($postedData['profit_loss_type'] == 2) {
                $dataToBeSaved = [$postedData];
                $businessName = $postedData['name_of_business'];
            }
        }

        $businessNameMonthData = $this->getBusinessNameAndNextMonth($postedData, $businessName, $attProfitLossMonths);
        $businessName = $businessNameMonthData['businessName'];
        $nextMonth = $businessNameMonthData['nextMonth'];
        $msg = $this->getProfileLossMessage($postedData);

        return compact('msg', 'businessName', 'dataToBeSaved', 'nextMonth');
    }



    public function client_common_creditors_search(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $keyword = urldecode($input["keyword"]);
            $json = \App\Models\MasterCreditor::autosuggest($keyword);

            return response()->json(Helper::renderApiSuccess('Result', ['data' => $json]), 200);
        }
    }




    public function get_county_by_state_name(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $state_name = $input['state_name'] ?? '';
            $statearr = explode("(", $state_name);
            $state_name = isset($statearr[0]) ? trim($statearr[0]) : '';
            $countyList = \App\Models\CountyFipsData::get_county_by_state_name($state_name);

            return response()->json(Helper::renderJsonSuccess("Record Saved Successfully", ['countyList' => $countyList]))
            ->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    private function clientRequest($data, $url)
    {
        $client = new Client();

        return $client->request('POST', $url, $data);
    }

    private function clientRequestData($body, $token)
    {
        return [
            'body' => $body,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'http_errors' => false
        ];
    }

    private function getCrsToken()
    {
        try {
            $client = new Client();
            $response = $client->request(
                'POST',
                env('CRS_API_URL') . '/users/login',
                [
                    'body' => '{
                        "username": "' . env('CRS_USER') . '",
                        "password": "' . env('CRS_PASSWORD') . '"
                      }',
                    'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json'],
                    'http_errors' => false
                ]
            );
        } catch (GuzzleHttp\Exception\GuzzleException $e) {
            if ($e->hasResponse()) {
                $curlResponse = $e->getResponse();
                abort("200", $curlResponse->getReasonPhrase());
            }
        }
        $response = json_decode($response->getBody(), true);

        if (!isset($response['token'])) {
            abort("200", "Something went wrong. Try again!");
        }

        return $response;
    }
    private function updateCrsLjs($liensSearchPayload, $token)
    {
        try {
            $data = $this->clientRequestData($liensSearchPayload, $token);
            $this->clientRequest($data, env('CRS_API_URL') . '/ljssss');
        } catch (GuzzleHttp\Exception\GuzzleException $e) {
            if ($e->hasResponse()) {
                $curlResponse = $e->getResponse();
                abort("200", $curlResponse->getReasonPhrase());
            }
        }
    }
    private function getUpdateCrsLjr($liensSearchPayload, $uniqueNo, $token, $client_id)
    {
        $lienPayload = '{"reportBy": {"uniqueId": "' . $uniqueNo . '"}}';
        try {
            $data = $this->clientRequestData($lienPayload, $token);
            $liensResponse = $this->clientRequest($data, env('CRS_API_URL') . '/ljr');
        } catch (GuzzleHttp\Exception\GuzzleException $e) {
            if ($e->hasResponse()) {
                $curlResponse = $e->getResponse();
                abort("200", $curlResponse->getReasonPhrase());
            }
        }

        $msg = '';
        $timestamp = date("Y-m-d H:i:s");
        $liensResponseArray = json_decode($liensResponse->getBody(), true);
        if (isset($liensResponseArray['response']['lienJudgments']) && !empty($liensResponseArray['response']['lienJudgments'])) {
            foreach ($liensResponseArray['response']['lienJudgments'] as $liensList) {
                foreach ($liensList as $liens) {
                    $dataToBeSave = [
                        'client_id' => $client_id,
                        'originFilingDate' => isset($liens['originFilingDate']['month']) ? ($liens['originFilingDate']['month'] . '/' . $liens['originFilingDate']['day'] . '/' . $liens['originFilingDate']['year']) : '',
                        'amount' => $liens['amount'] ?? 0,
                        'filingJurisdiction' => $liens['filingJurisdiction'],
                        'filingJurisdictionName' => $liens['filingJurisdictionName'],
                        'multipleDefendant' => $liens['multipleDefendant'],
                        'debtors' => json_encode($liens['debtors']),
                        'filings' => json_encode($liens['filings']),
                        'tmsid' => $liens['tmsid'],
                        'json_response' => json_encode([
                            'searc_request' => json_decode($liensSearchPayload),
                            'response' => $liens]),
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                        ];
                    Auth::user()->crsLienJudgmentsReport()->updateOrCreate(
                        [
                            'tmsid' => $liens['tmsid'],
                            'client_id' => $client_id
                        ],
                        $dataToBeSave
                    );
                }
            }
        } else {
            $msg = "Lien and Judgments are not found for this account.";
        }

        return $msg;
    }

    private function getLiensSearchPayload($uniqueNo, $basicinfo, $ssno): string
    {
        $add = $basicinfo['Address'] ?? '';
        $city = $basicinfo['City'] ?? '';
        $state = $basicinfo['state'] ?? '';
        $zip = $basicinfo['zip'] ?? '';

        return '{"user": {"dlpurpose": "0","glbpurpose": "0"},
			"searchBy": {
				"uniqueId": "' . $uniqueNo . '",
				"name": {
					"qualifier": "ALSO_KNOWN_AS",
					"searchIndicator": 0,
					"person": {
						"unparsed": "LANE BAIRD Z"
					},
					"source": "INPUT"
					},"address": {
					"line1": "' . $add. '",
					"line2": "",
					"city": "' . $city. '",
					"state": "' . $state . '",
					"zipCode": "' . $zip . '"
				},
				"ssn": "' . $ssno . '",
				"includeEvictions": true,
				"includeLiens": true,
				"includeJudgments": true
			},
			"options": {
				"returnCount": 10,
				"startingRecord": 1,
				"includeAlsoFound": true
			}
		}';
    }
    private function getPayloadNotJointMarried($data)
    {
        if (Auth::user()->client_type != Helper::CLIENT_TYPE_JOINT_MARRIED) {
            return '{"aboutversions":{"aboutversions":[{"dataVersionIdentifier":{"value":"201703"}}]},"dealsets":{"dealsets":[{"deals":{"deals":[{"parties":{"parties":[{"individual":{"name":{"firstName":{"value":"' . $data['firstname'] . '"},"lastName":{"value":"' . $data['lastname'] . '"},"middleName":{"value":"' . $data['middlename'] . '"},"suffixName":{}}},"roles":{"roles":[{"borrower":{"residences":{"residences":[{"address":{"addressLineText":{"value":"' . $data['address'] . '"},"cityName":{"value":"' . $data['city'] . '"},"countryCode":{"value":"US"},"postalCode":{"value":"' . $data['zip'] . '"},"stateCode":{"value":"' . $data['state'] . '"}},"residencedetail":{"borrowerResidencyType":{"value":"CURRENT"}}}]}},"roledetail":{"partyRoleType":{"value":"BORROWER"}}}]},"taxpayeridentifiers":{"taxpayeridentifiers":[{"taxpayerIdentifierType":{"value":"SOCIAL_SECURITY_NUMBER"},"taxpayerIdentifierValue":{"value":"' . $data['ssno'] . '"}}]},"label":"Party1"}]},"relationships":{"relationships":[{"arcrole":"urn:fdc:Meridianlink.com:2017:mortgage/PARTY_IsVerifiedBy_SERVICE","from":"Party1","to":"Service1"}]},"services":{"services":[{"credit":{"creditrequest":{"creditrequestdatas":{"creditrequestdatas":[{"creditrepositoryincluded":{"creditRepositoryIncludedEquifaxIndicator":{"value":true},"creditRepositoryIncludedExperianIndicator":{"value":true},"creditRepositoryIncludedTransUnionIndicator":{"value":true},"extension":{"other":{"requestEquifaxScore":true,"requestExperianFraud":true,"requestExperianScore":true,"requestTransUnionFraud":true,"requestTransUnionScore":true}}},"creditrequestdatadetail":{"creditReportRequestActionType":{"value":"SUBMIT"}}}]}}},"serviceproduct":{"serviceproductrequest":{"serviceproductdetail":{"serviceProductDescription":{"value":"CreditOrder"},"extension":{"other":{"servicepreferredresponseformats":{"servicepreferredresponseformats":[{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"XML"}},{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"HTML"}},{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"PDF"}}]}}}}}},"label":"Service1"}]}}]}}]},"messageType":"REQUEST"}';
        }

        return '';
    }

    private function getPollyPayloadNotJointMarried($data)
    {
        if (Auth::user()->client_type != Helper::CLIENT_TYPE_JOINT_MARRIED) {
            return '{"aboutversions":{"aboutversions":[{"dataVersionIdentifier":{"value":"201703"}}]},"dealsets":{"dealsets":[{"deals":{"deals":[{"parties":{"parties":[{"individual":{"name":{"firstName":{"value":"' . $data['firstname'] . '"},"lastName":{"value":"' . $data['lastname'] . '"},"middleName":{"value":"' . $data['middlename'] . '"},"suffixName":{}}},"roles":{"roles":[{"borrower":{"residences":{"residences":[{"address":{"addressLineText":{"value":"' . $data['address'] . '"},"cityName":{"value":"' . $data['city'] . '"},"countryCode":{"value":"US"},"postalCode":{"value":"' . $data['zip'] . '"},"stateCode":{"value":"' . $data['state'] . '"}},"residencedetail":{"borrowerResidencyType":{"value":"CURRENT"}}}]}},"roledetail":{"partyRoleType":{"value":"BORROWER"}}}]},"taxpayeridentifiers":{"taxpayeridentifiers":[{"taxpayerIdentifierType":{"value":"SOCIAL_SECURITY_NUMBER"},"taxpayerIdentifierValue":{"value":"' . $data['ssno'] . '"}}]},"label":"Party1"}]},"relationships":{"relationships":[{"arcrole":"urn:fdc:Meridianlink.com:2017:mortgage/PARTY_IsVerifiedBy_SERVICE","from":"Party1","to":"Service1"}]},"services":{"services":[{"credit":{"creditrequest":{"creditrequestdatas":{"creditrequestdatas":[{"creditrepositoryincluded":{"creditRepositoryIncludedEquifaxIndicator":{"value":true},"creditRepositoryIncludedExperianIndicator":{"value":true},"creditRepositoryIncludedTransUnionIndicator":{"value":true},"extension":{"other":{"requestEquifaxScore":true,"requestExperianFraud":true,"requestExperianScore":true,"requestTransUnionFraud":true,"requestTransUnionScore":true}}},"creditrequestdatadetail":{"creditReportRequestActionType":{"value":"STATUS_QUERY"}}}]}}},"serviceproduct":{"serviceproductrequest":{"serviceproductdetail":{"serviceProductDescription":{"value":"CreditOrder"},"extension":{"other":{"servicepreferredresponseformats":{"servicepreferredresponseformats":[{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"XML"}},{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"HTML"}},{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"PDF"}}]}}}}}},"serviceproductfulfillment":{"contactpoints":{"contactpoints":[],"otherAttributes":{}},"serviceproductfulfillmentdetail":{"vendorOrderIdentifier":{"value":"' . $data['clientIdentifer'] . '","otherAttributes":{}},"extension":{"other":{"anies":[]}},"otherAttributes":{}},"otherAttributes":{}},"label":"Service1"}]}}]}}]},"messageType":"REQUEST"}';
        }

        return '';
    }
    private function getPollyPayloadJointMarried($data, $pollpayload)
    {
        if (Auth::user()->client_type == Helper::CLIENT_TYPE_JOINT_MARRIED) {
            return '{"aboutversions":{"aboutversions":[{"dataVersionIdentifier":{"value":"201703"}}]},"dealsets":{"dealsets":[{"deals":{"deals":[{"parties":{"parties":[{"individual":{"name":{"firstName":{"value":"' . $data['firstname'] . '"},"lastName":{"value":"' . $data['lastname'] . '"},"middleName":{"value":"' . $data['middlename'] . '"},"suffixName":{"value":"' . $data['prifix'] . '"}}},"roles":{"roles":[{"borrower":{"residences":{"residences":[{"address":{"addressLineText":{"value":"' . $data['address'] . '"},"cityName":{"value":"' . $data['city'] . '"},"countryCode":{"value":"US"},"postalCode":{"value":"' . $data['zip'] . '"},"stateCode":{"value":"' . $data['state'] . '"}},"residencedetail":{"borrowerResidencyType":{"value":"CURRENT"}}}]}},"roledetail":{"partyRoleType":{"value":"BORROWER"}}}]},"taxpayeridentifiers":{"taxpayeridentifiers":[{"taxpayerIdentifierType":{"value":"SOCIAL_SECURITY_NUMBER"},"taxpayerIdentifierValue":{"value":"' . $data['ssno'] . '"}}]},"label":"Party1"},{"individual":{"name":{"firstName":{"value":"' . $data['sp_firstname'] . '"},"lastName":{"value":"' . $data['sp_lastname'] . '"},"middleName":{"value":"' . $data['sp_middlename'] . '"},"suffixName":{}}},"roles":{"roles":[{"borrower":{"residences":{"residences":[{"address":{"addressLineText":{"value":"' . $data['sp_address'] . '"},"cityName":{"value":"' . $data['sp_city'] . '"},"countryCode":{"value":"US"},"postalCode":{"value":"' . $data['sp_zip'] . '"},"stateCode":{"value":"' . $data['sp_state'] . '"}},"residencedetail":{"borrowerResidencyType":{"value":"CURRENT"}}}]}},"roledetail":{"partyRoleType":{"value":"BORROWER"}}}]},"taxpayeridentifiers":{"taxpayeridentifiers":[{"taxpayerIdentifierType":{"value":"SOCIAL_SECURITY_NUMBER"},"taxpayerIdentifierValue":{"value":"' . $data['sp_ssno'] . '"}}]},"label":"Party2"}]},"relationships":{"relationships":[{"arcrole":"urn:fdc:Meridianlink.com:2017:mortgage/PARTY_IsVerifiedBy_SERVICE","from":"Party1","to":"Service1"},{"arcrole":"urn:fdc:Meridianlink.com:2017:mortgage/PARTY_IsVerifiedBy_SERVICE","from":"Party2","to":"Service1"}]},"services":{"services":[{"credit":{"creditrequest":{"creditrequestdatas":{"creditrequestdatas":[{"creditrepositoryincluded":{"creditRepositoryIncludedEquifaxIndicator":{"value":true},"creditRepositoryIncludedExperianIndicator":{"value":true},"creditRepositoryIncludedTransUnionIndicator":{"value":true},"extension":{"other":{"requestEquifaxScore":true,"requestExperianFraud":true,"requestExperianScore":true,"requestTransUnionFraud":true,"requestTransUnionScore":true}}},"creditrequestdatadetail":{"creditReportRequestActionType":{"value":"STATUS_QUERY"}}}]}}},"serviceproduct":{"serviceproductrequest":{"serviceproductdetail":{"serviceProductDescription":{"value":"CreditOrder"},"extension":{"other":{"servicepreferredresponseformats":{"servicepreferredresponseformats":[{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"XML"}},{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"HTML"}},{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"PDF"}}]}}}}}},"serviceproductfulfillment":{"contactpoints":{"contactpoints":[],"otherAttributes":{}},"serviceproductfulfillmentdetail":{"vendorOrderIdentifier":{"value":"' . $data['clientIdentifer'] . '","otherAttributes":{}},"extension":{"other":{"anies":[]}},"otherAttributes":{}},"otherAttributes":{}},"label":"Service1"}]}}]}}]},"messageType":"REQUEST"}';
        }

        return $pollpayload;
    }

    private function getPayloadJointMarried($data, $payload, $ssno, $sp_ssno)
    {
        if (Auth::user()->client_type == Helper::CLIENT_TYPE_JOINT_MARRIED) {
            if ($ssno == $sp_ssno) {
                abort("200", "Borrowers cannot have the same SSN");
            }
            $payload = '{"aboutversions":{"aboutversions":[{"dataVersionIdentifier":{"value":"201703"}}]},"dealsets":{"dealsets":[{"deals":{"deals":[{"parties":{"parties":[{"individual":{"name":{"firstName":{"value":"' . $data['firstname'] . '"},"lastName":{"value":"' . $data['lastname'] . '"},"middleName":{"value":"' . $data['middlename'] . '"},"suffixName":{"value":"' . $data['prifix'] . '"}}},"roles":{"roles":[{"borrower":{"residences":{"residences":[{"address":{"addressLineText":{"value":"' . $data['address'] . '"},"cityName":{"value":"' . $data['city'] . '"},"countryCode":{"value":"US"},"postalCode":{"value":"' . $data['zip'] . '"},"stateCode":{"value":"' . $data['state'] . '"}},"residencedetail":{"borrowerResidencyType":{"value":"CURRENT"}}}]}},"roledetail":{"partyRoleType":{"value":"BORROWER"}}}]},"taxpayeridentifiers":{"taxpayeridentifiers":[{"taxpayerIdentifierType":{"value":"SOCIAL_SECURITY_NUMBER"},"taxpayerIdentifierValue":{"value":"' . $data['ssno'] . '"}}]},"label":"Party1"},{"individual":{"name":{"firstName":{"value":"' . $data['sp_firstname'] . '"},"lastName":{"value":"' . $data['sp_lastname'] . '"},"middleName":{"value":"' . $data['sp_middlename'] . '"},"suffixName":{}}},"roles":{"roles":[{"borrower":{"residences":{"residences":[{"address":{"addressLineText":{"value":"' . $data['sp_address'] . '"},"cityName":{"value":"' . $data['sp_city'] . '"},"countryCode":{"value":"US"},"postalCode":{"value":"' . $data['sp_zip'] . '"},"stateCode":{"value":"' . $data['sp_state'] . '"}},"residencedetail":{"borrowerResidencyType":{"value":"CURRENT"}}}]}},"roledetail":{"partyRoleType":{"value":"BORROWER"}}}]},"taxpayeridentifiers":{"taxpayeridentifiers":[{"taxpayerIdentifierType":{"value":"SOCIAL_SECURITY_NUMBER"},"taxpayerIdentifierValue":{"value":"' . $data['sp_ssno'] . '"}}]},"label":"Party2"}]},"relationships":{"relationships":[{"arcrole":"urn:fdc:Meridianlink.com:2017:mortgage/PARTY_IsVerifiedBy_SERVICE","from":"Party1","to":"Service1"},{"arcrole":"urn:fdc:Meridianlink.com:2017:mortgage/PARTY_IsVerifiedBy_SERVICE","from":"Party2","to":"Service1"}]},"services":{"services":[{"credit":{"creditrequest":{"creditrequestdatas":{"creditrequestdatas":[{"creditrepositoryincluded":{"creditRepositoryIncludedEquifaxIndicator":{"value":true},"creditRepositoryIncludedExperianIndicator":{"value":true},"creditRepositoryIncludedTransUnionIndicator":{"value":true},"extension":{"other":{"requestEquifaxScore":true,"requestExperianFraud":true,"requestExperianScore":true,"requestTransUnionFraud":true,"requestTransUnionScore":true}}},"creditrequestdatadetail":{"creditReportRequestActionType":{"value":"SUBMIT"}}}]}}},"serviceproduct":{"serviceproductrequest":{"serviceproductdetail":{"serviceProductDescription":{"value":"CreditOrder"},"extension":{"other":{"servicepreferredresponseformats":{"servicepreferredresponseformats":[{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"XML"}},{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"HTML"}},{"servicepreferredresponseformatdetail":{"preferredResponseFormatType":"PDF"}}]}}}}}},"label":"Service1"}]}}]}}]},"messageType":"REQUEST"}';
        }

        return $payload;
    }

    private function callRequest($payload, $token, $url)
    {
        try {
            $data = $this->clientRequestData($payload, $token);

            return $this->clientRequest($data, $url);
        } catch (GuzzleHttp\Exception\GuzzleException $e) {
            if ($e->hasResponse()) {
                $curlResponse = $e->getResponse();
                abort("200", $curlResponse->getReasonPhrase());
            }
        }
    }

    public function upload_crs_report()
    {
        try {
            $client_id = Auth::user()->id;
            $BIData = CacheBasicInfo::getBasicInformationData($client_id);
            $basicinfo = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
            $response = $this->getCrsToken();
            $firstname = $basicinfo['name'] ?? '';
            $lastname = $basicinfo['last_name'] ?? '';
            $middlename = $basicinfo['middle_name'] ?? '';
            $prifix = "";
            $address = $basicinfo['Address'] ?? '';
            $city = $basicinfo['City'] ?? '';
            $state = $basicinfo['state'] ?? '';
            $zip = $basicinfo['zip'] ?? '';
            $ssno = $basicinfo['security_number'] ?? '';
            $ssno = str_replace("-", "", $ssno);
            $uniqueNo = '888809001188';
            $token = $response['token'];

            $liensSearchPayload = $this->getLiensSearchPayload($uniqueNo, $basicinfo, $ssno);

            $this->updateCrsLjs($liensSearchPayload, $token);
            /** TO-DO need to get the uniqueId and replace with client's one, question asked to crs team */
            $msg = $this->getUpdateCrsLjr($liensSearchPayload, $uniqueNo, $token, $client_id);

            $spouseinfo = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
            $sp_firstname = $spouseinfo['name'] ?? '';
            $sp_lastname = $spouseinfo['last_name'] ?? '';
            $sp_middlename = $spouseinfo['middle_name'] ?? '';
            $sp_address = $spouseinfo['Address'] ?? '';
            $sp_city = $spouseinfo['City'] ?? '';
            $sp_state = $spouseinfo['state'] ?? '';
            $sp_zip = $spouseinfo['zip'] ?? '';
            $sp_ssno = $spouseinfo['social_security_number'] ?? '';
            $sp_ssno = str_replace("-", "", $sp_ssno);
            if (isset($spouseinfo['spouse_different_address']) && $spouseinfo['spouse_different_address'] != 1) {
                $sp_address = $address;
                $sp_city = $city;
                $sp_state = $state;
                $sp_zip = $zip;
            }
            $payloadData = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'middlename' => $middlename,
                'address' => $address,
                'city' => $city,
                'zip' => $zip,
                'state' => $state,
                'ssno' => $ssno,
                'prifix' => $prifix,
                'sp_firstname' => $sp_firstname,
                'sp_lastname' => $sp_lastname,
                'sp_middlename' => $sp_middlename,
                'sp_address' => $sp_address,
                'sp_city' => $sp_city,
                'sp_state' => $sp_state,
                'sp_zip' => $sp_zip,
                'sp_ssno' => $sp_ssno,
            ];
            $payload = $this->getPayloadNotJointMarried($payloadData);
            $payload = $this->getPayloadJointMarried($payloadData, $payload, $ssno, $sp_ssno);
            $response1 = $this->callRequest($payload, $token, env('CRS_API_URL') . '/mcl/request');
            $responsearray = json_decode($response1->getBody(), true);
            $clientIdentifer = $responsearray['dealsets']['dealsets'][0]['deals']['deals'][0]['services']['services'][0]['serviceproductfulfillment']['serviceproductfulfillmentdetail']['vendorOrderIdentifier']['value'] ?? '';
            $returnerror = $responsearray['dealsets']['dealsets'][0]['deals']['deals'][0]['services']['services'][0]['errors']['errors'][0]['errormessages']['errormessages'][0]['errorMessageText']['value'] ?? '';
            $returnerror = !empty($responsearray['statuses']['statuses'][0]['statusDescription']['value']) ? $responsearray['statuses']['statuses'][0]['statusDescription']['value'] : $returnerror;
            if (!empty($returnerror)) {
                abort("200", $returnerror . ' ' . $msg);
            }
            $payloadData['clientIdentifer'] = $clientIdentifer;
            $pollpayload = $this->getPollyPayloadNotJointMarried($payloadData);
            $pollpayload = $this->getPollyPayloadJointMarried($payloadData, $pollpayload);
            sleep(11);
            $apiresponse = $this->callRequest($pollpayload, $token, env('CRS_API_URL') . '/mcl/request');

            $response = json_decode($apiresponse->getBody(), true);

            $this->getCsrDataFromApiResponse($response, $client_id);

            return response()->json(Helper::renderJsonSuccess("Report imported successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            return response()->json(Helper::renderJsonError($e->getMessage()))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    private function updateCsrApiData($service, $client_id)
    {
        Auth::user()->crsCreditReport()->delete();
        foreach ($service['credit']['creditresponse']['creditliabilities'] as $libalities) {
            foreach ($libalities as $credit) {
                $creditorname = $credit['creditliabilitycreditor']['name']['fullName']['value'] ?? '';
                $address = $credit['creditliabilitycreditor']['address']['addressLineText']['value'] ?? '';
                $city = $credit['creditliabilitycreditor']['address']['cityName']['value'] ?? '';
                $zip = $credit['creditliabilitycreditor']['address']['postalCode']['value'] ?? '';
                $state = $credit['creditliabilitycreditor']['address']['stateCode']['value'] ?? '';
                $details = $credit['creditliabilitydetail'];
                $data = [
                    'client_id' => $client_id,
                    'fullName' => $creditorname,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'zip' => $zip,
                    'creditBusinessType' => $details['creditBusinessType']['value'] ?? '',
                    'creditLiabilityAccountIdentifier' => $details['creditLiabilityAccountIdentifier']['value'] ?? '',
                    'creditLiabilityAccountOpenedDate' => $details['creditLiabilityAccountOpenedDate']['value'] ?? '',
                    'creditLiabilityAccountReportedDate' => $details['creditLiabilityAccountReportedDate']['value'] ?? '',
                    'creditLiabilityAccountType' => $details['creditLiabilityAccountType']['value'] ?? '',
                    'creditLiabilityAccountOwnershipType' => $details['creditLiabilityAccountOwnershipType']['value'] ?? '',
                    'creditLiabilityAccountStatusType' => $details['creditLiabilityAccountStatusType']['value'] ?? '',
                    'creditLiabilityMonthlyPaymentAmount' => $details['creditLiabilityMonthlyPaymentAmount']['value'] ?? '',
                    'creditLiabilityPastDueAmount' => $details['creditLiabilityPastDueAmount']['value'] ?? '',
                    'creditLiabilityTermsSourceType' => $details['creditLiabilityTermsSourceType']['value'] ?? '',
                    'creditLiabilityUnpaidBalanceAmount' => $details['creditLiabilityUnpaidBalanceAmount']['value'] ?? '',
                    'creditLoanType' => $details['creditLoanType']['value'] ?? '',
                    'detailCreditBusinessType' => $details['detailCreditBusinessType']['value'] ?? '',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
                Auth::user()->crsCreditReport()->create($data);
            }
        }
    }

    private function getCsrDataFromApiResponse($response, $client_id)
    {
        if (!isset($response['dealsets']['dealsets'])) {
            abort("200", "Oops!! CRS server busy, Please try again.");
        }
        foreach ($response['dealsets']['dealsets'] as $dealset) {
            foreach ($dealset['deals']['deals'] as $deal) {
                foreach ($deal['services']['services'] as $service) {
                    if (isset($service['statuses']['statuses'][0]['statusCode']['value']) && $service['statuses']['statuses'][0]['statusCode']['value'] == 'Error') {
                        $error = $service['statuses']['statuses'][0]['statusDescription']['value'] ?? '';
                        abort("200", $error);
                    }
                    if (!isset($service['credit']['creditresponse']['creditliabilities'])) {
                        abort("200", "Credit Report data not available for this account, Check your details.");
                    }
                    if (!empty($service['credit']['creditresponse']['creditliabilities'])) {
                        $this->updateCsrApiData($service, $client_id);
                    }
                }
            }
        }
    }

    public function fetch_client_crs_report()
    {
        $client_id = Auth::user()->id;
        $report = \App\Models\CrsCreditReport::where('client_id', $client_id)->orderBy('client_confirm', 'asc')->orderBy('id', 'desc')->get();
        $report = !empty($report) ? $report->toArray() : [];
        if (!empty($report)) {
            $liens = Auth::user()->crsLienJudgmentsReport()->orderBy('client_confirm', 'asc')->orderBy('id', 'desc')->get();

            return view('client.questionnaire.debt.report_list')->with(['liens' => $liens,'report' => $report, 'web_view' => Session::get('web_view')])->render();
        }
    }

    public function import_client_crs_creditor(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $dataTosave = [
                'client_id' => Auth::user()->id,
                'fullName' => $input['creditor_name'],
                'creditLiabilityAccountIdentifier' => $input['account'],
                'address' => $input['street'],
                'city' => $input['city'],
                'state' => $input['state'],
                'zip' => $input['zip'],
                'creditLoanType' => $input['credit_type_selection'],
                'client_confirm' => Helper::NO,
                'manual_added_by_client' => Helper::YES,
                'creditLiabilityUnpaidBalanceAmount' => $input['amount'],
                'creditLiabilityAccountReportedDate' => $input['date_incurred']
            ];
            \App\Models\CrsCreditReport::updateOrCreate($dataTosave, $dataTosave);

            return response()->json(Helper::renderJsonSuccess("Creditor imported successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function confirmCreditorIntoCrs(Request $request)
    {
        if ($request->isMethod('post')) {
            \App\Models\CrsCreditReport::where('client_id', Auth::user()->id)->update(['client_confirm' => 1]);

            return response()->json(Helper::renderJsonSuccess("Record updated successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function confirm_client_liens(Request $request)
    {
        if ($request->isMethod('post')) {
            \App\Models\CrsLienJudgmentsReport::where('client_id', Auth::user()->id)->update(['client_confirm' => 1]);

            return response()->json(Helper::renderJsonSuccess("Record updated successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }


}
