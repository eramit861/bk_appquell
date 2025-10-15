@php
    $vehicleData = Helper::validate_key_value('vehicle_details', $formData, 'array');

    // Precompute vehicle count and visibility classes
    $count = 1;
    if (!empty($vehicleData) && is_array($vehicleData)) {
        $count = count($vehicleData);
    }

    $ownVehicleClass = ((Helper::validate_key_value('own_any_vehicle', $formData, 'radio') == 1) || (old('own_any_vehicle') == 1)) ? '' : 'hide-data';
@endphp
<script>
    // VIN Fetch Route
    window.fetchVinRoute = "{{ route('fetch_vin_number') }}";
</script>
<div class="col-md-12 ">
    <div class="label-div question-area  mt-2">
        <!-- Radio -->
        <label class="form-label">(LIST ALL VEHICLES YOU OWN, WHETHER YOU OWE MONEY ON THEM OR NOT)</label>
        <div class="custom-radio-group form-group">
            <input type="radio" required name="own_any_vehicle" class="form-check-input" id="own_any_vehicle_yes"
                value="1"
                {{ Helper::validate_key_value('own_any_vehicle', $formData, 'radio') === 1 || old('own_any_vehicle') === '1' ? 'checked' : '' }}>
            <label for="own_any_vehicle_yes"
                class="btn-toggle {{ Helper::validate_key_value('own_any_vehicle', $formData, 'radio') === 1 || old('own_any_vehicle') === '1' ? 'active' : '' }}"
                onclick="ownVehicleChange(1)">Yes</label>
            <input type="radio" required name="own_any_vehicle" class="form-check-input" id="own_any_vehicle_no"
                value="0"
                {{ Helper::validate_key_value('own_any_vehicle', $formData, 'radio') === 0 || old('own_any_vehicle') === '0' ? 'checked' : '' }}>
            <label for="own_any_vehicle_no"
                class="btn-toggle {{ Helper::validate_key_value('own_any_vehicle', $formData, 'radio') === 0 || old('own_any_vehicle') === '0' ? 'active' : '' }}"
                onclick="ownVehicleChange(0)">No</label>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="red-notice p-3 mb-3 mt-0">
        (Please list any & ALL types of property listed above you possess, own or use even if you're not on the
        title or registration.)
    </div>
