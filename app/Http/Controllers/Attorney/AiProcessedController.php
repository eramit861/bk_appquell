<?php

namespace App\Http\Controllers\Attorney;

use App\Helpers\Helper;
use App\Http\Controllers\AttorneyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AiProcessedController extends AttorneyController
{
    public function index(Request $request)
    {
        $loggedUserId = Auth::user()->id;
        $cacheKey = 'ai_processed_requests_' . $loggedUserId;
        $requests = cache()->remember($cacheKey, 300, function () use ($loggedUserId) {
            $query = DB::table('pdf_ocr_to_json as ocr')
                ->leftJoin('users as client', 'ocr.client_id', '=', 'client.id')
                ->leftJoin('tbl_clients_attorney as ca', 'ocr.client_id', '=', 'ca.client_id')
                ->leftJoin('users as attorney', 'ca.attorney_id', '=', 'attorney.id')
                ->leftJoin('tbl_client_document_uploaded as cdu', 'ocr.document_id', '=', 'cdu.id')
                ->select([
                    'ocr.*',
                    'cdu.document_file',
                    'client.name as client_name',
                    'attorney.name as attorney_name',
                    'attorney.id as attorney_id'
                ]);

            if ($loggedUserId != 1) {
                $query->where('ca.attorney_id', $loggedUserId);
            }

            $query->orderByDesc(
                DB::raw('(SELECT MAX(id) FROM pdf_ocr_to_json WHERE client_id = ocr.client_id)')
            );

            $query->orderByRaw("
                CASE 
                WHEN ocr.request_type IN ('Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs') 
                THEN JSON_UNQUOTE(JSON_EXTRACT(ocr.json, '$.paystubs[0].payDate'))
                ELSE NULL
                END DESC
            ");

            $query->orderByDesc('ocr.id');

            return $query->get();
        });

        $returnHTML = view('attorney.client.ai_process.requests')
            ->with(['requests' => $requests])
            ->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function process_by_graphql(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $document_type = Helper::validate_key_value('document_type', $input);
            $client_id = Helper::validate_key_value('client_id', $input, 'radio');
            $empID = Helper::validate_key_value('employer_id', $input, 'radio');
            self::processDocumentByGraphQL($empID, $client_id, $document_type);

            return response()->json(Helper::renderJsonSuccess('Your payroll assistant in progress. Visit Employer/Payroll Management tab.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function process_by_graphql_for_all_employers(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $document_type = Helper::validate_key_value('document_type', $input);
            $client_id = Helper::validate_key_value('client_id', $input, 'radio');
            $employer_ids = Helper::validate_key_value('employer_ids', $input, 'array');

            if (!empty($employer_ids) && is_array($employer_ids)) {
                foreach ($employer_ids as $empID) {
                    self::processDocumentByGraphQL($empID, $client_id, $document_type);
                }

                return response()->json(Helper::renderJsonSuccess('Your payroll assistant in progress.'))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            return response()->json(Helper::renderJsonError('No Employers Found.'))->header('Content-Type: application/json;', 'charset=utf-8');

        }
    }

    public static function processDocumentByGraphQL($empID, $client_id, $document_type)
    {
        $allDocsData = \App\Models\PayStubs::getPendingforAiPaystubs($client_id, $document_type);
        $allDocsData = !empty($allDocsData) ? $allDocsData->toArray() : [];
        $pdfToJson = new \App\Models\PdfToJson();
        foreach ($allDocsData as $docData) {
            $employerId = Helper::validate_key_value('employer_id', $docData, 'radio');
            $employerId = !empty($employerId) ? $employerId : $empID;
            $docId = Helper::validate_key_value('document_id', $docData, 'radio');
            $pdfToJson->uploadFileToGraphQl($client_id, '', $document_type, $docId, $employerId);
        }
    }
}
