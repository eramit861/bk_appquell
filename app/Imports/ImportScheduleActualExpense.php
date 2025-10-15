<?php

namespace App\Imports;

use App\Models\ScheduleActualExpense;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportScheduleActualExpense implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // check for median family income
        if (!is_numeric($row[1]) && !is_float($row[1])) {
            return null;
        }

        //        echo '<pre>';
        //       print_r($row);
        return new ScheduleActualExpense([
            'judicial_district' => $row[0],
            'multiplier' => $row[1],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
