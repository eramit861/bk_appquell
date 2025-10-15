<?php

namespace App\Models\EditQuestionnaire;

use App\Helpers\Helper;
use App\Models\User;
use App\Services\Client\CacheProperty;
use Illuminate\Database\Eloquent\Model;

class QuestionnairePropertyFarmCommercial extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_property_farm_commercial';
    public $timestamps = false;

    public static function saveStepPropertyFarmCommercial($client_id, $request, $save_request_by_attorney = false, $attorney_id = '')
    {
        // get all input data
        $input = $request->except('_token');

        // save farm commercial data
        self::updateOrCreatePropertyFarmCommercial($input, $client_id, $save_request_by_attorney, $attorney_id);

        // forget property cache
        CacheProperty::forgetPropertyCache($client_id);
    }

    private static function updateOrCreatePropertyFarmCommercial($input, $client_id, $save_request_by_attorney, $attorney_id)
    {
        $abFormLineStart = QuestionnaireUser::get_AB_FORM_LINE_NUMBERS('farm_and_commercial_fishing_related_property');
        $abFormLineNo = '';
        if (!empty($input)) {

            if (isset($input['client_id']) && !empty($input['client_id'])) {
                unset($input['client_id']);
            }

            $function = $save_request_by_attorney ? 'QuestionnairePropertyFarmCommercial' : 'clientsPropertyFarmCommercial';

            $user = User::find($client_id);
            $dateTime = date('Y-m-d H:i:s');
            foreach ($input as $dataToSave) {
                $abFormLineNo = ($abFormLineNo == '') ? ($abFormLineStart + 1) : ($abFormLineNo + 1);
                $dataToSave['client_id'] = $client_id;
                $dataToSave['form_ab_line_no'] = $abFormLineNo;
                $dataToSave['updated_on'] = $dateTime;
                $dataToSave['created_on'] = $dateTime;

                $type_value = Helper::validate_key_value('type_value', $dataToSave, 'radio');
                $data = Helper::validate_key_value('data', $dataToSave) ?? '';

                $dataToSave['type_data'] = (isset($type_value) && $type_value == 1) ? json_encode($data) : json_encode([]);

                $assetId = Helper::validate_key_value('id', $dataToSave, 'radio');
                if (isset($data)) {
                    unset($dataToSave['data']);
                }
                unset($dataToSave['id']);

                if ($save_request_by_attorney) {
                    $dataToSave['reviewed_by'] = $attorney_id;
                    $dataToSave['reviewed_on'] = $dateTime;
                }

                $user->$function()->updateOrCreate([ 'id' => $assetId, 'client_id' => $client_id ], $dataToSave);

            }

            // forget property cache
            CacheProperty::forgetPropertyCache($client_id);
        }
    }
}
