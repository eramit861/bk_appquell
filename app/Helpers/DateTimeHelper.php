<?php

namespace App\Helpers;

class DateTimeHelper extends Helper
{
    public static function getIncomeDescArray($array = [])
    {
        if (empty($array)) {
            return $array;
        }
        if (isset($array['profit_loss_type']) && $array['profit_loss_type'] == 1) {
            return [];
        }
        uasort($array, function ($a, $b) {
            $ascending = false;
            $format = 'm-Y';
            $zone = new \DateTimeZone('UTC');
            $d1 = \DateTime::createFromFormat($format, $a['profit_loss_month'], $zone)->getTimestamp();
            $d2 = \DateTime::createFromFormat($format, $b['profit_loss_month'], $zone)->getTimestamp();

            return $ascending ? ($d1 - $d2) : ($d2 - $d1);
        });

        return $array;
    }

    public static function getOnlyYearForTaxReturn($attorney_id = 0)
    {
        $array = [];
        $array = [
            date("Y", strtotime("-0 year")),
            date("Y", strtotime("-1 year")),
            date("Y", strtotime("-2 year")),
            date("Y", strtotime("-3 year"))
         ];

        return $array;
    }

    public static function getYearForTaxReturn($type, $taxReturnDayMonth)
    {
        $today = new \DateTime();
        $currentYear = $today->format('Y');
        $currentDate = $today->format('Y-m-d');

        // Handle mm/dd input for $taxReturnDayMonth
        if (!empty($taxReturnDayMonth)) {
            [$month, $day] = explode('/', $taxReturnDayMonth);

            // Create a DateTime object for the tax return date
            $taxReturnDate = \DateTime::createFromFormat('Y-m-d', "$currentYear-$month-$day");

            // Define the base date for comparison (January 15th of the current year)
            $baseDate = $taxReturnDate;

            // Determine the tax return year based on the current date and base date
            if ($today <= $baseDate) {
                // If the current date is before or on January 15th, treat the tax return year as the previous year
                $taxReturnYear = $currentYear - 1;
            } else {
                // If the current date is after January 15th, treat the tax return year as the current year
                $taxReturnYear = $currentYear;
            }
        } else {
            // Default to current year if no tax return date is provided
            $taxReturnYear = $currentYear;
        }

        // Define the year offsets based on the tax return year
        $yearOffsets = [
            "Last_Year_Tax_Returns" => $taxReturnYear - 1,
            "Prior_Year_Tax_Returns" => $taxReturnYear - 2,
            "Prior_Year_Two_Tax_Returns" => $taxReturnYear - 3,
            "Prior_Year_Three_Tax_Returns" => $taxReturnYear - 4
        ];

        // Return the requested tax return year
        return $yearOffsets[$type] ?? '';
    }
    public static function dbDateToDisplay($db_date, $includeTime = false, $twelvehr = false)
    {
        $timeFormat = '';
        if (in_array($db_date, ['', '0000-00-00', '0000-00-00 00:00:00'])) {
            return '';
        }
        if ($includeTime) {
            $timeFormat = ' H:i:s';
        }
        if ($twelvehr) {
            $timeFormat = ' h:i:sa';
        }

        return date('m/d/Y' . $timeFormat, strtotime($db_date));
    }
    public static function validateDateFormat($dateString)
    {
        if (!isset($dateString) || empty($dateString)) {
            return false;
        }
        $pattern = "/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/";
        if (!preg_match($pattern, $dateString, $matches)) {
            return false;
        }

        if (!checkdate($matches[1], $matches[2], $matches[3])) {
            return false;
        }

        return true;
    }
    public static function createSixDuplicateObject($arrayData, $attProfitLossMonths)
    {
        $arr = [];
        $months = self::getFullMonthYearArrayForProfitLoss($attProfitLossMonths);

        if (empty($arrayData) || !isset($arrayData['profit_loss_month']) || (isset($arrayData['profit_loss_month']) && !array_key_exists($arrayData['profit_loss_month'], $months))) {
            return $arr;
        }

        foreach ($months as $monthKey => $monthLabel) {
            $duplicate = $arrayData;
            $duplicate['profit_loss_month'] = $monthKey;
            $arr[] = $duplicate;
        }

        return $arr;
    }
    public static function getFullMonthYearArrayForProfitLoss($monthCount = 6)
    {
        $arr = [];
        foreach (range(1, $monthCount) as $val) {
            $arr[date("n-Y", mktime(0, 0, 0, date("m") - $val, 1, date("Y")))] = date("F, Y", mktime(0, 0, 0, date("m") - $val, 1, date("Y")));
        }

        return  $arr;
    }
    public static function getMonthArrayForProfitLoss($key = null, $monthCount = 6)
    {
        $arr = [];
        foreach (range(1, $monthCount) as $val) {
            $arr[date("n-Y", mktime(0, 0, 0, date("m") - $val, 1, date("Y")))] = date("F Y", mktime(0, 0, 0, date("m") - $val, 1, date("Y")));
        }

        return static::returnArrValue($arr, $key);
    }
    public static function getMonthYearArray()
    {
        $arr = [];
        foreach (range(1, 6) as $val) {
            $arr[date("m-Y", mktime(0, 0, 0, date("m") - $val, 1, date("Y")))] = date("M, Y", mktime(0, 0, 0, date("m") - $val, 1, date("Y")));
        }

        return  $arr;
    }
    public static function getBankStatementShortMonthArray($nofMonths = 3, $key = null, $addCurrentMonthToDate = false, $brokerageMonthType = null)
    {
        // Ensure $nofMonths is not an empty string
        if ($nofMonths === '') {
            $nofMonths = 3;
        }

        // Parse $nofMonths to an integer
        $nofMonths = (int)$nofMonths;

        // Default to 3 if $nofMonths is not more than 1
        if ($nofMonths <= 1) {
            $nofMonths = 3;
        }

        if ($brokerageMonthType == 1) {
            $nofMonths = 1;
        } else {
            $arr = $addCurrentMonthToDate ? ['' => 'Current Month Stmt '] : [];
        }

        foreach (range(1, $nofMonths) as $val) {
            $arr[date("n-Y", mktime(0, 0, 0, date("m") - $val, 1, date("Y")))] = date("M Y", mktime(0, 0, 0, date("m") - $val, 1, date("Y")));
        }

        return static::returnArrValue($arr, $key);
    }

