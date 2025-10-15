<?php
$chapterPlan = !empty($chapterPlan) ? $chapterPlan->toArray() : [];
$chapterPlanData = isset($chapterPlan['plan_data']) ? json_decode($chapterPlan['plan_data'], 1) : [];

?>
<form method="POST" name="plan_information_form" id="plan_info">
    @csrf
    <section class="popup py-5">
        <div class="chapter13 container">
            <div class="chapter13 chapter row">
                <div class="col-md-12 pr-0 mb-3">
                    <h2 class="text-center">{{ __('Chapter 13 Plan') }}</h2>
                </div>
                <div class="col-md-5 pl-0 pr-0 mt-3"></div>
                <div class="col-md-7 pl-0 pr-0 mt-3 text-right">
                    <a onclick="resetChapterPlanPopup()" class="off-btn btn-form float-right ml-2" href="javascript:void(0)">
                        <span class="card-title-text">{{ __('Reset to Client Questionnaire') }}</span>
                    </a>
                    <a onclick="" class="off-btn btn-form float-right ml-2" href="javascript:void(0)">
                        <span class="card-title-text">{{ __('Import Plan Data') }}</span>
                    </a>
                    <a onclick="savechapterPlanDataInfoToDb()" class="off-btn btn-form float-right ml-2" href="javascript:void(0)">
                        <span class="card-title-text">{{ __('Save Changes') }}</span>
                    </a>

                    <a onclick="" class="off-btn btn-form float-right ml-2" href="javascript:void(0)">
                        <span class="card-title-text">{{ __('Plan Payout') }}</span>
                    </a>
                </div>
            </div>

            <div class="chapter13 row">
                <div class="chapter13 col-md-12">

                    <div class="chapter13 row no-border-elements">
                        <div class="chapter13 col-md-12">

                            <h5 class="mt-2 payment-mtgr">{{ __('Mortgage Loans') }} </h5>
                        </div>
                        <div class="chapter13 col-md-12 mb-2 headingpm">
                            <div class="chapter13 row">

                                <div class="chapter13 col-md-2 mt-2  pr-0">
                                    <strong>{{ __('Property/Creditor') }}</strong>
                                </div>

                                <div class="chapter13 col-md-2 mt-2  pr-0">
                                    <strong><label>{{ __('Monthly Payment') }}</label></strong>
                                </div>
                                <div class="chapter13 col-md-4 mt-2  pr-0">
                                    <strong>{{ __('Past Due') }}</strong>
                                </div>
                                <div class="chapter13 col-md-2 mt-2 ">
                                    <strong> <label>{{ __('Remaining Payments') }}</label></strong>
                                </div>
                                <div class="chapter13 col-md-2 mt-2 ">
                                    <strong> <label>{{ __('Total') }}</label></strong>
                                </div>
                            </div>
                        </div>

                        <?php
                        $loans = [];
$clientPrimaryAddress = '';
if ($BasicInfoPartA) {
    $clientPrimaryAddress = $BasicInfoPartA->Address . ", " . $BasicInfoPartA->City . ", " . $BasicInfoPartA->zip . ", " . \App\Models\CountyFipsData::get_county_name_by_id($BasicInfoPartA->country);
}
$keyind = 1;

