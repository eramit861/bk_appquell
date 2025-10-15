<?php

namespace App\Helpers;

use App\Models\AttorneySettings;
use App\Models\AttorneySubscription;
use App\Models\DebtStateTaxes;
use App\Models\DomesticAddress;
use App\Models\State;
use App\Services\Client\CacheBasicInfo;
use Illuminate\Support\Facades\Hash;

class AddressHelper
{
    public static function getStateTaxAddress($code = null)
    {
        $cacheKey = 'state_tax_address_' . ($code ?? 'all');

        return cache()->remember($cacheKey, 3600, function () use ($code) {
            $array = DebtStateTaxes::groupBy("stax_name")
                ->select([
                    'stax_name as address_heading',
                    'stax_address1 as add1',
                    'stax_address2 as add2',
                    'stax_address3 as add3',
                    'stax_city as city',
                    'stax_state as code',
                    'stax_zip as zip',
                    'stax_contact'
                ])
                ->orderBy('stax_name', "asc")
                ->where("stax_name", "!=", null)
                ->get()
                ->toArray();

            if ($code == null) {
                return $array;
            }
            foreach ($array as $item) {
                if ($code == $item['code']) {
                    return $item;
                }
            }

            return [];
        });
    }
    public static function getStateTaxAddressUsingArray($array, $code = null)
    {
        if ($code == null) {
            return $array;
        }
        foreach ($array as $item) {
            if ($code == $item['code']) {
                return $item;
            }
        }

        return [];
    }


    public static function getSelectedStatesList($code = '')
    {
        $codesArray = ['AZ', 'CA', 'ID', 'LA', 'NV', 'NM', 'TX', 'WA', 'WI', 'PR'];
        $cacheKey = 'selected_states_list_' . md5(json_encode($codesArray));
        $stateArray = cache()->remember($cacheKey, 3600, function () use ($codesArray) {
            return State::orderBy('state_name', "asc")
                ->where("state_code", "!=", null)
                ->whereIn('state_code', $codesArray)
                ->get();
        });
        $statelist = '';
        foreach ($stateArray as $state) {
            $select = !empty($code) && $code == $state->state_code ? 'selected' : '';
            $statelist .= "<option value='" . $state->state_code . "' " . $select . ">" . $state->state_name . "</option>";
        }

        return $statelist;
    }

    public static function getStateListArray()
    {
        // Use Laravel cache for 1 hour
        return cache()->remember('state_list_array', 3600, function () {
            return State::select('state_code', 'state_name')
                ->orderBy('state_name', "asc")
                ->where("state_code", "!=", null)
                ->where('state_name', '!=', 'Jakarta')
                ->get();
        });
    }

    public static function getStatesList($code = '')
    {
        $stateArray = self::getStateListArray();
        $statelist = '';
        foreach ($stateArray as $state) {
            $select = !empty($code) && $code == $state->state_code ? 'selected' : '';
            $statelist .= "<option value='" . $state->state_code . "' " . $select . ">" . $state->state_name . "</option>";
        }

        return $statelist;
    }

    public static function getStatesListUsingArray($stateArray, $code = '')
    {
        $statelist = '';
        foreach ($stateArray as $state) {
            $select = !empty($code) && $code == $state->state_code ? 'selected' : '';
            $statelist .= "<option value='" . $state->state_code . "' " . $select . ">" . $state->state_name . "</option>";
        }

        return $statelist;
    }

    public static function getStateArray()
    {
        // Cache the state array for 1 hour
        return cache()->remember('state_array', 3600, function () {
            return State::select(['state_code', 'state_name', 'state_code'])
                ->orderBy('state_name', "asc")
                ->where("state_code", "!=", null)
                ->where('state_name', '!=', 'Jakarta')
                ->get();
        });
    }

    public static function getStateNameByCode($code = '')
    {
        if (empty($code)) {
            return '';
        }

        return cache()->remember("state_name_by_code_{$code}", 3600, function () use ($code) {
            $state = State::whereNotNull('state_name')
                ->where('state_code', $code)
                ->select('state_name')
                ->first();

            return isset($state) && !empty($state) ? $state->state_name : '';
        });
    }

