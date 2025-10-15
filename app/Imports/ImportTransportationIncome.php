<?php

namespace App\Imports;

use App\Models\TransportationIncome;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportTransportationIncome implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $row[1] = isset($row[1]) ? (int) filter_var($row[1], FILTER_SANITIZE_NUMBER_INT) : '';
        $row[2] = isset($row[2]) ? (int) filter_var($row[2], FILTER_SANITIZE_NUMBER_INT) : '';
        if (!isset($row[1]) || !isset($row[1]) || $row[0] == '' || !is_numeric($row[1])) {
            return null;
        }

        return new TransportationIncome([
            'region' => trim($row[0]),
            'one_car_cost' => !empty($row[1]) ? $row[1] : 0,
            'two_car_cost' => !empty($row[2]) ? $row[2] : 0,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
