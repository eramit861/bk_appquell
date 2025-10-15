<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AutoLoanCompanies;
use App\Models\ClientBasicInfoPartA;
use App\Models\ClientBasicInfoPartB;
use App\Models\ClientDocumentUploaded;
use App\Models\UploadedOcrData;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Services\Client\CacheBasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OcrController extends Controller
{
    public function uploadOcrData(Request $request)
    {
        if ($request->isMethod('post')) {
            $client_id = Auth::user()->id;
            $post = $request->json()->all();
            $clientType = Auth::user()->client_type;
            $documentType = $post['document_type'] ?? '';
            if (empty($documentType)) {
                return response()->json(Helper::renderApiError('document type is required'), 401);
            }
            DB::beginTransaction();
            try {
                $data = ['client_type' => $clientType, 'document_type' => $documentType, 'client_id' => $client_id];
                switch ($documentType) {
                    case ClientDocumentUploaded::SOCIAL_SECURITY_CARD:
                        if (strlen($post['social_security_number']) < 9) {
                            return  response()->json(Helper::renderApiError($post['social_security_number'] . ' is an invalid Social security no. Please scan again.'));
                        }
                        $documentData = json_encode(['social_security_number' => $post['social_security_number']]);
                        ClientBasicInfoPartA::updateOrCreate(["client_id" => $client_id], ['security_number' => $post['social_security_number']]);
                        break;
                    case ClientDocumentUploaded::CO_DEBTOR_SECURITY_CARD:
                        if (strlen($post['social_security_number']) < 9) {
                            return    response()->json(Helper::renderApiError($post['social_security_number'] . ' is an invalid Social security no. Please scan again.'));
                        }
                        $documentData = json_encode(['social_security_number' => $post['social_security_number']]);
                        ClientBasicInfoPartB::updateOrCreate(["client_id" => $client_id], ['social_security_number' => $post['social_security_number']]);
                        break;
                    case ClientDocumentUploaded::CURRENT_AUTO_LOAN_STMT:
                    case 'Current_Auto_Loan_Statement':
                    case 'Current_Auto_Loan_Statement_1':
                    case 'Current_Auto_Loan_Statement_2':
                    case 'Current_Auto_Loan_Statement_3':
                    case 'Current_Auto_Loan_Statement_4':
                    case 'Other_Loan_Statement_1':
                    case 'Other_Loan_Statement_2':
                        $loan_company = $post['loan_company'] ?? '';
                        $mortgage_company = $post['mortgage_company'] ?? '';
                        $loan_company = !empty($loan_company) ? $loan_company : $mortgage_company;
                        $address = $post['address'] ?? '';
                        $monthly_payment = $post['monthly_payment'] ?? '';
                        $past_due_amount = $post['past_due_amount'] ?? '';
                        $city = $post['city'] ?? '';
                        $state = $post['state'] ?? '';
                        $zip = $post['zip'] ?? '';
                        $account_number = $post['account_number'] ?? '';
                        $amount_own = $post['amount_own'] ?? '';
                        $loan_total_amount = $post['loan_total_amount'] ?? '';
                        $amount_own = !empty($amount_own) ? $amount_own : $loan_total_amount;
                        $ocrData = ['past_due_amount' => $past_due_amount,'loan_company' => $loan_company, 'address' => $address, 'city' => $city, 'state' => $state, 'zip' => $zip, 'monthly_payment' => $monthly_payment, 'account_number' => $account_number, 'amount_own' => $amount_own];
                        $documentData = json_encode($ocrData);
                        $masterData = ['alcomp_name' => $loan_company, 'alcomp_address' => $address, 'alcomp_city' => $city, 'alcomp_state' => $state, 'alcomp_zip' => $zip];
                        AutoLoanCompanies::updateOrCreate($masterData, $masterData);
                        break;

                    case ClientDocumentUploaded::CURRENT_MORTGAGE_STMT:
                    case 'Current_Mortgage_Statement_1_1':
                    case 'Current_Mortgage_Statement_2_1':
                    case 'Current_Mortgage_Statement_3_1':
                    case 'Current_Mortgage_Statement_1_2':
                    case 'Current_Mortgage_Statement_2_2':
                    case 'Current_Mortgage_Statement_3_2':
                    case 'Current_Mortgage_Statement_1_3':
                    case 'Current_Mortgage_Statement_2_3':
                    case 'Current_Mortgage_Statement_3_3':
                    case 'Current_Mortgage_Statement_1_4':
                    case 'Current_Mortgage_Statement_2_4':
                    case 'Current_Mortgage_Statement_3_4':
                    case 'Current_Mortgage_Statement_1_5':
                    case 'Current_Mortgage_Statement_2_5':
                    case 'Current_Mortgage_Statement_3_5':
                        if (isset($post['document_type'])) {
                            unset($post['document_type']);
                        }
                        $documentData = json_encode($post);
                        break;

                    case ClientDocumentUploaded::DEBTOR_PAY_STUB:
                        $documentData = json_encode(['paystub_data' => $post['paystub_data']]);
                        break;
                    default:
                        # code...

                        break;
                }

                UploadedOcrData::updateOrCreate($data, ['data' => $documentData,'is_imported' => 0]);
                // clear cache for client basic information
                CacheBasicInfo::forgetBasicInformationCache($client_id);
                DB::commit();

                return  response()->json(Helper::renderApiSuccess('Data uploaded'));
            } catch (\Exception $e) {
                DB::rollback();

                return  response()->json(Helper::renderApiError('something went wrong please try again'));
            }
        }
    }
}
