<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Jobs\ZipDownload;
use App\Models\DoctoZipFileScheduler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Traits\Common; // Trait
use App\Helpers\DocumentHelper;
use App\Models\AttorneySettings;
use App\Services\Client\CacheBasicInfo;
use Illuminate\Support\Facades\Session;
use Storage;
use Illuminate\Support\Facades\Log;

class AttorneyDocumentActionController extends AttorneyController
{
    use Common;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function client_decline_docs_popup(Request $request)
    {
        $input = $request->all();
        if (!Helper::isClientBelongsToAttorney($input['client_id'], Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return view('attorney.client.decline_docs', ['doc_id' => $input['doc_id'],'client_id' => $input['client_id'],'file_url' => $input['file_url'], 'document_status' => $input['document_status'],
        'document_type' => $input['document_type'], 'label' => $input['label']]);
    }

    public function client_document_status(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $doctype = $input['document_type'];
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $doc_id = $input['doc_id'];
            $file_url = $input['file_url'];
            $newStatus = $input['document_status'];
            $documentDeclineReason = isset($input['document_decline_reason']) ? $input['document_decline_reason'] : '';
            $this->isValidDocumentStatus($newStatus);
            $msg = $this->changeStatusDoc($client_id, $doctype, $doc_id, $newStatus, $file_url, $documentDeclineReason);

            return response()->json(Helper::renderJsonSuccess($msg))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    private function isValidDocumentStatus($newStatus)
    {
        if (!in_array($newStatus, [\App\Models\ClientDocumentUploaded::STATUS_APPROVE,\App\Models\ClientDocumentUploaded::STATUS_DECLINE])) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function client_document_delete(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $doctype = $input['type'];
            $client_id = $input['client_id'];
            $document_id = $input['document_id'] ?? 0;

            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            $conditions = ['client_id' => $client_id, 'document_type' => $doctype];
            if (!empty($document_id)) {
                $conditions = ['client_id' => $client_id, 'id' => $document_id];
            }

            $document = \App\Models\ClientDocumentUploaded::where($conditions)->first();
            if (!$document) {
                return response()->json(Helper::renderJsonError("Document not found."))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            $documentArr = $document->toArray();
            $s3Path = $documentArr['document_file'];

            DB::beginTransaction();
            try {
                // Log the deletion in notes
                $subject = "Document Deleted By " . Auth::user()->name;
                $note = "Document " . $doctype . ' ' . $documentArr['updated_name'] . ' is deleted via Uploaded Client Documents page by ' . Auth::user()->name;
                \App\Models\ConciergeServiceNotes::create([
                    'client_id' => $client_id,
                    'subject' => $subject,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'note' => $note,
                    'added_by_id' => 1
                ]);

                // Delete related OCR data
                \App\Models\UploadedOcrData::where($conditions)->delete();

                // Delete document and its relations from DB
                \App\Models\ClientDocumentUploaded::where('id', $documentArr['id'])->delete();
                \App\Models\ClientDocumentUploaded::where(['relate_to_document' => $documentArr['id']])->update(['relate_to_document' => 0]);

                // Notification
                self::createNotification($client_id, $doctype);

                // Commit database changes
                DB::commit();

                // Now delete the S3 file (external, non-transactional)
                if ($doctype !== 'Vehicle_Information' && Storage::disk('s3')->exists($s3Path)) {
                    if (!Storage::disk('s3')->delete($s3Path)) {
                        Log::error("S3 Deletion failed for file: {$s3Path}");

                        // Optional: Notify admin or reverse DB actions manually if critical
                        return response()->json(Helper::renderJsonError("Document DB record deleted but failed to remove file from S3."))->header('Content-Type: application/json;', 'charset=utf-8');
                    }
                }

                return response()->json(Helper::renderJsonSuccess('Document Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Document deletion failed: " . $e->getMessage());

                return response()->json(Helper::renderJsonError("Something went wrong during deletion."))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }
    }

    public function delete_bank_type(Request $request)
    {
        $input = $request->all();
        if (!Helper::isClientBelongsToAttorney($input['client_id'], Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $client_id = Helper::validate_key_value('client_id', $input);
        $document_type = Helper::validate_key_value('document_type', $input);
        if (!empty($client_id) && !empty($document_type)) {
            try {
                $documents = \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id, 'document_type' => $document_type])->get()->toArray();
                foreach ($documents as $doc) {
                    \App\Models\ClientDocumentUploaded::where('id', $doc['id'])->delete();
                    \App\Models\ClientDocumentUploaded::where(['relate_to_document' => $doc['id']])->update(['relate_to_document' => 0]);
                }
                \App\Models\ClientDocuments::where(['client_id' => $client_id, 'document_name' => $document_type])->delete();
                \App\Models\AdminClientRequestedDocuments::deleteTypeinRequDocs($client_id, $document_type);

                return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
            } catch (\Exception $e) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }
    }

    public function delete_requested_doc_type(Request $request)
    {
        $input = $request->all();
        if (!Helper::isClientBelongsToAttorney($input['client_id'], Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $client_id = Helper::validate_key_value('client_id', $input);
        $document_type = Helper::validate_key_value('document_type', $input);
        if (!empty($client_id) && !empty($document_type)) {
            try {
                $documents = \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id, 'document_type' => $document_type])->get()->toArray();
                foreach ($documents as $doc) {
                    \App\Models\ClientDocumentUploaded::where('id', $doc['id'])->delete();
                    \App\Models\ClientDocumentUploaded::where(['relate_to_document' => $doc['id']])->update(['relate_to_document' => 0]);
                }
                \App\Models\AdminClientDocuments::where(['client_id' => $client_id, 'document_type' => $document_type])->delete();
                \App\Models\ClientDocuments::where(['client_id' => $client_id, 'document_name' => $document_type])->delete();
                $savedRequestedDocs = \App\Models\AdminClientRequestedDocuments::where(['client_id' => $client_id])->select('requested_documents')->first();
                $requestedDocuments = Helper::validate_key_value('requested_documents', $savedRequestedDocs);
                $requestedDocuments = !empty($requestedDocuments) ? json_decode($requestedDocuments, true) : [];
                $requestedDocuments = is_array($requestedDocuments) ? $requestedDocuments : [];
                if (!empty($requestedDocuments)) {
                    foreach ($requestedDocuments as $key => $docx) {
                        if ($key == $document_type) {
                            unset($requestedDocuments[$key]);
                        }
                    }
                    \App\Models\AdminClientRequestedDocuments::where(['client_id' => $client_id])->update(['requested_documents' => json_encode($requestedDocuments)]);
                }

                return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
            } catch (\Exception $e) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }
    }

    private static function createNotification($client_id, $doctype)
    {
        $notif_body = "document has been deleted by Attorney!";
        $notif_body = str_replace("_", " ", $doctype.' '.$notif_body);
        $data = [
            'client_id' => $client_id,
            'unotification_body' => $notif_body,
            'unotification_date' => date("Y-m-d H:i:s"),
            'unotification_is_read' => 0,
            'unotification_type' => \App\Models\Notifications::DOCUMENT_TYPE,
            'unotification_data' => json_encode(['document_status' => \App\Models\ClientDocumentUploaded::STATUS_DELETED, 'file_url' => '', 'document_enable_reupload' => 1,'document_type' => $doctype]),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        \App\Models\Notifications::create($data);
    }

    public function client_child_document_delete(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $doctype = $input['type'];
            $client_id = $input['client_id'];
            $document_id = $input['doc_id'];

            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            DB::beginTransaction();
            try {
                $doc = \App\Models\ClientDocumentUploaded::where([
                    'id' => $document_id,
                    'client_id' => $client_id
                ])->first();

                if (!$doc) {
                    DB::rollBack();

                    return response()->json(Helper::renderJsonError("Document not found."))->header('Content-Type: application/json;', 'charset=utf-8');
                }

                $docArr = $doc->toArray();
                $s3Path = $docArr['document_file'];

                // Add note
                $subject = "Document Deleted By " . Auth::user()->name;
                $note = "Document " . $doctype . ' ' . $docArr['updated_name'] . ' is deleted via Uploaded Client Documents page by ' . Auth::user()->name;

                \App\Models\ConciergeServiceNotes::create([
                    'client_id' => $client_id,
                    'subject' => $subject,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'note' => $note,
                    'added_by_id' => 1
                ]);

                // Delete from DB
                \App\Models\ClientDocumentUploaded::where('id', $document_id)->delete();
                \App\Models\ClientDocumentUploaded::where(['relate_to_document' => $document_id])->update(['relate_to_document' => 0]);

                // Delete related OCR data
                \App\Models\UploadedOcrData::where(['client_id' => $client_id, 'id' => $document_id])->delete();

                // Notification
                self::createNotification($client_id, $doctype);

                DB::commit();

                // S3 delete (non-transactional, post-commit)
                if ($doctype !== 'Vehicle_Information' && Storage::disk('s3')->exists($s3Path)) {
                    if (!Storage::disk('s3')->delete($s3Path)) {
                        Log::error("S3 deletion failed for: {$s3Path}");
                    }
                }

                return response()->json(Helper::renderJsonSuccess('Document Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Child document deletion failed: " . $e->getMessage());

                return response()->json(Helper::renderJsonError("Something went wrong during deletion."))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }
    }



    public function client_document_enable_reupload(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $doctype = $input['document_type'];
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $newStatus = $input['document_enable_reupload'];
            $file_url = $input['file_url'];
            $document_status = $input['document_status'];
            $doc_id = $input['doc_id'];
            $cond = ['client_id' => $client_id,'document_type' => $doctype];
            if ($doc_id > 0) {
                $cond['id'] = $doc_id;
            }
            \App\Models\ClientDocumentUploaded::where($cond)->update(['document_enable_reupload' => $newStatus]);
            if ($newStatus == \App\Models\ClientDocumentUploaded::DOCUMENT_ENABLE_REUPLOAD) {
                $msg = 'Document Enabled for Reuploading Successfully!';
            }
            $notif_body = "document enabled for reuploading!";
            $notif_body = str_replace("_", " ", $doctype.' '.$notif_body);
            $data = [
                'client_id' => $client_id,
                'unotification_body' => $notif_body,
                'unotification_date' => date("Y-m-d H:i:s"),
                'unotification_is_read' => 0,
                'unotification_type' => \App\Models\Notifications::DOCUMENT_TYPE,
                'unotification_data' => json_encode(['document_status' => $document_status, 'file_url' => $file_url, 'document_enable_reupload' => 1,'document_type' => $doctype]),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $status = 'Enabled for Reuploading';
            $this->sendNotification($client_id, $doctype, $status);
            \App\Models\Notifications::create($data);

            return response()->json(Helper::renderJsonSuccess($msg))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function client_delete_documents(Request $request)
    {
        $document_id = $request->input('document_id');

        $input = $request->all();

        $is_associate = Helper::validate_key_value('is_associate', $input, 'radio');
        $associate_id = Helper::validate_key_value('associate_id', $input, 'radio');

        $attorney_id = $is_associate ? $associate_id : Helper::getCurrentAttorneyId();

        $documentuploaded_data = \App\Models\AttorneyDocuments::where([ "attorney_id" => $attorney_id, 'is_associate' => $is_associate ])->where('id', $document_id)->select('attorney_id', 'id')->get()->toArray();
        if (empty($documentuploaded_data)) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $deletedRows = \App\Models\AttorneyDocuments::where(['id' => $document_id])->delete();
        if (empty($deletedRows)) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return response()->json(Helper::renderJsonSuccess('Document Deleted Successfully!', ['div' => 'add-doc-pagination']))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public static function attorney_common_doc_delete(Request $request)
    {
        $documentId = $request->input('document_id');
        $input = $request->all();

        $isAssociate = Helper::validate_key_value('is_associate', $input, 'radio');
        $associateId = Helper::validate_key_value('associate_id', $input, 'radio');
        $attorneyId = $isAssociate ? $associateId : Helper::getCurrentAttorneyId();

        $document = \App\Models\AttorneyCommonDocuments::where([
            'attorney_id' => $attorneyId,
            'is_associate' => $isAssociate,
            'id' => $documentId
        ])->first(['attorney_id', 'id']);

        if (!$document) {
            return response()->json(Helper::renderJsonError('Invalid Request'))
                             ->header('Content-Type', 'application/json; charset=utf-8');
        }

        $deleted = $document->delete();

        if (!$deleted) {
            return response()->json(Helper::renderJsonError('Unable to delete document'))
                             ->header('Content-Type', 'application/json; charset=utf-8');
        }

        return response()->json(Helper::renderJsonSuccess('Document Deleted Successfully!', ['div' => 'add-doc-common-pagination']))
                         ->header('Content-Type', 'application/json; charset=utf-8');
    }


    public function generateZip(Request $request)
    {
        Session::save();
        //$docDirepath = public_path().'/documents/';
        // $command = 'sudo chown -R ubuntu:www-data '.$docDirepath;
        //$command2 = 'sudo chmod -R 775 '.$docDirepath;
        //shell_exec($command);
        //shell_exec($command2);
        $clientId = $request->client_id;
        DoctoZipFileScheduler::updateOrCreate(['client_id' => $clientId], ['downloadable_path' => '','scheduler_start_at' => date("Y-m-d H:i:s"),'completion_percentage' => 0])->lockForUpdate();
        ZipDownload::dispatch($clientId);

        return response()->json([
            'client_id' => $clientId,
            'downloadLink' => 'documents/'.$clientId.'/Client_Document_Uploads.zip',
            'message' => 'Success'
        ]);
    }

    public function getProgress(Request $request)
    {
        $clientId = $request->client_id;

        $progress = DoctoZipFileScheduler::where('client_id', $clientId)->sharedLock()->first();
        $clientInfo = \App\Models\User::getClientInfo($clientId);
        $clientName = str_replace(' ', '_', $clientInfo['client_fullname']);
        $zippedFilename = $clientName ."_BKQ_Uploaded_Docs.zip";
        $downloadPath = $progress->downloadable_path;
        if (!empty($progress->downloadable_path) && !str_contains($progress->downloadable_path, '.zip')) {
            $downloadPath = "documents/$clientId/$zippedFilename";
        }
        $zipFilePath = '';
        $fileExists = false;
        if (!empty($downloadPath)) {
            $zipFilePath = public_path()."/".$downloadPath;
            if (file_exists($zipFilePath)) {
                $fileExists = true;
            }
        }



        if ($progress) {
            return response()->json([
                'progress' => $fileExists ? $progress->completion_percentage : 0,
                'current_file' => $fileExists ? $downloadPath : ''
            ]);
        }

        return response()->json(['error' => 'No progress found'], 404);
    }

    public function client_document_zip_download($client_id, $download = 0)
    {
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->back()->with('error', 'Invalid request');
        }

        $notIn = ['document_sign','signed_document'];
        $documentList = \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id, 'is_uploaded_to_s3' => 1])->whereNotIn('document_type', $notIn)->get();
        $documentList = !empty($documentList) ? $documentList->toArray() : [];
        if (empty($documentList)) {
            return redirect()->back()->with('error', 'Client documents not available.');
        }
        $jobStatus = \App\Models\DoctoZipFileScheduler::where(['client_id' => $client_id, 'job_status' => \App\Models\DoctoZipFileScheduler::STATUS_COMPLETED])->first();
        if ($download == 1 && isset($jobStatus->downloadable_path) && !empty($jobStatus->downloadable_path)) {
            if (!Storage::disk('s3')->exists($jobStatus->downloadable_path)) {
                return redirect()->back()->with('error', 'File does not exists.');
            }

            $filename = !empty($jobStatus->downloadable_path) ? basename($jobStatus->downloadable_path) : "File missing";

            return redirect(Storage::disk('s3')->temporaryUrl(
                $jobStatus->downloadable_path,
                now()->addDays(2),
                ['ResponseContentDisposition' => 'attachment;filename= '.rawurlencode($filename)]
            ));
        }

        DoctoZipFileScheduler::updateOrCreate(['client_id' => $client_id], ['completion_percentage' => 0,'job_status' => \App\Models\DoctoZipFileScheduler::STATUS_PENDING, 'scheduler_start_at' => date("Y-m-d H:i:s"), 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")]);

        return redirect()->back()->with('success', 'Zip File Download Request has been placed.');
        /*DocumentHelper::generateZipFile(urlencode('Client_Document_Uploads.zip') , $fileName);*/
    }

    private static function getPDFData($client_id, $value)
    {
        $clientObj = \App\Models\User::where('id', $client_id)->first();
        $pdata = \App\Models\FormsStepsCompleted::where("client_id", $client_id)->select('step6', 'can_edit', 'updated_on')->first();
        $pdata = !empty($pdata) ? $pdata->toArray() : [];
        $newdate = '';
        if (!empty($pdata) && $pdata['step6'] == 1 && $pdata['can_edit'] == 2) {
            $date = $pdata['updated_on'];
            $timestamp = strtotime($date);
            $newdate = date('m/d/Y', $timestamp);
        }

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        return [ 'BasicInfoPartA' => $clientBasicInfoPartA, 'BasicInfo_PartB' => $clientBasicInfoPartB, 'income_profit_loss' => $value, 'final_date' => $newdate ];
    }

    public function client_doc_download_format(Request $request)
    {
        $client_id = $request->input('client_id');
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $download_support_format = $request->input('download_support_format');
        \App\Models\User::where('id', $client_id)->update(['download_support_format' => $download_support_format]);

        return response()->json(Helper::renderJsonSuccess('Format Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    private function sendNotification($id, $documentType, $status, $documentDeclineReason = '')
    {

        $attorney_id = Helper::getCurrentAttorneyId();
        $client = \App\Models\User::find($id);
        if ($documentType == 'Drivers_License') {
            $documentType = "Debtor’s Drivers Lic./Gov. ID";
        }
        if ($documentType == 'Co_Debtor_Drivers_License') {
            $documentType = "Co-Debtor’s Drivers Lic./Gov. ID";
        }
        if ($documentType == 'Social_Security_Card') {
            $documentType = "Debtor’s Social Security Card/ITIN";
        }
        if ($documentType == 'Co_Debtor_Social_Security_Card') {
            $documentType = "Co-Debtor’s Social Security Card/ITIN";
        }
        $documentType = str_replace('_', ' ', $documentType);
        $message = "Dear, " . $client->name . "\nYour document of ".$documentType." has been ".$status.".";
        $message_title = $documentType;
        $icon = false;
        $self_web_url = "#";


        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $attorney_company = (!empty($attorney_company)) ? $attorney_company : [];
        if ($client->document_pushed_notification == 1) {
            // $self_web_url = url('attorney/sign/document/'.$client->id);
            if ($client->device_type == 'Ios' && strlen($client->device_token) > 20) {
                $this->send_iphone_notification($client->device_token, $message_title, $message, "New Message Notification", 1);
            }
            if ($client->device_type == 'Android' && strlen($client->device_token) > 20) {
                $this->send_android_notification_new($client->device_token, $message_title, $message, "New Message Notification", 1);
            }
            if ($client->device_type == 'Web' && strlen($client->device_token) > 20) {
                $this->send_web_push_notification($client->device_token, $message, $message_title, $icon, $self_web_url);
            }
        }

        if ($client->document_email_notification == 1) {
            try {
                $message = "Your document of ".$documentType." has been ".$status." by your attorney.";
                if (AttorneySettings::isEmailEnabled($attorney_id, 'client_doc_status_mail', $id)) {
                    Mail::to($client->email)->send(new \App\Mail\DocumentNotification($client->name, $message, $message_title, Auth::user()->email, $attorney_company, $documentDeclineReason));
                }
            } catch (\Exception $e) {

            }
        }
    }


    public function update_doc_name(Request $request)
    {
        $input = $request->all();
        if (!Helper::isClientBelongsToAttorney($input['client_id'], Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        try {
            $doc_id = $input['doc_id'];
            $input['new_name'] = Helper::validate_doc_type($input['new_name']);
            $input['new_name'] = rtrim($input['new_name'], '_');
            \App\Models\ClientDocumentUploaded::where(['id' => $doc_id,'client_id' => $input['client_id']])->update(['updated_name' => $input['new_name']]);

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

    }

    public function update_doc_date(Request $request)
    {
        $input = $request->all();
        if (!Helper::isClientBelongsToAttorney($input['client_id'], Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        try {
            $doc_id = $input['doc_id'];
            \App\Models\ClientDocumentUploaded::where(['id' => $doc_id,'client_id' => $input['client_id']])->update(['document_month' => $input['new_date']]);

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

    }

    private static function getClientDocumentList($id)
    {
        $clientDocs = \App\Models\ClientDocuments::orderBy('document_name', 'DESC')->where('client_id', $id)->get();
        $clientDocs = !empty($clientDocs) ? $clientDocs->toArray() : [];

        return  array_column($clientDocs, 'document_name');
    }


    public function save_document_order(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $orders = [];

            if (isset($input['fOutMode'])) {
                unset($input['fOutMode']);
            }
            if (isset($input['fIsAjax'])) {
                unset($input['fIsAjax']);
            }

            $orders = !empty($input) ? current($input) : [];
            if (!empty($orders)) {
                $this->updateOrder($orders);
            }
        }

        return response()->json(Helper::renderJsonSuccess('Sorting order updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }


    public function updateOrder($order)
    {
        if (is_array($order) && sizeof($order) > 0) {
            foreach ($order as $i => $id) {
                if ($id < 1) {
                    continue;
                }
                \App\Models\ClientDocumentUploaded::where(['id' => $id])->update(['sort_order' => $i]);
            }

            return true;
        }

        return false;
    }

    public function update_tax_name_after_order(Request $request)
    {
        if ($request->isMethod('post')) {
            if (in_array($request->type, ['Last_Year_Tax_Returns','Prior_Year_Tax_Returns','Prior_Year_Two_Tax_Returns','Prior_Year_Three_Tax_Returns'])) {
                \App\Models\ClientDocumentUploaded::updatePreviousTaxFilesNames($request->type, $request->client_id, $request->attorney_id);
            }
        }
    }

    public function update_bank_name_after_order(Request $request)
    {
        if ($request->isMethod('post')) {
            $bankDocsArray = \App\Models\ClientDocuments::getAllBankDocumentKeysList($request->client_id);
            if (in_array($request->type, $bankDocsArray)) {
                \App\Models\ClientDocumentUploaded::updatePreviousBankFilesNames($request->type, $request->client_id);
            }
        }
    }

    public function client_doc_download($id)
    {
        $docData = \App\Models\ClientDocumentUploaded::where(['id' => $id])
            ->orderBy('id', 'desc')
            ->first();

        $docData = !empty($docData) ? $docData->toArray() : [];
        if (empty($docData)) {
            return redirect()->back()->with('error', 'Invalid Request');
        }
        if (!Helper::isClientBelongsToAttorney($docData['client_id'], Helper::getCurrentAttorneyId())) {
            return redirect()->back()->with('error', 'Invalid Request');
        }

        $paths = basename($docData['document_file']);
        $fname = explode('.', $paths);
        $updatedName = !empty($docData["updated_name"]) ? rtrim($docData["updated_name"], '.') : $paths;
        $ext = array_pop($fname);
        $filename = $updatedName.'.'.$ext;

        if ($docData["is_uploaded_to_s3"] == 1) {
            if (!Storage::disk('s3')->exists($docData['document_file'])) {
                return redirect()->back()->with('error', 'File does not exists.');
            }

            return redirect(Storage::disk('s3')->temporaryUrl(
                $docData['document_file'],
                now()->addDays(2),
                ['ResponseContentDisposition' => 'attachment;filename= '.rawurlencode($filename)]
            ));
        }

        if ($docData["is_uploaded_to_s3"] == 0) {
            if (!\File::exists(public_path().'/'.$docData['document_file'])) {
                return redirect()->back()->with('error', 'File does not exists.');
            }

            return DocumentHelper::generatePDFFile($filename, $docData['document_file']);
        }


    }

    public function mark_own_document(Request $request)
    {
        $client_id = $request->client_id;
        $document_type = $request->document_type;
        if ($request->isMethod('post')) {
            if ($client_id > 0 && $document_type != '') {
                \App\Models\User::mark_doc_own($client_id, $document_type);

                return response()->json(Helper::renderJsonSuccess('Document status has been changed successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        } else {
            return response()->json(Helper::renderJsonError('Invalid request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

    }

    public function relate_vehicle_reg_to_autoloan(Request $request)
    {
        if ($request->isMethod('post')) {
            $auto_loan_id = $request->auto_loan_id;
            $registration_id = $request->registration_id;
            $client_id = $request->client_id;
            \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id, 'id' => $auto_loan_id])->update(['relate_to_document' => $registration_id]);

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } else {
            return response()->json(Helper::renderJsonError('Invalid request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

    }

    public function check_zip_status(Request $request)
    {
        if ($request->isMethod('post')) {
            $client_id = $request->client_id;
            $zipStatus = \App\Models\DoctoZipFileScheduler::where(['client_id' => $client_id])->first();

            return response()->json(['status' => 1, 'msg' => "Information has been saved successfully.", 'data' => $zipStatus])->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function delete_bulk_documents(Request $request, $client_id, $documentType)
    {
        ini_set('max_execution_time', '300');

        $documents = [];
        if (isset($request->pdf_id) && !empty($request->pdf_id)) {
            $documents = \App\Models\ClientDocumentUploaded::where('client_id', $client_id)
                ->whereIn('id', $request->pdf_id)
                ->get();
        }

        $documents = !empty($documents) ? $documents->toArray() : [];

        if (empty($documents)) {
            return response()->json(Helper::renderJsonError('No documents found.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $s3FilesToDelete = [];

        DB::beginTransaction();
        try {
            foreach ($documents as $doc) {
                $docId = $doc['id'];

                // Log note
                $subject = "Document Deleted By " . Auth::user()->name;
                $note = "Document " . $doc['document_type'] . ' ' . $doc['updated_name'] . ' is deleted via Uploaded Client Documents page by ' . Auth::user()->name;

                \App\Models\ConciergeServiceNotes::create([
                    'client_id' => $client_id,
                    'subject' => $subject,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'note' => $note,
                    'added_by_id' => 1
                ]);

                // Delete from OCR
                \App\Models\UploadedOcrData::where(['client_id' => $client_id, 'id' => $docId])->delete();

                // Delete PayStubs if applicable
                if (in_array($documentType, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])) {
                    \App\Models\PayStubs::where(['client_id' => $client_id, 'document_id' => $docId])->delete();
                }

                // Delete from DB
                \App\Models\ClientDocumentUploaded::where('id', $docId)->delete();

                // Update related documents
                \App\Models\ClientDocumentUploaded::where(['relate_to_document' => $docId])->update(['relate_to_document' => 0]);

                // Notification
                self::createNotification($client_id, $documentType);

                // Prepare for S3 deletion (after commit)
                if ($documentType !== 'Vehicle_Information' && !empty($doc['document_file'])) {
                    $s3FilesToDelete[] = $doc['document_file'];
                }
            }

            DB::commit();

            // Perform S3 deletions post-commit
            foreach ($s3FilesToDelete as $filePath) {
                if (Storage::disk('s3')->exists($filePath)) {
                    $deleted = Storage::disk('s3')->delete($filePath);
                    if (!$deleted) {
                        Log::error("S3 deletion failed for: {$filePath}");
                    }
                }
            }

            return response()->json(Helper::renderJsonSuccess('Selected document file(s) are deleted successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Bulk document deletion failed: " . $e->getMessage());

            return response()->json(Helper::renderJsonError('Something went wrong during bulk deletion.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }


    public function accept_bulk_documents(Request $request, $client_id)
    {
        $documents = [];
        if (isset($request->pdf_id) && !empty($request->pdf_id)) {
            $documents = \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id])->whereIn('id', $request->pdf_id)->get();
        }
        $documents = !empty($documents) ? $documents->toArray() : [];
        if (!empty($documents)) {
            foreach ($documents as $doc) {
                $documentDeclineReason = '';
                $this->changeStatusDoc($client_id, $doc['document_type'], $doc['id'], \App\Models\ClientDocumentUploaded::STATUS_APPROVE, $doc['updated_name'], $documentDeclineReason);
            }
        }

        return response()->json(Helper::renderJsonSuccess('Selected document file(s) are accepted successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function decline_bulk_documents(Request $request, $client_id)
    {
        $documents = [];
        if (isset($request->pdf_id) && !empty($request->pdf_id)) {
            $documents = \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id])->whereIn('id', $request->pdf_id)->get();
        }
        $documents = !empty($documents) ? $documents->toArray() : [];
        if (!empty($documents)) {
            foreach ($documents as $doc) {
                $documentDeclineReason = 'Declined By Attorney';
                $this->changeStatusDoc($client_id, $doc['document_type'], $doc['id'], \App\Models\ClientDocumentUploaded::STATUS_DECLINE, $doc['updated_name'], $documentDeclineReason);
            }
        }

        return response()->json(Helper::renderJsonSuccess('Selected document file(s) are declined successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
    }


    private function changeStatusDoc($client_id, $doctype, $doc_id, $newStatus, $file_url, $documentDeclineReason = '')
    {
        $notif_body = '';
        $msg = 'Document Accepted Successfully!';
        $notif_body = "accepted by attorney";
        $notif_body = str_replace('_', ' ', $doctype.' '.$notif_body);
        $documentTypeName = str_replace('_', ' ', $doctype);
        $status = 'Accepted';
        if ($newStatus == \App\Models\ClientDocumentUploaded::STATUS_DECLINE) {
            $msg = 'Document Declined Successfully!';
            $notif_body = "declined by attorney";
            $status = 'Declined';
            $notif_body = str_replace("_", " ", $doctype.' '.$notif_body);
        }
        $data = [
            'client_id' => $client_id,
            'unotification_body' => $notif_body,
            'unotification_date' => date("Y-m-d H:i:s"),
            'unotification_is_read' => 0,
            'unotification_type' => \App\Models\Notifications::DOCUMENT_TYPE,
            'unotification_data' => json_encode(['file_url' => $file_url,'document_type' => $doctype,'document_status' => $newStatus,'document_decline_reason' => $documentDeclineReason]),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $cond = ['client_id' => $client_id,'document_type' => $doctype];
        if ($doc_id > 0) {
            $cond['id'] = $doc_id;
        }
        \App\Models\Notifications::create($data);
        $this->sendNotification($client_id, $doctype, $status, $documentDeclineReason);
        \App\Models\ClientDocumentUploaded::where($cond)->update(['document_status' => $newStatus,"document_decline_reason" => $documentDeclineReason]);

        return $msg;
    }

    public function showPdf($docId)
    {

        $document = \App\Models\ClientDocumentUploaded::where('id', $docId)
        ->select('document_file')
        ->first();
        $fileUrl = $document ? $document->document_file : null;

        $url = Storage::disk('s3')->temporaryUrl(
            $fileUrl,
            now()->addDays(2), // Expires in 10 minutes
            ['ResponseContentDisposition' => 'inline'] // Force inline display
        );

        return view('attorney.doc_mgmt.pdf_preview', compact('url'));
    }

    public function client_paystub_date_change(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $pay_date = $input['new_date'];
            $employer_id = $input['employer_id'];
            $client_id = $input['client_id'];
            $document_id = $input['document_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $docName = date('m.d.Y', strtotime($pay_date));
            $paystub_for_month = date('Ym', strtotime($pay_date));
            \App\Models\PayStubs::where(['client_id' => $client_id, 'document_id' => $document_id,'employer_id' => $employer_id])->update(['pay_date' => $pay_date, 'pay_period_start' => $pay_date,'pay_period_end' => $pay_date, 'document' => $docName,'paystub_for_month' => $paystub_for_month]);
            \App\Models\ClientDocumentUploaded::where(['id' => $document_id])->update(['document_paystub_date' => $docName,'updated_name' => $docName]);

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

}
