<?php

namespace App\Models;

use App\Helpers\AddressHelper;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyClientForDocs;

class AdminClientRequestedDocuments extends Model
{
    protected $table = 'tbl_admin_client_requested_documents';
    public $timestamps = false;
    protected $fillable = [
        'client_id',
        'requested_documents',
        'created_at',
        'updated_at',
        'added_by',
        'additional_data'
    ];

    public static function getRequestedDocuments($client_id)
    {
        $requestedDocuments = \App\Models\AdminClientRequestedDocuments::where(['client_id' => $client_id])->select('requested_documents')->first();
        $requestedDocuments = Helper::validate_key_value('requested_documents', $requestedDocuments);

        return !empty($requestedDocuments) ? json_decode($requestedDocuments, true) : [];
    }

    public static function getRequestedDocumentsAddedBy($client_id)
    {
        $requestedDocs = \App\Models\AdminClientRequestedDocuments::where(['client_id' => $client_id])->select(['requested_documents','added_by'])->first();
        $requestedDocs = !empty($requestedDocs) ? $requestedDocs->toArray() : [];
        $requestedDocsList = Helper::validate_key_value('requested_documents', $requestedDocs);
        $adeed_by = Helper::validate_key_value('added_by', $requestedDocs);

        return [
            'added_by' => $adeed_by,
            'requestedDocuments' => !empty($requestedDocsList) ? json_decode($requestedDocsList, true) : []
        ];
    }

    public static function notifyClientForRequestedDocs($input, $added_by, $request_by_admin = false)
    {

        $requestedDocs = Helper::validate_key_value('requestedDocs', $input);
        $client_id = Helper::validate_key_value('client_id', $input);
        $attorney_id = Helper::validate_key_value('attorney_id', $input);
        $list = Helper::validate_key_value('list', $input);
        $category = Helper::validate_key_value('category', $input);
        $message = Helper::validate_key_value('message', $input);
        $dateTime = date('Y-m-d H:i:s');

        if (!Helper::isClientBelongsToAttorney($client_id, $attorney_id)) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $requestedDocFinal = [];
        $additionalDocs = [];

        if (!empty($requestedDocs)) {
            foreach ($requestedDocs as $key => $value) {
                $key = trim($key);
                $docType = Helper::validate_doc_type($key);
                if (in_array($key, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])) {
                    if ($key == "Debtor_Pay_Stubs") {
                        $requestedDocFinal[$docType] = "Debtor Pay Stubs";
                    }
                    if ($key == "Co_Debtor_Pay_Stubs") {
                        $requestedDocFinal[$docType] = "Co-Debtor Pay Stubs";
                    }
                    $additionalDocs[$docType] = $value;
                } else {
                    $requestedDocFinal[$docType] = $value;
                }
            }
        }

        $alreadyAddedDocs = self::getRequestedDocuments($client_id);
        if (!empty($alreadyAddedDocs)) {
            $requestedDocFinal = array_merge($requestedDocFinal, $alreadyAddedDocs);
        }

        if (isset($requestedDocFinal['bussiness_profit_loss'])) {
            unset($requestedDocFinal['bussiness_profit_loss']);
        }

        $requestedDocsData = [
                'client_id' => $client_id,
                'requested_documents' => json_encode($requestedDocFinal),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
                'added_by' => $added_by,
                'additional_data' => json_encode($additionalDocs)
            ];
        AdminClientRequestedDocuments::updateOrCreate(['client_id' => $client_id], $requestedDocsData);

        $result = preg_replace('/<li[^>]*>/', '', $list);
        $result = preg_replace('/<\/li>/', ', ', $result);
        $result = trim($result, ', ');
        $result = str_replace("\n", '', $result);

        $user = User::find($client_id);

        if (AttorneySettings::isEmailEnabled($attorney_id, 'client_requested_doc_mail', $client_id)) {
            Mail::to($user['email'])->send(new NotifyClientForDocs($user['name'], $list, $message, $category));
        }
        $mobileMessage = $message;
        $msg = 'Please see your email for the documents needed to start to process your case.';
        if ($user['concierge_service'] == 1) {
            $msg = 'It was a pleasure meeting with you. Please see your email for the documents needed to submit your case to your attorney. If requested please setup another appointment [url='.Helper::CALENDY_CONCIERGE_APPOINTMENT_URL."?month=".date('Y-m')."]" ;
        }

        AddressHelper::getMessageResponseData($user['phone_no'], $msg, $user['name'], $user['email']);
        AdminNotes::Create([
                'adm_id' => $added_by,
                'client_id' => $client_id,
                'note' => $mobileMessage,
                'created_at' => $dateTime,
                'updated_at' => $dateTime
            ]);

        ConciergeServiceNotes::Create([
                'client_id' => $client_id,
                'added_by_id' => $added_by,
                'attachment_file' => '',
                'subject' => 'Requested Documents From Client(s)',
                'note' => $mobileMessage,
                'created_at' => $dateTime,
                'updated_at' => $dateTime
            ]);
    }

    public static function deleteTypeinRequDocs($client_id, $document_type)
    {
        $savedRequestedDocs = \App\Models\AdminClientRequestedDocuments::where(['client_id' => $client_id])->select('requested_documents')->first();
        $requestedDocuments = Helper::validate_key_value('requested_documents', $savedRequestedDocs);
        $requestedDocuments = !empty($requestedDocuments) ? json_decode($requestedDocuments, true) : [];
        if (!empty($requestedDocuments) && isset($requestedDocuments[$document_type])) {
            unset($requestedDocuments[$document_type]);
            \App\Models\AdminClientRequestedDocuments::where(['client_id' => $client_id])->update(['requested_documents' => json_encode($requestedDocuments)]);
        }
    }

}
