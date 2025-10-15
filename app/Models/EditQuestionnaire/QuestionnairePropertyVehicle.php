<?php

namespace App\Models\EditQuestionnaire;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use App\Models\AutoLoanCompanies;
use App\Models\ClientsAssociate;
use App\Models\CrsCreditReport;
use App\Models\User;
use App\Services\Client\CacheProperty;

class QuestionnairePropertyVehicle extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_property_vehicle';
    public $timestamps = false;

    public static function saveStepVehicle($client_id, $request, $save_request_by_attorney = false, $attorney_id = '')
    {
        // get all input data
        $input = $request->all();

        // check has any vehicles
        $ownAnyVehicle = Helper::validate_key_value('do_you_own_vehicle', $input, 'radio') ?? 0;

        // Retrieve vehicle details and loans
        $propertyVehicleFinal = [];
        $propertyVehicleFinal = self::getVehicleDetails($input, $propertyVehicleFinal, $ownAnyVehicle);
        $propertyVehicleFinal = self::getVehicleLoanDetails($input, $propertyVehicleFinal);

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $settingsAttorneyId,'is_associate' => $is_associate])->select(['is_car_title_enabled'])->first();
        $is_car_title_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_car_title_enabled', $attorneySettings, 'radio') : 0;

        if ($is_car_title_enabled) {
            CrsCreditReport::addVehicleTitleFromVehicle($propertyVehicleFinal, $client_id);
        }


        // get vehicles, recreation data
        $vehicles = self::getVehicleLoanMonthlyPayment($propertyVehicleFinal, 1);
        $recreational = self::getVehicleLoanMonthlyPayment($propertyVehicleFinal, 6);
        // save auto loan creditors
        self::addAutoLoanCreditorToList($propertyVehicleFinal, $save_request_by_attorney, $attorney_id, $client_id);

        $user = User::find($client_id);

        // save Expense data from vehicles
        QuestionnaireExpenses::updateExpensesFromPropertyVehicle($save_request_by_attorney, $user, $client_id, $vehicles, $recreational);

        // save SOFA data from vehicles
        QuestionnaireFinancialAffairs::updateFinancialAffairsFromPropertyVehicle($save_request_by_attorney, $user, $propertyVehicleFinal, $client_id);

        // save SOFA data from vehicles
        CrsCreditReport::addCreditorToReportFromVehicle($propertyVehicleFinal, $client_id);

        // save property vehicle

        self::updateOrCreatePropertyVehicle($propertyVehicleFinal, $user, $client_id, $attorney_id, $save_request_by_attorney);

        // forget property cache
        CacheProperty::forgetPropertyCache($client_id);
    }

    private static function getVehicleDetails($input, $propertyVehicleFinal, $ownAnyVehicle)
    {
        $propertyVehicle = Helper::validate_key_value('property_vehicle', $input);
        if (!empty($propertyVehicle)) {
            foreach ($propertyVehicle as $key => $values) {
                $i = 0;
                if ($key == "vehicle_car_loan") {
                    continue;
                }
                foreach ($values as $val) {
                    if (!isset($propertyVehicleFinal[$i]['own_any_property'])) {
                        $propertyVehicleFinal[$i]['own_any_property'] = $ownAnyVehicle;
                    }
                    $propertyVehicleFinal[$i][$key] = (isset($val)) ? $val : "";
                    $i++;
                }
            }
        }

        return $propertyVehicleFinal;
    }

    private static function getVehicleLoanDetails($input, $propertyVehicleFinal)
    {
        $vehicle_car_loan_final = [];
        $propertyVehicle = Helper::validate_key_value('property_vehicle', $input);
        if (!empty($propertyVehicle['vehicle_car_loan'])) {
            foreach ($propertyVehicle['vehicle_car_loan'] as $key => $values) {
                $i = 0;
                foreach ($values as $val) {
                    $vehicle_car_loan_final[$i][$key] = (isset($val)) ? $val : "";
                    $propertyVehicleFinal[$i]['vehicle_car_loan'] = json_encode($vehicle_car_loan_final[$i]);
                    $i++;
                }
            }
        }

        return $propertyVehicleFinal;
    }

    private static function getVehicleLoanMonthlyPayment($propertyVehicleFinal, $propertyType)
    {
        $vehicleData = [];
        $i = 1;
        if (!empty($propertyVehicleFinal)) {
            foreach ($propertyVehicleFinal as $car) {
                if (
                    isset($car['property_type']) &&
                    $car['property_type'] == $propertyType &&
                    $car['own_any_property'] == 1 &&
                    isset($car['loan_own_type_property']) &&
                    $car['loan_own_type_property'] == 1 &&
                    isset($car['retain_above_property']) &&
                    $car['retain_above_property'] == 1
                ) {
                    $vehicleData[$i] = json_decode($car['vehicle_car_loan'], 1)['monthly_payment'];
                    $i++;
                }
            }
        }

        return $vehicleData;
    }

    private static function addAutoLoanCreditorToList($propertyVehicleFinal, $save_request_by_attorney, $attorney_id, $client_id)
    {
        if (!empty($propertyVehicleFinal)) {
            foreach ($propertyVehicleFinal as $car) {
                $vehicleCarLoanDecoded = json_decode($car['vehicle_car_loan'], 1);
                AutoLoanCompanies::addCreditorToAutoLoanList($vehicleCarLoanDecoded, $save_request_by_attorney, $attorney_id, $client_id);
            }
        }

        return true;
    }

    private static function updateOrCreatePropertyVehicle($propertyVehicleFinal, $user, $client_id, $attorney_id, $save_request_by_attorney)
    {

        $abFormLineStart = QuestionnaireUser::get_AB_FORM_LINE_NUMBERS('vehicle_property');
        $abFormLineNo = '';
        $function = $save_request_by_attorney ? 'questionnairePropertyVehicle' : 'clientsPropertyVehicle';
        $dateTime = date('Y-m-d H:i:s');
        if (!empty($propertyVehicleFinal)) {
            $postedIds = array_column($propertyVehicleFinal, 'id');

            if ($client_id > 0 && !empty($postedIds)) {
                // Remove previous data that is not in the new list
                $user->$function()->whereNotIn('id', $postedIds)->delete();
            }

            foreach ($propertyVehicleFinal as $dataToSave) {
                $abFormLineNo = ($abFormLineNo == '') ? ($abFormLineStart + .1) : ($abFormLineNo + .1);
                if (!isset($dataToSave['own_any_property'])) {
                    continue;
                }
                $dataToSave['client_id'] = $client_id;
                $dataToSave['form_ab_line_no'] = $abFormLineNo;
                $dataToSave['updated_on'] = $dateTime;

                if ($save_request_by_attorney) {
                    $dataToSave['reviewed_by'] = $attorney_id;
                    $dataToSave['reviewed_on'] = $dateTime;
                }

                if (!empty($dataToSave['id'])) {
                    self::createPropertyVehicle($user, $dataToSave, $function, $dateTime, count($propertyVehicleFinal));
                } else {
                    if (Helper::validate_key_value('own_any_property', $dataToSave, 'radio') == 0 && count($propertyVehicleFinal) == 1) {
                        $dataToSave['created_on'] = $dateTime;
                    }
                    $user->$function()->create($dataToSave);
                }
            }
        } else {
            $user->$function()->delete();
            $dataToSave = [];
            $dataToSave['client_id'] = $client_id;
            $dataToSave['form_ab_line_no'] = $abFormLineNo;
            $dataToSave['updated_on'] = $dateTime;
            $dataToSave['created_on'] = $dateTime;
            $dataToSave['own_any_property'] = 0;
            $user->$function()->create();
        }

        // forget property cache
        CacheProperty::forgetPropertyCache($client_id);
    }

    private static function createPropertyVehicle($user, $dataToSave, $function, $dateTime, $count)
    {
        $id = $dataToSave['id'];

        if (Helper::validate_key_value('own_any_property', $dataToSave, 'radio') == 0) {
            $user->$function()->where("id", $id)->delete();

            if ($count == 1) { // Only if this is the last record
                $dataToSave['created_on'] = $dateTime;

                return $user->$function()->create($dataToSave);
            }

            return;
        }

        unset($dataToSave['id']);

        // Use `updateOrCreate` to handle both cases efficiently
        return $user->$function()->updateOrCreate(['id' => $id], $dataToSave);
    }

}
