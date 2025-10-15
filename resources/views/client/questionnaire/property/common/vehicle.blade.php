@php
$srNo = Helper::validate_key_value('sr_no', $vehicle, 'radio');
$initialClass = 'initial';
if ($srNo > 1) {
    $initialClass = 'additional';
}
if (date('d') >= 10) {
    $currentMonth = date('m/Y');
    $lastMonth = date('m/Y', strtotime('-1 month'));
    $monthBeforeLast = date('m/Y', strtotime('-2 months'));
} else {
    $currentMonth = date('m/Y', strtotime('-1 month'));
    $lastMonth = date('m/Y', strtotime('-2 months'));
    $monthBeforeLast = date('m/Y', strtotime('-3 months'));
}
$vehicle_car_loan = (!empty($vehicle['vehicle_car_loan'])) ? json_decode($vehicle['vehicle_car_loan'], 1) : [];
$list = @$docsUploadInfo['list'];
@endphp

<div class="outline-gray-border-area mt-2 vehicle_form_div vehicle_form_div_{{$i}}">
	<div class="light-gray-div {{ ($i == 1) ? 'mt-2' : '' }}">
		<div class="light-gray-box-form-area">
			<h2>
				<div class="circle-number-div vehicleno">{{ $i + 1 }}</div> 
				<span class="vtype_name me-1">{{ (Helper::validate_key_value('property_type', $vehicle) == 6) ? 'Recreational' : 'Vehicle' }} </span>
				<span class="vehicleno">{{ !empty($srNo) ? $srNo : '' }}</span>
			</h2>
			<button type="button" class="delete-div trash-btn" title="Delete" data-saveid="{{ $i }}" onclick="remove_vehicle_div({{ $i }}, {{ (isset($attorney_edit) && $attorney_edit == true) ? 1 : 0 }}, {{$vehicle['id']??0}});">
				<i class="bi bi-trash3 mr-1"></i>
				Delete
			</button>

			<!-- summary -->
			<div class="mb-3 vehicle_summary vehicle_summary_{{ $i }} {{ (!isset($vehicle['id']) || empty($vehicle['id']) || empty($vehicleselected)) ? 'hide-data' : '' }}">
				<div class="row gx-3">
					@include("attorney.form_elements.vehicle_listing", ['hide_docs' => true])
				</div>
			</div>

			<!-- edit section -->
			
			<div class="form-main {{ !empty($vehicle) ? 'hide-data' : '' }}  vehicle-form removeDiv  vehicle_form_{{ $i }} {{ $initialClass }} {{ (isset($key) && ($key > 0)) ? 'additional' : '' }}">
				<div class="row gx-3">
					@include('client.questionnaire.property.common.vehicle_edit')
				</div>
			</div>

		
			<a href="javascript:void(0)" data-saveid="{{ $i }}" class=" client-edit-button with-delete bottom-left-position" onclick="display_vehicle_div({{ $i }}, {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }});">
				<span>
					<i class="bi bi-pencil-square mr-1"></i>
					Edit
				</span>
			</a>
		</div>
	</div>
</div>