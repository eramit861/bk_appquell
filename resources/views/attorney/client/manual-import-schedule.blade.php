<div class="modal-content modal-content-div">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100 py-1" id="invitemodalLabel">
            <i class="bi bi-person-plus-fill me-2"></i> Add Creditor
        </h5>
    </div>
    <div class="modal-body p-0">
        <div class="card-body min-height b-0-i">
            <div class="light-gray-div mt-3">
                <h2>Creditor details</h2>
                <div class="row gx-3">
                    
                    <div class="col-12">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <label class="">Search Creditor</label>
                                <input type="text" autocomplete="off" autocomplete  class="input_capitalize autocomplete common_creditors_auto_complete form-control mb-4" placeholder="{{ __('Search Creditor') }}" name="name" id="name">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <label class="">Street Address</label>
                                <input type="text" class="input_capitalize form-control mb-4" placeholder="{{ __('Street Address') }}" name="street" id="street">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <label class="">City</label>
                                <input type="text" class="input_capitalize form-control mb-4" placeholder="{{ __('City') }}" name="city" id="city">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <label class="">State</label>
                                <select class="form-control state" name="state" id="state">
                                    <option value="">{{ __('Please Select State') }}</option>
                                    {!! AddressHelper::getStatesList() !!}
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class  ="col-3">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <label class="">Zip</label>
                                <input type="text" class="form-control mb-4 allow-5digit" placeholder="Zip" name="zip" id="zip">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <label class="">Last 4 Digits of Account #</label>
                                <input type="text" class="form-control mb-4 allow-4digit allow_numeric" placeholder="Last 4 Digits of Account #:" name="account" id="account">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <label class="">Date Incurred</label>
                                <input type="text" class="form-control mb-4 date_month_year required" name="date_incurred" id="date_incurred" placeholder="{{ __('MM/YYYY') }}" value="">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <label class="">Total Due</label>
                                <input type="number" class="form-control price-field required" id="amount" name="amount" placeholder="{{ __('Total Due') }}" value="">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="label-div">
                            <div class="form-group mb-0 change-schedule">
                                <label class="">Schedule</label>
                                <select onchange="changeSchedule(this)" class="form-control required mb-4 import_to_schedule"  name="import_to_schedule" id="import_to_schedule">
                                    <option value="">{{ __('Select Schedule') }}</option>
                                    <option value="Mortgage">{{ __('D - Mortgage') }}</option>
                                    <option value="Auto">{{ __('D - Auto') }}</option>
                                    <option value="Installment Loan">{{ __('D - Installment Loan') }}</option>

                                    <option value="State Taxes">{{ __('E - State Taxes') }}</option>
                                    <option value="Federal Taxes">{{ __('E - Federal Taxes') }}</option>
                                    <option value="DSO">{{ __('E - DSO') }}</option>
                                    <option value="F Debt Tab">{{ __('F - Debt Tab') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 hide-data import-manual-client">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <label class="">Credit Type</label>
                                <select  class="form-control hide-data required import-manual-client"  name="credit_type_selection" id="credit_type_selection">
                                    <option value="">{{ __('Select Credit Type') }}</option>
                                    {!! AddressHelper::getDebtSelectionList() !!}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-4 align-right import-manual-client hide-data">
                        <a href="javascript:void(0)" onclick="manualImportCreditor()" class="btn btn-primary">                                
                            <span class="card-title-text">{{ __('Import Creditor') }}</span>
                        </a>

                    </div>

                </div>
            </div>

            <div class="bottom-btn-div">
                <a href="javascript:void(0)" onclick="importRest()" class="import-rest hide-data btn-new-ui-default cursor-pointer">{{ __('Submit') }}</a>
            </div>

            <!-- resident_schedule hide-data -->
            <div class="resident_schedule hide-data light-gray-div my-3 mt-4 questionnaire">
                <h2 style="font-size: 16px;">Select Mortgage in which you want to import</h2>
                <div class="delete-div">
                    <a href="javascript:void(0)" onclick="addNewResident('{{ $client_id }}',0)" class="btn-new-ui-default py-1 px-2">
                        <i class="feather icon-plus"></i>
                        <span class="card-title-text">{{ __('Add New Residence') }}</span>
                    </a>
                </div>
                <div class="row gx-3">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($propertyresident as $manualval)
                        @php
                            $propertName = '';
                            if ($manualval['not_primary_address'] == 0) {
                                $propertName = $clientAddress;
                            } else {
                                $propertName .= $manualval['mortgage_address'];
                                $propertName .= ', '.$manualval['mortgage_city'];
                                $propertName .= ', '.$manualval['mortgage_state'];
                                $propertName .= ', '.$manualval['mortgage_zip'];
                            }

                            $loan1 = '';
                            $loan2 = '';
                            $loan3 = '';
                            if (isset($manualval['currently_lived']) && $manualval['currently_lived'] && $manualval['loan_own_type_property'] == 1) {
                                $loan1 = json_decode($manualval['home_car_loan'], 1);
                                if (!empty($manualval['home_car_loan2'])) {
                                    $loan2 = json_decode($manualval['home_car_loan2'], 1);
                                    if (isset($loan2['additional_loan1']) && $loan2['additional_loan1'] == 0) {
                                        $loan2 = '';
                                    }
                                }

                                if (!empty($manualval['home_car_loan3'])) {
                                    $loan3 = json_decode($manualval['home_car_loan3'], 1);
                                    if (isset($loan3['additional_loan2']) && $loan3['additional_loan2'] == 0) {
                                        $loan3 = '';
                                    }
                                }
                            }
                        @endphp
                        <div class="col-12 {{ $i == 1 ? 'mt-2' : '' }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="d-block"><strong>{{$i}}. Property Address:</strong> {{ $propertName }}</label>
                                    <div class="d-inline-flex radio-primary">
                                        @php $id = !empty($manualval['id']) ? $manualval['id'] : 0; @endphp
                                        <input onclick="propertyDImport('{{$id}}','mortgage1','{{$client_id}}')" id="mortgage1-{{$i}}" class="" type="radio" name="property[{{$i}}]" value="1">
                                        <label for="mortgage1-{{$i}}" class="cr">{{ __('Mortgage 1') }}</label>
                                    </div>
                                    @if (!empty($loan1))
                                    <div class="d-inline-flex radio-primary ml-2">
                                        <input id="mortgage2-{{$i}}" onclick="propertyDImport('{{$id}}','mortgage2','{{$client_id}}')" class="" type="radio" name="property[{{$i}}]" value="2">
                                        <label for="mortgage2-{{$i}}" class="cr">{{ __('Mortgage 2') }}</label>
                                    </div>
                                    @endif
                                    @if (!empty($loan2))
                                    <div class="d-inline-flex radio-primary ml-2">
                                        <input id="mortgage3-{{$i}}" onclick="propertyDImport('{{$id}}','mortgage3','{{$client_id}}')" type="radio" class="" name="property[{{$i}}]" value="3">
                                        <label for="mortgage3-{{$i}}" class="cr">{{ __('Mortgage 3') }}</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php $i++; @endphp
                    @endforeach
                </div>
            </div>

            <div class="auto_schedule hide-data light-gray-div my-3 mt-4 questionnaire">
                <h2 style="font-size: 16px;">Select Vehicle for which you want to import</h2>
                <div class="delete-div">
                    <a href="javascript:void(0)" onclick="addNewVehicle('{{ $client_id }}',0)" class="btn-new-ui-default py-1 px-2">
                        <i class="feather icon-plus"></i>
                        <span class="card-title-text">{{ __('Add New Vehicle') }}</span>
                    </a>
                </div>
                <div class="row gx-3">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($propertyvehicle as $vehicle)
                        @php
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
                        @endphp
                        <div class="col-12 {{ $i == 1 ? 'mt-2' : '' }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <div style="display:inline-flex;" class="radio-primary">
                                        @php $id = !empty($vehicle['id']) ? $vehicle['id'] : 0; @endphp
                                        <label for="loan-{{$i}}" class="cr">
                                            <strong>{{$i}}</strong>
                                            <input onclick="propertyVehicleImport('{{$id}}','{{$client_id}}','{{$vehicle_name}}')" id="loan-{{$i}}" class="" type="radio" name="vehicle[{{$i}}]" value="1">
                                            {{$vehicle_name}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $i++; @endphp
                    @endforeach
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
#facebox .content.medium-fb-width {
    /* max-width: 779px !important; */
}
    </style>
<script>
      initializeDatepicker();

importRest = function(){
    var client_id = '{{ $client_id }}';
    var selected_schedule = $("#import_to_schedule").val();
    if(selected_schedule == ''){
        return;
    }
    var name = $.trim($("#name").val());
    var street = $.trim($("#street").val());
    var city = $.trim($("#city").val());
    var state = $.trim($("#state").val());
    var zip = $.trim($("#zip").val());
    var account = $.trim($("#account").val());
    var amount = $.trim($("#amount").val());
    var date_incurred = $.trim($("#date_incurred").val());

    var data = {
        import_type:selected_schedule,
        client_id:client_id,
        name:name,
        street:street,
        city:city,
        state:state,
        zip:zip,
        account:account,
        amount:amount,
        date_incurred:date_incurred,
        manual:true
    };

    if (name == '' || street == '' || city == '' || state =='' || zip=='' || date_incurred=='' || account =='') {
        $.systemMessage('Name, Street, City, State, Zip, Date and Acct # are required', 'alert--danger', true);
        return;
    }
    if (!confirm('Are you sure you want to import this creditor to '+selected_schedule+'?')) {
        $("input[type=radio]").prop("checked", false);
        return;
    }


	var url = "{{ route('manual_save_creditors') }}";
	laws.ajax(url, data, function (response) {
		if(isJson(response)){
		var res = JSON.parse(response);
            if (res.status == 0) {
				$.systemMessage(res.msg, 'alert--danger', true);
            }else if(res.status == 1){
				$.systemMessage(res.msg, 'alert--success', true);
				$.facebox.close();
			}
		}
		});
}

    changeSchedule = function(obj){
        if(obj.value == 'Mortgage') {
            $(".auto_schedule").addClass('hide-data');
            $(".resident_schedule").removeClass('hide-data');
            $(".import-rest").addClass("hide-data");
        }else if(obj.value == 'Auto'){
            $(".resident_schedule").addClass('hide-data');
            $(".auto_schedule").removeClass('hide-data');
            $(".import-rest").addClass("hide-data");
        }else if(obj.value == 'Installment Loan'){
            $(".auto_schedule").removeClass('hide-data');
            $(".resident_schedule").removeClass('hide-data');
            $(".import-rest").addClass("hide-data");
        }else{
            $(".import-rest").removeClass("hide-data");
            $(".auto_schedule").addClass('hide-data');
            $(".resident_schedule").addClass('hide-data');
        }

    }
	propertyDImport = function(propertyIndex, mortgage, client_id){


    var name = $("#name").val();
    var street = $("#street").val();
    var city = $("#city").val();
    var state = $("#state").val();
    var zip = $("#zip").val();
    var account = $("#account").val();
    var amount = $("#amount").val();
    var date_incurred = $("#date_incurred").val();

    var data = {
        propertyIndex: propertyIndex,
        mortgage:mortgage,
        client_id:client_id,
        name:name,
        street:street,
        city:city,
        state:state,
        zip:zip,
        account:account,
        amount:amount,
        date_incurred:date_incurred,
        manual:true
    };

    if (name == '' || street == '' || city == '' || state =='' || zip=='') {
        $.systemMessage('Name, Street, City, State and Zip are required', 'alert--danger', true);
        return;
    }
    if (!confirm('Are you sure you want to import this creditor to '+mortgage+'?')) {
        $("input[type=radio]").prop("checked", false);
        return;
    }
	var url = "{{ route('import_schedule_d') }}";
	laws.ajax(url, data, function (response) {
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
        laws.ajax('{{ route('manual_add_vehicle_form') }}', { client_id:client_id,report_id:report_id }, function (response) {
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

     addNewResident = function(client_id, report_id)
     {
        laws.ajax('{{ route('manual_add_resident_form') }}', { client_id:client_id,report_id:report_id }, function (response) {
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
	propertyVehicleImport = function(propertyIndex, client_id,vehiclename) {

    var name = $("#name").val();
    var street = $("#street").val();
    var city = $("#city").val();
    var state = $("#state").val();
    var zip = $("#zip").val();
    var account = $("#account").val();
    var amount = $("#amount").val();
    var date_incurred = $("#date_incurred").val();
    if (name == '' || street == '' || city == '' || state =='' || zip=='') {
        $.systemMessage('Name, Street, City, State and Zip are required', 'alert--danger', true);
        return;
    }

    var data = {
        propertyIndex: propertyIndex,
        client_id:client_id,
        name:name,
        street:street,
        city:city,
        state:state,
        zip:zip,
        account:account,
        amount:amount,
        date_incurred:date_incurred,
        manual:true
    };
	if (!confirm('Are you sure you want to import this creditor to '+vehiclename+'?')) {
        $("input[type=radio]").prop("checked", false);
        return;
    }


	var url = "{{ route('import_schedule_d_vehicle') }}";
	laws.ajax(url, data, function (response) {
        var res = JSON.parse(response);
            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger', true);
            } else {
                $.systemMessage(res.msg, 'alert--success', true);
                $.facebox.close();
            }
    });
	}




$(document).on('input', ".common_creditors_auto_complete", function(e) {
$(this).autocomplete({
    'classes': {
        "ui-autocomplete": "custom-ui-autocomplete"
    },
    'source': function(request, response) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url: '{{ route("common_creditors_search") }}',
            data: {
                keyword: encodeURIComponent(request['term'])
            },
            dataType: 'json',
            type: 'post',
            success: function(json) {
				json = json.data;
                response($.map(json, function(item) {
                    return {
                        label: item['placeholder'],
                        value: item['value'],
                        address: item['address'],
                        city: item['city'],
                        state: item['state'],
                        zip: item['zip'],
                    };
                }));
            },
        });
    },
    select: function(event, ui) {
        $(this).val(ui.item.label);
        var n =$(this).attr('name');
        var index = n.slice(-3);
        index= index.replace('[', '');
        index = index.replace(']', '');
        index = parseInt(index);
        $("#name").val(ui.item.label);
        $("#street").val(ui.item.address);
        $("#city").val(ui.item.city);
        $("#state").val(ui.item.state);
        $("#zip").val(ui.item.zip);
    }
  });
});
</script>