    public static function getStateCodeForJubliee($code = '')
    {
        $list = ["AL" => 1, "AK" => 2, "AZ" => 3, "AR" => 4, "CA" => 5, "CO" => 6, "CT" => 7, "DE" => 9, "DC" => 8, "FL" => 10, "GA" => 11, "HI" => 12, "ID" => 13, "IL" => 14, "IN" => 15, "IA" => 16, "KS" => 17, "KY" => 18, "LA" => 19, "ME" => 20, "MD" => 33, "MA" => 34, "MI" => 35, "MN" => 36, "MS" => 37, "MO" => 38, "MT" => 21, "NE" => 22, "NV" => 23, "NH" => 24, "NJ" => 25, "NM" => 26, "NY" => 27, "NC" => 28, "ND" => 29, "OH" => 30, "OK" => 31, "OR" => 32, "PA" => 39, "PR" => 52, "RI" => 40, "SC" => 41, "SD" => 42, "TN" => 43, "TX" => 44, "UT" => 45, "VT" => 46, "VA" => 47, "WA" => 48, "WV" => 49, "WI" => 50, "WY" => 51];
        if (isset($list[$code])) {
            $stateCode = $list[$code];
        } else {
            $stateCode = "";
        }

        return $stateCode;
    }

    public static function getStateCodeByStateNameForJubliee($name = '')
    {
        $list = [ "Alabama" => 'AL', "Alaska" => 'AK', "Arizona" => 'AZ', "Arkansas" => 'AR', "California" => 'CA', "Colorado" => 'CO', "Connecticut" => 'CT', "Delaware" => 'DE', "District Of Columbia" => 'DC', "Florida" => 'FL', "Georgia" => 'GA', "Hawaii" => 'HI', "Idaho" => 'ID', "Illinois" => 'IL', "Indiana" => 'IN', "Iowa" => 'IA', "Jakarta" => 'JKT', "Kansas" => 'KS', "Kentucky" => 'KY', "Louisiana" => 'LA', "Maine" => 'ME', "Maryland" => 'MD', "Massachusetts" => 'MA', "Michigan" => 'MI', "Minnesota" => 'MN', "Mississippi" => 'MS', "Missouri" => 'MO', "Montana" => 'MT', "Nebraska" => 'NE', "Nevada" => 'NV', "New Hampshire" => 'NH', "New Jersey" => 'NJ', "New Mexico" => 'NM', "New York" => 'NY', "North Carolina" => 'NC', "North Dakota" => 'ND', "Ohio" => 'OH', "Oklahoma" => 'OK', "Oregon" => 'OR', "Pennsylvania" => 'PA', "Puerto Rico" => 'PR', "Rhode Island" => 'RI', "South Carolina" => 'SC', "South Dakota" => 'SD', "Tennessee" => 'TN', "Texas" => 'TX', "Utah" => 'UT', "Vermont" => 'VT', "Virginia" => 'VA', "Washington" => 'WA', "West Virginia" => 'WV', "Wisconsin" => 'WI', "Wyoming" => 'WY' ];
        if (isset($list[$name])) {
            $stateCode = $list[$name];
        } else {
            $stateCode = "";
        }

        return $stateCode;
    }

    public static function getDomesticAddressStatesSelection($code = '')
    {
        // Cache the state list for 1 hour
        $stateArray = cache()->remember('domestic_address_states_selection', 3600, function () {
            return DomesticAddress::with('state')
                ->groupBy("address_state")
                ->orderBy('address_state', "asc")
                ->where("address_state", "!=", null)
                ->get();
        });

        $statelist = '';
        foreach ($stateArray as $state) {
            $select = !empty($code) && $code == $state->address_state ? 'selected' : '';
            $statelist .= "<option value='" . $state->address_state . "' " . $select . ">" . ($state->state->state_name ?? $state->address_state) . "</option>";
        }

        return $statelist;
    }

