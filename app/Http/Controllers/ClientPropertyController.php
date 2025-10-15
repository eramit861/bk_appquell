<?php

namespace App\Http\Controllers;

use App\Helpers\ClientHelper;
use App\Services\Client\CacheProperty;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Helpers\UtilityHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\FormsStepsCompleted;
use Illuminate\Support\Facades\DB;
use App\Models\EditQuestionnaire\QuestionnairePropertyHousehold;
use App\Traits\Common; // Trait
use App\Models\AttorneyDocuments;
use App\Models\AttorneySettings;
use App\Models\ClientsAssociate;
use App\Models\ClientsPropertyFinancialAssets;
use App\Models\TblPropertyDetailApiRequest;
use App\Models\Creditors;
use App\Models\PdfToJson;
use App\Models\TemplateDetailedProperty;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheSOFA;
use App\Services\Client\PropertyDataService;
use App\Services\Client\DashboardDataService;
use App\Models\SignedDocuments;
use App\Models\MasterCardTransactions;
use App\Models\User as UserModel;
use App\Models\ClientsAttorney;
use App\Helpers\VideoHelper;
use Illuminate\Support\Facades\Log;

class ClientPropertyController extends Controller
{
    use Common;

    protected PropertyDataService $propertyDataService;

    /**
     * Schedule A/B form line numbers for different property types
     * Used for mapping property categories to bankruptcy form line numbers
     */
    public const AB_FORM_LINE_NUMBERS = [
        'resident_property' => 1,
        'vehicle_property' => 3,
        'household_property' => 6,
        'financial_assets' => 29,
        'financial_assets_continue' => 16,
        'business_related_assets' => 37,
        'farm_and_commercial_fishing_related_property' => 46,
        'miscellaneous' => 53
    ];

    /**
     * GraphQL query for vehicle VIN decoding
     * Extracted to constant to reduce method length
     */
    private const VEHICLE_VIN_GRAPHQL_QUERY = <<<'GRAPHQL'
        query DecodeVin($vin: String!, $mileage: Int!) {
            decodeVin(vin: $vin, mileage: $mileage) {
                decodedFields {
                    VariableId
                    VariableName
                    Value
                    ValueId
                }
                vehicleValue {
                    vin
                    success
                    id
                    vehicle
                    mean
                    stdev
                    count
                    mileage
                    certainty
                    period
                    prices {
                        average
                        below
                        above
                        distribution {
                            group {
                                min
                                max
                                count
                            }
                        }
                    }
                }
            }
        }
        GRAPHQL;

    /**
     * Constructor - inject PropertyDataService dependency
     *
     * @param PropertyDataService $propertyDataService
     */
    public function __construct(PropertyDataService $propertyDataService)
    {
        $this->propertyDataService = $propertyDataService;
    }

