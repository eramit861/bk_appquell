<?php

namespace App\Http\Controllers;

use App\Services\Client\EmployerManagementService;
use App\Services\Client\IncomeCalculationService;
use App\Services\Client\PaystubManagementService;
use App\Helpers\ClientHelper;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\FormsStepsCompleted;
use Illuminate\Support\Facades\Session;
use App\Helpers\VideoHelper;
use App\Models\AttorneyDocuments;
use App\Models\AttorneyEmployerInformationToClient;
use App\Models\AttorneySettings;
use App\Models\ClientsAssociate;
use App\Models\IncomeDebtorEmployer;
use App\Models\IncomeDebtorSpouseEmployer;
use App\Models\PdfToJson;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheIncome;

class ClientIncomeController extends Controller
{
    protected EmployerManagementService $employerService;
    protected IncomeCalculationService $incomeCalculationService;
    protected PaystubManagementService $paystubService;

    public function __construct(
        EmployerManagementService $employerService,
        IncomeCalculationService $incomeCalculationService,
        PaystubManagementService $paystubService
    ) {
        $this->employerService = $employerService;
        $this->incomeCalculationService = $incomeCalculationService;
        $this->paystubService = $paystubService;
    }
    public function client_income()
    {
        $client = Auth::user();

        $client_id = $client->id;
        if ($client->hide_questionnaire && empty($client->client_payroll_assistant)) {
            return redirect()->route('no_client_questionnaire')->with('success', 'You are Logged in successfully');
        }
        $video = VideoHelper::getVideo(Helper::INCOME_DEBTOR_EMPLOYEE_VIDEO);
        if ($client->client_subscription == \App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION || (in_array($client->client_payroll_assistant, [Helper::PAYROLL_ASSISTANT_TYPE_DEBTOR,Helper::PAYROLL_ASSISTANT_TYPE_BOTH]))) {
            $video = VideoHelper::getVideo(Helper::INCOME_DEBTOR_EMPLOYEE_WITH_PAYROLL_VIDEO);
        }
        $steps = ['step1' => true, 'step2' => false, 'step3' => false, 'step4' => false, 'video' => $video];
        $steps['tab'] = 'tab4';

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');

        $redirect = false;
        if (!empty($clientBasicInfoPartA->marital_status) && in_array($clientBasicInfoPartA->marital_status, ['1', '5'])) {
            $redirect = true;
        }

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($settingsAttorneyId, $is_associate);

        $income = CacheIncome::getIncomeData($client_id, true);

        $currentEmployer = AttorneyEmployerInformationToClient::getCurrentEmployerData(1, $client_id, $attorney_id, 1);
        $previousEmployer = AttorneyEmployerInformationToClient::getCurrentEmployerData(1, $client_id, $attorney_id, 2);

        $income['currentEmployer'] = $currentEmployer;
        $income['previousEmployer'] = $previousEmployer;

        $docsUploadInfo = ClientHelper::documentUploadInfo();
        $progress = FormsStepsCompleted::getStepCompletionData($client_id, $client->client_type);
        $docsProgress = ClientHelper::get_uploaded_docs_progress('', $client_id, $settingsAttorneyId);
        $listOfFiles = AttorneyDocuments::getSignedDocuments($client_id, $attorney_id);
        $crsReportNotCompleted = PdfToJson::getCrsReportStatus($client_id);

        // Get names data
        $dashboardService = app(\App\Services\Client\DashboardDataService::class);
        $names = $dashboardService->getDebtorNames($client_id, $client->client_type);
        $labels = $dashboardService->getUiLabels($client);

        return view('client.dashboard', $steps)->with(['crsReportNotCompleted' => $crsReportNotCompleted, 'attProfitLossMonths' => $attProfitLossMonths, 'listOfFiles' => $listOfFiles, 'progress' => $progress,'docsProgress' => $docsProgress, 'income' => $income, 'redirect' => $redirect, 'docsUploadInfo' => $docsUploadInfo, 'progress_percentage' => ClientHelper::checkProgress(), 'names' => $names, 'labels' => $labels ]);
    }

