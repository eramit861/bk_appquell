<?php

namespace App\Services;

use App\Helpers\ArrayHelper;
use App\Helpers\DocumentHelper;
use App\Helpers\Helper;
use App\Models\AutoLoanCompanies;
use App\Models\ClientDocumentUploaded;
use App\Models\Mortgages;
use App\Models\SignedDocuments;
use App\Traits\Common;
use Illuminate\Support\Facades\Cache;

class ClientService
{
    use Common;

    public static function buildClientAddress($clientInfo): string
    {
        $address = '';
        if (!empty($clientInfo)) {
            $address .= $clientInfo['Address'] ?? '';
            $address .= ', ' . $clientInfo['City'] ?? '';
            $address .= ', ' . $clientInfo['state'] ?? '';
            $address .= ', ' . $clientInfo['zip'] ?? '';
        }

        return $address;
    }

    public static function parseInformation($basicInfo): array
    {
        $result = [];
        if (!empty($basicInfo)) {
            $info = $basicInfo->toArray();
            foreach ($info as $k => $v) {
                if (is_array(json_decode($v, 1))) {
                    $data[$k] = json_decode($v, 1);
                    if (!empty($data[$k])) {
                        foreach ($data[$k] as $key => $value) {
                            $result[$key] = $value;
                        }
                    }
                } else {
                    $result[$k] = $v;
                }
            }
        }

        return $result;
    }

    public static function getAutoloanCompanies()
    {
        return Cache::remember('auto_loan_companies', now()->addHours(6), function () {
            $autoLoanCompanies = AutoLoanCompanies::where('is_ocr_available', 1)
                ->select(['id', 'alcomp_name', 'alcomp_address', 'alcomp_city', 'alcomp_state', 'alcomp_zip', 'ocr_sample_image'])
                ->get()
                ->toArray();

            $autoLoanCompanies[] = [
                'id' => 0,
                'alcomp_name' => 'Loan Co. Not Listed Above',
                'alcomp_address' => null,
                'alcomp_city' => null,
                'alcomp_state' => null,
                'alcomp_zip' => null,
                'ocr_sample_image' => null
            ];

            return $autoLoanCompanies;
        });
    }

    public static function getMortgagesCompanies()
    {
        return Cache::remember('mortgage_loan_companies', now()->addHours(6), function () {
            $MortgagesCompanies = Mortgages::where('is_ocr_available', 1)
                ->select([
                    'mortgage_id as id',
                    'mortgage_name',
                    'mortgage_address',
                    'mortgage_city',
                    'mortgage_state',
                    'mortgage_zip',
                    'ocr_sample_image'
                ])
                ->get()
                ->toArray();

            $MortgagesCompanies[] = [
                'id' => 0,
                'mortgage_name' => 'Mortgage Holder not listed above',
                'mortgage_address' => null,
                'mortgage_city' => null,
                'mortgage_state' => null,
                'mortgage_zip' => null,
                'ocr_sample_image' => null
            ];

            return $MortgagesCompanies;
        });
    }

    public function updateSignDocument($request, $client_id)
    {
        $file = $request->file('signed_document');
        $this->updateSignedDocument($file, $client_id);
    }

    public function updateSignedDocument($file, $client_id)
    {
        $store_path = "client/" . $client_id . "/signed_document";
        $imageName = $file->getClientOriginalName();
        $imageName = time() . '_' . $imageName;
        $imageName = pathinfo($imageName)['filename'];
        $imageName = Helper::validate_doc_type($imageName);
        $updatedImageName = Helper::validate_doc_type($imageName);
        $allowedTypes = ArrayHelper::getAllowedFileExtensionArray();
        $extension = DocumentHelper::getExtensionFromFile($file, $allowedTypes);
        if (!empty($newName)) {
            $updatedImageName = Helper::validate_doc_type($newName);
            $imageName = $updatedImageName;
        }
        $imageName = $imageName . '.pdf';
        if (strtolower($extension) != "pdf") {
            $origionalName = $file->getClientOriginalName();
            if (!DocumentHelper::hasExtension($file->getClientOriginalName())) {
                $origionalName = $file->getClientOriginalName().'.'.$extension;
            }
            $store_path = ClientDocumentUploaded::convertImageToPDF($client_id, $file, $updatedImageName, $origionalName, $extension, '', true);
            $signed_document = $store_path['file_path'];
        } else {
            \Storage::disk('s3')->putFileAs($store_path, $file, $imageName);
            $signed_document = $store_path.'/'.$imageName;
        }

        $data = ['sign_document' => $signed_document, 'is_sent' => 0,'read_by_attorney' => 0];

        SignedDocuments::updateOrCreate(['client_id' => $client_id], $data);
    }

    public function getLoanCompanies()
    {
        $loanCompanies = Cache::remember('loan_companies', now()->addHours(1), function () {
            return [
                'auto_loan_companies' => ClientService::getAutoloanCompanies(),
                'mortgage_loan_companies' => ClientService::getMortgagesCompanies(),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $loanCompanies
        ]);
    }

}
