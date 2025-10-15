<?php

namespace App\Imports;

use App\Models\MortgageHousingUtilities;
use App\Models\NonMortgageHousingUtilities;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportHousingUtils implements ToCollection
{
    /**
     * @param array $rows
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        $rows = $rows->toArray();


        foreach ($rows as $key => $row) {
            unset($key);
            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[4]) && !empty($row[6]) && !empty($row[8]) && !empty($row[10]) && !empty($row[12])) {
                MortgageHousingUtilities::create([
                    'state' => $row[0],
                    'county' => $row[1],
                    'FIPS_Code' => $row[2],
                    'OnePerson_amount' => $row[5],
                    'TwoPerson_amount' => $row[7],
                    'ThreePerson_amount' => $row[9],
                    'FourPerson_amount' => $row[11],
                    'FiveorMorePerson_amount' => $row[13],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);


                NonMortgageHousingUtilities::create([
                    'state' => $row[0],
                    'county' => $row[1],
                    'FIPS_Code' => $row[2],
                    'OnePerson_amount' => $row[4],
                    'TwoPerson_amount' => $row[6],
                    'ThreePerson_amount' => $row[8],
                    'FourPerson_amount' => $row[10],
                    'FiveorMorePerson_amount' => $row[12],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            }



        }

    }
}