    public static function getDomesticAddressStatesList($code = '', $applyGroupBy = 1)
    {
        $fieldsToFetch = ['address_name', 'address_street', 'address_line2', 'address_city', 'address_state', 'address_zip', 'notify_address_name', 'notify_address_street', 'notify_address_line2', 'notify_address_city', 'notify_address_zip'];
        $cacheKey = 'domestic_address_states_list_' . md5(json_encode([$code, $applyGroupBy]));

        return cache()->remember($cacheKey, 3600, function () use ($fieldsToFetch, $code, $applyGroupBy) {
            if (!empty($code)) {
                if ($applyGroupBy) {
                    $stateArray = DomesticAddress::select($fieldsToFetch)
                        ->groupBy("address_state")->orderBy('address_state', "asc")->where("address_state", "!=", null)->where("address_state", "=", $code)->get()->toArray();

                    return current($stateArray);
                }
                if (!$applyGroupBy) {
                    $stateArray = DomesticAddress::select($fieldsToFetch)
                        ->orderBy('address_state', "asc")->where("address_state", "!=", null)->where("address_state", "=", $code)->get()->toArray();

                    return $stateArray;
                }
            } else {
                $stateArray = DomesticAddress::select($fieldsToFetch)
                    ->groupBy("address_state")->orderBy('address_state', "asc")->where("address_state", "!=", null)->get();
            }

            return $stateArray;
        });
    }
    public static function getSubscriptionSelection($code = '')
    {
        $subcarrayList = AttorneySubscription::inviteClientpackageNameArray();

        return self::createSelectionFromArray($subcarrayList, $code);
    }
    private static function createSelectionFromArray($arrayList, $code = '')
    {
        $list = '';
        foreach ($arrayList as $key => $value) {
            $selected = !empty($code) && $code == $key ? 'selected' : '';
            $list .= "<option value='" . $key . "' " . $selected . ">" . $value . "</option>";
        }

        return $list;
    }

    public static function getPackagePriceClientTypeWise()
    {
        return AttorneySubscription::packagePriceClientTypeWise();
    }
    public static function getBankStatementPackagePriceClientTypeWise()
    {
        return AttorneySubscription::packageBankStatementPriceClientTypeWise();
    }
    public static function getProfitLossPackagePriceClientTypeWise()
    {
        return AttorneySubscription::packageProfitLossPriceClientTypeWise();
    }

    public static function getAttorneySubscriptionArray($key = null)
    {
        $arr = AttorneySubscription::packageNameArray();

        return static::returnArrValue($arr, $key);
    }

    private static function returnArrValue($arr, $key)
    {
        if ($key === null) {
            return $arr;
        } elseif (array_key_exists($key, $arr)) {
            return $arr[$key];
        } else {
            return '';
        }
    }

    public static function formatCommonJsonData($jsonArray)
    {
        $final_array = [];
        if (!empty($jsonArray)) {
            foreach ($jsonArray as $k => $v) {
                if (is_array(json_decode($v, 1))) {
                    $final_array[$k] = json_decode($v, 1);
                } else {
                    $final_array[$k] = $v;
                }
            }
        }

        return $final_array;
    }

    public static function getWithUtilityAndMortgage($expenses)
    {
        $final_expenses = [];
        if (!empty($expenses)) {
            foreach ($expenses as $k => $v) {
                if (is_array(json_decode($v, 1))) {
                    if (!in_array($k, ['utilities', 'mortgage_property'])) {
                        $final_expenses[$k] = array_values(json_decode($v, 1));
                    } else {
                        $final_expenses[$k] = json_decode($v, 1);
                    }
                } else {
                    $final_expenses[$k] = $v;
                }
            }
        }

        return $final_expenses;
    }

