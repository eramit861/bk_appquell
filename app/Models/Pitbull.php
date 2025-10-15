<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use App\Services\Client\CacheBasicInfo;
use GuzzleHttp\Client;

class Pitbull extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_pitbull_taxes';
    public $timestamps = false;
    public const API_URL = "https://www.pitbulltax.com/api/";
    public const API_VERSION = "0.0.5";

    public static function create_update_client($client_id)
    {
        $user = \App\Models\User::where('id', '=', $client_id)->first();

        $pitbull_client_id = $user->pitbull_client_id;

        // create pitbull client
        if (isset($pitbull_client_id) && empty($pitbull_client_id)) {
            self::createPitbullClient($user, $client_id);
        }
        // update pitbull client
        if (isset($pitbull_client_id) && !empty($pitbull_client_id)) {
            self::updatePitbullClient($user, $client_id, $pitbull_client_id);
        }

    }

    private static function createPitbullClient($user, $client_id)
    {
        $apiURI = Pitbull::API_URL . 'create?token=' . env('PITBULL_API_TOKEN') . '&api_version=' . Pitbull::API_VERSION;
        $body = self::getBodyJson($user);

        // create pitbull client
        $client = new Client();
        try {
            $response = $client->request('POST', $apiURI, [
                            'body' => $body,
                            'headers' => [ 'Content-Type' => 'application/json' ],
                        ]);
            $res = json_decode($response->getBody(), true);
            if (isset($res['new_client_id']) && !empty($res['new_client_id'])) {
                \App\Models\User::where('id', '=', $client_id)->update(['pitbull_client_id' => $res['new_client_id']]);
            }
        } catch (\Exception $e) {
        }
    }

    private static function updatePitbullClient($user, $client_id, $pitbull_client_id)
    {

        $apiURI = Pitbull::API_URL . 'update?token=' . env('PITBULL_API_TOKEN') . '&api_version=' . Pitbull::API_VERSION . '&update_by=client_id&client_id=' . $pitbull_client_id ;
        $body = self::getBodyJson($user);

        // update pitbull client
        $client = new Client();
        try {
            $response = $client->request('POST', $apiURI, [
                            'body' => $body,
                            'headers' => [ 'Content-Type' => 'application/json' ],
                        ]);
            $res = json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            $errorResponse = $e->getResponse();
            if ($errorResponse) {
                $errorBlock = json_decode($errorResponse->getBody()->getContents(), true);
                if (!empty($errorBlock)) {
                    if (isset($errorBlock['error']) && $errorBlock['error'] === 'client_not_found') {
                        self::createPitbullClient($user, $client_id);
                    }
                }
            } else {
                $errorText = $e->getMessage();
            }
        }
    }

    private static function getCountyByState($stateCode, $countyId)
    {
        $apiURI = Pitbull::API_URL . 'get-counties-by-state?token=' . env('PITBULL_API_TOKEN') . '&api_version=' . Pitbull::API_VERSION . '&state=' . $stateCode;

        $client = new Client();
        $responseCountyList = [];

        try {
            $response = $client->request('GET', $apiURI, [
                'headers' => ['Content-Type' => 'application/json'],
            ]);
            $res = json_decode($response->getBody(), true);
            $responseCountyList = $res;

        } catch (\Exception $e) {
        }

        $countyName = \App\Models\CountyFipsData::get_county_name_by_id($countyId);
        $countyValue = '';

        foreach ($responseCountyList as $county) {
            if ($county['label'] === $countyName) {
                $countyValue = $county['value'];
                break;
            }
        }

        return $countyValue;
    }

    private static function getDataArray($data)
    {
        try {
            $data = (isset($data) && !empty($data)) ? $data->toArray() : [];
        } catch (\Throwable $th) {
        }

        return $data ?? [];
    }

    private static function getBodyJson($user)
    {
        $BIData = CacheBasicInfo::getBasicInformationData($user->id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
        $clientAnyOtherNameData = Helper::validate_key_value('BasicInfo_AnyOtherName', $BIData, 'array');

        $d1Data = self::getDataArray($clientBasicInfoPartA);
        $d1OtherNameData = self::getDataArray($clientAnyOtherNameData);
        $d2Data = self::getDataArray($clientBasicInfoPartB);

        $bussinessObj = [];

        $d1county = self::getCountyByState(Helper::validate_key_value('state', $d1Data), Helper::validate_key_value('country', $d1Data));
        $d2county = self::getCountyByState(Helper::validate_key_value('state', $d2Data), Helper::validate_key_value('country', $d2Data));

        $responseBody = [
                            'client_data' => [
                                'first_name' => Helper::validate_key_value('name', $d1Data) ,
                                'middle_name' => Helper::validate_key_value('middle_name', $d1Data) ,
                                'last_name' => Helper::validate_key_value('last_name', $d1Data) ,
                                'date_of_birth' => Helper::validate_key_value('date_of_birth', $d1OtherNameData) ,
                                'state' => strtoupper(Helper::validate_key_value('state', $d1Data)),
                                'county' => $d1county,
                                'city' => Helper::validate_key_value('City', $d1Data) ,
                                'street' => Helper::validate_key_value('Address', $d1Data) ,
                                'zip' => Helper::validate_key_value('zip', $d1Data) ,
                                'is_in_foreign_country' => 0,
                                'foreign_country' => '',
                                'foreign_province' => '',
                                'foreign_city' => '',
                                'foreign_street' => '',
                                'postal_code' => '',
                                'email' => Helper::validate_key_value('email', $d1OtherNameData),
                                'additional_email' => '',
                                'home_phone' => Helper::validate_key_value('home', $d1OtherNameData),
                                'work_phone' => '',
                                'cell_phone' => Helper::validate_key_value('cell', $d1OtherNameData),
                                'spouse_first_name' => Helper::validate_key_value('name', $d2Data),
                                'spouse_middle_name' => Helper::validate_key_value('middle_name', $d2Data),
                                'spouse_last_name' => Helper::validate_key_value('last_name', $d2Data),
                                'spouse_date_of_birth' => Helper::validate_key_value('part2_dob', $d2Data),
                                'same_address' => (Helper::validate_key_value('spouse_different_address', $d2Data) == 1) ? 0 : 1,
                                'spouse_state' => strtoupper(Helper::validate_key_value('state', $d2Data)),
                                'spouse_county' => $d2county,
                                'spouse_city' => Helper::validate_key_value('City', $d2Data),
                                'spouse_street' => Helper::validate_key_value('Address', $d2Data),
                                'spouse_zip' => Helper::validate_key_value('zip', $d2Data),
                                'spouse_is_in_foreign_country' => 0,
                                'spouse_foreign_country' => '',
                                'spouse_foreign_province' => '',
                                'spouse_foreign_city' => '',
                                'spouse_foreign_street' => '',
                                'spouse_postal_code' => '',
                                'spouse_email' => Helper::validate_key_value('email', $d2Data),
                                'spouse_additional_email' => '',
                                'spouse_home_phone' => '',
                                'spouse_work_phone' => '',
                                'spouse_cell_phone' => Helper::validate_key_value('part2_phone', $d2Data),
                                'is_business' => 0,
                                'has_income_tax' => 0,
                                'has_employment_taxes' => 0,
                                'has_civil_penalty' => 0,
                                'income_tax' => [ [ 'year' => ''  , 'amount' => '', 'estimated_csed' => '' ] ],
                                'employment_taxes' => [ [ 'period' => '', 'amount' => '', 'estimated_csed' => '' ] ],
                                'civil_penalty' => [ [ 'period' => '', 'amount' => '', 'estimated_csed' => '' ] ],
                                'businesses' => $bussinessObj,
                                'payment_info' => [ ],
                                'billing_info' => [ ],
                                'notes' => '',
                                'profile_id' => '',
                                'priority' => 1,
                                'status' => 1,
                                'case_manager' => 21787,
                                'sales_rep' => '',
                                'client_source_text' => 'BK Questionnaire',
                                'client_source_other' => '',
                                'linked_clients (synonim: linked_clients_by_client_id)' => [ ],
                                'linked_clients_by_profile_id' => [ ],
                                'filling_status' => 1,
                                'spouse_filling_status' => ($user->client_type == 3) ? 1 : 0,
                                'entered_by' => 'Michael Croak'
                            ]
                        ];

        return json_encode($responseBody);
    }

}
