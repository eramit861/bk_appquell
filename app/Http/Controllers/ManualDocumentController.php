<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Traits\Common; // Trait
use App\Helpers\ClientHelper;
use App\Helpers\VideoHelper;
use App\Helpers\DocumentHelper;

class ManualDocumentController extends Controller
{
    use Common;

    public function shortenLinkManual($code)
    {
        $find = \App\Models\ShortLink::where('code', $code)->first();

        if (!$find) {
            abort(404, 'Manual link not found.');
        }

        // Get the full query string from the request
        $queryString = request()->getQueryString();

        // Build the redirect URL
        $redirectUrl = $find->manual_link;

        // Append query string if it exists
        if ($queryString) {
            $redirectUrl .= (strpos($redirectUrl, '?') === false ? '?' : '&') . $queryString;
        }

        return redirect($redirectUrl);
    }

    public function manual_upload(Request $request)
    {

        $token = '';
        $errorMsg = '';
        $attorney_id = 0;
        $client_id = 0;
        if ($request->has('token')) {
            $token = $request->input('token');
            $clientToken = $request->input('clientToken');
            try {
                $attorney_id = base64_decode($token);
                $client_id = base64_decode($clientToken);
                if (!\App\Models\User::where('id', '=', $attorney_id)->exists()) {
                    $errorMsg = 'Invalid token.';
                }
                if (!\App\Models\User::where('id', '=', $client_id)->exists()) {
                    $errorMsg .= 'Invalid client token.';
                }
            } catch (DecryptException $e) {
                $errorMsg = 'Invalid token.';
            }
        }
        if (!empty($errorMsg)) {
            die('Invalid token.');
        }
        $client = \App\Models\User::where('id', '=', $client_id)->first();


        $documentuploaded = \App\Models\ClientDocumentUploaded::where("client_id", $client_id)->select('document_type')->get()->toArray();
        $documentuploaded = array_column($documentuploaded, 'document_type');
        $client_attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->select('attorney_id')->first();
        $client_attorney = (!empty($client_attorney)) ? $client_attorney : [];

        $attorney_id = $client_attorney->attorney_id;
        $ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($client_id);
        $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

        $attorneydocuments = [];
        if (!empty($settingsAttorneyId)) {
            $attorneydocuments = \App\Models\AttorneyDocuments::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->pluck('document_name', 'document_type')->all();
        }

        $docsUploadInfo = ClientHelper::documentUploadInfo($client, $client_id, $attorney_id, true);

        $documentList = self::getDocList($client_id, $attorney_id);


        $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->select(['bank_statement_months','attorney_enabled_bank_statment','brokerage_months'])->first();
        $bank_statement_months = !empty($attorneySettings) ? Helper::validate_key_value('bank_statement_months', $attorneySettings) : '';


        $attorney_enabled_bank_statment = !empty($attorneySettings) ? Helper::validate_key_value('attorney_enabled_bank_statment', $attorneySettings, 'radio') : 0;
        $isBankStatementEnabled = ($attorney_enabled_bank_statment == 1) ? true : false;
        $brokerage_months = $attorneySettings && $attorneySettings->brokerage_months ? $attorneySettings->brokerage_months : 1;

        $creditReportVideos = [
            'iphone' => $this->getVideos(Helper::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE),
            'android' => $this->getVideos(Helper::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID),
            'desktop_laptop' => $this->getVideos(Helper::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE)
        ];
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

        return view('manual_upload', [   'token' => $token,
                                        'clientToken' => $clientToken,
                                        'documentList' => $documentList,
                                        'errorMsg' => $errorMsg,
                                        'client_name' => $client->name ?? '',
                                        'user' => $client,
                                        'client_id' => $client_id,
                                        'attorney_id' => $attorney_id,
                                        'documentuploaded' => $documentuploaded,
                                        'attorneydocuments' => $attorneydocuments,
                                        'docsUploadInfo' => $docsUploadInfo,
                                        'bank_statement_months' => $bank_statement_months,
                                        'isBankStatementEnabled' => $isBankStatementEnabled,
                                        'creditReportVideos' => $creditReportVideos,
                                        'brokerage_months' => $brokerage_months,
                                        'paypalVideos' => $paypalVideos,
                                        'cashAppVideos' => $cashAppVideos,
                                        'venmoVideos' => $venmoVideos,
        ]);
    }

