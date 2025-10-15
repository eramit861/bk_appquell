<?php

namespace App\Http\Controllers\Attorney;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\AttorneyController;
use App\Models\ClientDocumentUploaded;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helpers\VideoHelper;
use App\Helpers\DocumentHelper;
use App\Models\AttorneyDocuments;
use App\Models\AttorneyCommonDocuments;
use App\Models\AttorneyExcludeDocs;
use App\Models\AttorneySettings;
use App\Models\User;
use App\Traits\Common;
use App\Models\ClientDocuments;
use App\Models\DocumentUploadedData;
use App\Models\PayStubs;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AttorneyDocumentController extends AttorneyController
{
    use Common;

    private $aiReports = [
        ClientDocumentUploaded::DEBTOR_CREDITOR_REPORT,
        ClientDocumentUploaded::CO_DEBTOR_CREDITOR_REPORT
    ];
    private $aiPayStubs = [
      ClientDocumentUploaded::DEBTOR_PAY_STUB,
      ClientDocumentUploaded::CO_DEBTOR_PAY_STUB
    ];

    public static function update_viewed_by_attorney(Request $request)
    {
        if ($request->isMethod('post')) {
            $client_id = $request->client_id;
            $indocType = ClientDocumentUploaded::getCardTypeArray();
            $indocType = array_merge($indocType, array_keys(\App\Models\ClientDocumentUploaded::getAutoloanKeyValue(1)));
            $indocType = array_merge($indocType, array_keys(\App\Models\ClientDocumentUploaded::getResidenceKeyValue(1)));
            ClientDocumentUploaded::where("client_id", $client_id)->whereIn('document_type', $indocType)->update(['is_viewed_by_attorney' => 1]);

            return response()->json(Helper::renderJsonSuccess("Success"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function retainer_document(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        $this->validate($request, [
            'retainer_document' => 'required|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
        ], [
            'retainer_document.required' => 'Please select the document file. File size must below 2 mb.',
        ]);
        $retainer_document = "";
        if ($request->hasFile('retainer_document')) {
            $store_path = "attorney/" . $attorney_id . "/documents";
            $path = public_path() . "/attorney/" . $attorney_id . "/documents";
            $this->checkOrCreateDir($path);
            $imageName = time() . '.' . $request->retainer_document->extension();
            $request->retainer_document->move($path, $imageName);
            $retainer_document = $store_path . '/' . $imageName;
        }

        $retainer_document_info = [
            'retainer_document' => $retainer_document,
            'attorney_id' => $attorney_id
        ];

        if (!empty($request->document_id)) {
            \App\Models\RetainerDocuments::where('id', $request->document_id)->update($retainer_document_info);
        } else {
            \App\Models\RetainerDocuments::create($retainer_document_info);
        }

        return redirect()->route('attorney_profile', ['tab' => 4])->with('success', 'Document has been uploaded successfully.');
    }

    public function delete_signed_document($client_id, $filepath)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        $store_path = "attorney/" . $attorney_id . "/signed_document/" . $client_id;
        $path = $store_path . '/' . $filepath;
        Storage::disk('s3')->delete($path);

        return redirect()->route('attorney_signed_doc', $client_id)->with('success', 'Document has been deleted successfully.');
    }

    public function signed_document($id)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($id, $attorney_id)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        $client = \App\Models\User::find($id);
        $editable = \App\Models\FormsStepsCompleted::select('can_edit')->where('client_id', $id)->first();
        $total = $this->getClientCompletedStepsCount($id);

        $client_path_pre = "/client/" . $client->id . "/signed_document";
        $clientfiles = Storage::disk('s3')->files($client_path_pre);
        $clientlistOfFiles = $this->getFilesArrayFromPath($clientfiles);

        $path_pre = "/attorney/" . $attorney_id . "/signed_document/" . $client->id;
        $files = Storage::disk('s3')->files($path_pre);

        $listOfFiles = $this->getFilesArrayFromPath($files);
        $listOfFiles = $this->addClientViewStat($listOfFiles, $id);

        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_SEND_RECEIVE_SIGNED_DOC_VIDEO);
        \App\Models\SignedDocuments::where(['client_id' => $id])->update(['read_by_attorney' => 1]);
        $dateFormate = 'M d, y H:i';
        $clientDocs = ClientDocumentUploaded::where(['client_id' => $id, 'document_type' => 'signed_document'])->get();
        $payStubAIStatus = PayStubs::getAIStatusBasedArray($id);

        return view('attorney.signed_document', ['payStubAIStatus' => $payStubAIStatus,'clientDocs' => $clientDocs, 'dateFormate' => $dateFormate, 'video' => $video, 'uploadedFiles' => $listOfFiles, 'client_doc_list' => $clientlistOfFiles,  'attorney_id' => $attorney_id, 'client_id' => $id, 'User' => $client, 'editable' => (isset($editable->can_edit) ? $editable->can_edit : 0), 'type' => 'signed', 'totals' => $total]);
    }

    private function addClientViewStat($list, $client_id)
    {
        if (!empty($list)) {

            $docStats = \App\Models\AttorneyClientDocumentStats::where(["client_id" => $client_id])->select(['file', 'viewed_at'])->get();
            $docStats = (isset($docStats) && !empty($docStats)) ? $docStats->toArray() : [];

            $updatedList = [];
            $docStatsMap = [];
            foreach ($docStats as $stat) {
                $docStatsMap[$stat['file']] = $stat['viewed_at'];
            }

            foreach ($list as $doc) {
                if (isset($docStatsMap[$doc['path']])) {
                    $doc['viewed_at'] = $docStatsMap[$doc['path']];
                } else {
                    $doc['viewed_at'] = '';
                }
                $updatedList[] = $doc;
            }

            return $updatedList;
        }

        return $list;
    }

    public function save_signed_document(Request $request, $id)
    {
        $attorney_id = \App\Models\ClientSettings::getClientAttorneyId($id);
        $client = \App\Models\User::find($id);

        if (!$client) {
            return response()->json(Helper::renderJsonError('Client not found.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        if (!$request->isMethod('post')) {
            return redirect()->route('attorney_signed_doc', $client->id)->with('error', 'Invalid request.');
        }

        // Send push notifications


        if (!$request->hasFile('document_file')) {
            return response()->json(Helper::renderJsonError('Document is Required.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $files = $request->file('document_file');
        $allowedfileExtension = ArrayHelper::getAllowedFileExtensionArray();
        $store_path = "attorney/{$attorney_id}/signed_document/{$client->id}";

        \DB::beginTransaction();
        try {
            foreach ($files as $file) {
                $errors = DocumentHelper::validateFile($file);
                if (!empty($errors)) {
                    \DB::rollBack();

                    return response()->json(Helper::renderJsonError(json_encode($errors)))->header('Content-Type: application/json;', 'charset=utf-8');
                }

                $extension_from_mime_type = DocumentHelper::getExtensionFromMimeType($file->getMimeType());
                $extension = $file->getClientOriginalExtension() ?: $extension_from_mime_type;
                $origName = $file->getClientOriginalName();
                $baseName = pathinfo($origName, PATHINFO_FILENAME);
                $imageName = Helper::validate_doc_type($baseName);
                $updatedImageName = time() . '_' . $imageName;
                $finalFileName = $updatedImageName . '.pdf';

                // Convert and store file as PDF if needed
                if (in_array(strtolower($extension), $allowedfileExtension)) {
                    $origionalName = DocumentHelper::hasExtension($origName) ? $origName : $origName . '.' . $extension;
                    ClientDocumentUploaded::convertImageToPDF($client->id, $file, $updatedImageName, $origionalName, $extension, '', false, $store_path);
                } else {
                    Storage::disk('s3')->putFileAs($store_path, $file, $finalFileName);
                }

                // Save document record
                $data = [
                    'attorney_id' => $attorney_id,
                    'client_id' => $client->id,
                    'sign_document' => $store_path . '/' . $finalFileName,
                    'is_sent' => 1,
                ];
                \App\Models\SignedDocuments::updateOrCreate(
                    ['attorney_id' => $attorney_id, 'client_id' => $client->id, 'sign_document' => $data['sign_document']],
                    $data
                );
            }

            // Send Push notification
            $message = "GREAT NEWS, {$client->name}\nYou have received documents for your review and signatures from your attorney.";
            $message_title = "Signed Document";
            $icon = false;
            $self_web_url = "#";
            $device_token = $client->device_token;
            $device_type = $client->device_type;

            if ($device_type === 'Ios' && strlen($device_token) > 20) {
                $this->send_iphone_notification($device_token, $message_title, $message, "New Message Notification", 1);
            } elseif ($device_type === 'Android' && strlen($device_token) > 20) {
                $this->send_android_notification_new($device_token, $message_title, $message, "New Message Notification", 1);
            } elseif ($device_type === 'Web' && strlen($device_token) > 20) {
                $this->send_web_push_notification($device_token, $message, $message_title, $icon, $self_web_url);
            }
            // Send email notification
            $attorney = \App\Models\User::with('attorneyCompany')->find($attorney_id);
            if (!empty($client->email)) {
                try {
                    $attorney_name = $attorney ? $attorney->name : '';
                    if (AttorneySettings::isEmailEnabled($attorney_id, 'client_signed_doc_sent_mail', $id)) {
                        Mail::to($client->email)->send(new \App\Mail\SignedDocument($client, $attorney_name, $attorney));
                    }
                } catch (\Exception $error) {
                    Log::error('Attorney Sign doc upload error', [
                        'client_id' => $client->id,
                        'error' => $error,
                        'trace' => $error->getTraceAsString(),
                        'timestamp' => now()->toIso8601String()
                    ]);
                    \DB::rollBack();

                    return response()->json(Helper::renderJsonError($error->getMessage()))->header('Content-Type: application/json;', 'charset=utf-8');
                }
            }

            \DB::commit();

            return response()->json(Helper::renderJsonSuccess('Document has been uploaded successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            \DB::rollBack();
            Log::error('Error in save_signed_document: ' . $e->getMessage(), [
                'exception' => $e,
                'client_id' => $id,
                'request' => $request->all()
            ]);

            return response()->json(Helper::renderJsonError($e->getMessage()))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function manage_document(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        if ($request->isMethod('post')) {
            $input = $request->all();

            $is_associate = Helper::validate_key_value('is_associate', $input, 'radio');
            $associate_id = Helper::validate_key_value('associate_id', $input, 'radio');

            unset($input['associate_id']);
            $attorney_id = $is_associate ? $associate_id : $attorney_id;
            $input['is_associate'] = $is_associate;
            $input['attorney_id'] = $attorney_id;
            $input['document_name'] = $input['document_name'];
            $input['document_type'] = Helper::validate_doc_type($input['document_name'], true);
            if (empty($input['document_name'])) {
                return ($is_associate)
                    ? redirect()->route('attorney_lawfirm_settings', ['associate_id' => $attorney_id])->with("error", 'Document name must have atleast 1 alphabets')
                    : redirect()->route('attorney_settings')->with("error", 'Document name must have atleast 1 alphabets');
            }
            AttorneyDocuments::create($input);

            return ($is_associate)
                ? redirect()->route('attorney_lawfirm_settings', ['associate_id' => $attorney_id, 'type' => 1])->with('success', 'Document has been added successfully.')
                : redirect()->route('attorney_settings', ['type' => 1])->with('success', 'Document has been added successfully.');
        }

        $documents = AttorneyDocuments::where(['attorney_id' => $attorney_id, 'is_associate' => 0])->where('document_type', '!=', 'Pre_Filing_Bankruptcy_Certificate_CCC');

        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'desc');
        $documents = $documents->orderBy($sortBy, $sortOrder);

        $perPage = $request->input('per_page', 10);
        $documents = $documents->paginate($perPage)->appends([
            'per_page' => $perPage,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ]);

        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_ADDITIOANL_DOCUMENT_UPLOAD);
        $exlude = \App\Models\AttorneyExcludeDocs::where(['attorney_id' => $attorney_id, 'is_associate' => 0])->select('doc_type_json')->first();
        $exclude = !empty($exlude) ? $exlude['doc_type_json'] : '';
        if (!empty($exclude)) {
            $exclude = json_decode($exclude, 1);
        }
        $certificateenable = AttorneyDocuments::where(['attorney_id' => $attorney_id, 'is_associate' => 0])->where('document_type', '=', 'Pre_Filing_Bankruptcy_Certificate_CCC')->first();


        $commonDocuments = AttorneyCommonDocuments::where(['attorney_id' => $attorney_id, 'is_associate' => 0]);
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'desc');
        $commonDocuments = $commonDocuments->orderBy($sortBy, $sortOrder);
        $perPage = $request->input('per_page', 10);
        $commonDocuments = $commonDocuments->paginate($perPage)->appends([
            'per_page' => $perPage,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ]);

        $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $attorney_id, 'is_associate' => 0])
                            ->select(['bank_statement_months',
                            'attorney_enabled_bank_statment',
                            'counseling_agency',
                            'counseling_agency_site',
                            'attorney_code','profit_loss_months'])->first();

        return view('attorney.document_management', ['commonDocuments' => $commonDocuments, 'delete_route' => route("attorney_client_delete_documents"), 'per_page' => $perPage,'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'exclude_docs' => $exclude, 'video' => $video, 'documents' => $documents, 'attorneySettings' => $attorneySettings,'certificateenable' => $certificateenable]);
    }

    public function manage_document_edit(Request $request)
    {
        if ($request->isMethod('post')) {
            $attorney_id = Helper::getCurrentAttorneyId();
            $input = $request->all();
            $input['attorney_id'] = $attorney_id;
            $document_id = $input['document_id'];

            $is_associate = Helper::validate_key_value('is_associate', $input, 'radio');
            $associate_id = Helper::validate_key_value('associate_id', $input, 'radio');

            unset($input['document_id'], $input['_token'], $input['associate_id']);
            $input['document_name'] = $input['document_name'];
            $input['document_type'] = Helper::validate_doc_type($input['document_name']);
            if (empty($input['document_name'])) {
                return redirect()->route('attorney_settings')->with('error', 'Document name must have atleast 1 alphabets.');
            }
            AttorneyDocuments::where(['id' => $document_id])->update($input);

            return ($is_associate)
                ? redirect()->route('attorney_lawfirm_settings', ['associate_id' => $associate_id, 'type' => 1])->with('success', 'Document has been updated successfully.')
                : redirect()->route('attorney_settings', ['type' => 1])->with('success', 'Document has been updated successfully.');
        }
    }

    public function setup_attorney_certificate_ccc(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate(
                [
                    'counseling_agency' => 'required|min:1',
                    'counseling_agency_site' => 'required',
                    // 'attorney_code' => 'required',
                ],
            );

            $input = $request->all();

            $is_associate = Helper::validate_key_value('is_associate', $input, 'radio');
            $associate_id = Helper::validate_key_value('associate_id', $input, 'radio');

            $attorneyId = $is_associate ? $associate_id : Helper::getCurrentAttorneyId();
            $timestamp = now();
            $attorneySettings = AttorneySettings::where([ "attorney_id" => $attorneyId, 'is_associate' => $is_associate ])->first();
            if ($attorneySettings) {
                $attorneySettings->update([
                    'counseling_agency' => $request->counseling_agency,
                    'counseling_agency_site' => $request->counseling_agency_site,
                    'attorney_code' => $request->attorney_code,
                    'updated_at' => $timestamp,
                    'is_associate' => $is_associate,
                ]);
            } else {
                AttorneySettings::create(
                    [
                        'attorney_id' => $attorneyId,
                        'counseling_agency' => $request->counseling_agency,
                        'counseling_agency_site' => $request->counseling_agency_site,
                        'attorney_code' => $request->attorney_code,
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                        'is_associate' => $is_associate,
                    ]
                );
            }
            // remove from excluded docs
            self::update_attorney_exclude_docs($attorneyId, "add", "Pre_Filing_Bankruptcy_Certificate_CCC", $input);

            // add in att docs
            AttorneyDocuments::updateOrCreate(
                [
                        'attorney_id' => $attorneyId,
                        'document_type' => 'Pre_Filing_Bankruptcy_Certificate_CCC',
                        'is_associate' => $is_associate
                    ],
                [
                        'attorney_id' => $attorneyId,
                        'document_name' => 'Pre-Filing Bankruptcy Certificate(s) '.$request->counseling_agency,
                        'document_type' => 'Pre_Filing_Bankruptcy_Certificate_CCC',
                        'created_on' => $timestamp,
                        'updated_on' => $timestamp,
                        'is_associate' => $is_associate,
                    ]
            );


            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');

        }
    }

    public function attorney_exclude_docs(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $attorney_id = Helper::getCurrentAttorneyId();
            $postedDocType = $input['doc_type'];
            $action_type = $input['type'];

            self::update_attorney_exclude_docs($attorney_id, $action_type, $postedDocType, $input);

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public static function update_attorney_exclude_docs($attorney_id, $action_type, $postedDocType, $input)
    {

        $is_associate = Helper::validate_key_value('is_associate', $input, 'radio');
        $associate_id = Helper::validate_key_value('associate_id', $input, 'radio');

        $attorney_id = $is_associate ? $associate_id : $attorney_id;
        $excludedocs = AttorneyExcludeDocs::where([ "attorney_id" => $attorney_id, 'is_associate' => $is_associate ])->first();

        $residentKeysToExclude = Helper::DEBTOR_RESIDENTARRAY;
        $vehicleKeysToExclude = Helper::CODEBTOR_VEHICLEARRAY;

        $excludedocs = !empty(json_decode($excludedocs)) && !empty($excludedocs->doc_type_json) ? array_values(json_decode($excludedocs->doc_type_json, 1)) : [];
        if ($action_type == 'remove') {

            $excludedocs[] = $postedDocType;
            if ($postedDocType == "Current_Mortgage_Statement") {
                $excludedocs = array_merge($excludedocs, $residentKeysToExclude);
            }
            if ($postedDocType == "Current_Auto_Loan_Statement") {
                $excludedocs = array_merge($excludedocs, $vehicleKeysToExclude);
            }
            if ($postedDocType == "Pre_Filing_Bankruptcy_Certificate_CCC") {
                // remove from att docs
                AttorneyDocuments::where(
                    [
                        'attorney_id' => $attorney_id,
                        'document_type' => 'Pre_Filing_Bankruptcy_Certificate_CCC',
                        'is_associate' => $is_associate,
                    ]
                )->delete();
            }
        }


        if ($action_type == 'add') {
            $arrayKeysToRemove[] = $postedDocType;
            if ($postedDocType == "Current_Mortgage_Statement") {
                foreach ($residentKeysToExclude as $value) {
                    $arrayKeysToRemove[] = $value;
                }
            }
            if ($postedDocType == "Current_Auto_Loan_Statement") {
                foreach ($vehicleKeysToExclude as $value) {
                    $arrayKeysToRemove[] = $value;
                }
            }
            $excludedocs = array_values(array_diff($excludedocs, $arrayKeysToRemove));
        }


        $excludedocs = array_unique($excludedocs);

        $data['attorney_id'] = $attorney_id;
        $data['is_associate'] = $is_associate;
        $data['doc_type_json'] = json_encode($excludedocs);
        $data['updated_at'] = date('Y-m-d H:i:s');

        AttorneyExcludeDocs::updateOrCreate([ "attorney_id" => $attorney_id, 'is_associate' => $is_associate ], $data);
    }

    public function upload_client_date(Request $request, $clientIddeomUrl = null)
    {


        if ($request->isMethod('post')) {
            Log::info("upload_client_date request object");
            $input = $request->all();
            $attorney_id = Helper::getCurrentAttorneyId();
            $client_id = $request->client_id ?? $clientIddeomUrl;
            if (empty($client_id)) {
                return response()->json(Helper::renderJsonError("Client ID is required."))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $selectedDocToMoveId = Helper::validate_key_value('selectedDocToMove', $input, 'radio');
            if (!empty($selectedDocToMoveId)) {
                $updatedImageName = ClientDocumentUploaded::where('id', $selectedDocToMoveId)->select('updated_name')->first();
                PayStubs::dummyPaystubEntry($input, $selectedDocToMoveId, Helper::validate_key_value('updated_name', $updatedImageName));

                return response()->json(Helper::renderJsonSuccess('Document has been assisgned successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            if ($request->hasFile('document_file')) {
                $files = $request->file('document_file');
                $bankDocsArray = ClientDocuments::getAllBankDocumentKeysList($client_id);
                if (in_array($request->document_type, $bankDocsArray)) {
                    $files = ClientDocumentUploaded::updateBankFilesNames($request->all(), $client_id);
                }
                $successMsg = 'Document has been uploaded successfully.';
                $i = 0;
                foreach ($files as $file) {
                    $erros = DocumentHelper::validateFile($file);
                    if (!empty($erros)) {
                        return response()->json(Helper::renderJsonError(json_encode($erros)))->header('Content-Type: application/json;', 'charset=utf-8');
                    }
                    $imageName = $file->getClientOriginalName();
                    $document_type = $request->document_type;
                    $extension_from_mime_type = DocumentHelper::getExtensionFromMimeType($file->getMimeType());
                    $extension = !empty($file->getClientOriginalExtension()) ? $file->getClientOriginalExtension() : $extension_from_mime_type;

                    $updatedImageName = '';
                    $imageName = str_replace($extension, "", $imageName);
                    $updatedImageName = Helper::validate_doc_type($imageName);

                    $document_month = null;
                    $statement_month = Helper::validate_key_value('statement_month', $input);
                    if (!empty($statement_month)) {
                        $document_month = Helper::validate_key_value($i, $statement_month);
                    }

                    $document_paystub_date = $request->paystub_date ?? null;
                    if (!empty($document_paystub_date)) {
                        $document_paystub_date = Helper::validate_key_value($i, $document_paystub_date);
                        $document_paystub_date = str_replace('/', '.', $document_paystub_date);
                        $updatedImageName = $document_paystub_date;
                    }

                    $selected_debtor = '';
                    $selected_debtor = $request->debtor_select ?? '';
                    $selected_debtor = Helper::validate_key_value($i, $selected_debtor);
                    if (!empty($selected_debtor)) {
                        $updatedImageName = $selected_debtor . ' '. $updatedImageName;
                        $updatedImageName = Helper::validate_doc_type($updatedImageName);
                    }
                    $docId = ClientDocumentUploaded::storeClientSideDocument($client_id, $file, $document_type, $imageName, 1, ClientDocumentUploaded::STATUS_PENDING, $extension, false, $document_month, $document_paystub_date, $selected_debtor);

                    if (is_array(($docId)) && isset($docId['status']) && $docId['status'] == false) {
                        return response()->json(Helper::renderJsonError($docId['message']))->header('Content-Type: application/json;', 'charset=utf-8');
                    }

                    $employer_id = null;
                    if (in_array($document_type, $this->aiPayStubs) || (in_array($document_type, $this->aiReports) && \App\Models\User::isCreditReportEnabledForClient($client_id, $document_type))) {
                        if (in_array($request->document_type, $this->aiPayStubs)) {
                            $employer_id = self::getEmployerIdfromrequest($input, $i);
                            if (empty($employer_id)) {
                                return response()->json(Helper::renderJsonError('Employer id is required'))->header('Content-Type: application/json;', 'charset=utf-8');
                            }
                        }
                        $pdfToJson = new \App\Models\PdfToJson();
                        $resData = $pdfToJson->uploadFileToGraphQl($client_id, $file, $document_type, $docId, $employer_id);
                        if (isset($resData['data']['scrapeDocument']['success']) && $resData['data']['scrapeDocument']['success'] == 1) {
                            $successMsg = 'Document has been uploaded successfully. The Magic takes some time. We will notify you when its done.';
                        }
                        Log::info('uploaded file from attorney side response: '.$document_type.'=' . json_encode($resData));
                    }

                    if (in_array($request->document_type, $this->aiPayStubs)) {
                        PayStubs::dummyPaystubEntry($input, $docId, $updatedImageName, $i);
                    }
                    $i++;
                }
                ClientDocumentUploaded::clearTempDirs($client_id);

                return response()->json(Helper::renderJsonSuccess($successMsg))->header('Content-Type: application/json;', 'charset=utf-8');
            } else {
                // If file size exceeds PHP's post_max_size or upload_max_filesize,
                // PHP will not populate $_FILES and Laravel's $request->hasFile() will return false.
                // So, for a 56MB file, this else block is triggered because the file is too large.
                return response()->json(Helper::renderJsonError("Document file is required or file size exceeds the server limit."))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        } else {
            return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public static function getUpdatedDocViewHTML(Request $request)
    {
        $isAttorneyDocPage = $request->input('isAttorneyDocPage', '');
        $parentKey = $request->input('parentKey', '');
        if ($isAttorneyDocPage === 'true' && !empty($parentKey)) {
            $employer_id = $request->input('employer_id', '');
            $attorney_id = Helper::getCurrentAttorneyId();

            $input = $request->all();
            $client_id = $input['client_id'];
            $user = User::whereId($client_id)->first();
            $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();

            if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
                $attorney_id = $attorney->attorney_id;
            }

            $ajaxData = DocumentUploadedData::getDocumentScreenAjaxData($parentKey, $user, $attorney_id, $request->document_type, $employer_id);
            $mainDocumentTypeStructure = Helper::validate_key_value('mainDocumentTypeStructure', $ajaxData, 'array');
            $documentMoveToList = json_decode($request->input('documentMoveToList', ''), true);
            $allDocNames = Helper::validate_key_value('allDocNames', $ajaxData, 'array');
            $renderData = [
                'key' => $parentKey,
                'isIdSection' => $parentKey == 'parentIdDocuments',
                'allDocNames' => $allDocNames,
                'requestedDocuments' => Helper::validate_key_value('requestedDocuments', $ajaxData),
                'banktypeString' => Helper::validate_key_value('banktypeString', $ajaxData),
                'parentIndicator' => Helper::validate_key_value('parentIndicator', $ajaxData),
                'documentAndMissingText' => Helper::validate_key_value('documentAndMissingText', $ajaxData),
                'docsCount' => Helper::validate_key_value('docsCount', $ajaxData),
                'checkbox' => Helper::validate_key_value('checkbox', $ajaxData),
                'acceptedCount' => Helper::validate_key_value('acceptedCount', $ajaxData),
                'declinedCount' => Helper::validate_key_value('declinedCount', $ajaxData),
                'bank_statement_months' => Helper::validate_key_value('bank_statement_months', $ajaxData),
                'isStatements' => in_array($parentKey, ['parentPaypalVenmoCashDocuments', 'parentBankDocuments', 'parentBrokerageDocuments']) ? 1 : 0,
                'isPaystub' => in_array($parentKey, ['parentIncomeDocuments']) ? 1 : 0,
                'val' => $user,
                'clientDocs' => Helper::validate_key_value('clientDocs', $ajaxData, 'array'),
                'adminDocs' => Helper::validate_key_value('adminDocs', $ajaxData, 'array'),
                'docsMisc' => Helper::validate_key_value('docsMisc', $ajaxData, 'array'),
                'venmoPaypalCash' => Helper::validate_key_value('venmoPaypalCash', $ajaxData, 'array'),
                'brokerageAccount' => Helper::validate_key_value('brokerageAccount', $ajaxData, 'array'),
                'bank_account_documents' => Helper::validate_key_value('bank_account_documents', $ajaxData, 'array'),
                'expandableDiv' => true,
                'client_id' => $client_id,
                'cardsArray' => ClientDocumentUploaded::getCardTypeArray(),
                'documentMoveToList' => $documentMoveToList,
                'autoloankeys' => array_keys(ClientDocumentUploaded::getAutoloanKeyValue(1)),
                'mortloankeys' => array_keys(ClientDocumentUploaded::getResidenceKeyValue(1)),
                'final_debts' => Helper::validate_key_value('final_debts', $ajaxData, 'array'),
                'notOwnedproperty' => Helper::validate_key_value('notOwnedproperty', $ajaxData),
                'attProfitLossMonths' => Helper::validate_key_value('attProfitLossMonths', $ajaxData, 'radio'),
                'brokerage_months' => Helper::validate_key_value('brokerage_months', $ajaxData, 'radio'),
            ];

            $viewFile = 'docMainColFormData';
            $unassignedDocIds = '';

            if ($parentKey == 'parentSecuredDocuments' && $request->document_type !== 'Insurance_Documents') {

                $unreadDocuments = ClientDocumentUploaded::where(['client_id' => $client_id, 'is_viewed_by_attorney' => 0])->whereNotIn('document_type', ['document_sign', 'signed_document'])->get()->toArray();

                $viewFile = 'docSecuredColFormData';
                $renderData['securedObjKey'] = $request->document_type;
                $renderData['securedDocs'] = $mainDocumentTypeStructure;
                $renderData['unreadDocuments'] = $unreadDocuments;
            } elseif ($parentKey == 'parentIncomeDocuments') {
                $viewFile = 'docPayStubMainFormData';
                $response = ClientDocuments::pay_check_calculation($client_id, $user->client_type);
                $renderData['parentKey'] = $parentKey;
                $renderData['childObjKey'] = $request->document_type;
                $renderData['response'] = $response;
                $renderData['attorney_id'] = $attorney_id;
                $renderData['expandableEmpId'] = $employer_id;
                $renderData['client_type'] = $user->client_type;
                $renderData['acceptType'] = ".heic, .png, .jpg, .jpeg, .pdf,.doc,.docx";
                $renderData['objData'] = [
                    'document_type' => $request->document_type,
                    'document_name' => Helper::validate_key_value($request->document_type, $allDocNames),
                    'multiple' => $mainDocumentTypeStructure,
                ];

                $prevDocData = $mainDocumentTypeStructure['multiple'] ?? [];
                $filteredPrevDocData = [];

                $paystubAssignedDocIds = [];
                if ($request->document_type == "Debtor_Pay_Stubs") {
                    $paystubAssignedDocIds = DocumentUploadedData::getAssignedPaystubDocIds('self', $client_id);
                }
                if ($request->document_type == "Co_Debtor_Pay_Stubs") {
                    $paystubAssignedDocIds = DocumentUploadedData::getAssignedPaystubDocIds('spouse', $client_id);
                }

                if (!empty($prevDocData)) {
                    $filteredPrevDocData = array_filter($prevDocData, function ($doc) use ($paystubAssignedDocIds) {
                        return !in_array($doc['id'], $paystubAssignedDocIds);
                    });
                    $filteredPrevDocData = array_values($filteredPrevDocData);
                }
                $prevDocData = $filteredPrevDocData;
                $renderData['prevDocData'] = $prevDocData;

                $unassignedDocIds = count(self::getUnassignedDocIds($client_id, $user->client_type, $request->document_type, $mainDocumentTypeStructure));

            } elseif ($parentKey == 'Post_submission_documents') {
                $renderData['objKey'] = $request->document_type;
                $renderData['docs'] = $mainDocumentTypeStructure;
                if (str_starts_with($request->document_type, 'post_submission_doc_')) {
                    $renderData['formultiples'] = true;
                    $renderData['checkbox'] = true;
                }
            } else {
                $renderData['objKey'] = $request->document_type;
                $renderData['docs'] = $mainDocumentTypeStructure;
            }

            $html = view('attorney.uploaded_doc_view.'.$viewFile, $renderData)->render();

            return response()->json([
                            'status' => true,
                            'html' => $html,
                            'unassignedDocIds' => $unassignedDocIds
                        ]);
        }

        return response()->json([
            'status' => false,
            'html' => ''
        ]);
    }

    public static function getUnassignedDocIds($client_id, $client_type, $document_type, $mainDocumentTypeStructure)
    {


        $assignedDocs = [];
        $unassignedDocIds = [];

        $response = ClientDocuments::pay_check_calculation($client_id, $client_type);

        if (empty($document_type)) {
            return $unassignedDocIds;
        }
        $payCheckData = [];
        if ($document_type == 'Debtor_Pay_Stubs' && !empty($response['debtorPayCheckData'])) {
            $payCheckData = $response['debtorPayCheckData'] ?? [];
        }
        if ($document_type == 'Co_Debtor_Pay_Stubs' && !empty($response['codebtorPayCheckData'])) {
            $payCheckData = $response['codebtorPayCheckData'] ?? [];
        }

        foreach ($payCheckData as $key => $asnadocs) {
            $pay_dates_list = Helper::validate_key_value('pay_dates_list', $asnadocs);
            $pay_datesas = Helper::validate_key_value('pay_dates', $asnadocs);
            $pay_datesas = !empty($pay_datesas) ? array_reverse($pay_datesas) : [];

            if (!empty($pay_dates_list)) {
                foreach ($pay_dates_list as $index => $uppaydates) {
                    $uploadedDocId = Helper::validate_key_value('document_id', $uppaydates, 'radio');
                    if ($uploadedDocId > 0) {
                        $assignedDocs[] = $uploadedDocId;
                    }
                }
            }

            if (!empty($pay_datesas)) {
                foreach ($pay_datesas as $index => $asdata) {
                    $existsDataAd = Helper::validate_key_value('existsData', $asdata);
                    $docObjAs = is_array($existsDataAd) ? reset($existsDataAd) : [];
                    $docIdas = Helper::validate_key_value('document_id', $docObjAs, 'radio');
                    if ($docIdas > 0) {
                        $assignedDocs[] = $docIdas;
                    }
                }
            }
        }


        if (isset($mainDocumentTypeStructure)) {
            $allDocsArray = array_column($mainDocumentTypeStructure, 'id');
            $unassignedDocIds = array_diff($allDocsArray, $assignedDocs);
        }

        return $unassignedDocIds;
    }
    private static function getEmployerIdfromrequest($input, $index = '')
    {
        $employerIdData = Helper::validate_key_value('employer_id', $input);

        return ArrayHelper::getValidatedDataForDummyEntry($employerIdData, $index, 'radio');
    }


    public function mark_signed_doc_read(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];
            $attorney_id = Helper::getCurrentAttorneyId();
            if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
                return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
            }
            $doc_url = $input['doc_url'];
            $doc_url = ltrim($doc_url, '/');
            $data = ['sign_document' => $doc_url, 'attorney_id' => $attorney_id, 'client_id' => $client_id];
            $data['read_by_attorney'] = 1;
            $data['is_sent'] = 0;
            \App\Models\SignedDocuments::where(['sign_document' => $doc_url, 'attorney_id' => $attorney_id, 'client_id' => $client_id])->update($data);

            return redirect()->back()->with('success', 'Document downloaded successfully.');
        }
    }


    public function move_document_to(Request $request)
    {
        $input = $request->all();
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($input['client_id'], $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        try {
            if (in_array($input['pre_document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) {
                $emp_id = Helper::validate_key_value('emp_id', $input);
                $pay_date = Helper::validate_key_value('pay_date', $input);
                $document_paystub_date = "";

                if (in_array($input['new_selected_value'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) {
                    $document_paystub_date = date("m.d.Y", strtotime($pay_date));
                    if (empty($pay_date)) {
                        $getpaydate = \App\Models\ClientDocumentUploaded::where('id', $input['doc_id'])
                        ->select('document_paystub_date')
                        ->first();
                        $pay_date = $getpaydate ? $getpaydate->document_paystub_date : null;
                        $document_paystub_date = $pay_date;
                    }
                }

                \App\Models\ClientDocumentUploaded::where(['id' => $input['doc_id'], 'client_id' => $input['client_id']])->update(['document_type' => $input['new_selected_value'], 'document_paystub_date' => $document_paystub_date]);
                $data = [
                            'client_id' => $input['client_id'],
                            'document_type' => $input['new_selected_value'],
                            'employer_id' => $emp_id,
                            'paystub_date' => $pay_date,
                            'pre_document_type' => $input['pre_document_type']
                        ];



                if (!in_array($input['new_selected_value'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) {
                    $data['employer_id'] = Helper::validate_key_value('select_employer_id', $input);
                    $this->removePaystub($input['doc_id'], $data);
                } else {
                    $this->updatePaystub($input['doc_id'], $data);
                }

            } else {
                if (in_array($input['new_selected_value'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) {
                    \App\Models\ClientDocumentUploaded::where(['id' => $input['doc_id'], 'client_id' => $input['client_id']])->update(['document_type' => $input['new_selected_value'], 'document_paystub_date' => date("m.d.Y")]);
                    $emp_id = Helper::validate_key_value('emp_id', $input);
                    $pay_date = Helper::validate_key_value('pay_date', $input);
                    $data = [
                                'client_id' => $input['client_id'],
                                'document_type' => $input['new_selected_value'],
                                'employer_id' => $emp_id,
                                'paystub_date' => $pay_date,
                                'pre_document_type' => $input['pre_document_type']
                            ];

                    $this->updatePaystub($input['doc_id'], $data);

                } else {
                    \App\Models\ClientDocumentUploaded::where(['id' => $input['doc_id'], 'client_id' => $input['client_id']])->update(['document_type' => $input['new_selected_value']]);
                }

            }

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

    }

    private function updatePaystub($docId, $data)
    {
        $new_pinwheel_account_type = '';
        if (Helper::validate_key_value('document_type', $data) == "Debtor_Pay_Stubs") {
            $new_pinwheel_account_type = 'self';
        }
        if (Helper::validate_key_value('document_type', $data) == "Co_Debtor_Pay_Stubs") {
            $new_pinwheel_account_type = 'spouse';
        }

        $document_paystub_date = str_replace('/', '.', $data['paystub_date']);
        $unformattedDate = $data['paystub_date'];
        $postedDocType = Helper::validate_key_value('document_type', $data);

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $document_paystub_date)) {
            $date = DateTime::createFromFormat('m.d.Y', $document_paystub_date);
            $document_paystub_date = $date->format('Y-m-d'); // Output: 2025-01-25
        }

        $condition = [
            'pinwheel_account_type' => $new_pinwheel_account_type,
            'client_id' => $data['client_id'],
            'pay_date' => $document_paystub_date,
            'employer_id' => $data['employer_id']
        ];
        if (\App\Models\PayStubs::where($condition)->exists()) {
            // Step 1: Unassign old paystub (set employer_id to 0 only)
            \App\Models\PayStubs::where($condition)->delete();

            // Step 2: Prepare new data to insert
            $newData = [
                'document' => $document_paystub_date,
                'updated_at' => now(),
                'paystub_date' => $unformattedDate,
                'pinwheel_account_type' => $new_pinwheel_account_type,
                'employer_id' => $data['employer_id'],
                'client_id' => $data['client_id'],
                'document_type' => $postedDocType
            ];

            \App\Models\PayStubs::dummyPaystubEntry($newData, $docId, $unformattedDate);
        } else {
            unset($data['pre_document_type']);

            \App\Models\PayStubs::dummyPaystubEntry($data, $docId, $unformattedDate);
        }
    }


    private function removePaystub($docId, $data)
    {
        $prev_pinwheel_account_type = '';
        if (Helper::validate_key_value('pre_document_type', $data) == "Debtor_Pay_Stubs") {
            $prev_pinwheel_account_type = 'self';
        }
        if (Helper::validate_key_value('pre_document_type', $data) == "Co_Debtor_Pay_Stubs") {
            $prev_pinwheel_account_type = 'spouse';
        }

        $document_paystub_date = str_replace('/', '.', $data['paystub_date']);

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $document_paystub_date)) {
            $date = DateTime::createFromFormat('m.d.Y', $document_paystub_date);
            $document_paystub_date = $date->format('Y-m-d'); // Output: 2025-01-25
        }

        $condition = [
            'pinwheel_account_type' => $prev_pinwheel_account_type,
            'client_id' => $data['client_id'],
            'pay_date' => $document_paystub_date,
            'employer_id' => $data['employer_id'],
            'document_id' => $docId
        ];

        \App\Models\PayStubs::where($condition)->delete();
    }

    public function update_creditors_to_doc(Request $request)
    {
        $input = $request->all();
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($input['client_id'], $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        try {
            \App\Models\ClientDocumentUploaded::where(['id' => $input['doc_id'], 'client_id' => $input['client_id']])->update(['creditor_value' => $input['new_selected_value']]);

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }
    public function set_bank_statement_months(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $attorney_id = Helper::getCurrentAttorneyId();
            $dataToSave = [
                            'attorney_id' => $attorney_id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
            if (isset($input['bank_statement_months'])) {
                $dataToSave['bank_statement_months'] = Helper::validate_key_value('bank_statement_months', $input);
            }

            if (isset($input['attorney_enabled_bank_statment'])) {
                $dataToSave['attorney_enabled_bank_statment'] = Helper::validate_key_value('attorney_enabled_bank_statment', $input) == 'yes' ? 1 : 0;
            }
            if (isset($input['profit_loss_months'])) {
                $dataToSave['profit_loss_months'] = Helper::validate_key_value('profit_loss_months', $input);
            }


            \App\Models\AttorneySettings::updateOrCreate(['attorney_id' => $attorney_id], $dataToSave);

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function get_thumbnail_generate_status(Request $request)
    {
        $input = $request->all();
        $doc_ids = $input['document_ids'];
        $pending_ones = ClientDocumentUploaded::select(['id', 'is_generated_thumbnails', 'document_file'])->whereIn('id', $doc_ids)->get();

        $return_res = ["status" => "1", "pending_ones" => $pending_ones];

        return response()->json($return_res)->header('Content-Type: application/json;', 'charset=utf-8');

    }

    public function attorney_common_document_mgt(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();


        $is_associate = 0;
        $associate_id = 0;
        if ($request->isMethod('post')) {
            $input = $request->all();

            $is_associate = Helper::validate_key_value('is_associate', $input, 'radio');
            $associate_id = Helper::validate_key_value('associate_id', $input, 'radio');

            unset($input['associate_id']);
            $attorney_id = $is_associate ? $associate_id : $attorney_id;
            $input['is_associate'] = $is_associate;
            $input['attorney_id'] = $attorney_id;
            $input['document_type'] = Helper::validate_doc_type($input['document_name'], true);
            if (empty($input['document_name'])) {
                return ($is_associate)
                    ? redirect()->route('attorney_lawfirm_settings', ['associate_id' => $attorney_id])->with("error", 'Document name must have atleast 1 alphabets')
                    : redirect()->route('attorney_settings')->with("error", 'Document name must have atleast 1 alphabets');
            }
            AttorneyCommonDocuments::create($input);

            return ($is_associate)
                ? redirect()->route('attorney_lawfirm_settings', ['associate_id' => $attorney_id, 'type' => 4])->with('success', 'Document has been added successfully.')
                : redirect()->route('attorney_settings', ['type' => 4])->with('success', 'Document has been added successfully.');
        }
    }

    public static function attorney_common_document_edit(Request $request)
    {
        if ($request->isMethod('post')) {
            $attorney_id = Helper::getCurrentAttorneyId();
            $input = $request->all();
            $input['attorney_id'] = $attorney_id;
            $document_id = $input['document_id'];

            $is_associate = Helper::validate_key_value('is_associate', $input, 'radio');
            $associate_id = Helper::validate_key_value('associate_id', $input, 'radio');

            unset($input['document_id'], $input['_token'], $input['associate_id']);
            $input['document_type'] = Helper::validate_doc_type($input['document_name']);
            if (empty($input['document_name'])) {
                return redirect()->route('attorney_settings')->with('error', 'Document name must have atleast 1 alphabets.');
            }
            AttorneyCommonDocuments::where(['id' => $document_id])->update($input);

            return ($is_associate)
                ? redirect()->route('attorney_lawfirm_settings', ['associate_id' => $associate_id, 'type' => 4])->with('success', 'Document has been updated successfully.')
                : redirect()->route('attorney_settings', ['type' => 4])->with('success', 'Document has been updated successfully.');
        }
    }

    public function attorney_post_submission_document_create(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        $is_associate = 0;
        $associate_id = 0;
        if ($request->isMethod('post')) {
            $input = $request->all();

            $is_associate = Helper::validate_key_value('is_associate', $input, 'radio');
            $associate_id = Helper::validate_key_value('associate_id', $input, 'radio');

            unset($input['associate_id']);
            $attorney_id = $is_associate ? $associate_id : $attorney_id;
            $input['is_associate'] = $is_associate;
            $input['attorney_id'] = $attorney_id;

            // Find the latest post_submission_doc_X for this attorney/associate
            $lastDoc = AttorneyCommonDocuments::where([
                    'attorney_id' => $attorney_id,
                    'is_associate' => $is_associate,
                ])
                ->where('document_type', 'like', 'post_submission_doc_%')
                ->orderByDesc('id')
                ->first();

            $nextNumber = 1; // default if none exist

            if ($lastDoc && preg_match('/post_submission_doc_(\d+)$/', $lastDoc->document_type, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            }

            $input['document_type'] = Helper::validate_doc_type("post_submission_doc_" . $nextNumber, true);

            if (empty($input['document_name'])) {
                return ($is_associate)
                    ? redirect()->route('attorney_lawfirm_settings', ['associate_id' => $attorney_id])->with("error", 'Document name must have atleast 1 alphabets')
                    : redirect()->route('attorney_settings')->with("error", 'Document name must have atleast 1 alphabets');
            }
            AttorneyCommonDocuments::create($input);

            return ($is_associate)
                ? redirect()->route('attorney_lawfirm_settings', ['associate_id' => $attorney_id, 'type' => 5])->with('success', 'Document has been added successfully.')
                : redirect()->route('attorney_settings', ['type' => 5])->with('success', 'Document has been added successfully.');
        }
    }

    public static function attorney_post_submission_document_update(Request $request)
    {
        if ($request->isMethod('post')) {
            $attorney_id = Helper::getCurrentAttorneyId();
            $input = $request->all();
            $input['attorney_id'] = $attorney_id;
            $document_id = $input['document_id'];

            $is_associate = Helper::validate_key_value('is_associate', $input, 'radio');
            $associate_id = Helper::validate_key_value('associate_id', $input, 'radio');

            unset($input['document_id'], $input['_token'], $input['associate_id']);
            if (empty($input['document_name'])) {
                return redirect()->route('attorney_settings')->with('error', 'Document name must have atleast 1 alphabets.');
            }
            AttorneyCommonDocuments::where(['id' => $document_id])->update($input);

            return ($is_associate)
                ? redirect()->route('attorney_lawfirm_settings', ['associate_id' => $associate_id, 'type' => 5])->with('success', 'Document has been updated successfully.')
                : redirect()->route('attorney_settings', ['type' => 5])->with('success', 'Document has been updated successfully.');
        }
    }


    public static function mark_document_seen(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $docId = Helper::validate_key_value('docId', $input);
            $clientId = Helper::validate_key_value('clientId', $input);
            ClientDocumentUploaded::where(['id' => $docId, 'client_id' => $clientId])->update(['is_viewed_by_attorney' => 1]);

            return response()->json(Helper::renderJsonSuccess("Success"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    /**
     * Add Post Submission Document
     */
    public function post_submission_document_add(Request $request)
    {
        $post_submission_docs = $request->input('post_submission_docs') ?? [];
        // if (empty($post_submission_docs)) {
        //     return redirect()->back()->with('error', 'No documents selected');
        // }
        DB::beginTransaction();

        try {
            // Get client id
            $client_id = $request->input('client_id');
            // Check if client belongs to current attorney
            $attorneyId = Helper::getCurrentAttorneyId();
            if (!Helper::isClientBelongsToAttorney($client_id, $attorneyId)) {
                DB::rollBack();

                return redirect()->back()->with('error', 'Invalid request - Client does not belong to current attorney');
            }
            // Get all existing post submission documents for this client
            $existingDocs = ClientDocuments::where([
                'client_id' => $client_id,
                'type' => 'post_submission_doc'
            ])->get();

            // Get list of selected document keys
            $selectedKeys = array_keys($post_submission_docs);

            // Find documents that need to be deleted (exist in DB but not in selected list)
            $docsToDelete = $existingDocs->filter(function ($doc) use ($selectedKeys) {
                return !in_array($doc->document_name, $selectedKeys);
            });

            // Delete the deselected documents
            foreach ($docsToDelete as $doc) {
                $doc->delete();
            }

            // Add or update selected documents
            if (!empty($post_submission_docs)) {
                foreach ($post_submission_docs as $key => $value) {
                    $document_name = trim($value);
                    // Generate document type for post submission documents
                    $document_type = Helper::validate_doc_type($key, true);

                    // Check if document already exists
                    $existingRecord = ClientDocuments::where([
                        'client_id' => $client_id,
                        'document_name' => $document_type,
                        'document_type' => $document_name,
                        'type' => 'post_submission_doc'
                    ])->first();

                    if (!$existingRecord) {
                        $dataToSave = [
                            'client_id' => $client_id,
                            'document_name' => $document_type,
                            'document_type' => $document_name,
                            'type' => 'post_submission_doc',
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];

                        ClientDocuments::create($dataToSave);
                    }
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Post Submission Documents list has been updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error adding selected post submission document: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while adding the document. Please try again.');
        }
    }

}
