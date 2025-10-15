<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Helpers\DateTimeHelper;
use App\Helpers\Helper;
use App\Services\Client\CacheBasicInfo;

class PdfToJson extends Model
{
    use HasFactory;
    public const STATUS_COMPLETED = 1;
    public const STATUS_PROGRESS = 2;
    public const STATUS_FAILED = 3;
    protected $guarded = [];
    protected $table = 'pdf_ocr_to_json';
    public $timestamps = false;

    public static function colorCode($status)
    {
        $array = [
         self::STATUS_COMPLETED => 'drop-green',
         self::STATUS_PROGRESS => 'drop-yellow',
         self::STATUS_FAILED => 'drop-red',
         0 => 'drop-gray' ];

        return isset($array[$status]) ? $array[$status] : '';
    }

    public static function getStatusName($status)
    {
        $array = [
         self::STATUS_COMPLETED => "Completed",
         self::STATUS_PROGRESS => 'In-Progress',
         self::STATUS_FAILED => 'Failed',
         0 => 'Not Started Yet' ];

        return isset($array[$status]) ? $array[$status] : '';
    }

    public static function getRequests($client_id, $type = 'credit_report')
    {
        $reqData = \App\Models\PdfToJson::where(['client_id' => $client_id])->get();
        $reqData = !empty($reqData) ? $reqData->toArray() : [];

        return $reqData;
    }

