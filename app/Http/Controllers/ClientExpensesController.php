<?php

namespace App\Http\Controllers;

use App\Services\Client\ExpenseManagementService;
use App\Services\Client\ExpenseUtilityService;
use App\Helpers\ClientHelper;
use Illuminate\Support\Facades\Auth;
use App\Helpers\VideoHelper;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\FormsStepsCompleted;
use Illuminate\Support\Facades\Session;
use App\Repositories\MeanTestSettingRepository;
use App\Models\AttorneyDocuments;
use App\Models\AttorneySettings;
use App\Models\ClientsAttorney;
use App\Models\PdfToJson;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheExpense;

class ClientExpensesController extends Controller
{
    protected ExpenseManagementService $expenseManagementService;
    protected ExpenseUtilityService $expenseUtilityService;

    public function __construct(
        ExpenseManagementService $expenseManagementService,
        ExpenseUtilityService $expenseUtilityService
    ) {
        $this->expenseManagementService = $expenseManagementService;
        $this->expenseUtilityService = $expenseUtilityService;
    }

    public function client_expenses(Request $request)
    {
        if (Auth::user()->client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            return redirect()->route('client_income')->with('success', 'You are Logged in successfully');
        }
        if (Auth::user()->hide_questionnaire && empty(Auth::user()->client_payroll_assistant)) {
            return redirect()->route('no_client_questionnaire')->with('success', 'You are Logged in successfully');
        }
        $clientId = Auth::user()->id;
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_expenase')) {
            return redirect()->back()->with('error', 'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.');
        }
        if ($request->isMethod('post')) {
            $input = $request->all();
            unset($input['_token']);
            if (Helper::isTabEditable('can_edit_expenase')) {
                $this->expenseManagementService->setupExpense($input, $clientId);
            }

            if (isset($input['live_separately']) && $input['live_separately'] == 1) {
                return redirect()->route('client_spouse_expenses')->with('success', 'Information has been saved successfully');
            } else {
                FormsStepsCompleted::updateOrCreate(["client_id" => $clientId], ["client_id" => $clientId,'step5' => 1]);

                return redirect()->route('client_financial_affairs')->with('success', 'Information has been saved successfully');
            }
        }
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[Helper::EXPENSE_DEBTOR_VIDEO] ?? [];
        $video = VideoHelper::getVideos($tutorial);
        $steps = ['step1' => true, 'step2' => false, 'step3' => false, 'step4' => false, 'video' => $video];
        $steps['tab'] = 'tab5';
        $finalExpenses = CacheExpense::getExpenseData($clientId, false, true);
        $rentedFlag = $this->expenseManagementService->getRentalFlag($clientId);
        $docsUploadInfo = ClientHelper::documentUploadInfo();
        $progress = FormsStepsCompleted::getStepCompletionData($clientId, Auth::user()->client_type);
        //Session::flash('success', 'Information has been saved successfully');
        $averagePriceList = app(MeanTestSettingRepository::class)->getFoodClothing();

        $attorney = ClientsAttorney::where("client_id", $clientId)->first();
        $attorneyId = $attorney->attorney_id;
        $docsProgress = ClientHelper::get_uploaded_docs_progress('', $clientId, $attorneyId);

        $detailedProperty = \App\Models\User::where("id", $clientId)->get('detailed_property')->first();
        $listOfFiles = AttorneyDocuments::getSignedDocuments($clientId, $attorneyId);
        $crsReportNotCompleted = PdfToJson::getCrsReportStatus($clientId);
        $isConfirmPromptEnabled = AttorneySettings::isConfirmPromptEnabled($attorneyId);

        return view('client.dashboard', $steps)->with(['is_confirm_prompt_enabled' => $isConfirmPromptEnabled,'crsReportNotCompleted' => $crsReportNotCompleted, 'listOfFiles' => $listOfFiles,'detailed_property' => $detailedProperty['detailed_property'],'progress' => $progress, 'docsProgress' => $docsProgress, 'expenses' => $finalExpenses, 'client_type' => Auth::user()->client_type, 'averagePriceList' => $averagePriceList, 'docsUploadInfo' => $docsUploadInfo, 'progress_percentage' => ClientHelper::checkProgress() ])->with('rented_flag', $rentedFlag);
    }

    public function client_spouse_expenses(Request $request)
    {
        if (Auth::user()->client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            return redirect()->route('client_income')->with('success', 'You are Logged in successfully');
        }
        if (Auth::user()->hide_questionnaire && empty(Auth::user()->client_payroll_assistant)) {
            return redirect()->route('no_client_questionnaire')->with('success', 'You are Logged in successfully');
        }
        $clientId = Auth::user()->id;
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_expenase')) {
            return redirect()->back()->with('error', 'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.');
        }
        if ($request->isMethod('post')) {
            $input = $request->all();
            if (Helper::isTabEditable('can_edit_expenase')) {
                $this->expenseManagementService->createOrUpdateSpouseExpense($clientId, $input);
            }

            return redirect()->route('client_financial_affairs')->with('success', 'Information has been saved successfully');
        }
        $BIData = CacheBasicInfo::getBasicInformationData($clientId);
        $spouseDifferentAddress = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
        $spouseDifferentAddress = !empty($spouseDifferentAddress) ? $spouseDifferentAddress->toArray() : [];
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[Helper::EXPENSE_CO_DEBTOR_VIDEO] ?? [];
        $video = VideoHelper::getVideos($tutorial);
        $steps = ['step1' => true, 'step2' => false, 'step3' => false, 'step4' => false, 'video' => $video];
        $steps['tab'] = 'tab7';
        $finalExpenses = CacheExpense::getExpenseData($clientId, true);
        $rentedFlag = $this->expenseManagementService->getRentalFlag($clientId);
        $docsUploadInfo = ClientHelper::documentUploadInfo();
        $progress = FormsStepsCompleted::getStepCompletionData($clientId, Auth::user()->client_type);
        Session::flash('success', 'Information has been saved successfully');
        $averagePriceList = app(MeanTestSettingRepository::class)->getFoodClothing();
        $attorney = ClientsAttorney::where("client_id", $clientId)->first();
        $attorneyId = $attorney->attorney_id;
        $docsProgress = ClientHelper::get_uploaded_docs_progress('', $clientId, $attorney->attorney_id);
        $detailedProperty = \App\Models\User::where("id", $clientId)->get('detailed_property')->first();
        $listOfFiles = AttorneyDocuments::getSignedDocuments($clientId, $attorneyId);
        $crsReportNotCompleted = PdfToJson::getCrsReportStatus($clientId);
        $isconfirmPromptEnabled = AttorneySettings::isConfirmPromptEnabled($attorneyId);

        return view('client.dashboard', $steps)->with(['is_confirm_prompt_enabled' => $isconfirmPromptEnabled, 'crsReportNotCompleted' => $crsReportNotCompleted,'listOfFiles' => $listOfFiles,'detailed_property' => $detailedProperty['detailed_property'],'progress' => $progress,'docsProgress' => $docsProgress, 'client_type' => Auth::user()->client_type,'averagePriceList' => $averagePriceList, 'expenses' => $finalExpenses, 'spouse_different_address' => $spouseDifferentAddress,'docsUploadInfo' => $docsUploadInfo, 'progress_percentage' => ClientHelper::checkProgress() ])->with('rented_flag', $rentedFlag);
    }

    // utiltity popup data
    public function expense_utility_popup(Request $request)
    {
        $input = $request->all();
        $result = $this->expenseUtilityService->handleUtilityPopup($input);

        return response()->json($result);
    }
}
