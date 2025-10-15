<?php

namespace App\Http\Controllers\Attorney;

use App\Helpers\AddressHelper;
use App\Http\Controllers\AttorneyController;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Helpers\ClientHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Helpers\DateTimeHelper;
use App\Helpers\VideoHelper;
use App\Mail\ClientAppointmentReminderMail;
use App\Models\AdminClientRequestedDocuments;
use App\Models\AttorneyCommonDocuments;
use App\Models\AttorneyDocuments;
use App\Models\AttorneyEmployerInformationToClient;
use App\Models\AttorneySettings;
use App\Models\CalendlyWebhook;
use App\Models\ClientAppointmentReminder;
use App\Models\ClientDocuments;
use App\Models\ClientDocumentUploaded;
use App\Models\ClientParalegal;
use App\Models\ClientsAssociate;
use App\Models\LawFirmAssociate;
use App\Models\ParalegalSettings;
use App\Models\User;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheIncome;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;

class AttorneyDashboardController extends AttorneyController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function client_management(Request $request, $type = '')
    {
        if (!$this->isValidPackage()) {
            return redirect()->route('attorney_price_table', ['package_id' => 100]);
        }
        $isParalegal = !empty(Auth::user()->parent_attorney_id);
        $query = $request->query('q', '');
        $type = !empty($query) ? '' : $type;
        $unreadMessageCount = 0;
        $notIn = [
                'document_sign',
                'signed_document'
            ];
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'desc');
        $perPage = $request->input('per_page', 10);
        $filterParalegalId = $request->query('filter_paralegal', '');
        $filterAssociateId = $request->query('filter_associate', '');

        $attorney_id = Helper::getCurrentAttorneyId();

        // Get unread message count for attorney or paralegal
        $unreadMessageQuery = User::leftJoin('tbl_clients_attorney', 'users.id', '=', 'tbl_clients_attorney.client_id')
            ->leftJoin('tbl_simpletext_message_webhook', 'users.id', '=', 'tbl_simpletext_message_webhook.client_id')
            ->where('users.role', User::CLIENT)
            ->where('tbl_clients_attorney.attorney_id', $attorney_id)
            ->where('tbl_simpletext_message_webhook.seen_by_attorney', 0);

        if ($isParalegal) {
            $unreadMessageQuery->leftJoin('tbl_clients_paralegal', 'users.id', '=', 'tbl_clients_paralegal.client_id')
            ->where('tbl_clients_paralegal.paralegal_id', Auth::user()->id);
        }

        $unreadMessageCount = $unreadMessageQuery->groupBy('users.id')->get()->count();

        $paginateData = ['users.id',
                'users.phone_no',
                'users.name',
                'users.email',
                'users.client_type',
                'users.created_at',
                'users.client_subscription',
                'users.client_payroll_assistant',
                'users.petition_prepration_package',
                'users.peralegal_check_package',
                'users.user_status',
                'users.logged_in_ever',
                'users.concierge_service as concierge_service',
                'users.in_queue',
                'users.concierge_service_status',
                'users.client_bank_statements',
                'users.client_bank_statements_premium',
                'users.client_profit_loss_assistant',
                'users.detailed_property',
                'users.case_submitted_to_attorney_on',
                'users.last_login_at',
                'users.client_credit_report',
                'users.date_marked_delete',
                'users.free_package_unpaid'
            ];

        $client = User::with([
                'clientsAttorney',
                'assignedAttorney',
                'clientsParalegal',
                'clientsAssociate',
                'formsStepsCompleted',
                'simpleTextWebhookMessages',
                'clientsAppointmentReminder',
                'clientsSettings'
            ])->leftJoin('tbl_client_settings', 'users.id', '=', 'tbl_client_settings.client_id')
            ->where('users.role', User::CLIENT)
            ->whereHas('clientsAttorney', function ($q) use ($attorney_id) {
                $q->where('attorney_id', $attorney_id);
            })->userSearch($query)
            ->userFilterByType(
                $type,
                $unreadMessageCount,
                $notIn,
                Auth::user(),
                $filterParalegalId,
                $filterAssociateId
            )->orderBy('users.' . $sortBy, $sortOrder)
            ->groupBy('users.id')
            ->paginate($perPage, $paginateData)
            ->appends([
                'q' => $query,
                'sort_by' => $sortBy,
                'sort_order' => $sortOrder,
                'per_page' => $perPage,
            ]);

        $fileCaseCount = User::getFiledCaseCount($attorney_id);

        $clientIds = $client->pluck('id')->toArray();

        $clients = [];
        $clientClendly = [];
        $documentCompleteness = [];
        $newDocUploaded = [];
        $newDocumentClientCount = 0;

        $clandleyEventdata = CalendlyWebhook::whereIn('client_id', $clientIds)->orderBy('id', 'DESC')->get();

        foreach ($client as $val) {
            $clients[$val['id']] = [
                "eligible_for_final_submit" => "",
                "tab1_percentage" => 0.0,
                "tab1_percentage_by_steps" => [],
                "tab2_percentage" => 0.0,
                "tab2_percentage_by_steps" => [],
                "tab3_percentage" => 0.0,
                "tab3_percentage_by_steps" => [],
                "tab4_percentage" => 0.0,
                "tab4_percentage_by_steps" => [],
                "tab5_percentage" => 0.0,
                "tab5_percentage_by_steps" => [],
                "tab6_percentage" => 0.0,
                "tab6_percentage_by_steps" => [],
                "all_percentage" => 0.0,
                "submitted_to_att_at" => "",
            ];

            $eventdata = $clandleyEventdata->where('client_id', $val['id'])->first();
            $clientClendly[$val['id']] = !empty($eventdata) ? $eventdata->toArray() : [];
            $documentCompleteness[$val['id']] = ["notUploadedDocs" => [], "progress" => 0.0];
            $newDocUploaded[$val['id']] = 0;
        }

        $invite_video = VideoHelper::getAttorneyVideos(Helper::INVITE_CLIENT_VIDEO);
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_CLIENT_MANAGEMENT_VIDEO);

        $iDocStatus = User::where('id', $attorney_id)->select('invite_document_selection')->first();
        $iDocStatus = !empty($iDocStatus) ? $iDocStatus->invite_document_selection : 0;

        $attorneydocuments = Cache::remember("attorney_documents_{$attorney_id}", 3600, function () use ($attorney_id) {
            return AttorneyDocuments::where(['attorney_id' => $attorney_id, 'is_associate' => 0])
                ->pluck('document_name', 'document_type')
                ->all();
        });

        $attorneySettings = AttorneySettings::where(['attorney_id' => $attorney_id, 'is_associate' => 0])->select(['enabled_detailed_property'])->first();

        $associates = LawFirmAssociate::where('attorney_id', $attorney_id);
        $associates = $associates->orderBy('id', 'DESC')->get();
        $associates = isset($associates) && !empty($associates) ? $associates->toArray() : [];

        $isAnyClientWithNewDoc = is_array($newDocUploaded) ? array_sum(array_values($newDocUploaded)) : '';

        $commonDocuments = AttorneyCommonDocuments::orderBy('id', 'DESC')->where([ 'attorney_id' => $attorney_id, 'is_associate' => 0 ])->get();
        $commonDocuments = isset($commonDocuments) && !empty($commonDocuments) ? $commonDocuments->toArray() : [];


        $enabled_menu_items = [];
        if ($isParalegal) {
            $paralegalId = Auth::user()->id;
            $paralegal = ParalegalSettings::where(['paralegal_id' => $paralegalId])->first();
            $paralegal = !empty($paralegal) ? $paralegal->toArray() : [];

            $enabled_menu_items = Helper::validate_key_value('enabled_menu_items', $paralegal);
            $enabled_menu_items = json_decode($enabled_menu_items, true) ?? [];
        }
        $jsonClientData = User::getClientManagementCommonDataNew($clientIds, $attorney_id);

        return view('attorney.client_management_new', ['jsonClientData' => $jsonClientData,'fileCaseCount' => $fileCaseCount, 'enabled_menu_items' => $enabled_menu_items, 'commonDocuments' => $commonDocuments,'clientIds' => $clientIds, 'attorney_id' => $attorney_id, 'isAnyClientWithNewDoc' => $isAnyClientWithNewDoc, 'newDocUploaded' => $newDocUploaded, 'sort_by' => $sortBy,'filterParalegalId' => $filterParalegalId, 'filterAssociateId' => $filterAssociateId, 'associates' => $associates,'sort_order' => $sortOrder, 'per_page' => $perPage, 'unreadMessageCount' => $unreadMessageCount,'attorney_detailed_property_enabled' => $attorneySettings->enabled_detailed_property ?? 0, 'video' => $video, 'keyword' => $query ,'invite_video' => $invite_video,"type" => $type,"iDocStatus" => $iDocStatus,"attorneydocuments" => $attorneydocuments,'client_percent' => $clients, 'client' => $client,'client_clendly' => $clientClendly,'newDocumentClientCount' => $newDocumentClientCount, 'documentCompleteness' => $documentCompleteness]);
    }


    public function edit_attorney_request_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $formstep = \App\Models\FormsStepsCompleted::where(['client_id' => $client_id])->first();

        $data = [
                    'isAdmin' => false,
                    'isAttorney' => true,
                    'formstep' => $formstep,
                    'client_id' => $client_id
                ];

        return view('admin.concierge_service_clients.edit_request_popup', $data);
    }

    public function attorney_documents_list_popup_non_concierge(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $client = User::where('id', '=', $client_id)->first();

        $attorney_id = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attIdToReturn = $attorney_id;
        $is_associate = 0;

        if (!empty($ClientsAssociateId)) {
            $attorney_id = $ClientsAssociateId;
            $is_associate = 1;
        }

        $queryCondition = [ 'attorney_id' => $attorney_id, 'is_associate' => $is_associate ];

        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
        $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
        if ($client->client_type == 2) {
            $spousename = "Non-Filing Spouse";
        }

        $documentuploaded_list = $client->clientDocumentUploaded->toArray();
        $documentuploaded = array_column($documentuploaded_list, 'document_type');

        $fdata = \App\Models\FormsStepsCompleted::where("client_id", $client_id)->select('step6', 'can_edit')->get()->toArray();
        $hidebtn = !empty($fdata) && $fdata[0]['step6'] == 1 && $fdata[0]['can_edit'] == 2 ? 1 : 0;

        $attorneydocuments = AttorneyDocuments::where($queryCondition)->pluck('document_name', 'document_type')->all();
        $adminDocuments = \App\Models\AdminClientDocuments::where(['client_id' => $client_id])->select('document_name', 'document_type')->get();

        $documentTypes = Helper::getDocuments($client->client_type, false, 1, 1, 0, 0, $attorney_id);
        $documentTypes = $documentTypes + Helper::getMiscDocs();
        // $documentTypes = self::checkAndSetDefaultTypes($documentTypes, $documentuploaded,0);
        // $documentTypes = self::getDefaultAutoLoans($documentTypes, $documentuploaded,0);



        $isPostSubmissionEnabled = \App\Models\ClientSettings::isPostSubmissionEnabled($client_id);
        if ($isPostSubmissionEnabled) {
            $documentTypes = [ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS => "Post submission documents"] + $documentTypes;
            $clientPSDocuments = ClientDocuments::getClientPostSubmissionDocumentList($client_id);
            if ($clientPSDocuments) {
                foreach ($clientPSDocuments as $key => $document) {
                    $documentTypes[Helper::validate_key_value('document_name', $document)] = Helper::validate_key_value('document_type', $document);
                }
            }
        }

        $attorneySettings = AttorneySettings::where($queryCondition)->select(['bank_statement_months','attorney_enabled_bank_statment','is_car_title_enabled','is_rental_agreement_enabled'])->first();
        $attorney_enabled_bank_statment = !empty($attorneySettings) ? Helper::validate_key_value('attorney_enabled_bank_statment', $attorneySettings, 'radio') : 0;
        $is_car_title_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_car_title_enabled', $attorneySettings, 'radio') : 0;
        $is_rental_agreement_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_rental_agreement_enabled', $attorneySettings, 'radio') : 0;
        $isBankStatementEnabled = ($attorney_enabled_bank_statment == 1) ? true : false;

        $unpaid_wages = ClientDocuments::getClientDocumentList($client_id, 'unpaid_wages');
        $unpaid_wages = ClientHelper::getUpdatedLabelName($debtorname, $spousename, $unpaid_wages, true);

        $bankDocuments = [];
        $venmoPaypalCash = [];
        $brokerageAccount = [];
        $bankDocsBussinessKeys = [];

        if ($isBankStatementEnabled) {
            $bankDocuments = ClientDocuments::getClientDocumentList($client_id, 'bank');
            $venmoPaypalCash = ClientDocuments::getClientDocumentList($client_id, 'venmo_paypal_cash');
            $venmoPaypalCash = Helper::getUpdatedPayPalName($venmoPaypalCash);
            $brokerageAccount = ClientDocuments::getClientDocumentList($client_id, 'brokerage_account');
            $bankDocsBussinessKeys = ClientDocuments::bankDocsBussinessKeys($client_id);
        }


        $lifeInsuranceDocuments = ClientDocuments::getClientDocumentList($client_id, 'life_insurance');
        $retirement_pension = ClientDocuments::getClientDocumentList($client_id, 'retirement_pension');

        $documentTypes = ClientHelper::getUpdatedLabelName($debtorname, $spousename, $documentTypes, true);
        $rental_agreement = ClientDocuments::getClientDocumentList($client_id, 'rental_agreement');
        $vehicle_title = ClientDocuments::getClientDocumentList($client_id, 'vehicle_title');
        if ($is_car_title_enabled && !empty($vehicle_title)) {
            $attorneydocuments = array_merge($attorneydocuments, $vehicle_title);
        }
        if ($is_rental_agreement_enabled && !empty($rental_agreement)) {
            $attorneydocuments = array_merge($attorneydocuments, $rental_agreement);
        }
        $docsUploadInfo = ['venmoPaypalCash' => $venmoPaypalCash,'bankDocsBussinessKeys' => $bankDocsBussinessKeys, 'unpaid_wages' => $unpaid_wages, 'brokerageAccount' => $brokerageAccount, 'documentTypes' => $documentTypes, 'attorneydocuments' => $attorneydocuments, 'adminDocuments' => $adminDocuments, 'bankDocuments' => $bankDocuments, 'lifeInsuranceDocuments' => $lifeInsuranceDocuments, 'retirement_pension' => $retirement_pension, 'documentuploaded' => $documentuploaded, 'list' => $documentuploaded_list, 'hidebtn' => $hidebtn, 'client' => true];
        $notesCategories = \App\Models\AdminCommonNotesCategory::where("category", "!=", null)->orderBy('id', "asc")->select('id', 'category')->get()->toArray();
        $adminNotes = \App\Models\AdminNotes::where(['adm_id' => Helper::getCurrentAttorneyId(), 'client_id' => $client_id])->orderby('id', 'desc')->get();
        $adminNotes = !empty($adminNotes) ? $adminNotes->toArray() : [];

        $saveDocRoute = route('add_attorney_client_document');
        $notifyClientRoute = route('attorney_notify_client_for_docs');

        $attorneySettings = AttorneySettings::where($queryCondition)->select(['bank_statement_months'])->first();
        $bank_statement_months = !empty($attorneySettings) ? $attorneySettings->bank_statement_months : 3 ;


        $paypalVideos = [
            'iphone' => $this->getVideos(Helper::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE),
            'android' => $this->getVideos(Helper::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID),
            'desktop_laptop' => $this->getVideos(Helper::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE)
        ];
        $cashAppVideos = [
            'iphone' => $this->getVideos(Helper::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE),
            'android' => $this->getVideos(Helper::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID),
            'desktop_laptop' => $this->getVideos(Helper::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE),
        ];
        $venmoVideos = [
            'iphone' => $this->getVideos(Helper::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE),
            'android' => $this->getVideos(Helper::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID),
            'desktop_laptop' => $this->getVideos(Helper::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE)
        ];

        $debtorname = $debtorname."'s" ;
        $spousename = ($client->client_type == 2) ? "Non-Filing Spouse" : $spousename."'s" ;

        // Fetch specific columns for debtor income data
        $incomeData = CacheIncome::getIncomeData($client_id);

        $debtorIncomeTabData = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');
        $debtorIncomeTabData = User::getSelectedColumnsFromArray($debtorIncomeTabData, ['operation_business', 'profit_loss_business_name', 'profit_loss_business_name_2', 'profit_loss_business_name_3', 'profit_loss_business_name_4','profit_loss_business_name_5','profit_loss_business_name_6', 'income_profit_loss', 'income_profit_loss_2', 'income_profit_loss_3', 'income_profit_loss_4', 'income_profit_loss_5', 'income_profit_loss_6']);

        $spouseIncomeTabData = Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');
        $spouseIncomeTabData = User::getSelectedColumnsFromArray($spouseIncomeTabData, ['joints_operation_business', 'profit_loss_business_name', 'profit_loss_business_name_2', 'profit_loss_business_name_3', 'profit_loss_business_name_4','profit_loss_business_name_5','profit_loss_business_name_6', 'income_profit_loss', 'income_profit_loss_2', 'income_profit_loss_3', 'income_profit_loss_4', 'income_profit_loss_5', 'income_profit_loss_6']);

        $PlStatusDebtor = Helper::validate_key_value('operation_business', $debtorIncomeTabData, 'radio');
        $PlStatusSpouse = Helper::validate_key_value('joints_operation_business', $spouseIncomeTabData, 'radio');

        // Convert to arrays and process with `getIncomeDataArray()`
        $debtorIncomeTabData = ($debtorIncomeTabData && ($PlStatusDebtor == 1)) ? self::getBusinessAndPLDataArray($debtorIncomeTabData, $attProfitLossMonths) : [];
        $spouseIncomeTabData = ($spouseIncomeTabData && ($PlStatusSpouse == 1)) ? self::getBusinessAndPLDataArray($spouseIncomeTabData, $attProfitLossMonths) : [];

        $debtorBussinessData = $debtorIncomeTabData['businessData'] ?? [];
        $spouseBussinessData = $spouseIncomeTabData['businessData'] ?? [];
        $debtorPLData = $debtorIncomeTabData['plData'] ?? [];
        $spousePLData = $spouseIncomeTabData['plData'] ?? [];

        $reviwedData = \App\Models\ClientQuestionnaireReview::where('client_id', $client_id)->get();
        $reviwedData = !empty($reviwedData) ? $reviwedData->toArray() : [];

        $rwData = [];
        foreach ($reviwedData as $data) {
            $rwData[] = $data['reviewed_for'];
        }

        $vehicleRegisterationDocs = ClientHelper::getVehicleRegisterationDocs($client_id);
        $addCurrentMonthToDate = AttorneySettings::isCurrentPartialMonthEnabled($attorney_id);

        return view('admin.concierge_service_clients.documents_popup', ['addCurrentMonthToDate' => $addCurrentMonthToDate, 'vehicleRegisterationDocs' => $vehicleRegisterationDocs, 'attProfitLossMonths' => $attProfitLossMonths, 'rwData' => $rwData, 'debtorname' => $debtorname,'spousename' => $spousename,'debtorBussinessData' => $debtorBussinessData,'spouseBussinessData' => $spouseBussinessData,'debtorPLData' => $debtorPLData,'spousePLData' => $spousePLData,'unpaid_wages' => $unpaid_wages, 'notesCategories' => $notesCategories, 'bank_statement_months' => $bank_statement_months, 'adminNotes' => $adminNotes, 'saveDocRoute' => $saveDocRoute, 'notifyClientRoute' => $notifyClientRoute, 'attorney_id' => $attIdToReturn,'client' => $client,'client_id' => $client_id ,'docsUploadInfo' => $docsUploadInfo, 'paypalVideos' => $paypalVideos, 'cashAppVideos' => $cashAppVideos, 'venmoVideos' => $venmoVideos , 'unpaid_wages' => $unpaid_wages]);
    }

    public function translate_to_spanish(Request $request)
    {
        $textToTranslate = $request->input('text');
        $translateTo = $request->input('to');
        $translator = new GoogleTranslate($translateTo);
        $translatedText = $translator->translate($textToTranslate);

        return response()->json($translatedText);
    }

    private function getBusinessAndPLDataArray($incomeData, $attProfitLossMonths)
    {
        $bsName = [];
        $plData = [];
        foreach ($incomeData as $key => $value) {
            if (in_array($key, ['profit_loss_business_name', 'profit_loss_business_name_2', 'profit_loss_business_name_3', 'profit_loss_business_name_4','profit_loss_business_name_5','profit_loss_business_name_6',]) && !empty($value)) {
                $type = str_replace(" ", "_", $value);
                $type = Helper::validate_doc_type($value, true);
                $name = ucfirst($value);
                $bsName[$type] = $name;
            }
            if (in_array($key, ['income_profit_loss', 'income_profit_loss_2', 'income_profit_loss_3', 'income_profit_loss_4', 'income_profit_loss_5','income_profit_loss_6',])) {
                if (!empty($value) && is_array($value)) {
                    // Check if it is a single associative array
                    if (array_keys($value) !== range(0, count($value) - 1)) {
                        $PLType = Helper::validate_key_value("profit_loss_type", $value, "radio");
                        $PLMonth = Helper::validate_key_value("profit_loss_month", $value);
                        $lastSixMonth = DateTimeHelper::getFullMonthYearArrayForProfitLoss($attProfitLossMonths);
                        if (array_key_exists($PLMonth, $lastSixMonth)) {

                            $typePL = Helper::validate_key_value("name_of_business", $value);
                            $typePL = str_replace(" ", "_", $typePL);
                            $typePL = Helper::validate_doc_type($typePL, true);
                            $objectArray = [];
                            if ($PLType == 1) {
                                foreach ($lastSixMonth as $index => $Mname) {
                                    $value['profit_loss_month'] = $index;
                                    $objectArray[] = $value;
                                }
                            }
                            if ($PLType == 2) {
                                $objectArray[] = $value;
                            }
                            $plData[$typePL] = $objectArray;
                        }
                    } else {
                        $typePL = $value[0]['name_of_business'];
                        $typePL = str_replace(" ", "_", $typePL);
                        $typePL = Helper::validate_doc_type($typePL, true);
                        $plData[$typePL] = $value;
                    }
                }
            }
        }
        $object = ['businessData' => $bsName, 'plData' => $plData ];

        return $object;
    }

    private function getVideos($step)
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[$step] ?? [];

        return VideoHelper::getVideos($tutorial);
    }

    public function client_login($client_id)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request.');
        }
        $parentUserId = Auth::user()->id;
        Auth::loginUsingId($client_id);
        Session::put('refrence_parent', $parentUserId);
        Session::put('refrence_admin', null);

        return redirect()->route('client_dashboard')->with('success', 'You are Logged in into your client dashboard successfully');
    }

    public function add_attorney_client_document(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = Helper::validate_key_value('client_id', $input);
            $document_name = Helper::validate_key_value('admin_document', $input);
            $document_type = Helper::validate_doc_type(str_replace(' ', '_', $document_name), true);

            $existingDocument = \App\Models\AdminClientDocuments::where([ 'client_id' => $client_id, 'document_type' => $document_type ])->first();
            if ($existingDocument) {
                return response()->json(Helper::renderJsonError('" '.$document_name.' " document already exists for this client.'))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            $dataToSave = [
                'client_id' => $client_id,
                'document_name' => $document_name,
                'document_type' => $document_type,
                'added_by' => Helper::getCurrentAttorneyId(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            \App\Models\AdminClientDocuments::create($dataToSave);

            return response()->json(Helper::renderJsonSuccess("Document sucessfully added."))->header('Content-Type: application/json;', 'charset=utf-8');
        } else {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function attorney_notify_client_for_docs(Request $request)
    {
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                AdminClientRequestedDocuments::notifyClientForRequestedDocs($request->all(), Helper::getCurrentAttorneyId(), false);
                DB::commit();

                return response()->json(Helper::renderJsonSuccess("Notification sent successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json(Helper::renderJsonError("Something went wrong, try again."))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }

        return response()->json(Helper::renderJsonError("Invalid Request."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function download_transaction_pdf(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = $request->input('attorney_id');
        $index = $request->input('index');
        $date = date("m/d/Y");

        $user = User::whereId($client_id)->first();

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
        if ($user->client_type == 2) {
            $spousename = "Non-Filing Spouse";
        }

        $data = $user->getPropertyFinancialAssets(true, ['bank'])->toArray();
        $data = reset($data);

        $type_data = Helper::validate_key_value('type_data', $data);
        $type_data = !empty($type_data) ? json_decode($type_data, true) : [];

        $transaction_data = Helper::validate_key_value('transaction_data', $type_data);
        $transaction_data = Helper::validate_key_value($index, $transaction_data);

        $description = Helper::validate_key_value('description', $type_data);
        $description = Helper::validate_key_value($index, $description);

        $last_4_digits = Helper::validate_key_value('last_4_digits', $type_data);
        $last_4_digits = Helper::validate_key_value($index, $last_4_digits);

        $business_name = Helper::validate_key_value('business_name', $type_data);
        $business_name = Helper::validate_key_value($index, $business_name);

        $labelBank = $description;
        $labelBank = (isset($last_4_digits) && !empty($last_4_digits)) ? $labelBank.' ending with '.$last_4_digits : $labelBank ;
        $labelBank = (isset($business_name) && !empty($business_name)) ? $labelBank.' ('.($business_name).')' : $labelBank ;


        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attIdToReturn = $attorney_id;
        $is_associate = 0;

        if (!empty($ClientsAssociateId)) {
            $attorney_id = $ClientsAssociateId;
            $is_associate = 1;
        }


        $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $attorney_id, 'is_associate' => $is_associate, ])->select('transaction_pdf_signature_enabled')->first();
        $attorneySettings = (!empty($attorneySettings)) ? $attorneySettings->toArray() : [];
        $transaction_pdf_signature_enabled = Helper::validate_key_value('transaction_pdf_signature_enabled', $attorneySettings, 'radio');

        $company_logo = \App\Models\AttorneyCompany::where('attorney_id', $attIdToReturn)->select('company_logo')->first();
        $company_logo = (!empty($company_logo)) ? $company_logo->toArray() : [];
        $company_logo = Helper::validate_key_value('company_logo', $company_logo);
        $company_logo = empty($company_logo) ? '' : $company_logo;

        $pdf = PDF::loadView('attorney.form_elements.transactions_pdf', [
            'data' => $transaction_data, 'labelBank' => $labelBank, 'client_type' => $user->client_type, 'date' => $date,'debtorname' => $debtorname,'spousename' => $spousename,'transaction_pdf_signature_enabled' => $transaction_pdf_signature_enabled, 'company_logo' => $company_logo
        ]);

        return $pdf->download('transactions_pdf.pdf');
    }

    public function attorney_resend_reminder_popup(Request $request)
    {
        $client_id = $request->client_id;
        $reminder = ClientAppointmentReminder::where('client_id', $client_id)->first();
        $latestReminder = [
                "date" => "",
                "time" => "",
                "location" => ""
            ];
        if ($reminder) {
            $prevData = !empty($reminder->data) ? json_decode($reminder->data, true) : [];
            $prevData = is_array($prevData) ? $prevData : [];
            $latestReminder = end($prevData);
        }

        $start = new \DateTime('12:00 AM');
        $end = new \DateTime('11:55 PM');
        $interval = new \DateInterval('PT5M'); // 5 minutes
        $times = [];

        while ($start <= $end) {
            $times[] = $start->format('h:i A');
            $start->add($interval);
        }

        return view('attorney.attorney_resend_reminder_popup')
            ->with([
                'client_id' => $client_id,
                'times' => $times,
                'latestReminder' => $latestReminder,
            ]);
    }

    public function attorney_resend_reminder_send(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $date = $input['date'] ?? '';
            $time = $input['time'] ?? '';
            $location = $input['location'] ?? '';
            $client_id = $input['client_id'] ?? '';

            // Validate required fields
            if (empty($client_id)) {
                return redirect()->back()->with('error', 'Client ID is required.');
            }

            $client = User::where('id', $client_id)->select(['phone_no','name','email'])->first();

            // Validate user exists
            if (!$client) {
                return redirect()->back()->with('error', 'Client not found.');
            }

            if (!empty($client->email)) {
                Mail::to($client->email)->send(new ClientAppointmentReminderMail($client->name, $date, $time, $location));
            }
            if (!empty($client->phone_no)) {
                $msg_body = "Law firm appointment reminder: You have an appointment with your law firm for: Date:".$date." Time:".$time." Location:".$location;
                AddressHelper::sendSakariMobileTextMessage($client, $msg_body);
            }

            $newData = [
                    'date' => $date, 'time' => $time, 'location' => $location
                ];

            $reminder = ClientAppointmentReminder::where('client_id', $client_id)->first();
            $attorney_id = Helper::getCurrentAttorneyId();
            $dateTime = date("Y-m-d H:i:s");

            $reminder_time = $date . ' ' . $time;

            if ($reminder) {
                $prevData = !empty($reminder->data) ? json_decode($reminder->data, true) : [];
                $prevData = is_array($prevData) ? $prevData : [];
                $prevData[] = $newData;

                $reminder->update([
                    'added_by' => $attorney_id,
                    'data' => json_encode($prevData),
                    'last_send' => $dateTime,
                    'reminder_time' => $reminder_time,
                    'reminder_location' => $location,
                    'updated_at' => $dateTime,
                ]);
            } else {
                ClientAppointmentReminder::create([
                    'client_id' => $client_id,
                    'added_by' => $attorney_id,
                    'data' => json_encode([$newData]), // Wrap in array for consistency
                    'last_send' => $dateTime,
                    'reminder_time' => $reminder_time,
                    'reminder_location' => $location,
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ]);
            }

            return redirect()->back()->with('success', 'Appointment Reminder Sent.');
        }
    }

    public function client_password_reset_popup_by_attorney(Request $request)
    {
        $client_id = $request->client_id;
        $client = User::where('id', $client_id)->select(columns: ['name'])->first();

        $formLabel = $client->name ? "Reset Password - ".$client->name : "Reset Client Password";

        return view('modal.common.client_password_reset_popup')
            ->with([
                'client_id' => $client_id,
                'formRoute' => route('client_password_reset_save_by_attorney'),
                'formLabel' => $formLabel,
            ]);
    }

    public function client_password_reset_save_by_attorney(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = Helper::getCurrentAttorneyId();

        return User::client_password_reset_save($client_id, $attorney_id, $request);
    }
    public function send_paralegal_info_to_client_popup_by_attorney(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $paralegal_id = $request->input('paralegal_id');
        $data = ClientParalegal::get_paralegal_info_to_client_popup_data($client_id, $attorney_id, $paralegal_id, 'send_paralegal_info_to_client_by_attorney');

        return view(view: 'modal.common.client_paralegal_info_to_client_popup')
            ->with($data);
    }

    public function send_paralegal_info_to_client_by_attorney(Request $request)
    {
        return ClientParalegal::send_paralegal_info_to_client($request);
    }

}
