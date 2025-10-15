<?php

namespace App\Repositories;

use App\Imports\ImportMedianFamilyIncome;
use App\Imports\ImportNationalExpense;
use App\Models\FoodClothing;
use App\Models\MedianFamilyIncome;
use Maatwebsite\Excel\Facades\Excel;

class MeanTestSettingRepository
{
    /**
     * @param $request
     * @return void
     */
    public function medianFamilyUpdateDeleteStatus($request)
    {
        // update status=deleted for the old ones
        MedianFamilyIncome::where('status', null)->update([
            'status' => 'Deleted'
        ]);
        Excel::import(new ImportMedianFamilyIncome(), $request->medianIncome);

        MedianFamilyIncome::where('status', 'Deleted')->delete();
    }

    public function medianFamilyStatusUpdate($post)
    {
        MedianFamilyIncome::where('status', null)->update([
            'additional_person_amount' => $post['additional_person_amount'],
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }

    public function foodClothingsStatusUpdate($post)
    {
        FoodClothing::where('status', null)->update([
            'AdditionalPersonCost' => $post['AdditionalPersonCost'],
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }

    public function getMedianFamily()
    {
        return MedianFamilyIncome::all()->toArray();
    }

    public function deleteOldFoodClothing($request)
    {
        // update status=deleted for the old ones
        FoodClothing::where('status', null)->update([
            'status' => 'Deleted'
        ]);
        Excel::import(new ImportNationalExpense(), $request->nationalExpense);

        FoodClothing::where('status', 'Deleted')->delete();
    }

    public function getFoodClothing()
    {
        return FoodClothing::all()->toArray();
    }

}
