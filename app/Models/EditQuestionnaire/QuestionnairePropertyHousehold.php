<?php

namespace App\Models\EditQuestionnaire;

use App\Helpers\Helper;
use App\Models\User;
use App\Models\ClientsPropertyHousehold;
use App\Services\Client\CacheProperty;
use Illuminate\Database\Eloquent\Model;

class QuestionnairePropertyHousehold extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_property_personal_household';
    public $timestamps = false;

    public static function saveStepPersonalHouseholdItems($client_id, $request, $save_request_by_attorney = false, $attorney_id = '')
    {
        // get all input data
        $input = $request->except('_token');

        // save property vehicle
        self::updateOrCreatePersonalHouseholdItems($input, $client_id, $save_request_by_attorney, $attorney_id);

        // forget property cache
        CacheProperty::forgetPropertyCache($client_id);

        return true;
    }

    private static function updateOrCreatePersonalHouseholdItems($input, $client_id, $save_request_by_attorney, $attorney_id)
    {
        $abFormLineStart = QuestionnaireUser::get_AB_FORM_LINE_NUMBERS('household_property');
        $abFormLineNo = '';
        if (!empty($input)) {

            if (isset($input['client_id']) && !empty($input['client_id'])) {
                unset($input['client_id']);
            }

            $function = $save_request_by_attorney ? 'questionnairePropertyHousehold' : 'clientsPropertyHousehold';

            $user = User::find($client_id);
            $dateTime = date('Y-m-d H:i:s');
            foreach ($input as $dataToSave) {
                $abFormLineNo = ($abFormLineNo == '') ? ($abFormLineStart) : ($abFormLineNo + 1);
                $dataToSave['client_id'] = $client_id;
                $dataToSave['form_ab_line_no'] = $abFormLineNo;
                $dataToSave['updated_on'] = $dateTime;
                $dataToSave['created_on'] = $dateTime;

                $type_value = Helper::validate_key_value('type_value', $dataToSave, 'radio');
                $data = Helper::validate_key_value('data', $dataToSave) ?? '';

                $dataToSave['type_data'] = (isset($type_value) && $type_value == 1) ? json_encode($data) : json_encode([]);

                if (isset($data)) {
                    unset($dataToSave['data']);
                }
                unset($dataToSave['id']);

                if ($save_request_by_attorney) {
                    $dataToSave['reviewed_by'] = $attorney_id;
                    $dataToSave['reviewed_on'] = $dateTime;
                }

                $user->$function()->where(["client_id" => $client_id, "type" => $dataToSave['type']])->delete();
                $user->$function()->create($dataToSave);
            }

            // forget property cache
            CacheProperty::forgetPropertyCache($client_id);
        }

    }


    public static function savePropertyAsset($request, $client_id, $save_request_by_attorney = false, $attorney_id = '')
    {

        $input = $request->all();
        $type = Helper::validate_key_value('type', $input);
        $data = Helper::validate_key_value('data', $input);

        switch ($type) {
            case 'everydayclothing': $type = 'clothing';
                break;
            case 'everydayfinejqwl': $type = 'jewelry';
                break;
        }

        if (!empty($client_id) && !empty($type) && !empty($data)) {
            $dateTime = date('Y-m-d H:i:s');

            $dataToSave = [
                'client_id' => $client_id,
                'type' => $type,
                'type_value' => 1,
                'type_data' => json_encode($data),
                'updated_on' => $dateTime,
            ];

            if ($save_request_by_attorney) {
                $dataToSave['reviewed_by'] = $attorney_id;
                $dataToSave['reviewed_on'] = $dateTime;
            }

            $model = $save_request_by_attorney ? (QuestionnairePropertyHousehold::class) : (ClientsPropertyHousehold::class);

            $condtion = [ 'client_id' => $client_id, 'type' => $type ];
            if (!$model::where($condtion)->exists()) {
                $dataToSave['created_on'] = $dateTime;
            }

            $model::updateOrCreate($condtion, $dataToSave);

            // forget property cache
            CacheProperty::forgetPropertyCache($client_id);
        }

    }

}
