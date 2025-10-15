
<div class="sign_up_bgs">
   <div class="container-fluid">
      <div class="row py-0 page-flex">
         <div class="col-md-12">
            <div class="form_colm row">
            <div class="col-md-12 pt-40 align-right">
					<a href="javascript:void(0)" onclick="addNewVehicle('<?php echo $client_id;?>','<?php echo $report_id; ?>')" class="btn font-weight-bold border-black f-12">
						<i class="feather icon-plus"></i> 
						<span class="card-title-text">{{ __('Import this creditor to a New Vehicle') }}</span>
					</a>
				</div>
               <div class="col-md-12 mb-3">
                  <div class="title-h mt-1 d-flex">
                     <h5><strong>{{ __('Select Mortgage in which you want to import:') }} </strong></h5>
                  </div>
               </div>
               <div class="col-md-12">
                    <div class="row">
                    <?php
                    $i = 1;
					foreach ($propertyvehicle as $vehicle) {
					    $propertName = '';
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
                                <strong>{{$i}}).</strong><input onclick="propertyVehicleImport('{{$id}}','{{$client_id}}','{{$vehicle_name}}')" id="loan-{{$i}}" class="" type="radio" name="vehicle[{{$i}}]" value="1"> 
                                <label for="loan-{{$i}}" class="cr">{{$vehicle_name}}</label>
                            </div>
                        </div>
                    </div>
                <?php $i++;
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

    addNewVehicle = function(client_id, report_id)
     {
        laws.ajax('<?php echo route('manual_add_vehicle_form'); ?>', { client_id:client_id,report_id:report_id }, function (response) {
            if(isJson(response)){
            var res = JSON.parse(response);
                if (res.status == 0) {
                    $.systemMessage(res.msg, 'alert--danger', true);
                }else if(res.status == 1){
                    $.systemMessage(res.msg, 'alert--success', true);
                    $.facebox.close();
                }
            } else {
				laws.updateFaceboxContent(response,'xlarge-fb-width');
			}
    });
     }
</script>