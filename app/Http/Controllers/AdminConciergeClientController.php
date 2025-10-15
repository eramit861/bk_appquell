<?php

namespace App\Http\Controllers;

use App\Helpers\AddressHelper;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Helpers\VideoHelper;
use App\Helpers\ClientHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConciergeClientActivate;
use App\Models\User;
use App\Traits\Common; // Trait
use App\Helpers\Helper as HelperAlias;
use App\Mail\ConciergeClientActivateToClient;
use App\Models\AdminClientRequestedDocuments;
use App\Models\AttorneySettings;
use App\Models\CalendlyWebhook;
use App\Models\ClientParalegal;
use App\Models\ClientsAssociate;
use App\Models\ClientSettings;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheIncome;
use Illuminate\Support\Facades\DB;

class AdminConciergeClientController extends Controller
{
    use Common;
    public function index(Request $request, $attorneyWise = 'all', $type = '2')
    {
        $attentionClientCount = 0;
        $newDocumentClientCount = 0;
        $unreadMessageCount = 0;
        $attorney = User::where(['role' => User::ATTORNEY, 'parent_attorney_id' => 0])->select('name', 'id')->orderBy('name', 'Asc')->get();
        $client = User::leftJoin('tbl_concierge_service_notes', 'users.id', '=', 'tbl_concierge_service_notes.client_id')
                        ->leftJoin('tbl_calendly_webhook', 'users.id', '=', 'tbl_calendly_webhook.client_id')
                        ->leftJoin('tbl_clients_attorney', 'users.id', '=', 'tbl_clients_attorney.client_id')
                        ->leftJoin('tbl_simpletext_message_webhook', 'users.id', '=', 'tbl_simpletext_message_webhook.client_id')
                        ->leftJoin('tbl_forms_steps_completed', 'users.id', '=', 'tbl_forms_steps_completed.client_id')
                        ->leftJoin('tbl_client_settings', 'users.id', '=', 'tbl_client_settings.client_id')
                        ->where(['users.role' => User::CLIENT, 'users.concierge_service' => 1])
                        ->select(
                            'tbl_clients_attorney.attorney_id as attorney_id',
                            'users.id as id',
                            'users.created_at as created_at',
                            'name',
                            'email',
                            'phone_no',
                            'users.last_login_at',
                            'client_payroll_assistant',
                            'client_subscription',
                            'client_type',
                            'petition_prepration_package',
                            'peralegal_check_package',
                            'client_bank_statements',
                            'client_profit_loss_assistant',
                            'concierge_service_status',
                            'concierge_service',
                            'note',
                            'case_submitted_to_attorney_on',
                            'disable_concierge_mail',
                            'in_queue',
                            'user_status',
                            'tbl_simpletext_message_webhook.seen_by_admin as seen_by_admin',
                            'tbl_simpletext_message_webhook.created_at as message_created_at',
                            'tbl_forms_steps_completed.request_edit_access',
                            'tbl_forms_steps_completed.request_edit_access_types',
                            'tbl_forms_steps_completed.request_edit_access_time',
                            'tbl_simpletext_message_webhook.json'
                        )
                        ->with(['ClientsAttorneybyclient','ClientsAttorneybyattorney','ClientsAttorneybyclient.getuserattorney', 'clientsSettings']);

        if (!empty($request->query('q'))) {
            $client->Where(function ($query) use ($request, $type) {
                $query->where('users.name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.email', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.phone_no', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.id', 'like', '%' . $request->query('q') . '%');
                if ($type == 6) {
                    $query->where('users.user_status', '=', Helper::INACTIVE);
                }
                if ($type != 6) {
                    $query->where('users.user_status', '=', Helper::ACTIVE);
                }
            });
        }

        if (!empty($request->query('attorney_wise'))) {
            $attorneyWise = $request->query('attorney_wise');
        }
        $queueClient = \App\Models\User::where('in_queue', '=', 1)->where('users.user_status', '=', Helper::ACTIVE)->leftJoin('tbl_clients_attorney', 'users.id', '=', 'tbl_clients_attorney.client_id');
        if ($attorneyWise != 'all') {
            $client->Where(function ($query) use ($attorneyWise) {
                $query->where('attorney_id', 'like', '%' . $attorneyWise . '%');
            });
            $queueClient->Where(function ($query) use ($attorneyWise) {
                $query->where('attorney_id', 'like', '%' . $attorneyWise . '%');
            });
        }

        $queueClientCount = $queueClient->groupBy('users.id')->get()->count();
        $unreadMessageCount = User::leftJoin('tbl_simpletext_message_webhook', 'users.id', '=', 'tbl_simpletext_message_webhook.client_id')
        ->where(['users.role' => User::CLIENT, 'users.concierge_service' => 1])
        ->where(['tbl_simpletext_message_webhook.seen_by_admin' => 0])->groupBy('users.id')->get()->count();


        if (empty($request->query('q')) && isset($type) && in_array($type, ["0","1",'2',"3","4","5","6","7","8"])) {
            $client->Where(function ($query) use ($type, $unreadMessageCount) {
                // for pending and dome
                if ($type == '0') {
                    $query->where(['users.logged_in_ever' => Helper::YES, 'users.concierge_service_status' => $type]);
                }
                if ($type == '1') {
                    $query->where(['users.concierge_service_status' => $type]);
                }
                // for new
                if ($type == '2') {
                    $query->Where(['users.logged_in_ever' => Helper::NO, 'users.concierge_service_status' => Helper::NO]);
                }
                if ($type == '3') {
                    $query->Where(['tbl_concierge_service_notes.note' => null]);
                    $query->Where(['tbl_calendly_webhook.client_id' => null]);
                    $query->Where(['users.logged_in_ever' => Helper::NO]);
                }
                if ($type == '4') {
                    $query->where(['users.in_queue' => 1]);
                }
                // for archived
                if ($type == '6') {
                    $query->Where('users.user_status', '=', Helper::INACTIVE);
                } else {
                    $query->Where('users.user_status', '=', Helper::ACTIVE);
                }
                // for text messages
                if ($type == '7' && $unreadMessageCount > 0) {
                    $query->where(['tbl_simpletext_message_webhook.seen_by_admin' => 0]);
                }
            });

            if ($type == 3) {
                $client->Where(['users.concierge_service_status' => Helper::NO]);
            }
            $notIn = ['document_sign','signed_document'];
            if ($type == 5) {
                $client->leftJoin('tbl_client_document_uploaded', 'users.id', '=', 'tbl_client_document_uploaded.client_id')
                    ->where(['tbl_client_document_uploaded.is_viewed_by_attorney' => 0])
                    ->whereNotIn('document_type', $notIn);
            }
            if ($type == 7 && $unreadMessageCount > 0) {
                $client->orderBy('tbl_simpletext_message_webhook.created_at', "DESC");
            }

            if ($type == 7 && $unreadMessageCount == 0) {
                $client->whereNotNull("tbl_simpletext_message_webhook.seen_by_admin")->whereNotNull("tbl_simpletext_message_webhook.json")->orderBy('tbl_simpletext_message_webhook.created_at', "DESC");
            }

            if ($type == 6) {
                $client->Where('users.user_status', '=', Helper::INACTIVE);
            } else {
                $client->Where('users.user_status', '=', Helper::ACTIVE);
            }

            // filed cases
            if ($type == '8') {
                $client->where(function ($q) {
                    $q->where(function ($subQ) {
                        $subQ->whereIn('is_case_filed', ['1']);
                    });
                });
                $client->orderByRaw("
                    CASE 
                        WHEN tbl_client_settings.case_filed_timestamp >= NOW() THEN 0 
                        ELSE 1 
                    END,
                    tbl_client_settings.case_filed_timestamp DESC
                ");
            } else {
                $client->where(function ($q) {
                    $q->whereNull('tbl_client_settings.is_case_filed')
                    ->orWhere('tbl_client_settings.is_case_filed', '!=', 1);
                });
            }

            $client->orderBy('users.id', 'DESC');
        }

        $client->groupBy('users.id');
        $client = $client->paginate(10);
        $attentionClientCount = User::leftJoin('tbl_concierge_service_notes', 'users.id', '=', 'tbl_concierge_service_notes.client_id')
        ->leftJoin('tbl_calendly_webhook', 'users.id', 'tbl_calendly_webhook.client_id')
        ->where(['users.role' => User::CLIENT, 'users.concierge_service' => 1])
        ->where(['users.concierge_service_status' => Helper::NO])
        ->where(['tbl_concierge_service_notes.note' => null])
        ->where(['tbl_calendly_webhook.client_id' => null])
        ->where(['users.logged_in_ever' => Helper::NO])
        ->groupBy('users.id')->get()->count();

        $keyword = $request->query('q') ?? '';
        $clients = [];
        $documentCompleteness = [];
        $newDocumentClientCount = [];
        $newDocUploaded = [];
        $notIn = ['document_sign','signed_document'];

        $clientIds = !empty($client) ? array_column($client->toArray()['data'], 'id') : [];

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

            $documentCompleteness[$val['id']] = ["notUploadedDocs" => [], "progress" => 0.0];
            if (isset($val['attorney_id']) && !empty($val['attorney_id'])) {
                $newDocUploaded[$val['id']] = 0;
            }
        }

        $isAnyClientWithNewDoc = User::leftJoin('tbl_client_document_uploaded', 'users.id', '=', 'tbl_client_document_uploaded.client_id')
        ->where(['tbl_client_document_uploaded.is_viewed_by_attorney' => 0])
        ->where(['users.role' => User::CLIENT, 'users.concierge_service' => 1])
        ->whereNotIn('document_type', $notIn)->groupBy('users.id')->get()->count();

        $fileCaseCount = User::getFiledCaseCountForAdmin($type);

        $jsonClientData = User::getClientManagementCommonDataNew($clientIds, $attorneyWise, true);

        return view('admin.concierge_service_clients.list', ['jsonClientData' => $jsonClientData, 'fileCaseCount' => $fileCaseCount, 'clientIds' => $clientIds, 'isAnyClientWithNewDoc' => $isAnyClientWithNewDoc,'newDocUploaded' => $newDocUploaded, 'unreadMessageCount' => $unreadMessageCount,'attentionClientCount' => $attentionClientCount, 'attorneyWise' => $attorneyWise, 'queueClientCount' => $queueClientCount, 'newDocumentClientCount' => $newDocumentClientCount, 'keyword' => $keyword,'client' => $client,'attorney' => $attorney, 'type' => $type,'client_percent' => $clients , 'documentCompleteness' => $documentCompleteness]);
    }

