<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\LocalFormHelper;
use mikehaertl\pdftk\Pdf;
use App\Traits\Common; // Trait
use App\Helpers\Helper;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Illuminate\Support\Facades\Log;
use App\Helpers\DocumentHelper;

class CombinedPdf extends Model
{
    use Common;
    public function getPdfRequest()
    {
        $htmldata = \App\Models\AttorneyEditorData::where(['request_for_combined' => 1])->select(['client_id', 'data'])
            ->orderby('pdf_request_placed_on', 'asc')
            ->first();

        $savedData = !empty($htmldata) ? $htmldata->toArray() : [];
        if (!empty($savedData)) {
            $this->proceessPDF($savedData);
        }
        //\Log::info("Combined PDF cron executed successfully!", true);
    }

    private function proceessPDF($savedData)
    {
        $client_id = $savedData['client_id'];
        $cpdfpath = base_path('resources') . '/courts_pdf_clients/' . $client_id;
        $this->checkOrCreateDir($cpdfpath);
        //shell_exec('chmod -R 777 '.$cpdfpath);
        // Get all files in a directory
        $filesInFolder = File::allFiles($cpdfpath);
        // Delete files
        $filesTodelete = [];
        foreach ($filesInFolder as $fl) {
            if ($fl->getFileName() != 'creditors.pdf') { // Ignore thumbs directory
                $filesTodelete[] = $fl;
            }
        }
        $this->unLinkFiles($filesTodelete);
        $lpath = base_path('resources') . '/local_forms_clients/' . $client_id;
        $this->checkOrCreateDir($lpath);
        //shell_exec('chmod -R 777 '.$lpath);
        $localfilesInFolder = File::allFiles($lpath);
        $this->unLinkFiles($localfilesInFolder);
        $htmlData = \App\Models\AttorneyClientHtml::where('client_id', $client_id)->select(['form_id','data'])->get()->pluck('data', 'form_id');
        $htmlData = !empty($htmlData) ? $htmlData->toArray() : [];

        if (!empty($htmlData)) {
            $this->pdfFormsArray($htmlData);
        }
    }
    protected function unLinkFiles($file)
    {
        if (!empty($file)) {
            File::delete($file);
        }
    }
    private function pdfFormsArray($htmlData)
    {
        $formsArray = [];
        foreach ($htmlData as $key => $value) {
            if (in_array($key, ['id', 'client_id', 'data', 'created_at', 'updated_at']) || $value == null) {
                continue;
            }
            $formData = json_decode($value, 1);
            if (isset($formData['form_id'])) {
                $formsArray[$formData['form_id']] = $formData;
            }

        }

        $data = [];
        foreach ($formsArray as $key => $val) {
            $fmdata = [];
            $form_id = $val['form_id'];
            $client_id = $val['client_id'];
            $sourcePDFName = Helper::validate_key_value('sourcePDFName', $val);
            $clientPDFName = Helper::validate_key_value('clientPDFName', $val);
            $form_id = self::getFormNameByKey($key);
            $pdfData = \App\Models\PdfData::getPDFData($form_id, $client_id);
            $sourcePDFName = empty($pdfData['sourcePDFName']) ? $sourcePDFName : $pdfData['sourcePDFName'];
            $clientPDFName = empty($pdfData['clientPDFName']) ? $clientPDFName : $pdfData['clientPDFName'];
            foreach ($val as $k => $fields) {
                $fmdata[base64_decode($k)] = ($fields == 'on') ? 'On' : $fields;
            }
            $data = array_merge($fmdata, $pdfData['data']);
            $localForms = $pdfData['localForms'];
            $attData = $pdfData['attData'];

            if (!isset($localForms['form_tab_content'])) {
                $samplePDF = base_path('resources/courts_pdf_samples/' . $sourcePDFName);
                $path = base_path('resources/courts_pdf_clients/' . $client_id . '/');
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true);
                }
                @chmod($path, 0777); // Ensure directory is writable
                $clientPopulatedPDFName = $path . $clientPDFName;
            }


