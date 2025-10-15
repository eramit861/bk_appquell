<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheProperty;
use Illuminate\Http\Request;

class ChapterPlanController extends AttorneyController
{
    public function popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'] ?? 0;
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $chapterPlan = \App\Models\ChapterThirteenPlan::where('client_id', $client_id)->first();
        $meantestData = \App\Models\MeanTestData::where('client_id', $client_id)->first();

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $BasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');

        $propertyData = CacheProperty::getPropertyData($client_id);
        $mortgageDetails = Helper::validate_key_value('propertyresident', $propertyData, 'array');
        $vehicleMortgage = Helper::validate_key_value('propertyvehicle', $propertyData, 'array');

        return view('attorney.official_form.chapter_plan_popup', ['BasicInfoPartA' => $BasicInfoPartA, 'meantestData' => $meantestData,'mortgages' => $mortgageDetails, 'vehicleMortgage' => $vehicleMortgage, 'chapterPlan' => $chapterPlan, 'client_id' => $client_id]);
    }

    public function chapter_plan_popup_save(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            unset($input['fIsAjax']);
            unset($input['fOutMode']);
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $dataTosave = ['plan_data' => json_encode($input)];
            if (empty($dataTosave)) {
                return response()->json(Helper::renderJsonError("Invalid request", []))
                    ->header('Content-Type: application/json;', 'charset=utf-8');
            }
            \App\Models\ChapterThirteenPlan::updateOrCreate([
                'client_id' => $client_id,
            ], $dataTosave);

            return response()->json(Helper::renderJsonSuccess("Data save Successfully!", []))
                ->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function chapter_plan_popup_reset(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            \App\Models\ChapterThirteenPlan::where(['client_id' => $client_id])->delete();

            return response()->json(Helper::renderJsonSuccess("Plan Data Reset successfully", []))
            ->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }
}
