<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class FilingInformationController extends AttorneyController
{
    public function filing_information_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'] ?? 0;
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($client_id == 0) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $filingData = \App\Models\FillingInformation::where('client_id', $client_id)->first();

        return view('attorney.official_form.filing_information_popup', ['client_id' => $client_id, 'filingData' => $filingData]);
    }

    public function filing_information_popup_save(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            unset($input['fIsAjax']);
            unset($input['fOutMode']);
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $saveType = $input['saveType'];
            $resetType = $input['resetType'];
            $dataTosave = $this->getDataOnSaveType($saveType, $input, $resetType);
            // $successMessage = $this->getSuccessMessageOnSaveType($saveType);
            if (empty($dataTosave)) {
                return response()->json(Helper::renderJsonError("Invalid request", []))
                    ->header('Content-Type: application/json;', 'charset=utf-8');
            }
            \App\Models\FillingInformation::updateOrCreate([
                'client_id' => $client_id,
            ], $dataTosave);

            return response()->json(Helper::renderJsonSuccess("Record Saved Successfully", []))
                ->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    private function getDataOnSaveType($saveType, $input, $resetType)
    {
        $data = json_encode($input);
        if ($resetType == 'true') {
            $data = null;
        }
        if ($saveType == 'basic_info') {
            return ['basic_info' => $data];
        }
        if ($saveType == 'summary_info') {
            return ['summary_of_schedule' => $data];
        }
        if ($saveType == 'meanstest_info') {
            return ['meantest_information' => $data];
        }

        return [];
    }



}