    /**
     * Display property information dashboard
     * Main landing page for property section of questionnaire
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function property_information()
    {
        $user = Auth::user();
        $clientId = $user->id;

        // Check redirects using service
        if ($redirectRoute = $this->propertyDataService->checkSubscriptionRedirects($user)) {
            return redirect()->route($redirectRoute)->with('success', 'Logged in successfully');
        }

        // Get attorney data using service
        $attorney = $this->propertyDataService->getAttorneyData($clientId);
        $attorneyId = $attorney ? $attorney->attorney_id : null;

        // Get common data using service
        $commonData = $this->propertyDataService->getCommonViewData($clientId, $attorneyId, $user);

        // Generate steps data using service
        $steps = $this->propertyDataService->generateStepsArray(1, Helper::PROPERTY_DASHBOARD_VIDEO);

        // Get property data using service
        $resident = $this->propertyDataService->getPropertyData($clientId, true, false);
        $resident['detailed_property'] = $user->detailed_property;

        // Get additional data
        $signedDocuments = SignedDocuments::where("client_id", $clientId)->value('is_sent') ?? false;
        $biData = CacheBasicInfo::getBasicInformationData($clientId);
        $basicInfoPartRest = Helper::validate_key_value('BasicInfo_PartRest', $biData, 'array');

        // Get names data - removed leading backslash for consistency
        $dashboardService = app(DashboardDataService::class);
        $names = $dashboardService->getDebtorNames($clientId, $user->client_type);
        $labels = $dashboardService->getUiLabels($user);

        return view('client.dashboard', $steps)->with([
            'signeddocuments' => (bool)$signedDocuments,
            'listOfFiles' => $commonData['listOfFiles'],
            'appservice_codebtors' => $commonData['codebtors'],
            'finacial_affairs' => $commonData['financialAffairs'],
            'mortageloanData' => [], // Empty array maintained for backward compatibility with view
            'BasicInfo_PartRest' => $basicInfoPartRest,
            'progress' => $commonData['progress'],
            'docsProgress' => $commonData['docsProgress'],
            'resident' => $resident,
            'docsUploadInfo' => $commonData['docsUploadInfo'],
            'progress_percentage' => $commonData['progress_percentage'],
            'crsReportNotCompleted' => $commonData['crsReportNotCompleted'],
            'names' => $names,
            'labels' => $labels,
        ]);
    }

    /**
     * Update property step 1 via AJAX
     * Handles adding/updating residence properties
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_property_step1_ajax(Request $request)
    {
        // Check permission using service
        if ($error = $this->propertyDataService->checkEditPermission($request)) {
            return response()->json($error, 200);
        }

        $user = Auth::user();
        $clientId = $user->id;

        // Get attorney with validation using service
        $attorneyResult = $this->propertyDataService->getAttorneyWithValidation($clientId);
        if (isset($attorneyResult['error'])) {
            return response()->json(['status' => 0, 'msg' => $attorneyResult['error']], 404);
        }

        // Update property data using service
        $this->propertyDataService->updatePropertyStep1($request, $clientId, $attorneyResult['attorneyId']);
        $this->propertyDataService->clearPropertyCache($clientId);

        // Prepare response data using service
        $property = $this->propertyDataService->getPropertyData($clientId, true, false);
        $propertyResident = Helper::validate_key_value('propertyresident', $property, 'array');
        $propertyResident = !empty($propertyResident) ? $propertyResident->toArray() : [];
        $codebtors = Creditors::geCodebtors($clientId, $user->client_type);

        // Get the latest property ID (for new properties)
        $propertyId = null;
        if (!empty($propertyResident)) {
            $latestProperty = end($propertyResident);
            $propertyId = $latestProperty['id'] ?? null;
        }

        // Render view
        $html = view('client.questionnaire.property.ajax_resident', [
            'appservice_codebtors' => $codebtors,
            'propertyresident' => $propertyResident
        ])->render();

        return response()->json([
            'status' => 1,
            'msg' => "Information saved successfully",
            'display_id' => 'resident_listing_html',
            'html' => $html,
            'property_id' => $propertyId
        ]);
    }

    /**
     * Display property step 1 (Residence Information)
     * Shows form for entering real estate/residence details
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_property_step1(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;

        // Get attorney with validation using service
        $attorneyResult = $this->propertyDataService->getAttorneyWithValidation($clientId);
        if (isset($attorneyResult['error'])) {
            return redirect()->back()->with('error', $attorneyResult['error']);
        }
        $attorneyId = $attorneyResult['attorneyId'];

        // Handle POST request
        if ($request->isMethod('post')) {
            if ($error = $this->propertyDataService->checkEditPermission($request)) {
                return $request->wantsJson()
                    ? response()->json($error, 200)
                    : redirect()->back()->with('error', $error['msg']);
            }
            $this->propertyDataService->updatePropertyStep1($request, $clientId, $attorneyId);
        }

        // Get common data and generate steps using service
        $commonData = $this->propertyDataService->getCommonViewData($clientId, $attorneyId, $user);
        $steps = $this->propertyDataService->generateStepsArray(2, Helper::PROPERTY_STEP1_VIDEO);

        // Get property data using service
        $resident = $this->propertyDataService->getPropertyData($clientId, true, false);
        $resident['detailed_property'] = $user->detailed_property;
        $vehicles = $resident['propertyvehicle']->first()?->toArray() ?? [];
        $vehicleSelected = $vehicles['own_any_property'] ?? 0;

        return view('client.dashboard', $steps)->with([
            'appservice_codebtors' => $commonData['codebtors'],
            'BasicInfo_PartRest' => [], // Empty array maintained for backward compatibility with view
            'listOfFiles' => $commonData['listOfFiles'],
            'vehicleselected' => $vehicleSelected,
            'loanData' => [], // Empty array maintained for backward compatibility with view
            'progress' => $commonData['progress'],
            'docsProgress' => $commonData['docsProgress'],
            'resident' => $resident,
            'progress_percentage' => $commonData['progress_percentage'],
            'finacial_affairs' => $commonData['financialAffairs'],
            'crsReportNotCompleted' => $commonData['crsReportNotCompleted'],
        ]);
    }

    /**
     * Save property step 2 via AJAX
     * Handles adding/updating vehicle properties
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function property_ajax_save(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;

        // Check permission using service
        if ($error = $this->propertyDataService->checkEditPermission($request)) {
            return response()->json(['status' => false, 'msg' => $error['msg']], 200);
        }

        // Get attorney with validation using service
        $attorneyResult = $this->propertyDataService->getAttorneyWithValidation($clientId);
        if (isset($attorneyResult['error'])) {
            return response()->json(['status' => false, 'msg' => $attorneyResult['error']], 404);
        }

        // Update property data using service
        $this->propertyDataService->updatePropertyStep2($request, $clientId, $attorneyResult['attorneyId']);

        // Get vehicle data using service
        $clientPropertyData = $this->propertyDataService->getPropertyData($clientId);
        $propertyvehicle = Helper::validate_key_value('propertyvehicle', $clientPropertyData, 'array');
        $vehicles = !empty($propertyvehicle) ? current($propertyvehicle->toArray()) : [];
        $vehicleselected = !empty($vehicles) ? $vehicles['own_any_property'] : 0;
        $codebtors = Creditors::geCodebtors($clientId, $user->client_type);

        // Render view
        $html = view('client.questionnaire.property.ajax_vehicle', [
            'appservice_codebtors' => $codebtors,
            'vehicleselected' => $vehicleselected,
            'propertyvehicle' => $propertyvehicle
        ])->render();

        return response()->json([
            'status' => true,
            'msg' => 'Information saved successfully',
            'display_id' => 'vehicle_listing_html',
            'html' => $html
        ]);
    }

    /**
     * Display property step 2 (Household Goods)
     * Shows form for entering personal household items
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_property_step2(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;

        // Check redirects using service
        if ($redirectRoute = $this->propertyDataService->checkSubscriptionRedirects($user)) {
            return redirect()->route($redirectRoute)->with('success', 'Logged in successfully');
        }

        // Get attorney data using service
        $attorney = $this->propertyDataService->getAttorneyData($clientId);
        $attorneyId = $attorney ? $attorney->attorney_id : null;

        // Handle POST request
        if ($request->isMethod('post')) {
            if ($error = $this->propertyDataService->checkEditPermission($request)) {
                return redirect()->back()->with('error', $error['msg']);
            }
            $this->propertyDataService->updatePropertyStep2($request, $clientId, $attorneyId);
            Session::flash('success', 'Information saved successfully');
        }

        // Get common data and generate steps using service
        $commonData = $this->propertyDataService->getCommonViewData($clientId, $attorneyId, $user);
        $steps2 = $this->propertyDataService->generateStepsArray(3, Helper::PROPERTY_STEP2_VIDEO);

        // Get property data using service
        $residentData = $this->propertyDataService->getPropertyData($clientId, true, false);
        $detailedProperty = UserModel::where("id", $clientId)->value('detailed_property');
        $residentData['detailed_property'] = $detailedProperty ?? 0;
        $templateData = $this->propertyDataService->getTemplateData($attorneyId, 'personal_household_items');

        return view('client.dashboard', $steps2)->with([
            'appservice_codebtors' => $commonData['codebtors'],
            'listOfFiles' => $commonData['listOfFiles'],
            'BasicInfo_PartRest' => [], // Empty array maintained for backward compatibility with view
            'progress' => $commonData['progress'],
            'resident' => $residentData,
            'templateData' => $templateData,
            'docsProgress' => $commonData['docsProgress'],
            'docsUploadInfo' => $commonData['docsUploadInfo'],
            'progress_percentage' => $commonData['progress_percentage'],
            'finacial_affairs' => $commonData['financialAffairs'],
            'crsReportNotCompleted' => $commonData['crsReportNotCompleted'],
        ]);
    }

    /**
     * Display property step 3 (Financial Assets)
     * Shows form for entering bank accounts, investments, etc.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_property_step3(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;

        // Check redirects using service
        if ($redirectRoute = $this->propertyDataService->checkSubscriptionRedirects($user)) {
            return redirect()->route($redirectRoute)->with('success', 'Logged in successfully');
        }

        // Get attorney data using service
        $attorney = $this->propertyDataService->getAttorneyData($clientId);
        $attorneyId = $attorney ? $attorney->attorney_id : null;

        // Handle POST request
        if ($request->isMethod('post')) {
            if ($error = $this->propertyDataService->checkEditPermission($request)) {
                return redirect()->back()->with('error', $error['msg']);
            }
            $this->propertyDataService->updatePropertyStep3($request, $clientId, $attorneyId);
            Session::flash('success', 'Information saved successfully');
        }

        // Generate steps using service
        $steps3 = $this->propertyDataService->generateStepsArray(4, Helper::PROPERTY_STEP3_VIDEO);

        // Get property data
        $residentData = CacheProperty::getPropertyData($clientId, true, false);

        // Check statement existence with single query each
        $statementExist = MasterCardTransactions::where('client_id', $clientId)
            ->where('client_type', 'debtor')
            ->exists() ? 1 : 0;

        $spouseStatementExist = MasterCardTransactions::where('client_id', $clientId)
            ->where('client_type', 'codebtor')
            ->exists() ? 1 : 0;

        // Get video guides using service
        $videoGuides = [
            'paypalVideos' => $this->propertyDataService->getPaymentMethodVideos('PAYPAL'),
            'cashAppVideos' => $this->propertyDataService->getPaymentMethodVideos('CASH_APP'),
            'venmoVideo' => $this->propertyDataService->getPaymentMethodVideos('VENMO'),
        ];

        // Process business data using service
        $businessData = $this->propertyDataService->processBusinessData($user);

        // Get associate data if exists
        $clientsAssociateId = ClientsAssociate::getAssociateId($clientId);
        $finalAttorneyId = $clientsAssociateId ?: $attorneyId;
        $isAssociate = $clientsAssociateId ? 1 : 0;

        // Get attorney settings
        $attorneySettings = $finalAttorneyId
            ? AttorneySettings::where([
                'attorney_id' => $finalAttorneyId,
                'is_associate' => $isAssociate
            ])->first(['transaction_pdf_enabled', 'transaction_pdf_signature_enabled'])
            : null;

        $transactionPdfEnabled = $attorneySettings ? $attorneySettings->transaction_pdf_enabled : 0;

        // Get all required data
        $progressData = FormsStepsCompleted::getStepCompletionData($clientId, $user->client_type);
        $docsProgress = $attorneyId ? ClientHelper::get_uploaded_docs_progress('', $clientId, $attorneyId) : [];
        $financialAffairs = CacheSOFA::getSOFAData($clientId);
        $codebtors = Creditors::geCodebtors($clientId, $user->client_type);
        $listOfFiles = $finalAttorneyId ? AttorneyDocuments::getSignedDocuments($clientId, $finalAttorneyId) : [];
        $docsUploadInfo = ClientHelper::documentUploadInfo();
        $crsReportNotCompleted = PdfToJson::getCrsReportStatus($clientId);

        $templateData = $this->propertyDataService->getTemplateData($attorneyId,'financial_assets');
        $financialAssetsSettings =  Helper::validate_key_value('data', $templateData);
        return view('client.dashboard', array_merge($steps3, $videoGuides))->with([
            'appservice_codebtors' => $codebtors,
            'listOfFiles' => $listOfFiles,
            'BasicInfo_PartRest' => [], // Empty array maintained for backward compatibility with view
            'progress' => $progressData,
            'financialAssetsSettings' => $financialAssetsSettings,
            'resident' => $residentData,
            'docsProgress' => $docsProgress,
            'docsUploadInfo' => $docsUploadInfo,
            'progress_percentage' => ClientHelper::checkProgress(),
            'statement_exist' => $statementExist,
            'crsReportNotCompleted' => $crsReportNotCompleted,
            'spousestatement_exist' => $spouseStatementExist,
            'hasAnyBussiness' => $businessData['hasAnyBusiness'],
            'businessNames' => $businessData['businessNames'],
            'finacial_affairs' => $financialAffairs,
            'transaction_pdf_enabled' => $transactionPdfEnabled,
        ]);
    }

    /**
     * Display property step 4 (Money Owed/Business Assets)
     * Shows form for entering business equipment and money owed to client
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_property_step4(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;

        // Check redirects using service
        if ($redirectRoute = $this->propertyDataService->checkSubscriptionRedirects($user)) {
            return redirect()->route($redirectRoute)->with('success', 'Logged in successfully');
        }

        // Get attorney data using service
        $attorney = $this->propertyDataService->getAttorneyData($clientId);
        $attorneyId = $attorney ? $attorney->attorney_id : null;

        // Permission check for POST requests
        if ($request->isMethod('post')) {
            if ($error = $this->propertyDataService->checkEditPermission($request)) {
                return redirect()->back()->with('error', $error['msg']);
            }
            $this->propertyDataService->updatePropertyStep4($request, $clientId, $attorneyId);
            Session::flash('success', 'Information saved successfully');
        }

        // Get videos
        $videos = VideoHelper::getAdminVideos();
        $video = VideoHelper::getVideos($videos[Helper::PROPERTY_STEP4_VIDEO] ?? []);
        $steps4 = [
            'step1' => false, 'step2' => false, 'step3' => false,
            'step4' => false, 'step5' => false, 'step6' => false,
            'step7' => false, 'video' => $video, 'tab' => 'tab2'
        ];

        // Get property data and process steps
        $propertyData = CacheProperty::getPropertyData($clientId, true, false);

        $steps4 = $this->propertyDataService->getStepsDataForStep4($propertyData, $steps4);

        // Handle step7 completion
        if ($steps4['step7'] == 1) {
            FormsStepsCompleted::updateOrCreate(["client_id" => $clientId], ['client_id' => $clientId, 'step2' => 1]);

            return redirect()
                ->route('client_debts_step2_unsecured')
                ->with('success', 'Information saved successfully');
        }

        // Get all required data in single batches
        $progressData = FormsStepsCompleted::getStepCompletionData($clientId, $user->client_type);
        $financialAffairs = CacheSOFA::getSOFAData($clientId);
        $codebtors = Creditors::geCodebtors($clientId, $user->client_type);
        $docsProgress = $attorneyId ? ClientHelper::get_uploaded_docs_progress('', $clientId, $attorneyId) : [];
        $listOfFiles = $attorneyId ? AttorneyDocuments::getSignedDocuments($clientId, $attorneyId) : [];
        $docsUploadInfo = ClientHelper::documentUploadInfo();
        $crsReportNotCompleted = PdfToJson::getCrsReportStatus($clientId);
        $is_confirm_prompt_enabled = AttorneySettings::isConfirmPromptEnabled($attorneyId);
        $templateData = $this->propertyDataService->getTemplateData($attorneyId, 'money_own_to_you');
        $moneyOwnSettings = Helper::validate_key_value('data', $templateData);

        return view('client.dashboard', $steps4)->with([
            'appservice_codebtors' => $codebtors,
            'listOfFiles' => $listOfFiles,
            'BasicInfo_PartRest' => [], // Empty array maintained for backward compatibility with view
            'video' => $steps4['video'],
            'docsProgress' => $docsProgress,
            'progress' => $progressData,
            'resident' => $propertyData,
            'moneyOwnSettings' => $moneyOwnSettings,
            'docsUploadInfo' => $docsUploadInfo,
            'progress_percentage' => ClientHelper::checkProgress(),
            'finacial_affairs' => $financialAffairs,
            'crsReportNotCompleted' => $crsReportNotCompleted,
            'is_confirm_prompt_enabled' => $is_confirm_prompt_enabled
        ]);
    }

    /**
     * Display property step 4 continued (Additional Business Assets)
     * Continuation of step 4 for additional business property entries
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_property_step4_continue(Request $request)
    {
        $client = Auth::user();
        $client_id = $client->id;

        // Get attorney with validation using service
        $attorneyResult = $this->propertyDataService->getAttorneyWithValidation($client_id);
        if (isset($attorneyResult['error'])) {
            return redirect()->back()->with('error', $attorneyResult['error']);
        }
        $attorney_id = $attorneyResult['attorneyId'];

        if ($request->isMethod('post')) {
            if ($error = $this->propertyDataService->checkEditPermission($request)) {
                return redirect()->back()->with('error', $error['msg']);
            }
            $this->propertyDataService->updatePropertyStepContinue4($request, $client_id, $attorney_id);
            Session::flash('success', 'Information has been saved successfully');
        }

        // Generate steps using service
        $steps4 = $this->propertyDataService->generateStepsArray(4, Helper::PROPERTY_STEP4_CONTINUED_VIDEO);

        $resident = CacheProperty::getPropertyData($client_id, true, false);

        $steps4 = $this->propertyDataService->getStepsDataForStep4($resident, $steps4);
        $docsUploadInfoSteps4 = ClientHelper::documentUploadInfo();
        $progressSteps4 = FormsStepsCompleted::getStepCompletionData($client_id, $client->client_type);

        // For step4continue page, step4 should be false and step4continue should be true
        $steps4['step4'] = false;
        $steps4['step4continue'] = 1;
        $steps4['step5'] = false;
        $steps4['step7'] = false;
        $steps4['step6'] = false;

        $docsProgress = ClientHelper::get_uploaded_docs_progress('', $client_id, $attorney_id);
        $finacial_affairs = CacheSOFA::getSOFAData($client_id);
        $codebtors = Creditors::geCodebtors($client_id, $client->client_type);
        $listOfFiles = AttorneyDocuments::getSignedDocuments($client_id, $attorney_id);
        $crsReportNotCompleted = PdfToJson::getCrsReportStatus($client_id);

        $is_confirm_prompt_enabled = AttorneySettings::isConfirmPromptEnabled($attorney_id);
        $templateData = $this->propertyDataService->getTemplateData($attorney_id, 'money_own_to_you');
        $moneyOwnSettings = Helper::validate_key_value('data', $templateData);

        return view('client.dashboard', $steps4)->with(
            [
                'appservice_codebtors' => $codebtors,
                'listOfFiles' => $listOfFiles,
                'BasicInfo_PartRest' => [], // Empty array maintained for backward compatibility with view
                'video' => $steps4['video'],
                'docsProgress' => $docsProgress,
                'progress' => $progressSteps4,
                'resident' => $resident,
                'moneyOwnSettings' => $moneyOwnSettings,
                'docsUploadInfo' => $docsUploadInfoSteps4,
                'progress_percentage' => ClientHelper::checkProgress(),
                'finacial_affairs' => $finacial_affairs,
                'crsReportNotCompleted' => $crsReportNotCompleted,
                'is_confirm_prompt_enabled' => $is_confirm_prompt_enabled
            ]
        );
    }

    /**
     * Display property step 5 (Farm/Commercial Fishing)
     * Shows form for entering farm and commercial fishing equipment
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function client_property_step5(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;

        // Check redirects using service
        if ($redirectRoute = $this->propertyDataService->checkSubscriptionRedirects($user)) {
            return redirect()->route($redirectRoute)->with('success', 'You are Logged in successfully');
        }

        // Get attorney data using service
        $attorney = $this->propertyDataService->getAttorneyData($clientId);
        $attorneyId = $attorney ? $attorney->attorney_id : null;

        // Handle POST request
        if ($request->isMethod('post')) {
            if ($error = $this->propertyDataService->checkEditPermission($request)) {
                return redirect()->back()->with('error', $error['msg']);
            }
            $this->propertyDataService->updatePropertyStep5($request, $clientId, $attorneyId);
            Session::flash('success', 'Information has been saved successfully');
        }

        // Get videos
        $videos = VideoHelper::getAdminVideos();
        $video = VideoHelper::getVideos($videos[Helper::PROPERTY_STEP5_VIDEO] ?? []);
        $steps5 = [
            'step1' => false,
            'step2' => false,
            'step3' => false,
            'step4' => false,
            'step5' => false,
            'step6' => false,
            'step7' => false,
            'video' => $video,
            'tab' => 'tab2'
        ];

        $residentSteps5 = CacheProperty::getPropertyData($clientId, true, false);

        $steps5 = $this->propertyDataService->getStepsDataForStep5($residentSteps5, $steps5);

        // Check for step7 completion
        if ($steps5['step7']) {
            FormsStepsCompleted::updateOrCreate(["client_id" => $clientId], ['client_id' => $clientId, 'step2' => 1]);

            return redirect()->route('client_debts_step2_unsecured')->with('success', 'Information has been saved successfully');
        }

        // Get all needed data
        $progress = FormsStepsCompleted::getStepCompletionData($clientId, $user->client_type);
        $docsProgress = ClientHelper::get_uploaded_docs_progress('', $clientId, $attorneyId);
        $finacialAffairs = CacheSOFA::getSOFAData($clientId);
        $codebtors = Creditors::geCodebtors($clientId, $user->client_type);
        $listOfFiles = $attorneyId ? AttorneyDocuments::getSignedDocuments($clientId, $attorneyId) : [];
        $docsUploadInfoSteps5 = ClientHelper::documentUploadInfo();
        $crsReportNotCompleted = PdfToJson::getCrsReportStatus($clientId);
        $is_confirm_prompt_enabled = AttorneySettings::isConfirmPromptEnabled($attorneyId);

        return view('client.dashboard', $steps5)->with([
            'appservice_codebtors' => $codebtors,
            'listOfFiles' => $listOfFiles,
            'BasicInfo_PartRest' => [], // Empty array maintained for backward compatibility with view
            'video' => $steps5['video'],
            'progress' => $progress,
            'docsProgress' => $docsProgress,
            'resident' => $residentSteps5,
            'docsUploadInfo' => $docsUploadInfoSteps5,
            'progress_percentage' => ClientHelper::checkProgress(),
            'finacial_affairs' => $finacialAffairs,
            'crsReportNotCompleted' => $crsReportNotCompleted,
            'is_confirm_prompt_enabled' => $is_confirm_prompt_enabled
        ]);
    }

    /**
     * Display property step 6 (Miscellaneous Property)
     * Shows form for entering miscellaneous property and completes property section
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function client_property_step6(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;

        // Check redirects using service
        if ($redirectRoute = $this->propertyDataService->checkSubscriptionRedirects($user)) {
            return redirect()->route($redirectRoute)->with('success', 'Logged in successfully');
        }

        // Get attorney data using service
        $attorney = $this->propertyDataService->getAttorneyData($clientId);
        $attorneyId = $attorney ? $attorney->attorney_id : null;

        // Handle POST request
        if ($request->isMethod('post')) {
            if ($error = $this->propertyDataService->checkEditPermission($request)) {
                return redirect()->back()->with('error', $error['msg']);
            }
            $this->propertyDataService->updatePropertyStep6($request, $clientId, $attorneyId);
            Session::flash('success', 'Information saved successfully');
        }

        // Generate steps using service
        $steps6 = $this->propertyDataService->generateStepsArray(7, Helper::PROPERTY_STEP6_VIDEO);

        // Check step7 completion (always true in original code)
        FormsStepsCompleted::updateOrCreate(["client_id" => $clientId], ['client_id' => $clientId, 'step2' => 1]);

        return redirect()
            ->route('client_debts_step2_unsecured')
            ->with('success', 'Information saved successfully');

        // The following code is unreachable due to the redirect above,
        // but kept for reference of the original structure

        // $residentData = CacheProperty::getPropertyData($clientId, true, false);
        // $progressData = FormsStepsCompleted::getStepCompletionData($clientId, $user->client_type);
        // $financialAffairs = self::getFinancialAffairsData($clientId);
        // $listOfFiles = $attorneyId ? AttorneyDocuments::getSignedDocuments($clientId, $attorneyId) : [];
        // $docsUploadInfo = ClientHelper::documentUploadInfo();
        // $crsReportNotCompleted = PdfToJson::getCrsReportStatus($client_id);

        // return view('client.dashboard', $steps6)->with([
        //     'listOfFiles' => $listOfFiles,
        //     'BasicInfo_PartRest' => [],
        //     'progress' => $progressData,
        //     'resident' => $residentData,
        //     'docsUploadInfo' => $docsUploadInfo,
        //     'progress_percentage' => ClientHelper::checkProgress(),
        //     'finacial_affairs' => $financialAffairs,
        //     'crsReportNotCompleted' => $crsReportNotCompleted,
        // ]);
    }

    /**
     * Save property step 7 (final completion)
     * Marks property section as complete and redirects to debts
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function client_property_step7(Request $request)
    {
        $client = Auth::user();
        $client_id = $client->id;
        $this->propertyDataService->updatePropertyStep7($request, $client, $client_id);
        FormsStepsCompleted::updateOrCreate(["client_id" => $client_id], ['client_id' => $client_id, 'step2' => 1]);

        return redirect()
            ->route('client_debts_step2_unsecured')
            ->with('success', 'Information has been saved successfully');
    }

    /**
     * Display popup for detailed property items selection
     * Shows predefined items list for household goods, electronics, etc.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailed_tab_items_popup(Request $request)
    {
        $input = $request->all();
        $type = Helper::validate_key_value('type', $input);
        $previous_data = Helper::validate_key_value('previous_data', $input);

        // Get items and title based on type - extracted to reduce complexity
        $itemsData = $this->getDetailedPropertyItemsByType($type);

        // Check for attorney template override
        $client_id = Auth::user()->id;
        $attorney = ClientsAttorney::where("client_id", $client_id)->first();
        $attorney_id = $attorney->attorney_id;

        $items = $this->getTemplateItemsOrDefault($attorney_id, $type, $itemsData['items']);

        $returnHTML = view('client.questionnaire.property.common_utility_popup')
            ->with([
                'type' => $type,
                'previous_data' => $previous_data,
                'items' => $items,
                'title' => $itemsData['title']
            ])
            ->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    /**
     * Get detailed property items and title by type
     * Extracted switch statement to reduce cyclomatic complexity
     *
     * @param string $type
     * @return array
     */
    private function getDetailedPropertyItemsByType(string $type): array
    {
        $itemsMap = [
            'household_goods_furnishings' => [
                'title' => 'Household Goods & Furnishings',
                'items' => UtilityHelper::getHouseholdGoodsFurnishingsItemsArray()
            ],
            'electronics' => [
                'title' => 'Electronics',
                'items' => UtilityHelper::getElectronicsItemsArray()
            ],
            'collectibles' => [
                'title' => 'Collectibles',
                'items' => UtilityHelper::getCollectiblesItemsArray()
            ],
            'sports' => [
                'title' => 'Sports Equipment',
                'items' => UtilityHelper::getSportsItemsArray()
            ],
            'everydayfinejqwl' => [
                'title' => 'Everyday and Fine Jewelry',
                'items' => UtilityHelper::getEverydayAndFineJewelryItemsArray()
            ],
            'everydayclothing' => [
                'title' => 'Everyday Clothing',
                'items' => UtilityHelper::getEverydayClothingArray()
            ],
            'firearms' => [
                'title' => 'Firearms',
                'items' => UtilityHelper::getFirearmsArray()
            ],
        ];

        return $itemsMap[$type] ?? ['title' => '', 'items' => []];
    }