    public function admin_client_status(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = $this->getClientAttorneyId($client_id);
        $status = $request->input('status');
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if (!\App\Models\ClientsAttorney::where(['client_id' => $client_id, "attorney_id" => $attorney_id])->exists()) {
            return response()->json(Helper::renderJsonError('Invalid Request1'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        if (!in_array($status, [HelperAlias::ACTIVE, HelperAlias::INACTIVE])) {
            return response()->json(Helper::renderJsonError('Invalid Request2'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $newStatus = HelperAlias::ACTIVE;

        if ($status == HelperAlias::ACTIVE) {
            $newStatus = HelperAlias::INACTIVE;
        }

        $data = ['user_status' => $newStatus];

        User::where("id", $client_id)->update($data);

        return response()->json(Helper::renderJsonSuccess("Status updated successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    protected function getClientAttorneyId($client_id)
    {
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        $attorney_id = Auth::user()->id;
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }

        return $attorney_id;
    }

    public function activate(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = $request->input('attorney_id');
        $client = User::where(['role' => User::CLIENT, 'id' => $client_id])->select('name', 'email', 'phone_no', 'in_queue')->first();
        $attorney = User::where(['role' => User::ATTORNEY, 'id' => $attorney_id])->select('name', 'email')->first();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($client->in_queue == 1) {
            User::where("id", $client_id)->update(['concierge_service_status' => 1,'case_submitted_to_attorney_on' => date('Y-m-d H:i:s'), 'in_queue' => 0]);
        } else {
            User::where("id", $client_id)->update(['concierge_service_status' => 1,'case_submitted_to_attorney_on' => date('Y-m-d H:i:s')]);
        }
        \App\Models\FormsStepsCompleted::updateOrCreate(['client_id' => $client_id], ['client_id' => $client_id,'can_edit_basic_info' => '0','can_edit_property' => '0','can_edit_debts' => '0','can_edit_income' => '0','can_edit_expenase' => '0','can_edit_sofa' => '0']);

        // Clear tab edit permissions cache since permissions were updated
        Helper::clearTabEditCache($client_id);

        try {
            $mail = Helper::getAttorneyEmailArray($attorney_id);
            if (AttorneySettings::isEmailEnabled(1, 'attorney_concierge_client_activate_mail', '', true)) {
                Mail::to($mail)->send(
                    new ConciergeClientActivate($attorney->name, $client->name, $client_id)
                );
            }

            // Your case was submitted to the law firm;   Email to client
            $clientEmail = Helper::validate_key_value('email', $client);
            Mail::to($clientEmail)->send(new ConciergeClientActivateToClient());

            // Send message to client
            AddressHelper::sendSakariMobileTextMessage($client, 'Your case was submitted to the law firm');

        } catch (\Exception $e) {

        }

        return response()->json(Helper::renderJsonSuccess("Status updated successfully.", ['client_id' => $client_id]))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function mark_inprogress(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = $request->input('attorney_id');
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        User::where("id", $client_id)->update(['concierge_service_status' => 0]);


        return response()->json(Helper::renderJsonSuccess("Status updated successfully.", ['client_id' => $client_id]))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function add_remove_client_from_queue(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = $request->input('att_id');
        $status = $request->input('status');
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        User::where("id", $client_id)->update(['in_queue' => $status]);

        return response()->json(Helper::renderJsonSuccess("Record updated successfully.", ['client_id' => $client_id]))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function disable_client_concierge_mail(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = $request->input('att_id');
        $status = $request->input('status');
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        User::where("id", $client_id)->update(['disable_concierge_mail' => $status]);

        return response()->json(Helper::renderJsonSuccess("Record updated successfully.", ['client_id' => $client_id]))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function notes_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $notes = \App\Models\ConciergeServiceNotes::where('client_id', $client_id)->orderby('id', 'asc')->get();
        $notes = !empty($notes) ? $notes->toArray() : [];
        $notesCategories = \App\Models\AdminCommonNotesCategory::where("category", "!=", null)->orderBy('id', "asc")->select('id', 'category')->get()->toArray();

        return view('admin.concierge_service_clients.notes_popup', ['notesCategories' => $notesCategories,'is_print' => 0, 'notes' => $notes, 'client_id' => $client_id]);
    }

    public function edit_request_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $formstep = \App\Models\FormsStepsCompleted::where(['client_id' => $client_id])->first();

        $data = [
                    'isAdmin' => true,
                    'isAttorney' => false,
                    'formstep' => $formstep,
                    'client_id' => $client_id
                ];

        return view('admin.concierge_service_clients.edit_request_popup', $data);
    }

    public function update_notes(Request $request)
    {
        if ($request->isMethod('post')) {
            $attachment_file = '';
            $input = $request->all();
            if ($request->hasFile('attachment_file')) {
                $client_id = $input['client_id'];
                $store_path = "attorney_concierge_notes/" . $client_id . "/media";
                $path = public_path() . "/attorney_concierge_notes/" . $client_id . "/media";
                $this->checkOrCreateDir($path);
                $imageName = $request->attachment_file->getClientOriginalName();
                $imageName = str_replace(" ", "_", $imageName);
                $imageName = time() . '_' . $imageName;
                $mime_type = $request->attachment_file->getMimeType();
                $imageName = time() . '.' . $request->attachment_file->extension();
                $request->attachment_file->move($path, $imageName);
                $attachment_file = $store_path . '/' . $imageName;

            }
            $subject = $input['category'] ?? '';
            $textNote = $input['note'];
            \App\Models\ConciergeServiceNotes::Create(['client_id' => $input['client_id'], 'added_by_id' => Auth::user()->id,'attachment_file' => $attachment_file, 'subject' => $subject, 'note' => $textNote, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);

            return redirect()->back()->with('success', 'Record has been added successfully.');
        }
    }

    public function admin_notes_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $notes = \App\Models\AdminNotes::where(['adm_id' => Auth::user()->id, 'client_id' => $client_id])->orderby('id', 'desc')->get();
        $notes = !empty($notes) ? $notes->toArray() : [];

        return view('admin.concierge_service_clients.admin_notes_popup', [ 'notes' => $notes, 'client_id' => $client_id]);
    }

    public function admin_update_notes(Request $request)
    {
        $input = $request->all();
        \App\Models\AdminNotes::Create(['adm_id' => Auth::user()->id, 'client_id' => $input['client_id'], 'note' => $input['note'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);

        return redirect()->back()->with('success', 'Record has been added successfully.');
    }

    // after this

    public function documents_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $client = User::where('id', '=', $client_id)->first();
        $attorney_id = \App\Models\AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $is_associate = 0;

        if (!empty($ClientsAssociateId)) {
            $attorney_id = $ClientsAssociateId;
            $is_associate = 1;
        }

        $queryCondition = [ 'attorney_id' => $attorney_id, 'is_associate' => $is_associate ];

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

        $attorneydocuments = \App\Models\AttorneyDocuments::where($queryCondition)->pluck('document_name', 'document_type')->all();
        $adminDocuments = \App\Models\AdminClientDocuments::where(['client_id' => $client_id])->select('document_name', 'document_type')->get();

        $documentTypes = Helper::getDocuments($client->client_type, false, 1, 1, 0, 0, $attorney_id);
        $documentTypes = $documentTypes + Helper::getMiscDocs();
        $documentTypes = self::checkAndSetDefaultTypes($documentTypes, $documentuploaded, 0);
        $documentTypes = self::getDefaultAutoLoans($documentTypes, $documentuploaded, 0);

        $bankDocuments = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'bank');
        $venmoPaypalCash = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'venmo_paypal_cash');
        $venmoPaypalCash = Helper::getUpdatedPayPalName($venmoPaypalCash);
        $bankDocsBussinessKeys = \App\Models\ClientDocuments::bankDocsBussinessKeys($client_id);

        $brokerageAccount = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'brokerage_account');
        $lifeInsuranceDocuments = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'life_insurance');
        $retirement_pension = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'retirement_pension');



        $unpaid_wages = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'unpaid_wages');
        $unpaid_wages = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $unpaid_wages, true);

        $docsUploadInfo = ['bankDocsBussinessKeys' => $bankDocsBussinessKeys, 'unpaid_wages' => $unpaid_wages,'venmoPaypalCash' => $venmoPaypalCash,'brokerageAccount' => $brokerageAccount, 'lifeInsuranceDocuments' => $lifeInsuranceDocuments,'retirement_pension' => $retirement_pension,'bankDocuments' => $bankDocuments,'documentTypes' => $documentTypes, 'attorneydocuments' => $attorneydocuments, 'adminDocuments' => $adminDocuments, 'documentuploaded' => $documentuploaded, 'list' => $documentuploaded_list, 'hidebtn' => $hidebtn, 'client' => true];
        $notesCategories = \App\Models\AdminCommonNotesCategory::where("category", "!=", null)->orderBy('id', "asc")->select('id', 'category')->get()->toArray();
        $adminNotes = \App\Models\AdminNotes::where(['adm_id' => Auth::user()->id, 'client_id' => $client_id])->orderby('id', 'desc')->get();
        $adminNotes = !empty($adminNotes) ? $adminNotes->toArray() : [];
        //
        $saveDocRoute = route('add_admin_client_document');
        $notifyClientRoute = route('notify_client_for_docs');

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
        $debtorIncomeTabData = User::getSelectedColumnsFromArray($debtorIncomeTabData, ['operation_business', 'profit_loss_business_name', 'profit_loss_business_name_2', 'profit_loss_business_name_3', 'profit_loss_business_name_4','profit_loss_business_name_5','profit_loss_business_name_6', 'income_profit_loss', 'income_profit_loss_2', 'income_profit_loss_3', 'income_profit_loss_4','income_profit_loss_5','income_profit_loss_6']);

        $spouseIncomeTabData = Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');
        $spouseIncomeTabData = User::getSelectedColumnsFromArray($spouseIncomeTabData, ['joints_operation_business', 'profit_loss_business_name', 'profit_loss_business_name_2', 'profit_loss_business_name_3', 'profit_loss_business_name_4','profit_loss_business_name_5','profit_loss_business_name_6', 'income_profit_loss', 'income_profit_loss_2', 'income_profit_loss_3', 'income_profit_loss_4','income_profit_loss_5','income_profit_loss_6']);

        $PlStatusDebtor = Helper::validate_key_value('operation_business', $debtorIncomeTabData, 'radio');
        $PlStatusSpouse = Helper::validate_key_value('joints_operation_business', $spouseIncomeTabData, 'radio');

        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

        // Convert to arrays and process with `getIncomeDataArray()`
        $debtorIncomeTabData = ($debtorIncomeTabData && ($PlStatusDebtor == 1)) ? (new \App\Models\IncomeDebtorMonthlyIncome())->getBusinessAndPLDataArray($debtorIncomeTabData, $attProfitLossMonths) : [];
        $spouseIncomeTabData = ($spouseIncomeTabData && ($PlStatusSpouse == 1)) ? (new \App\Models\IncomeDebtorMonthlyIncome())->getBusinessAndPLDataArray($spouseIncomeTabData, $attProfitLossMonths) : [];

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

        return view('admin.concierge_service_clients.documents_popup', ['addCurrentMonthToDate' => $addCurrentMonthToDate, 'vehicleRegisterationDocs' => $vehicleRegisterationDocs, 'attProfitLossMonths' => $attProfitLossMonths, 'rwData' => $rwData, 'unpaid_wages' => $unpaid_wages, 'debtorname' => $debtorname,'spousename' => $spousename,'debtorBussinessData' => $debtorBussinessData,'spouseBussinessData' => $spouseBussinessData,'debtorPLData' => $debtorPLData,'spousePLData' => $spousePLData,'notesCategories' => $notesCategories,'bank_statement_months' => $bank_statement_months, 'adminNotes' => $adminNotes, 'saveDocRoute' => $saveDocRoute, 'notifyClientRoute' => $notifyClientRoute, 'attorney_id' => $attorney_id,'client' => $client,'client_id' => $client_id ,'docsUploadInfo' => $docsUploadInfo, 'paypalVideos' => $paypalVideos, 'cashAppVideos' => $cashAppVideos, 'venmoVideos' => $venmoVideos ]);
    }



    private function getVideos($step)
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[$step] ?? [];

        return VideoHelper::getVideos($tutorial);
    }

    public function getclendlywebhook($type = 'upcoming')
    {

        if ($type == 'upcoming') {
            $date = date("Y-m-d\TH:i:s\Z");
            $clandlywebhook = CalendlyWebhook::leftJoin(
                'users',
                'users.id',
                '=',
                'tbl_calendly_webhook.client_id'
            )->leftJoin(
                'tbl_clients_attorney',
                'tbl_clients_attorney.client_id',
                '=',
                'users.id'
            )->leftJoin(
                'users as attorney',
                'attorney.id',
                '=',
                'tbl_clients_attorney.attorney_id'
            )->select(['event_type','tbl_calendly_webhook.id','tbl_calendly_webhook.client_id','event_invitte_url','user_name','user_email','event_url','event_status','cancel_url','cancel_reason','cancel_created_at','canceled_by','rescheduled','reschedule_url','scheduled_event_name','scheduled_event_start_time','scheduled_event_end_time','event_read','attorney.name as attorney_name','users.phone_no'])->where('event_status', '=', 'active')->where('scheduled_event_end_time', '>=', $date)->where('scheduled_event_start_time', '!=', null)->orderby('tbl_calendly_webhook.scheduled_event_start_time', 'asc')->get();
        }
        if ($type == 'old') {
            $date = date("Y-m-d\TH:i:s\Z");
            $clandlywebhook = CalendlyWebhook::leftJoin(
                'users',
                'users.id',
                '=',
                'tbl_calendly_webhook.client_id'
            )->leftJoin(
                'tbl_clients_attorney',
                'tbl_clients_attorney.client_id',
                '=',
                'users.id'
            )->leftJoin(
                'users as attorney',
                'attorney.id',
                '=',
                'tbl_clients_attorney.attorney_id'
            )->select(['event_type','tbl_calendly_webhook.id','tbl_calendly_webhook.client_id','event_invitte_url','user_name','user_email','event_url','event_status','cancel_url','cancel_reason','cancel_created_at','canceled_by','rescheduled','reschedule_url','scheduled_event_name','scheduled_event_start_time','scheduled_event_end_time','event_read','attorney.name as attorney_name','users.phone_no'])->where('event_status', '=', 'active')->where('scheduled_event_end_time', '<', $date)->where('scheduled_event_start_time', '!=', null)->orderby('tbl_calendly_webhook.scheduled_event_start_time', 'desc')->get();
        }

        !empty($clandlywebhook) ? $clandlywebhook->toArray() : [];
        CalendlyWebhook::where(['event_read' => 0])->update(['event_read' => 1]);

        return view('admin.concierge_service_clients.clendly_webhook', ['type' => $type, 'list' => $clandlywebhook]);
    }

    public function notify_client_for_docs(Request $request)
    {
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                AdminClientRequestedDocuments::notifyClientForRequestedDocs($request->all(), Auth::user()->id, true);
                DB::commit();

                return response()->json(Helper::renderJsonSuccess("Notification sent successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json(Helper::renderJsonError("Something went wrong, try again."))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }

        return response()->json(Helper::renderJsonError("Invalid Request."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function add_admin_client_document(Request $request)
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
                'added_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            \App\Models\AdminClientDocuments::create($dataToSave);

            return response()->json(Helper::renderJsonSuccess("Document sucessfully added."))->header('Content-Type: application/json;', 'charset=utf-8');
        } else {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function fix_doc_type_for_requested_docs()
    {
        $attorneyDocs = \App\Models\AttorneyDocuments::select(['document_name'])->get()->toArray();
        foreach ($attorneyDocs as $doc) {
            $docType = Helper::validate_doc_type($doc['document_name']);
            \App\Models\AttorneyDocuments::where(['document_name' => $doc['document_name']])->update(['document_type' => $docType]);
            \App\Models\ClientDocumentUploaded::where(['document_type' => $doc['document_name']])->update(['document_type' => $docType]);
        }
    }

    public function send_paralegal_info_to_client_popup_by_admin(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = $this->getClientAttorneyId($client_id);
        $paralegal_id = $request->input('paralegal_id');
        $data = ClientParalegal::get_paralegal_info_to_client_popup_data($client_id, $attorney_id, $paralegal_id, 'send_paralegal_info_to_client_by_admin');

        return view('modal.common.client_paralegal_info_to_client_popup')
            ->with($data);
    }

    public function send_paralegal_info_to_client_by_admin(Request $request)
    {
        return ClientParalegal::send_paralegal_info_to_client($request);
    }
    public function adminChangeCaseFiledPreviewPopup(Request $request)
    {
        $returnHTML = ClientSettings::getCaseFiledPopupReturnHTML($request, 'admin_client_case_filed', true, 'admin_client_case_filed_not_available');

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function adminChangeCaseFiledPopup(Request $request)
    {
        $returnHTML = ClientSettings::getCaseFiledPopupReturnHTML($request, 'admin_client_case_filed', false, 'admin_client_case_filed_not_available');

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function adminChangeCaseFiled(Request $request)
    {
        $client_id = $request->input('client_id', '');
        $attorney_id = self::getClientAttorneyId($client_id);
        $caseNo = $request->input('caseNo', '');
        $caseInfo = $request->input('caseInfo', '');
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->back()->with('error', 'Invalid Request');
        }
        DB::beginTransaction();
        try {
            ClientSettings::updateCaseFiledStatus($request);
            if (!empty($caseInfo) && !empty($caseNo)) {
                ClientSettings::sendStatusMailAndText($request);
            }
            DB::commit();

            return redirect()->back()->with('success', 'Case Filed status updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Invalid Request '.$e->getMessage());
        }
    }

    public function adminChangeCaseFiledNotAvailable(Request $request)
    {
        $client_id = $request->input('client_id', '');
        $attorney_id = self::getClientAttorneyId($client_id);
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->back()->with('error', 'Invalid Request');
        }
        DB::beginTransaction();
        try {
            ClientSettings::updateCaseFiledNotAvailableStatus($request);
            DB::commit();

            return redirect()->back()->with('success', 'Case Filed Not Available status updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Invalid Request '.$e->getMessage());
        }
    }


}
