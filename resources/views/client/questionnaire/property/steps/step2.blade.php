@php
$form_route_step_2 = $attorney_edit ? $save_route : route('property_ajax_save');
$form_id_step_2 = $attorney_edit ? 'property_step2_modal_save' : 'client_property_step2';
$i = 0;
$vehicleselected = !isset($vehicleselected) ? 0 : $vehicleselected;
$vehicle = [];
if (isset($vininfo)) {
    $vins = [];
    $property = $propertyvehicle->toArray();
    if (empty($property)) {
        $propertyvehicle = [];
        foreach ($vininfo as $vin) {
            $propertyvehicle[] = ['own_any_property' => 1, 'vin_number' => $vin['document_file']];
        }
    }
}
@endphp
<form name="client_property_step2" id="{{ $form_id_step_2 }}" action="{{$form_route_step_2}}" method="post" novalidate style="width: 100%">
    @csrf
    <div class="light-gray-div mt-2">
        <h2>Vehicles</h2>
        <div class="row gx-3">
            <div class="col-12 light-gray-div b-0-i py-0 mb-0 getOwnTypeProperty_obj_data">
                <div class="label-div question-area border-bottom-default">
                    <label for="bankruptcy_filed">
                        Do you own or have possession of any cars, vans, trucks, tractors, SUVs, motorcycles, RVs, watercraft, aircraft, motorhomes, ATVs, or other types of vehicles?
                        <p class="text-bold mb-0 w-100">
                            <span class="text-c-blue">Possess means you use the item for transportation either full-time or part-time, even if you are not listed on the title</span>
                        </p>
                    </label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group">
                        <input type="radio" id="own_type_property_yes_{{ $i }}" class="d-none own_any_property" name="do_you_own_vehicle" data-index="{{ $i }}" required {{ (!empty($vehicleselected)) ? 'checked' : '' }} value="1">
                        <label for="own_type_property_yes_{{ $i }}" class="btn-toggle {{ (!empty($vehicleselected)) ? 'active' : '' }}" onclick="getOwnTypeProperty_obj('yes',this,{{ $vehicleselected }},1,'{{ route('show_scanned_property') }}');">Yes</label>

                        <input type="radio" id="own_type_property_no_{{ $i }}" class="d-none own_any_property" name="do_you_own_vehicle" data-index="{{ $i }}" required {{ (!empty($vehicleselected)) ? '' : 'checked' }} value="0">
                        <label for="own_type_property_no_{{ $i }}" class="btn-toggle {{ (!empty($vehicleselected)) ? '' : 'active' }}" onclick="getOwnTypeProperty_obj('no', this,{{ $vehicleselected }},0,'{{ route('show_scanned_property') }}');">No</label>
                    </div>
                    <p class="text-bold  mb-0">
                        <span class="text-danger">Please list all types of property you own or possess from the categories mentioned above. Include items regardless of whether you owe money on them or if they are fully paid off</span>
                    </p>
                </div>
            </div>

            <div class="col-12 {{ empty($vehicleselected) ? 'hide-data' : '' }}" id="vehicle_page_listing_div">
                <div class="row" id="vehicle_listing_html">
                    <div class="col-12">
                        <div class="label-div">
                            <p class="text-bold mb-0">
                                <span class="text-c-blue">IMPORTANT: Please ensure you list all property you own or possess in this section, even if it is not being included in your bankruptcy case</span>
                            </p>
                        </div>
                    </div>
                    @php
                        $i = 0;
                        $ri = 0;
                        $vi = 0;
                        foreach ($propertyvehicle as $vehicleType) {
                            if ((!empty($vehicleType['property_type']) && $vehicleType['property_type'] == 6)) {
                                $ri++;
                                $vehicleType['sr_no'] = $ri;
                            } else {
                                $vi++;
                                $vehicleType['sr_no'] = $vi;
                            }
                        }
                        $hideClass = 'hide-data';
                        if (!empty($propertyvehicle) && count($propertyvehicle) > 0) {
                            if (isset($propertyvehicle[0]['own_any_property']) && $propertyvehicle[0]['own_any_property'] == 1) {
                                $hideClass = '';
                            }
                            $propertyvehicle = !is_array($propertyvehicle) ? $propertyvehicle->toArray() : $propertyvehicle;
                            if (!empty($propertyvehicle)) {
                                usort($propertyvehicle, function ($a, $b) {
                                    if (!empty($a['property_type']) && !empty($b['property_type'])) {
                                        return (float)$a['property_type'] - (float)$b['property_type'];
                                    }
                                });
                            }
                            $vehi = 0;
                            $rerc = 0;
                            foreach ($propertyvehicle as $key => $vehicle) {
                                if ((!empty($vehicle['property_type']) && $vehicle['property_type'] == 6)) {
                                    $rerc++;
                                } else {
                                    $vehi = $vehi + 1;
                                }
                                @endphp
                                @include("client.questionnaire.property.common.vehicle",[$vehicle])
                                @php
                                $i++;
                            }
                        } else {
                            @endphp
                            @include("client.questionnaire.property.common.vehicle",$vehicle)
                            @php
                        }
                        $i = $i + 1;
                    @endphp

                </div>

                <div class="add-more-div-bottom vehicle-btn-section {{ empty($vehicleselected) ? 'hide-data' : '' }}">
                    @php
                        $loanId = $loanData['id'] ?? 0;
                        $route = route('show_scanned_property');
                    @endphp
                    <button type="button" class="btn-new-ui-default py-1 px-2" id="add-more-domestic-form" onclick="addVehicleForm('{{$loanId}}','{{$route}}',{{ $attorney_edit ? 'true' : 'false' }});return false;">
                        <i class="bi bi-plus-lg"></i>
                        Add Additional vehicle(s)
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="bottom-btn-div">
    @if(!$attorney_edit)
        <a href="{{ route('property_information') }}" class="btn-new-ui-default me-2">Back to Previous Page</a>
    @endif
    <button
        type="button"
        onclick="checkVehicleSelection('{{ route('client_property_step2') }}', {{ $attorney_edit ? 'true' : 'false' }}); "
        class="btn-new-ui-default">
        {{ $attorney_edit ? 'Save' : 'Save & Next' }} <i class="feather icon-chevron-right mr-0"></i>
    </button>
</div>

<div class="hide-data vehicle-popup">
    <p><i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i> Its not normal not to have any vehicles. You don't have a car, motorcycles or any other vehicles? &#x1F914;</p>
    <p>Are you sure you don't have this?</p>
</div>

<div class="hide-data no-mortgage-popup">
    <p>
        <i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i>
        <span class="text-c-red">Its extremely important you list any <u>Mortgages/Loans</u> on this property if you have any. If you have mortgages/liens on a property your not listing it looks like you have a bunch of equity you really don't have. If you plan on keeping this property it needs to be accurate.
        </span><br><small class="text-c-blue">Although some people have homes without any mortgages and/or loans this is very rare</small>
    </p>
    <p>Are you sure you don't have any loans on this property?</p>
</div>
