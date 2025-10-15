<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AttorneyEmployerInformationToClient extends Model
{
    protected $table = 'tbl_payroll_assistant_employer_to_client';
    public $timestamps = false;
    protected $casts = [
        'not_own_paystub' => 'array',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'attorney_id',
        'client_id',
        'employer_type',
        'employer_occupation',
        'employment_duration',
        'start_date',
        'end_date',
        'frequency',
        'twice_month_selection',
        'client_type',
        'created_at',
        'updated_at',
        'employer_name',
        'employer_address',
        'employer_city',
        'employer_state',
        'employer_zip',
        'employer_added_by',
        'notes',
        'not_own_paystub'
    ];

    public static function getMissingPaystubList($client_id, $debtor_type)
    {
        $payCheckData = [];
        if (!empty($client_id) && !empty($debtor_type)) {
            $attorney_id = self::getClientAttorneyId($client_id);
            $employerList = self::getEmployerList($client_id, $attorney_id, $debtor_type);
            $acctype = '';
            if ($debtor_type == 'debtor') {
                $acctype = 'self';
            } elseif ($debtor_type == 'codebtor') {
                $acctype = 'spouse';
            }
            $payCheckData = self::getPayCheckData($client_id, $acctype, $employerList);
        }

        return $payCheckData;
    }

    protected static function getClientAttorneyId($client_id)
    {
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }

        return $attorney_id;
    }

    public static function getEmployerList($client_id, $attorney_id, $client_type)
    {
        $client_type = $client_type == 'codebtor' ? 2 : 1;
        $whereConditions = [
            "client_id" => $client_id,
            "attorney_id" => $attorney_id,
            "client_type" => $client_type,
        ];
        $employers = \App\Models\AttorneyEmployerInformationToClient::where($whereConditions)->where("employer_name", "!=", null)
                        ->orderByRaw("CASE WHEN employer_type = 0 THEN 100 ELSE employer_type END ASC")
                        ->orderBy('tbl_payroll_assistant_employer_to_client.employer_type', 'asc')->get();

        return !empty($employers) ? $employers->toArray() : [];
    }

    public static function getPayCheckData($client_id, $accountType, $employerList)
    {
        $payCheckData = [];
        $now = Carbon::now();
        $startDate = $now->copy()->startOfMonth()->subMonths(6);
        $endDate = $now->copy()->startOfMonth()->subDay();

        $employerIds = array_column($employerList, 'id');

        $paystubList = \App\Models\PayStubs::where([
                            'client_id' => $client_id,
                            'pinwheel_account_type' => $accountType,
                        ])
                        ->whereIn('employer_id', $employerIds) // Filter by multiple employer IDs
                        ->orderBy('pay_date', 'DESC')
                        ->get();

        foreach ($employerList as $employer) {
            $employer_id = $employer['id'];
            $frequency = $employer['frequency'];

            $payStubData = $paystubList->where('employer_id', $employer_id)->whereBetween('pay_date', [$startDate, $endDate])->values();

            if (!$payStubData) {
                continue;
            }

            $payDates = [];
            switch ($frequency) {
                case 1: // Weekly
                    $payDates = self::getWeeklyPayDates($startDate, $endDate);
                    break;
                case 2: // Bi-Weekly
                    $payDates = self::getBiWeeklyPayDates($startDate, $endDate);
                    break;
                case 3: // Twice a month
                    $payDates = self::getTwiceAMonthPayDates($startDate, $endDate, $paystubList->where('employer_id', $employer_id));
                    break;
                case 4: // Monthly
                    $payDates = self::getMonthlyPayDates($startDate, $endDate);
                    break;
            }

            $overrideCount = $paystubList->where('employer_id', $employer_id)->whereNotNull('override_date')->where('override_date', '!=', '')->count() ?? 0;

            $missing_count = 0;
            $total_count = 0;
            foreach ($payDates as $payDate) {

                $checkStartDate = '';
                $checkEndDate = '';
                if ($frequency == 4) {
                    $checkStartDate = '';
                    $checkEndDate = '';
                    $checkStartDate = Carbon::parse($payDate)->startOfMonth();
                    $checkEndDate = Carbon::parse($payDate)->endOfMonth();
                } else {
                    $checkStartDate = '';
                    $checkEndDate = '';
                    $checkStartDate = Carbon::parse($payDate)->subDay();
                    $checkEndDate = Carbon::parse($payDate)->addDay();
                }

                if (!empty($checkStartDate) && !empty($checkEndDate)) {
                    $existsData = $paystubList->where('employer_id', $employer_id)->whereBetween('pay_date', [$checkStartDate, $checkEndDate]);
                }

                $exists = !$existsData->isEmpty();

                if (!$exists) {
                    $missing_count++;
                }
                $total_count++;

            }

            $payCheckData[] = [
                'employer_name' => $employer['employer_name'],
                'missing_count' => ((int)$missing_count - (int)$overrideCount),
                'override_count' => $overrideCount ?? 0,
                'total_count' => $total_count ?? 0,
            ];
        }

        return $payCheckData;
    }

    private static function getWeeklyPayDates($startDate, $endDate)
    {
        $dates = [];

        $firstFriday = $startDate->copy();
        if ($firstFriday->dayOfWeek != Carbon::FRIDAY) {
            $firstFriday->addDays((Carbon::FRIDAY - $firstFriday->dayOfWeek + 7) % 7);
        }

        $currentDate = $firstFriday;
        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $dates[] = $currentDate->toDateString(); // Add current Friday
            $currentDate->addDays(7); // Move to the next Friday
        }

        return $dates;
    }

    private static function getBiWeeklyPayDates($startDate, $endDate)
    {
        $dates = [];
        $firstFriday = $startDate->copy();
        if ($firstFriday->dayOfWeek != Carbon::FRIDAY) {
            $firstFriday->addDays((Carbon::FRIDAY - $firstFriday->dayOfWeek + 7) % 7);
            $currentDate = $firstFriday->copy()->addDays(7);
        } else {
            $currentDate = $firstFriday;
        }

        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $dates[] = $currentDate->toDateString();
            $currentDate->addDays(14);
        }

        return $dates;
    }

    private static function getTwiceAMonthPayDates($startDate, $endDate, $data)
    {
        $dates = [];
        $currentDate = $startDate->copy();

        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $firstDay = $currentDate->copy()->setDay(1);
            $fifteenthDay = $currentDate->copy()->setDay(15);
            $existsFirst = $data->where('pay_date', '=', $firstDay->toDateString());
            $existsFirst = (isset($existsFirst) && !empty($existsFirst)) ? true : false ;
            $existsThirtieth = false;
            $thirtiethDay = $currentDate->copy();
            if ($thirtiethDay->daysInMonth >= 30) {
                $thirtiethDay->setDay(30);
                $existsThirtieth = $data->where('pay_date', '=', $thirtiethDay->toDateString());
                $existsThirtieth = (isset($existsThirtieth) && !empty($existsThirtieth)) ? true : false ;
                if ($thirtiethDay->daysInMonth > 30) {
                    $thirtiethDay->addDay();
                    if (!$existsThirtieth) {
                        $existsThirtyFirst = $data->where('pay_date', '=', $thirtiethDay->toDateString());
                        $existsThirtyFirst = (isset($existsThirtyFirst) && !empty($existsThirtyFirst)) ? true : false ;
                        $existsThirtieth = $existsThirtyFirst;
                    } else {
                        $existsThirtieth = false;
                    }
                }
            }

            if ($existsFirst) {
                $dates[] = $firstDay->toDateString();
                $dates[] = $fifteenthDay->toDateString();
            } elseif ($existsThirtieth) {
                $dates[] = $fifteenthDay->toDateString();
                $dates[] = $currentDate->copy()->setDay(30)->toDateString();
            } else {
                $dates[] = $firstDay->toDateString();
                $dates[] = $fifteenthDay->toDateString();
            }

            $currentDate->addMonths(1);
        }

        return array_unique($dates);
    }

    private static function getMonthlyPayDates($startDate, $endDate)
    {
        $dates = [];
        $currentDate = $startDate->copy();
        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $endOfMonth = $currentDate->copy()->endOfMonth();
            if ($endOfMonth->isSaturday()) {
                $dates[] = $endOfMonth->subDay()->toDateString();
            } elseif ($endOfMonth->isSunday()) {
                $dates[] = $endOfMonth->subDays(2)->toDateString();
            } else {
                $dates[] = $endOfMonth->toDateString();
            }
            $currentDate->addMonths(1);
        }

        return $dates;
    }

    public static function hasAnyEmployer($clientId, $attorneyId, $clientType)
    {
        $count = \App\Models\AttorneyEmployerInformationToClient::where([ "client_id" => $clientId, "attorney_id" => $attorneyId, "client_type" => $clientType ])->where("employer_name", "!=", null)->count();

        return ($count > 0) ? true : false;
    }

    public static function getCurrentEmployerData($type, $client_id, $attorney_id, $employer_type)
    {
        $condition = [
            'attorney_id' => $attorney_id,
            'client_id' => $client_id,
            'client_type' => $type,
            'employer_type' => $employer_type,
        ];

        $data = \App\Models\AttorneyEmployerInformationToClient::where($condition)->get();

        return (isset($data) && !empty($data)) ? $data->toArray() : [];

    }

    /**
    * Add or remove a single date from the not_own_paystub JSON array.
    *
    * @param string $date
    * @return void
    */
    public function updateNotOwnPaystubDate(string $date)
    {
        // Get the current JSON data
        $currentDates = $this->not_own_paystub ?? [];

        // Check if the date already exists in the array
        $dateIndex = array_search($date, $currentDates);

        if ($dateIndex !== false) {
            // If the date exists, remove it
            unset($currentDates[$dateIndex]);
        } else {
            // If the date doesn't exist, add it
            $currentDates[] = $date;
        }

        // Update the not_own_paystub attribute
        $this->not_own_paystub = array_values($currentDates); // Re-index the array
    }
    public static function hasMultipleCurrentEmployer($clientId, $attorneyId, $clientType)
    {
        $count = AttorneyEmployerInformationToClient::where([ "client_id" => $clientId, "attorney_id" => $attorneyId, "client_type" => $clientType, 'employer_type' => 1 ])->where("employer_name", "!=", null)->count();

        return ($count > 1) ? true : false;
    }

    public static function hasSingleCurrentEmployer($clientId, $attorneyId, $clientType)
    {
        $count = AttorneyEmployerInformationToClient::where([ "client_id" => $clientId, "attorney_id" => $attorneyId, "client_type" => $clientType, 'employer_type' => 1 ])->where("employer_name", "!=", null)->count();

        return ($count == 1) ? true : false;
    }
}