            if (!empty($localForms) && $form_id == $localForms['form_tab_content']) {
                $zipcode = $attData['district_id'] ?? null;
                $data['Case'] = Helper::validate_key_value('case_number', $attData);
                $samplePDF = base_path('resources/local_form_samples/' . $zipcode . '/' . $sourcePDFName);
                $path = base_path('resources/local_forms_clients/' . $client_id . '/' . $zipcode . '/');
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true);
                }
                @chmod($path, 0777); // Ensure directory is writable
                $clientPopulatedPDFName = $path . $clientPDFName;
            }

            if ($form_id == 'official_form_mailing_matrix') {
                $zipcode = $attData['district_id'] ?? null;
                $sourcePDFName = 'official_form_mailing_matrix.pdf';
                $samplePDF = base_path('resources/local_form_samples/' . $zipcode . '/' . $sourcePDFName);

                $path = base_path('resources/local_forms_clients/' . $client_id . '/' . $zipcode . '/');

                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true);
                }
                @chmod($path, 0777); // Ensure directory is writable
                $clientPopulatedPDFName = $path . $clientPDFName;

            }


            if (!is_dir($samplePDF) && !copy($samplePDF, $clientPopulatedPDFName)) {
                Log::info(print_r('can not copy file', true));
            } else {
                @chmod($clientPopulatedPDFName, 0666); // Ensure file is writable after copy
            }

            if (!is_dir($samplePDF)) {
                $pdf = \App\Models\PdfData::commonPdfGenerateScript($samplePDF);
                $result = $pdf->fillForm($data)->saveAs($clientPopulatedPDFName);
                $this->validatePdfGenerate($pdf, $result);
                @chmod($clientPopulatedPDFName, 0666); // Ensure file is writable after generation
            }
        }
        \App\Models\AttorneyEditorData::where(['client_id' => $client_id])->update(['request_for_combined' => 2, 'pdf_request_placed_on' => date("Y-m-d H:i:s") ]);
        $this->combineOfficialPDF($client_id);
        Log::info(print_r('pdf generated individuals', true));
    }



    private function validatePdfGenerate($pdf, $result)
    {
        if ($result === false) {
            Log::info(print_r($pdf->getError(), true));
        }
    }



    private function combineOfficialPDF($client_id)
    {

        // $combine_with_default_pdf = explode(',',$request->comabine_with_default);
        //$input = $request->all();
        //$excludepdf = $input['exclude_fields']??'';
        //$combinedPDF = base_path('resources/courts_pdf_clients/'.$client_id.'/'.$client_id.'_Combined.pdf');
        $attData = \App\Models\AttorneyEditorData::where(['client_id' => $client_id])->first();
        $suppliment = \App\Models\AttorneyEditorData::where(['client_id' => $client_id])->select('suppliment_form')->first();
        $suppliment = !empty($suppliment) ? $suppliment->toArray() : [];
        $DefaultFormscombinedPDF = base_path('resources/courts_pdf_clients/' . $client_id . '/' . $client_id . '_DefaultFormsCombined.pdf');
        $fileNames = [
            'b_101',
            'b106sum',
            'b106ab',
            'b_106c',
            'b_106c_add_1',
            'b_106c_add_2',
            'b_106c_add_3',
            'b_106c_add_4',
            'b_106c_add_5',
            'b_106c_add_6',
            'b_106c_add_7',
            'b_106c_add_8',
            'b_106c_add_9',
            'b106d',
            'b106d_part1_add1',
            'b106d_part1_add2',
            'b106d_part2_add1',
            'b106d_part2_add2',
            'b106d_part2_add3',
            'b106d_part2_add4',
            'b106d_part2_add5',
            'b106ef',
            'b106ef_part1_pdf1',
            'b106ef_part1_pdf2',
            'b106ef_part1_pdf3',
            'b106ef_part2',
            'b106ef_part2_pdf2',
            'b106ef_part2_pdf3',
            'b106ef_part2_pdf4',
            'b106ef_part2_pdf5',
            'b106ef_part2_pdf6',
            'b106ef_part2_pdf7',
            'b106ef_part2_pdf8',
            'b106ef_part2_pdf9',
            'b106ef_part2_pdf10',
            'b106ef_part2_pdf11',
            'b106ef_part2_pdf12',
            'b106ef_part2_pdf13',
            'b106ef_part2_pdf14',
            'b106ef_part2_pdf15',
            'b106ef_part2_pdf16',
            'b106ef_part2_pdf17',
            'b106ef_part2_pdf18',
            'b106ef_part3_pdf1',
            'b106ef_part3_pdf2',
            'b106ef_part3_pdf3',
            'b106ef_part3_pdf4',
            'b106ef_part3_pdf5',
            'b106ef_part3_pdf6',
            'b106ef_part3_pdf7',
            'b106ef_part3_pdf8',
            'b106ef_part3_pdf9',
            'b106ef_part4',
            'b106g',
            'b106h',
            "106h_pdf1",
            "106h_pdf2",
            "106h_pdf3",
            "106h_pdf4",
            "106h_pdf5",
            "106h_pdf6",
            "106h_pdf7",
            "106h_pdf8",
            "106h_pdf9",
            "106h_pdf10",
            'b106i',
            'b106j',
            'b106j2',
            '106dec',
            'b107',
            'b108',
            "b108_pdf1",
            "b108_pdf2",
            "b108_pdf3",
            "b108_pdf4",
            "b108_pdf5",
            "b108_pdf6",
            "b108_pdf7",
            "b108_pdf8",
            "b108_last",
            '110',
            '111',
            'b_122a_1',
            'b122a_1supp',
            'b_122a_2'
        ];

        $tabssequeance = ["official-form-101" => ['b_101'], "official-form-106sum" => ['b106sum'], "official-form-106a_and_b" => ['b106ab'], "official-form-106c" => LocalFormHelper::getCarray() , "official-form-106d" => LocalFormHelper::getDarray() , "official-form-106e_and_f" => LocalFormHelper::getEfArray() , "official-form-106g" => ['b106g'], "official-form-106h" => ['b106h'], "official-form-106i" => ['b106i'], "official-form-106j" => ['b106j'], "official-form-106j-2" => ['b106j2'], "official-form-106dec" => ['106dec'], "official-form-107" => ['b_107'], "official-form-108" => ['b108'], "official-form-110" => ['110'], "official-form-111" => ['111'], "official-form-109" => ['b_122a_1'], "official-form-122a─1supp" => ["b122a_1supp"], "official-form-122a─2" => ["b_122a_2"], "official-form-103a" => ["103a"], "official-form-103b" => ["103b"], "official_form_mailing_matrix" => ['official_form_mailing_matrix'], ];

        $tabData = \App\Models\Form::where(['zipcode' => json_decode($attData->data)
            ->district_id])
            ->get()
            ->toArray();
        $matrixTab = [];
        $defaultForms = [];
        $localForms = [];
        foreach ($tabData as $disdata) {
            if (($disdata['type'] == 'local' && $disdata["form_tab_content"] == "official_form_mailing_matrix")) {
                $matrixTab = $disdata;
            }
            if ($disdata['type'] == 'local' && ($disdata['form_tab_content'] != 'official_form_mailing_matrix')) {

                array_push($localForms, $disdata);
            }
            $supplimentForms = !empty($suppliment['suppliment_form']) ? json_decode($suppliment['suppliment_form'], 1) : [];
            if (($disdata['type'] == 'default' && $disdata['is_uppliment'] == 0 && $disdata['is_active'] == 1) || ($disdata['is_active'] == 1 && $disdata['is_uppliment'] == 1 && in_array($disdata['form_id'], $supplimentForms))) {
                array_push($defaultForms, $disdata);
            }
        }


        $finalDefault = [];
        $i = 1;
        foreach ($defaultForms as $dForm) {
            if ($i == count($defaultForms)) {
                array_push($finalDefault, $matrixTab);
            }
            array_push($finalDefault, $dForm);
            $i++;
        }

        $savedtabs = array_column($finalDefault, 'form_tab_content');

        foreach ($savedtabs as $frm) {
            if ($frm != 'official_form_mailing_matrix') {
                if (isset($tabssequeance[$frm])) {
                    array_merge($fileNames, $tabssequeance[$frm]);
                }
            }
        }

        /*$exclude_pdf_array = [];
        if($excludepdf){
        $exclude_pdf_array = explode(',',$excludepdf);
        if(in_array('b122a_1supp',$exclude_pdf_array)){
        unset($fileNames[array_search('b122a_1supp',$fileNames)]);
        }
        if(in_array('b_122a_2',$exclude_pdf_array)){
        unset($fileNames[array_search('b_122a_2',$fileNames)]);
        }
        foreach($exclude_pdf_array as $exname){
            if(isset($fileNames)){
                unset($fileNames[$exname]);
            }
        }
        }*/

        $fileNames = array_unique(array_values($fileNames));
        $clientPopulatedFilesArr = [];
        $key = 0;
        for ($val = 'A';$val !== 'CH';$val++) {
            if (isset($fileNames[$key])) {
                //if(!in_array($fileNames[$key], $exclude_pdf_array)){
                $clientPopulatedFilesArr[$val] = 'courts_pdf_clients/' . $client_id . '/' . $client_id . '_' . $fileNames[$key] . '.pdf';
                // }
                $key++;
            }
        }

        /*Generate Separate Default form file*/
        $last_key = array_key_last($clientPopulatedFilesArr);
        $key_form = $last_key;
        // $key_form = ++$key_form;
        /************* */
        $attData = isset($attData['data']) && !empty($attData['data']) ? json_decode($attData['data'], 1) : null;
        $zipcode = $attData['district_id'] ?? null;
        $LocalclientPopulatedFilesArr = [];
        if ($zipcode != null) {

            //$localForms = \App\Models\Form::join('tbl_zip_code', 'tbl_forms.zipcode', '=', 'tbl_zip_code.id')->where('tbl_forms.zipcode', $zipcode)->get(['tbl_forms.*', 'tbl_zip_code.district_name']);
            foreach ($localForms as $localform) {
                //if(in_array($localform->form_tab_content, $combine_with_default_pdf)){
                $key_form = ++$last_key;
                $LocalclientPopulatedFilesArr[$key_form] = 'local_forms_clients/' . $client_id . '/' . $zipcode . '/' . $localform['form_tab_content'] . '.pdf';

                //}
            }
        }

        if (in_array('official_form_mailing_matrix', $savedtabs)) {

            $clientPDFName = 'official_form_mailing_matrix.pdf';

            if (file_exists(resource_path('local_forms_clients/' . $client_id . '/' . $zipcode . '/' . $clientPDFName))) {
                $key_form = ++$key_form;
                $LocalclientPopulatedFilesArr[$key_form] = 'local_forms_clients/' . $client_id . '/' . $zipcode . '/' . $clientPDFName;
            }
        }

        /************* */
        $key_form = ++$key_form;
        $clientPopulatedFilesArr[$key_form] = 'courts_pdf_clients/' . $client_id . '/creditors.pdf';

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
        foreach ($alreadyDownloadedPdf as $key => $val) {
            $pdf->cat(1, 'end', $key);
        }
        $result = $pdf->saveAs($DefaultFormscombinedPDF);
        if (!\App\Models\AttorneySubscription::isPetitionPackageAvailable($client_id)) {
            $pdf = new Pdf($DefaultFormscombinedPDF);
            $result = $pdf->multiBackground(base_path('resources/courts_pdf_samples/stamp.pdf'))
                ->saveAs($DefaultFormscombinedPDF);
        }
        $this->validatePdfGenerate($pdf, $result);
        //$this->downloadScript($client_id, $DefaultFormscombinedPDF, $client_id."_DefaultFormsCombined.pdf");
        /*For SSN , file name is 'b121', Start*/
        $SSNPDF = base_path('resources/courts_pdf_clients/' . $client_id . '/' . $client_id . '_SSN.pdf');
        $SSNclientPopulatedFilesArr['A'] = 'courts_pdf_clients/' . $client_id . '/' . $client_id . '_b121.pdf';
        $SSNDownloadedPdf = [];
        foreach ($SSNclientPopulatedFilesArr as $key => $file) {
            if (file_exists(resource_path($file))) {
                $SSNDownloadedPdf[$key] = resource_path($file);
            }
        }
        $pdf = \App\Models\PdfData::commonPdfGenerateScript($SSNDownloadedPdf);
        foreach ($SSNDownloadedPdf as $key => $val) {
            $pdf->cat(1, 'end', $key);
        }

        $result = $pdf->saveAs($SSNPDF);
        if (!\App\Models\AttorneySubscription::isPetitionPackageAvailable($client_id)) {
            $pdf = new Pdf($SSNPDF);
            $result = $pdf->multiBackground(base_path('resources/courts_pdf_samples/stamp.pdf'))
                ->saveAs($SSNPDF);
        }
        $this->validatePdfGenerate($pdf, $result);

        $attData = \App\Models\AttorneyEditorData::where(['client_id' => $client_id])->first();
        $attData = isset($attData['data']) && !empty($attData['data']) ? json_decode($attData['data'], 1) : null;
        $zipcode = $attData['district_id'] ?? null;
        $LocalclientPopulatedFilesArr = [];
        if ($zipcode != null) {
            // $localForms = \App\Models\Form::join('tbl_zip_code', 'tbl_forms.zipcode', '=', 'tbl_zip_code.id')->where('tbl_forms.zipcode', $zipcode)->get(['tbl_forms.*', 'tbl_zip_code.district_name']);
            //$last_key = array_key_last($clientPopulatedFilesArr);
            $last_key = 'A';
            foreach ($localForms as $localform) {
                // if(!in_array($localform->form_tab_content, $exclude_pdf_array)){
                $key_form = ++$last_key;
                $LocalclientPopulatedFilesArr[$key_form] = 'local_forms_clients/' . $client_id . '/' . $zipcode . '/' . $localform['form_tab_content'] . '.pdf';
                // }

            }
        }

        if (in_array('official_form_mailing_matrix', $savedtabs)) {
            $clientPDFName = $client_id . '_official_form_mailing_matrix.pdf';
            if (file_exists(resource_path('local_forms_clients/' . $client_id . '/' . $zipcode . '/' . $clientPDFName))) {
                $key_form = ++$key_form;
                $LocalclientPopulatedFilesArr[$key_form] = 'local_forms_clients/' . $client_id . '/' . $zipcode . '/' . $clientPDFName;
            }
        }

        /*For Local Forms, Start*/
        $LocalFormsPDF = base_path('resources/courts_pdf_clients/' . $client_id . '/' . $client_id . '_LocalForms.pdf');

        $LocalFormsDownloadedPdf = [];
        foreach ($LocalclientPopulatedFilesArr as $key => $file) {
            if (file_exists(resource_path($file))) {
                $LocalFormsDownloadedPdf[$key] = resource_path($file);
            }
        }
        if (!empty($LocalFormsDownloadedPdf)) {
            $pdf = \App\Models\PdfData::commonPdfGenerateScript($LocalFormsDownloadedPdf);
            foreach ($LocalFormsDownloadedPdf as $key => $val) {
                $pdf->cat(1, 'end', $key);
            }

            $result = $pdf->saveAs($LocalFormsPDF);
            if (!\App\Models\AttorneySubscription::isPetitionPackageAvailable($client_id)) {
                $pdf = new Pdf($LocalFormsPDF);
                $result = $pdf->multiBackground(base_path('resources/courts_pdf_samples/stamp.pdf'))
                    ->saveAs($LocalFormsPDF);
            }
            $this->validatePdfGenerate($pdf, $result);
        }
        // downlaoded populated pdf
        /*For SSN , file name is 'b121', End*/

        /*Generating Zip File*/
        $zip = new ZipArchive();
        $fileName = base_path('resources/courts_pdf_clients/' . $client_id . '/Combine.zip');
        $files = [$SSNPDF, $DefaultFormscombinedPDF];
        if (file_exists($LocalFormsPDF)) {
            $files = [$SSNPDF, $DefaultFormscombinedPDF, $LocalFormsPDF];
        }

        //Zipper::make('Combine.zip')->add([$SSNPDF,$DefaultFormscombinedPDF]);
        if ($zip->open($fileName, ZipArchive::CREATE) === true) {
            //$files = File::files(public_path('uploads/file'));
            foreach ($files as $key => $value) {
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }
            $zip->close();
        }

        DocumentHelper::generateZipFile(urlencode('Combine.zip'), $fileName);
    }



    private static function getFormNameByKey($key = null)
    {
        $arr = ['b107' => 'b107', 'b110' => '110', 'b111' => '111', 'vol_petition_data' => 'b_101', '106sum' => 'b106sum', '106a_and_b' => 'b106ab', '106c' => 'b_106c', '106c_add_1' => 'b_106c_add_1', '106c_add_2' => 'b_106c_add_2', '106c_add_3' => 'b_106c_add_3', '106c_add_4' => 'b_106c_add_4', '106c_add_5' => 'b_106c_add_5', '106c_add_6' => 'b_106c_add_6', '106c_add_7' => 'b_106c_add_7', '106c_add_8' => 'b_106c_add_8', '106c_add_9' => 'b_106c_add_9', 'b106d' => 'b106d', '106d_part1_add1' => 'b106d_part1_add1', '106d_part1_add2' => 'b106d_part1_add2', '106d_part2_add1' => 'b106d_part2_add1', '106d_part2_add2' => 'b106d_part2_add2', '106d_part2_add3' => 'b106d_part2_add3', '106ef' => 'b106ef', '106ef_part1_pdf1' => 'b106ef_part1_pdf1', '106ef_part1_pdf2' => 'b106ef_part1_pdf2', '106ef_part1_pdf3' => 'b106ef_part1_pdf3', '106ef_part2' => 'b106ef_part2', '106ef_part2_pdf2' => 'b106ef_part2_pdf2', '106ef_part2_pdf3' => 'b106ef_part2_pdf3', '106ef_part2_pdf4' => 'b106ef_part2_pdf4', '106ef_part2_pdf5' => 'b106ef_part2_pdf5', '106ef_part2_pdf6' => 'b106ef_part2_pdf6', '106ef_part2_pdf7' => 'b106ef_part2_pdf7', '106ef_part2_pdf8' => 'b106ef_part2_pdf8', '106ef_part2_pdf9' => 'b106ef_part2_pdf9', '106ef_part2_pdf10' => 'b106ef_part2_pdf10', '106ef_part2_pdf11' => 'b106ef_part2_pdf11', '106ef_part2_pdf12' => 'b106ef_part2_pdf12', '106ef_part2_pdf13' => 'b106ef_part2_pdf13', '106ef_part2_pdf14' => 'b106ef_part2_pdf14', '106ef_part2_pdf15' => 'b106ef_part2_pdf15', '106ef_part2_pdf16' => 'b106ef_part2_pdf16', '106ef_part2_pdf17' => 'b106ef_part2_pdf17', '106ef_part2_pdf18' => 'b106ef_part2_pdf18', '106ef_part3_pdf1' => 'b106ef_part3_pdf1', '106ef_part3_pdf2' => 'b106ef_part3_pdf2', '106ef_part3_pdf3' => 'b106ef_part3_pdf3', '106ef_part3_pdf4' => 'b106ef_part3_pdf4', '106ef_part3_pdf5' => 'b106ef_part3_pdf5', '106ef_part3_pdf6' => 'b106ef_part3_pdf6', '106ef_part3_pdf7' => 'b106ef_part3_pdf7', '106ef_part3_pdf8' => 'b106ef_part3_pdf8', '106ef_part3_pdf9' => 'b106ef_part3_pdf9', '106ef_part4' => 'b106ef_part4', 'b106g' => 'b106g', '106h' => 'b106h', '106i' => 'b106i', '106j' => 'b106j', '106j_2' => 'b106j2', "b108_pdf1" => "108_pdf1", "b108_pdf2" => "108_pdf2", "b108_pdf3" => "108_pdf3", "b108_pdf4" => "108_pdf4", "b108_pdf5" => "108_pdf5", "b108_pdf6" => "108_pdf6", "b108_pdf7" => "108_pdf7", "b108_pdf8" => "108_pdf8", "b108_last" => "108_last", "122a_1" => 'b_122a_1', "122a_1supp" => 'b122a_1supp', "122a_2" => 'b_122a_2', "b110" => '110', 'b111' => "111"];

        if (isset($arr[$key]) && !empty($arr[$key])) {
            return $arr[$key];
        } else {
            return $key;
        }
    }

}
