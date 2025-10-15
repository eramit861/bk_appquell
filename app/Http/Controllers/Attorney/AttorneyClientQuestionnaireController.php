<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\AddressHelper;
use App\Helpers\ArrayHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Models\EditQuestionnaire\QuestionnaireUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;
use DateTime;
use App\Helpers\DateTimeHelper;
use Illuminate\Support\Facades\Session;
use App\Helpers\VideoHelper;
use App\Models\AttorneySettings;
use App\Models\ClientsAssociate;
use App\Models\DebtsTax;
use App\Models\PayStubs;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheExpense;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheProperty;
use App\Services\Client\CacheSOFA;
use App\Services\Client\PropertyDataService;

class AttorneyClientQuestionnaireController extends AttorneyController
{
    protected PropertyDataService $propertyDataService;

    public function __construct(PropertyDataService $propertyDataService)
    {
        $this->propertyDataService = $propertyDataService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function form_submission_view($client_id)
    {
        $attorney_id = \App\Models\AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request.');
        }
        $clientObj = User::where('id', $client_id)->first();
        $completedSteps = \App\Models\FormsStepsCompleted::where('client_id', $client_id);
        $form_completed_clients = clone $completedSteps;
        $form_completed_clients = $form_completed_clients->select('client_id', DB::raw('SUM(step1+step2+step3+step4+step5+step6) as Total'))->groupBy('client_id')->get()->pluck('Total', 'client_id')->toArray();
        $total = isset($form_completed_clients[$client_id]) ? $form_completed_clients[$client_id] : 0;
        if (empty($total) || $total < 6) {
            //return redirect()->route('attorney_client_view', $client_id)->with('error', 'Questionnaire is not yet submitted by the client.');
        }

        $clientCompletedSteps = clone $completedSteps;
        $clientCompletedSteps = $clientCompletedSteps->select('step1', 'step2', 'step3', 'step4', 'step5', 'step6')->first();
        $clientCompletedSteps = !empty($clientCompletedSteps) ? $clientCompletedSteps->toArray() : [];

        $isDebtorEdited = QuestionnaireUser::isAddedByAttorney('DebtorInfo', $clientObj);
        $isCoDebtorEdited = QuestionnaireUser::isAddedByAttorney('CoDebtorInfo', $clientObj);
        $isBusinessEdited = QuestionnaireUser::isAddedByAttorney('BusinessInfo', $clientObj);
        $isPropertyResidenceEdited = QuestionnaireUser::isAddedByAttorney('PropertyResidenceInfo', $clientObj);
        $isPropertyVehicleEdited = QuestionnaireUser::isAddedByAttorney('PropertyVehicleInfo', $clientObj);
        $isPropertyHouseholdEdited = QuestionnaireUser::isAddedByAttorney('PropertyHouseholdInfo', $clientObj);
        $isPropertyFinancialAssetEdited = QuestionnaireUser::isAddedByAttorney('PropertyFinancialAssetInfo', $clientObj);
        $isPropertyFinancialAssetContinuedEdited = QuestionnaireUser::isAddedByAttorney('PropertyFinancialAssetContinuedInfo', $clientObj);
        $isPropertyBusinessAssetEdited = QuestionnaireUser::isAddedByAttorney('PropertyBusinessAssetInfo', $clientObj);
        $isPropertyFarmCommercialEdited = QuestionnaireUser::isAddedByAttorney('PropertyFarmCommercialInfo', $clientObj);
        $isPropertyMiscellaneousEdited = QuestionnaireUser::isAddedByAttorney('PropertyMiscellaneousInfo', $clientObj);


        $final_debtstax = CacheDebt::getDebtData($client_id);
        $fromAttorney = true;

        $basic_info = CacheBasicInfo::getBasicInformationData($client_id, false, $fromAttorney);
        $property_info = CacheProperty::getPropertyData($client_id, false, $fromAttorney);

        $attorneyPropertyhousehold = $property_info['propertyhousehold'] ?? [];
        $clientPropertyhousehold = $clientObj->getPropertyHousehold(false)->toArray() ?? [];

        $property_info['propertyhousehold'] = $this->getMergedPropertyHouseholdData($attorneyPropertyhousehold, $clientPropertyhousehold);

        $income_info = CacheIncome::getIncomeData($client_id);
        $condition = [
            'attorney_id' => $attorney_id,
            'client_id' => $client_id,
            'client_type' => 1,
        ];

        $currentEmployer = \App\Models\AttorneyEmployerInformationToClient::where($condition)->where('employer_type', 1)->get();
        $currentEmployer = (isset($currentEmployer) && !empty($currentEmployer)) ? $currentEmployer->toArray() : [];

        $income_info['currentEmployer'] = $currentEmployer;

        $previousEmployer = \App\Models\AttorneyEmployerInformationToClient::where($condition)->where('employer_type', 2)->get();
        $previousEmployer = (isset($previousEmployer) && !empty($previousEmployer)) ? $previousEmployer->toArray() : [];

        $income_info['previousEmployer'] = $previousEmployer;

        $condition['client_type'] = 2;
        $currentEmployerSpouse = \App\Models\AttorneyEmployerInformationToClient::where($condition)->where('employer_type', 1)->get();
        $currentEmployerSpouse = (isset($currentEmployerSpouse) && !empty($currentEmployerSpouse)) ? $currentEmployerSpouse->toArray() : [];

        $income_info['currentEmployerSpouse'] = $currentEmployerSpouse;

        $previousEmployerSpouse = \App\Models\AttorneyEmployerInformationToClient::where($condition)->where('employer_type', 2)->get();
        $previousEmployerSpouse = (isset($previousEmployerSpouse) && !empty($previousEmployerSpouse)) ? $previousEmployerSpouse->toArray() : [];

        $income_info['previousEmployerSpouse'] = $previousEmployerSpouse;

        $expenses_info = CacheExpense::getExpenseData($client_id);
        $spouse_expenses_info = CacheExpense::getExpenseData($client_id, true);
        $financialaffairs_info = CacheSOFA::getSOFAData($client_id);

        $businessassets = $clientObj->getPropertyBusinessAssets($fromAttorney)->toArray();
        $farmcommercial = $clientObj->getPropertyFarmCommercial($fromAttorney)->toArray();

        $property_info['businessassets'] = self::validateIfData($businessassets);
        $property_info['farmcommercial'] = self::validateIfData($farmcommercial);

        $user = \App\Models\User::where('id', $client_id)->select('client_type')->first();

        $client = \App\Models\User::with(['ClientsAttorneybyclient','ClientsAttorneybyattorney','ClientsAttorneybyclient.getuserattorney'])->where('users.id', $client_id)->first();

        $detailed_property = \App\Models\User::where("id", $client_id)->value('detailed_property');
        $notes = \App\Models\ConciergeServiceNotes::where(['client_id' => $client_id])->first();
        $editable = \App\Models\FormsStepsCompleted::select('can_edit')->where('client_id', $client_id)->first();
        $total = isset($form_completed_clients[$client_id]) ? $form_completed_clients[$client_id] : 0;
        $attorneyCompany = User::find($attorney_id)->AttorneyCompany;
        $attorneyCompany = (!empty($attorneyCompany)) ? $attorneyCompany : [];
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_CLIENT_QUESTIONNAIRE_VIDEO);
        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $attorney_company = (!empty($attorney_company)) ? $attorney_company : [];
        $residentTypes = array_keys(\App\Models\ClientDocumentUploaded::getResidenceKeyValue());

