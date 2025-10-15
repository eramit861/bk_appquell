<?php

namespace App\Models\EditQuestionnaire;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClientBasicInfoPartB;
use App\Models\FinancialAffairs;
use App\Models\User;
use App\Helpers\Helper;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheSOFA;

class QuestionnaireBasicInfoPartB extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_basic_info_part_b';
    public $timestamps = false;

    public static function saveStep2($client_id, $request, $save_request_by_attorney = false, $attorney_id = '')
    {

        // determine which model to use
        $modelBasicInfoPartB = $save_request_by_attorney ? (QuestionnaireBasicInfoPartB::class) : (ClientBasicInfoPartB::class);
        $modelFinancialAffair = $save_request_by_attorney ? (QuestionnaireFinancialAffairs::class) : (FinancialAffairs::class);

        // get all input data
        $input = $request->all();

        // save basic info part B
        self::saveBasicInfoPartBFromBasicInfoStep2($client_id, $input, $modelBasicInfoPartB, $save_request_by_attorney, $attorney_id);

        // save financial affair
        self::saveFinancialAffairFromBasicInfoStep2($client_id, $input, $modelFinancialAffair, $save_request_by_attorney);

        // clear cache for client basic information
        CacheBasicInfo::forgetBasicInformationCache($client_id);

        // clear cache for client SOFA
        CacheSOFA::forgetSOFACache($client_id);

        return true;
    }

    public static function saveBasicInfoPartBFromBasicInfoStep2($client_id, $input, $model, $save_request_by_attorney, $attorney_id)
    {

        $dateTime = date('Y-m-d H:i:s');

        $inputData = Helper::validate_key_value('part2', $input);

        $dataToSave = [
            'client_id' => $client_id,
            'name' => Helper::getUcWordsString(Helper::validate_key_value('name', $inputData)),
            'suffix' => Helper::validate_key_value('suffix', $inputData, 'radio'),
            'middle_name' => Helper::getUcWordsString(Helper::validate_key_value('middle_name', $inputData)),
            'last_name' => Helper::getUcWordsString(Helper::validate_key_value('last_name', $inputData)),
            'has_security_number' => Helper::validate_key_value('has_security_number', $inputData, 'radio'),
            'spouse_has_ein' => empty(Helper::validate_key_value('spouse_has_ein', $inputData)) ? 1 : 0,
            'social_security_number' => Helper::validate_key_value('social_security_number', $inputData),
            'state' => Helper::validate_key_value('state', $inputData),
            'itin' => Helper::validate_key_value('itin', $inputData),
            'date_of_birth' => !empty(Helper::validate_key_value('date_of_birth', $inputData)) ? date('Y-m-d', strtotime(Helper::validate_key_value('date_of_birth', $inputData))) : date('Y-m-d'),
            'Address' => Helper::getUcWordsString(Helper::validate_key_value('Address', $inputData)),
            'City' => Helper::getUcWordsString(Helper::validate_key_value('City', $inputData)),
            'zip' => Helper::validate_key_value('zip', $inputData),
            'country' => Helper::validate_key_value('country', $inputData),
            'lived_address_from_180' => Helper::validate_key_value('lived_address_from_180', $inputData, 'radio'),
            'lived_address_from_730' => Helper::validate_key_value('lived_address_from_730', $inputData, 'radio'),
            'spouse_different_address' => Helper::validate_key_value('spouse_different_address', $inputData, 'radio'),
            'spouse_different_address_info' => Helper::getUcWordsString(Helper::validate_key_value('spouse_different_address_info', $inputData)),
            'part2_driving_license' => Helper::validate_key_value('part2_driving_license', $inputData),
            'part2_dob' => Helper::validate_key_value('part2_dob', $inputData),
            'part2_phone' => Helper::validate_key_value('part2_phone', $inputData),
            'spouse_any_other_name' => Helper::validate_key_value('spouse_any_other_name', $inputData, 'radio'),
            'spouse_other_name' => Helper::getEncodedUcWordsString(Helper::validate_key_value('spouse_other_name', $inputData)),
            'spouse_other_suffix' => Helper::getEncodedUcWordsString(Helper::validate_key_value('spouse_other_suffix', $inputData)),
            'spouse_other_middle_name' => Helper::getEncodedUcWordsString(Helper::validate_key_value('spouse_other_middle_name', $inputData)),
            'spouse_other_last_name' => Helper::getEncodedUcWordsString(Helper::validate_key_value('spouse_other_last_name', $inputData)),
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

    public static function saveFinancialAffairFromBasicInfoStep2($client_id, $input, $model, $save_request_by_attorney)
    {

        $dateTime = date('Y-m-d H:i:s');

        $inputData = Helper::validate_key_value('part2', $input);

        $fullName = Helper::getUcWordsString(Helper::validate_key_value('name', $inputData));
        $fullName .= !empty(Helper::validate_key_value('middle_name', $inputData)) ? ' '.Helper::getUcWordsString(Helper::validate_key_value('middle_name', $inputData)) : '';
        $fullName .= !empty(Helper::validate_key_value('last_name', $inputData)) ? ' '.Helper::getUcWordsString(Helper::validate_key_value('last_name', $inputData)) : '';

        if (empty($fullName)) {
            return true;
        }

        $condtion = [ 'client_id' => $client_id ];

        $dataToSave = [];

        if (User::where('id', $client_id)->first()->client_type == 2) {
            $fullName = '';
        }

        if ($model::where($condtion)->exists()) {
            $dataToSave = self::getDataToSaveForFinancialAffairsForExistingData($model::where($condtion), $inputData, $fullName, $client_id, $save_request_by_attorney);
            $dataToSave['client_id'] = $client_id;
            $dataToSave['updated_on'] = $dateTime;
        } else {
            $dataToSave = self::getDataToSaveForFinancialAffairsForNotExistingData($inputData, $fullName, $client_id, $save_request_by_attorney);
            $dataToSave['client_id'] = $client_id;
            $dataToSave['updated_on'] = $dateTime;
            $dataToSave['created_on'] = $dateTime;
        }

        $model::updateOrCreate($condtion, $dataToSave);

        return true;


    }

    public static function getDataToSaveForFinancialAffairsForExistingData($data, $inputData, $fullName, $client_id, $save_request_by_attorney)
    {


        $domestic_partner_state = [];
        $domestic_partner_street_address = [];
        $domestic_partner_city = [];
        $domestic_partner_zip = [];
        $domestic_partner = [];

        $finacialFields = [
                'living_domestic_partner',
                'community_property_state', 		// main state
                'domestic_partner_living', 			// address radio
                'domestic_partner', 				// name
                'domestic_partner_street_address', 	// address
                'domestic_partner_city', 			// city
                'domestic_partner_state', 			// state
                'domestic_partner_zip', 			// zip
            ];
        $data = $data->select($finacialFields)->first();
        $data = Helper::getFinacialAffairsUpdateArray($data);

        $commonData = self::getDomesticCommonData($inputData, $client_id, $save_request_by_attorney);

        $community_property_state = is_array($data['community_property_state']) ? $data['community_property_state'] : [] ;
        $domestic_partner_living = is_array($data['domestic_partner_living']) ? $data['domestic_partner_living'] : [] ;
        $domestic_partner = is_array($data['domestic_partner']) ? $data['domestic_partner'] : [] ;
        $domestic_partner_street_address = is_array($data['domestic_partner_street_address']) ? $data['domestic_partner_street_address'] : [] ;
        $domestic_partner_city = is_array($data['domestic_partner_city']) ? $data['domestic_partner_city'] : [] ;
        $domestic_partner_state = is_array($data['domestic_partner_state']) ? $data['domestic_partner_state'] : [] ;
        $domestic_partner_zip = is_array($data['domestic_partner_zip']) ? $data['domestic_partner_zip'] : [] ;

        // Check if $fullName exists in the 'domestic_partner' array
        $existingIndex = array_search($fullName, $domestic_partner);
        if ($existingIndex !== false) {
            // Update values at the existing index
            $community_property_state[$existingIndex] = Helper::validate_key_value('finalStateMain', $commonData);
            $domestic_partner_living[$existingIndex] = 1; // Update living status
            $domestic_partner_street_address[$existingIndex] = Helper::validate_key_value('finalAddress', $commonData); // Update address
            $domestic_partner_city[$existingIndex] = Helper::validate_key_value('finalCity', $commonData); // Update city
            $domestic_partner_state[$existingIndex] = Helper::validate_key_value('finalState', $commonData); // Update state
            $domestic_partner_zip[$existingIndex] = Helper::validate_key_value('finalZip', $commonData); // Update zip code
        } else {
            // Add new values if $fullName does not exist
            $community_property_state[] = Helper::validate_key_value('finalStateMain', $commonData);
            $domestic_partner_living[] = 1; // Add new living status
            $domestic_partner[] = $fullName; // Add new full name
            $domestic_partner_street_address[] = Helper::validate_key_value('finalAddress', $commonData); // Add new address
            $domestic_partner_city[] = Helper::validate_key_value('finalCity', $commonData); // Add new city
            $domestic_partner_state[] = Helper::validate_key_value('finalState', $commonData); // Add new state
            $domestic_partner_zip[] = Helper::validate_key_value('finalZip', $commonData); // Add new zip code
        }
        $dataToSave = [
            'living_domestic_partner' => 1,
            'community_property_state' => json_encode($community_property_state),
            'domestic_partner_living' => json_encode($domestic_partner_living),
            'domestic_partner_state' => json_encode($domestic_partner_state),
            'domestic_partner_street_address' => json_encode($domestic_partner_street_address),
            'domestic_partner_city' => json_encode($domestic_partner_city),
            'domestic_partner_zip' => json_encode($domestic_partner_zip),
            'domestic_partner' => json_encode($domestic_partner),
        ];

        return $dataToSave;
    }

    public static function getDataToSaveForFinancialAffairsForNotExistingData($inputData, $fullName, $client_id, $save_request_by_attorney)
    {

        $commonData = self::getDomesticCommonData($inputData, $client_id, $save_request_by_attorney);

        $dataToSave = [
            'living_domestic_partner' => 1,
            'community_property_state' => json_encode([Helper::validate_key_value('finalStateMain', $commonData)]),
            'domestic_partner_living' => json_encode([1]),
            'domestic_partner_state' => json_encode([Helper::validate_key_value('finalState', $commonData)]),
            'domestic_partner_street_address' => json_encode([Helper::validate_key_value('finalAddress', $commonData)]),
            'domestic_partner_city' => json_encode([Helper::validate_key_value('finalCity', $commonData)]),
            'domestic_partner_zip' => json_encode([Helper::validate_key_value('finalZip', $commonData)]),
            'domestic_partner' => json_encode([$fullName]),
        ];

        return $dataToSave;

    }

    public static function getDomesticCommonData($inputData, $client_id, $save_request_by_attorney)
    {

        $finalAddress = '';
        $finalCity = '';
        $finalState = '';
        $finalZip = '';

        $validStates = ["AZ", "CA", "ID", "LA", "NV", "NM", "PR", "TX", "WA", "WI"];

        if (Helper::validate_key_value('spouse_different_address', $inputData, 'radio') == 1) {
            $finalStateMain = in_array(Helper::validate_key_value('state', $inputData), $validStates) ? Helper::validate_key_value('state', $inputData) : '';
            $finalAddress = Helper::getUcWordsString(Helper::validate_key_value('Address', $inputData));
            $finalCity = Helper::getUcWordsString(Helper::validate_key_value('City', $inputData));
            $finalState = Helper::validate_key_value('state', $inputData);
            $finalZip = Helper::validate_key_value('zip', $inputData);
        }

        $partAInfo = User::where('id', $client_id)->first()->getBasicInfo(true);

        if (Helper::validate_key_value('spouse_different_address', $inputData, 'radio') == 0 && (isset($partAInfo) || !empty($partAInfo))) {
            $finalStateMain = in_array($partAInfo->state, $validStates) ? $partAInfo->state : '';
            $finalAddress = $partAInfo->Address;
            $finalCity = $partAInfo->City;
            $finalState = $partAInfo->state;
            $finalZip = $partAInfo->zip;
        }

        return  [
            'finalStateMain' => $finalStateMain,
            'finalState' => $finalState,
            'finalAddress' => $finalAddress,
            'finalCity' => $finalCity,
            'finalZip' => $finalZip,
        ];

    }


}
