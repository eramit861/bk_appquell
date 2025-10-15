<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\ClientsAttorney;
use App\Models\EditQuestionnaire\QuestionnaireUser;
use App\Traits\Common; // Trait
use Illuminate\Support\Facades\Validator;

// Trait

class AttorneyController extends Controller
{
    use Common;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveFormAjax(Request $request)
    {
        $post = $request->post();
        unset($post['_token']);
        $client_id = $post['client_id'];
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $formId = $post['form_id'];
        if (in_array($formId, ['107', '108', '110', '111', '121'])) {
            $formId = 'b' . $formId;
        }
        if (in_array($formId, ['101'])) {
            $formId = 'vol_petition_data';
        }

        $formId = str_replace("-", "_", $formId);

        $dataToSave = [];
        $dataToSave['form_id'] = $formId;
        $dataToSave['data'] = json_encode($post);
        $dataToSave['client_id'] = $client_id;
        $dataToSave['created_at'] = date('Y-m-d H:i:s');
        $dataToSave['updated_at'] = date('Y-m-d H:i:s');

        \App\Models\AttorneyClientHtml::updateOrCreate(['client_id' => $client_id,'form_id' => $formId], $dataToSave);

        return response()->json(Helper::renderJsonSuccess('Data saved successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    protected function getClientData($client_id)
    {
        return User::with(['ClientsAttorneybyclient','ClientsAttorneybyattorney','ClientsAttorneybyclient.getuserattorney'])->select('id', 'user_status', 'name', 'created_at', 'client_type', 'client_payroll_assistant', 'client_subscription', 'document_email_notification', 'document_pushed_notification', 'argyle_invalid_credential_self', 'argyle_invalid_credential_spouse', 'client_bank_statements', 'client_profit_loss_assistant', 'detailed_property')->where('id', $client_id)->first();
    }

    protected function getClientCompletedStepsCount($id)
    {
        $form_completed_clients = \App\Models\FormsStepsCompleted::where('client_id', $id)->select('client_id', DB::raw('SUM(step1+step2+step3+step4+step5+step6) as Total'))->groupBy('client_id')->get()->pluck('Total', 'client_id')->toArray();
        $total = isset($form_completed_clients[$id]) ? $form_completed_clients[$id] : 0;

        return $total;
    }

    protected function unLinkFiles($files)
    {
        if (!empty($files)) {
            File::delete($files);
        }
    }

    protected function getCreditors($user, $attorney_company, $basic_info, $propertyInfo)
    {
        $BasicInfoPartA = $basic_info['BasicInfoPartA'];
        $BasicInfoPartB = $basic_info['BasicInfoPartB'];
        $creditorsObj = new \App\Models\Creditors();
        $creditors = $creditorsObj->download_cliet_creditors($user, $basic_info, $propertyInfo);

        $debtorname = Helper::validate_key_value('name', $BasicInfoPartA);
        $debtorname .= " ".Helper::validate_key_value('middle_name', $BasicInfoPartA);
        $debtorname .= " ".Helper::validate_key_value('last_name', $BasicInfoPartA);

        $spousename = Helper::validate_key_value('name', $BasicInfoPartB);
        $spousename .= " " . Helper::validate_key_value('middle_name', $BasicInfoPartB);
        $spousename .= " " . Helper::validate_key_value('last_name', $BasicInfoPartB);
        $debtorname .= !empty($spousename) ? " and " . $spousename : '';

        $address = Helper::validate_key_value('Address', $BasicInfoPartA);
        $city = Helper::validate_key_value('City', $BasicInfoPartA);
        $state = Helper::validate_key_value('state', $BasicInfoPartA);
        $zip = Helper::validate_key_value('zip', $BasicInfoPartA);

        $client = [
            'creditor_name' => $debtorname ?? '',
            'creditor_name_addresss' => $address ?? '',
            'creditor_city' => $city ?? '',
            'creditor_state' => $state ?? '',
            'creditor_zip' => $zip ?? '',
            'account_number' => '',
            'debt_incurred_date' => '',
            'debt_amount_due' => '',
            'describe_secure_claim' => '',
            'debt_owned_by' => ''
        ];

        $attorneyAddress = $attorney_company['attorney_address'] ?? '';
        $attorneyAddress .= isset($attorney_company['attorney_address2']) ? $attorney_company['attorney_address2'] : '';
        $attorney = [
            'creditor_name' => $attorney_company['company_name'] ?? '',
            'creditor_name_addresss' => $attorneyAddress,
            'creditor_city' => $attorney_company['attorney_city'] ?? '',
            'creditor_state' => $attorney_company['attorney_state'] ?? '',
            'creditor_zip' => $attorney_company['attorney_zip'] ?? '',
            'account_number' => '',
            'debt_incurred_date' => '',
            'debt_amount_due' => '',
            'describe_secure_claim' => '',
            'debt_owned_by' => ''
        ];
        array_unshift($creditors, $attorney);
        array_unshift($creditors, $client);

        return $creditors;
    }

    public function credit_report_uploads(Request $request)
    {

        $attorneycId = Helper::getCurrentAttorneyId();
        $client_id = $request->input('client_id');
        if (!Helper::isClientBelongsToAttorney($client_id, $attorneycId)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request.');
        }
        if ($request->hasFile('report_file')) {
            $validate = Validator::make($request->all(), [
                'report_file' => 'required|mimes:pdf|max:5120',
                'client_id' => 'required',
            ]);
            if ($validate->fails()) {
                return redirect()->route('attorney_client_upload_credit_report', $client_id)->with('error', $validate->errors()->first());
            }

            $reportpath = public_path() . "/creditReport/" . $attorneycId . "/" . $client_id;
            $this->checkOrCreateDir($reportpath);
            $reportimageName = $request->report_file->getClientOriginalName();
            $reportimageName = time() . '_' . $reportimageName;
            $request->report_file->move($reportpath, $reportimageName);

            return redirect()->route('attorney_client_upload_credit_report', $client_id)->with('success', 'Report has been uploaded successfully.');
        }

        return redirect()->route('attorney_client_upload_credit_report', $client_id)->with('error', 'Please select Report file.');
    }


    protected function checkCreditLoanType($creditLoanType)
    {
        switch ($creditLoanType) {
            case 'CREDIT_CARD':
                $type = 2;
                break;
            case 'COLLECTION':
            case 'CHARGE_ACCOUNT':
                $type = 3;
                break;
            case 'OTHER':
            case 'UNSECURED':
                $type = 4;
                break;
            case 'EDUCATIONAL':
                $type = 5;
                break;
            default:
                $type = 1;
                break;
        }

        return $type;
    }

    /**
     * Validate that client belongs to the attorney
     *
     * @param int $clientId Client ID to validate
     * @return bool True if valid
     * @throws \Illuminate\Auth\Access\AuthorizationException If client doesn't belong to attorney
     */
    protected function validClient($clientId)
    {
        $attorneyId = Helper::getCurrentAttorneyId();
        $isExist = ClientsAttorney::where(['client_id' => $clientId, "attorney_id" => $attorneyId])->exists();

        if (!$isExist) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return true;
    }

    protected function validReport($clientId, $reportId)
    {
        if ($reportId == 0) {
            return true;
        }
        $isExist = \App\Models\CrsCreditReport::where(["client_id" => $clientId, 'id' => $reportId])->exists();
        if (!$isExist) {
            return false;
        }

        return true;
    }

    protected function getAttorneyPackages()
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        $attorney = User::find($attorney_id);

        return \App\Models\AttorneySubscription::getAttorneySubscriptions($attorney);
    }

    protected function getAttorneyUsedSubscriptions()
    {
        $attorney_id = Helper::getCurrentAttorneyId();

        return \App\Models\AttorneySubscription::getConsumeSubscription($attorney_id);
    }

    protected function isValidPackage()
    {
        if (Auth::user()->role == 1) {
            return true;
        }

        $attorney_id = Helper::getCurrentAttorneyId();
        $data = \App\Models\AttorneySubscription::where(['attorney_id' => $attorney_id,'is_signup_subscription' => 1])->first();
        $package = !empty($data) ? $data->toArray() : [];
        if (empty($package)) {
            return false;
        }
        if (isset($package['type']) && !in_array($package['type'], \App\Models\AttorneySubscription::PACKAGE_IDS)) {
            return false;
        }

        return true;
    }

    protected function getClientAttorneyId($client_id)
    {
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        $attorney_id = Helper::getCurrentAttorneyId();
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }

        return $attorney_id;
    }

    protected function markReviewwedBy($byAttorneyId, $client_id, $reviewed_for, $label, $name)
    {
        $clientObj = \App\Models\User::find($client_id);
        if (!$clientObj) {
            return; // Exit if client not found
        }

        $reviewSections = [
            'basic_info' => [
                'checks' => ['DebtorInfo', 'CoDebtorInfo', 'BusinessInfo'],
                'section' => 'basic_info'
            ],
            'property_resident' => [
                'checks' => ['PropertyResidenceInfo'],
                'section' => 'property'
            ],
            'property_vehicle' => [
                'checks' => ['PropertyVehicleInfo'],
                'section' => 'property'
            ],
            'property' => [
                'checks' => [
                    'PropertyVehicleInfo',
                    'PropertyHouseholdInfo',
                    'PropertyFinancialAssetInfo',
                    'PropertyBusinessAssetInfo',
                    'PropertyFarmCommercialInfo',
                    'PropertyMiscellaneousInfo'
                ],
                'section' => 'property'
            ]
        ];

        // Check if the given $reviewed_for exists in our mapping
        if (isset($reviewSections[$reviewed_for])) {
            $allEdited = array_map(fn ($info) => QuestionnaireUser::isAddedByAttorney($info, $clientObj), $reviewSections[$reviewed_for]['checks']);

            // If all conditions are true, add the review
            if (!in_array(false, $allEdited)) {
                \App\Models\ClientQuestionnaireReview::addReviewForSection($client_id, $reviewSections[$reviewed_for]['section'], $byAttorneyId, $name, $label);
            }
        }
    }

    public function getDiscountPrice($discountPercentage, $packagePriceTotal)
    {
        return number_format((float)$packagePriceTotal * ((float)$discountPercentage / 100), 3);
    }

    public function getPackageName($package_id)
    {
        return  \App\Models\AttorneySubscription::allPackageNameWithParamForTransactionArray($package_id);
    }
}