    public static function getCommercialAsstesArray($key = null)
    {
        $arr = [
            'farm_animals' => 47,
            'crops' => 48,
            'fishing_equipment' => 49,
            'fishing_supplies' => 50,
            'fishing_property' => 51
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getSchAbPropertyType($key = null)
    {
        $arr = [
            'commissions' => 38,
            'office_equipment' => 39,
            'machinery_fixtures' => 40,
            'business_inventory' => 41,
            'interests' => 42,
            'customer_mailing' => 43,
            'other_business' => 44
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getHouseHoldTypes($key)
    {
        $arr = [
            'household_goods_furnishings' => 6,
            'electronics' => 7,
            'collectibles' => 8,
            'sports' => 9,
            'firearms' => 10,
            'clothing' => 11,
            'jewelry' => 12,
            'pets' => 13,
        ];
        $type = static::returnArrValue($arr, $key);

        return !empty($type) ? $type : 14;
    }

    public static function checkAutoKeys($key = null)
    {
        $arr = [
            1 => '',
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
        ];
        $type = static::returnArrValue($arr, $key);

        return !empty($type) ? $type : '';
    }

    public static function getDebtDetail($key = null)
    {
        $arr = [
            1 => "",
            2 => "Credit card purchases",
            3 => "Collection account",
            4 => "Other unsecured account",
            5 => "Student Loan",
            6 => "Civil suit",
            7 => "Cash Advance",
        ];
        $type = $key > 7 ? 'Other:' : static::returnArrValue($arr, $key);

        return $type;
    }

    public static function getDebtSelection($key = null)
    {
        $arr = [
            2 => "Credit Card Debt", //unsecured
            3 => "Collection Account", //unsecured
            4 => "Other Debt", //unsecured
            5 => "Student Loan", //unsecured
            6 => "Law Suit", //unsecured
            7 => "Cash Advance", //unsecured
            8 => "Back Taxes",
            9 => "Domestic Support Debt",
            10 => "Mortgage Loans",
            11 => "Car Loans",
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getDebtSelectionList($code = null)
    {
        $list = self::getDebtSelection();

        return self::createSelectionFromArray($list, $code);
    }


    public static function getClientBasicAddress($client_id)
    {
        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $BasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $BasicInfoPartA = !empty($BasicInfoPartA) ? $BasicInfoPartA->toArray() : [];
        $clientAddress = '';
        if (!empty($BasicInfoPartA)) {
            $clientAddress .= $BasicInfoPartA['Address'] ?? '';
            $clientAddress .= ', ' . $BasicInfoPartA['City'] ?? '';
            $clientAddress .= ', ' . $BasicInfoPartA['state'] ?? '';
            $clientAddress .= ', ' . $BasicInfoPartA['zip'] ?? '';
        }

        return $clientAddress;
    }

    public static function getProfitLossCommonData($final_debtormonthlyincome, $request)
    {
        $displayData = [];
        if (!empty($request->get('additional'))) {
            $additional = $request->get('additional');
            $nameOfBusiness = $final_debtormonthlyincome['profit_loss_business_name_'. $additional] ?? '';
            $final_debtormonthlyincome = $final_debtormonthlyincome['income_profit_loss_'. $additional] ?? '';
        } else {
            $nameOfBusiness = $final_debtormonthlyincome['profit_loss_business_name'] ?? '';
            $final_debtormonthlyincome = $final_debtormonthlyincome['income_profit_loss'] ?? '';
        }

        if (empty($final_debtormonthlyincome)) {
            $displayData['profit_loss_type'] = 2;
        }
        if (!empty($final_debtormonthlyincome) && isset($final_debtormonthlyincome['profit_loss_type']) && $request['onchange'] == 0) {
            $displayData = $final_debtormonthlyincome;
        }
        if (!empty($final_debtormonthlyincome) && isset($final_debtormonthlyincome[0]['profit_loss_type'])) {
            /* onload popup */
            if ($request['for_month'] > 0 && $request['onchange'] == 0) {
                $displayData = [];
                if (!empty($final_debtormonthlyincome)) {
                    foreach ($final_debtormonthlyincome as $inpro) {
                        if ($inpro['profit_loss_month'] == $request['for_month']) {
                            $displayData = $inpro;
                        }
                    }
                }

            }
        }
        /* If already have data and need to show on load*/
        if (isset($request['for_month']) && $request['for_month'] > 0 && $request['existing_type'] == 2 && $request['onchange'] == 1) {
            if (!empty($final_debtormonthlyincome) && isset($final_debtormonthlyincome[0]['profit_loss_type'])) {
                $new = true;
                foreach ($final_debtormonthlyincome as $month) {
                    if ($request['for_month'] == $month['profit_loss_month']) {
                        $new = false;
                        $displayData = $month;
                    }
                }
                if ($new == true) {
                    $displayData['profit_loss_month'] = $request['for_month'];
                    $displayData['profit_loss_type'] = 2;
                }
            }
        }
        if (isset($request['for_month']) && $request['for_month'] == 0 && $request['existing_type'] == 2 && $request['onchange'] == 1) {
            $displayData['profit_loss_type'] = 1;
            $displayData['profit_loss_month'] = $request['for_month'];
        }
        if (isset($request['for_month']) && $request['for_month'] == 0 && $request['existing_type'] == 1 && $request['onchange'] == 1) {
            if (!empty($final_debtormonthlyincome)) {
                $displayData = $final_debtormonthlyincome;
            }
            $displayData['profit_loss_type'] = 1;
            $displayData['profit_loss_month'] = $request['for_month'];
        }
        if (isset($request['for_month']) && $request['for_month'] > 0 && $request['existing_type'] == 1) {
            $displayData['profit_loss_type'] = 2;
            $displayData['profit_loss_month'] = $request['for_month'];
        }

        if (!empty($nameOfBusiness)) {
            $displayData['name_of_business'] = $nameOfBusiness;
        }


        return $displayData;
    }

    public static function getSelectedStateName($code = '')
    {
        if (empty($code)) {
            return '';
        }

        return cache()->remember("selected_state_name_{$code}", 3600, function () use ($code) {
            $state = State::where("state_code", $code)->first('state_name');

            return $state ? $state['state_name'] : '';
        });
    }

    public static function getDebtorIncomeFromBusiness($debtormonthlyincome)
    {
        $debtortotal6month = 0;
        $debtoraverage = 0;
        $debtorTotalOperatingExpense = 0;
        if ($debtormonthlyincome['operation_business'] == 1 && is_array($debtormonthlyincome['income_profit_loss']) && count($debtormonthlyincome['income_profit_loss']) > 0) {
            $income_profit_loss = $debtormonthlyincome['income_profit_loss'];
            $income_profit_loss = DateTimeHelper::getIncomeDescArray($income_profit_loss);
            $di = 1;

            foreach ($income_profit_loss as $profit) {
                if ($di > 6) {
                    continue;
                }
                if (isset($profit['profit_loss_month']) && !empty($profit['profit_loss_month'])) {
                    $debtorTotalOperatingExpense = $debtorTotalOperatingExpense + $profit['total_expense'];
                    $debtortotal6month = $debtortotal6month + Helper::validate_key_value('total_profit_loss', $profit, 'float');
                }
                $di++;
            }
        }
        $debtoraverage = $debtortotal6month > 0 ? number_format((float)($debtortotal6month / ($di - 1)), 2, '.', '') : "0.00";

        return ['debtoraverage' => $debtoraverage, 'debtorTotalOperatingExpense' => $debtorTotalOperatingExpense];
    }

    public static function getSpouseIncomeFromBusiness($debtorspousemonthlyincome)
    {
        $codebtorTotalOperatingExpense = 0;
        $spouseaverage = 0;
        $totalSpouse6month = 0;
        if (isset($debtorspousemonthlyincome['joints_operation_business']) && $debtorspousemonthlyincome['joints_operation_business'] == 1 && is_array($debtorspousemonthlyincome['income_profit_loss']) && count($debtorspousemonthlyincome['income_profit_loss']) > 0) {
            $income_profit_loss = $debtorspousemonthlyincome['income_profit_loss'];
            $income_profit_loss = DateTimeHelper::getIncomeDescArray($income_profit_loss);
            $si = 1;
            foreach ($income_profit_loss as $profit) {
                if ($si > 6) {
                    continue;
                }
                if (isset($profit['profit_loss_month']) && !empty($profit['profit_loss_month'])) {
                    $codebtorTotalOperatingExpense = $codebtorTotalOperatingExpense + $profit['total_expense'];
                    $totalSpouse6month = $totalSpouse6month + Helper::validate_key_value('total_profit_loss', $profit, 'float');
                }
                $si++;
            }
            $spouseaverage = $totalSpouse6month > 0 ? number_format((float)($totalSpouse6month / ($si - 1)), 2, '.', '') : "0.00";

        }

        return ['spouseaverage' => $spouseaverage, 'codebtorTotalOperatingExpense' => $codebtorTotalOperatingExpense];
    }

    public static function getSimplifiedPhoneNo($phone_no)
    {
        $mobile = str_replace(' ', '', $phone_no);
        $mobile = str_replace('-', '', $mobile);
        $mobile = str_replace(')', '', $mobile);
        $mobile = str_replace('(', '', $mobile);

        return $mobile;
    }

    public static function getMessageResponseData($mobile, $message, $username, $email)
    {
        $client = new \GuzzleHttp\Client([
            'timeout' => 30, // Set max timeout to 30 seconds
            'connect_timeout' => 10
        ]);

        try {
            $baseUrl = env('SMS_API_URL');
            $token = env('SMS_API_TOKEN');

            // Step 1: Update or create the contact
            $contactResponse = $client->request('PUT', "{$baseUrl}/contacts/{$mobile}", [
                'json' => [
                    'firstName' => $username,
                    'email' => $email
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ]
            ]);

            \Log::info('create/update user in simpletext:', [
                'status_code' => $contactResponse->getStatusCode(),
                'body' => json_decode($contactResponse->getBody(), true)
            ]);

            // Step 2: Prepare the message JSON safely
            $payload = [
                'contactPhone' => $mobile,
                'mode' => 'AUTO',
                'subject' => 'Message from BK Questionnaire',
                'text' => $message
            ];

            \Log::info('sms sent request:', $payload);

            // Step 3: Send the message
            $response = $client->request('POST', "{$baseUrl}/messages", [
                'json' => $payload,
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'http_errors' => true
            ]);

            $res = json_decode($response->getBody(), true);

            if (isset($res['id']) && !empty($res['id'])) {
                \Log::info('Invite message sent successfully:', [
                    'message_id' => $res['id'],
                    'client_phone' => $mobile
                ]);
            }

            return $res;

        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // Handle connection timeout
            \Log::error("text message connect timeout: " . $e->getMessage());

            return null;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle gateway timeout (HTTP 504) or other request errors
            if ($e->hasResponse() && $e->getResponse()->getStatusCode() == 504) {
                \Log::error("text message gateway timeout (504): " . $e->getMessage());
            } else {
                \Log::error("text message request error: " . $e->getMessage());
            }

            return null;
        } catch (\Exception $e) {
            \Log::error("text message error: " . $e->getMessage());

            return null;
        }
    }


    public static function sendSakariMobileTextMessage($user, $message)
    {
        if (empty($user->phone_no)) {
            return true;
        }
        $mobile = self::getSimplifiedPhoneNo($user->phone_no);

        return self::getMessageResponseData($mobile, $message, $user->name, $user->email);
    }

    public static function sendMobileTextMessage($user, $attorney, $cellNo = '')
    {
        if (empty($user->phone_no)) {
            return true;
        }

        $clientLoginurl = AttorneySettings::getClientLoginUrl($attorney->id);

        $message = "Welcome to BK Questionnaire.\n";
        $message .= "Your attorney, ({$attorney->name}), signed you up to securely submit info for your bankruptcy case.\n";
        $message .= "Log in at: [url={$clientLoginurl}]\n";
        $message .= "Email: ({$user['email']})\n";

        if (!Hash::info($user->password)['algo']) {
            $message .= "Temp Password: ({$user->password})\n";
        }

        $mobile = self::getSimplifiedPhoneNo($user->phone_no);
        if (!empty($cellNo)) {
            $mobile = self::getSimplifiedPhoneNo($cellNo);
        }

        self::getMessageResponseData($mobile, $message, $user->name, $user->email);
    }





    public static function financial_assets_array()
    {
        //"retirement_pension" => "Retirement and/or pensions, or profit-sharing plan(s) either through your employer or outside of your employer. Examples of these are: (IRA, 401(k), 403(b), thrift savings account, or other pension or profit-sharing plan) (list type of plan and where the account is held)",
        return  [
            'cash' => "Cash",
            'bank' => "Bank account(s) and/or Deposits of money",
            "mutual_funds" => "Bonds, mutual funds, and publicly traded stocks",
            "traded_stocks" => "Non-publicly traded stocks and interests in businesses",
            "government_corporate_bonds" => "Government and corporate bonds and instruments (including U.S. Savings Bonds) (Privately held stock of companies if your self-employed your business entity would be listed here)",
            "retirement_pension" => "Retirement and/or pensions. Examples of these are: (IRA, 401(k), 403(b), thrift savings account, or other pension or profit-sharing plan)",
            "security_deposits" => "Security deposits and/or pre-payments. Examples: Agreements with landlords (Rental Deposit), prepaid rent, public utilities (electric, gas, water), telecommunications companies, or others",
            "annuities" => "Annuities (list company)",
            "education_ira" => "Education IRA, Sec. 529 or Sec. 530 account, state tuition plan",
            "trusts_life_estates" => "Trusts, life estates, future, and equitable interests in property or assets",
            "patents_copyrights" => "Patents, copyrights, trademarks, trade secrets, and other intellectual property",
            "licenses_franchises" => "Licenses, franchises, and other general intangibles",
            "tax_refunds" => "Tax refunds owed to you (list years due)",
            "alimony_child_support" => "Alimony and child support",
            "unpaid_wages" => "Other amounts someone owes you (unpaid wages, disability benefits, sick pay, vacation pay, workers' compensation, unpaid loans made by you, etc.)",
            "insurance_policies" => "Cash value of insurance policies (whole or universal life, health, disability, HSA, etc.)",
            "inheritances" => "Inheritances, estate distributions, and death benefits",
            "injury_claims" => "Personal injury claims or awards",
            "other_claims" => "All other claims contingent and unliquidated claims of any nature",
            "other_financial" => "Any other financial asset not listed"];
    }

}
