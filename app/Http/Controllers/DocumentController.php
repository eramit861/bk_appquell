<?php

namespace App\Http\Controllers;

use App\Models\DebtsDocuments;
use Illuminate\Http\Request;
use App\Helpers\ArrayHelper;
use App\Models\AttorneySettings;
use App\Models\ClientDocuments;
use App\Models\ClientsAttorney;

class DocumentController extends Controller
{
    public function get_debts_document(Request $request)
    {

        $id = $request->get('id');
        $idParts = explode('_', $id);
        $doctype = $idParts[0];
        $filename = $idParts[1];

        $doc = DebtsDocuments::select('debts_document', 'document_type')->where('document_type', $doctype)->where('debts_document', 'like', "%$filename")->first();
        if (!empty($doc)) {
            $file = $doc->debts_document;
            $type = $doc->document_type;
            $path = public_path() . "/" . $file;
            if (file_exists($path)) {
                $pathInfo = pathinfo($path);
                $enc_file = base64_encode(file_get_contents($path));
                $response = [
                    'success' => true,
                    'data' => [
                        'id' => $type."_".$pathInfo['basename'],
                        'content' => $enc_file,
                    ]
                ];

                return  response()->json($response);
            }
        }

        return  response()->json(['success' => false], 404);
    }

    public function get_statement_month_option(Request $request)
    {
        if ($request->isMethod('post')) {
            $clientId = $request->id;
            $documentType = $request->document_type;
            $months = $request->bank_statement_months ?? null;
            $statementMonths = ClientDocuments::getAvailableStatementMonths($clientId, $documentType, $months);
            $client_attorney = ClientsAttorney::where('client_id', $clientId)->first();
            $attorney_id = $client_attorney->attorney_id;

            $brokerageDocTypes = ClientDocuments::getClientDocs($clientId, 'brokerage_account');

            if (AttorneySettings::isCurrentPartialMonthEnabled($attorney_id) && !array_key_exists($documentType, $brokerageDocTypes)) {
                $statementMonths = ['' => 'Current Month Stmt '] + $statementMonths;
            }

            return response()->json([
                'message' => 'success',
                'data' => $statementMonths,
            ], 200);
        }
    }

    public function mark_not_own_paystub(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];
            $pay_date = $input['pay_date'];
            $employer_id = $input['employer_id'];

            $attorneyEmployerInfo = \App\Models\AttorneyEmployerInformationToClient::findOrFail($employer_id);

            // Get the single date from the request
            $date = $request->input('pay_date'); // Assuming 'date' is the key in your request

            // Validate the date (optional but recommended)


            // Update the not_own_paystub date
            $attorneyEmployerInfo->updateNotOwnPaystubDate($date);

            // Save the model
            $attorneyEmployerInfo->save();

            return response()->json(['message' => 'Date updated successfully']);

        }
    }

    public function load_guide_doc(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            if (!empty($input['divclass'])) {
                $type = $input['divclass'];
                $documentuploadedImages = ArrayHelper::getHelpDocumentUrls($type);
                $index = array_search($type, array_column($documentuploadedImages, 'type'));
                $docGuide = $index !== false ? $documentuploadedImages[$index] ?? [] : [];

                $returnHTML = view('client.questionnaire.guide_popup')
                ->with(['docGuide' => $docGuide])
                ->render();

                return response()->json(['success' => true, 'html' => $returnHTML]);
            }
        }
    }


}