    public function getisImportedStatus($client, $type)
    {
        return $this->incomeCalculationService->getImportedStatus($client->id, $type);
    }

    public function client_income_step1(Request $request)
    {
        $client = Auth::user();
        $client_id = $client->id;
        if ($client->hide_questionnaire && empty($client->client_payroll_assistant)) {
            return redirect()->route('no_client_questionnaire')->with('success', 'You are Logged in successfully');
        }

        $origionalAttorneyId = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $origionalAttorneyId;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_income')) {
            return redirect()->back()->with('error', 'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.');
        }
        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_income')) {

            $input = $request->all();
            if (!empty($input)) {
                $recieved_any_income = Helper::validate_key_value('recieved_any_income', $input, 'radio');
                $previous_employer = Helper::validate_key_value('previous_employer', $input) ?? [];

                if ($recieved_any_income == 1 && is_array($previous_employer) && !empty($previous_employer)) {
                    $this->syncEmployerToAttorney($previous_employer, 1, $client_id, $origionalAttorneyId, 2);
                }
                if ($recieved_any_income == 0) {
                    $this->deleteEmployerToAttorney($client_id, $origionalAttorneyId, 2, 1);
                }
                $debtorCurrentEmployer = AttorneyEmployerInformationToClient::getCurrentEmployerData(1, $client_id, $origionalAttorneyId, 1);
                $curr_emp_radio_status = empty($debtorCurrentEmployer) ? 0 : 1;
                $modal = IncomeDebtorEmployer::class;
                $this->syncRadioDataInEmployerTable($client_id, $modal, $curr_emp_radio_status, $recieved_any_income);
            }
            Session::flash('success', 'Information has been saved successfully');

