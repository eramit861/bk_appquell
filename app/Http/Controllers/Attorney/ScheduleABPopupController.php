<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class ScheduleABPopupController extends AttorneyController
{
    public function sch_ab_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($client_id == 0) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $client_attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->select('attorney_id')->first();
        $client_attorney = (!empty($client_attorney)) ? $client_attorney : [];
        $attorney_id = $client_attorney->attorney_id;

        $data = \App\Models\AttorneyAbTemplate::where('attorney_id', $attorney_id)->first();
        $data = !empty($data) ? $data->toArray() : [];
        $dis = isset($data['ab_data']) && !empty($data['ab_data']) ? json_decode($data['ab_data'], 1) : null;

        return view('attorney.official_form.sch_ab_popup', ['client_id' => $client_id,'ab_data' => $dis]);
    }

    public function save_ab_template(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];

        $client_attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->select('attorney_id')->first();
        $client_attorney = (!empty($client_attorney)) ? $client_attorney : [];
        $attorney_id = $client_attorney->attorney_id;

        unset($input['_token']);
        unset($input['client_id']);
        if ($client_id == 0) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $dataToSave = ['ab_data' => json_encode($input),'attorney_id' => $attorney_id];
        $dataTocheck = ['attorney_id' => $attorney_id];
        \App\Models\AttorneyAbTemplate::updateOrCreate($dataTocheck, $dataToSave);

        return redirect()->route('attorney_offical_form', $client_id)->with('success', 'Sch A/B Template Saved Successflly.');
    }

    public function import_ab_template(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        if ($client_id == 0) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $client_attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->select('attorney_id')->first();
        $client_attorney = (!empty($client_attorney)) ? $client_attorney : [];
        $attorney_id = $client_attorney->attorney_id;

        $abclient = \App\Models\AttorneyClientHtml::where(['client_id' => $client_id,'form_id' => '106a_and_b'])->first();
        $abclientdata = !empty($abclient) ? $abclient->toArray() : [];
        $abclientdata = Helper::validate_key_value('data', $abclientdata);

        $attorneyTemp = \App\Models\AttorneyAbTemplate::where(['attorney_id' => $attorney_id])->select('ab_data')->first();
        $attorneyTemp = !empty($attorneyTemp) ? $attorneyTemp->toArray() : [];
        $attorneyTemp = Helper::validate_key_value('ab_data', $attorneyTemp);
        if (!empty($attorneyTemp)) {
            $attorneyTemp = json_decode($attorneyTemp, 1);
        }
        if (!empty($abclientdata)) {
            $abclientdata = json_decode($abclientdata, 1);
        }

        $newclientdata = array_replace($abclientdata, $attorneyTemp);

        $abclient = \App\Models\AttorneyClientHtml::where(['client_id' => $client_id,'form_id' => '106a_and_b'])->update(['data' => json_encode($newclientdata)]);

        return response()->json(Helper::renderJsonSuccess('Template Imported Successfully'))->header('Content-Type: application/json;', 'charset=utf-8');
    }


}
