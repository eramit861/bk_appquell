@php
    $dataFor = 'vehicles-info';
    $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);

    // Precompute vehicle data and display logic
    $vehiclesYesOrNo = "";
    $vehicleYesSection = "hide-data";
    if ($details['own_any_vehicle'] == 0) {
        $vehiclesYesOrNo = "No";
    }
    if ($details['own_any_vehicle'] == 1) {
        $vehiclesYesOrNo = "Yes";
        $vehicleYesSection = "";
    }

    $vehicle_details = $details['vehicle_details'];
    $vehicle_details = json_decode($vehicle_details, true);
@endphp
<div class="row">
    <div class="col-12 col-md-12">
        <div class="light-gray-div">
            <h2>Vehicles/ Motorcycles/ Boats etc.</h2>
            <div class="intake-edit-div">
                <a href="javascript:void(0)" class="history-section-btn {{ $historyExists ? '' : 'hide-data' }}"
                    onclick="openHistoryLogsModal('{{$dataFor}}', {{ $intakeFormID }})">
                    <span class="text-bold" style="min-width: 80px !important;">
                        <i class="bi bi-clock-history"></i> History
                    </span>
                </a>
                <a href="javascript:void(0)" onclick="editIntakeData(this, '{{$dataFor}}')" class="ml-2 edit edit-section-btn">
                    <span class="text-bold" style="min-width: 80px !important;">
                        <i class="bi bi-pencil-square"></i> Edit
                    </span>
                </a>
            </div>
            <div class="row gx-3 {{$dataFor}} summary-div">
                <div class="col-md-12">
                    <p class=""><span class=" fw-bold">Do you own any vehicle:
                        </span>{{ $vehiclesYesOrNo }}</p>
                </div>
                <div class="col-md-12 {{ $vehicleYesSection }}">
                    @if(!empty($vehicle_details))
                        @foreach($vehicle_details as $val => $veh)
                            @php
                                $vehicleType = "";
                                if ($veh['property_type'] == 1) {
                                    $vehicleType = "Vehicle (Cars, vans, trucks, tractors, sport utility vehicles)";
                                }
                                if ($veh['property_type'] == 6) {
                                    $vehicleType = "Watercraft, aircraft, motor homes, ATVs and other recreational vehicles, other vehicles, and accessories";
                                }

                                $vehPayment = json_decode($veh['vehicle_car_loan'], true);
                                $vehicleLoan = "hide-data";
                                $vehicleLoanType = $veh['loan_own_type_property'] ?? "";
                                if ($vehicleLoanType == 0) {
                                    $vehicleLoan = "";
                                }
                            @endphp
                            <div class="px-3 {{ $loop->last ? 'mb-3' : '' }}">
                                <div class="row additional-que-div mortgage">
                                    @php
                                        // Check if file is present at path intakeForm/{$intakeFormID}/vehicle/{$val}/ in s3
                                        $vehicleDocumentPath = "intakeForm/{$intakeFormID}/vehicle/{$val}/";
                                        $filePth = null;
                                        if (\Storage::disk('s3')->exists($vehicleDocumentPath)) {
                                            $files = \Storage::disk('s3')->files($vehicleDocumentPath);
                                            if (!empty($files)) {
                                                $filePth = \Storage::disk('s3')->temporaryUrl(
                                                    $files[0],
                                                    now()->addMinutes(30), // Expires in 30 minutes
                                                    ['ResponseContentDisposition' => 'attachment']
                                                );
                                            }
                                        }
                                    @endphp
                                    @if(!empty($filePth))
                                        <div class="col-md-12">
                                            <p class="mt-2"><span class=" fw-bold">Attached File:
                                            </span><a href="{{ $filePth }}" target="_blank" class="btn-new-ui-default p-sm-1 ms-2 me-1 blue-pdf-icon" title="Download File">Download</a></p>
                                        </div>
                                    @endif
                                    <div class="col-md-8">
                                        <p class=""><span class=" fw-bold">Type:
                                            </span>{{ $vehicleType }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class=""><span class=" fw-bold">Property Value:
                                            </span>{{ $veh['property_estimated_value'] ? '$' . number_format((float) $veh['property_estimated_value'], 2) : '' }}
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class=""><span class=" fw-bold">Year:
                                            </span>{{ $veh['property_year'] }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class=""><span class=" fw-bold">Make:
                                            </span>{{ $veh['property_make'] }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class=""><span class=" fw-bold">Model:
                                            </span>{{ $veh['property_model'] }}
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class=""><span class=" fw-bold">Mileage:
                                            </span>{{ $veh['property_mileage'] }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class=""><span class=" fw-bold">Style of Vehicle:
                                            </span>{{ $veh['property_other_info'] }}</p>
                                    </div>
                                    <div class="col-md-4 {{ $vehicleLoan }}">
                                        <p class=""><span class=" fw-bold">Monthly payment amount:
                                            </span>{{ isset($vehPayment['monthly_payment']) ? '$' . number_format((float) $vehPayment['monthly_payment'], 2) : '' }}
                                        </p>
                                    </div>
                                    <div class="col-md-4 {{ $vehicleLoan }}">
                                        <p class=""><span class=" fw-bold">Past due payment:
                                            </span>{{ $vehPayment['past_due_amount'] ? '$' . number_format((float) $vehPayment['past_due_amount'], 2) : '' }}
                                        </p>
                                    </div>
                                    <div class="col-md-4 {{ $vehicleLoan }}">
                                        <p class=""><span class=" fw-bold">Amount Owed:
                                            </span>{{ $vehPayment['amount_own'] ? '$' . number_format((float) $vehPayment['amount_own'], 2) : '' }}
                                        </p>
                                    </div>
                                    <div class="col-md-3 {{ $vehicleLoan }}">
                                        <p class=""><span class=" fw-bold">Name of creditor:
                                            </span>{{ $vehPayment['creditor_name'] ?? '' }}</p>
                                    </div>
                                    <div class="col-md-3 {{ $vehicleLoan }}">
                                        <p class=""><span class=" fw-bold">Street Address:
                                            </span>{{ $vehPayment['creditor_name_addresss'] ?? '' }}</p>
                                    </div>
                                    <div class="col-md-2 {{ $vehicleLoan }}">
                                        <p class=""><span class=" fw-bold">City:
                                            </span>{{ $vehPayment['creditor_city'] ?? '' }}</p>
                                    </div>
                                    <div class="col-md-2 {{ $vehicleLoan }}">
                                        <p class=""><span class=" fw-bold">State:
                                            </span>{{ $vehPayment['creditor_state'] ?? '' }}</p>
                                    </div>
                                    <div class="col-md-2 {{ $vehicleLoan }}">
                                        <p class=""><span class=" fw-bold">Zip code:
                                            </span>{{ $vehPayment['creditor_zip'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="{{$dataFor}} edit-div hide-data">
                <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                    action="{{route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID])}}"
                    method="post" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-3">
                        @include('intake_form.questions.vehicles', ['formData' => $finalDetails])
                    </div>
                    <div class="bottom-btn-div px-0 mt-3">
                        <button type="button"
                            class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                            onclick="closeIntakeForm('{{$dataFor}}')">Close</button>
                        <button type="button"
                            class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                            onclick="submitIntakeForm('{{ $dataFor }}')">Save
                            Vehicles Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
