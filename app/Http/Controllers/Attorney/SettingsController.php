<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\VideoHelper;
use App\Models\AttorneyDocuments;
use App\Models\AttorneyCommonDocuments;
use App\Models\AttorneyExcludeDocs;
use App\Models\AttorneySettings;
use App\Models\LawFirmAssociate;

class SettingsController extends AttorneyController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $origionalAttId = Helper::getCurrentAttorneyId();
        $authUser = Auth::user();
        $attorney_id = $authUser->parent_attorney_id == $origionalAttId ? $origionalAttId : $authUser->id;
        $associate_name = "";
        $is_associate = 0;
        $associate_id = $request->query('associate_id', '');
        if (!empty($associate_id)) {
            $attorney_id = $associate_id;
            $associate = LawFirmAssociate::where('id', $associate_id)->first();
            $associate_name = !empty($associate) ? ($associate->firstName . ' ' . $associate->lastName) : '';
            $is_associate = 1;
        }

        $exlude = AttorneyExcludeDocs::where(['attorney_id' => $attorney_id, 'is_associate' => $is_associate])->select('doc_type_json')->first();
        $exclude = !empty($exlude) ? $exlude['doc_type_json'] : '';
        if (!empty($exclude)) {
            $exclude = json_decode($exclude, 1);
        }

        $certificateenable = AttorneyDocuments::where(['attorney_id' => $attorney_id, 'is_associate' => $is_associate, 'document_type' => 'Pre_Filing_Bankruptcy_Certificate_CCC'])->first();
        $documents = AttorneyDocuments::orderBy('id', 'DESC')->where(['attorney_id' => $attorney_id, 'is_associate' => $is_associate])->where('document_type', '!=', 'Pre_Filing_Bankruptcy_Certificate_CCC')->paginate(10);
        $attorneySettings = AttorneySettings::where(['attorney_id' => $attorney_id, 'is_associate' => $is_associate])->first();
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_ADDITIOANL_DOCUMENT_UPLOAD);

        $associate_data = ['is_associate' => $is_associate, 'associate_name' => $associate_name, 'associate_id' => $associate_id,];

        $AttorneyCommonDocuments = AttorneyCommonDocuments::orderBy('id', 'DESC')
            ->where([
                'attorney_id' => $attorney_id,
                'is_associate' => $is_associate,
            ]);

        // Documents where `document_type` does NOT start with "post_submission_doc_"
        $commonDocuments = (clone $AttorneyCommonDocuments)
            ->where('document_type', 'not like', 'post_submission_doc_%')
            ->paginate(10);

        // Documents where `document_type` starts with "post_submission_doc_"
        $pSDocuments = (clone $AttorneyCommonDocuments)
            ->where('document_type', 'like', 'post_submission_doc_%')
            ->paginate(10);

        $type = $request->query('type', 1);

        return view('attorney.settings.index', ['type' => $type, 'commonDocuments' => $commonDocuments, 'pSDocuments' => $pSDocuments, 'associate_data' => $associate_data, 'exclude_docs' => $exclude, 'video' => $video, 'attorneySettings' => $attorneySettings,'certificateenable' => $certificateenable, 'documents' => $documents]);
    }

    public function attorney_setting_save(Request $request)
    {
        $type = $request->query('type', 1);
        $input = $request->all();
        $is_associate = Helper::validate_key_value('is_associate', $input, 'radio');
        $associate_id = Helper::validate_key_value('associate_id', $input, 'radio');

        $attorney_id = $is_associate ? $associate_id : Auth::user()->id;

        unset($input['is_associate']);
        unset($input['associate_id']);
        unset($input['_token']);
        unset($input['type']);

        $notification_status = Helper::validate_key_value('notification_status', $input);

        if (!empty($notification_status)) {
            $dataToSave['notification_status'] = json_encode($notification_status);
        } else {
            $dataToSave = $input;
        }

        $dataToSave['attorney_id'] = $attorney_id;
        AttorneySettings::updateOrCreate(["attorney_id" => $attorney_id, 'is_associate' => $is_associate], $dataToSave);

        return ($is_associate)
            ? redirect()->route('attorney_lawfirm_settings', ['associate_id' => $attorney_id, 'type' => $type])->with("success", 'Settings updated successfully')
            : redirect()->route('attorney_settings', ['type' => $type])->with("success", 'Settings updated successfully');

    }
}