    private function getVideos($step)
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[$step] ?? [];

        return VideoHelper::getVideos($tutorial);
    }

    public function getDocList($client_id, $attorney_id)
    {

        try {
            $client = \App\Models\User::where('id', '=', $client_id)->first();
            if (empty($client)) {
                die('<h1>This Link is no longer supported, please ask your attorney to share new link.</h1>');
            }
            $client_id = $client->id;

            $uploadedDocsList = $client->clientDocumentUploaded->toArray();
            // main docs

            $mainDocs = Helper::getDocuments($client->client_type, false, 1, 0, 0, 1, $attorney_id);

            $mainDocs = $mainDocs + Helper::getMiscDocs();
            // unset($mainDocs['Current_Auto_Loan_Statement']);

            $ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($client_id);
            $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
            $is_associate = !empty($ClientsAssociateId) ? 1 : 0;


            $additionalDocuments = \App\Models\AttorneyDocuments::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->pluck('document_name', 'document_type')->all();
            // additional Docs

            $additionalDocs = [];
            foreach ($additionalDocuments as $key => $value) {
                foreach ($uploadedDocsList as $data) {
                    if ($data['document_type'] == $key) {
                        $additionalDocs[$key] = $value;
                        break;
                    }
                }
            }
            $excludeMortgage = \App\Models\NotOwnDocuments::where(['client_id' => $client_id, 'document_type' => 'Current_Mortgage_Statement_1_1'])->exists();

            $mergedDocuments = array_merge($mainDocs, $additionalDocs);



            $excludeDocs = \App\Models\AttorneyExcludeDocs::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->first();
            $excludeDocs = !empty(json_decode($excludeDocs)) && !empty($excludeDocs->doc_type_json) ? json_decode($excludeDocs->doc_type_json, 1) : [];
            array_push($excludeDocs, 'Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report');
            if ($excludeMortgage) {
                array_push($excludeDocs, 'Current_Mortgage_Statement');
            }
            $filteredArray = [];
            foreach ($mergedDocuments as $key => $value) {
                if (!in_array($key, $excludeDocs)) {
                    $filteredArray[$key] = $value;
                }
            }

            $attorneyDocuments = \App\Models\AttorneyDocuments::orderBy('id', 'DESC')->where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->get();
            $attorneyDocuments = !empty($attorneyDocuments) ? $attorneyDocuments->toArray() : [];
            $attorneyDocuments = array_column($attorneyDocuments, 'document_name');

            foreach ($attorneyDocuments as $value) {
                $filteredArray[$value] = $value;
            }

            return $filteredArray;
        } catch (DecryptException $e) {
            die('<h1>This Link is no longer supported, please ask your attorney to share new link.</h1>');
        }
    }


    public function check_manual_upload_email_and_id(Request $request)
    {
        if ($request->isMethod('post')) {
            $attorney_id = base64_decode($request->token);
            $client_id = $request->id;

            $userTblEmails = \App\Models\User::where('email', $request->email)->exists();
            if ($userTblEmails && empty($client_id)) {
                $client_id = \App\Models\User::where('email', $request->email)->select('id')->first();
            }

            if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            return response()->json(Helper::renderJsonSuccess("Valid user"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function manual_document_uploads(Request $request)
    {
        $client_id = $request->client_id;
        try {
            if ($request->isMethod('post')) {
                if ($request->hasFile('document_file')) {
                    $files = $request->file('document_file');
                    $i = 0;
                    if (in_array($request->document_type, ['Last_Year_Tax_Returns', 'Prior_Year_Tax_Returns', 'Prior_Year_Two_Tax_Returns', 'Prior_Year_Three_Tax_Returns'])) {
                        $files = \App\Models\ClientDocumentUploaded::updateTaxFilesNames($files, $request->document_type, $client_id);
                    }
                    $bankDocsArray = \App\Models\ClientDocuments::getAllBankDocumentKeysList($client_id);
                    if (in_array($request->document_type, $bankDocsArray)) {
                        $files = \App\Models\ClientDocumentUploaded::updateBankFilesNames($request->all(), $client_id);
                    }
                    foreach ((array)$files as $file) {
                        $errors = DocumentHelper::validateFile($file);
                        if (!empty($errors)) {
                            return response()->json(Helper::renderJsonError(json_encode($errors)))->header('Content-Type: application/json;', 'charset=utf-8');
                        }
                        $extension_from_mime_type = DocumentHelper::getExtensionFromMimeType($file->getMimeType());
                        $extension = !empty($file->getClientOriginalExtension()) ? $file->getClientOriginalExtension() : $extension_from_mime_type;

                        $document_type = $next[$i] ?? $request->document_type ?? '';
                        $document_month = $request->statement_month ?? null;
                        if (!empty($document_month)) {
                            $document_month = Helper::validate_key_value($i, $document_month);
                        }
                        $document_paystub_date = $request->paystub_date ?? null;
                        if (!empty($document_paystub_date)) {
                            $document_paystub_date = Helper::validate_key_value($i, $document_paystub_date);
                            $document_paystub_date = str_replace('/', '.', $document_paystub_date);
                        }
                        \App\Models\NotOwnDocuments::where(['client_id' => $client_id, 'document_type' => $document_type])->delete();
                        $input = $request->all();
                        $employer_id = Helper::validate_key_value('employer_id', $input, 'radio');
                        $selected_debtor = $request->debtor_select ?? '';
                        $selected_debtor = Helper::validate_key_value($i, $selected_debtor);
                        $docId = \App\Models\ClientDocumentUploaded::storeClientSideDocument($client_id, $file, $document_type, '', 0, 0, $extension, false, $document_month, $document_paystub_date, $selected_debtor);
                        if (is_array($docId) && isset($docId['status']) && $docId['status'] == false) {
                            return response()->json(Helper::renderJsonError($docId['message']))->header('Content-Type: application/json;', 'charset=utf-8');
                        }
                        if ($employer_id) {
                            \App\Models\PayStubs::dummyPaystubEntry($input, $docId, '', $i);
                        }
                        $i++;
                    }

                    return response()->json(Helper::renderJsonSuccess('Document has been uploaded successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
                } else {
                    return response()->json(Helper::renderJsonError('Document is Required.'))->header('Content-Type: application/json;', 'charset=utf-8');
                }
            }
        } catch (\Exception $e) {
            return response()->json(Helper::renderJsonError('An error occurred during upload: ' . $e->getMessage()))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function mark_not_own_document(Request $request)
    {
        $client_id = $request->client_id;
        $document_type = $request->document_type;
        if ($request->isMethod('post')) {
            if ($client_id > 0 && $document_type != '') {
                $status = $request->status ?? '';
                if (in_array($status, ['0', '1'])) {
                    if ($status == '0') {
                        \App\Models\NotOwnDocuments::where(['client_id' => $client_id,'document_type' => $document_type])->delete();
                    }
                    if ($status == '1') {
                        \App\Models\User::mark_doc_not_own($client_id, $document_type);
                    }

                    return response()->json(Helper::renderJsonSuccess('Document status has been changed successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
                }
                \App\Models\User::mark_doc_not_own($client_id, $document_type);

                return response()->json(Helper::renderJsonSuccess('Document status has been changed successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        } else {
            return response()->json(Helper::renderJsonError('Invalid request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

}
