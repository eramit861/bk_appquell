
<div class="sign_up_bgs">
   <div class="container-fluid">
      <div class="row py-0 page-flex">
         <div class="col-md-12">
            <div class="form_colm row pt-40">
            <div class="col-md-12 align-right">
					<a href="javascript:void(0)" onclick="addNewResident('<?php echo $client_id;?>','<?php echo $report_id; ?>')" class="btn font-weight-bold border-black f-12">
						<i class="feather icon-plus"></i>
                        <x-singlespan class="card-title-text" spantext="Import this Creditor to New Residence"></x-singlespan>
					</a>
				</div>
               <div class="col-md-12 mb-3">
                  <div class="title-h mt-1 d-flex">
                     <h5><x-stronglabel label="Select Mortgage in which you want to import: " /></h5>
                  </div>
               </div>
              
             
               <div class="col-md-12">
                    <div class="row">
                    <?php
                    $i = 1;
					foreach ($propertyresident as $importdval) {
					    $propertName = '';
					    if ($importdval['not_primary_address'] == 0) {
					        $propertName = $clientAddress;
					    } else {
					        $propertName .= $importdval['mortgage_address'];
					        $propertName .= ', '.$importdval['mortgage_city'];
					        $propertName .= ', '.$importdval['mortgage_state'];
					        $propertName .= ', '.$importdval['mortgage_zip'];
					    }

					    $loan1 = '';
					    $loan2 = '';
					    $loan3 = '';
					    if (isset($importdval['currently_lived']) && $importdval['currently_lived'] && $importdval['loan_own_type_property'] == 1) {
					        $loan1 = json_decode($importdval['home_car_loan'], 1);
					        if (!empty($importdval['home_car_loan2'])) {
					            $loan2 = json_decode($importdval['home_car_loan2'], 1);
					            if (isset($loan2['additional_loan1']) && $loan2['additional_loan1'] == 0) {
					                $loan2 = '';
					            }
					        }

					        if (!empty($importdval['home_car_loan3'])) {
					            $loan3 = json_decode($importdval['home_car_loan3'], 1);
					            if (isset($loan3['additional_loan2']) && $loan3['additional_loan2'] == 0) {
					                $loan3 = '';
					            }
					        }
					    }

					    ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <h6 class="d-block"><strong>{{$i}}). Property Address:</strong> <?php echo $propertName; ?></h6>
                            <div class="d-inline radio-primary">
                                <?php $id = !empty($importdval['id']) ? $importdval['id'] : 0; ?>
                                <input onclick="propertyDImport('{{$id}}','mortgage1','{{$client_id}}')" id="mortgage1-{{$i}}" class="" type="radio" name="property[{{$i}}]" value="1"> 
                                <label for="mortgage1-{{$i}}" class="cr">{{ __('Mortgage 1') }}</label>
                            </div>
                            <?php if (!empty($loan1)) { ?>
                            <div class="d-inline radio-primary">
                                <input id="mortgage2-{{$i}}" onclick="propertyDImport('{{$id}}','mortgage2','{{$client_id}}')" class="" type="radio" name="property[{{$i}}]" value="2">  
                                <label for="mortgage2-{{$i}}" class="cr">{{ __('Mortgage 2') }}</label>
                            </div>
                            <?php } ?>
                            <?php if (!empty($loan2)) { ?>
                            <div class="d-inline radio-primary">
                                <input id="mortgage3-{{$i}}" onclick="propertyDImport('{{$id}}','mortgage3','{{$client_id}}')" type="radio" class="" name="property[{{$i}}]" value="3"> 
                                <label for="mortgage3-{{$i}}" class="cr">{{ __('Mortgage 3') }}</label>
                            </div>
                            <?php } ?>
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

     addNewResident = function(client_id, report_id)
     {
        laws.ajax('<?php echo route('manual_add_resident_form'); ?>', { client_id:client_id,report_id:report_id }, function (response) {
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