        $autoloansTypes = array_keys(\App\Models\ClientDocumentUploaded::getAutoloanKeyValue());

        $cardsArray = \App\Models\ClientDocumentUploaded::getCardTypeArray();
        $searchDocsIn = [];
        $searchDocsIn = array_merge($searchDocsIn, $residentTypes);
        $searchDocsIn = array_merge($searchDocsIn, $autoloansTypes);
        $searchDocsIn = array_merge($searchDocsIn, $cardsArray);

        $uploadedDocuments = \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id])->whereIn('document_type', $searchDocsIn)->get();
        $uploadedDocuments = !empty($uploadedDocuments) ? $uploadedDocuments->toArray() : [];
        $documentlist = [];
        if (!empty($uploadedDocuments)) {
            foreach ($uploadedDocuments as $doc) {
                $documentlist[$doc['document_type']] = $doc;
            }
        }
        $notes = \App\Models\ConciergeServiceNotes::where(['client_id' => $client_id, 'marked_seen' => 0])->count();
        $lawsuitDebts = DebtsTax::getLawsuitDebts($client_id);

        $reviwedData = \App\Models\ClientQuestionnaireReview::where('client_id', $client_id)->get();
        $reviwedData = !empty($reviwedData) ? $reviwedData->toArray() : [];

        $rwData = [];
        foreach ($reviwedData as $data) {
            $rwData[ $data['reviewed_for'] ] = [
                "status" => $data['reviewed_status'],
                "name" => $data['reviewed_by_name'],
                "time" => \Carbon\Carbon::parse($data['reviewed_at'])->format('m/d/Y @ h:i A'),
            ];
        }

        $refreenceAdmin = Session::get('refrence_admin');
        $loggedInUser = Auth::user();

        if (isset($refreenceAdmin) && \App\Models\User::where('id', $refreenceAdmin)->value('role') == 1) {
            $loggedInUser = User::where('id', $refreenceAdmin)->first();
        }

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = !empty($ClientsAssociateId) ? AttorneySettings::getProfitLossMonths($ClientsAssociateId, $is_associate) : AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

        $client_uoloaded_documents = \App\Models\ClientDocuments::getClientUploadedDocArray($client, $client_id, $attorney_id, true);

        $attorneySettings = AttorneySettings::where('attorney_id', $attorney_id)->select(['transaction_pdf_enabled', 'transaction_pdf_signature_enabled', 'is_confirm_prompt_enabled'])->first();
        $attorneySettings = (!empty($attorneySettings)) ? $attorneySettings->toArray() : [];
        $transaction_pdf_enabled = Helper::validate_key_value('transaction_pdf_enabled', $attorneySettings, 'radio');
        $transaction_pdf_signature_enabled = Helper::validate_key_value('transaction_pdf_signature_enabled', $attorneySettings, 'radio');
        $is_confirm_prompt_enabled = Helper::validate_key_value('is_confirm_prompt_enabled', $attorneySettings, 'radio');
        $payStubAIStatus = PayStubs::getAIStatusBasedArray($client_id);
        $templateData = $this->propertyDataService->getTemplateData($attorney_id, 'money_own_to_you');
        $moneyOwnSettings = Helper::validate_key_value('data', $templateData);
        $templateData = $this->propertyDataService->getTemplateData($attorney_id, 'financial_assets');
        $financialAssetsSettings = Helper::validate_key_value('data', $templateData);
        $personalHouseholdSettings = $this->propertyDataService->getTemplateData($attorney_id, 'personal_household_items');
        // $personalHouseholdSettings =  Helper::validate_key_value('data', $personalHouseholdSettings);
        $returnData = [
            // Basic info checks
            'isCoDebtorEdited' => $isCoDebtorEdited,
            'isDebtorEdited' => $isDebtorEdited,
            'isBusinessEdited' => $isBusinessEdited,
            'client_uoloaded_documents' => $client_uoloaded_documents,
            'moneyOwnSettings' => $moneyOwnSettings,
            'financialAssetsSettings' => $financialAssetsSettings,
            'personalHouseholdSettings' => $personalHouseholdSettings,
            // Property checks
            'isPropertyResidenceEdited' => $isPropertyResidenceEdited,
            'isPropertyVehicleEdited' => $isPropertyVehicleEdited,
            'isPropertyHouseholdEdited' => $isPropertyHouseholdEdited,
            'isPropertyFinancialAssetEdited' => $isPropertyFinancialAssetEdited,
            'isPropertyFinancialAssetContinuedEdited' => $isPropertyFinancialAssetContinuedEdited,

            'isPropertyBusinessAssetEdited' => $isPropertyBusinessAssetEdited,
            'isPropertyFarmCommercialEdited' => $isPropertyFarmCommercialEdited,
            'isPropertyMiscellaneousEdited' => $isPropertyMiscellaneousEdited,

            'video' => $video,
            'uploadedDocuments' => $documentlist,
            'basic_info' => $basic_info,
            'property_info' => $property_info,
            'income_info' => $income_info,
            'debts' => $final_debtstax,
            'expenses_info' => $expenses_info,
            'spouse_expenses_info' => $spouse_expenses_info,
            'financialaffairs_info' => $financialaffairs_info,
            'client_id' => $client_id,
            'client_type' => $user->client_type,
            'User' => $client,
            'notes' => $notes,
            'editable' => (isset($editable->can_edit) ? $editable->can_edit : 0),
            'type' => 'view',
            'totals' => $total,
            'attorneyCompany' => $attorneyCompany,
            'detailed_property' => $detailed_property,
            'attorney_company' => $attorney_company,
            'attorney_id' => $attorney_id,
            'new_notes' => $notes,
            'lawsuitDebts' => $lawsuitDebts,
            'rwData' => $rwData,
            'loggedInUser' => $loggedInUser,
            'attProfitLossMonths' => $attProfitLossMonths,
            'transaction_pdf_enabled' => $transaction_pdf_enabled,
            'transaction_pdf_signature_enabled' => $transaction_pdf_signature_enabled,
            'clientCompletedSteps' => $clientCompletedSteps,
            'is_confirm_prompt_enabled' => $is_confirm_prompt_enabled,
            'payStubAIStatus' => $payStubAIStatus
        ];

        return view('attorney.form_submission_view', $returnData);
    }

    public static function getMergedPropertyHouseholdData($attorneyPropertyhousehold, $clientPropertyhousehold)
    {
        if (!empty($attorneyPropertyhousehold) && !empty($clientPropertyhousehold)) {
            foreach ($clientPropertyhousehold as $key => $value) {
                foreach ($attorneyPropertyhousehold as $key1 => $value1) {
                    if ($value['type'] == $value1['type']) {
                        $clientPropertyhousehold[$key] = array_merge($value, $value1);
                        unset($attorneyPropertyhousehold[$key1]);
                    }
                }
            }
        }

        return $clientPropertyhousehold;
    }

    public function checkForNotes(Request $request)
    {
        $client_id = $request->input('client_id');
        $user = User::whereId($client_id)->first();
        $isConciergeClient = (isset($user) && !empty($user)) ? $user->concierge_service : 0 ;
        $notes = \App\Models\ConciergeServiceNotes::where(['client_id' => $client_id])->orderby('id', 'asc')->get();
        $notes = !empty($notes) ? $notes->toArray() : [];
        $returnHTML = view('attorney.client.notes_popup', ['is_print' => 0, 'notes' => $notes, 'client_id' => $client_id, 'isAdmin' => false, 'isConciergeClient' => $isConciergeClient ])->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function add_attorney_notes(Request $request)
    {
        if ($request->isMethod('post')) {
            $client_id = $request->input('client_id');
            $note = $request->input('note');
            $subject = $request->input('category');
            $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
            if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
                $attorney_id = $attorney->attorney_id;
            }
            \App\Models\ConciergeServiceNotes::create(['client_id' => $client_id, 'subject' => $subject,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"),'note' => $note,'added_by_id' => $attorney_id]);
            \App\Models\ConciergeServiceNotes::where('client_id', $client_id)->update(['marked_seen' => 1]);

            return redirect()->back()->with('success', 'Attorney note added successfully!');
        }
    }

    public function mark_notes_as_shown(Request $request)
    {
        $client_id = $request->input('client_id');
        \App\Models\ConciergeServiceNotes::where('client_id', $client_id)->update(['marked_seen' => 1]);

        return response()->json(Helper::renderJsonSuccess('Status updated successfully'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    private function validateIfData($data)
    {
        $businessData = [];
        foreach ($data as $arr) {
            if (!empty($arr['type_data'])) {
                array_push($businessData, $arr);
            }
        }

        return $businessData;
    }

    public function client_profit_loss_popup_download(Request $request)
    {
        $client_id = $request['id'];
        $additional = $request->get('additional');
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request.');
        }
        $final_debtormonthlyincome = self::getProfitLossOfclient($client_id, $additional);

        return self::getPDFData($final_debtormonthlyincome, $request, $client_id);
    }

    private static function getPDFData($final_debtormonthlyincome, $request, $client_id)
    {
        $clientObj = \App\Models\User::where('id', $client_id)->first();
        $profitType = Helper::validate_key_value('profitType', $request, 'radio');
        $for_month = Helper::validate_key_value('for_month', $request);

        $displayData = [];

        if ($profitType == 1) {
            $displayData = self::getProfitLossTypeSameData($final_debtormonthlyincome, $for_month);
        } else {
            $displayData = self::getProfitLossTypeVariesData($final_debtormonthlyincome, $for_month);
            // $displayData = AddressHelper::getProfitLossCommonData($final_debtormonthlyincome, $request);
        }
        $pdata = \App\Models\FormsStepsCompleted::where("client_id", $client_id)->select('step6', 'can_edit', 'updated_on')->first();
        $pdata = !empty($pdata) ? $pdata->toArray() : [];
        $newdate = '';
        if (!empty($pdata) && $pdata['step6'] == 1 && $pdata['can_edit'] == 2) {
            $date = $pdata['updated_on'];
            $timestamp = strtotime($date);
            $newdate = date('m/d/Y', $timestamp);
        }
        $attorney_id = \App\Models\AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $majorLawProfitLossLabels = ArrayHelper::getMajotLawFirmProfitLossLabels($attorney_id);

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $pdfData = [
            'BasicInfoPartA' => $clientBasicInfoPartA,
            'BasicInfo_PartB' => $clientBasicInfoPartB,
            'income_profit_loss' => $displayData,
            'final_date' => $newdate,
            'majorLawProfitLossLabels' => $majorLawProfitLossLabels
        ];


        $pdf = PDF::loadView('client.questionnaire.income.profit_loss_pdf', $pdfData);

        return $pdf->download('client_income_'.$request['for_month'].'.pdf');
    }

    private static function getProfitLossTypeSameData($final_debtormonthlyincome, $for_month)
    {
        $sampleArray = reset($final_debtormonthlyincome) ?? [];
        $sampleArray['profit_loss_month'] = $for_month;

        return $sampleArray;
    }

    private static function getProfitLossTypeVariesData($final_debtormonthlyincome, $for_month)
    {
        $final_debtormonthlyincome = reset($final_debtormonthlyincome) ?? [];
        $sampleArray = [];
        foreach ($final_debtormonthlyincome as $data) {
            if (isset($data['profit_loss_month']) && $data['profit_loss_month'] == $for_month) {
                $sampleArray = $data;
                break;
            }
        }

        return $sampleArray;
    }

    public function client_spouse_profit_loss_popup_download(Request $request)
    {
        $client_id = $request['id'];
        $additional = $request->get('additional');
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request.');
        }
        $final_debtormonthlyincome = self::getProfitLossOfJoinclient($client_id, $additional);

        return self::getPDFData($final_debtormonthlyincome, $request, $client_id);
    }

    private static function getProfitLossOfclient($client_id, $additional = "")
    {
        if (!empty($additional)) {
            $income_profit_loss = "income_profit_loss_" . $additional;
        } else {
            $income_profit_loss = "income_profit_loss";
        }
        $incomeData = CacheIncome::getIncomeData($client_id);
        $D1Data = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');

        return User::getSelectedColumnsFromArray($D1Data, [$income_profit_loss]);
    }

    private static function getProfitLossOfJoinclient($client_id, $additional = "")
    {
        if (!empty($additional)) {
            $income_profit_loss = "income_profit_loss_" . $additional;
        } else {
            $income_profit_loss = "income_profit_loss";
        }
        $incomeData = CacheIncome::getIncomeData($client_id);
        $D2Data = Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');

        return User::getSelectedColumnsFromArray($D2Data, [$income_profit_loss]);
    }

    public function allow_client_edit_ques(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        $client_id = $request->input('client_id');
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError('Invalid request.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $can_edit_basic_info = $request->input('can_edit_basic_info');
        $can_edit_property = $request->input('can_edit_property');
        $can_edit_debts = $request->input('can_edit_debts');
        $can_edit_income = $request->input('can_edit_income');
        $can_edit_expenase = $request->input('can_edit_expenase');
        $can_edit_sofa = $request->input('can_edit_sofa');
        $for_tab = $request->input('for_tab');
        $client = \App\Models\User::find($client_id);
        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $attorney_company = (!empty($attorney_company)) ? $attorney_company : [];

        $isAdmin = $request->input('isAdmin') ?? false;
        $isAttorney = $request->input('isAttorney') ?? false;
        $dataToUpdate = [
                        'client_id' => $client_id,
                        'can_edit_basic_info' => $can_edit_basic_info,
                        'can_edit_property' => $can_edit_property,
                        'can_edit_debts' => $can_edit_debts,
                        'can_edit_income' => $can_edit_income,
                        'can_edit_expenase' => $can_edit_expenase,
                        'can_edit_sofa' => $can_edit_sofa
        ];

        if (($isAdmin || $isAttorney) && in_array(1, [$can_edit_basic_info, $can_edit_property, $can_edit_debts, $can_edit_income, $can_edit_expenase, $can_edit_sofa])) {
            $dataToUpdate['request_edit_access'] = 0;
            $dataToUpdate['request_edit_access_types'] = null;
            $dataToUpdate['request_edit_access_time'] = null;
        }

        \App\Models\FormsStepsCompleted::updateOrCreate(['client_id' => $client_id], $dataToUpdate);

        // Clear tab edit permissions cache since permissions were updated
        Helper::clearTabEditCache($client_id);

        if ($request->input($for_tab) == 1) {
            try {
                $tabname = Helper::getTabByName($for_tab);
                $message = "I’ve gone ahead and granted you edit access to the questionnaire, specifically the [".$tabname."] section. You should now be able to make any necessary changes.";
                if (AttorneySettings::isEmailEnabled($attorney_id, 'client_que_edit_request_mail', $client_id)) {
                    Mail::to($client->email)->send(new \App\Mail\EditRequest($client->name, $message, $attorney_company, Auth::user()->name, Auth::user()->email));
                }
            } catch (\Exception $e) {

            }
        }

        return response()->json(Helper::renderJsonSuccess("Edit client questionnaire settings has been updated successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function add_profit_loss_to_client_zip(Request $request)
    {
        $input = $request->all();
        if (!$request->isMethod('post')) {
            return response()->json(Helper::renderJsonError('Invalid request.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $clientType = $input['clientType'];
        $input['flagValue'] = $input['flagValue'] == true ? 1 : 0;

        if ($clientType == 'self') {
            \App\Models\User::where('id', $input['client_id'])->update(['debtor_add_profit_loss_to_client_zip' => $input['flagValue']]);
        }
        if ($clientType == 'spouse') {
            \App\Models\User::where('id', $input['client_id'])->update(['co_debtor_add_profit_loss_to_client_zip' => $input['flagValue']]);
        }

        return response()->json(Helper::renderJsonSuccess('Records updated successfully!'));
    }

    public function client_profit_loss_popup_zip_download(Request $request)
    {
        $client_id = $request['id'];
        $clientType = $request['clientType'];
        $additional = $request->get('additional');
        $attorney_id = \App\Models\AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request.');
        }
        $type = '';
        if ($clientType == 'self') {
            $final_debtormonthlyincome = self::getProfitLossOfclient($client_id, $additional);
            $client_type = 'Debtor';
        }
        if ($clientType == 'spouse') {
            $final_debtormonthlyincome = self::getProfitLossOfJoinclient($client_id, $additional);
            $client_type = 'CoDebtor';
            $type = 'Codebtor_';
        }

        $zip = new ZipArchive();
        $zipFileName = public_path() . "/documents/" . $client_id. '/'.$client_type.'_Client_Profit_Loss.zip';

        if ($zip->open($zipFileName, ZipArchive::CREATE) === true) {
            // delete all files in zip
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $zip->deleteIndex($i);
            }
            // add profit loss files to zip
            $incomeProfit = DateTimeHelper::getIncomeDescArray($final_debtormonthlyincome);
            $incomeProfit = $incomeProfit['income_profit_loss'] ?? array_pop($incomeProfit);

            $attProfitLossMonths = !empty($ClientsAssociateId) ? AttorneySettings::getProfitLossMonths($ClientsAssociateId, $is_associate) : AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

            $monthsArray = DateTimeHelper::getFullMonthYearArrayForProfitLoss($attProfitLossMonths);
            if (isset($incomeProfit['profit_loss_type']) && $incomeProfit['profit_loss_type'] == 1) {
                // $incomeProfit = [$incomeProfit];
                $tempObject = $incomeProfit;
                $sampleArray = [];
                foreach ($monthsArray as $key => $value) {
                    $tempObject['profit_loss_month'] = $key;
                    $sampleArray[] = $tempObject;
                }
                $incomeProfit = $sampleArray;
            }

            // Ensure $incomeProfit is always an array
            if (!is_array($incomeProfit)) {
                $incomeProfit = [];
            }

            foreach ($incomeProfit as $key => $value) {
                if (array_key_exists($value['profit_loss_month'], $monthsArray)) {
                    $clientObj = \App\Models\User::where('id', $client_id)->first();
                    $pdata = \App\Models\FormsStepsCompleted::where("client_id", $client_id)->select('step6', 'can_edit', 'updated_on')->first();
                    $pdata = !empty($pdata) ? $pdata->toArray() : [];
                    $newdate = '';
                    $key = (int)$key + 1;
                    if (!empty($pdata) && $pdata['step6'] == 1 && $pdata['can_edit'] == 2) {
                        $date = $pdata['updated_on'];
                        $timestamp = strtotime($date);
                        $newdate = date('m/d/Y', $timestamp);
                    }
                    $attorney_id = \App\Models\AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
                    $majorLawProfitLossLabels = ArrayHelper::getMajotLawFirmProfitLossLabels($attorney_id);

                    $BIData = CacheBasicInfo::getBasicInformationData($client_id);
                    $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
                    $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
                    $pdfData = [
                        'BasicInfoPartA' => $clientBasicInfoPartA,
                        'BasicInfo_PartB' => $clientBasicInfoPartB,
                        'income_profit_loss' => $value,
                        'final_date' => $newdate,
                        'majorLawProfitLossLabels' => $majorLawProfitLossLabels
                    ];
                    $months = isset($value['profit_loss_month']) && !empty($value['profit_loss_month']) ? explode("-", $value['profit_loss_month']) : '';
                    $monthName = '';
                    if (isset($months[0])) {
                        $dateObj = DateTime::createFromFormat('!m', $months[0]);
                        $monthName = $dateObj->format('F');
                    }
                    $pdf = PDF::loadView('client.questionnaire.income.profit_loss_pdf', $pdfData);
                    $pdfFileName = $type.'Month_'.$monthName.'.pdf';
                    $directory = public_path("documents/{$client_id}");

                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true); // Ensures directory exists
                    }
                    $pdf->save($directory. '/' . $pdfFileName);
                    $zip->addFile($directory. '/' . $pdfFileName, $pdfFileName);
                }
            }
            $zip->close();
        }

        return response()->download($zipFileName);
    }

    public function paralegal_check_popup($client_id)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request.');
        }
        // default status
        $textNA = "<span class='text-na'>N/A</span>";
        $textNO = "<span class='text-no'>NO</span>";
        $textOK = "<span class='text-ok'>OK</span>";
        $textOKYellow = "<span class='text-ok-yellow'>OK</span>";

        // default variables
        $ssn = $textNA;
        $itin = $textNA;
        $businessNames = $textNA;
        $lifeInsuranceDebtor = $textNA;
        $lifeInsuranceCodebtor = $textNA;
        $supplementalLifeDebtor = $textNA;
        $supplementalLifeCodebtor = $textNA;
        $healthSavingsAccountDebtor = $textNA;
        $healthSavingsAccountCodebtor = $textNA;
        $communityPropertyScheduleH = $textNA;
        $ques4Debtor = $textNA;
        $ques4Codebtor = $textNA;
        $ques5Debtor = $textNA;
        $ques5Codebtor = $textNA;
        $ques6 = $textNA;
        $ques7 = $textNA;
        $ques27 = $textNA;
        $ques28 = $textNA;

        //data to be used for checks
        $client = \App\Models\User::where('id', $client_id)->first();
        $basicInfo = CacheBasicInfo::getBasicInformationData($client_id, false, true);
        $basicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $basicInfo)->toArray();
        $basicInfoPartC = Helper::validate_key_value('BasicInfo_PartC', $basicInfo)->toArray();

        $incomeData = CacheIncome::getIncomeData($client_id);

        $debtorIncome = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');
        $debtorIncome = User::getSelectedColumnsFromArray($debtorIncome, ["social_security","social_security_month","retirement_income","retirement_income_month","unemployment_compensation","unemployment_compensation_month","government_assistance","government_assistance_specify","operation_business","otherDeductions11","other_deduction_specify","other_deduction","automatically_deduction_insurance","paycheck_mandatory_contribution","paycheck_voluntary_contribution","union_dues_deducted"]);

        $spouseIncome = Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');
        $spouseIncome = User::getSelectedColumnsFromArray($spouseIncome, ["joints_union_dues_deducted","joints_paycheck_mandatory_contribution","joints_paycheck_voluntary_contribution","joints_social_security","joints_social_security_month","joints_retirement_income","joints_retirement_income_month","joints_unemployment_compensation","joints_unemployment_compensation_month","government_assistance","government_assistance_specify","joints_operation_business","otherDeductions22","other_deduction_specify","joints_other_deduction"]);

        $property = CacheProperty::getPropertyData($client_id, false, true);
        $resident = Helper::validate_key_value('propertyresident', $property, 'array');
        $resident = !empty($resident) ? $resident->toArray() : [];

        $vehicle = Helper::validate_key_value('propertyvehicle', $property, 'array');
        $recretional = $vehicle;

        $vehicle = !empty($vehicle) ? $vehicle->where("property_type", "!=", Helper::VEHICLE_RECREATINAL_VEHICLE)->toArray() : [];
        $vehicle = array_values($vehicle);

        $recretional = !empty($recretional) ? $recretional->where('property_type', Helper::VEHICLE_RECREATINAL_VEHICLE)->toArray() : [];
        $recretional = array_values($recretional);

        $householdExists = !empty(Helper::validate_key_value('propertyhousehold', $property, 'array'));
        $financialExists = !empty(Helper::validate_key_value('financialassets', $property, 'array'));
        $businessExists = !empty(Helper::validate_key_value('businessassets', $property, 'array'));
        $farmExists = !empty(Helper::validate_key_value('farmcommercial', $property, 'array'));
        $miscExists = !empty(Helper::validate_key_value('miscellaneous', $property, 'array'));

        $final_debtstax = CacheDebt::getDebtData($client_id);
        $additional_liens = (Helper::validate_key_value('additional_liens', $final_debtstax) == 1) ? $final_debtstax['additional_liens_data'] : [];
        $financialaffairs_info = CacheSOFA::getSOFAData($client_id);

        // table 1 data (Voluntary Petition)
        // SSN/ITIN:
        switch ($basicInfoPartA['has_security_number'] ?? '') {
            case 0: $ssn = $textOK;
                $itin = $textNA;
                break; // ssn
            case 1: $ssn = $textNA;
                $itin = $textOK;
                break; // itin
        }
        // Prior Cases:	Que 9
        $ques9 = self::commonSwitch($basicInfoPartC['filed_bankruptcy_case_last_8years']) ?? $textNA;
        // Prior Cases:	Que 10
        $ques10 = self::commonSwitch($basicInfoPartC['any_bankruptcy_cases_pending']) ?? $textNA;
        // Business Names
        switch ($businessExists) {
            case false: $businessNames = $textNO;
                break; // no
            case true: $businessNames = $textOK;
                break; // yes
        }

        $voluntaryPetition = [
                                'ssn' => $ssn,
                                'itin' => $itin,
                                'ques9' => $ques9,
                                'ques10' => $ques10,
                                'businessNames' => $businessNames
                            ];

        // table 2 data (Income & Deductions)
        if (Helper::validate_key_value('otherDeductions11', $debtorIncome) == 1) {
            $debtorDeductionsName = json_encode(Helper::validate_key_value('other_deduction_specify', $debtorIncome));
            if (str_contains(strtolower($debtorDeductionsName), 'life')) {
                $lifeInsuranceDebtor = $textOK;
            }
            if (str_contains(strtolower($debtorDeductionsName), 'supp. life')) {
                $supplementalLifeDebtor = $textOK;
            }
            if (str_contains(strtolower($debtorDeductionsName), 'health savings')) {
                $healthSavingsAccountDebtor = $textOK;
            }
        }
        if (Helper::validate_key_value('otherDeductions22', $spouseIncome) == 1) {
            $spouseDeductionsName = json_encode(Helper::validate_key_value('other_deduction_specify', $spouseIncome));
            if (str_contains(strtolower($spouseDeductionsName), 'life')) {
                $lifeInsuranceCodebtor = $textOK;
            }
            if (str_contains(strtolower($spouseDeductionsName), 'supp. life')) {
                $supplementalLifeCodebtor = $textOK;
            }
            if (str_contains(strtolower($spouseDeductionsName), 'health savings')) {
                $healthSavingsAccountCodebtor = $textOK;
            }
        }

        // debtor deductions
        $deductionsDebtor = [
            'lifeInsurance' => $lifeInsuranceDebtor ?? $textNA,
            'supplementalLife' => $supplementalLifeDebtor ?? $textNA,
            'retirementMandatory' => Helper::validate_key_value('paycheck_mandatory_contribution', $debtorIncome) > 0 ? $textOK : $textNO,
            'retirementVoluntary' => Helper::validate_key_value('paycheck_voluntary_contribution', $debtorIncome) > 0 ? $textOK : $textNO,
            'healthSavingsAccount' => $healthSavingsAccountDebtor ?? $textNA,
            'unionDues' => Helper::validate_key_value('union_dues_deducted', $debtorIncome) > 0 ? $textOK : $textNO
        ];
        // codebtor deductions
        $deductionsCodebtor = [
            'lifeInsurance' => $lifeInsuranceCodebtor ?? $textNA,
            'supplementalLife' => $supplementalLifeCodebtor ?? $textNA,
            'retirementMandatory' => Helper::validate_key_value('joints_paycheck_mandatory_contribution', $spouseIncome) > 0 ? $textOK : $textNO,
            'retirementVoluntary' => Helper::validate_key_value('joints_paycheck_voluntary_contribution', $spouseIncome) > 0 ? $textOK : $textNO,
            'healthSavingsAccount' => $healthSavingsAccountCodebtor ?? $textNA,
            'unionDues' => Helper::validate_key_value('joints_union_dues_deducted', $spouseIncome) > 0 ? $textOK : $textNO
        ];
        // debtor income
        $incomeDebtor = [
            'socialSecurity' => Helper::paralegal_key_display('social_security', $debtorIncome) ?? $textNA,
            'pension' => Helper::paralegal_key_display('retirement_income', $debtorIncome) ?? $textNA,
            'unemployment' => Helper::paralegal_key_display('unemployment_compensation', $debtorIncome) ?? $textNA,
            'governmentAssistance' => Helper::paralegal_key_display('government_assistance', $debtorIncome) ?? $textNA,
            'BusinessSelfEmployed' => Helper::paralegal_key_display('operation_business', $debtorIncome) ?? $textNA
        ];
        // codebtor income
        $incomeCodebtor = [
            'socialSecurity' => Helper::paralegal_key_display('joints_social_security', $spouseIncome) ?? $textNA,
            'pension' => Helper::paralegal_key_display('joints_retirement_income', $spouseIncome) ?? $textNA,
            'unemployment' => Helper::paralegal_key_display('joints_unemployment_compensation', $spouseIncome) ?? $textNA,
            'governmentAssistance' => Helper::paralegal_key_display('government_assistance', $spouseIncome) ?? $textNA,
            'BusinessSelfEmployed' => Helper::paralegal_key_display('joints_operation_business', $spouseIncome) ?? $textNA
        ];

        // table 3 data (Property)
        $property = [
            'realProperty' => !empty($resident) ? ((Helper::validate_key_value('currently_lived', $resident[0]) == 1) ? $textOK : $textNO) : $textNA,
            'Vehicles' => !empty($vehicle) ? ((Helper::validate_key_value('own_any_property', $vehicle[0]) == 1) ? $textOK : $textNO) : $textNA,
            'recreationalVehicles' => !empty($recretional) ? ((Helper::validate_key_value('own_any_property', $recretional[0]) == 1) ? $textOK : $textNO) : $textNA,
            'personalProperty' => !empty($householdExists) ? $textOK : $textNO,
            'financialAssets' => !empty($financialExists) ? $textOK : $textNO,
            'businessRelated' => !empty($businessExists) ? $textOK : $textNO,
            'farmAndCommercialProperty' => !empty($farmExists) ? $textOK : $textNO,
            'miscProperty' => !empty($miscExists) ? $textOK : $textNO
        ];
        // table 3 data (Statement of Financial Affairs)

        $isArrayAL = (is_array($additional_liens) && !empty($additional_liens)) ? Helper::validate_key_value('codebtor_creditor_name', current($additional_liens)) : '';
        if (!empty($additional_liens) && !empty($isArrayAL)) {
            $communityPropertyScheduleH = $textOK;
        }
        $total_amount_this_year_income = Helper::validate_key_value('total_amount_this_year_income', $financialaffairs_info);
        if (!empty($total_amount_this_year_income) && $total_amount_this_year_income > 0) {
            $ques4Debtor = $textOK;
        }
        $total_amount_spouse_this_year_income = Helper::validate_key_value('total_amount_spouse_this_year_income', $financialaffairs_info);
        if (!empty($total_amount_spouse_this_year_income) && $total_amount_spouse_this_year_income > 0) {
            $ques4Codebtor = $textOK;
        }
        $other_amount_this_year_income = Helper::validate_key_value('other_amount_this_year_income', $financialaffairs_info);
        if (!empty($other_amount_this_year_income) && $other_amount_this_year_income > 0) {
            $ques5Debtor = $textOK;
        }
        $other_amount_spouse_this_year_income = Helper::validate_key_value('other_amount_spouse_this_year_income', $financialaffairs_info);
        if (!empty($other_amount_spouse_this_year_income) && $other_amount_spouse_this_year_income > 0) {
            $ques5Codebtor = $textOK;
        }
        if (Helper::validate_key_value('primarily_consumer_debets', $financialaffairs_info) == 1) {
            $ques6 = $textOK;
        }
        if (Helper::validate_key_value('payment_past_one_year', $financialaffairs_info) == 1) {
            $ques7 = $textOK;
        }
        $ques27Object = (is_array(Helper::validate_key_value('list_nature_business_data', $financialaffairs_info)) && !empty(Helper::validate_key_value('list_nature_business_data', $financialaffairs_info))) ? Helper::validate_key_value('list_nature_business_data', $financialaffairs_info) : '';
        if (is_array($ques27Object) && !empty(current($ques27Object))) {
            $ques27 = $textOK;
        }
        if (Helper::validate_key_value('list_financial_institutions', $financialaffairs_info) == 1) {
            $ques28 = $textOK;
        }

        $sofa = [
            'communityPropertyScheduleH' => $communityPropertyScheduleH ?? $textNA,
            'ques4Debtor' => $ques4Debtor ?? $textNA,
            'ques4Codebtor' => $ques4Codebtor ?? $textNA,
            'ques5Debtor' => $ques5Debtor ?? $textNA,
            'ques5Codebtor' => $ques5Codebtor ?? $textNA,
            'ques6' => $ques6 ?? $textNA,
            'ques7' => $ques7 ?? $textNA,
            'ques27' => $ques27 ?? $textNA,
            'ques28' => $ques28 ?? $textNA
        ];

        $dataToShow = [
            'client_id' => $client_id,
            'voluntaryPetition' => $voluntaryPetition,
            'deductionsDebtor' => $deductionsDebtor,
            'deductionsCodebtor' => $deductionsCodebtor,
            'incomeDebtor' => $incomeDebtor,
            'incomeCodebtor' => $incomeCodebtor,
            'property' => $property,
            'sofa' => $sofa
        ];

        $returnHTML = view('attorney.official_form.paralegal_check_popup', $dataToShow)->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);

    }

    public function commonSwitch($variable)
    {
        $textNA = "<span class='text-na'>N/A</span>";
        $textNO = "<span class='text-no'>NO</span>";
        $textOK = "<span class='text-ok'>OK</span>";
        switch ($variable ?? '') {
            case 0: $spanData = $textNO;
                break; // no
            case 1: $spanData = $textOK;
                break; // yes
        }

        return $spanData ?? $textNA;
    }

    public function update_review_status(Request $request)
    {
        $input = $request->all();
        if (!$request->isMethod('post')) {
            return response()->json(Helper::renderJsonError('Invalid request.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $client_id = Helper::validate_key_value('client_id', $input, 'radio');
        $name = Helper::validate_key_value('name', $input);
        $label = Helper::validate_key_value('label', $input);
        $reviewed_by = Helper::validate_key_value('id', $input, 'radio');
        $reviewed_for = Helper::validate_key_value('updateFor', $input);

        $noteForView = \App\Models\ClientQuestionnaireReview::addReviewForSection($client_id, $reviewed_for, $reviewed_by, $name, $label);

        return response()->json(Helper::renderJsonSuccess('Status updated successfully!', ['note' => $noteForView]));
    }

}
