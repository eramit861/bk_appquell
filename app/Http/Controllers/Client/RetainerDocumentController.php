<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\Common; // Trait
use App\Helpers\Helper;
use App\Helpers\ClientHelper;
use App\Models\ClientDocumentUploaded;
use App\Models\ClientDocuments;
use App\Models\NotOwnDocuments;
use App\Models\PayStubs;
use App\Models\ClientsAttorney;
use App\Models\AttorneyDocuments;
use App\Models\FormsStepsCompleted;
use App\Models\AttorneySettings;
use App\Helpers\VideoHelper;
use App\Helpers\DocumentHelper;
use App\Helpers\ArrayHelper;
use App\Models\ClientsAssociate;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class RetainerDocumentController extends Controller
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

    public function __construct()
    {
        // Initialization if needed
    }

    /**
     * Handles document uploads.
     */
    public function document_uploads(Request $request)
    {
        $client_id = Auth::user()->id;
        try {
            $user = User::find($client_id);
            if (!$user) {
                return $this->errorResponse('User not found.');
            }

            $client_attorney = ClientsAttorney::where('client_id', $client_id)->first();
            if (!$client_attorney) {
                return $this->errorResponse('Attorney not found.');
            }
            $attorney_id = $client_attorney->attorney_id ?? null;
            $client_progress = FormsStepsCompleted::getStepCompletionData($client_id, $user->client_type);

            if (
                isset($client_progress) &&
                is_array($client_progress) &&
                ($client_progress['all_percentage'] ?? 0) != 100 &&
                AttorneySettings::isDocumentUploadRestrictionEnabled($attorney_id)
            ) {
                return $this->errorResponse('Please complete the questionnaire to enable document upload.');
            }

            if ($request->isMethod('post')) {
                if (!$request->hasFile('document_file')) {
                    return $this->errorResponse('Document is required.');
                }
                $document_type = $request->document_type;
                if (!$document_type) {
                    return $this->errorResponse('Document type is required.');
                }

                $files = $this->handleSpecialDocumentTypes($request, $client_id);
                if (empty($files) || !is_array($files)) {
                    return $this->errorResponse('No valid files to upload.');
                }

                $paystubId = '';
                $dataToReturn = [];
                $paystub_date_data = Helper::validate_key_value('paystub_date', $request);

                foreach ($files as $i => $file) {
                    $errors = DocumentHelper::validateFile($file);
                    if (!empty($errors)) {
                        return $this->errorResponse(json_encode($errors));
                    }

                    $document_month = Helper::validate_key_value($i, $request->statement_month ?? null);
                    $document_paystub_date = $this->formatPaystubDate($request, $i);
                    $paystub_date = Helper::validate_key_value($i, $paystub_date_data ?? []);
                    $paystub_date_for_view = $paystub_date ? date("M d, Y", strtotime($paystub_date)) : '';
                    NotOwnDocuments::where(['client_id' => $client_id, 'document_type' => $document_type])->delete();
                    $selected_debtor = $request->debtor_select ?? '';
                    $selected_debtor = Helper::validate_key_value($i, $selected_debtor);
                    $extension = $this->getFileExtension($file);
                    $docId = '';

                    if ((env('ENABLED_CLIENT_SIDE_CREDIT_REPORT', false) == true && in_array($document_type, $this->aiReports) && User::isCreditReportEnabledForClient($client_id, $document_type))) {
                        try {
                            $pdfToJson = new \App\Models\PdfToJson();
                            $resData = $pdfToJson->uploadFileToGraphQl($client_id, $file, $document_type);
                            if (isset($resData['data']['scrapeDocument']['success']) && $resData['data']['scrapeDocument']['success'] == 1) {
                                return $this->successResponse('Document has been uploaded successfully. The Magic takes some time. We will notify you when it\'s done.');
                            }
                        } catch (\Exception $e) {
                            Log::error("Error uploading file to GraphQL for client_id: $client_id", ['exception' => $e]);

                            return $this->errorResponse('Failed to upload credit report document.');
                        }
                    } else {
                        try {
                            $docId = ClientDocumentUploaded::storeClientSideDocument(
                                $client_id,
                                $file,
                                $document_type,
                                '',
                                0,
                                0,
                                $extension,
                                false,
                                $document_month,
                                $document_paystub_date,
                                $selected_debtor
                            );
                            if (is_array($docId) && isset($docId['status']) && $docId['status'] == false) {
                                return $this->errorResponse($docId['message']);
                            }
                        } catch (\Exception $e) {
                            return $this->errorResponse('Failed to upload document.');
                        }
                    }

                    if (Helper::validate_key_value('employer_id', $request->all(), 'radio') > 0) {
                        try {
                            $paystubId = PayStubs::dummyPaystubEntry($request->all(), $docId, '', $i);
                            $paystubDeleteRoute = route('paystub_delete_client_side');
                            $dataToReturn = [
                                'deleteFunction' => "deletePaystubFromClientSide(this, '{$paystubDeleteRoute}', '{$paystubId}', '{$docId}', '{$paystub_date_for_view}', '{$client_id}')"
                            ];
                        } catch (\Exception $e) {
                            Log::error("Exception while creating dummy paystub entry for client_id: $client_id", ['exception' => $e]);
                            // Continue, but don't break the upload process
                        }
                    }
                }

                return $this->successResponse("Document has been uploaded successfully.", $dataToReturn);
            }
        } catch (\Exception $e) {
            Log::error("Exception in document_uploads for client_id: $client_id", ['exception' => $e]);

            return $this->errorResponse('An unexpected error occurred. Please try again later.');
        }
    }

    private static function getEmployerIdfromrequest($input, $index = '')
    {
        $employerIdData = Helper::validate_key_value('employer_id', $input);

        return ArrayHelper::getValidatedDataForDummyEntry($employerIdData, $index, 'radio');
    }

    /**
     * Fetches uploaded documents for the client.
     */
    public function listUploadedDocuments(Request $request)
    {
        $client_id = Auth::user()->id;

        if ($request->isMethod('get')) {
            $documentuploaded = ClientDocumentUploaded::where('client_id', $client_id)->pluck('document_type')->toArray();
            $client_attorney = ClientsAttorney::where('client_id', $client_id)->first();

            $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
            $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : ($client_attorney->attorney_id ?? null);
            $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

            $attorneydocuments = $client_attorney ?
                AttorneyDocuments::where(['attorney_id' => $settingsAttorneyId , 'is_associate' => $is_associate])->pluck('document_name', 'document_type')->toArray() : [];

            $stepData = FormsStepsCompleted::where('client_id', operator: $client_id)->first();
            $hidebtn = $stepData && $stepData->step6 == 1 && $stepData->can_edit == 2;

            $attorneySettings = AttorneySettings::where(['attorney_id' => $settingsAttorneyId , 'is_associate' => $is_associate])->first();
            $bank_statement_months = Helper::validate_key_value('bank_statement_months', $attorneySettings);
            $isBankStatementEnabled = $attorneySettings && $attorneySettings->attorney_enabled_bank_statment == 1;
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

            return view('client.document_upload', [
                'hidebtn' => $hidebtn,
                'client' => true,
                'documentuploaded' => $documentuploaded,
                'attorneydocuments' => $attorneydocuments,
                'docsUploadInfo' => ClientHelper::documentUploadInfo(Auth::user(), $client_id, $client_attorney->attorney_id ?? null, true),
                'bank_statement_months' => $bank_statement_months,
                'isBankStatementEnabled' => $isBankStatementEnabled,
                'creditReportVideos' => $creditReportVideos,
                'paypalVideos' => $paypalVideos,
                'cashAppVideos' => $cashAppVideos,
                'venmoVideos' => $venmoVideos,
                'brokerage_months' => $brokerage_months,
            ]);
        }
    }

    /**
     * Helper to get videos.
     */
    private function getVideos($step)
    {
        return VideoHelper::getVideos(VideoHelper::getAdminVideos()[$step] ?? []);
    }

    /**
     * Returns an error response.
     */
    private function errorResponse($message)
    {
        return response()->json(Helper::renderJsonError($message))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    /**
     * Returns a success response.
     */
    private function successResponse($message)
    {
        return response()->json(Helper::renderJsonSuccess($message))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    /**
     * Handle special document types.
     */
    private function handleSpecialDocumentTypes(Request $request, $client_id)
    {
        $files = $request->file('document_file');

        if (in_array($request->document_type, ['Last_Year_Tax_Returns', 'Prior_Year_Tax_Returns', 'Prior_Year_Two_Tax_Returns', 'Prior_Year_Three_Tax_Returns'])) {
            $files = ClientDocumentUploaded::updateTaxFilesNames($files, $request->document_type, $client_id);
        }

        $bankDocsArray = ClientDocuments::getAllBankDocumentKeysList($client_id);
        if (in_array($request->document_type, $bankDocsArray)) {
            $files = ClientDocumentUploaded::updateBankFilesNames($request->all(), $client_id);
        }

        return $files;
    }

    /**
     * Get allowed extensions for the document type.
     */
    private function getAllowedExtensions($document_type)
    {
        $defaultExtensions = ArrayHelper::getAllowedFileExtensionArray();

        return $defaultExtensions;
    }

    /**
     * Get the file extension.
     */
    private function getFileExtension($file)
    {
        $mimeType = $file->getMimeType();
        $extension = strtolower($file->getClientOriginalExtension() ?: explode('/', $mimeType)[1] ?? '');

        return $extension;
    }

    /**
     * Format paystub date.
     */
    private function formatPaystubDate(Request $request, $index)
    {
        $paystub_date = Helper::validate_key_value($index, $request->paystub_date ?? null);

        return $paystub_date ? str_replace('/', '.', $paystub_date) : null;
    }

    public function client_documents_download_popup(Request $request)
    {
        return ClientDocumentUploaded::show_client_documents_download_popup($request);
    }

    public function client_documents_download_popup_single_delete(Request $request)
    {
        return ClientDocumentUploaded::remove_single_client_document($request);
    }

}