    /**
     * Get template items if attorney has custom template, otherwise return default
     * Extracted to reduce method complexity
     *
     * @param int $attorney_id
     * @param string $type
     * @param array $defaultItems
     * @return array
     */
    private function getTemplateItemsOrDefault(int $attorney_id, string $type, array $defaultItems): array
    {
        $template = TemplateDetailedProperty::where(['attorney_id' => $attorney_id])->first();

        if (empty($template)) {
            return $defaultItems;
        }

        $columnName = UtilityHelper::getDetailedPropertyTableColumnNameForTemplate($type);
        $subData = Helper::validate_key_value($columnName, $template->toArray());

        if (!empty($subData)) {
            return json_decode($subData, true);
        }

        return $defaultItems;
    }

    /**
     * Update property asset on client side
     * Saves household property data via AJAX
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_property_asset_client_side(Request $request)
    {
        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_property')) {
            $input = $request->all();
            $client_id = Helper::validate_key_value('client_id', $input, 'radio');
            $attorney = ClientsAttorney::where("client_id", $client_id)->first();
            $attorney_id = $attorney->attorney_id;
            DB::beginTransaction();
            try {
                QuestionnairePropertyHousehold::savePropertyAsset($request, $client_id, false, $attorney_id);
                DB::commit();

                return response()->json(Helper::renderJsonSuccess("Record saved successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json(Helper::renderJsonError('Something went wrong'))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }

        return response()->json(Helper::renderJsonError('Something went wrong'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    /**
     * Save property asset separately
     * Handles separate save for financial assets (bank, retirement, etc.)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function property_asset_seperate_save(Request $request)
    {
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_property')) {
            return response()->json(['status' => 0, 'msg' => "You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen."])->header('Content-Type: application/json;', 'charset=utf-8');
        }

        if ($request->isMethod('post') && Helper::isTabEditable('can_edit_property')) {
            DB::beginTransaction();
            try {
                $user = Auth::user();

                // Use service to handle the business logic
                $result = $this->propertyDataService->savePropertyAssetSeparately($request, $user);

                // Render the updated section
                $html = view('client.questionnaire.property.financial.common.'.$result['fileName'], $result['renderData'])->render();

                DB::commit();

                return response()->json([
                    'status' => true,
                    'html' => $html
                ]);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json([
                    'status' => false,
                    'msg' => 'Something went wrong, try again.'
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'msg' => 'Something went wrong, try again.'
        ]);
    }

    /**
     * Get asset data to return for specific asset type
     * NOTE: Method name has typo "Assest" (should be "Asset") but kept for backward compatibility
     *
     * @param int $client_id
     * @param string $assetType
     * @return array
     */
    public static function getAssestDataToReturn($client_id, $assetType)
    {
        $propertyData = CacheProperty::getPropertyData($client_id, true, false);
        $pFA = Helper::validate_key_value('financialassets', $propertyData, 'array');
        $financial = ClientsPropertyFinancialAssets::getDataByAssetType($pFA, $assetType);

        if (empty($financial) || !is_array($financial)) {
            return [];
        }

        $f_type_data = json_decode($financial['type_data'], 1);
        if (empty($f_type_data)) {
            return [];
        }

        // Add common fields to all asset types
        $financial = self::addCommonFinancialFields($financial, $f_type_data);
        
        // Add type-specific fields based on asset type
        $financial = self::addTypeSpecificFinancialFields($financial, $f_type_data);
        
        unset($financial['type_data']);

        return $financial;
    }

