<?php

namespace App\Http\Controllers\Attorney\Questionnaire;

use App\Http\Controllers\AttorneyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Helpers\ClientHelper;
use App\Models\User;
use App\Models\ZipCode;
use App\Models\EditQuestionnaire\QuestionnaireBasicInfoPartA;
use App\Models\EditQuestionnaire\QuestionnaireBasicInfoPartB;
use App\Models\EditQuestionnaire\QuestionnaireBasicInfoPartC;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheSOFA;

class BasicInfoEditController extends AttorneyController
{
    public function basic_info_step1_modal(Request $request)
    {
        $client_id = $request->input('client_id');
        $htmlData = $this->getHtmlData($client_id);
        $htmlData['popup_label'] = 'Basic Information Step 1';
        $htmlData['step1'] = true;
        $htmlData['save_route'] = route('basic_info_step1_modal_save', ['client_id' => $client_id]);
        $returnHTML = view('attorney.form_elements.que_models.basic_info.step', $htmlData)->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function basic_info_step2_modal(Request $request)
    {
        $client_id = $request->input('client_id');
        $htmlData = $this->getHtmlData($client_id);
        $htmlData['popup_label'] = 'Basic Information Step 2';
        $htmlData['step2'] = true;
        $htmlData['save_route'] = route('basic_info_step2_modal_save', ['client_id' => $client_id]);
        $returnHTML = view('attorney.form_elements.que_models.basic_info.step', $htmlData)->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function basic_info_step3_modal(Request $request)
    {
        $client_id = $request->input('client_id');
        $htmlData = $this->getHtmlData($client_id);
        $htmlData['popup_label'] = 'BK Cases/Businesses';
        $htmlData['step3'] = true;
        $htmlData['save_route'] = route('basic_info_step3_modal_save', ['client_id' => $client_id]);
        $returnHTML = view('attorney.form_elements.que_models.basic_info.step', $htmlData)->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function getHtmlData($client_id)
    {
        $user = User::find($client_id);
        $client_type = $user->client_type;

        $basicInfoData = CacheBasicInfo::getBasicInformationData($client_id, false, true);

        $final_finacial_affairs = CacheSOFA::getSOFAData($client_id);

        $district_names = ZipCode::groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->get();

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor's");
        $spousename = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor's");
        if ($client_type == 2) {
            $spousename = "Non-Filing Spouse's";
        }

        $htmlData = [
                        'info' => $basicInfoData,
                        'client_id' => $client_id,
                        'client_type' => $client_type,
                        'phone_no' => $user->phone_no,
                        'email' => $user->email,
                        'can_editable' => Helper::isTabEditable('can_edit_basic_info'),
                        'finacial_affairs' => $final_finacial_affairs,
                        'district_names' => $district_names,
                        'step1' => false,
                        'step2' => false,
                        'step3' => false,
                        'step4' => false,
                        'step5' => false,
                        'step6' => false,
                        'tab' => 'tab1',
                        'attorney_edit' => true,
                        'save_route' => '',
                        'debtorname' => $debtorname,
                        'spousename' => $spousename,
                        'traded_stocks' => [],
                        'popup_label' => '',
                    ];

        return $htmlData;
    }

    public function basic_info_step1_modal_save(Request $request)
    {
        $client_id = $request->input('client_id');
        if ($request->isMethod('post')) {
            $attorney_id = Auth::user()->id;
            QuestionnaireBasicInfoPartA::saveStep1($client_id, $request, true, $attorney_id);
            $this->markReviewwedBy($attorney_id, $client_id, 'basic_info', "Basic Information", Auth::user()->name);

            return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('success', 'Data has been saved successfully.');
        }

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Invalid Request.');
    }

    public function basic_info_step2_modal_save(Request $request)
    {
        $client_id = $request->input('client_id');
        if ($request->isMethod('post')) {
            $attorney_id = Auth::user()->id;
            QuestionnaireBasicInfoPartB::saveStep2($client_id, $request, true, $attorney_id);
            $this->markReviewwedBy($attorney_id, $client_id, 'basic_info', "Basic Information", Auth::user()->name);

            return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('success', 'Data has been saved successfully.');
        }

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Invalid Request.');
    }

    public function basic_info_step3_modal_save(Request $request)
    {
        $client_id = $request->input('client_id');
        if ($request->isMethod('post')) {
            $attorney_id = Auth::user()->id;
            QuestionnaireBasicInfoPartC::saveStep3($client_id, $request, true, $attorney_id);
            $this->markReviewwedBy($attorney_id, $client_id, 'basic_info', "Basic Information", Auth::user()->name);

            return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('success', 'Data has been saved successfully.');
        }

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Invalid Request.');
    }

}