    public static function getBankStatementMonthArray($nofMonths = 3, $key = null, $addCurrentMonthToDate = false, $brokerageMonthType = null)
    {
        // Ensure $nofMonths is not an empty string
        if ($nofMonths === '') {
            $nofMonths = 3;
        }

        // Parse $nofMonths to an integer
        $nofMonths = (int)$nofMonths;

        // Default to 3 if $nofMonths is not more than 1
        if ($nofMonths <= 1) {
            $nofMonths = 3;
        }

        if ($brokerageMonthType == 1) {
            $nofMonths = 1;
        } else {
            $arr = $addCurrentMonthToDate ? ['' => 'Current Month Stmt '] : [];
        }
        foreach (range(1, $nofMonths) as $val) {
            $arr[date("n-Y", mktime(0, 0, 0, date("m") - $val, 1, date("Y")))] = date("F Y", mktime(0, 0, 0, date("m") - $val, 1, date("Y")));
        }

        return static::returnArrValue($arr, $key);
    }
    public static function convertToDateProfitLoss($date, $format = 'Y-m-d')
    {
        $date = "1 " . $date;
        $date = \DateTime::createFromFormat('j F, Y', $date);  // Explicit format parsing

        return $date->format($format);
    }

    public static function convertToDatePaystub($date, $format = 'Y-m-d')
    {
        $date = new \DateTime($date);

        return $date->format($format);
    }

    public static function convertYearsToEndOfYear($inputString)
    {
        if (trim($inputString) === '') {
            return '';
        }

        // Split the input string by spaces to get an array of years
        $years = explode(' ', $inputString);

        // Convert to integers for correct numerical sorting
        $years = array_map('intval', $years);
        sort($years); // Sort in ascending order

        // Map each year to the desired format "12/31/YYYY"
        $formattedYears = array_map(function ($year) {
            return "12/31/$year";
        }, $years);

        // Extract the last formatted date
        $lastDate = array_pop($formattedYears);

        // Format and return the string with proper separators
        return empty($formattedYears) ? $lastDate : implode("; ", $formattedYears) . "; & " . $lastDate;

    }

    public static function formatToMonthYearFromAnyFormat($date)
    {
        // Define an array of possible date formats
        $formats = [
            'm-d-Y', 'm/d/Y', 'm/Y', 'm-Y', 'Y-m', 'Y/m','Y-m-d'
        ];

        // Attempt to parse the date using each format
        foreach ($formats as $format) {
            try {
                $parsedDate = \Carbon\Carbon::createFromFormat($format, $date);

                return $parsedDate->format('m/Y'); // Return in mm/yyyy format
            } catch (\Exception $e) {
                // Continue trying the next format if parsing fails
                continue;
            }
        }

        // If all parsing attempts fail, return a default date
        return false;
    }

}