    /**
     * Add common financial fields to asset data
     * Reduces complexity by extracting common mapping
     *
     * @param array $financial
     * @param array $f_type_data
     * @return array
     */
    private static function addCommonFinancialFields(array $financial, array $f_type_data): array
    {
        $financial['type_of_account'] = $f_type_data['type_of_account'] ?? '';
        $financial['description'] = $f_type_data['description'] ?? '';
        $financial['last_4_digits'] = $f_type_data['last_4_digits'] ?? '';
        $financial['property_value'] = $f_type_data['property_value'] ?? '';
        $financial['account_type'] = $f_type_data['account_type'] ?? '';
        $financial['owned_by'] = $f_type_data['owned_by'] ?? '';
        $financial['property_value_unknown'] = $f_type_data['property_value_unknown'] ?? '';
        $financial['state'] = Helper::validate_key_value('state', $f_type_data);
        $financial['unknown'] = $f_type_data['unknown'] ?? '';

        return $financial;
    }

    /**
     * Add type-specific financial fields based on asset type
     * Reduces cyclomatic complexity by extracting conditional logic
     *
     * @param array $financial
     * @param array $f_type_data
     * @return array
     */
    private static function addTypeSpecificFinancialFields(array $financial, array $f_type_data): array
    {
        $type = $financial['type'] ?? '';

        switch ($type) {
            case 'tax_refunds':
                $financial['year'] = $f_type_data['year'] ?? '';
                break;

            case 'bank':
                $financial['personal_business_account'] = $f_type_data['personal_business_account'] ?? '';
                $financial['business_name'] = $f_type_data['business_name'] ?? '';
                $financial['transaction'] = $f_type_data['transaction'] ?? '';
                $financial['transaction_data'] = $f_type_data['transaction_data'] ?? '';
                break;

            case 'venmo_paypal_cash':
                $financial['debtor_type'] = $f_type_data['debtor_type'] ?? '';
                break;

            case 'alimony_child_support':
                $financial['data_for'] = Helper::validate_key_value('data_for', $f_type_data);
                break;

            case 'life_insurance':
                $financial['current_value'] = Helper::validate_key_value('current_value', $f_type_data);
                break;

            case 'unpaid_wages':
                $financial['owed_type'] = Helper::validate_key_value('owed_type', $f_type_data);
                $financial['data_for'] = Helper::validate_key_value('data_for', $f_type_data);
                $financial['monthly_amount'] = Helper::validate_key_value('monthly_amount', $f_type_data);
                break;
        }

        return $financial;
    }

