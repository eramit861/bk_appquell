<?php

namespace App\Http\Controllers\Client;

use App\Helpers\ClientHelper;
use App\Http\Controllers\Controller;
use App\Models\ClientsPropertyFinancialAssets;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\FormsStepsCompleted;
use App\Models\ZipCode;
use Illuminate\Support\Facades\Mail;
use App\Models\AttorneySubscription;
use App\Mail\ClientFirstLogin;
use App\Models\EditQuestionnaire\QuestionnaireBasicInfoPartB;
use App\Models\EditQuestionnaire\QuestionnaireBasicInfoPartC;
use App\Helpers\VideoHelper;
use App\Models\AttorneyDocuments;
use App\Models\AttorneySettings;
use App\Models\ClientsAssociate;
use App\Models\ParalegalSettings;
use App\Models\PdfToJson;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheSOFA;
use App\Services\Client\DashboardDataService;
use App\Services\Questionnaire\QuestionnaireBasicInfoPartA;
use App\Services\Client\ClientBasicInfoBusinessService;
use App\Traits\Common;

class ClientBasicInfoController extends Controller
{
    use Common;

    /**
     * Display main dashboard for client
     * Shows basic information form and progress tracking
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function basic_information()
    {
        $user = Auth::user();
        $clientId = $user->id;

        // Handle redirects based on subscription
        if ($user->client_subscription == AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            return redirect()->route('client_income')->with('success', 'You are Logged in successfully');
        }

        if ($user->hide_questionnaire && empty($user->client_payroll_assistant)) {
            return redirect()->route('no_client_questionnaire')->with('success', 'You are Logged in successfully');
        }

        // Check attorney status
        $businessService = app(ClientBasicInfoBusinessService::class);
        $attorney = $businessService->getAttorneyData($clientId);
        if (!$attorney || empty($attorney->attorney_id)) {
            Auth::logout();

            return redirect()->route('client_login')->with('error', "Your attorney's account is no more with us, please contact your attorney.");
        }

        $attorneyId = $attorney->attorney_id;

        // Handle first login - reuse $businessService instead of creating new instance
        if ($user->logged_in_ever == 0) {
            $businessService->handleFirstLogin($user, $attorney);
        }

        // Prepare view data
        $steps = $this->prepareStepsData($attorneyId);
        $progress = $this->getProgressParameters($clientId);
        $commonData = $this->getCommonViewData($clientId, $attorneyId);

        // Get names data - removed leading backslash for consistency
        $dashboardService = app(DashboardDataService::class);
        $names = $dashboardService->getDebtorNames($clientId, $user->client_type);
        $labels = $dashboardService->getUiLabels($user);

        // Prepare complete view data array
        $viewData = array_merge($steps, [
            'progress' => $progress['progress'],
            'listOfFiles' => $commonData['listOfFiles'],
            'traded_stocks' => [], // Empty array maintained for backward compatibility with view
            'docsProgress' => $commonData['docsProgress'],
            'info' => $commonData['info'],
            'client_with_payments' => true, // Hard-coded for backward compatibility with view
            'district_names' => $progress['district_names'],
            'docsUploadInfo' => $progress['docsUploadInfo'],
            'userJustLogin' => Session::get('userJustLogin'),
            'progress_percentage' => ClientHelper::checkProgress(),
            'finacial_affairs' => CacheSOFA::getSOFAData($clientId),
            'crsReportNotCompleted' => $commonData['crsReportNotCompleted'],
            'names' => $names,
            'labels' => $labels,
        ]);

        return view('client.dashboard', $viewData);
    }

    /**
     * Prepare steps data for navigation
     *
     * @param int $attorneyId
     * @return array
     */
    protected function prepareStepsData(int $attorneyId): array
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[Helper::BASIC_INFO_STEP1_VIDEO] ?? [];
        $video = VideoHelper::getVideos($tutorial);
        $isConfirmPromptEnabled = AttorneySettings::isConfirmPromptEnabled($attorneyId);

