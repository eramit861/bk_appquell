<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\Common; // Trait
use App\Helpers\DocumentHelper;
use App\Models\AttorneyCompany;
use App\Models\AttorneyEditorData;
use App\Models\DistrictCreditersSetting;
use App\Models\User;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheProperty;

class ClientCreditorsController extends AttorneyController
{
    use Common;
    public function createCreditorPdfByAjax($client_id)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        $user = User::where('id', operator: $client_id)->first();
        $basic_info = CacheBasicInfo::getBasicInformationData($client_id, false, false);
        $attorney_company = AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $attorney_company = (!empty($attorney_company)) ? $attorney_company->toArray() : [];

        $PropertyData = CacheProperty::getPropertyData($client_id);
        $propertyInfo = [
            'propertyresident' => Helper::validate_key_value('propertyresident', $PropertyData, 'array'),
            'propertyvehicle' => Helper::validate_key_value('propertyvehicle', $PropertyData, 'array')
        ];

        $creditors = $this->getCreditors($user, $attorney_company, $basic_info, $propertyInfo);
        $savedData = AttorneyEditorData::where('client_id', $client_id)->first();
        $distritId = isset($savedData->data) && !empty(json_decode($savedData->data)->district_id) ? json_decode($savedData->data)->district_id : 69;
        $creditor_settings = DistrictCreditersSetting::where('destrict_id', $distritId)->first();
        $path = base_path('resources') . '/courts_pdf_clients/' . $client_id;
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }
        PDF::loadView('attorney.official_form.creditors_pdf', ['creditors' => $creditors, 'creditor_settings' => $creditor_settings])
        ->save(base_path('resources').'/courts_pdf_clients/'.$client_id.'/creditors.pdf');
    }

    public function download_cliet_creditors($client_id)
    {
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        $user = User::where('id', $client_id)->first();
        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $BasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $creditors = self::commonGetCreditorsList($user);
        $fileName = (Helper::validate_key_value('name', $BasicInfoPartA).'_'.Helper::validate_key_value('last_name', $BasicInfoPartA)) ?? 'creditors-'.$client_id . '.txt';
        $fileName = 'creditors-files/client/'.$fileName . '_creditors.txt';
        $baseContent = '';
        foreach ($creditors as $creditor) {

            $creditor['creditor_name_addresss'] = str_replace("-", " ", $creditor['creditor_name_addresss']);
            $creditor['creditor_name_addresss'] = preg_replace("/[^A-Za-z0-9 ]/", '', $creditor['creditor_name_addresss']);
            $baseContent .= "".$creditor['creditor_name']."\r\n".$creditor['creditor_name_addresss']."\r\n".$creditor['creditor_city'].", ".$creditor['creditor_state']." ".$creditor['creditor_zip']."\r\n\r\n\r\n";
        }
        $baseContent = preg_replace("/(?<=[^\r]|^)\n/", "\r\n", $baseContent);
        DocumentHelper::generateFile($baseContent, $fileName);
        $msg = 'You have successfully generated creditors file. Please <a href="'. url('/'. $fileName) . '" download> click here  </a> to download the file';

        return redirect()->route('attorney_offical_form', ['id' => $client_id])->with('custom', $msg);
    }


    public function download_client_creditors_xls($client_id)
    {
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }

        $user = User::where('id', $client_id)->first();
        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $BasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $creditors = self::commonGetCreditorsList($user);
        $fileName = (Helper::validate_key_value('name', $BasicInfoPartA).'_'.Helper::validate_key_value('last_name', $BasicInfoPartA)) ?? 'creditors-'.$client_id . '.txt';
        $fileName = 'creditors-files/client/'.$fileName . '_BK_Pro_Creditor_Export.txt';

        $columnNames = [ 'Creditor Name', 'Address 1', 'Address 2', 'Address 3', 'City', 'State', 'Zip Code', 'Account Number', 'Amount of Claim', 'Date Incurred', 'Contract Payment', 'Value of Security', 'Collateral (if any)', 'Consideration', 'Remarks', 'Contingent (Y/N)', 'Unliquidated (Y/N)', 'Disputed (Y/N)', 'Business (Y/N/%)', 'Unknown (Y/N)', 'Notice Only (Y/N)' ];

        $data[] = $columnNames;
        foreach ($creditors as $creditor) {
            $creditor['creditor_name_addresss'] = str_replace("-", " ", $creditor['creditor_name_addresss']);
            $creditor['creditor_name_addresss'] = preg_replace("/[^A-Za-z0-9 ]/", '', $creditor['creditor_name_addresss']);
            $dataObj = [
                            $creditor['creditor_name'], // Creditor Name
                            $creditor['creditor_name_addresss'], // Address 1
                            '', // Address 2
                            '', // Address 3
                            $creditor['creditor_city'], // City
                            $creditor['creditor_state'], // State
                            $creditor['creditor_zip'], // Zip Code
                            $creditor['account_number'] ?? '', // Account Number
                            $creditor['debt_amount_due'] ?? '', // Amount of Claim
                            $creditor['debt_incurred_date'] ?? '', // Date Incurred
                            '', // Contract Payment
                            '', // Value of Security
                            '', // Collateral (if any)
                            '', // Consideration
                            '', // Remarks
                            '', // Contingent (Y/N)
                            '', // Unliquidated (Y/N)
                            '', // Disputed (Y/N)
                            '', // Business (Y/N/%)
                            '', // Unknown (Y/N)
                            '', // Notice Only (Y/N)
                        ];
            $data[] = $dataObj;
        }



        $fileContent = '';
        foreach ($data as $row) {
            $fileContent .= implode("\t", $row) . "\n";
        }


        file_put_contents(public_path($fileName), $fileContent);
        $msg = 'You have successfully generated BK Pro Creditor Export file. Please <a href="'. url('/'. $fileName) . '" download> click here  </a> to download the file';

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('custom', $msg);
    }

    public function commonGetCreditorsList($user)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        $attorney_company = AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $attorney_company = (!empty($attorney_company)) ? $attorney_company->toArray() : [];

        $client_id = $user->id;

        $PropertyData = CacheProperty::getPropertyData($client_id);
        $propertyInfo = [
            'propertyresident' => Helper::validate_key_value('propertyresident', $PropertyData, 'array'),
            'propertyvehicle' => Helper::validate_key_value('propertyvehicle', $PropertyData, 'array')
        ];

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $basic = [
            'BasicInfoPartA' => Helper::validate_key_value('BasicInfoPartA', $BIData, 'array'),
            'BasicInfoPartB' => Helper::validate_key_value('BasicInfoPartB', $BIData, 'array')
        ];

        return $this->getCreditors($user, $attorney_company, $basic, $propertyInfo);
    }

}