    /**
     * Get property vehicle details via GraphQL API
     * Fetches vehicle information and value using VIN number
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_property_vehicle_details_by_graphql(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'vin' => 'required|string',
            'mileage' => 'required',
        ]);

        $client_id = $request->input('client_id', '');
        $vin = $request->input('vin', '');
        $mileage = $request->input('mileage', '');

        try {
            // Make GraphQL API call
            $payload = $this->callVehicleVinGraphQL($vin, $mileage);

            // Handle GraphQL errors
            if (isset($payload['errors'])) {
                $this->logGraphQLError($client_id, $vin, $mileage, $payload['errors']);
                return response()->json(Helper::renderJsonError("Failed to fetch vehicle details. Please try again later."))
                    ->header('Content-Type: application/json;', 'charset=utf-8');
            }

            // Transform response data
            $data = $payload['data']['decodeVin']['vehicleValue'] ?? null;
            $finalData = $this->transformVehicleData($data);

            // Log request
            $this->logVehicleApiRequest($client_id, $vin, $mileage, $payload);

            return response()->json([
                'status' => 1,
                'finalData' => $finalData,
                'extraData' => json_encode($payload),
            ], 200);

        } catch (RequestException $e) {
            // Network or HTTP error
            return response()->json(Helper::renderJsonError($e->getMessage()))
                ->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    /**
     * Call GraphQL API for vehicle VIN decoding
     * Extracted to reduce method complexity
     *
     * @param string $vin
     * @param int $mileage
     * @return array
     */
    private function callVehicleVinGraphQL(string $vin, int $mileage): array
    {
        $endpoint = env('APPSYNC_ENDPOINT');
        $apiKey = env('APPSYNC_API_KEY');

        $variables = [
            'vin' => $vin,
            'mileage' => $mileage,
        ];

        // Prepare Guzzle client
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'x-api-key' => $apiKey
            ],
            'timeout' => 10
        ]);

        $response = $client->post($endpoint, [
            'json' => [
                'query' => self::VEHICLE_VIN_GRAPHQL_QUERY,
                'variables' => $variables
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Transform GraphQL vehicle response to final data array
     * Reduces complexity in main method
     *
     * @param array|null $data
     * @return array
     */
    private function transformVehicleData(?array $data): array
    {
        $finalData = [
            'year' => '',
            'make' => '',
            'model' => '',
            'style' => '',
            'mileage' => '',
            'price' => ''
        ];

        if (empty($data)) {
            return $finalData;
        }

        $finalData['mileage'] = Helper::getLotSize(Helper::validate_key_value('mileage', $data, 'array'));
        $finalData['price'] = Helper::getLotSize(Helper::validate_key_value('mean', $data, 'array'));
        
        $vehicle = Helper::validate_key_value('vehicle', $data);
        if (!empty($vehicle)) {
            $parts = explode(" ", $vehicle);
            $finalData['year'] = $parts[0] ?? '';
            $finalData['make'] = $parts[1] ?? '';
            $finalData['model'] = $parts[2] ?? '';
            $finalData['style'] = implode(" ", array_slice($parts, 3));
        }

        return $finalData;
    }

    /**
     * Log GraphQL error for debugging
     *
     * @param int $client_id
     * @param string $vin
     * @param int $mileage
     * @param array $errors
     * @return void
     */
    private function logGraphQLError(int $client_id, string $vin, int $mileage, array $errors): void
    {
        Log::error('GraphQL error in get_property_vehicle_details_by_graphql', [
            'client_id' => $client_id,
            'vin' => $vin,
            'mileage' => $mileage,
            'errors' => $errors
        ]);
    }

    /**
     * Log vehicle API request for audit trail
     *
     * @param int $client_id
     * @param string $vin
     * @param int $mileage
     * @param array $payload
     * @return void
     */
    private function logVehicleApiRequest(int $client_id, string $vin, int $mileage, array $payload): void
    {
        TblPropertyDetailApiRequest::logRequest(
            $client_id,
            2,
            json_encode(['vin' => $vin, 'mileage' => $mileage]),
            json_encode($payload)
        );
    }
}
