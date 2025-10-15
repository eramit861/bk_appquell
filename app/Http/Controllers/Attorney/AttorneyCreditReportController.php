<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Models\FormsStepsCompleted;
use Illuminate\Support\Facades\File;
use App\Helpers\VideoHelper;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttorneyCreditReportController extends AttorneyController
{
    public function credit_report_uploads(Request $request)
    {
        $attorneyId = Helper::getCurrentAttorneyId();
        $clientId = $request->input('client_id');
        if ($request->hasFile('report_file')) {
            $validator = Validator::make($request->all(), [
                'report_file' => 'required|mimes:pdf|max:5120',
                'client_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('attorney_client_upload_credit_report', $clientId)->with('error', $validator->errors()->first());
            }

            $path = public_path()."/creditReport/".$attorneyId."/".$clientId;
            $this->checkOrCreateDir($path);
            $imageName = $request->report_file->getClientOriginalName();
            $imageName = time().'_'.$imageName;
            $request->report_file->move($path, $imageName);

            return redirect()->route('attorney_client_upload_credit_report', $clientId)->with('success', 'Report has been uploaded successfully.');
        }

        return redirect()->route('attorney_client_upload_credit_report', $clientId)->with('error', 'Please select Report file.');
    }

    public function upload_credit_form($id)
    {
        if (!Helper::isClientBelongsToAttorney($id, Helper::getCurrentAttorneyId())) {
            return redirect()->back()->with('error', 'Invalid request.');
        }
        $client = $this->getClientData($id);
        $editable = FormsStepsCompleted::select('can_edit')->where('client_id', $id)->first();
        $total = $this->getClientCompletedStepsCount($id);
        $path_pre = "/creditReport/".Helper::getCurrentAttorneyId()."/".$id;
        $files = \Storage::disk('s3')->files($path_pre);
        $listOfFiles = $this->getFilesArrayFromPath($files);
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_UPLOAD_CREDIT_REPORT_VIDEO);

        return view('attorney.client.creditform', ['video' => $video, 'uploadedFiles' => $listOfFiles,'User' => $client,'editable' => (isset($editable->can_edit) ? $editable->can_edit : 0),'type' => 'credit_form', 'totals' => $total]);
    }

    public function attorney_delete_credit_report($client_id, $fileName)
    {
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->back()->with('error', 'Invalid request.');
        }
        $attorney_id = Helper::getCurrentAttorneyId();
        $store_path = "/creditReport/".$attorney_id.'/'.$client_id;
        $path = public_path().'/'.$store_path;
        if (File::exists($path.'/'.$fileName)) {
            unlink($path.'/'.$fileName);
        }

        return redirect()->route('attorney_client_upload_credit_report', $client_id)->with('success', 'Document has been deleted successfully.');
    }
}
