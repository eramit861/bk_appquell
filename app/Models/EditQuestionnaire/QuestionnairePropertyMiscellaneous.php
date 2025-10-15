<?php

namespace App\Models\EditQuestionnaire;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use App\Models\FormsStepsCompleted;
use App\Services\Client\CacheProperty;

class QuestionnairePropertyMiscellaneous extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_property_miscellaneous';
    public $timestamps = false;

    public static function updatePropertyMiscellaneousFromPropertyFinancialAssetsContinued($input, $user, $client_id, $attorney_id, $save_request_by_attorney)
    {

        $other_financial = Helper::validate_key_value('other_financial', $input) ?? [];

        if (isset($other_financial) && !empty($other_financial)) {

            $dateTime = date('Y-m-d H:i:s');

            $other_financial['type'] = 'miscellaneous';
            $other_financial['client_id'] = $client_id;
            $other_financial['form_ab_line_no'] = QuestionnaireUser::get_AB_FORM_LINE_NUMBERS('miscellaneous');
            $other_financial['updated_on'] = $dateTime;
            $other_financial['created_on'] = $dateTime;

            $type_value = Helper::validate_key_value('type_value', $other_financial, 'radio');
            $data = Helper::validate_key_value('data', $other_financial) ?? [];

            $other_financial['type_data'] = (!empty($type_value) && $type_value == 1) ? json_encode($data) : json_encode([]);

            unset($other_financial['data']);

            $function = 'clientsPropertyMiscellaneous';
            if ($save_request_by_attorney) {
                $function = 'questionnairePropertyMiscellaneous';
                $other_financial['reviewed_by'] = $attorney_id;
                $other_financial['reviewed_on'] = $dateTime;
            }

            $savedData = $user->$function();
            if ($savedData->exists()) {
                $existingRecord = $savedData->first(); // No need to convert to an array
                unset($other_financial['id']); // Make sure you're not modifying the id
                $user->$function()->where("id", $existingRecord->id)->update($other_financial);
            } else {
                $user->$function()->create($other_financial);
            }

            FormsStepsCompleted::updateOrCreate(["client_id" => $client_id], ['client_id' => $client_id, 'step2' => 1]);

            // forget property cache
            CacheProperty::forgetPropertyCache($client_id);
        }
    }

}