            return redirect()->route('client_income_step2')->with('redirect', true);
        }

        $video = VideoHelper::getVideo(Helper::INCOME_CO_DEBTOR_EMPLOYEE_VIDEO);
        if ($client->client_subscription == \App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION || (in_array($client->client_payroll_assistant, [Helper::PAYROLL_ASSISTANT_TYPE_BOTH]))) {
            $video = VideoHelper::getVideo(Helper::INCOME_CO_DEBTOR_EMPLOYEE_WITH_PAYROLL_VIDEO);
        }
        $steps = ['step1' => false, 'step2' => true, 'step3' => false, 'step4' => false, 'video' => $video];
        $steps['tab'] = 'tab4';
        $income = CacheIncome::getIncomeData($client_id, true);
        $currentEmployer = AttorneyEmployerInformationToClient::getCurrentEmployerData(2, $client_id, $origionalAttorneyId, 1);
        $previousEmployer = AttorneyEmployerInformationToClient::getCurrentEmployerData(2, $client_id, $origionalAttorneyId, 2);

        $income['currentEmployer'] = $currentEmployer;
        $income['previousEmployer'] = $previousEmployer;

        $docsUploadInfo = ClientHelper::documentUploadInfo();
        $progress = FormsStepsCompleted::getStepCompletionData($client_id, $client->client_type);
        $docsProgress = ClientHelper::get_uploaded_docs_progress('', $client_id, $attorney_id);
        $listOfFiles = AttorneyDocuments::getSignedDocuments($client_id, $attorney_id);
        $crsReportNotCompleted = PdfToJson::getCrsReportStatus($client_id);

        // Get names data
        $dashboardService = app(\App\Services\Client\DashboardDataService::class);
        $names = $dashboardService->getDebtorNames($client_id, $client->client_type);
        $labels = $dashboardService->getUiLabels($client);

        return view('client.dashboard', $steps)->with(['crsReportNotCompleted' => $crsReportNotCompleted, 'attProfitLossMonths' => $attProfitLossMonths, 'listOfFiles' => $listOfFiles,'progress' => $progress, 'docsProgress' => $docsProgress, 'income' => $income, 'docsUploadInfo' => $docsUploadInfo, 'progress_percentage' => ClientHelper::checkProgress(), 'names' => $names, 'labels' => $labels ]);
    }

    public function current_employer_custom_save(Request $request)
    {

        $input = $request->all();
        $client = Auth::user();
        $client_id = $client->id;
        $attorney_id = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_income')) {
            return response()->json(['status' => 0, 'msg' => "You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen."])->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_income')) {

            $empIdToDelete = Helper::validate_key_value('empIdToDelete', $input, 'radio');
            if (isset($empIdToDelete) && $empIdToDelete > 0) {
                AttorneyEmployerInformationToClient::where('id', $empIdToDelete)->delete();
            } else {
                $currentEmployed = Helper::validate_key_value('current_employed', $input, 'radio');
                $currentEmployerData = Helper::validate_key_value('current_employer', $input) ?? [];

                if ($currentEmployed == 1 && is_array($currentEmployerData) && !empty($currentEmployerData)) {
                    $this->syncEmployerToAttorney($currentEmployerData, 1, $client_id, $attorney_id, 1);
                }
                if ($currentEmployed == 0) {
                    $this->deleteEmployerToAttorney($client_id, $attorney_id, 1, 1);
                }
            }
        }

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');


        $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor's");

        $currentEmployer = AttorneyEmployerInformationToClient::getCurrentEmployerData(1, $client_id, $attorney_id, 1);

        $returnHTML = view('client.questionnaire.income.ajax_summary.employer_summary', ['currentEmployerData' => $currentEmployer, 'enableEdit' => true,  'formId' => 'income_step1_employer', 'debtorname' => $debtorname])->render();

        return response()->json(['status' => 1, 'msg' => "Information has been saved successfully.", 'display_id' => 'employer_page_listing_div', 'html' => $returnHTML])->header('Content-Type: application/json;', 'charset=utf-8');
    }


    public function current_employer_custom_save_spouse(Request $request)
    {

        $input = $request->all();
        $client = Auth::user();
        $client_id = $client->id;
        $attorney_id = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_income')) {
            return response()->json(['status' => 0, 'msg' => "You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen."])->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_income')) {

            $empIdToDelete = Helper::validate_key_value('empIdToDelete', $input, 'radio');
            if (isset($empIdToDelete) && $empIdToDelete > 0) {
                AttorneyEmployerInformationToClient::where('id', $empIdToDelete)->delete();
            } else {
                $currentEmployed = Helper::validate_key_value('current_employed', $input, 'radio');
                $currentEmployerData = Helper::validate_key_value('current_employer', $input) ?? [];

                if ($currentEmployed == 1 && is_array($currentEmployerData) && !empty($currentEmployerData)) {
                    $this->syncEmployerToAttorney($currentEmployerData, 2, $client_id, $attorney_id, 1);
                }
                if ($currentEmployed == 0) {
                    $this->deleteEmployerToAttorney($client_id, $attorney_id, 1, 2);
                }
            }
        }

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $BasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
        $spousename = ClientHelper::getDebtorName($BasicInfoPartB, "Co-Debtor's");

        $currentEmployer = AttorneyEmployerInformationToClient::getCurrentEmployerData(2, $client_id, $attorney_id, 1);

        $returnHTML = view('client.questionnaire.income.ajax_summary.employer_summary', ['currentEmployerData' => $currentEmployer, 'enableEdit' => true,  'formId' => 'income_step2_employer', 'debtorname' => $spousename])->render();

        return response()->json(['status' => 1, 'msg' => "Information has been saved successfully.", 'display_id' => 'employer_page_listing_div_spouse', 'html' => $returnHTML])->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function income_employer_seperate_save(Request $request)
    {
        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_income')) {
            $result = $this->employerService->handleEmployerSeparateSave($request->all(), Auth::user()->id);

            return response()->json($result);
        }

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong, try again.'
        ]);
    }

    private function syncRadioDataInEmployerTableForPreviousEmployer($client_id, $modal, $prev_emp_radio_status)
    {
        $this->employerService->syncRadioDataInEmployerTableForPreviousEmployer($client_id, $modal, $prev_emp_radio_status);
    }

    public function resetArrayIndexes($current_employer)
    {
        if (is_array($current_employer)) {
            foreach ($current_employer as $key => $subArray) {
                if (is_array($subArray)) {
                    $current_employer[$key] = array_values($subArray);
                }
            }
        }

        return $current_employer;
    }

    private function syncEmployerToAttorney($employerData, $client_type, $client_id, $attorney_id, $employer_type)
    {
        $this->employerService->syncEmployerToAttorney($employerData, $client_type, $client_id, $attorney_id, $employer_type);
    }

    private function deleteEmployerToAttorney($client_id, $attorney_id, $employer_type, $client_type)
    {
        $this->employerService->deleteEmployerToAttorney($client_id, $attorney_id, $employer_type, $client_type);
    }

    private function syncRadioDataInEmployerTable($client_id, $modal, $curr_emp_radio_status, $prev_emp_radio_status)
    {
        $this->employerService->syncRadioDataInEmployerTable($client_id, $modal, $curr_emp_radio_status, $prev_emp_radio_status);
    }

    private function checkPayStubsStatus($client_id, $type = "self")
    {
        return $this->incomeCalculationService->checkPayStubsStatus($client_id, $type);
    }
    public function client_income_step2(Request $request)
    {
        $client = Auth::user();
        $client_id = $client->id;
        if ($client->hide_questionnaire && empty($client->client_payroll_assistant)) {
            return redirect()->route('no_client_questionnaire')->with('success', 'You are Logged in successfully');
        }

        $origionalAttorneyId = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $origionalAttorneyId;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_income')) {
            return redirect()->back()->with('error', 'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.');
        }
        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_income')) {
            $input = $request->all();
            if (!empty($input)) {
                $recieved_any_income = Helper::validate_key_value('recieved_any_income', $input, 'radio');
                $previous_employer = Helper::validate_key_value('previous_employer', $input) ?? [];

                if ($recieved_any_income == 1 && is_array($previous_employer) && !empty($previous_employer)) {
                    $this->syncEmployerToAttorney($previous_employer, 2, $client_id, $origionalAttorneyId, 2);
                }

                if ($recieved_any_income == 0) {
                    $this->deleteEmployerToAttorney($client_id, $origionalAttorneyId, 2, 2);
                }

                $spouseCurrentEmployer = AttorneyEmployerInformationToClient::getCurrentEmployerData(2, $client_id, $origionalAttorneyId, 1);
                $curr_emp_radio_status = empty($spouseCurrentEmployer) ? 0 : 1;
                $modal = IncomeDebtorSpouseEmployer::class;
                $this->syncRadioDataInEmployerTable($client_id, $modal, $curr_emp_radio_status, $recieved_any_income);
            }

            Session::flash('success', 'Information has been saved successfully');

            return redirect()->route('client_income_step3')->with('redirect', true);

        }
        $redirect = false;
        if ($client->client_type == Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED && $request->isMethod('get')) { //skipping first step if option is rent on proprty tab
            $redirect = true;
        }


        $video = VideoHelper::getVideo(Helper::INCOME_DEBTOR_INCOME_VIDEO);
        $income_video = VideoHelper::getVideo(Helper::INCOME_PROFIT_LOSS_PDF_VIDEO);
        $isPendingPaystub = $this->checkPayStubsStatus($client_id);

        $steps = ['step1' => false, 'step2' => false, 'step3' => true, 'step4' => false, 'video' => $video, 'income_video' => $income_video];
        $steps['tab'] = 'tab4';
        $income = CacheIncome::getIncomeData($client_id, true);
        $docsUploadInfo = ClientHelper::documentUploadInfo();
        $progress = FormsStepsCompleted::getStepCompletionData($client_id, $client->client_type);
        $docsProgress = ClientHelper::get_uploaded_docs_progress('', $client_id, $attorney_id);
        $listOfFiles = AttorneyDocuments::getSignedDocuments($client_id, $attorney_id);
        $hasMultipleCurrentEmployer = AttorneyEmployerInformationToClient::hasMultipleCurrentEmployer($client_id, $origionalAttorneyId, 1);
        $crsReportNotCompleted = PdfToJson::getCrsReportStatus($client_id);
        $is_confirm_prompt_enabled = AttorneySettings::isConfirmPromptEnabled($attorney_id);

        // Get names data
        $dashboardService = app(\App\Services\Client\DashboardDataService::class);
        $names = $dashboardService->getDebtorNames($client_id, $client->client_type);
        $labels = $dashboardService->getUiLabels($client);

        return view('client.dashboard', $steps)->with(['is_confirm_prompt_enabled' => $is_confirm_prompt_enabled,'crsReportNotCompleted' => $crsReportNotCompleted, 'hasMultipleCurrentEmployer' => $hasMultipleCurrentEmployer, 'attProfitLossMonths' => $attProfitLossMonths, 'listOfFiles' => $listOfFiles,'isPendingPaystub' => $isPendingPaystub,'docsProgress' => $docsProgress,'progress' => $progress, 'income' => $income, 'redirect' => $redirect, 'docsUploadInfo' => $docsUploadInfo, 'progress_percentage' => ClientHelper::checkProgress(), 'names' => $names, 'labels' => $labels]);
    }

    private function buildFinalInput($input, $client_id)
    {
        return $this->incomeCalculationService->buildFinalInput($input, $client_id);
    }
    public function client_income_step3(Request $request)
    {
        $client = Auth::user();
        if ($client->hide_questionnaire && empty($client->client_payroll_assistant)) {
            return redirect()->route('no_client_questionnaire')->with('success', 'You are Logged in successfully');
        }
        $client_id = $client->id;
        $origionalAttorneyId = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $origionalAttorneyId;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_income')) {
            return redirect()->back()->with('error', 'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.');
        }
        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_income')) {
            $input = $request->all();
            unset($input['firstmonth']);
            unset($input['lastmonth']);
            unset($input['existingType']);
            unset($input['document_type']);
            unset($input['document_file']);
            if (!empty($input)) {
                unset($input['_token']);
                $final_input = $this->buildFinalInput($input, $client_id);

                if (empty(Helper::validate_key_value('recieve_overtime', $final_input))) {
                    $final_input["overtime_per_month"] = "0.00";
                }
                if (empty(Helper::validate_key_value('dso_deduction', $final_input))) {
                    $final_input["domestic_support_obligations"] = "0.00";
                }
                $part = $client->incomeDebtorMonthlyIncome;
                if (!empty($part)) {
                    unset($final_input['id']);
                    $client->incomeDebtorMonthlyIncome()->update($final_input);
                } else {
                    $client->incomeDebtorMonthlyIncome()->create($final_input);
                }
                CacheIncome::forgetIncomeCache($client_id);
                $this->incomeCalculationService->importDebtorIncomeToSofa($client_id);
            }

            if ($client->client_type == Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED) { //skipping first step if option is rent on proprty tab
                FormsStepsCompleted::updateOrCreate(["client_id" => $client_id], ['client_id' => $client_id, 'step4' => 1]);
                $route = 'client_expenses';
                if ($client->client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
                    $route = 'client_income';
                }
                if ($client->hide_questionnaire && empty($client->client_payroll_assistant)) {
                    $route = 'no_client_questionnaire';
                }

                return redirect()->route($route)->with('success', 'Information has been saved successfully');
            } else {
                return redirect()->route('client_income_step1')->with('redirect', true);
            }
        }

        $spouseisPendingPaystub = $this->checkPayStubsStatus($client_id, 'spouse');

        $video = VideoHelper::getVideo(Helper::INCOME_CO_DEBTOR_INCOME_VIDEO);
        $income_video = VideoHelper::getVideo(Helper::INCOME_SPOUSE_PROFIT_LOSS_PDF_VIDEO);

        $steps = ['step1' => false, 'step2' => false, 'step3' => false, 'step4' => true, 'video' => $video, 'income_video' => $income_video];
        $steps['tab'] = 'tab4';
        $income = CacheIncome::getIncomeData($client_id, true);
        $docsUploadInfo = ClientHelper::documentUploadInfo();
        $progress = FormsStepsCompleted::getStepCompletionData($client_id, $client->client_type);
        $docsProgress = ClientHelper::get_uploaded_docs_progress('', $client_id, $attorney_id);
        $listOfFiles = AttorneyDocuments::getSignedDocuments($client_id, $attorney_id);
        $hasMultipleCurrentEmployer = AttorneyEmployerInformationToClient::hasMultipleCurrentEmployer($client_id, $origionalAttorneyId, 2);
        $crsReportNotCompleted = PdfToJson::getCrsReportStatus($client_id);
        $is_confirm_prompt_enabled = AttorneySettings::isConfirmPromptEnabled($attorney_id);

        // Get names data
        $dashboardService = app(\App\Services\Client\DashboardDataService::class);
        $names = $dashboardService->getDebtorNames($client_id, $client->client_type);
        $labels = $dashboardService->getUiLabels($client);

        return view('client.dashboard', $steps)->with(['is_confirm_prompt_enabled' => $is_confirm_prompt_enabled,'crsReportNotCompleted' => $crsReportNotCompleted, 'hasMultipleCurrentEmployer' => $hasMultipleCurrentEmployer,'attProfitLossMonths' => $attProfitLossMonths,'listOfFiles' => $listOfFiles, 'spouseisPendingPaystub' => $spouseisPendingPaystub,'docsProgress' => $docsProgress,'progress' => $progress, 'income' => $income, 'docsUploadInfo' => $docsUploadInfo, 'progress_percentage' => ClientHelper::checkProgress(), 'names' => $names, 'labels' => $labels ]);
    }
    public function client_income_step4(Request $request)
    {

        $client = Auth::user();
        $client_id = $client->id;
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_income')) {
            return redirect()->back()->with('error', 'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.');
        }
        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_income')) {
            $input = $request->all();
            unset($input['firstmonth_joint']);
            unset($input['lastmonth_joint']);
            unset($input['existingType_joint']);
            unset($input['document_type']);
            unset($input['document_file']);
            if (!empty($input)) {
                unset($input['_token']);

                $final_input = $this->buildFinalInput($input, $client_id);

                if (empty(Helper::validate_key_value('joints_recieve_overtime', $final_input))) {
                    $final_input["joints_overtime_per_month"] = "0.00";
                }
                if (empty(Helper::validate_key_value('joints_dso_deduction', $final_input))) {
                    $final_input["joints_domestic_support_obligations"] = "0.00";
                }

                $part = $client->incomeDebtorSpouseMonthlyIncome;
                if (!empty($part)) {
                    $client->incomeDebtorSpouseMonthlyIncome()->update($final_input);
                } else {
                    $client->incomeDebtorSpouseMonthlyIncome()->create($final_input);
                }
                CacheIncome::forgetIncomeCache($client_id);
                $this->incomeCalculationService->importSpouseIncomeToSofa($client_id);
            }
        }
        FormsStepsCompleted::updateOrCreate(["client_id" => $client_id], ['client_id' => $client_id, 'step4' => 1]);
        $route = 'client_expenses';
        if ($client->client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            $route = 'client_income';
        }
        if ($client->hide_questionnaire && empty($client->client_payroll_assistant)) {
            $route = 'no_client_questionnaire';
        }

        return redirect()->route($route)->with('success', 'Information has been saved successfully');
    }

    public function getisImportedStatusByMonth($client_id, $type, $forMonth = "")
    {
        return $this->incomeCalculationService->getImportedStatusByMonth($client_id, $type, $forMonth);
    }

    public function paystub_delete_client_side(Request $request)
    {
        if ($request->isMethod('post')) {
            $result = $this->paystubService->deletePaystubClientSide($request->all());

            return response()->json($result)->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

}
