<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mikehaertl\pdftk\Pdf;

class PdfData extends Model
{
    use HasFactory;

    public static function getPDFData($form_id, $client_id)
    {
        $attData = \App\Models\AttorneyEditorData::where(['client_id' => $client_id])->first();
        $attData = isset($attData['data']) && !empty($attData['data']) ? json_decode($attData['data'], 1) : null;

        $localForms = [];
        $data = [];
        $sourcePDFName = '';
        $clientPDFName = '';
        $localForms = self::getLocalFormsBasedOnzip($attData, $form_id);

        if (!empty($localForms) && isset($localForms['form_tab_content']) && $form_id == $localForms['form_tab_content']) {
            $sourcePDFName = $localForms['form_tab_content'].'.pdf';
            $clientPDFName = $localForms['form_tab_content'].'.pdf';
        }

        if ($form_id == 101) {
            $hazardA = $data['What is the hazard1'] ?? '';
            $hazardFirst55 = substr($hazardA, 0, 55);
            $hazardTheRest = substr($hazardA, 55);
            $data['What is the hazard1'] = $hazardFirst55;
            $data['What is the hazard2'] = $hazardTheRest;

            $streetA = $data['Street_6'] ?? '';
            $streetFirst55 = substr($streetA, 0, 55);
            $streetTheRest = substr($streetA, 55);
            $data['Street_6'] = $streetFirst55;
            $data['Street_7'] = $streetTheRest;

            $attentionA = $data['If immediate attention is needed why is it needed1'] ?? '';
            $attentionFirst35 = substr($attentionA, 0, 35);
            $attentionTheRest = substr($attentionA, 35);
            $data['If immediate attention is needed why is it needed1'] = $attentionFirst35;
            $data['If immediate attention is needed why is it needed2'] = $attentionTheRest;
        } elseif ($form_id == '106a_and_b') {
            $otherPropertyA = $data['53 Examples Season tickets country club membership-106AB_1'] ?? '';
            $otherPropertyB = $data['53 Examples Season tickets country club membership-106AB_2'] ?? '';
            $otherPropertyC = $data['53 Examples Season tickets country club membership-106AB_3'] ?? '';
            $otherProperty = $otherPropertyA."\n".$otherPropertyB."\n".$otherPropertyC;
            $data['53 Examples Season tickets country club membership-106AB'] = $otherProperty;
        } elseif ($form_id == 'official_form_mailing_matrix') {
            $sourcePDFName = 'official_form_mailing_matrix.pdf';
            $clientPDFName = 'official_form_mailing_matrix.pdf';
            $data['TextBox5'] = '';
            $data['TextBox6'] = '';
        }

        return ['attData' => $attData,'localForms' => $localForms,'data' => $data,'sourcePDFName' => $sourcePDFName, 'clientPDFName' => $clientPDFName];
    }
    public static function getLocalFormsBasedOnzip($attData, $form_id)
    {
        $localForms = [];
        if (isset($attData['district_id']) && $attData['district_id'] > 0) {
            $localForms = \App\Models\Form::where('zipcode', $attData['district_id'])->where('form_tab_content', $form_id)->select(['form_tab_content','form_name'])->first();
        }

        return $localForms;
    }

    public static function commonPdfGenerateScript($samplePDF)
    {
        $pdf = new Pdf($samplePDF, [
            'command' => env('PDFTK_SOFTWARE_PATH'),
            'useExec' => true,  // May help on Windows systems if execution fails
        ]);

        return  $pdf;
    }
}
