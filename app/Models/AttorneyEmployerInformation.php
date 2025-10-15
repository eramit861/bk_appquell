<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AttorneyEmployerInformation extends Model
{
    protected $table = 'tbl_payroll_assistant_employer';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'attorney_id',
        'employer_name',
        'employer_address',
        'employer_city',
        'employer_state',
        'employer_zip',
        'created_at',
        'updated_at'
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

    private static function getEmployerList($client_id, $attorney_id, $client_type)
    {
        $client_type = $client_type == 'codebtor' ? 2 : 1;
        $employers = \App\Models\AttorneyEmployerInformation::leftJoin('tbl_payroll_assistant_employer_to_client', 'tbl_payroll_assistant_employer.id', '=', 'tbl_payroll_assistant_employer_to_client.employer_id')
                    ->where("employer_name", "!=", null)
                    ->where("tbl_payroll_assistant_employer_to_client.client_id", "=", $client_id)
                    ->where("tbl_payroll_assistant_employer_to_client.attorney_id", "=", $attorney_id)
                    ->where("tbl_payroll_assistant_employer_to_client.client_type", "=", $client_type)
                    ->select([
                        'tbl_payroll_assistant_employer_to_client.employer_id',
                        'tbl_payroll_assistant_employer.employer_name',
                        'tbl_payroll_assistant_employer_to_client.employment_duration',
                        'tbl_payroll_assistant_employer_to_client.employer_occupation',
                        'tbl_payroll_assistant_employer_to_client.frequency',
                        'tbl_payroll_assistant_employer.employer_address',
                        'tbl_payroll_assistant_employer.employer_city',
                        'tbl_payroll_assistant_employer.employer_state',
                        'tbl_payroll_assistant_employer.employer_zip',
                        'tbl_payroll_assistant_employer_to_client.attorney_id',
                        'tbl_payroll_assistant_employer_to_client.client_id',
                    ])
                    ->get();

        return !empty($employers) ? $employers->toArray() : [];
    }

    public static function getPayCheckData($client_id, $accountType, $employerList)
    {
        $payCheckData = [];
        $now = Carbon::now();
        $startDate = $now->copy()->startOfMonth()->subMonths(6);
        $endDate = $now->copy()->startOfMonth()->subDay();

        foreach ($employerList as $employer) {
            $employer_id = $employer['employer_id'];
            $frequency = $employer['frequency'];
            $payStubData = ClientDocuments::getPayStubs($client_id, $accountType, $employer_id, $startDate, $endDate);

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
                    $where = [ 'client_id' => $client_id, 'employer_id' => $employer_id, 'pinwheel_account_type' => $accountType ];
                    $payDates = self::getTwiceAMonthPayDates($startDate, $endDate, $where);
                    break;
                case 4: // Monthly
                    $payDates = self::getMonthlyPayDates($startDate, $endDate);
                    break;
            }

            $overrideCount = \App\Models\PayStubs::where([
                                                    'client_id' => $client_id,
                                                    'pinwheel_account_type' => $accountType,
                                                    'employer_id' => $employer_id,
                                                ])
                                                ->where(function ($query) {
                                                    $query->whereNotNull('override_date')
                                                          ->where('override_date', '!=', '');
                                                })
                                                ->count();

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
                    $existsData = \App\Models\PayStubs::where([
                                        'client_id' => $client_id,
                                        'employer_id' => $employer_id,
                                        'pinwheel_account_type' => $accountType
                                    ])->whereBetween('pay_date', [$checkStartDate, $checkEndDate])->get();
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

    private static function getTwiceAMonthPayDates($startDate, $endDate, $where)
    {
        $dates = [];
        $currentDate = $startDate->copy();

        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $firstDay = $currentDate->copy()->setDay(1);
            $fifteenthDay = $currentDate->copy()->setDay(15);

            $existsFirst = \App\Models\PayStubs::where($where)->where('pay_date', '=', $firstDay->toDateString())->exists();
            $existsThirtieth = false;
            $thirtiethDay = $currentDate->copy();
            if ($thirtiethDay->daysInMonth >= 30) {
                $thirtiethDay->setDay(30);
                $existsThirtieth = \App\Models\PayStubs::where($where)->where('pay_date', '=', $thirtiethDay->toDateString())->exists();
                if ($thirtiethDay->daysInMonth > 30) {
                    $thirtiethDay->addDay();
                    $existsThirtieth = !$existsThirtieth ? \App\Models\PayStubs::where($where)->where('pay_date', '=', $thirtiethDay->toDateString())->exists() : false;
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

}
