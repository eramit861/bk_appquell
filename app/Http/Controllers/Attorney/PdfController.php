<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;
use App\Helpers\Helper;
use Illuminate\Support\Facades\File;
use App\Helpers\LocalFormHelper;
use App\Helpers\DocumentHelper;

class PdfController extends AttorneyController
{
    public function generatePDF(Request $request)
    {

        $post = $request->post();
        $data = $this->validateAndDecodePost($post);
        $sourcePDFName = Helper::validate_key_value('sourcePDFName', $post);
        $clientPDFName = Helper::validate_key_value('clientPDFName', $post);
        $this->ifEmptyFormId($post);
        $form_id = $post['form_id'];
        $client_id = $post['client_id'];
        $path = base_path('resources/courts_pdf_clients/'.$client_id);
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        //shell_exec('chmod -R 777 '.$path);
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request.');
        }
        $pdfData = \App\Models\PdfData::getPDFData($form_id, $client_id);
        $sourcePDFName = empty($pdfData['sourcePDFName']) ? $sourcePDFName : $pdfData['sourcePDFName'];
        $clientPDFName = empty($pdfData['clientPDFName']) ? $clientPDFName : $pdfData['clientPDFName'];
        $data = array_merge($data, $pdfData['data']);
        $localForms = $pdfData['localForms'];
        $attData = $pdfData['attData'];
        $lforms = $this->getLocalFormsArray($form_id, $sourcePDFName, $client_id, $clientPDFName, $attData);
        $samplePDF = $lforms['samplePDF'];
        $clientPopulatedPDFName = $lforms['clientPopulatedPDFName'];
        $filePath = '';
        $zipcode = Helper::validate_key_value('district_id', $attData);
        if (!empty($localForms) && $form_id == $localForms['form_tab_content']) {
            $samplePDF = base_path('resources/local_form_samples/'.$zipcode.'/'.$sourcePDFName);
            $path = base_path('resources/local_forms_clients/'.$client_id.'/'.$zipcode);
            $filePath = 'local_forms_clients/'.$client_id.'/'.$zipcode.'/';
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }
            // shell_exec('chmod -R 777 '.$path);
            $path = $path.'/';
            $clientPopulatedPDFName = $path.$clientPDFName;
        }
        if ($form_id == 'official_form_mailing_matrix') {
            $matrix = $this->mailingMatrix($form_id, $client_id, $sourcePDFName, $zipcode, $clientPDFName, $clientPopulatedPDFName, $filePath, $samplePDF);
            $clientPopulatedPDFName = $matrix['clientPopulatedPDFName'];
            $samplePDF = $matrix['samplePDF'];
            $filePath = $matrix['filePath'];
        }

        $clientPopulatedPDFName = $this->checkCombinedClientFilesExits($form_id, $clientPopulatedPDFName, $samplePDF);
        $downloadedPDFName = $clientPDFName;
        $pdf = \App\Models\PdfData::commonPdfGenerateScript($samplePDF);

        $result = $pdf->fillForm($data)->saveAs($clientPopulatedPDFName);
        if (!\App\Models\AttorneySubscription::isPetitionPackageAvailable($client_id)) {
            $pdf = new Pdf($clientPopulatedPDFName);
            $result = $pdf->multiBackground(base_path('resources/courts_pdf_samples/stamp.pdf'))->saveAs($clientPopulatedPDFName);
        }
        // Always check for errors
        $this->validatePdfGenerate($pdf, $result);
        $this->getFunctionIdArray($form_id, $client_id, $zipcode, $clientPDFName, $clientPopulatedPDFName, $downloadedPDFName, $filePath);
    }

    private function getLocalFormsArray($form_id, $sourcePDFName, $client_id, $clientPDFName, $attData)
    {
        $localForms = \App\Models\PdfData::getLocalFormsBasedOnzip($attData, $form_id);
        $clientPopulatedPDFName = '';
        $samplePDF = '';
        if (!isset($localForms['form_tab_content']) || $form_id != $localForms['form_tab_content']) {
            $samplePDF = base_path('resources/courts_pdf_samples/'.$sourcePDFName);
            $path = base_path('resources/courts_pdf_clients/'.$client_id);
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }
            // shell_exec('chmod -R 777 '.$path);
            $path = $path.'/';
            $clientPopulatedPDFName = $path.$clientPDFName;
        }

        return ['samplePDF' => $samplePDF, 'clientPopulatedPDFName' => $clientPopulatedPDFName];
    }

    private function validateAndDecodePost($post)
    {
        $data = [];
        foreach ($post as $key => $value) {
            if (!in_array($key, ['_token','form_id','client_id','sourcePDFName','clientPDFName'])) {

                $data[base64_decode($key)] = ($value == 'on') ? 'On' : $value;
            }
        }

        return $data;
    }

    private function ifEmptyFormId($post)
    {
        if ($post['form_id'] == '') {
            return redirect()->back()->with('error', 'Please select any form');
        }
    }

    private function mailingMatrix($form_id, $client_id, $sourcePDFName, $zipcode, $clientPDFName, $clientPopulatedPDFName, $filePath, $samplePDF)
    {
        if ($form_id == 'official_form_mailing_matrix') {
            $samplePDF = base_path('resources/local_form_samples/'.$zipcode.'/'.$sourcePDFName);
            $path = base_path('resources/local_forms_clients/'.$client_id.'/'.$zipcode);
            $filePath = 'local_forms_clients/'.$client_id.'/'.$zipcode.'/';
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }
            // shell_exec('chmod -R 777 '.$path);
            $path = $path.'/';
            $clientPopulatedPDFName = $path.$clientPDFName;

            return ['clientPopulatedPDFName' => $clientPopulatedPDFName, 'samplePDF' => $samplePDF, 'filePath' => $filePath];
        }

        return ['clientPopulatedPDFName' => $clientPopulatedPDFName, 'samplePDF' => $samplePDF, 'filePath' => $filePath];

    }

    private function checkCombinedClientFilesExits($form_id, $clientPopulatedPDFName, $samplePDF)
    {
        if (file_exists($clientPopulatedPDFName) || $form_id == 110) {
            if (!copy($samplePDF, $clientPopulatedPDFName)) {
                echo "failed to copy";
            }
        }

        return $clientPopulatedPDFName;
    }

    private function validatePdfGenerate($pdf, $result)
    {
        if ($result === false) {
            echo  $pdf->getError();
        }
    }

    private function getFunctionIdArray($form_id, $client_id, $zipcode, $clientPDFName, $clientPopulatedPDFName, $downloadedPDFName, $filePath)
    {

        if ($form_id == '106c') {
            $this->combineSchCPDF($client_id);
        } elseif ($form_id == '106h') {
            $this->combineSchHPDF($client_id);
        } elseif ($form_id == '108') {
            $this->combineStmtIntPDF($client_id);
        } elseif ($form_id == '106d') {
            $this->combineSchDPDF($client_id);
        } elseif ($form_id == '106ef') {
            $this->combineSchEFPDF($client_id);
        } elseif ($form_id == '106i') {
            $this->combineSchIPDF($client_id);
        } elseif (in_array($form_id, ['official_form_mailing_matrix'])) {
            $filePath = 'local_forms_clients/'.$client_id.'/'.$zipcode.'/';
            $this->combineLocalWithCreditors($client_id, $filePath.$clientPDFName, $clientPDFName);
        } else {
            DocumentHelper::generatePDFFile($downloadedPDFName, $clientPopulatedPDFName);
        }
    }



    public function submitFormAjax(Request $request)
    {
        $post = $request->post();
        $data = [];
        foreach ($post as $key => $value) {
            if ($key != '_token' && $key != 'form_id' && $key != 'client_id') {
                $data[base64_decode($key)] = ($value == 'on') ? 'On' : $value;
            }

        }
        if (isset($post['comabine_with_default'])) {
            return true;
        }

        if (!isset($post['form_id'])) {
            return true;
        }
        if ($post['form_id'] == '') {
            echo 'Please select any form';

            return true;
        }

        $form_id = $post['form_id'];
        $client_id = $post['client_id'];
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $sourcePDFName = $post['sourcePDFName'] ?? '';
        $clientPDFName = $post['clientPDFName'] ?? '';
        $pdfData = \App\Models\PdfData::getPDFData($form_id, $client_id);

        $sourcePDFName = empty($pdfData['sourcePDFName']) ? $sourcePDFName : $pdfData['sourcePDFName'];
        $clientPDFName = empty($pdfData['clientPDFName']) ? $clientPDFName : $pdfData['clientPDFName'];
        $data = array_merge($data, $pdfData['data']);

        $localForms = $pdfData['localForms'];
        $attData = $pdfData['attData'];

        if (!isset($localForms['form_tab_content'])) {
            $samplePDF = base_path('resources/courts_pdf_samples/'.$sourcePDFName);
            $path = base_path('resources/courts_pdf_clients/'.$client_id);
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }
            // shell_exec('chmod -R 777 '.$path);
            $path = $path.'/';
            $clientPopulatedPDFName = $path.$clientPDFName;
        }


        if (!empty($localForms) && $form_id == $localForms['form_tab_content']) {
            $zipcode = $attData['district_id'] ?? null;
            $data['Case'] = Helper::validate_key_value('case_number', $attData);
            $samplePDF = base_path('resources/local_form_samples/'.$zipcode.'/'.$sourcePDFName);
            $path = base_path('resources/local_forms_clients/'.$client_id.'/'.$zipcode);
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }

            //shell_exec('chmod -R 777 '.$path);
            $path = $path.'/';
            $clientPopulatedPDFName = $path.$clientPDFName;
        }


        if ($form_id == 'official_form_mailing_matrix') {
            $samplePDF = base_path('resources/local_form_samples/'.$zipcode.'/'.$sourcePDFName);
            $path = base_path('resources/local_forms_clients/'.$client_id.'/'.$zipcode);

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }

            //shell_exec('chmod -R 777 '.$path);
            $path = $path.'/';
            $clientPopulatedPDFName = $path.$clientPDFName;
        }

        if (file_exists($clientPopulatedPDFName)) {
            if (!copy($samplePDF, $clientPopulatedPDFName)) {
                echo "failed to copy";
            }
        }
        $pdf = \App\Models\PdfData::commonPdfGenerateScript($samplePDF);
        $result = $pdf->fillForm($data)
            ->saveAs($clientPopulatedPDFName);

        /* $pdf = new Pdf($clientPopulatedPDFName);
         $result = $pdf->multiBackground(base_path('resources/courts_pdf_samples/stamp.pdf'))
    ->saveAs($clientPopulatedPDFName);*

        /* $result = $pdf->multiBackground($clientPopulatedPDFName)
         ->saveAs(base_path('resources/courts_pdf_samples/stamp.pdf'));*/
        // Always check for errors
        $this->validatePdfGenerate($pdf, $result);

        return true;

    }

    public function combineSchCPDF($client_id)
    {
        $fileNameCombined = $client_id.'_b_106c_final.pdf';
        $fileNames = LocalFormHelper::getCarray();
        $this->commonForCombined($client_id, $fileNameCombined, $fileNames, 'A', 'K');
    }

    private function commonForCombined($client_id, $fileNameCombined, $fileNames, $start, $end)
    {

        $combinedPDF = base_path('resources/courts_pdf_clients/'.$client_id.'/'.$fileNameCombined);
        $fileNames = array_values($fileNames);
        $key = 0;

        $clientPopulatedFilesArr = [];
        for ($val = $start; $val !== $end; $val++) {
            $clientPopulatedFilesArr[$val] = 'courts_pdf_clients/'.$client_id.'/'.$client_id.'_'.$fileNames[$key].'.pdf';
            if (!file_exists(resource_path('courts_pdf_clients/'.$client_id.'/'.$client_id.'_'.$fileNames[$key].'.pdf'))) {
                $samplePDF = base_path('resources/courts_pdf_samples/form_'.$fileNames[$key].'.pdf');
                $clientPopulatedPDFName = base_path('resources/courts_pdf_clients/'.$client_id.'/'.$client_id.'_'.$fileNames[$key].'.pdf');
                if (File::exists($clientPopulatedPDFName)) {
                    if (!copy($samplePDF, $clientPopulatedPDFName)) {
                        echo "failed to copy";
                    }
                }
            }
            $key++;
        }
        $alreadyDownloadedPdf = [];
        foreach ($clientPopulatedFilesArr as $key => $file) {
            if (file_exists(resource_path($file))) {
                $alreadyDownloadedPdf[$key] = resource_path($file);
            }
        }

        if (empty($alreadyDownloadedPdf)) {
            return redirect()->route('attorney_offical_form', $client_id)->with('error', 'Please Generate at least one PDF.');
        }

        $pdf1 = \App\Models\PdfData::commonPdfGenerateScript($alreadyDownloadedPdf);

        foreach ($alreadyDownloadedPdf as $key => $val) {
            $pdf1->cat(1, 'end', $key);
        }
        $result1 = $pdf1->saveAs($combinedPDF);

        if (!\App\Models\AttorneySubscription::isPetitionPackageAvailable($client_id)) {
            $pdf1 = new Pdf($combinedPDF);
            $pdf1->multiBackground(base_path('resources/courts_pdf_samples/stamp.pdf'))->saveAs($combinedPDF);
        }
        $pdf1 = $this->validatePdfGenerate($pdf1, $result1);
        $this->downloadScript($client_id, $combinedPDF, $fileNameCombined);
    }

    public function combineSchDPDF($client_id)
    {
        $fileNameCombined = $client_id.'_b_106d_final.pdf';
        $fileNames = LocalFormHelper::getDarray();
        $this->commonForCombined($client_id, $fileNameCombined, $fileNames, 'A', 'N');
    }

    public function combineSchIPDF($client_id)
    {
        $fileNameCombined = $client_id.'_b_106i_final.pdf';
        $fileNames = ['b106i','b106i_additional'];
        $this->commonForCombined($client_id, $fileNameCombined, $fileNames, 'A', 'C');
    }

    public function combineSchHPDF($client_id)
    {
        $fileNameCombined = $client_id.'_106h_final.pdf';
        $fileNames = LocalFormHelper::getHArray();
        $this->commonForCombined($client_id, $fileNameCombined, $fileNames, 'A', 'L');
    }

    public function combineStmtIntPDF($client_id)
    {
        $fileNameCombined = $client_id.'_108_final.pdf';
        $fileNames = LocalFormHelper::getStmtIntArray();
        $this->commonForCombined($client_id, $fileNameCombined, $fileNames, 'A', 'K');
    }

    public function combineSchEFPDF($client_id)
    {
        $fileNameCombined = $client_id.'_b_106ef_final.pdf';
        $fileNames = LocalFormHelper::getEfArray();
        $this->commonForCombined($client_id, $fileNameCombined, $fileNames, 'A', 'AG');
    }

    public function combineLocalWithCreditors($id, $firstPdf, $pdfName)
    {
        $client_id = $id;
        $downloadFileName = "creditors_".$pdfName;
        $clientPopulatedFilesArr = [];
        $clientPopulatedFilesArr['A'] = $firstPdf;
        $clientPopulatedFilesArr['B'] = 'courts_pdf_clients/'.$client_id.'/creditors.pdf';

        $alreadyDownloadedPdf = [];
        foreach ($clientPopulatedFilesArr as $key => $file) {
            if (file_exists(resource_path($file))) {
                $alreadyDownloadedPdf[$key] = resource_path($file);
            }
        }

        if (empty($alreadyDownloadedPdf)) {
            return redirect()->route('attorney_offical_form', $client_id)->with('error', 'Please Generate at least one PDF.');
        }
        $pdf = \App\Models\PdfData::commonPdfGenerateScript($alreadyDownloadedPdf);

        $combinedPDF = base_path('resources/courts_pdf_clients/'.$client_id.'/'.$client_id.'_creditors_Combined.pdf');

        foreach (array_keys($alreadyDownloadedPdf) as $key) {
            $pdf->cat(1, 'end', $key);
        }
        $result = $pdf->saveAs($combinedPDF);

        if (!\App\Models\AttorneySubscription::isPetitionPackageAvailable($client_id)) {
            $pdf = new Pdf($combinedPDF);
            $result = $pdf->multiBackground(base_path('resources/courts_pdf_samples/stamp.pdf'))->saveAs($combinedPDF);
            $pdf = $this->validatePdfGenerate($pdf, $result);
        }
        $this->downloadScript($client_id, $combinedPDF, $downloadFileName);
    }

    private function downloadScript($client_id, $combinedPDF, $fileName)
    {
        DocumentHelper::generatePDFFile(urlencode($fileName ?? $client_id.'_Combined.pdf'), $combinedPDF);
    }


    public function downloadCombined($client_id)
    {
        $fileName = base_path('resources/courts_pdf_clients/'.$client_id.'/Combine.zip');
        $secondryFileName = 'Combine.zip';

        DocumentHelper::generatePDFFile(urlencode($secondryFileName), $fileName);

    }

    public function assign_trustee(Request $request)
    {
        $post = $request->post();
        $client_id = Helper::validate_key_value('client_id', $post);
        $trustee_id = Helper::validate_key_value('trustee_id', $post);
        $attData = \App\Models\AttorneyEditorData::where(['client_id' => $client_id])->first();
        $attData = isset($attData['data']) && !empty($attData['data']) ? json_decode($attData['data'], 1) : null;
        if (empty($attData)) {
            $attData = [];
        }
        $attData['trustee'] = $trustee_id;
        \App\Models\AttorneyEditorData::updateOrCreate(['client_id' => $client_id], ['data' => json_encode($attData)]);

        return response()->json(Helper::renderJsonSuccess("Record Updated Successfully"))->header('Content-Type: application/json;', 'charset=utf-8');
    }

}
