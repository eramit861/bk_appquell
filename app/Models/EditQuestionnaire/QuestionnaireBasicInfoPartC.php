<?php

namespace App\Models\EditQuestionnaire;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use App\Models\ClientBasicInfoPartC;
use App\Services\Client\CacheBasicInfo;

class QuestionnaireBasicInfoPartC extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_basic_info_part_c';
    public $timestamps = false;

    public static function saveStep3($client_id, $request, $save_request_by_attorney = false, $attorney_id = '')
    {

        // determine which model to use
        $modelBasicInfoPartC = $save_request_by_attorney ? (QuestionnaireBasicInfoPartC::class) : (ClientBasicInfoPartC::class);

        // get all input data
        $input = $request->all();

        // save basic info part C
        self::saveBasicInfoPartCFromBasicInfoStep3($client_id, $input, $modelBasicInfoPartC, $save_request_by_attorney, $attorney_id);

        // save basic info part rest data
        QuestionnaireBasicInfoPartRest::saveBasicInfoPartRestFromBasicInfoStep3($client_id, $input, $save_request_by_attorney);

        // save basic info part rest data
        QuestionnairePropertyFinancialAssets::savePropertyFinancialAssetsFromBasicInfoStep3($client_id, $input, $save_request_by_attorney);

        // clear cache for client basic information
        CacheBasicInfo::forgetBasicInformationCache($client_id);

        return true;
    }

    public static function saveBasicInfoPartCFromBasicInfoStep3($client_id, $input, $model, $save_request_by_attorney, $attorney_id)
    {

        $dateTime = date('Y-m-d H:i:s');

        $inputData = Helper::validate_key_value('part3', $input);

        $pendingPiorCases = Helper::validate_key_value('pending_pior_cases', $inputData, 'radio');
        $filedBankruptcyCaseLast8Years = Helper::validate_key_value('filed_bankruptcy_case_last_8years', $inputData, 'radio');
        $anyBankruptcyCasesPending = Helper::validate_key_value('any_bankruptcy_cases_pending', $inputData, 'radio');
        $bankruptcyFiledBefore = Helper::validate_key_value('bankruptcy_filed_before', $inputData, 'radio');

        $dataToSave = [
                'client_id' => $client_id,
                'pending_pior_cases' => $pendingPiorCases,
                'filed_bankruptcy_case_last_8years' => $filedBankruptcyCaseLast8Years,
                'any_bankruptcy_cases_pending' => $anyBankruptcyCasesPending,
                'bankruptcy_filed_before' => $bankruptcyFiledBefore,
                'case_filed_state' => '',
                'case_number' => '',
                'date_filed' => '',
                'date_discharge' => '',
                'is_case_dismissed' => '',
                'dismissed_date' => '',
                'filed_bankruptcy_case_last_8years_data' => '',
                'any_bankruptcy_cases_pending_data' => '',
                'any_bankruptcy_filed_before_data' => '',
                'status' => 1,
                'updated_on' => $dateTime,
            ];

        if ($pendingPiorCases == 1) {
            if ($filedBankruptcyCaseLast8Years == 1) {
                $dataToSave['case_filed_state'] = json_encode(Helper::validate_key_value('case_filed_state', $inputData));
                $dataToSave['case_number'] = json_encode(Helper::validate_key_value('case_number', $inputData));
                $dataToSave['date_filed'] = json_encode(Helper::validate_key_value('date_filed', $inputData));
                $dataToSave['date_discharge'] = json_encode(Helper::validate_key_value('date_discharge', $inputData));
                $dataToSave['is_case_dismissed'] = json_encode(Helper::validate_key_value('is_case_dismissed', $inputData));
                $dataToSave['dismissed_date'] = json_encode(Helper::validate_key_value('dismissed_date', $inputData));
            }

            $anyBankruptcyCasesPendingData = Helper::validate_key_value('any_bankruptcy_cases_pending_data', $inputData);
            if (($anyBankruptcyCasesPending == 1) && !empty($anyBankruptcyCasesPendingData)) {
                $dataToSave['any_bankruptcy_cases_pending_data'] = json_encode($anyBankruptcyCasesPendingData);
            }

            $anyBankruptcyFiledBeforeData = Helper::validate_key_value('any_bankruptcy_filed_before_data', $inputData);
            if (($bankruptcyFiledBefore == 1) && !empty($anyBankruptcyFiledBeforeData)) {
                $dataToSave['any_bankruptcy_filed_before_data'] = json_encode($anyBankruptcyFiledBeforeData);
            }
        } else {
            $dataToSave['pending_pior_cases'] = 0;
            $dataToSave['filed_bankruptcy_case_last_8years'] = 0;
            $dataToSave['case_filed_state'] = '';
            $dataToSave['any_bankruptcy_cases_pending'] = 0;
            $dataToSave['any_bankruptcy_cases_pending_data'] = '';
            $dataToSave['bankruptcy_filed_before'] = 0;
            $dataToSave['any_bankruptcy_filed_before_data'] = '';
        }

        $condtion = [ 'client_id' => $client_id ];
        if (!$model::where($condtion)->exists()) {
            $dataToSave['created_on'] = $dateTime;
        }

        if ($save_request_by_attorney) {
            $dataToSave['reviewed_by'] = $attorney_id;
            $dataToSave['reviewed_on'] = $dateTime;
        }

        $model::updateOrCreate($condtion, $dataToSave);

        return true;

    }

}
