<?php

namespace App\Imports;

use App\Models\MedianFamilyIncome;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportMedianFamilyIncome implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!isset($row[1]) || $row[1] == '' || !is_numeric($row[1])) {
            return null;
        }

        //        echo '<pre>';
        //       print_r($row);
        return new MedianFamilyIncome([
            'state' => $row[0],
            'one_earner' => $row[1],
            'two_person' => $row[2],
            'three_person' => $row[3],
            'four_person' => $row[4],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
