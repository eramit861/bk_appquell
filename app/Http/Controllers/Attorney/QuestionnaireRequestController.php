<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Models\OnePageQuestionnaireRequest;
use App\Helpers\Helper;
use App\Helpers\VideoHelper;
use App\Models\AttorneyCommonDocuments;
use App\Models\IntakeFormUpdateLogs;
use App\Models\ShortLink;
use App\Models\ZipCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuestionnaireRequestController extends AttorneyController
{
    public function index(Request $request)
    {
        $type = "";
        $attorney_id = Helper::getCurrentAttorneyId();
        $input = $request->all();
        $keyword = urldecode($request->query('q'));
        $active = $input['active'] ?? 0;
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'desc');

        $onePage = OnePageQuestionnaireRequest::where("tbl_one_page_questionnaire_request.id", "!=", null)
            ->where("tbl_one_page_questionnaire_request.martial_status", "!=", null)
            ->where("tbl_one_page_questionnaire_request.attorney_id", $attorney_id)
            ->leftjoin('users', 'users.onepage_questionnaire_request_id', '=', 'tbl_one_page_questionnaire_request.id');

        if ($active == 0) {
            $onePage->where("users.onepage_questionnaire_request_id", "=", null);
        } else {
            $onePage->where("users.onepage_questionnaire_request_id", "!=", null);
        }

        $onePage->select(['tbl_one_page_questionnaire_request.id',
            'tbl_one_page_questionnaire_request.attorney_id',
            'tbl_one_page_questionnaire_request.name',
            'tbl_one_page_questionnaire_request.middle_name',
            'tbl_one_page_questionnaire_request.created_at',
            'tbl_one_page_questionnaire_request.is_imported',
            'tbl_one_page_questionnaire_request.last_name',
            'tbl_one_page_questionnaire_request.email',
            'tbl_one_page_questionnaire_request.cell',
            'users.onepage_questionnaire_request_id',
            'tbl_one_page_questionnaire_request.martial_status',
            'tbl_one_page_questionnaire_request.spouse_email',
            'tbl_one_page_questionnaire_request.spouse_name',
            'tbl_one_page_questionnaire_request.spouse_middle_name',
            'tbl_one_page_questionnaire_request.spouse_last_name',
            'tbl_one_page_questionnaire_request.spouse_cell',

            'tbl_one_page_questionnaire_request.step_completed',
            'tbl_one_page_questionnaire_request.step_1_submited',
            'tbl_one_page_questionnaire_request.step_2_submited',
            'tbl_one_page_questionnaire_request.step_3_submited',
            'tbl_one_page_questionnaire_request.spouse_filing_with_you',
        ]);
        if (!empty($request->query('q'))) {
            $onePage->Where(function ($query) use ($request) {
                $query->Where('tbl_one_page_questionnaire_request.name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('tbl_one_page_questionnaire_request.middle_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('tbl_one_page_questionnaire_request.last_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('tbl_one_page_questionnaire_request.email', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('tbl_one_page_questionnaire_request.cell', 'like', '%' . $request->query('q') . '%');
            });
        }

        $perPage = $request->input('per_page', 10);

        $onePage = $onePage->orderBy($sortBy, $sortOrder);
        $onePage = $onePage->paginate($perPage)->appends([
            'q' => $request->input('q'),
            'per_page' => $perPage,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ]);

        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_SHORT_FORM_LISTING_VIDEO);
        $invitevideo = VideoHelper::getAttorneyVideos(Helper::INVITE_CLIENT_VIDEO);
        $encryptedid = base64_encode($attorney_id);
        $linkinput['link'] = route('questionnaire')."?token=".$encryptedid;

        $linkinput['attorney_id'] = $attorney_id;

        $url = ShortLink::getSetLink($linkinput, $attorney_id);
        $linkinput['link_for'] = ShortLink::CUSTOM_INTAKE_LINK;
        $linkinput['custom_intake_link'] = route('intake_form')."?token=".$encryptedid;
        $urlCustom = ShortLink::getSetLink($linkinput, $attorney_id);

        $iDocStatus = \App\Models\User::where('id', $attorney_id)->select('invite_document_selection')->first();
        $iDocStatus = !empty($iDocStatus) ? $iDocStatus->invite_document_selection : 0;

        $attorneydocuments = \App\Models\AttorneyDocuments::where(['attorney_id' => $attorney_id,'is_associate' => 0])->pluck('document_name', 'document_type')->all();
        $attorneydocuments = array_keys($attorneydocuments);

        $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $attorney_id,'is_associate' => 0])->select(['enabled_detailed_property'])->first();
        $associates = \App\Models\LawFirmAssociate::where('attorney_id', $attorney_id);
        $associates = $associates->orderBy('id', 'DESC')->get();
        $associates = isset($associates) && !empty($associates) ? $associates->toArray() : [];

        $commonDocuments = AttorneyCommonDocuments::orderBy('id', 'DESC')->where([ 'attorney_id' => $attorney_id, 'is_associate' => 0 ])->get();
        $commonDocuments = isset($commonDocuments) && !empty($commonDocuments) ? $commonDocuments->toArray() : [];

        $conditionalQuestionArray = \App\Models\ShortFormConditionalFields::getConditionalQuestionArray();
        $checkedQuestions = \App\Models\ShortFormConditionalFields::where('attorney_id', $attorney_id)->first();
        $question_to_show = $checkedQuestions['question_to_show'] ?? '';
        $question_to_show = !empty($question_to_show) ? json_decode($question_to_show, 1) : [];

        $conditionalQuePopupData = ['conditionalQuestionArray' => $conditionalQuestionArray, 'question_to_show' => $question_to_show];

        $questions = \App\Models\ConciergeAttorneyQuestions::where(['attorney_id' => $attorney_id, 'is_deleted' => '0'])->orderby('id', 'asc')->get();
        $questions = !empty($questions) ? $questions->toArray() : [];

        return view('attorney.questionnaire_intake_management')->with(['attorney_id' => $attorney_id, 'urlCustom' => $urlCustom, 'questions' => $questions, 'conditionalQuePopupData' => $conditionalQuePopupData, 'commonDocuments' => $commonDocuments, 'associates' => $associates, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'per_page' => $perPage,'attorney_detailed_property_enabled' => $attorneySettings->enabled_detailed_property, 'url' => $url,'keyword' => $keyword, 'video' => $video,'invite_video' => $invitevideo,"active" => $active , "type" => $type, "iDocStatus" => $iDocStatus,  "attorneydocuments" => $attorneydocuments, "onePage" => $onePage,'encryptedid' => $encryptedid]);
    }

    public function import(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $requestId = $input['request_id'];
            if ($requestId < 1 && !OnePageQuestionnaireRequest::where(['id' => $requestId,'attorney_id' => Helper::getCurrentAttorneyId()])->exists()) {
                return redirect()->route('questionnaire_index')->with('error', 'Invalid request');
            }

            $user = \App\Models\User::where('onepage_questionnaire_request_id', $requestId)->select(['id','client_type'])->first();
            if (empty($user)) {
                return redirect()->route('questionnaire_index')->with('error', 'Invalid request');
            }


            return response()->json(Helper::renderJsonSuccess('Data imported Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

    }

    public function conditional_questions_save(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();

        $data = $request->input('data', []);

        if (!empty($data) && is_array($data)) {
            foreach ($data as $key => $value) {
                if ($value == 0) {
                    unset($data[$key]);
                }
            }
        }

        $dataToSave = [];
        $dataToSave['attorney_id'] = $attorney_id;
        $dataToSave['question_to_show'] = json_encode(array_keys($data));
        $existingRecord = \App\Models\ShortFormConditionalFields::where('attorney_id', $attorney_id)->exists();
        if (!$existingRecord) {
            $dataToSave['created_at'] = date('Y-m-d H:i:s');
        }
        $dataToSave['updated_at'] = date('Y-m-d H:i:s');
        \App\Models\ShortFormConditionalFields::updateOrCreate(['attorney_id' => $attorney_id], $dataToSave);

        return redirect()->back()->with('success', 'Record updated sucessfully');
    }

    public function attorney_concierge_question_save(Request $request)
    {
        $input = $request->all();
        \App\Models\ConciergeAttorneyQuestions::Create(['attorney_id' => Helper::getCurrentAttorneyId(), 'question' => $input['question'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);

        return redirect()->back()->with('success', 'Record has been added successfully.');
    }

    public function attorney_concierge_question_update(Request $request)
    {
        $input = $request->all();
        $question_id = $input['question_id'];
        \App\Models\ConciergeAttorneyQuestions::where('id', $question_id)->update(['question' => $input['new_question']]);

        return response()->json(Helper::renderJsonSuccess("Record updated sucessfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function attorney_concierge_question_delete(Request $request)
    {
        $input = $request->all();
        $question_id = $input['question_id'];
        \App\Models\ConciergeAttorneyQuestions::where('id', $question_id)->update(['is_deleted' => 1]);

        return response()->json(Helper::renderJsonSuccess("Record updated sucessfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function attorney_short_form_notes_popup(Request $request)
    {
        $input = $request->all();
        $notes = self::getNotesForQuesId($input['questionnaire_id']);

        return view('attorney.attorney_short_form_notes_popup', ['notes' => $notes, 'questionnaire_id' => $input['questionnaire_id']]);
    }

    public static function getNotesForQuesId($quesId)
    {
        $notes = \App\Models\ShortFormNotes::where('questionnaire_id', $quesId)
                    ->select([
                        'id',
                        'questionnaire_id',
                        'attorney_id as added_by_id',
                        'subject',
                        'notes as note',
                        'created_at',
                        'updated_at',
                    ])
                    ->orderby('id', 'asc')
                    ->get();

        return !empty($notes) ? $notes->toArray() : [];
    }


    public function attorney_short_form_notes_save(Request $request)
    {
        $input = $request->all();
        \App\Models\ShortFormNotes::Create(['attorney_id' => Helper::getCurrentAttorneyId(), 'questionnaire_id' => $input['questionnaire_id'], 'notes' => $input['note'], 'subject' => $input['category'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]);

        return redirect()->back()->with('success', 'Record has been added successfully.');
    }

    public function attorney_short_form_notes_update(Request $request)
    {
        $input = $request->all();
        $notes_id = $input['notes_id'];
        \App\Models\ShortFormNotes::where('id', $notes_id)->update(['notes' => $input['new_notes']]);

        return response()->json(Helper::renderJsonSuccess("Record updated sucessfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function questionnaire_view(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $details = OnePageQuestionnaireRequest::where('id', $client_id)->first();
        $finalDetails = \App\Services\CreditorsService::calculateTax($details);
        $details = !empty($details) ? $details->toArray() : [];
        $concierge_question_details = json_decode($details['concierge_question'], 1) ?? [];
        $concierge_questions = [];
        $attorney_id = Helper::getCurrentAttorneyId();
        if (!empty($concierge_question_details)) {
            foreach ($concierge_question_details as $index => $value) {
                $question = \App\Models\ConciergeAttorneyQuestions::where('attorney_id', $attorney_id)->where('id', $index)->first();
                $questionObject = [ 'question' => $question['question'], 'value' => $value ];
                array_push($concierge_questions, $questionObject);
            }
        }

        $attQuestions = \App\Models\ConciergeAttorneyQuestions::where(['attorney_id' => $attorney_id, 'is_deleted' => '0'])->orderby('id', 'asc')->get();
        $attQuestions = !empty($attQuestions) ? $attQuestions->toArray() : [];

        $notes = self::getNotesForQuesId($client_id);

        $notesForm = view('attorney.attorney_short_form_notes_popup', ['notes' => $notes, 'questionnaire_id' => $client_id]);

        $conditionalQuestions = \App\Models\ShortFormConditionalFields::where('attorney_id', $attorney_id)->first();
        $question_to_show = $conditionalQuestions['question_to_show'] ?? '';
        $question_to_show = !empty($question_to_show) ? json_decode($question_to_show, 1) : [];

        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $district_names = ZipCode::groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->select(['short_name','district_name','id' ])->get();

        $historyLog = IntakeFormUpdateLogs::where('form_id', $client_id)->get();
        $historyLog = !empty($historyLog) ? $historyLog->toArray() : [];

        $returnHTML = view('modal.attorney.client_intake_management.questions_preview')
            ->with(['is_print' => 0, 'historyLog' => $historyLog, 'details' => $details, 'finalDetails' => $finalDetails, 'district_names' => $district_names, 'concierge_questions' => $concierge_questions, 'notes' => $notes, 'notesForm' => $notesForm, 'conditionalQuestions' => $question_to_show, 'questions' => $attQuestions, 'attorney_company' => $attorney_company])
            ->render();

        return response()->json(data: ['success' => true, 'html' => $returnHTML]);
    }

    public function show_log_history_modal(Request $request)
    {
        $input = $request->all();
        $dataFor = $input['dataFor'];
        $formId = $input['formId'];
        $historyLog = IntakeFormUpdateLogs::where('form_id', $formId);
        if ($dataFor) {
            $historyLog->where('section_name', '=', $dataFor);
        }
        $historyLog = $historyLog->orderBy('created_at', 'DESC')->get();
        $historyLog = !empty($historyLog) ? $historyLog->toArray() : [];

        $returnHTML = view('modal.attorney.client_intake_management.history_log')
            ->with(['historyLog' => $historyLog, 'dataFor' => $dataFor])
            ->render();

        return response()->json(data: ['success' => true, 'html' => $returnHTML]);
    }

    public function print_pdf(Request $request, $id)
    {
        $input = $request->all();
        $details = OnePageQuestionnaireRequest::where('id', $id)->first();
        $details = !empty($details) ? $details->toArray() : [];
        $pdf = PDF::loadView('attorney.questionnaire_import_popup', ['is_print' => 1, 'details' => $details]);

        return $pdf->download('import_data.pdf');
    }

    public function delete_intake_request(Request $request)
    {
        $input = $request->all();
        $request_id = $input['request_id'];
        $request_exists = OnePageQuestionnaireRequest::where('id', $request_id)->exists();
        if ($request_exists == true) {
            \App\Models\User::where('onepage_questionnaire_request_id', $request_id)->update(['onepage_questionnaire_request_id' => 0]);
            OnePageQuestionnaireRequest::where('id', $request_id)->delete();

            return response()->json(Helper::renderJsonSuccess('Data Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

}
