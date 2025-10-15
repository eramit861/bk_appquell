<?php

namespace App\Models\EditQuestionnaire;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClientBasicInfoPartA;
use App\Models\ClientAnyOtherNameData;
use App\Models\FinancialAffairs;
use App\Helpers\Helper;
use App\Helpers\AddressHelper;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheSOFA;

class QuestionnaireBasicInfoPartA extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_basic_info_part_a';
    public $timestamps = false;

    public static function saveStep1($client_id, $request, $save_request_by_attorney = false, $attorney_id = '')
    {

        // determine which model to use
        $modelBasicInfo = $save_request_by_attorney ? (QuestionnaireBasicInfoPartA::class) : (ClientBasicInfoPartA::class);
        $modelFinancialAffair = $save_request_by_attorney ? (QuestionnaireFinancialAffairs::class) : (FinancialAffairs::class);
        $modelAnyOtherName = $save_request_by_attorney ? (QuestionnaireBasicInfoAnyOtherName::class) : (ClientAnyOtherNameData::class);

        // get all input data
        $input = $request->all();

        // save basic info part A
        self::saveBasicInfoPartAFromBasicInfoStep1($client_id, $input, $modelBasicInfo, $save_request_by_attorney, $attorney_id);

        // save financial affair
        self::saveFinancialAffairFromBasicInfoStep1($client_id, $input, $modelFinancialAffair);

        // save any other name data
        self::saveAnyOtherNameDataFromBasicInfoStep1($client_id, $input, $modelAnyOtherName);

        // clear cache for client basic information
        CacheBasicInfo::forgetBasicInformationCache($client_id);

        // clear cache for client SOFA
        CacheSOFA::forgetSOFACache($client_id);

        return true;
    }

    public static function saveBasicInfoPartAFromBasicInfoStep1($client_id, $input, $model, $save_request_by_attorney, $attorney_id)
    {

        $dateTime = date('Y-m-d H:i:s');

        $inputData = Helper::validate_key_value('part1', $input);
        $anyOtherName = Helper::validate_key_value('any_other_name', $inputData);
        $stateCode = Helper::validate_key_value('state', $inputData);
        $stateName = AddressHelper::getStateNameByCode($stateCode);
        $stateName = preg_replace('/\s*\(.*\)$/', '', $stateName);
        $districtQuery = \App\Models\Districts::where('short_name', $stateName);
        $district = $districtQuery->count() === 1 ? $districtQuery->first() : null;
        $districtId = (is_object($district) && isset($district->id)) ? $district->id : 0;

        if ($districtId > 0) {
            $attData = \App\Models\AttorneyEditorData::where(['client_id' => $client_id])->first();
            $attData = isset($attData['data']) && !empty($attData['data']) ? json_decode($attData['data'], 1) : [];
            $attData['district_id'] = $districtId;
            $attData['editor_chepter'] = 'chapter7';
            $attData['district_name'] = $stateName;
            $attData['district_full_name'] = 'District Of '.$stateName;
            $attData['district_attorney'] = 'District Of '.$stateName;
            \App\Models\AttorneyEditorData::updateOrCreate(['client_id' => $client_id], ['data' => json_encode($attData)]);
        }
        $dataToSave = [
            'client_id' => $client_id,
            'any_other_name' => Helper::validate_key_value('past_eight', $anyOtherName, 'radio'),
            'suffix' => Helper::validate_key_value('suffix', $inputData, 'radio'),
            'name' => Helper::getUcWordsString(Helper::validate_key_value('name', $inputData)),
            'middle_name' => Helper::getUcWordsString(Helper::validate_key_value('middle_name', $inputData)),
            'last_name' => Helper::getUcWordsString(Helper::validate_key_value('last_name', $inputData)),
            'has_security_number' => Helper::validate_key_value('has_security_number', $inputData, 'radio'),
            'security_number' => Helper::validate_key_value('security_number', $inputData),
            'state' => Helper::validate_key_value('state', $inputData),
            'itin' => Helper::validate_key_value('itin', $inputData),
            'date_of_birth' => !empty(Helper::validate_key_value('date_of_birth', $anyOtherName)) ? date('Y-m-d', strtotime(Helper::validate_key_value('date_of_birth', $anyOtherName))) : date('Y-m-d'),
            'Address' => Helper::validate_key_value('Address', $inputData),
            'City' => Helper::getUcWordsString(Helper::validate_key_value('City', $inputData)),
            'zip' => Helper::validate_key_value('zip', $inputData),
            'country' => Helper::validate_key_value('country', $inputData),
            'lived_address_from_180' => Helper::validate_key_value('lived_address_from_180', $inputData, 'radio'),
            'marital_status' => !empty(Helper::validate_key_value('marital_status', $inputData)) ? Helper::validate_key_value('marital_status', $inputData) : 0,
            'status' => 1,
            'updated_on' => $dateTime,
        ];

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

    public static function saveFinancialAffairFromBasicInfoStep1($client_id, $input, $model)
    {

        $dateTime = date('Y-m-d H:i:s');

        $list_every_address = Helper::validate_key_value('list_every_address', $input, 'radio');
        $prevAddress = [];
        if ($list_every_address == 0) {
            $prevAddress = Helper::validate_key_value('prev_address', $input);
            foreach ($prevAddress as $key => &$data) {
                if (is_array($data)) {
                    foreach ($data as &$value) {
                        if (in_array($key, ['creditor_street', 'creditor_city', 'debtor'])) {
                            $value = ucwords(strtolower($value));
                        } else {
                            $value = $value;
                        }
                    }
                }
            }
        }

        $living_domestic_partner = Helper::validate_key_value('living_domestic_partner', $input, 'radio');

        $dataToSave = [
            'client_id' => $client_id,
            'list_every_address' => $list_every_address,
            'prev_address' => json_encode($prevAddress),
            'living_domestic_partner' => $living_domestic_partner,
            'updated_on' => $dateTime,
        ];

        if ($living_domestic_partner == 1) {
            $dataToSave['community_property_state'] = json_encode(Helper::validate_key_value('community_property_state', $input, 'array'));
            $dataToSave['domestic_partner_living'] = json_encode(Helper::validate_key_value('domestic_partner_living', $input, 'array'));
            $dataToSave['domestic_partner'] = json_encode(Helper::validate_key_value('domestic_partner', $input, 'array'));
            $dataToSave['domestic_partner_street_address'] = json_encode(Helper::validate_key_value('domestic_partner_street_address', $input, 'array'));
            $dataToSave['domestic_partner_city'] = json_encode(Helper::validate_key_value('domestic_partner_city', $input, 'array'));
            $dataToSave['domestic_partner_state'] = json_encode(Helper::validate_key_value('domestic_partner_state', $input, 'array'));
            $dataToSave['domestic_partner_zip'] = json_encode(Helper::validate_key_value('domestic_partner_zip', $input, 'array'));
        }

        $condtion = [ 'client_id' => $client_id ];
        if (!$model::where($condtion)->exists()) {
            $dataToSave['created_on'] = $dateTime;
        }

        $model::updateOrCreate($condtion, $dataToSave);

        return true;

    }

    public static function saveAnyOtherNameDataFromBasicInfoStep1($client_id, $input, $model)
    {

        $inputData = Helper::validate_key_value('part1', $input);
        $anyOtherName = Helper::validate_key_value('any_other_name', $inputData);

        $dataToSave = [
                'client_id' => $client_id,
        ];

        if (Helper::validate_key_value('past_eight', $anyOtherName, 'radio') == 1) {
            $dataToSave['suffix'] = json_encode(Helper::validate_key_value('suffix', $anyOtherName)) ;
            $dataToSave['name'] = json_encode(Helper::validate_key_value('name', $anyOtherName)) ;
            $dataToSave['middle_name'] = json_encode(Helper::validate_key_value('middle_name', $anyOtherName)) ;
            $dataToSave['last_name'] = json_encode(Helper::validate_key_value('last_name', $anyOtherName)) ;
        }

        $dataToSave['home'] = Helper::validate_key_value('home', $anyOtherName) ;
        $dataToSave['work'] = Helper::validate_key_value('work', $anyOtherName) ;
        $dataToSave['cell'] = Helper::validate_key_value('cell', $anyOtherName) ;
        $dataToSave['email'] = Helper::validate_key_value('email', $anyOtherName) ;
        $dataToSave['date_of_birth'] = Helper::validate_key_value('date_of_birth', $anyOtherName) ;

        $condtion = [ 'client_id' => $client_id ];

        $model::updateOrCreate($condtion, $dataToSave);

        return true;

    }

}
