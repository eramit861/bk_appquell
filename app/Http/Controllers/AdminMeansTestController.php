<?php

namespace App\Http\Controllers;

use App\Repositories\MeanTestSettingRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportHousingUtils;
use App\Imports\ImportScheduleActualExpense;
use App\Models\MortgageHousingUtilities;
use App\Models\NonMortgageHousingUtilities;
use App\Models\ScheduleActualExpense;
use App\Models\OutOfPocketHealthCareExpnses;
use App\Models\TransportationIncome;
use App\Imports\ImportTransportationIncome;

class AdminMeansTestController extends Controller
{
    public function meansTestSetting(Request $request)
    {
        if ($request->isMethod('post')) {

            $post = $request->post() ;

            // Medain Family Income
            if ($request->hasFile('medianIncome')) {
                $this->validate($request, [
                    'medianIncome' => 'required|mimes:xlsx,xls',//kb
                ]);
                app(MeanTestSettingRepository::class)->medianFamilyUpdateDeleteStatus($request);
            }

            if ($post['additional_person_amount'] != '' && is_numeric($post['additional_person_amount'])) {
                app(MeanTestSettingRepository::class)->medianFamilyStatusUpdate($request);
            }
            if ($post['AdditionalPersonCost'] != '' && is_numeric($post['AdditionalPersonCost'])) {
                app(MeanTestSettingRepository::class)->foodClothingsStatusUpdate($request);
            }


            if ($request->hasFile('nationalExpense')) {
                $this->validate($request, [
                    'nationalExpense' => 'required|mimes:xlsx,xls',//kb
                ]);
                // update status=deleted for the old ones
                app(MeanTestSettingRepository::class)->deleteOldFoodClothing($request);
            }


            // Out Of Pocket
            if ($post['under_65'] != '') {
                OutOfPocketHealthCareExpnses::where('Age', 'under_65')->update(['Out_of_Pocket_Costs' => $post['under_65'] ,
                                                                               'updated_at' => \Carbon\Carbon::now()]);
            }
            if ($post['65_and_older'] != '') {
                OutOfPocketHealthCareExpnses::where('Age', '65_and_older')->update(['Out_of_Pocket_Costs' => $post['65_and_older'] ,
                    'updated_at' => \Carbon\Carbon::now()]);
            }

            // Housing UTILs FIPS

            if ($request->hasFile('housingUtilsFips')) {

                $this->validate($request, [
                    'housingUtilsFips' => 'required|mimes:xlsx,xls',//kb
                ]);
                // update status=deleted for the old ones
                MortgageHousingUtilities::where('status', null)->update([
                    'status' => 'Deleted'
                ]);

                NonMortgageHousingUtilities::where('status', null)->update([
                    'status' => 'Deleted'
                ]);
                Excel::import(new ImportHousingUtils(), $request->housingUtilsFips);

                MortgageHousingUtilities::where('status', 'Deleted')->delete();
                NonMortgageHousingUtilities::where('status', 'Deleted')->delete();

            }
            if ($request->hasFile('actualAdminExpense')) {

                $this->validate($request, [
                    'actualAdminExpense' => 'required|mimes:xlsx,xls',//kb
                ]);
                // update status=deleted for the old ones
                ScheduleActualExpense::where('status', null)->update([
                    'status' => 'Deleted'
                ]);
                Excel::import(new ImportScheduleActualExpense(), $request->actualAdminExpense);

                ScheduleActualExpense::where('status', 'Deleted')->delete();

            }

            if ($request->hasFile('actualTransportationExpense')) {
                $this->validate($request, [
                    'actualTransportationExpense' => 'required|mimes:xlsx,xls',//kb
                ]);
                // update status=deleted for the old ones
                TransportationIncome::where('status', 1)->update([
                    'status' => 0
                ]);
                Excel::import(new ImportTransportationIncome(), $request->actualTransportationExpense);
                TransportationIncome::where('status', 0)->delete();

            }

            return redirect()->back()->with('success', 'Means Test Standards has been imported successfully.');

        }


        return view('admin.meanstest_setting');
    }

    public function meansTestSettingAjax(Request $request)
    {
        $input = $request->all();
        $testType = $input['test_type'] ?? '';
        $datalist = self::getAllTypeArray($testType);

        return view('admin.mean_test.'.$testType, ['datalist' => $datalist]);
    }

    private static function getAllTypeArray($testType)
    {

        if ($testType == 'median_income') {
            return self::getMedianArray();
        } elseif ($testType == 'mortgage') {
            return self::getMortgageArray();
        } elseif ($testType == 'national_expense') {
            return self::getNEArray();
        } elseif ($testType == 'national_oop_healthcare') {
            return self::getNOHCArray();
        } elseif ($testType == 'non_mortgage') {
            return self::getNonMortgageArray();
        } elseif ($testType == 'schedule_of_actual_admins_expenses') {
            return  self::getSOAAArray();
        } elseif ($testType == 'transportation') {
            return self::getTransportationrray();
        }
    }

    private static function getMedianArray()
    {
        return app(MeanTestSettingRepository::class)->getMedianFamily();
    }

    private static function getMortgageArray()
    {
        return  MortgageHousingUtilities::all()->toArray();
    }

    private static function getNEArray()
    {
        return  app(MeanTestSettingRepository::class)->getFoodClothing();
    }

    private static function getNOHCArray()
    {
        return OutOfPocketHealthCareExpnses::all()->toArray();
    }

    private static function getNonMortgageArray()
    {
        return NonMortgageHousingUtilities::all()->toArray();
    }

    private static function getSOAAArray()
    {
        return ScheduleActualExpense::all()->toArray();
    }

    private static function getTransportationrray()
    {
        return  TransportationIncome::all()->toArray();
    }

}
