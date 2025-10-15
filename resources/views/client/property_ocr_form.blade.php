<div class="sign_up_bgs">
    <div class="container-fluid">
        <div class="row py-0 page-flex">
            <div class="col-md-12">
                <div class="form_colm row py-4">
                    <div class="col-md-12 mb-3">
                        <div class="title-h mt-1 d-flex">
                            @php
                                $vehciles = Helper::getVehicle() + [
                                    'Current_Auto_Loan_Statement' => 'Current Auto Loan Statement',
                                ];
                                $propertyvehicle = $resident['propertyvehicle'];
                            @endphp
                            <h4><strong>Confirm {{ $vehciles[$data['document_type']] ?? '' }} details: </strong></h4>
                        </div>
                    </div>

                    @php
                        $routeUrl = route('setup_scanned_property');
                        $documentType = $data['document_type'];
                        $vinNumber = $data['vin_number'];
                        $ocr = !empty($data['data']) ? json_decode($data['data'], 1) : [];
                        $ocr['vin_number'] = $data['vin_number'];
                        $vinData = !empty($data['vin_data']) ? json_decode($data['vin_data'], 1) : [];
                        $ocr['year'] = $vinData['year'] ?? '';
                        $ocr['make'] = $vinData['make'] ?? '';
                        $ocr['model'] = $vinData['model'] ?? '';
                        $ocr['trim'] = $vinData['trim'] ?? '';

                        if (isset($ocr['amount_own'])) {
                            $ocr['amount_own'] = str_replace(',', '', $ocr['amount_own']);
                            $ocr['amount_own'] = str_replace('$', '', $ocr['amount_own']);
                            $ocr['amount_own'] = number_format((float) $ocr['amount_own'], 2, '.', '');
                        }
                        if (isset($ocr['monthly_payment'])) {
                            $ocr['monthly_payment'] = str_replace(',', '', $ocr['monthly_payment']);
                            $ocr['monthly_payment'] = str_replace('$', '', $ocr['monthly_payment']);
                            $ocr['monthly_payment'] = number_format((float) $ocr['monthly_payment'], 2, '.', '');
                        }

                        if (isset($ocr['past_due_amount'])) {
                            $ocr['past_due_amount'] = str_replace(',', '', $ocr['past_due_amount']);
                            $ocr['past_due_amount'] = str_replace('$', '', $ocr['past_due_amount']);
                            $ocr['past_due_amount'] = number_format((float) $ocr['past_due_amount'], 2, '.', '');
                        }
                    @endphp
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="align-left">
                                    <form method="POST" id="dl_autoloan_confirm" name="dl_autoloan_confirm"
                                        action="{{ $routeUrl }}">
                                        <div>
                                            @csrf
                                            <div class="row form_bgp">
                                                <x-propertyOcrBasicAddon1 inputId="amount_own" span="$"
                                                    label="Amount Owed" placeholder="Amount Own" name="amount_own"
                                                    type="number" value="{{ $ocr['amount_own'] ?? '' }}"
                                                    inputClass="price-field form-control"></x-propertyOcrBasicAddon1>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Account Number</label>
                                                        <div class="input-group mb-4">
                                                            <input id="account_number" required
                                                                placeholder= "Account number" type="text"
                                                                class="form-control"
                                                                value="{{ $ocr['account_number'] ?? '' }}"
                                                                name="account_number">
                                                        </div>
                                                    </div>
                                                </div>

                                                <x-propertyOcrBasicAddon1 inputId="monthly_payment" span="$"
                                                    label="Monthly payment" placeholder="Monthly Payment"
                                                    name="monthly_payment" type="number"
                                                    value="{{ $ocr['monthly_payment'] ?? '' }}"
                                                    inputClass="price-field form-control"></x-propertyOcrBasicAddon1>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Past due payment </label>
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">$</span>
                                                            </div>
                                                            <input id="monthly_payment" required
                                                                placeholder= "Past due payment" type="number"
                                                                class="price-field form-control"
                                                                value="{{ $ocr['past_due_amount'] ?? '' }}"
                                                                name="past_due_amount">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h5>Vehicle Information</h5>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Vin #</label>
                                                        <a class="link_vin mt-1 " style="float:right;"
                                                            href="javascript:void(0)"
                                                            onclick="checkVinNumber(this)">Decode Vin #</a>

                                                        <div class="input-group">
                                                            <input type="text" id="v_vin_number"
                                                                placeholder="Enter VIN number"
                                                                value="{{ $ocr['vin_number'] ?? '' }}" name="vin_number"
                                                                class="w-100 form-control vin_number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Year
                                                        </label>
                                                        <input id="vehicle_year" type="number"
                                                            min="{{ date('Y', strtotime('-70 year')) }}"
                                                            max="{{ date('Y') }}"
                                                            class="form-control required allow-4digit vehicle_property_year"
                                                            placeholder="Year" name="property_year"
                                                            value="{{ $ocr['year'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Make
                                                        </label>
                                                        <input type="text" id="vehicle_make"
                                                            class="form-control required vehicle_property_make"
                                                            placeholder="Make" name="property_make"
                                                            value="{{ $ocr['make'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Model
                                                        </label>
                                                        <input id="vehicle_model" type="text"
                                                            class="form-control required vehicle_property_model"
                                                            placeholder="Model" name="property_model"
                                                            value="{{ $ocr['model'] ?? '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Style of vehicle
                                                        </label>
                                                        <input id="vehicle_style" type="text"
                                                            class="form-control required vehicle_property_other_info"
                                                            placeholder="Other information" name="property_other_info"
                                                            value="{{ $ocr['trim'] ?? '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Creditor Name</label>
                                                        <div class="input-group mb-3">
                                                            <input id="loan_company" required
                                                                placeholder= "Creditor Name" type="text"
                                                                class="form-control" name="loan_company"
                                                                value="{{ $ocr['loan_company'] ?? '' }}" autofocus>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <div class="input-group mb-4">
                                                            <input id="address" placeholder= "Address"
                                                                type="text" class="form-control"
                                                                value="{{ $ocr['address'] ?? '' }}" name="address">
                                                        </div>
                                                    </div>
                                                </div>

                                                <x-propertyOcrInputSelect zipval="{{ $ocr['zip'] ?? '' }}"
                                                    stateval="{{ $ocr['state'] ?? '' }}" inputId="city"
                                                    type="text" divClass="col-md-6" name="city"
                                                    placeholder="City" label="City" inputClass=""
                                                    value="{{ $ocr['city'] ?? '' }}"></x-propertyOcrInputSelect>

                                                <input type="hidden" name="ocr_id"
                                                    value="{{ $data['id'] ?? '' }}">
                                                <div class="col-md-12 mb-3">
                                                    <div class="title-h mt-1 d-flex">
                                                        <h5><strong>Select Vehicle in which you want to import:
                                                            </strong></h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        @foreach ($propertyvehicle as $vehicle)
                                                            @php
                                                                $propertName = '';
                                                                if (
                                                                    $vehicle['own_any_property'] &&
                                                                    $vehicle['loan_own_type_property'] == 1 &&
                                                                    isset($vehicle['vehicle_car_loan'])
                                                                ) {
                                                                    $loan = json_decode(
                                                                        $vehicle['vehicle_car_loan'],
                                                                        1,
                                                                    );
                                                                }
                                                                $vehicle_name = ArrayHelper::getVehiclesArray(
                                                                    $vehicle['property_type'],
                                                                );
                                                                if (!empty($vehicle_name)) {
                                                                    $vehicle_name .= ', ' . $vehicle['property_year'];
                                                                    $vehicle_name .= ', ' . $vehicle['property_make'];
                                                                    $vehicle_name .= ', ' . $vehicle['property_model'];
                                                                    $vehicle_name .=
                                                                        ', ' . $vehicle['property_mileage'];
                                                                    $vehicle_name .=
                                                                        ', ' . $vehicle['property_other_info'];
                                                                }
                                                                if (empty($vehicle_name)) {
                                                                    $vehicle_name =
                                                                        'Newly added Vehicle, Information not added yet';
                                                                }
                                                            @endphp
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div style="display:inline-flex;"
                                                                        class="radio-primary">
                                                                        @php $id = !empty($vehicle['id']) ? $vehicle['id'] : 0; @endphp
                                                                        <strong>{{ $i }}).</strong><input
                                                                            id="loan-{{ $i }}"
                                                                            class="" type="radio"
                                                                            name="vehicle"
                                                                            value="{{ $id }}">
                                                                        <label for="loan-{{ $i }}"
                                                                            class="cr">{{ $vehicle_name }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php $i++; @endphp
                                                        @endforeach
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div style="display:inline-flex;"
                                                                    class="radio-primary">
                                                                    @php $id = 0; @endphp
                                                                    <strong>{!! '&nbsp;&nbsp;&nbsp;&nbsp;' !!}</strong><input
                                                                        id="loan-0" class="" type="radio"
                                                                        name="vehicle" value="0">
                                                                    <label for="loan-0" class="cr">Import to new
                                                                        vehicle</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 align-right login-btn">
                                                    <button type="submit"
                                                        class="btn btn-primary shadow-2 mb-4">Import</button>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('tab_scripts')
    <script>
        window.__propertyOcrRoutes = {
            importScheduleDVehicle: "{{ route('import_schedule_d_vehicle') }}",
            fetchVinNumber: "{{ route('fetch_vin_number') }}",
            loanCompanySearch: "{{ route('loan_company_search') }}"
        };
        window.__propertyOcrData = {
            ocrId: "{{ $data['id'] ?? '' }}"
        };
    </script>
    <script src="{{ asset('assets/js/client/property_ocr_form.js') }}"></script>
@endpush
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/property_ocr_form.css') }}">
@endpush