        return [
            'step1' => true,
            'step2' => false,
            'step3' => false,
            'step4' => false,
            'step5' => false,
            'step6' => false,
            'video' => $video,
            'tab' => 'tab1',
            'is_confirm_prompt_enabled' => $isConfirmPromptEnabled
        ];
    }

    /**
     * Handle basic information step 1 (Personal Information)
     * Saves client basic info and determines next step based on marital status
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function basic_info_step1(Request $request)
    {
        $clientId = Auth::id();
        $user = Auth::user();
        $businessService = app(ClientBasicInfoBusinessService::class);
        $attorney = $businessService->getAttorneyData($clientId);
        $attorneyId = $attorney->attorney_id ?? null;

        // Handle POST request
        if ($request->isMethod('post')) {
            if (!Helper::isTabEditable('can_edit_basic_info')) {
                return redirect()->back()->with(
                    'error',
                    'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.'
                );
            }

            $questionnaire = new QuestionnaireBasicInfoPartA();
            $questionnaire->saveStep1($clientId, $request, false, $attorneyId);
        }

        // Prepare step data - reuse $businessService instead of creating new instance
        $biData = $businessService->getBasicInfoData($clientId);
        $part1Info = Helper::validate_key_value('BasicInfoPartA', $biData, 'array');
        $isJointMarried = $user->client_type == Helper::CLIENT_TYPE_JOINT_MARRIED;
        $steps = [
            'step1' => false,
            'step2' => $isJointMarried,
            'step3' => !$isJointMarried,
            'step4' => false,
            'step5' => false,
            'step6' => false,
            'tab' => 'tab1'
        ];

        // Get appropriate tutorial video
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $isJointMarried
            ? ($videos[Helper::BASIC_INFO_STEP2_VIDEO] ?? [])
            : ($videos[Helper::BASIC_INFO_STEP3_VIDEO] ?? []);

        $steps['video'] = VideoHelper::getVideos($tutorial);

        // Determine redirect based on marital status
        $currentStep = $request->segment(3);
        $redirect = (!empty($part1Info->marital_status) && in_array($part1Info->marital_status, ['1', '5']))
            || (!empty($currentStep) && $currentStep == "step1");

        // Prepare view data
        $progress = $this->getProgressParameters($clientId);
        $commonData = $this->getCommonViewData($clientId, $attorneyId);
        Session::flash('success', 'Information has been saved successfully');
        $isConfirmPromptEnabled = AttorneySettings::isConfirmPromptEnabled($attorneyId);

        // Get names data - removed leading backslash for consistency
        $dashboardService = app(DashboardDataService::class);
        $names = $dashboardService->getDebtorNames($clientId, $user->client_type);
        $labels = $dashboardService->getUiLabels($user);

        // Prepare complete view data array
        $viewData = array_merge($steps, [
            'finacial_affairs' => [], // Empty array maintained for backward compatibility
            'traded_stocks' => [], // Empty array maintained for backward compatibility
            'listOfFiles' => $commonData['listOfFiles'],
            'docsProgress' => $commonData['docsProgress'],
            'progress' => $progress['progress'],
            'info' => $commonData['info'],
            'district_names' => $progress['district_names'],
            'docsUploadInfo' => $progress['docsUploadInfo'],
            'progress_percentage' => ClientHelper::checkProgress(),
            'redirect' => $redirect,
            'crsReportNotCompleted' => $commonData['crsReportNotCompleted'],
            'is_confirm_prompt_enabled' => $isConfirmPromptEnabled,
            'names' => $names,
            'labels' => $labels,
        ]);

        return view('client.dashboard', $viewData);
    }

    /**
     * Handle basic information step 2 (Spouse Information)
     * Saves spouse basic info for joint married filing
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function basic_info_step2(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;
        
        // CRITICAL FIX: Create business service ONCE, not twice (was duplicated on line 225)
        $businessService = app(ClientBasicInfoBusinessService::class);
        $biData = $businessService->getBasicInfoData($clientId);
        $part1Info = Helper::validate_key_value('BasicInfoPartA', $biData, 'array');
        $attorney = $businessService->getAttorneyData($clientId);
        $attorneyId = $attorney->attorney_id ?? null;

        // Handle POST request
        if ($request->isMethod('post')) {
            if (!Helper::isTabEditable('can_edit_basic_info')) {
                return redirect()->back()->with(
                    'error',
                    'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.'
                );
            }

            QuestionnaireBasicInfoPartB::saveStep2($clientId, $request, false, $attorneyId);
            Session::flash('success', 'Information has been saved successfully');
        }

        // Determine if redirect is needed
        $currentStep = $request->segment(3);
        $redirect = !empty($part1Info->marital_status) &&
                    in_array($part1Info->marital_status, ['1', '5']) &&
                    $currentStep != "step2";
        $isConfirmPromptEnabled = AttorneySettings::isConfirmPromptEnabled($attorneyId);
        $commonData = $this->getCommonViewData($clientId, $attorneyId);

        // Get names data - removed leading backslash for consistency
        $dashboardService = app(DashboardDataService::class);
        $names = $dashboardService->getDebtorNames($clientId, $user->client_type);
        $labels = $dashboardService->getUiLabels($user);

        // IMPORTANT FIX: Use optimized getProgressParameters() method instead of raw query
        $progress = $this->getProgressParameters($clientId);

        // Prepare view data
        $viewData = [
            'finacial_affairs' => [], // Empty array maintained for backward compatibility
            'traded_stocks' => [], // Empty array maintained for backward compatibility
            'listOfFiles' => $commonData['listOfFiles'],
            'progress' => FormsStepsCompleted::getStepCompletionData($clientId, $user->client_type),
            'docsProgress' => $commonData['docsProgress'],
            'info' => $commonData['info'],
            'district_names' => $progress['district_names'],
            'docsUploadInfo' => $progress['docsUploadInfo'],
            'progress_percentage' => ClientHelper::checkProgress(),
            'redirect' => $redirect,
            'crsReportNotCompleted' => $commonData['crsReportNotCompleted'],
            'is_confirm_prompt_enabled' => $isConfirmPromptEnabled,
            'names' => $names,
            'labels' => $labels,
        ];

        // Prepare steps data
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[Helper::BASIC_INFO_STEP3_VIDEO] ?? [];

        $steps = [
            'step1' => false,
            'step2' => false,
            'step3' => true,
            'step4' => false,
            'step5' => false,
            'step6' => false,
            'video' => VideoHelper::getVideos($tutorial),
            'tab' => 'tab1'
        ];

        return view('client.dashboard', $steps)->with($viewData);
    }

    /**
     * Handle basic information step 3 (Additional Information)
     * Saves additional client information and marks step 1 as complete
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function basic_info_step3(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;
        $businessService = app(ClientBasicInfoBusinessService::class);
        $attorney = $businessService->getAttorneyData($clientId);
        $attorneyId = $attorney->attorney_id;

        // Handle POST requests
        if ($request->isMethod('post')) {
            if (!Helper::isTabEditable('can_edit_basic_info')) {
                return redirect()->back()->with(
                    'error',
                    'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.'
                );
            }

            QuestionnaireBasicInfoPartC::saveStep3($clientId, $request, false, $attorneyId);
            FormsStepsCompleted::updateOrCreate(['client_id' => $clientId], ['client_id' => $clientId, 'step1' => 1]);

            return redirect()->route('property_information')->with('success', 'Information saved successfully');
        }

        // Handle GET requests
        $video = VideoHelper::getVideos(
            VideoHelper::getAdminVideos()[Helper::BASIC_INFO_STEP4_VIDEO] ?? []
        );

        $steps = [
            'step1' => false,
            'step2' => false,
            'step3' => false,
            'step4' => true,
            'step5' => false,
            'step6' => false,
            'video' => $video,
            'tab' => 'tab1'
        ];

        $progress = $this->getProgressParameters($clientId);
        $tradedStocks = ClientsPropertyFinancialAssets::getTradedStocksData($clientId);
        $commonData = $this->getCommonViewData($clientId, $attorneyId);

        return view('client.dashboard', $steps)->with([
            'finacial_affairs' => [], // Empty array maintained for backward compatibility
            'traded_stocks' => $tradedStocks,
            'listOfFiles' => $commonData['listOfFiles'],
            'progress' => $progress['progress'],
            'docsProgress' => $commonData['docsProgress'],
            'info' => $commonData['info'],
            'district_names' => $progress['district_names'],
            'docsUploadInfo' => $progress['docsUploadInfo'],
            'progress_percentage' => ClientHelper::checkProgress(),
            'crsReportNotCompleted' => $commonData['crsReportNotCompleted']
        ]);
    }

    /**
     * Update business names to income
     * NOTE: Method name has typo "Bussiness" (should be "Business") but kept for backward compatibility
     *
     * @param int $clientId
     * @param array $data
     * @return void
     */
    public function updateBussinessNamesToIncome(int $clientId, array $data): void
    {
        $businessService = app(ClientBasicInfoBusinessService::class);
        $businessService->updateBusinessNamesToIncome($clientId, $data);
    }

    /**
     * Handle basic information step 5 (Business Information)
     * Saves sole proprietor and business status information
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function basic_info_step5(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;

        if (Helper::isTabEditable('can_edit_basic_info')) {
            $this->saveBusinessInformation($user, $clientId, $request->all());
        }

        // Prepare view data
        $video = VideoHelper::getVideos(
            VideoHelper::getAdminVideos()[Helper::BASIC_INFO_STEP5_VIDEO] ?? []
        );

        $businessService = app(ClientBasicInfoBusinessService::class);
        $attorney = $businessService->getAttorneyData($clientId);
        $progress = $this->getProgressParameters($clientId);
        Session::flash('success', 'Information has been saved successfully');
        $commonData = $this->getCommonViewData($clientId, $attorney->attorney_id);

        return view('client.dashboard', [
            'step1' => false,
            'step2' => false,
            'step3' => false,
            'step4' => false,
            'step5' => false,
            'step6' => true,
            'video' => $video,
            'tab' => 'tab1',
        ])->with([
            'progress' => $progress['progress'],
            'traded_stocks' => [], // Empty array maintained for backward compatibility
            'listOfFiles' => $commonData['listOfFiles'],
            'docsProgress' => $commonData['docsProgress'],
            'info' => $commonData['info'],
            'district_names' => $progress['district_names'],
            'docsUploadInfo' => $progress['docsUploadInfo'],
            'progress_percentage' => ClientHelper::checkProgress(),
            'crsReportNotCompleted' => $commonData['crsReportNotCompleted'],
        ]);
    }

    /**
     * Handle basic information step 6 (Final Business Information)
     * Saves business information and redirects to property information
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function basic_info_step6(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;

        if (Helper::isTabEditable('can_edit_basic_info')) {
            $this->saveBusinessInformation($user, $clientId, $request->all());
        }

        FormsStepsCompleted::updateOrCreate(
            ['client_id' => $clientId],
            ['client_id' => $clientId, 'step1' => 1]
        );

        return redirect()->route('property_information')->withSuccess('Information has been saved successfully');
    }



    /**
     * Get common view data - eliminates duplication across 5+ methods
     *
     * @param int $clientId
     * @param int $attorneyId
     * @return array
     */
    private function getCommonViewData(int $clientId, int $attorneyId): array
    {
        return [
            'docsProgress' => ClientHelper::get_uploaded_docs_progress('', $clientId, $attorneyId),
            'listOfFiles' => AttorneyDocuments::getSignedDocuments($clientId, $attorneyId),
            'crsReportNotCompleted' => PdfToJson::getCrsReportStatus($clientId),
            'info' => CacheBasicInfo::getBasicInformationData($clientId, true, false),
        ];
    }


    /**
     * Get progress parameters including district names and document upload info
     * Fixed typo: was getPropgressParameters
     *
     * @param int $clientId
     * @return array
     */
    private function getProgressParameters(int $clientId): array
    {
        $client = User::find($clientId);

        // Get all zip codes and use collection methods for better performance
        // This replicates: groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)
        $districtNames = ZipCode::all()
            ->where('short_name', '!=', null)
            ->sortBy('short_name') // Order by short_name first
            ->groupBy('district_name')
            ->map(function ($group) {
                return $group->first(); // Get first record from each group (like SQL groupBy)
            })
            ->values();

        $docsUploadInfo = ClientHelper::documentUploadInfo($client, $clientId, 0, true);
        $progress = FormsStepsCompleted::getStepCompletionData($clientId, $client->client_type);

        return [
            'district_names' => $districtNames,
            'docsUploadInfo' => $docsUploadInfo,
            'progress' => $progress
        ];
    }


    /**
     * Display client progress tracking page
     * Shows overall questionnaire completion status
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_progress()
    {
        $client = Auth::user();
        $clientId = $client->id;

        // Check attorney status
        $businessService = app(ClientBasicInfoBusinessService::class);
        $attorney = $businessService->getAttorneyData($clientId);
        if (empty($attorney?->attorney_id)) {
            Auth::logout();

            return redirect()->route('client_login')
                   ->with('error', "Your attorney's account is no more with us, please contact your attorney.");
        }

        // Handle first login - reuse $businessService instead of creating new instance
        if ($client->logged_in_ever == 0) {
            $businessService->handleFirstLogin($client, $attorney);
        }

        // Handle special subscription cases
        if ($client->client_subscription == AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            return redirect()->route('client_income')->with('success', 'You are Logged in successfully');
        }

        if ($client->hide_questionnaire && empty($client->client_payroll_assistant)) {
            return redirect()->route('no_client_questionnaire')->with('success', 'You are Logged in successfully');
        }

        // Prepare view data
        $viewData = $this->prepareProgressViewData($clientId, $attorney);

        return view('client.trackProgress', $viewData);
    }

    /**
     * Handle first login tasks for client
     * Sends notification email to attorney
     *
     * @param User $client
     * @param object $attorney
     * @return void
     */
    protected function handleFirstLogin(User $client, $attorney): void
    {
        $client->update(['logged_in_ever' => 1, 'recommned_password_update' => 0]);

        try {
            $clientParalegal = \App\Models\ClientParalegal::where('client_id', $client->id)->first();
            $attorneyData = User::find($clientParalegal ? $clientParalegal->paralegal_id : $attorney->attorney_id);

            if (AttorneySettings::isEmailEnabled($attorney->attorney_id, 'attorney_client_first_login_mail')) {
                $mail = Helper::getAttorneyEmailArray($attorneyData->id);
                $sendTo = ParalegalSettings::getMailSendToId(
                    $client->id,
                    $mail,
                    !empty($client->parent_attorney_id)
                );

                Mail::to($sendTo)->send(new ClientFirstLogin($client, $attorneyData->name));
            }
        } catch (\Exception $e) {
            // Log the exception if needed - silent fail for email issues
        }
    }

    /**
     * Prepare view data for progress tracking page
     *
     * @param int $clientId
     * @param object $attorney
     * @return array
     */
    protected function prepareProgressViewData(int $clientId, $attorney): array
    {
        // Basic steps and video
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[Helper::BASIC_INFO_STEP1_VIDEO] ?? [];
        $video = VideoHelper::getVideos($tutorial);

        $steps = [
            'step1' => false,
            'step2' => false,
            'step3' => false,
            'step4' => false,
            'step5' => false,
            'step6' => false,
            'video' => $video,
            'tab' => 'progress'
        ];

        // Get progress data
        $progress = $this->getProgressParameters($clientId);
        $commonData = $this->getCommonViewData($clientId, $attorney->attorney_id);

        // Attorney settings
        $clientsAssociateId = ClientsAssociate::getAssociateId($clientId);
        $settingsAttorneyId = $clientsAssociateId ?: $attorney->attorney_id;
        $isAssociate = !empty($clientsAssociateId) ? 1 : 0;

        $attorneySettings = AttorneySettings::where([
                'attorney_id' => $settingsAttorneyId,
                'is_associate' => $isAssociate
            ])
            ->select(['bank_statement_months', 'attorney_enabled_bank_statment'])
            ->first();

        $bankStatementMonths = $attorneySettings ? Helper::validate_key_value('bank_statement_months', $attorneySettings) : '';
        $attorneyEnabledBankStatement = $attorneySettings
            ? Helper::validate_key_value('attorney_enabled_bank_statment', $attorneySettings, 'radio')
            : 0;

        return array_merge($steps, [
            'progress' => $progress['progress'],
            'info' => $commonData['info'],
            'client_with_payments' => true, // Hard-coded for backward compatibility
            'district_names' => $progress['district_names'],
            'docsUploadInfo' => $progress['docsUploadInfo'],
            'userJustLogin' => Session::get('userJustLogin'),
            'progress_percentage' => ClientHelper::checkProgress(),
            'finacial_affairs' => CacheSOFA::getSOFAData($clientId),
            'docsProgress' => $commonData['docsProgress'],
            'concierge_service' => User::find($clientId)?->concierge_service,
            'bank_statement_months' => $bankStatementMonths,
            'isBankStatementEnabled' => ($attorneyEnabledBankStatement == 1)
        ]);
    }

    /**
     * Save business information for steps 5 and 6
     * Extracted to eliminate code duplication
     *
     * @param User $user
     * @param int $clientId
     * @param array $input
     * @return void
     */
    private function saveBusinessInformation(User $user, int $clientId, array $input): void
    {
        $part5 = [
            'sole_proprietor' => (int)!empty($input['part_rest']['sole_proprietor']),
            'proprietor_status' => (int)!empty($input['part_rest']['proprietor_status']),
            'any_proprietor_status_data' => !empty($input['part_rest']['any_proprietor_status_data']) &&
                                        !empty($input['part_rest']['proprietor_status'])
                ? json_encode($input['part_rest']['any_proprietor_status_data'])
                : "",
            'status' => 1
        ];

        $user->clientBasicInfoPartRest()->updateOrCreate([], $part5);
        // Clear cache for client basic information
        CacheBasicInfo::forgetBasicInformationCache($clientId);
    }

}
