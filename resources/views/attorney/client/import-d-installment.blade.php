
<div class="sign_up_bgs">
   <div class="container-fluid">
      <div class="row py-0 page-flex">
         <div class="col-md-12">
            <div class="form_colm row px-md-2 py-4">
               <div class="col-md-12 mb-3">
                  <div class="title-h mt-1 d-flex">
                     <h5>
                         <strong>{{ __('Select Mortgage in which you want to import:') }} </strong></h5>
                  </div>

               </div>
               <div class="col-md-12">
                    <div class="row">
                    <?php
                    $k = 1;
                    foreach ($propertyresident as $value) {
                        $inspropertName = '';
                        if ($value['not_primary_address'] == 0) {
                            $inspropertName = $clientAddress;
                        } else {
                            $inspropertName .= $value['mortgage_address'];
                            $inspropertName .= ', '.$value['mortgage_city'];
                            $inspropertName .= ', '.$value['mortgage_state'];
                            $inspropertName .= ', '.$value['mortgage_zip'];
                        }

                        $loan1 = '';
                        $loan2 = '';
                        $loan3 = '';
                        if (isset($value['currently_lived']) && $value['currently_lived'] && $value['loan_own_type_property'] == 1) {
                            $loan1 = json_decode($value['home_car_loan'], 1);
                            if (!empty($value['home_car_loan2'])) {
                                $loan2 = json_decode($value['home_car_loan2'], 1);
                                if (isset($loan2['additional_loan1']) && $loan2['additional_loan1'] == 0) {
                                    $loan2 = '';
                                }
                            }

                            if (!empty($value['home_car_loan3'])) {
                                $loan3 = json_decode($value['home_car_loan3'], 1);
                                if (isset($loan3['additional_loan2']) && $loan3['additional_loan2'] == 0) {
                                    $loan3 = '';
                                }
                            }
                        }

                        ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <h6 class="d-block"><strong>{{$k}}). Property Address:</strong> <?php echo $inspropertName; ?></h6>
                            <div class="d-inline radio-primary">
                                <?php $id = !empty($value['id']) ? $value['id'] : 0; ?>
                                <input onclick="propertyDImport('{{$id}}','mortgage1','{{$client_id}}')" id="mortgage1-{{$k}}" class="" type="radio" name="property[{{$k}}]" value="1"> 
                                <label for="mortgage1-{{$k}}" class="cr">{{ __('Mortgage 1') }}</label>
                            </div>
                            <?php if (!empty($loan1)) { ?>
                            <div class="d-inline radio-primary">
                                <input id="mortgage2-{{$k}}" onclick="propertyDImport('{{$id}}','mortgage2','{{$client_id}}')" class="" type="radio" name="property[{{$k}}]" value="2">  
                                <label for="mortgage2-{{$k}}" class="cr">{{ __('Mortgage 2') }}</label>
                            </div>
                            <?php } ?>
                            <?php if (!empty($loan2)) { ?>
                            <div class="d-inline radio-primary">
                                <input id="mortgage3-{{$k}}" onclick="propertyDImport('{{$id}}','mortgage3','{{$client_id}}')" type="radio" class="" name="property[{{$k}}]" value="3"> 
                                <label for="mortgage3-{{$k}}" class="cr">{{ __('Mortgage 3') }}</label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php $k++;
                    } ?>
            </div>
        </div>




        <div class="col-md-12 mb-3">
                  <div class="title-h mt-1 d-flex">
                     <h5><strong>{{ __('Select Vehicle for which you want to import:') }} </strong></h5>
                  </div>
               </div>
               <div class="col-md-12">
                    <div class="row">
                    <?php
                    $k = 1;
                    foreach ($propertyvehicle as $vehicle) {
                        $inspropertName = '';
                        if ($vehicle['own_any_property'] && $vehicle['loan_own_type_property'] == 1 && isset($vehicle['vehicle_car_loan'])) {
                            $loan = json_decode($vehicle['vehicle_car_loan'], 1);
                        }
                        $vehicle_name = ArrayHelper::getVehiclesArray($vehicle['property_type']);
                        $vehicle_name .= ', '.$vehicle['property_year'];
                        $vehicle_name .= ', '.$vehicle['property_make'];
                        $vehicle_name .= ', '.$vehicle['property_model'];
                        $vehicle_name .= ', '.$vehicle['property_mileage'];
                        $vehicle_name .= ', '.$vehicle['property_other_info'];
                        ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div style="display:inline-flex;" class="radio-primary">
                                <?php $id = !empty($vehicle['id']) ? $vehicle['id'] : 0; ?>
                                <strong>{{$k}}).</strong><input onclick="propertyVehicleImport('{{$id}}','{{$client_id}}','{{$vehicle_name}}')" id="loan-{{$k}}" class="" type="radio" name="vehicle[{{$k}}]" value="1"> 
                                <label for="loan-{{$k}}" class="cr">{{$vehicle_name}}</label>
                            </div>
                            
                        </div>
                    </div>

                <?php $k++;
                    } ?>
            </div>
        </div>


    </div>
</div>
</div>
</div>
</div>
<style>
    .d-inline.radio-primary {
    background: #f0f0f0;
    padding: 10px;
    margin-right: 20px;
    line-height: 45px;
    color: #000;
    border: 2px solid #012cae;
    border-radius: 6px;
    font-weight: bold;
}
input[type="radio"] {
width: 18px;
height: 18px;
vertical-align: middle;
margin: 0 4px;
}
    </style>
<script>
	propertyDImport = function(propertyIndex, mortgage, client_id){
		if (!confirm('Are you sure you want to import this creditor to '+mortgage+'?')) {
            $("input[type=radio]").prop("checked", false);
            return;
    }
	var report_id = '<?php echo $report_id; ?>';
	var url = "<?php echo route('import_schedule_d'); ?>";
	laws.ajax(url, { propertyIndex: propertyIndex,mortgage:mortgage,client_id:client_id,report_id:report_id }, function (response) {
        var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, 'alert--success', true);
                $.facebox.close();
            }
    });
	}
</script>

<style>
    .d-inline.radio-primary {
    background: #f0f0f0;
    padding: 10px;
    margin-right: 20px;
    line-height: 45px;
    color: #000;
    border: 2px solid #012cae;
    border-radius: 6px;
    font-weight: bold;
}
input[type="radio"] {
width: 18px;
height: 18px;
vertical-align: middle;
margin: 0 4px;
}
    </style>
<script>
	propertyVehicleImport = function(propertyIndex, client_id,vehiclename){
		if (!confirm('Are you sure you want to import this creditor to '+vehiclename+'?')) {
            $("input[type=radio]").prop("checked", false);
            return;
    }
	var report_id = '<?php echo $report_id; ?>';
	var url = "<?php echo route('import_schedule_d_vehicle'); ?>";
	laws.ajax(url, { propertyIndex: propertyIndex,client_id:client_id,report_id:report_id }, function (response) {
        var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, 'alert--success', true);
                $.facebox.close();
            }
    });
	}
</script>