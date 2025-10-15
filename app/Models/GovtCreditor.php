<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use GuzzleHttp\Client;
use Carbon\Carbon;

class GovtCreditor extends Model
{
    protected $table = 'tbl_govt_creditors';

    public $timestamps = false;

    protected $fillable = [
        'api_object_id',        // Unique ID from external API
        'creditor_name',        // column name in api 'NAME'
        'creditor_address',     // column name in api 'ADDRESS'
        'creditor_city',        // column name in api 'CITY'
        'creditor_state',       // column name in api 'STNAME'
        'creditor_zip',         // column name in api 'ZIP'
        'is_imported_to_mortgage',
        'import_to_mortgage_date',
        'is_imported_to_common_creditors',
        'import_to_common_creditors_date',
        'created_at',
        'updated_at'
    ];

    public static function sync_with_api()
    {
        $searchFields = 'fields=NAME%2CADDRESS%2CCITY%2CSTALP%2CZIP&';
        $apiUrl = 'https://banks.data.fdic.gov/api/institutions?'.$searchFields.'sort_by=NAME&sort_order=ASC&format=json&download=false&limit=1';
        $totalRecords = self::getApiData($apiUrl, true);

        if ($totalRecords > 0) {
            $recordLimit = '10000';
            $totalRequestsNeeded = ceil($totalRecords / $recordLimit);

            $latestUpdatedAt = GovtCreditor::max('updated_at');
            $dateFilter = '';

            if (!empty($latestUpdatedAt)) {
                // date Format YYYY-MM-DD Like 2024-10-28
                $fromDate = Carbon::parse($latestUpdatedAt)->format('Y-m-d'); // Format latestUpdatedAt as YYYY-MM-DD
                $toDate = Carbon::now()->format('Y-m-d');
                $dateFilter = 'filters=DATEUPDT%3A%5B%22'.$fromDate.'%22%20TO%20%22'.$toDate.'%22%5D&';
            }

            for ($i = 0; $i < $totalRequestsNeeded; $i++) {
                $offset = $i * $recordLimit;
                $recordOffset = "offset=$offset&";

                $apiUrl = 'https://banks.data.fdic.gov/api/institutions?'
                            . $dateFilter
                            . $searchFields
                            . 'sort_by=NAME&sort_order=ASC&format=json&download=false&'
                            . 'limit='.$recordLimit.'&'
                            . $recordOffset;

                $records = self::getApiData($apiUrl, false);
                self::updateGovtCreditorRecords($records);
            }

            return true;
        }

    }

    public static function getApiData($apiUrl, $getTotalCount = false)
    {
        $client = new Client();

        $response = $client->request('GET', $apiUrl, [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                        ],
                        'http_errors' => true, // Throws exceptions for HTTP error responses
                    ]);

        $body = json_decode($response->getBody(), true);
        $creditorsData = [];
        if (!empty($body)) {
            $creditorsData = Helper::validate_key_value('data', $body);
        }
        if ($getTotalCount) {
            $totals = Helper::validate_key_value('totals', $body);

            return Helper::validate_key_value('count', $totals);
        }

        return $creditorsData;
    }

    public static function updateGovtCreditorRecords($records)
    {
        if (empty($records)) {
            return false;
        }

        $dateCurrent = date('Y-m-d H:i:s');

        foreach ($records as $record) {
            $data = Helper::validate_key_value('data', $record);
            if (!empty($data)) {

                $mortgageConditions = [
                    'mortgage_name' => Helper::validate_key_value('NAME', $data),
                    'mortgage_address' => Helper::validate_key_value('ADDRESS', $data),
                    'mortgage_city' => Helper::validate_key_value('CITY', $data),
                    'mortgage_state' => Helper::validate_key_value('STALP', $data),
                    'mortgage_zip' => Helper::validate_key_value('ZIP', $data),
                ];
                $mortgageDataToSave = [
                                'mortgage_name' => Helper::validate_key_value('NAME', $data),
                                'mortgage_address' => Helper::validate_key_value('ADDRESS', $data),
                                'mortgage_city' => Helper::validate_key_value('CITY', $data),
                                'mortgage_state' => Helper::validate_key_value('STALP', $data),
                                'mortgage_zip' => Helper::validate_key_value('ZIP', $data),
                                'is_ocr_available' => 0,
                                'added_by_id' => 1,
                                'active_status' => 1,
                                'updated_at' => $dateCurrent
                            ];

                $existingMortgageRecord = Mortgages::where($mortgageConditions)->exists();
                if (!$existingMortgageRecord) {
                    $mortgageDataToSave['created_at'] = $dateCurrent;
                }

                Mortgages::updateOrCreate($mortgageConditions, $mortgageDataToSave);

                $conditions = [ 'api_object_id' => Helper::validate_key_value('ID', $data) ];
                $dataToSave = [
                                'api_object_id' => Helper::validate_key_value('ID', $data),
                                'creditor_name' => Helper::validate_key_value('NAME', $data),
                                'creditor_address' => Helper::validate_key_value('ADDRESS', $data),
                                'creditor_city' => Helper::validate_key_value('CITY', $data),
                                'creditor_state' => Helper::validate_key_value('STALP', $data),
                                'creditor_zip' => Helper::validate_key_value('ZIP', $data),
                                'is_imported_to_mortgage' => 1,
                                'import_to_mortgage_date' => $dateCurrent,
                                'updated_at' => $dateCurrent,
                              ];
                $existingRecord = GovtCreditor::where($conditions)->exists();
                if (!$existingRecord) {
                    $dataToSave['created_at'] = $dateCurrent;
                }

                GovtCreditor::updateOrCreate($conditions, $dataToSave);
            }
        }

        return true;
    }
}