    public function uploadFileToGraphQl($clientId, $file = '', $docType, $docID = null, $employer_id = null)
    {
        if (empty($docID)) {
            $docID = \App\Models\ClientDocumentUploaded::storeClientSideDocument($clientId, $file, $docType, '', 1, 0);
            if (is_array(($docID)) && isset($docID['status']) && $docID['status'] == false) {
                return response()->json(Helper::renderJsonError($docID['message']))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }

        $document = \App\Models\ClientDocumentUploaded::where('id', $docID)->select('file_s3_url')->first();
        // Check if the document exists and assign the file path to $doc['document_file']
        $files3Path = ($document) ? $document->file_s3_url : null;
        $uid = hash('sha256', $clientId . microtime(true));
        $endpoint = env('GRAPHQL_ENDPOINT');
        $headers = [
            'x-api-key' => env('GRAPHQL_API_KEY'),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        if (empty($clientId)) {
            return response()->json(['error' => 'Client ID is required'], 400);
        }



        $query = <<<GQL
        mutation ScrapeDocument(\$uid: ID!, \$type: DocumentType!, \$filePath: String!) {
            scrapeDocument(
                uid: \$uid,
                type: \$type,
                filePath: \$filePath
            ) {
                uid
                success
                message
            }
        }
        GQL;

        \Log::info('query new scrape doc= '.$query.'for uid '.$uid);
        \Log::info('s3 path=' . $files3Path . ' for uid ' . $uid . ' docType=' . $docType . ' employer_id=' . ($employer_id ?? 'null'));
        $variables = [
            'uid' => $uid,
            'type' => $this->getDocumentType($docType) , // This must be a valid value from the `DocumentType` enum
            'filePath' => $files3Path,
        ];

        // Make HTTP Request
        $response = Http::withHeaders($headers)
            ->post($endpoint, [
                'query' => $query,
                'variables' => $variables
            ]);

        // Debug Response
        $pdfTojsonData = [
            'client_id' => $clientId,
            'company_name' => '',
            'status' => self::STATUS_PROGRESS,
            'document_id' => $docID,
            'request_type' => $docType,
            'json' => json_encode($response->json()),
            'refrence_id' => $uid,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        if (!empty($employer_id)) {
            $pdfTojsonData['employer_id'] = $employer_id;
        }

        cache()->forget('ai_processed_requests');
        \App\Models\PdfToJson::updateOrCreate(
            ['client_id' => $clientId,
            'document_id' => $docID,
            'request_type' => $docType],
            $pdfTojsonData
        );

        return $response->json();
    }

    /**
     * Returns the Document type for GraphQL subscription
     *
     * @param string $documentType
     */
    private function getDocumentType($documentType)
    {
        $graphQlDoc = '';
        switch ($documentType) {
            case ClientDocumentUploaded::DEBTOR_CREDITOR_REPORT:
            case ClientDocumentUploaded::CO_DEBTOR_CREDITOR_REPORT:
                $graphQlDoc = 'CREDITREPORT';
                break;
            case ClientDocumentUploaded::DEBTOR_PAY_STUB:
            case ClientDocumentUploaded::CO_DEBTOR_PAY_STUB:
                $graphQlDoc = 'PAYSTUB';
                break;
        }

        return $graphQlDoc;
    }


    private function importReportDataFromGraphQl($response, $documentType)
    {

        \Log::info("importReportDataFromGraphQl", [$documentType]);
        switch ($documentType) {
            case ClientDocumentUploaded::DEBTOR_CREDITOR_REPORT:
            case ClientDocumentUploaded::CO_DEBTOR_CREDITOR_REPORT:
                $uid = $response['payload']['data']['onReportSent']['uid'];
                $resDataToSave = $response['payload']['data']['onReportSent']['accounts'];
                $other_names = !empty($response['payload']['data']['onReportSent']['other_names']) ? $response['payload']['data']['onReportSent']['other_names'] : [] ;
                if (!empty($other_names) && $documentType == ClientDocumentUploaded::DEBTOR_CREDITOR_REPORT) {
                    PdfToJson::importOtherNamesIntoBasicInfo($other_names, $uid);
                }
                if (!empty($other_names) && $documentType == ClientDocumentUploaded::CO_DEBTOR_CREDITOR_REPORT) {
                    PdfToJson::importOtherNamesIntoSpouseBasicInfo($other_names, $uid);
                }
                $this->importintoCreditReportFromGraphql($resDataToSave, $uid);
                break;
            case ClientDocumentUploaded::DEBTOR_PAY_STUB:
            case ClientDocumentUploaded::CO_DEBTOR_PAY_STUB:
                $uid = $response['payload']['data']['onSendPayStub'][0]['uid'];
                $resDataToSave = $response['payload']['data']['onSendPayStub'][0];
                $this->importPayStubReportFromGraphql($resDataToSave, $uid);
                break;
        }
    }


    private function importPayStubReportFromGraphql($payStub, $uid)
    {
        \Log::info("importPayStubReportFromGraphql", [$payStub, $uid]);
        $data = \App\Models\PdfToJson::where('refrence_id', $uid)->select('id', 'client_id', 'request_type', 'employer_id', 'document_id')->first();
        if (isset($payStub) && !empty($payStub)) {
            if (!empty($data->id)) {
                \App\Models\PayStubs::importPaystubJson($data->client_id, $data->request_type, $data->document_id, $data->employer_id, $payStub);
            }
        }
    }

    public static function importintoCreditReportFromGraphql($responseJson, $uid)
    {
        $data = \App\Models\PdfToJson::where('refrence_id', $uid)->select('id', 'client_id', 'request_type')->first();
        $pdf_to_json_id = null;
        $client_id = null;
        $request_type = null;
        if ($data) {
            $pdf_to_json_id = $data->id;
            $client_id = $data->client_id;
            $request_type = $data->request_type;
        }
        foreach ($responseJson as $creditor) {
            $address = '';
            $accntno = '';
            $address = $creditor['address']['address'] ?? '';
            $accntno = $creditor['account_number'] ?? '';
            $accntno = !empty($accntno) ? substr($accntno, -4) : '';
            $extractedDate = DateTimeHelper::formatToMonthYearFromAnyFormat($creditor['date_incurred']);
            $obj = [
                'client_id' => $client_id,
                'fullName' => $creditor['creditor_name'] ?? '',
                'address' => $address,
                'city' => $creditor['address']['city'] ?? '',
                'state' => $creditor['address']['state'] ?? '',
                'zip' => $creditor['address']['zipCode'] ?? '',
                'creditBusinessType' => '',
                'creditLiabilityAccountIdentifier' => $accntno,
                'creditLiabilityAccountOpenedDate' => '',
                'creditLiabilityAccountReportedDate' => '',
                'creditLiabilityAccountType' => '',
                'creditLiabilityAccountOwnershipType' => ($request_type == 'Co_Debtor_Creditor_Report' ? 'Debtor 2' : 'Debtor 1'),
                'creditLiabilityAccountStatusType' => '',
                'creditLiabilityMonthlyPaymentAmount' => $creditor['monthly_payment'] ?? '',
                'creditLiabilityPastDueAmount' => $creditor['current_balance'] ?? '',
                'creditLiabilityTermsSourceType' => '',
                'creditLiabilityUnpaidBalanceAmount' => '',
                'creditLoanType' => $creditor['account_type'] ?? '',
                'detailCreditBusinessType' => '',
                'date_incurred' => $extractedDate,
                'pdf_to_json_id' => $pdf_to_json_id,
                'is_ai_processed' => 1
            ];
            \App\Models\CrsCreditReport::updateOrCreate($obj, $obj);
        }
    }

    public static function importOtherNamesIntoBasicInfo($other_names, $uid)
    {
        $data = \App\Models\PdfToJson::where('refrence_id', $uid)->select('id', 'client_id', 'request_type')->first();
        $client_id = null;
        if ($data) {
            $client_id = $data->client_id;
        }
        if (empty($client_id) || empty($other_names)) {
            return;
        }

        $existingAnyOtherNameData = ClientAnyOtherNameData::where('client_id', $client_id)
            ->select(['name','middle_name', 'last_name'])
            ->first();

        $existingAnyOtherNameData = isset($existingAnyOtherNameData) && !empty($existingAnyOtherNameData)
            ? $existingAnyOtherNameData->toArray()
            : [
                'name' => [],
                'middle_name' => [],
                'last_name' => []
            ];

        $existingAnyOtherNameData['name'] = json_decode($existingAnyOtherNameData['name'], true) ?? [];
        $existingAnyOtherNameData['middle_name'] = json_decode($existingAnyOtherNameData['middle_name'], true) ?? [];
        $existingAnyOtherNameData['last_name'] = json_decode($existingAnyOtherNameData['last_name'], true) ?? [];

        foreach ($other_names as $index => $fullName) {
            if ($index >= 3) {
                break;
            }

            $parts = explode(' ', $fullName);

            if (count($parts) === 3) {
                [$first, $middle, $last] = $parts;
            } elseif (count($parts) === 2) {
                [$first, $last] = $parts;
                $middle = null;
            } else {
                continue;
            }

            $existingAnyOtherNameData['name'][$index] = $first;
            $existingAnyOtherNameData['middle_name'][$index] = $middle ?? '';
            $existingAnyOtherNameData['last_name'][$index] = $last;
        }

        ClientBasicInfoPartA::where('client_id', $client_id)->update(['any_other_name' => 1, 'updated_on' => date('Y-m-d H:i:s')]);
        ClientAnyOtherNameData::updateOrCreate(
            ['client_id' => $client_id],
            [
                'name' => json_encode($existingAnyOtherNameData['name']),
                'middle_name' => json_encode($existingAnyOtherNameData['middle_name']),
                'last_name' => json_encode($existingAnyOtherNameData['last_name']),
            ]
        );

        // clear cache for client basic information
        CacheBasicInfo::forgetBasicInformationCache($client_id);

    }

    public static function importOtherNamesIntoSpouseBasicInfo($other_names, $uid)
    {
        $data = \App\Models\PdfToJson::where('refrence_id', $uid)->select('id', 'client_id', 'request_type')->first();
        $client_id = null;

        $client_id = 1014;

        if ($data) {
            $client_id = $data->client_id;
        }
        if (empty($client_id) || empty($other_names)) {
            return;
        }

        $existingAnyOtherNameData = ClientBasicInfoPartB::where('client_id', $client_id)
            ->select(['spouse_other_name','spouse_other_middle_name', 'spouse_other_last_name'])
            ->first();

        $existingAnyOtherNameData = isset($existingAnyOtherNameData) && !empty($existingAnyOtherNameData)
            ? $existingAnyOtherNameData->toArray()
            : [
                'spouse_other_name' => [],
                'spouse_other_middle_name' => [],
                'spouse_other_last_name' => []
            ];


        $existingAnyOtherNameData['spouse_other_name'] = json_decode($existingAnyOtherNameData['spouse_other_name'], true) ?? [];
        $existingAnyOtherNameData['spouse_other_middle_name'] = json_decode($existingAnyOtherNameData['spouse_other_middle_name'], true) ?? [];
        $existingAnyOtherNameData['spouse_other_last_name'] = json_decode($existingAnyOtherNameData['spouse_other_last_name'], true) ?? [];

        foreach ($other_names as $index => $fullName) {
            if ($index >= 3) {
                break;
            }

            $parts = explode(' ', $fullName);

            if (count($parts) === 3) {
                [$first, $middle, $last] = $parts;
            } elseif (count($parts) === 2) {
                [$first, $last] = $parts;
                $middle = null;
            } else {
                continue;
            }

            $existingAnyOtherNameData['spouse_other_name'][$index] = $first;
            $existingAnyOtherNameData['spouse_other_middle_name'][$index] = $middle ?? '';
            $existingAnyOtherNameData['spouse_other_last_name'][$index] = $last;
        }

        ClientBasicInfoPartB::updateOrCreate(
            ['client_id' => $client_id],
            [
                'client_id' => $client_id,
                'spouse_any_other_name' => 1,
                'spouse_other_name' => json_encode($existingAnyOtherNameData['spouse_other_name']),
                'spouse_other_middle_name' => json_encode($existingAnyOtherNameData['spouse_other_middle_name']),
                'spouse_other_last_name' => json_encode($existingAnyOtherNameData['spouse_other_last_name']),
                'updated_on' => date('Y-m-d H:i:s')
            ]
        );

        // clear cache for client basic information
        CacheBasicInfo::forgetBasicInformationCache($client_id);

    }

    public static function handlePaystubJson($payStubs, $uid)
    {
        $data = \App\Models\PdfToJson::where('refrence_id', $uid)->select('id', 'client_id', 'request_type', 'employer_id', 'document_id')->first();
        if (!empty($data->id)) {
            foreach ($payStubs as $payStub) {
                \App\Models\PayStubs::importPaystubJson($data->client_id, $data->request_type, $data->document_id, $data->employer_id, $payStub);
            }
        }
    }



    private function unsubscribeFromEvent($client, $subscriptionId)
    {
        $unsubscribeMessage = [
            'id' => $subscriptionId,
            'type' => 'stop',
        ];
        \App\Models\PdfToJson::where('refrence_id', $subscriptionId)->update(['status' => \App\Models\PdfToJson::STATUS_COMPLETED,'updated_at' => date("Y-m-d H:i:s")]);
        $client->send(json_encode($unsubscribeMessage));
        \Log::info("Unsubscribed from event with ID: " . $subscriptionId);
    }

    public static function getCrsReportStatus($id)
    {
        $report = self::where('client_id', $id)
            ->whereIn('status', [0, self::STATUS_PROGRESS, self::STATUS_FAILED])
            ->orderBy('id', 'desc')
            ->select('status')
            ->first();

        if ($report) {
            return $report->status;
        }

        return 0;
    }

    public static function getCrsReportExistsStatus($id)
    {
        return self::where('client_id', $id)
            ->whereIn('request_type', ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report'])
            ->exists();
    }

    public static function getStatusBadge($statusCode)
    {
        switch ($statusCode) {
            case 0:
                return '<span class="status-badge status-not-started"><i class="ml-0 bi bi-hourglass"></i> Not Started</span>';
            case 1:
                return '<span class="status-badge status-completed"><i class="ml-0 bi bi-check-circle"></i> Completed</span>';
            case 2:
                return '<span class="status-badge status-in-progress"><i class="ml-0 bi bi-clock"></i> In Progress</span>';
            case 3:
                return '<span class="status-badge status-failed"><i class="ml-0 bi bi-x-circle"></i> Failed</span>';
            default:
                return '';
        }
    }

}