foreach ($mortgages as $k => $resident) {

    if ($resident['not_primary_address'] == 1) {
        $clientPrimaryAddress = $resident['mortgage_address'] . ", " . $resident['mortgage_city'] . ", " . $resident['mortgage_state'] . ", " . $resident['mortgage_zip'];
    }
    $loan1 = json_decode($resident['home_car_loan'], 1);
    $loan2 = json_decode($resident['home_car_loan2'], 1);
    $loan3 = json_decode($resident['home_car_loan3'], 1);
    if (isset($resident['loan_own_type_property']) && $resident['loan_own_type_property'] == 1) {
        $loans = ['loan1' => $loan1];
    }
    if (isset($loan2['additional_loan1']) && $loan2['additional_loan1'] == 1) {
        $loans['loan2'] = $loan2;
    }
    if (isset($loan3['additional_loan2']) && $loan3['additional_loan2'] == 1) {
        $loans['loan3'] = $loan3;
    }

    if (!empty($loans)) {
        ?>
                        <div class="chapter13 col-md-12 headingpm">
                            Property Address: {{ $clientPrimaryAddress }}
                            <input type="hidden" name="resident_property_{{$keyind}}"
                                value="<?php echo Helper::validate_key_value('resident_property_' . $keyind, $chapterPlanData); ?>">
                        </div>
                        <?php $mindex = 1;
        foreach ($loans as $loan) { ?>
                        <div class="chapter13 col-md-12 mb-2">
                            <div class="chapter13 row">

                                <div class="chapter13 col-md-2 mt-2">
                                    <span class="text-underline creditors">Mortgage {{$mindex}}</span>
                                    <span class="creditors">
                                        {{$loan['creditor_name']}} </span>
                                </div>
                                <input type="hidden" name="resident_mortgage_{{$mindex}}_{{$keyind}}"
                                    value="<?php echo Helper::validate_key_value('resident_mortgage_' . $mindex . '_' . $keyind, $chapterPlanData) ?? $loan['creditor_name']; ?>">

                                <div class="chapter13 col-md-2 mt-2">
                                    <div class="chapter13 form-group d-flex">

                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <div class="chapter13 input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text"
                                                class="form-control mortgage-monthly-payments price-field full-text required"
                                                name="mortgage_monthly_pay{{$mindex}}_{{$keyind}}"
                                                value="<?php echo Helper::priceFormtWithComma($chapterPlanData['mortgage_monthly_pay' . $mindex . '_' . $keyind] ?? (Helper::validate_key_value('monthly_payment', $loan) ? Helper::validate_key_value('monthly_payment', $loan) : 0.00)); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="chapter13 col-md-4 mt-2">
                                    <div class="chapter13 payment-box">
                                        <div class="chapter13 form-group d-flex">

                                            <div class="chapter13 input-groups d-flex ml-2">
                                                <div class="chapter13 input-group-prepends h20">
                                                    <span class="input-group-text basic-addon1">$</span>
                                                </div>
                                                <input type="text" readonly
                                                    class="form-control price-field full-text required"
                                                    name="mortgage_due{{$mindex}}_{{$keyind}}"
                                                    value="<?php echo Helper::priceFormtWithComma($chapterPlanData['mortgage_due' . $mindex . '_' . $keyind] ?? ((Helper::validate_key_value('due_payment', $loan)) ? Helper::validate_key_value('due_payment', $loan) : 0.00)); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="chapter13 col-md-2 mt-2 ">
                                    <div class="chapter13 form-group d-flex">
                                        <?php

                            $pr = 60;
            $pr = (isset($chapterPlanData['mortgage_payment_remaining_' . $mindex . '_' . $keyind]) && !empty($chapterPlanData['mortgage_payment_remaining_' . $mindex . '_' . $keyind])) ? $chapterPlanData['mortgage_payment_remaining_' . $mindex . '_' . $keyind] : $pr;
            ?>
                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <select data-mor="{{$mindex}}" data-property="{{$keyind}}" class="form-control mortgage_payment-remaining-number"
                                                name="mortgage_payment_remaining_{{$mindex}}_{{$keyind}}">
                                                <?php foreach (range(1, 60) as $no) { ?>
                                                <option <?php echo $no == $pr ? "selected" : ''; ?>
                                                    value="<?php echo $no; ?>"><?php echo $no; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="chapter13 col-md-2 mt-2 ">
                                    <div class="chapter13 form-group d-flex">

                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <div class="chapter13 input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" readonly
                                                class="form-control price-field full-text required mortgage-payment-total"
                                                name="mortgage_total{{$mindex}}_{{$keyind}}"
                                                value="<?php echo Helper::validate_key_value('mortgage_total' . $mindex . '_' . $keyind, $chapterPlanData); ?>">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="chapter13 col-md-2 mt-3 mb-3">
                            <label class="treatm">
                                {{ __('Plan Treatment') }} </label>
                        </div>
                        <?php
                                    $pr = (isset($chapterPlanData['plan_first_' . $mindex . '_' . $keyind]) && !empty($chapterPlanData['plan_first_' . $mindex . '_' . $keyind])) ? $chapterPlanData['plan_first_' . $mindex . '_' . $keyind] : null;
            ?>

                        <div class="chapter13 col-md-2 mt-2 mb-3 flx_cs_add">
                            <div class="chapter13 form-group d-flex">
                                <div class="chapter13 input-groups d-flex ml-2">
                                    <select class="planselection form-control" name="plan_first_{{$mindex}}_{{$keyind}}">
                                        <?php  echo Helper::planTreatmentFirstSelection($pr); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="chapter13 col-md-4 mt-2 pr-0 mb-3 flx_cs_add">
                            <div class="chapter13 form-group d-flex">
                                <?php

            $pr = (isset($chapterPlanData['plan_second_' . $mindex . '_' . $keyind]) && !empty($chapterPlanData['plan_second_' . $mindex . '_' . $keyind])) ? $chapterPlanData['plan_second_' . $mindex . '_' . $keyind] : null;
            ?>
                                <div class="chapter13 input-groups  ml-2">
                                <small>&nbsp;</small>
                                    <select class="planselection form-control" name="plan_second_{{$mindex}}_{{$keyind}}">
                                        <?php  echo Helper::planTreatmentSecondSelection($pr); ?>
                                    </select>
                                </div>

                                <div class="chapter13 input-groups ml-2">
                                    <small>{{ __('Int. Rate:') }}</small><br>
                                    <input type="text" class="pt_ir w-perce form-control price-field required"
                                        name="pt_past_due_ir_{{$mindex}}_{{$keyind}}"
                                        value="<?php echo Helper::validate_key_value('pt_past_due_ir_' . $mindex . '_' . $keyind, $chapterPlanData); ?>"> %
                                </div>
                                <div class="chapter13 input-groups ml-2">
                                    <small>{{ __('Payment per month:') }}</small><br>
                                    $<input type="text" class="pt_interest w-perceo form-control price-field required"
                                        name="pt_past_due_interest_{{$mindex}}_{{$keyind}}"
                                        value="<?php echo Helper::validate_key_value('pt_past_due_interest_' . $mindex . '_' . $keyind, $chapterPlanData); ?>">
                                </div>

                                <?php
            $pr = 60;
            $pr = (isset($chapterPlanData['pt_past_due_term_' . $mindex . '_' . $keyind]) && !empty($chapterPlanData['pt_past_due_term_' . $mindex . '_' . $keyind])) ? $chapterPlanData['pt_past_due_term_' . $mindex . '_' . $keyind] : $pr;
            ?>
                                <div class="chapter13 input-groups ml-2">
                                    <small>{{ __('Plan Term:') }}</small></br>
                                    <select class="pterm form-control" name="pt_past_due_term_{{$mindex}}_{{$keyind}}">
                                        <?php foreach (range(1, 84) as $no) { ?>
                                        <option <?php echo $no == $pr ? "selected" : ''; ?> value="<?php echo $no; ?>">
                                            <?php echo $no; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--div class="chapter13 col-md-2 mt-2 mb-3 flx_cs_add">
                            <div class="chapter13 form-group d-flex">

                                <?php

                           /* $pr = 60;

                            $pr = (isset($chapterPlanData['pt_past_due_termsecond_' . $mindex . '_' . $keyind]) && !empty($chapterPlanData['pt_past_due_termsecond_' . $mindex . '_' . $keyind])) ? $chapterPlanData['pt_past_due_termsecond_' . $mindex . '_' . $keyind] : $pr;
                            ?>
            <div class="chapter13 input-groups d-flex ml-2">
                <select class="form-control" name="pt_past_due_termsecond_{{$mindex}}_{{$keyind}}">
                    <?php foreach (range(1, 60) as $no) { ?>
                    <option <?php echo $no == $pr ? "selected" : ''; ?> value="<?php echo $no; ?>">
                        <?php echo $no; ?></option>
                    <?php } */?>
                                    </select>
                                </div>
                            </div>
                        </div-->
                        
                        <div class="chapter13 col-md-4 mt-2 mb-3 flx_cs_add">
                            <div class="chapter13 form-group d-flex">

                                <div class="chapter13 input-groups d-flex ml-2">
                                    <div class="chapter13 input-group-prepends h20">
                                        <span class="input-group-text basic-addon1">{{ __('Total Inside Plan: $') }}</span>
                                    </div>
                                    <input type="text" class="form-control price-field full-text required"
                                        name="pt_mortgage_total_{{$mindex}}_{{$keyind}}"
                                        value="<?php echo Helper::validate_key_value('pt_mortgage_total_' . $mindex . '_' . $keyind, $chapterPlanData); ?>">
                                </div>
                            </div>
                        </div>

                        <?php $mindex++;
        } ?>

                        <?php $keyind++;
    }
} ?>
                    </div>
                </div>

                <div class="chapter13 col-md-12 mt-3">
                    <?php if (count($vehicleMortgage) > 0) { ?>
                    <div class="chapter13 row no-border-elements">
                        <div class="chapter13 col-md-12">
                            <h5 class="mt-2 payment-mtgr">{{ __('Vehicle Loans:') }}</h5>
                        </div>
                        <div class="chapter13 col-md-12  mb-2 headingpm">
                            <div class="chapter13 row">
                                <div class="chapter13 col-md-2 mt-2 ">
                                    <strong> {{ __('Vehicle Name / Creditor') }}</strong>
                                </div>

                                <div class="chapter13 col-md-2 mt-2  pr-0">
                                    <strong>Monthly Payment</strong>
                                </div>
                                <div class="chapter13 col-md-4 mt-2 ">
                                    <strong>{{ __('Past due') }}</strong>
                                </div>
                                <div class="chapter13 col-md-2 mt-2  pr-0">
                                    <strong>Remaining Payments</strong>
                                </div>

                                <div class="chapter13 col-md-2 mt-2 ">
                                    <strong>Total</strong>
                                </div>

                            </div>
                        </div>
                        <?php $countVehicle = 0;
                        $veh = 1;
                        $recnal = 1;
                        ?>
                        <?php foreach ($vehicleMortgage as $key => $mortgage) {



                            $vehicle_loan = [];
                            if (($mortgage->vehicle_car_loan) != null) {
                                $vehicle_loan[] = json_decode($mortgage->vehicle_car_loan);
                                $vehicle_obj = $vehicle_loan[0];
                            }
                            ?>
                        <div class="chapter13 col-md-12 mb-2">
                            <div class="chapter13 row">

                                <div class="chapter13 col-md-12 headingpm pr-0">
                                    <?php  $vehicleType = Helper::VEHICLE_CARS_TK;
                            if ($mortgage->property_type == Helper::VEHICLE_RECREATINAL_VEHICLE) {
                                $vehicleType = 'Recreational ' . $recnal;
                                echo ' <span style="font-size:10px;"><strong>' . $vehicleType . ':&nbsp;</strong></span>';
                            } ?>
                                    <?php if ($mortgage->property_type == Helper::VEHICLE_CARS_TK) {
                                        $vehicleType = 'Vehicle ' . $veh;
                                        echo ' <span style="font-size:10px;"><strong>' . $vehicleType . ':&nbsp;</strong></span>';
                                    }
                            $vehicleName = $mortgage->property_make . ', ' . $mortgage->property_model;
                            $vehicleNameTobeSave = $vehicleType;
                            $vehicleNameTobeSave .= ', ' . $mortgage->property_year;
                            $vehicleNameTobeSave .= ', ' . $mortgage->property_make;
                            $vehicleNameTobeSave .= ', ' . $mortgage->property_model;
                            $vehicleNameTobeSave .= ', ' . $mortgage->property_mileage;
                            $vehicleNameTobeSave .= ', ' . $mortgage->property_other_info;
                            if (!empty($mortgage->vin_number)) {
                                $vehicleNameTobeSave .= ', Vin # ' . $mortgage->vin_number;
                            }
                            $creditorname = isset($vehicle_obj->creditor_name) && !empty($vehicle_obj->creditor_name) ? $vehicle_obj->creditor_name : 'Unknown Creditor';
                            ?>
                                    <span class="">{{$vehicleName}}</span>
                                    <input type="hidden" name="vehicle_name_{{$countVehicle}}"
                                        value="<?php echo $vehicleNameTobeSave ?>">
                                    <input type="hidden" name="vehicle_type_{{$countVehicle}}"
                                        value="{{$mortgage->property_type}}">
                                </div>
                                <div class="chapter13 col-md-2 mt-2 pr-0">

                                    <span class="creditors mt-2">Creditor: {{$creditorname}} </span>
                                    <input type="hidden" name="vehicle_creditor_{{$countVehicle}}"
                                        value="<?php echo $creditorname ?>">
                                </div>

                                <div class="chapter13 col-md-2 mt-2 ">
                                    <div class="chapter13 form-group d-flex">

                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <div class="chapter13 input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text"
                                                class="form-control price-field full-text required monthly-payments"
                                                name="monthly_payment_{{$countVehicle}}"
                                                value="<?php echo $chapterPlanData['monthly_payment_' . $countVehicle] ?? ($vehicle_obj->monthly_payment); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="chapter13 col-md-4 mt-2 ">
                                    <div class="chapter13 form-group d-flex">
                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <div class="chapter13 input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" readonly
                                                class="auto_past_due form-control price-field full-text required"
                                                name="past_due_{{$countVehicle}}"
                                                value="<?php echo Helper::priceFormtWithComma($chapterPlanData['past_due_' . $countVehicle] ?? ($vehicle_obj->past_due_amount)); ?>">
                                        </div>
                                    </div>
                                </div>


                                <div class="chapter13 col-md-2 mt-2 ">
                                    <div class="chapter13 form-group d-flex">
                                        <?php
                                $pr = $vehicle_obj->payment_remaining;
                            $pr = (isset($chapterPlanData['property_vehicle_payment_remaining_' . $countVehicle]) && !empty($chapterPlanData['property_vehicle_payment_remaining_' . $countVehicle])) ? $chapterPlanData['property_vehicle_payment_remaining_' . $countVehicle] : $pr;
                            ?>
                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <select data-veh="{{$countVehicle}}" class="form-control payment-remaining-number"
                                                name="property_vehicle_payment_remaining_{{$countVehicle}}">
                                                <?php foreach (range(1, 60) as $no) { ?>
                                                <option <?php echo $no == $pr ? "selected" : ''; ?>
                                                    value="<?php echo $no; ?>"><?php echo $no; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="chapter13 col-md-2 mt-2 ">
                                    <div class="chapter13 form-group d-flex">

                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <div class="chapter13 input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" readonly
                                                class="form-control price-field full-text required vehicle-payment-total"
                                                name="property_vehicle_payment_total_{{$countVehicle}}"
                                                value="<?php echo Helper::validate_key_value('property_vehicle_payment_total_' . $countVehicle, $chapterPlanData) ?? ($vehicle_obj->monthly_payment > 0 && $vehicle_obj->payment_remaining > 0 ? $vehicle_obj->monthly_payment * $vehicle_obj->payment_remaining : 0); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chapter13 col-md-2 mb-3 mt-3">
                            <label class="treatm"> {{ __('Plan Treatment') }} </label>
                        </div>
                     

                        <?php
                            $pr = (isset($chapterPlanData['vehicle_plan_first_' . $countVehicle]) && !empty($chapterPlanData['vehicle_plan_first_' . $countVehicle])) ? $chapterPlanData['vehicle_plan_first_' . $countVehicle] : null;
                            ?>

                        <div class="chapter13 col-md-2 mt-2 mb-3 flx_cs_add">
                            <div class="chapter13 form-group d-flex">
                                <div class="chapter13 input-groups d-flex ml-2">
                                    <select class="autoplanselection form-control" name="vehicle_plan_first_{{$countVehicle}}">
                                        <?php  echo Helper::planTreatmentFirstSelection($pr); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="chapter13 col-md-4 mt-2 mb-3 flx_cs_add">
                            <div class="chapter13 form-group d-flex">
                                <?php
                                        $pr = (isset($chapterPlanData['vehicle_plan_second_' . $countVehicle]) && !empty($chapterPlanData['vehicle_plan_second_' . $countVehicle])) ? $chapterPlanData['vehicle_plan_second_' . $countVehicle] : null;
                            ?>
                                <div class="chapter13 input-groups ml-2">
                                <small>&nbsp;</small><br>
                                    <select class="autoplanselection form-control" name="vehicle_plan_second_{{$countVehicle}}">
                                        <?php  echo Helper::planTreatmentSecondSelection($pr); ?>
                                    </select>
                                </div>

                                <div class="chapter13 input-groups  ml-2">
                                <small>{{ __('Int. Rate:') }}</small><br>
                                    <input type="text" class="autopt_ir w-perce form-control price-field required"
                                        name="pt_vehicle_past_due_ir_{{$countVehicle}}"
                                        value="<?php echo Helper::validate_key_value('pt_vehicle_past_due_ir_' . $countVehicle, $chapterPlanData); ?>"> %
                                </div>

                                <div class="chapter13 input-groups  ml-2">
                                <small>{{ __('Payment per month:') }}</small><br>
                                    $<input type="text" class="autopt_pd_interest w-perceo  form-control price-field required"
                                        name="pt_vehicle_past_due_interest_{{$countVehicle}}"
                                        value="<?php echo Helper::validate_key_value('pt_vehicle_past_due_interest_' . $countVehicle, $chapterPlanData); ?>">
                                </div>

                                <?php

                            $pr = 60;

                            $pr = (isset($chapterPlanData['pt_vehicle_past_due_term_' . $countVehicle]) && !empty($chapterPlanData['pt_vehicle_past_due_term_' . $mindex . '_' . $keyind])) ? $chapterPlanData['pt_vehicle_past_due_term_' . $mindex . '_' . $keyind] : $pr;
                            ?>
                                <div class="chapter13 input-groups ml-2">
                                <small>Plan Term:</small><br>
                                    <select class="autopterm form-control" name="pt_vehicle_past_due_term_{{$countVehicle}}">
                                        <?php foreach (range(1, 84) as $no) { ?>
                                        <option <?php echo $no == $pr ? "selected" : ''; ?> value="<?php echo $no; ?>">
                                            <?php echo $no; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        
                        <div class="chapter13 col-md-4 mt-2 mb-3 flx_cs_add">
                            <div class="chapter13 form-group d-flex">
                                <div class="chapter13 input-groups d-flex ml-2">
                                    <div class="chapter13 input-group-prepends h20">
                                        <span class="input-group-text basic-addon1">{{ __('Total Inside Plan: $') }}</span>
                                    </div>
                                    <input type="text" class="form-control price-field full-text required"
                                        name="pt_vehicle_total_{{$countVehicle}}"
                                        value="<?php echo Helper::validate_key_value('pt_vehicle_total_' . $countVehicle, $chapterPlanData); ?>">
                                </div>
                            </div>
                        </div>


                        <?php
                            if ($mortgage->property_type == Helper::VEHICLE_CARS_TK) {
                                $veh = $veh + 1;
                            }
                            if ($mortgage->property_type == Helper::VEHICLE_RECREATINAL_VEHICLE) {
                                $recnal = $recnal + 1;
                            }
                            $countVehicle = $countVehicle + 1;
                        } ?>

                    </div>
                    <?php } ?>

                </div>




                <div class="chapter13 col-md-6 mt-3">
                    <div class="chapter13 row no-border-elements">
                        <div class="chapter13 col-md-12">
                            <h5 class="mt-2 payment-mtgr">{{ __('Priority Debts:') }}</h5>
                        </div>
                    </div>

                    <div class="chapter13 row headingpm">
                        <div class="chapter13 col-md-3">
                            <span class=" creditors"> {{ __('Back Taxes') }} </span>
                        </div>
                        <div class="chapter13 col-md-4 pl-0 pr-0">
                            <span class=" creditors"> {{ __('Domestic Support Obligations') }}</span>
                        </div>
                        <div class="chapter13 col-md-3">
                            <span class="creditors"> {{ __('Student Loans') }} </span>
                        </div>
                        <div class="chapter13 col-md-2">
                            <span class=" creditors"> {{ __('Other') }} </span>
                        </div>
                       
                    </div>

                    <div class="chapter13 row">
                        <div class="chapter13 col-md-12 mb-2">
                            <div class="chapter13 row">

                                <div class="chapter13 col-md-3 mt-2">
                                    <div class="chapter13 form-group d-flex">

                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <div class="chapter13 input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" class="form-control price-field full-text required"
                                                id="claim_taxes" name="claim_taxes"
                                                value="<?php echo Helper::validate_key_value('claim_taxes', $chapterPlanData); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="chapter13 col-md-4 pl-0 pr-0 mt-2">
                                    <div class="chapter13 form-group d-flex">

                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <div class="chapter13 input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" class="form-control price-field full-text required"
                                                id="claim_obligations" name="claim_obligations"
                                                value="<?php echo Helper::validate_key_value('claim_obligations', $chapterPlanData); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="chapter13 col-md-3 mt-2">
                                    <div class="chapter13 form-group d-flex">
                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <div class="chapter13 input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" class="form-control price-field full-text required"
                                                id="claim_student_loans" name="claim_student_loans"
                                                value="<?php echo Helper::validate_key_value('claim_student_loans', $chapterPlanData); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="chapter13 col-md-2 mt-2">
                                    <div class="chapter13 form-group d-flex">
                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <div class="chapter13 input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" class="form-control price-field full-text required"
                                                id="claim_other" name="claim_other"
                                                value="<?php echo Helper::validate_key_value('claim_other', $chapterPlanData); ?>">
                                        </div>
                                    </div>
                                </div>

                               
                            </div>

                        </div>
                        <div class="chapter13 col-md-12 mt-3">
                            <label class="treatm">
                                {{ __('Plan Treatment:') }} </label>
                        </div>
                        <?php
                        $pr = (isset($chapterPlanData['pt_priority_debt_pt_first']) && !empty($chapterPlanData['pt_priority_debt_pt_first'])) ? $chapterPlanData['pt_priority_debt_pt_first'] : null;
?>

                        <div class="chapter13 col-md-3  mb-3 flx_cs_add">
                            <div class="chapter13 form-group d-flex">
                                <div class="chapter13 input-groups d-flex ml-2">
                                    <select class="form-control" name="pt_priority_debt_pt_first">
                                        <?php  echo Helper::planTreatmentFirstSelection($pr); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="chapter13 col-md-6 mb-3  flx_cs_add">
                            <div class="chapter13 form-group d-flex">
                                <?php

        $pr = (isset($chapterPlanData['pt_priority_debt_pt_second']) && !empty($chapterPlanData['pt_priority_debt_pt_second'])) ? $chapterPlanData['pt_priority_debt_pt_second'] : null;
?>
                                <div class="chapter13 input-groups ml-2">
                                <small>&nbsp;</small><br>
                                    <select class="form-control" name="pt_priority_debt_pt_second">
                                        <?php  echo Helper::planTreatmentSecondSelection($pr); ?>
                                    </select>
                                </div>

                                <div class="chapter13 input-groups ml-2">
                                <small>{{ __('Int. Rate:') }}</small><br>
                                    <input type="text" class="w-perce form-control price-field required"
                                        name="pt_priority_debt_pt_ir"
                                        value="<?php echo Helper::validate_key_value('pt_priority_debt_pt_ir', $chapterPlanData); ?>"> %
                                </div>

                                <?php

    $pr = 60;

$pr = (isset($chapterPlanData['pt_priority_debt_pt_term']) && !empty($chapterPlanData['pt_priority_debt_pt_term'])) ? $chapterPlanData['pt_priority_debt_pt_term'] : $pr;
?>
                                <div class="chapter13 input-groups ml-2">
                                <small>Plan Term:</small><br>
                                    <select class="form-control" name="pt_priority_debt_pt_term">
                                        <?php foreach (range(1, 84) as $no) { ?>
                                        <option <?php echo $no == $pr ? "selected" : ''; ?> value="<?php echo $no; ?>">
                                            <?php echo $no; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="chapter13 col-md-3 mb-3 flx_cs_add">
                            <div class="chapter13 form-group">
                                <small>{{ __('Total Inside Plan:') }}</small>
                                <div class="chapter13 input-groups d-flex ml-2">
                                    <div class="chapter13 input-group-prepends h20">
                                        <span class="input-group-text basic-addon1">$</span>
                                    </div>
                                    <input type="text" class="form-control price-field full-text required"
                                        name="pt_priority_debt_total"
                                        value="<?php echo Helper::validate_key_value('pt_priority_debt_total', $chapterPlanData); ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="chapter13 col-md-6 mt-3">
                    <div class="chapter13 row ">
                        <div class="chapter13 col-md-12">
                            <h5 class="mt-2 payment-mtgr">{{ __('Other Secured Debt Loans:') }}</h5>
                        </div>
                    </div>
                    <div class="chapter13 row no-border-elements  headingpm">

                        <div class="chapter13 col-md-4">
                            <span class="creditors">{{ __('Creditor Name:') }} </span>
                        </div>
                        <div class="chapter13 col-md-4">
                            <span class="creditors">{{ __('Past Due:') }}</span>
                        </div>
                        <div class="chapter13 col-md-4">
                            <span class="creditors">{{ __('Monthly Payments:') }} </span>
                        </div>
                    </div>
                    <div class="chapter13 row no-border-elements">
                   <?php $sec = 1;
foreach (range(1, 2) as $res) { ?>
                        <div class="chapter13 col-md-12 mb-2">
                            <div class="chapter13 row">
                                <div class="chapter13 col-md-4"></div>
                                <div class="chapter13 col-md-4 mt-2 flx_cs_add">

                                    <div class="chapter13 form-group d-flex">

                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <div class="chapter13 input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" class="form-control price-field full-text required"
                                                name="other_sec_past_due_{{$sec}}"
                                                value="<?php echo Helper::validate_key_value('other_sec_past_due_'.$sec, $chapterPlanData); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="chapter13 col-md-4 mt-2 flx_cs_add">
                                    <div class="chapter13 form-group d-flex">

                                        <div class="chapter13 input-groups d-flex ml-2">
                                            <div class="chapter13 input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text"
                                                class="form-control price-field full-text required monthly-payments"
                                                name="other_sec_monthly_pay_{{$sec}}"
                                                value="<?php echo Helper::validate_key_value('other_sec_monthly_pay_'.$sec, $chapterPlanData); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="chapter13 col-md-12 mt-3">
                            <label class="treatm">
                                {{ __('Plan Treatment:') }} </label>
                        </div>
                        <?php
         $pr = (isset($chapterPlanData['pt_other_sec_pt_first_'.$sec]) && !empty($chapterPlanData['pt_other_sec_pt_first_'.$sec])) ? $chapterPlanData['pt_other_sec_pt_first_'.$sec] : null;
    ?>

                        <div class="chapter13 col-md-3  mb-3 flx_cs_add">
                            <div class="chapter13 form-group d-flex">
                                <div class="chapter13 input-groups d-flex ml-2">
                                    <select class="form-control" name="pt_other_sec_pt_first_{{$sec}}">
                                        <?php  echo Helper::planTreatmentFirstSelection($pr); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="chapter13 col-md-6 mb-3  flx_cs_add">
                            <div class="chapter13 form-group d-flex">
                                <?php

            $pr = (isset($chapterPlanData['pt_other_sec_pt_second_'.$sec]) && !empty($chapterPlanData['pt_other_sec_pt_second_'.$sec])) ? $chapterPlanData['pt_other_sec_pt_second_'.$sec] : null;
    ?>
                                <div class="chapter13 input-groups ml-2">
                                <small>&nbsp;</small><br>
                                    <select class="form-control" name="pt_other_sec_pt_second_{{$sec}}">
                                        <?php  echo Helper::planTreatmentSecondSelection($pr); ?>
                                    </select>
                                </div>

                                <div class="chapter13 input-groups ml-2">
                                <small>{{ __('Int. Rate:') }}</small><br>
                                    <input type="text" class="w-perce form-control price-field required"
                                        name="pt_other_sec_pt_ir_{{$sec}}"
                                        value="<?php echo Helper::validate_key_value('pt_other_sec_pt_ir_'.$sec, $chapterPlanData); ?>"> %
                                </div>

                                <?php

        $pr = 60;

    $pr = (isset($chapterPlanData['pt_other_sec_pt_term_'.$sec]) && !empty($chapterPlanData['pt_other_sec_pt_term_'.$sec])) ? $chapterPlanData['pt_other_sec_pt_term_'.$sec] : $pr;
    ?>
                                <div class="chapter13 input-groups ml-2">
                                <small>Plan Term:</small><br>
                                    <select class="form-control" name="pt_other_sec_pt_term_{{$sec}}">
                                        <?php foreach (range(1, 84) as $no) { ?>
                                        <option <?php echo $no == $pr ? "selected" : ''; ?> value="<?php echo $no; ?>">
                                            <?php echo $no; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="chapter13 col-md-3 mb-3 flx_cs_add">
                            <div class="chapter13 form-group">
                                <small>{{ __('Total Inside Plan:') }}</small>
                                <div class="chapter13 input-groups d-flex ml-2">
                                    <div class="chapter13 input-group-prepends h20">
                                        <span class="input-group-text basic-addon1">$</span>
                                    </div>
                                    <input type="text" class="form-control price-field full-text required"
                                        name="pt_other_sec_pt_total_{{$sec}}"
                                        value="<?php echo Helper::validate_key_value('pt_other_sec_pt_total_'.$sec, $chapterPlanData); ?>">
                                </div>
                            </div>
                        </div>

                        <?php $sec++;
} ?>
                       
                       

                    </div>
                </div>
                <div class="chapter13 col-md-12 mt-3"></div>
                <div class="chapter13 col-md-12 d-flex mt-3">
                    <label class="mt-1">{{ __('Unsecured Non-Priority Debts (UGEN)') }}</label>
                    <div class="chapter13 input-group d-flex align-items-center">
                        <div class="chapter13 input-group-append">
                            <span class="input-group " id="basic-addon2">$</span>
                        </div>
                        <input name="ubsecured_nonpriority_debts" type="text"
                            value="<?php echo Helper::validate_key_value('ubsecured_nonpriority_debts', $chapterPlanData); ?>"
                            class="price-field form-control text-line">
                    </div>
                </div>


                <div class="chapter13 col-md-12 mt-1">
                    <label>{{ __('Inside Plan') }}</label>
                </div>
            </div>

            <div class="chapter13 row mt-3">
                <div class="chapter13 col-md-12">
                    <h5 class="payment-mtgr">{{ __('Plan Payments:') }}</h5>
                </div>
            </div>

            <div class="chapter13 row no-border-elements  headingpm">

                <div class="chapter13 col-md-3">
                    <span class="creditors">{{ __('Attorney Fee $:') }} </span>
                </div>
                <div class="chapter13 col-md-4">
                    <span class="creditors">{{ __('Interest to Unsecured Creditors:') }}</span>
                </div>
                <div class="chapter13 col-md-2">
                    <span class="creditors">{{ __('Liquidation:') }} </span>
                </div>
                <div class="chapter13 col-md-3">
                    <span class="creditors">{{ __('Trustee Fee:') }} </span>
                </div>

            </div>


            <div class="chapter13 row mb-3">
                <div class="chapter13 col-md-3  d-flex">
                    <div class="chapter13 input-groups d-flex ml-2">
                        <div class="chapter13 input-group-prepends h20">
                            <span class="input-group-text basic-addon1">$</span>
                        </div>
                        <input type="text" class="form-control price-field full-text required" name="attorney_fees"
                            value="<?php echo Helper::validate_key_value('attorney_fees', $chapterPlanData); ?>">
                    </div>
                </div>
                <div class="chapter13 col-md-4 d-flex align-items-center">
                    <div class="chapter13 input-groups d-flex ml-2">
                        <div class="chapter13 input-group-prepends h20">
                            <span class="input-group-text basic-addon1">$</span>
                        </div>
                        <input type="text" class="form-control price-field full-text required"
                            name="interest_to_unsecured_creditors"
                            value="<?php echo Helper::validate_key_value('interest_to_unsecured_creditors', $chapterPlanData); ?>">
                    </div>
                </div>
                <div class="chapter13 col-md-2  d-flex">
                    <span class="creditors mt-2"></span>
                    <div class="chapter13 input-group">
                        <input style="width:50px; min-width:50px; !important" readonly name="liquidation_percent" type="text" value="123"
                            class="full-text form-control"> %
                    </div>
                </div>

                <div class="chapter13 col-md-3 d-flex">
                    <div class="chapter13 input-groups d-flex ml-2">
                        <div class="chapter13 input-group-prepends h20">
                            <span class="input-group-text basic-addon1">$</span>
                        </div>
                        <input type="text" class="form-control price-field full-text required" name="trustee_fee"
                            value="<?php echo Helper::validate_key_value('trustee_fee', $chapterPlanData); ?>">
                    </div>
                </div>
            </div>
            <div class="chapter13 row mt-3">
                <div class="chapter13 col-md-2">
                    <div class="chapter13 input-group d-flex align-items-center">
                        <div class="chapter13 input-group-append">
                            <span class="input-group " id="basic-addon2">$</span>
                        </div>
                        <input name="total_fees" type="text"
                            value="<?php echo Helper::validate_key_value('total_fees', $chapterPlanData); ?>"
                            class="price-field total_fees form-control text-line">
                    </div>
                </div>
                <div class="chapter13 col-md-2 mt-2 ">
                    <div class="chapter13 form-group d-flex">
                        <label>{{ __('Plan term:') }}</label>
                        <?php

     $pr = 60;
$pr = (isset($chapterPlanData['plan_selected_term']) && !empty($chapterPlanData['plan_selected_term'])) ? $chapterPlanData['plan_selected_term'] : $pr;
?>
                        <div class="chapter13 input-groups d-flex ml-2">
                            <select class="stepupplanterm form-control" name="plan_selected_term">
                                <?php foreach (range(1, 84) as $no) { ?>
                                <option <?php echo $no == $pr ? "selected" : ''; ?> value="<?php echo $no; ?>">
                                    <?php echo $no; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="chapter13 col-md-7 mt-2 "></div>
            </div>

            <div class="chapter13 row mt-2">
                <?php
                $k = 0;
if (isset($chapterPlanData['stepup_price']) && !empty($chapterPlanData['stepup_price']) && is_array($chapterPlanData['stepup_price'])) {
    if (count($chapterPlanData['stepup_price']) > 0) {
        for ($k = 0; $k < count($chapterPlanData['stepup_price']); $k++) {
            ?>
                @include("attorney.official_form.step_ups")
                <?php } ?>
                <?php }
    } else {
        $k = 0; ?>
                @include("attorney.official_form.step_ups")
                <?php $k++;
    } ?>
                <div class="col-12 mt-3 p-0">
                    <button class="btn btn-primary shadow-2 rounded-0" onclick="addStepUpforms(); return false;">
                        {{ __('Add Step-up') }}
                    </button>
                    <i class="fas fa-trash fa-lg mb-2 mt-2 remove-other-names remove-btn text-danger cursor-pointer"
                        style="position: absolute;right: 40px;" onclick="remove_clone_box('steup_from')"></i><br />
                </div>
            </div>
        </div>
        </div>
    </section>
</form>

<style>
.width_max_content {
    width: max-content;
}

.rounded-0 {
    border-radius: 0 !important;
}

input.text-line {
    background-color: #efefef;
}

.select-box {
    margin-left: 45px;
}

.trustee {
    margin-top: 5px;
}

.treatm {
    font-weight: normal !important;
}

.btn-primary {
    color: #fff;
    background-color: #012cae;
    border-color: #012cae;
}

.btn-primary:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
}

.px-12 {
    font-size: 12px;
}

.text-danger {
    color: #dc3545 !important;
}
.steup_from:first-child{display:none;}
.cursor-pointer {
    cursor: pointer;
}

.float_right {
    float: right !important;
}

.w-perce {
    width: 40px;
    padding-left:0px;
}
.w-perceo {
    width: 80px;
    padding-left:0px;
}

.stepup_price{width:100px;}
span.steptext {
    margin-top: 2px;
    margin-left: 5px;
    font-weight: 500;
}
.w-hund {
    width: 150px;
}
.form-control{padding: 0.38rem 0.2rem;}
.btn-form {
    cursor: pointer;
    color: #000;
    border: 2px solid #012cae;
    background-color: #fff;
    padding: 10px;
    font-weight: 500 !important;
}
</style>
<script>
$(document).ready(function() {
    $(".total_fees").val($(".fi_schedule_j_line23c_monthly_net_income").val());
});
savechapterPlanDataInfoToDb = function() {
    var mt_form = $("#plan_info");
    var dataString1 = $(mt_form).serialize();
    var client_id = "<?php echo @$client_id; ?>";
    dataString1 += '&client_id=' + client_id;
    $.ajax({
        type: "POST",
        url: "<?php echo route('chapter_plan_popup_save'); ?>",
        data: dataString1,
        async: true,
        success: function() {
            $.systemMessage("Record Saved Successfully", 'alert--success', true);
        }
    });
}

resetChapterPlanPopup = function() {
    var client_id = "<?php echo $client_id; ?>";
    var url = "<?php echo route('chapter_plan_popup_reset'); ?>";
    laws.ajax(url, {
        client_id: client_id
    }, function(response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger');
        } else {
            $.systemMessage(res.msg, 'alert--success');
            planPopup();
        }
    });
}

$(document).ready(function() {
    calculateVehicleLoand();
    calculateMortages();
    calculateMortgagePlans();
    calculateAutoLoanPlans();
    $(".autopt_ir").each(function(){
        $(this).blur();
    });
    $(".pt_ir").each(function(){
        $(this).blur();
    });
    $(".auto_past_due").each(function(){
        $(this).blur();
    });
    calculateMortgageAndAutoLoanStepups();
});

remove_clone_box = function(box_class) {
    var ln = $(document).find("." + box_class).length;
    if (ln <= 1) {
        alert("You can not delete because min 1 entries require.");
        return false;
    } else {
        $(document).find("." + box_class).last().remove();
        var itm = $(document).find("." + box_class).last();
        var remove_btn_index = itm.find('button.remove_clone').data('index');
        if (remove_btn_index > 0) {
            itm.find('button.' + button_class).show();
        }
    }
}


addStepUpforms = function(price=0.00, month='', type=0) {
    var clnln = $(document).find(".steup_from").length;
    if (clnln > 19) {
        alert("You can only insert 20 items.");
        return false;
    }

    $('.remove-btn').show();
    var itm = $(document).find(".steup_from").last();
    var index_val = $(itm).index() + 1;
    var cln = $(itm).clone();
    var stepup_reason = cln.find('.stepup_reason');
    var stepup_price = cln.find('.stepup_price');
    
    $(stepup_reason).each(function() {
        $(this).attr('name', 'stepup_reason[' + index_val + ']');
        $(this).val(type);
    });
    $(stepup_price).each(function() {
        $(this).attr('name', 'stepup_price[' + index_val + ']');
        $(this).attr('value', price.toLocaleString());
        $(this).blur();
    });
    cln.find(".stepup_count").html(index_val);
    cln.find(".steptext").html(month);
    //cln.find('input[type="text"]').val('');
    //cln.find('select').val('');
    $(itm).after(cln);
}
calculateMortgagePlans = function(){
        $(".mortgage_payment-remaining-number").each(function() {
            var mortgage =  $(this).data("mor");
            var property =  $(this).data("property");
        
            var plan1 = $("select[name='plan_first_"+mortgage+"_"+property+"']").val();
            var plan2 = $("select[name='plan_second_"+mortgage+"_"+property+"']").val();
            var ir = $("input[name='pt_past_due_ir_"+mortgage+"_"+property+"']").val().replace(/,/g, '');

            var planterm = $("select[name='pt_past_due_term_"+mortgage+"_"+property+"']").val();
            var pt_total = $("input[name='pt_mortgage_total_"+mortgage+"_"+property+"']").val().replace(/,/g, '');

            var mort_m_pay = $("input[name='mortgage_monthly_pay"+mortgage+"_"+property+"']").val().replace(/,/g, '');
            var mortgage_due = $("input[name='mortgage_due"+mortgage+"_"+property+"']").val().replace(/,/g, '');
            var pt = 0; 
            var pt2 = 0;
            if(plan1 == "1"){
                pt =  (mort_m_pay*planterm);
            }
            if(plan1 == "2"){
                pt =  0;
            }
            if(plan2 == "1"){
                mortgage_due = parseFloat(mortgage_due);
                var rate_in_decomal = ir/100;
                rate_in_decomal = parseFloat(rate_in_decomal);
                planterm = parseFloat(planterm);
                if(rate_in_decomal > 0){
                    var above = (rate_in_decomal/12);
                    var res = (1+rate_in_decomal/12);
                    pt2 = mortgage_due*(above/(1- Math.pow(res,-planterm)));   
                    
                }else{
                    pt2 = (mortgage_due/planterm);
                }

                
                
            }
            if(plan2 == "2"){
                pt2 = 0;
            }
            $("input[name='pt_past_due_interest_"+mortgage+"_"+property+"']").val((parseFloat(pt2).toFixed(2)).toLocaleString());
            $("input[name='pt_past_due_interest_"+mortgage+"_"+property+"']").blur();
            pt2 = (pt2*planterm);
            var pt_total  = parseFloat(pt+pt2).toFixed(2);
            $("input[name='pt_mortgage_total_"+mortgage+"_"+property+"']").val(pt_total.toLocaleString());
            $("input[name='pt_mortgage_total_"+mortgage+"_"+property+"']").blur();
        });
    }

    $(".planselection").change(function(){
        calculateMortgagePlans();
        calculateMortgageAndAutoLoanStepups();
    });
    
    $(".pterm").change(function(){
        calculateMortgagePlans();
    });
    $(document).on("keyup", ".pt_ir,.mortgage-monthly-payments", function(evt) {
        calculateMortgagePlans();
    });


      calculateAutoLoanPlans = function(){
        $(".payment-remaining-number").each(function() {
            var loan =  $(this).data("veh");
            var plan1 = $("select[name='vehicle_plan_first_"+loan+"']").val();
            var plan2 = $("select[name='vehicle_plan_second_"+loan+"']").val();
            var ir = $("input[name='pt_vehicle_past_due_ir_"+loan+"']").val().replace(/,/g, '');
            var planterm = $("select[name='pt_vehicle_past_due_term_"+loan+"']").val();
            var loan_m_pay = $("input[name='monthly_payment_"+loan+"']").val().replace(/,/g, '');
            var past_due = $("input[name='past_due_"+loan+"']").val().replace(/,/g, '');
            var pt = 0; 
            var pt2 = 0;
            if(plan1 == "1"){
                pt =  (loan_m_pay*planterm);
            }
            if(plan1 == "2"){
                pt =  0;
            }
            if(plan2 == "1"){
                past_due = parseFloat(past_due);
                var rate_in_decomal = ir/100;
                rate_in_decomal = parseFloat(rate_in_decomal);
                planterm = parseFloat(planterm);
                if(rate_in_decomal > 0){
                    var above = (rate_in_decomal/12);
                    var res = (1+rate_in_decomal/12);
                    pt2 = past_due*(above/(1- Math.pow(res,-planterm)));  
                }
                
            }
            if(plan2 == "2"){
                pt2 = 0;
            }
            $("input[name='pt_vehicle_past_due_interest_"+loan+"']").val((parseFloat(pt2).toFixed(2)).toLocaleString());
            $("input[name='pt_vehicle_past_due_interest_"+loan+"']").blur();
            var pt_total  = parseFloat(pt+pt2).toFixed(2);
            $("input[name='pt_vehicle_total_"+loan+"']").val(pt_total.toLocaleString());
            $("input[name='pt_vehicle_total_"+loan+"']").blur();
        });
    }

    $(".autoplanselection").change(function(){
        calculateAutoLoanPlans();
        calculateMortgageAndAutoLoanStepups();
    });
    
    $(".autopterm").change(function(){
        calculateAutoLoanPlans();
    });
    $(document).on("keyup", ".autopt_ir,.monthly-payments", function(evt) {
        calculateAutoLoanPlans();
    });

    $(document).on("change", ".mortgage_payment-remaining-number,.payment-remaining-number", function(evt) {
       
        calculateMortgageAndAutoLoanStepups();
    });
    $(document).on("blur", ".total_fees,.mortgage-monthly-payments,.monthly-payments", function(evt) {
        calculateMortgageAndAutoLoanStepups();
    });
    

    $(document).on("change", ".stepupplanterm", function(evt) {
       
       if($(this).val() <60){
        alert("Plan term can not be less than 60.");
        $(this).val(60);
        return false;
       
       }else{
        calculateMortgageAndAutoLoanStepups();
       }
   });

    calculateMortgageAndAutoLoanStepups = function(){
        var globalplanTerm = $(".stepupplanterm").val();
        var stepupsProperty = [];
        var stepupsProperty = {
            properties: []
        };
        $('.steup_from').each(function(){
            var ln = $(document).find(".steup_from").length;
            if (ln <= 1) {
                return false;
            } else {
                
                $(document).find(".steup_from").last().remove();
            }
        });
      
        $(".mortgage_payment-remaining-number").each(function(){
             if($(this).val() < globalplanTerm){
                var mortgage =  $(this).data("mor");
                var property =  $(this).data("property");
                var plan1 = $("select[name='plan_first_"+mortgage+"_"+property+"']").val();
                if(plan1=='2'){
                    var monthly_pay = $("input[name='mortgage_monthly_pay"+mortgage+"_"+property+"']").val();
                    stepupsProperty.properties.push(
                        {
                            'monthly' : parseFloat(monthly_pay.replace(/,/g, '')),
                            'term' : parseInt($(this).val()),
                            'type' : 'mortgage',
                            'index' : mortgage+' of '+property
                        }
                    );
                   
                }
             }
        });

        $(".payment-remaining-number").each(function(){
             if($(this).val() < globalplanTerm){
                var loan =  $(this).data("veh");
               
                var plan1 = $("select[name='vehicle_plan_first_"+loan+"']").val();
                if(plan1=='2'){
                    var monthly_pay = $("input[name='monthly_payment_"+loan+"']").val();
                    stepupsProperty.properties.push(
                        {
                            'monthly' : parseFloat(monthly_pay.replace(/,/g, '')),
                            'term' : parseInt($(this).val()),
                            'type' : 'auto',
                            'index' : loan
                        }
                    );
                   
                }
             }
        });
        
        var stepups = {
            data: []
        };
        obj ={};
       // console.log(stepupsProperty);
        $(stepupsProperty.properties).each(function(index, value){
           // console.log(value);
            if(obj[value.term] != undefined){
               obj[value.term] = { 'month':value.term, 'price' : parseFloat(obj[value.term].price)+parseFloat(value.monthly), 'index':  obj[value.term].index+'|'+value.index ,'types' : obj[value.term].types+'|'+value.type};
            }else{
            obj[value.term] =  { 'month': value.term,'price' : value.monthly, 'index': value.index, 'types' : value.type};
        }
        });

        var indArr = [];
        $.each(obj, function(idx, oj) {
            indArr.push(idx);

        });
        
        var prev_price = parseFloat($(".total_fees").val().replace(/,/g, ''));
        var indxx = 0;
        $.each(obj, function(idx, oj) {
           
            var price = oj.price;
            var month = oj.month;
            var paidofftype = oj.types;
            price = price + prev_price;
            var types = paidofftype.split('|');
            var selectedType = 0;
            if(types.length > 1 && $.inArray('auto', types) >= 0 && $.inArray('mortgage', types) == -1){
                selectedType = 6;
            }
            if(types.length > 1 && $.inArray('auto', types) >= 0 && $.inArray('mortgage', types) >= 0){
                selectedType = 10;
            }
            if(types.length > 1 && $.inArray('auto', types) == -1 && $.inArray('mortgage', types) >= 0){
                selectedType = 9;
            }
            
            
            if(types.length == 1 && ($.inArray('auto', types) >= 0)){
                selectedType = oj.index;
                
            }

            if(types.length == 1 && $.inArray('mortgage', types) >=0 ){
                selectedType = 9;
            }
            var monthname = '';
            if(indArr[indxx+1] != undefined){
                monthname = "payments "+(parseInt(month)+1) +" thru "+ indArr[indxx+1];
            }else{
                var msxterm = $(".stepupplanterm").val();
                monthname = "payments "+(parseInt(month)+1) +" thru "+ parseInt(msxterm);
            }
         
            addStepUpforms(price, monthname, selectedType);
            prev_price =  price;
            indxx++;
        });
    }

</script>

@include("attorney.official_form.common_popup")