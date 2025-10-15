<?php

namespace App\Http\Controllers;

use App\Helpers\AddressHelper;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function download_zip()
    {

        $clients = \App\Models\ClientBasicInfoPartA::whereNotNull('state')
            ->pluck('state', 'client_id')
            ->toArray();

        foreach ($clients as $client_id => $stateCode) {
            $stateName = '';
            $stateName = AddressHelper::getStateNameByCode($stateCode);
            $stateName = preg_replace('/\s*\(.*\)$/', '', $stateName);
            $districtQuery = \App\Models\Districts::where('short_name', $stateName);

            $district = $districtQuery->count() === 1 ? $districtQuery->first() : null;
            $districtId = (is_object($district) && isset($district->id)) ? $district->id : 0;

            if ($districtId > 0 && !empty($stateName)) {
                $attData = \App\Models\AttorneyEditorData::where(['client_id' => $client_id])->first();
                $attData = isset($attData['data']) && !empty($attData['data']) ? json_decode($attData['data'], 1) : [];
                $attData['district_id'] = $districtId;
                $attData['editor_chepter'] = 'chapter7';
                $attData['district_name'] = $stateName;
                $attData['district_full_name'] = 'District Of '.$stateName;
                $attData['district_attorney'] = 'District Of '.$stateName;
                $existing = \App\Models\AttorneyEditorData::where('client_id', $client_id)->first();
                if ($existing) {
                    $existing->data = json_encode($attData);
                    $existing->save();
                    Log::info("AttorneyEditorData row updated for client_id: $client_id");
                } else {
                    \App\Models\AttorneyEditorData::create([
                       'client_id' => $client_id,
                       'data' => json_encode($attData)
                        ]);
                    Log::info("AttorneyEditorData row created for client_id: $client_id");
                }
            }
        }
    }


}
