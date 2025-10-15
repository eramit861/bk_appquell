<?php

namespace App\Imports;

use App\Models\FoodClothing;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportNationalExpense implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //        echo '<pre>';
        //        print_r($row);
        // check for median family income
        if (!isset($row[2]) || $row[2] == '' || !is_numeric($row[2])) {
            return null;
        }

        //        echo '<pre>';
        //       print_r($row);
        return new FoodClothing([
            'Expense_Type' => $row[0],
            'OnePersonCost' => $row[1],
            'TwoPersonCost' => $row[2],
            'ThreePersonCost' => $row[3],
            'FourPersonCost' => $row[4],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