</div>
<div class="col-md-12 mt-0 own_vehicle {{ $ownVehicleClass }}">
    <div class="row">
        <div class="col-md-12 ">
            <label class="mb-2">Please list all cars, trucks, motorcycles, boats or aircraft where your name is
                on
                the registration.</label>
            <div class="details-banner p-3 mb-3 text-start">
                <span class="">
                    Click to get value here
                    <span onClick="window.open('https://www.kbb.com/','popup','width=1200,height=650'); return false;"
                        class="card-title-text text-c-blue cursor-pointer mt-2">kbb.com</span>
                    and/or
                    <span onClick="window.open('https://www.nada.com/','popup','width=1200,height=650'); return false;"
                        class="card-title-text text-c-blue cursor-pointer mt-2">nada.com</span>
                </span>
            </div>
        </div>
        <div class="col-md-12" id="vehicle_page_listing_area">
            <div id="vehicle_listing_html">
                @for($i = 0; $i < $count; $i++)
                    @php
                        $vehicleCarLoan = [];
                        if (!empty($vehicleData[$i]['vehicle_car_loan'])) {
                            $vehicleCarLoan = is_array($vehicleData[$i]['vehicle_car_loan'])
                                ? $vehicleData[$i]['vehicle_car_loan']
                                : json_decode($vehicleData[$i]['vehicle_car_loan'], true);
                        }
                    @endphp
                    <div class="single-vehicle-form vehicle_form_div_{{$i + 1}}">
                        <div class="light-gray-div mt-2">
                            <h2 class=""><span class="vtype_name">{{ (!empty($vehicleData[$i]['property_type']) ? $vehicleData[$i]['property_type'] : old('property_vehicle.property_type.' . $i)) == 6 ? 'Recreational' : "Vehicle" }} </span>
                                <span class="vehicleno"> {{ $i + 1 }} </span>
                            </h2>
                        <div class="row gx-3">
                            @php
                                $property_type = !empty($vehicleData[$i]['property_type']) ? $vehicleData[$i]['property_type'] : old('property_vehicle.property_type.' . $i);
                                $property_type_name = !empty($vehicleData[$i]['property_type_name']) ? $vehicleData[$i]['property_type_name'] : old('property_vehicle.property_type_name.' . $i);
                            @endphp
                            <div class="col-12">
                                <div class="label-div mb-3">
                                    <label class="form-label">Upload Vehicle Property Value Document (Optional)</label>
                                    <div class="form-group">
                                        <input type="file" class="form-control vehicle_file_upload"
                                            name="property_vehicle[vehicle_property_value_document][{{ $i }}]"
                                            id="vehicle_file_{{ $i }}" accept="image/*,.pdf,.doc,.docx">
                                    </div>
                                </div>
                            </div>
                            @php
                                $intakeFormID = isset($intakeFormID) ? $intakeFormID : (isset($userId) ? base64_decode($userId) : '');
                                if (isset($intakeFormID)) {
                                    // Check if file is present at path intakeForm/{$requestId}/vehicle/{$index}/ in s3
                                    $vehicleDocumentPath = "intakeForm/{$intakeFormID}/vehicle/{$i}/";
                                    $hasFile = false;
                                    if (\Storage::disk('s3')->exists($vehicleDocumentPath)) {
                                        $files = \Storage::disk('s3')->files($vehicleDocumentPath);
                                        if (!empty($files)) {
                                            $filePth = \Storage::disk('s3')->temporaryUrl(
                                                $files[0],
                                                now()->addMinutes(30), // Expires in 30 minutes
                                                ['ResponseContentDisposition' => 'attachment']
                                            );
                            @endphp
                            <div class="col-md-12 pb-2">
                                <div class="label-div mb-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Attached File:
                                            <a href="{{ $filePth }}" target="_blank" class="btn-new-ui-default p-sm-1 ms-2 me-1 blue-pdf-icon" title="Download File">Download</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @php
                                        }
                                    }
                                }
                            @endphp

                            <div class="col-12 col-md-12">
                                <div class="chip-style-tab label-div mb-0">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="light-gray-div mb-3">
                                                <h2 class="pl-2">Vehicle Type</h2>
                                                <div class="d-flex flex-wrap w-100">
                                                    <label
                                                        class="chip-tab {{ $property_type == 1 && $property_type_name == 'Cars' ? 'active ' : ' ' }}{{ empty($property_type_name) && $property_type == 1 ? 'active' : '' }}">
                                                        <span class="emoji-icon">&#x1F697;</span>Cars
                                                        <input type="radio"
                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                            class="property_type required d-none" value="1"
                                                            data-label="Cars"
                                                            onclick="changeVehicleIntake(this, {{ $i }})"
                                                            {{ $property_type == 1 && ($property_type_name == 'Cars' || empty($property_type_name)) ? 'checked' : '' }}>
                                                    </label>

                                                    <label
                                                        class="chip-tab {{ $property_type == 1 && $property_type_name == 'Motorcycles' ? 'active ' : ' ' }}">
                                                        <span class="emoji-icon">&#x1F3CD;&#xFE0F;</span>Motorcycles
                                                        <input type="radio"
                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                            class="property_type required d-none" value="1"
                                                            data-label="Motorcycles"
                                                            onclick="changeVehicleIntake(this, {{ $i }})"
                                                            {{ $property_type == 1 && $property_type_name == 'Motorcycles' ? 'checked' : '' }}>
                                                    </label>

                                                    <label
                                                        class="chip-tab {{ $property_type == 1 && $property_type_name == 'Vans' ? 'active ' : ' ' }}">
                                                        <span class="emoji-icon">&#x1F690;</span>Vans
                                                        <input type="radio"
                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                            class="property_type required d-none" value="1"
                                                            data-label="Vans"
                                                            onclick="changeVehicleIntake(this, {{ $i }})"
                                                            {{ $property_type == 1 && $property_type_name == 'Vans' ? 'checked' : '' }}>
                                                    </label>

                                                    <label
                                                        class="chip-tab {{ $property_type == 1 && $property_type_name == 'Trucks' ? 'active ' : ' ' }}">
                                                        <span class="emoji-icon">&#x1F69A;</span>Trucks
                                                        <input type="radio"
                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                            class="property_type required d-none" value="1"
                                                            data-label="Trucks"
                                                            onclick="changeVehicleIntake(this, {{ $i }})"
                                                            {{ $property_type == 1 && $property_type_name == 'Trucks' ? 'checked' : '' }}>
                                                    </label>

                                                    <label
                                                        class="chip-tab {{ $property_type == 1 && $property_type_name == 'Sport utility vehicles' ? 'active ' : ' ' }}">
                                                        <span class="emoji-icon">&#x1F699;</span>Sport utility vehicles
                                                        <input type="radio"
                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                            class="property_type required d-none" value="1"
                                                            data-label="Sport utility vehicles"
                                                            onclick="changeVehicleIntake(this, {{ $i }})"
                                                            {{ $property_type == 1 && $property_type_name == 'Sport utility vehicles' ? 'checked' : '' }}>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="light-gray-div mb-3">
                                                <h2 class="pl-2">Recreational Vehicle Type</h2>
                                                <div class="d-flex flex-wrap w-100">
                                                    <label
                                                        class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Tractors' ? 'active ' : ' ' }}{{ empty($property_type_name) && $property_type == 6 ? 'active' : '' }}">
                                                        <span class="emoji-icon">&#x1F69C;</span>Tractors
                                                        <input type="radio"
                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                            class="property_type required d-none" value="6"
                                                            data-label="Tractors"
                                                            onclick="changeVehicleIntake(this, {{ $i }})"
                                                            {{ $property_type == 6 && ($property_type_name == 'Tractors' || empty($property_type_name)) ? 'checked' : '' }}>
                                                    </label>

                                                    <label
                                                        class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Watercraft' ? 'active ' : ' ' }}">
                                                        <span class="emoji-icon">&#x1F6A4;</span>Watercraft
                                                        <input type="radio"
                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                            class="property_type required d-none" value="6"
                                                            data-label="Watercraft"
                                                            onclick="changeVehicleIntake(this, {{ $i }})"
                                                            {{ $property_type == 6 && $property_type_name == 'Watercraft' ? 'checked' : '' }}>
                                                    </label>

                                                    <label
                                                        class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Motor homes' ? 'active ' : ' ' }}">
                                                        <span class="emoji-icon">&#x1F690;</span>Motor homes
                                                        <input type="radio"
                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                            class="property_type required d-none" value="6"
                                                            data-label="Motor homes"
                                                            onclick="changeVehicleIntake(this, {{ $i }})"
                                                            {{ $property_type == 6 && $property_type_name == 'Motor homes' ? 'checked' : '' }}>
                                                    </label>

                                                    <label
                                                        class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'ATVs' ? 'active ' : ' ' }}">
                                                        <span class="emoji-icon">&#x1F6FB;</span>ATVs
                                                        <input type="radio"
                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                            class="property_type required d-none" value="6"
                                                            data-label="ATVs"
                                                            onclick="changeVehicleIntake(this, {{ $i }})"
                                                            {{ $property_type == 6 && $property_type_name == 'ATVs' ? 'checked' : '' }}>
                                                    </label>

                                                    <label
                                                        class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Other vehicles' ? 'active ' : ' ' }}">
                                                        <span class="emoji-icon">&#x1F6F8;</span>Other vehicles
                                                        <input type="radio"
                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                            class="property_type required d-none" value="6"
                                                            data-label="Other vehicles"
                                                            onclick="changeVehicleIntake(this, {{ $i }})"
                                                            {{ $property_type == 6 && $property_type_name == 'Other vehicles' ? 'checked' : '' }}>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="property_type_name"
                                        name="property_vehicle[property_type_name][{{ $i }}]"
                                        value="{{ $property_type_name }}">
                                </div>
                            </div>

                            @php
                                // Hide vehicle detail fields until a vehicle type is selected
                                $vehicleDetailClass = 'hide-data';
                                if (!empty($vehicleData) && isset($vehicleData[$i]['property_type'])) {
                                    $vehicleDetailClass = '';
                                } elseif (!empty($property_type) || old('property_vehicle.property_type.' . $i) != null) {
                                    $vehicleDetailClass = '';
                                }
                            @endphp

                            <div
                                class="col-12 vehicle-detail-section vehicle-detail-section-{{ $i }} {{ $vehicleDetailClass }}">
                                <div class="row gx-3">
                                    <div class="col-md-4">
                                        <div class="label-div mb-3">
                                            <div
                                                class="form-group mb-0 vin_number_div vin_number_div_{{ $i }}">
                                                <label class="form-label">Input the vehicle Vin # below</label>
                                                <input type="text" oninput="vinOnInput(this)" placeholder="VIN"
                                                    value="{{ !empty($vehicleData[$i]['vin_number']) ? $vehicleData[$i]['vin_number'] : old('property_vehicle.vin_number.' . $i) }}"
                                                    name="property_vehicle[vin_number][{{ $i }}]"
                                                    id="vin_{{ $i }}"
                                                    class="w-100 form-control text-uppercase vin_number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="label-div mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Mileage</label>
                                                <input required type="text"
                                                    name="property_vehicle[property_mileage][{{ $i }}]"
                                                    value="{{ !empty($vehicleData[$i]['property_mileage']) ? $vehicleData[$i]['property_mileage'] : old('property_vehicle.property_mileage.' . $i) }}"
                                                    class="form-control property_mileage" placeholder="Mileage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="label-div mb-3">
                                            <div class="form-group mt-2 mb-2 vin-import-btn-div">
                                                <label class="form-label d-none d-md-block">&nbsp;</label>
                                                <a class="link_vin shadow-2 rounded-0 float_left label save-btn mx-ht im-action  btn-new-ui-default m-0 px-5 py-2 vehicle-action-btn"
                                                    href="javascript:void(0)" id="link_vin_{{ $i }}"
                                                    data-fetch-url="{{ route('fetch_vin_number') }}"
                                                    data-intake-form-id="{{ $intakeFormID }}"
                                                    data-property-fetch-url="{{ route('get_property_vehicle_details_by_graphql') }}"
                                                    onclick="checkVin2Number(this)">
                                                    <i class="bi bi-download"></i> Auto Import Vehicle Info
                                                </a>
                                            </div>
                                            <div
                                                class="form-check form-group mb-0 vin_number_div vin_number_div_{{ $i }}">
                                                <label class="mb-0 form-check-label vin_label_check">
                                                    <input
                                                        class="form-check-input unknown_vin unknown_vin_{{ $i }}"
                                                        value="1" type="checkbox"
                                                        onclick="checkUnknownVin(this, {{ $i }})">
                                                    <small class="text-bold">Select IF you can't find the Vin#</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        // Determine if vehicle data section should be visible initially
                                        $vehicleDataSectionClass = '';
                                        if (empty($vehicleData[$i]['property_year']) && empty($vehicleData[$i]['property_make']) && empty($vehicleData[$i]['property_model'])) {
                                            $vehicleDataSectionClass = 'd-none';
                                        }
                                    @endphp

                                    <div
                                        class="col-12 vehicle-data-section-{{ $i }} {{ $vehicleDataSectionClass }}">
                                        <div class="row gx-3">
                                            <div class="col-md-2">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Year</label>
                                                        <input required type="text"
                                                            name="property_vehicle[property_year][{{ $i }}]"
                                                            value="{{ !empty($vehicleData[$i]['property_year']) ? $vehicleData[$i]['property_year'] : old('property_vehicle.property_year.' . $i) }}"
                                                            class="form-control property_year" placeholder="Year">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Make</label>
                                                        <input required type="text"
                                                            name="property_vehicle[property_make][{{ $i }}]"
                                                            value="{{ !empty($vehicleData[$i]['property_make']) ? $vehicleData[$i]['property_make'] : old('property_vehicle.property_make.' . $i) }}"
                                                            class="form-control property_make" placeholder="Make">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Model</label>
                                                        <input required type="text"
                                                            name="property_vehicle[property_model][{{ $i }}]"
                                                            value="{{ !empty($vehicleData[$i]['property_model']) ? $vehicleData[$i]['property_model'] : old('property_vehicle.property_model.' . $i) }}"
                                                            class="form-control property_model" placeholder="Model">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Style of Vehicle</label>
                                                        <input required type="text"
                                                            name="property_vehicle[property_other_info][{{ $i }}]"
                                                            value="{{ !empty($vehicleData[$i]['property_other_info']) ? $vehicleData[$i]['property_other_info'] : old('property_vehicle.property_other_info.' . $i) }}"
                                                            class="form-control property_other_info"
                                                            placeholder="Style of Vehicle">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="label-div mb-3">
                                                    <div class="form-group ">
                                                        <label class="form-label">Estimated Value of Property</label>
                                                        <div class="d-flex input-group pt-2 pt-md-0">
                                                            <span
                                                                class="custom_corner_span h-26px br-0 input-group-text"
                                                                id="basic-addon1">$</span>
                                                            <input required type="text"
                                                                class="custom_corner_input form-control price-field property_estimated_value"
                                                                name="property_vehicle[property_estimated_value][{{ $i }}]"
                                                                placeholder="Estimated Value of Property"
                                                                value="{{ !empty($vehicleData[$i]['property_estimated_value']) ? $vehicleData[$i]['property_estimated_value'] : old('property_vehicle.property_estimated_value.' . $i) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        // Determine if Yes radio should be checked/active
                                        $isYesChecked = '';
                                        $isYesActive = '';
                                        if (!empty($vehicleData) && isset($vehicleData[$i]['loan_own_type_property']) && $vehicleData[$i]['loan_own_type_property'] == 0) {
                                            $isYesChecked = 'checked';
                                            $isYesActive = 'active';
                                        } elseif (old('property_vehicle.loan_own_type_property.' . $i) != null && old('property_vehicle.loan_own_type_property.' . $i) == 0) {
                                            $isYesChecked = 'checked';
                                            $isYesActive = 'active';
                                        }

                                        // Determine if No radio should be checked/active
                                        $isNoChecked = '';
                                        $isNoActive = '';
                                        if (!empty($vehicleData) && isset($vehicleData[$i]['loan_own_type_property']) && $vehicleData[$i]['loan_own_type_property'] == 1) {
                                            $isNoChecked = 'checked';
                                            $isNoActive = 'active';
                                        } elseif (old('property_vehicle.loan_own_type_property.' . $i) != null && old('property_vehicle.loan_own_type_property.' . $i) == 1) {
                                            $isNoChecked = 'checked';
                                            $isNoActive = 'active';
                                        }
                                    @endphp
                                    <div class="col-md-12 loan_sect ">
                                        <div class="label-div question-area mb-3">
                                            <label class="form-label">Do you have a loan on this property?</label>
                                            <div class="custom-radio-group form-group">
                                                <input type="radio" required
                                                    name="property_vehicle[loan_own_type_property][{{ $i }}]"
                                                    class="vehicle_loan_on_property form-check-input"
                                                    id="type_yes_vehicle_{{ $i }}" value="0"
                                                    {{ $isYesChecked }}
                                                    onclick="vehicle_loan_show('{{ $i }}','yes')">
                                                <label class="yes btn-toggle {{ $isYesActive }}"
                                                    for="type_yes_vehicle_{{ $i }}">Yes</label>
                                                <input type="radio" required
                                                    name="property_vehicle[loan_own_type_property][{{ $i }}]"
                                                    class="vehicle_loan_on_property form-check-input"
                                                    id="type_no_vehicle_{{ $i }}" value="1"
                                                    {{ $isNoChecked }}
                                                    onclick="vehicle_loan_show('{{ $i }}','no')">
                                                <label class="no btn-toggle {{ $isNoActive }}"
                                                    for="type_no_vehicle_{{ $i }}">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End .row -->
                            </div><!-- End .vehicle-detail-section -->

                            @php
                                // Default: hide loan section
                                $loanSectionClass = 'hide-data';

                                // Show only if vehicle data exists and loan_own_type_property is explicitly 0 (has loan)
                                if (!empty($vehicleData) && isset($vehicleData[$i]['loan_own_type_property']) && $vehicleData[$i]['loan_own_type_property'] == 0) {
                                    $loanSectionClass = '';
                                }
                                // Or check old() values as fallback
                                elseif (old('property_vehicle.loan_own_type_property.' . $i) != null && old('property_vehicle.loan_own_type_property.' . $i) == 0) {
                                    $loanSectionClass = '';
                                }
                            @endphp
                            <div
                                class="col-md-12 vehicle_loan_div_{{ $i }} vehicle_loan_section {{ $loanSectionClass }}">
                                <div class="row gx-3">
                                    <div class="col-md-6">
                                        <div class="label-div mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Monthly payment amount</label>
                                                <div class="d-flex input-group">
                                                    <span class="custom_corner_span h-26px br-0 input-group-text"
                                                        id="basic-addon1">$</span>
                                                    <input required type="text"
                                                        class="custom_corner_input form-control price-field vehicle_car_loan_monthly_payment"
                                                        placeholder="Monthly payment amount"
                                                        name="property_vehicle[vehicle_car_loan][monthly_payment][{{ $i }}]"
                                                        value="{{ !empty($vehicleCarLoan['monthly_payment']) ? $vehicleCarLoan['monthly_payment'] : old('property_vehicle.vehicle_car_loan.monthly_payment.' . $i) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="label-div mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Past due payment</label>
                                                <div class="d-flex input-group">
                                                    <span class="custom_corner_span h-26px br-0 input-group-text"
                                                        id="basic-addon1">$</span>
                                                    <input required type="text"
                                                        class="custom_corner_input form-control price-field vehicle_car_loan_past_due_amount"
                                                        placeholder="Past due payment"
                                                        name="property_vehicle[vehicle_car_loan][past_due_amount][{{ $i }}]"
                                                        value="{{ !empty($vehicleCarLoan['past_due_amount']) ? $vehicleCarLoan['past_due_amount'] : old('property_vehicle.vehicle_car_loan.past_due_amount.' . $i) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="label-div mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Estimated Amount Owed</label>
                                                <div class="d-flex input-group">
                                                    <span class="custom_corner_span h-26px br-0 input-group-text"
                                                        id="basic-addon1">$</span>
                                                    <input required type="text"
                                                        class="custom_corner_input form-control price-field vehicle_car_loan_amount_own"
                                                        placeholder="Amount Owed"
                                                        name="property_vehicle[vehicle_car_loan][amount_own][{{ $i }}]"
                                                        value="{{ !empty($vehicleCarLoan['amount_own']) ? $vehicleCarLoan['amount_own'] : old('property_vehicle.vehicle_car_loan.amount_own.' . $i) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-0"></div>
                                    <div class="col-md-3">
                                        <div class="label-div mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Name of creditor</label>
                                                <input type="text"
                                                    class="input_capitalize form-control vehicle_creditor_name required"
                                                    name="property_vehicle[vehicle_car_loan][creditor_name][{{ $i }}]"
                                                    placeholder="Creditor Name"
                                                    value="{{ !empty($vehicleCarLoan['creditor_name']) ? $vehicleCarLoan['creditor_name'] : old('property_vehicle.vehicle_car_loan.creditor_name.' . $i) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="label-div mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Street Address</label>
                                                <input type="text"
                                                    class="form-control vehicle_creditor_name_addresss "
                                                    name="property_vehicle[vehicle_car_loan][creditor_name_addresss][{{ $i }}]"
                                                    placeholder="Street Address"
                                                    value="{{ !empty($vehicleCarLoan['creditor_name_addresss']) ? $vehicleCarLoan['creditor_name_addresss'] : old('property_vehicle.vehicle_car_loan.creditor_name_addresss.' . $i) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="label-div mb-3">
                                            <div class="form-group">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control vehicle_creditor_city "
                                                    name="property_vehicle[vehicle_car_loan][creditor_city][{{ $i }}]"
                                                    placeholder="City"
                                                    value="{{ !empty($vehicleCarLoan['creditor_city']) ? $vehicleCarLoan['creditor_city'] : old('property_vehicle.vehicle_car_loan.creditor_city.' . $i) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="label-div mb-3">
                                            <label class="form-label">State</label>
                                            <div class="form-group">
                                                <select class="form-control vehicle_creditor_state "
                                                    name="property_vehicle[vehicle_car_loan][creditor_state][{{ $i }}]">
                                                    <option value="">Please Select State</option>
                                                    {!! AddressHelper::getStatesList(!empty($vehicleCarLoan['creditor_state']) ? $vehicleCarLoan['creditor_state'] : old('property_vehicle.vehicle_car_loan.creditor_state.' . $i)) !!}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="label-div mb-3">
                                            <label class="form-label">Zip code</label>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control allow-5digit vehicle_creditor_zip "
                                                    name="property_vehicle[vehicle_car_loan][creditor_zip][{{ $i }}]"
                                                    placeholder="Zip code"
                                                    value="{{ !empty($vehicleCarLoan['creditor_zip']) ? $vehicleCarLoan['creditor_zip'] : old('property_vehicle.vehicle_car_loan.creditor_zip.' . $i) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
<div class="col-12 mt-0 d-flex align-items-center own_vehicle {{ $ownVehicleClass }}">
    <button
        class="vehicle-action-btn add-btn shadow-2 rounded-0 w-auto label save-btn mx-ht im-action btn-new-ui-default m-0 py-2"
        id="add-more-btn" onclick="addMoreVehicleFn();return false;">
        <i class="bi bi-plus-lg mr-1"></i> Add More
    </button>

    <button type="button" class="vehicle-action-btn delete-btn delete-div trash-btn ms-auto" title="Delete"
        onclick="remove_clone_box('single-vehicle-form')">
        <i class="bi bi-trash3 mr-1 remove-btn cursor-pointer float_right remove_clone"></i>Delete
    </button>
</div>
