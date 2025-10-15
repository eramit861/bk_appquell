@php
    $dataFor = 'mortgage-info';
    $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);

    $rentOrOwn = '';
    $rentSectionClass = 'hide-data';
    $ownSectionClass = 'hide-data';
    $parentOwnSectionClass = 'hide-data';
    $mainOwnSectionClass = 'hide-data';

    if (isset($details['rent_or_own'])) {
        if ($details['rent_or_own'] == 0) {
            $rentOrOwn = 'Rent';
            $rentSectionClass = '';
        } elseif ($details['rent_or_own'] == 1) {
            $rentOrOwn = 'Own';
            $mainOwnSectionClass = '';
        }
    }

    if (array_key_exists('loan_on_property', $details) && $details['loan_on_property'] === 0) {
        $ownSectionClass = '';
        $parentOwnSectionClass = '';
    }

    $mortgageAdditionalLoans_2 = '';
    $yesOptionClass1 = 'hide-data';
    $noOptionClass1 = 'hide-data';
    $ownSectionClass2 = 'hide-data';

    if (isset($details['mortgage_additional_loans'])) {
        if ($details['mortgage_additional_loans'] == 0) {
            $mortgageAdditionalLoans_2 = 'No';
            $noOptionClass1 = '';
        } elseif ($details['mortgage_additional_loans'] == 1) {
            $mortgageAdditionalLoans_2 = 'Yes';
            $yesOptionClass1 = '';
            $ownSectionClass2 = '';
        }
    }

    $mortgageAdditionalLoans_3 = '';
    $yesOptionClass2 = 'hide-data';
    $noOptionClass2 = 'hide-data';
    $ownSectionClass3 = 'hide-data';

    if (isset($details['mortgage_additional_loans_2'])) {
        if ($details['mortgage_additional_loans_2'] == 0) {
            $mortgageAdditionalLoans_3 = 'No';
            $noOptionClass2 = '';
        } elseif ($details['mortgage_additional_loans_2'] == 1) {
            $mortgageAdditionalLoans_3 = 'Yes';
            $yesOptionClass2 = '';
            $ownSectionClass3 = '';
        }
    }

    $foreclosureValue = '';
    $foreclosureSectionClass = 'hide-data';
    if (isset($details['mortgage_foreclosure_property'])) {
        if ($details['mortgage_foreclosure_property'] == 0) {
            $foreclosureValue = 'Yes';
            $foreclosureSectionClass = '';
        } elseif ($details['mortgage_foreclosure_property'] == 1) {
            $foreclosureValue = 'No';
        }
    }

    $fmt = fn ($v) => $v ? '$' . number_format((float)$v, 2) : '';

    $property_own_data = Helper::validate_key_value('property_own_data', $details);
    $property_own_data = json_decode($property_own_data, 1);

    $not_primary_address = Helper::validate_key_value('not_primary_address', $property_own_data, 'radio');
    $property_address = Helper::validate_key_value('property_address', $property_own_data);
    $property_city = Helper::validate_key_value('property_city', $property_own_data);
    $property_state = Helper::validate_key_value('property_state', $property_own_data);
    $property_zip = Helper::validate_key_value('property_zip', $property_own_data);
    $property_county = Helper::validate_key_value('property_county', $property_own_data);
    $property_type = Helper::validate_key_value('property_type', $property_own_data);
    $property_type_name = Helper::validate_key_value('property_type_name', $property_own_data);
    $property_bedrooms = Helper::validate_key_value('property_bedrooms', $property_own_data);
    $property_bathrooms = Helper::validate_key_value('property_bathrooms', $property_own_data);
    $property_home_sq_ft = Helper::validate_key_value('property_home_sq_ft', $property_own_data);
    $property_lot_size_acres = Helper::validate_key_value('property_lot_size_acres', $property_own_data);
    $property_owned_by = Helper::validate_key_value('property_owned_by', $property_own_data);

    $property = [
        1 => 'Single family home',
        2 => 'Duplex or multi-unit building',
        3 => 'Condominium or cooperative',
        4 => 'Manufactured or mobile home',
        5 => 'Land',
        6 => 'Investment property',
        7 => 'Timeshare',
        8 => 'Other'
    ];

    $mortgagePropertyAddress = null;
    if($not_primary_address == 1) {
        $mortgagePropertyAddress = $details['Address'];
        $mortgagePropertyAddress .= $details['City'] ? ', ' . $details['City'] : '';
        $mortgagePropertyAddress .= $details['state'] ? ', ' . $details['state'] : '';
        $mortgagePropertyAddress .= $details['zip'] ? ', ' . $details['zip'] : '';
    }else{
        $mortgagePropertyAddress = $property_address;
        $mortgagePropertyAddress .= $property_city ? ', ' . $property_city : '';
        $mortgagePropertyAddress .= $property_state ? ', ' . $property_state : '';
        $mortgagePropertyAddress .= $property_zip ? ', ' . $property_zip : '';
    }

    $sessionId = Helper::validate_key_value('session_id', $details);

    $address_as_dir = DocumentHelper::sanitizeDirectoryName($mortgagePropertyAddress);
    $s3storePath = 'intake_form_residence_value/'.$sessionId.'/'.$address_as_dir;
    $filePth = null;
    if (\Storage::disk('s3')->exists($s3storePath)) {
        $files = \Storage::disk('s3')->files($s3storePath);
        if (!empty($files)) {
            $filePth = \Storage::disk('s3')->temporaryUrl(
                $files[0],
                now()->addMinutes(30), // Expires in 30 minutes
                ['ResponseContentDisposition' => 'attachment']
            );
        }
    }
@endphp
<div class="row">
    <div class="col-12 col-md-12">
        <div class="light-gray-div">
            <h2>Rental or Home Ownership</h2>
            <div class="intake-edit-div">
                <a href="javascript:void(0)" class="history-section-btn {{ $historyExists ? '' : 'hide-data' }}"
                    onclick="openHistoryLogsModal('{{ $dataFor }}',  {{ $intakeFormID }})">
                    <span class="text-bold" style="min-width: 80px !important;"><i class="bi bi-clock-history"></i> History </span>
                </a>
                <a href="javascript:void(0)" onclick="editIntakeData(this, '{{ $dataFor }}')" class="ml-2 edit edit-section-btn">
                    <span class="text-bold" style="min-width: 80px !important;"><i class="bi bi-pencil-square"></i> Edit </span>
                </a>
            </div>
            <div class="row gx-3 {{$dataFor}} summary-div">
                <div class="col-md-4">
                    <p class=""><span class=" fw-bold">Rent or Own: </span>{{ $rentOrOwn }}</p>
                </div>
                <div class="col-md-8 {{ $rentSectionClass }}">
                    <label for="" class="mb-2 w-100 dotted-line">
                        <span class="title"><span class="text-bold">Monthly Rent</span></span>
                        <span class="amount float-end">{{ $fmt($details['mortgage_rent_1'] ?? null) }}</span>
                    </label>
                </div>

                {{-- Primary Property or not --}}
                <div class="col-md-8 {{ $mainOwnSectionClass }}">
                    <p class=""><span class=" fw-bold">Is this property your primary residence: </span>{{ $not_primary_address == 1 ? 'No' : 'Yes' }}</p>
                </div>

                {{-- Property Address Section (Only shown if not primary) --}}
                @if($not_primary_address == 1)
                <div class="col-md-4 {{ $mainOwnSectionClass }}">
                    <p class="">
                        <span class="fw-bold">Address: </span>{{ $property_address }}
                    </p>
                </div>
                <div class="col-md-3 {{ $mainOwnSectionClass }}">
                    <p class="">
                        <span class="fw-bold">City: </span>{{ $property_city }}
                    </p>
                </div>
                <div class="col-md-2 {{ $mainOwnSectionClass }}">
                    <p class="">
                        <span class="fw-bold">State: </span>{{ $property_state }}
                    </p>
                </div>
                <div class="col-md-2 {{ $mainOwnSectionClass }}">
                    <p class="">
                        <span class="fw-bold">Zip: </span>{{ $property_zip }}
                    </p>
                </div>
                <div class="col-md-4 {{ $mainOwnSectionClass }}">
                    <p class="">
                        <span class="fw-bold">County: </span>
                        {{ \App\Models\CountyFipsData::get_county_name_by_id($property_county) }}
                    </p>
                </div>
                @endif
                @if(!empty($propertyFilePth))
                    <div class="col-md-8">
                        <p class="mt-2"><span class=" fw-bold">Attached File:
                        </span><a href="{{ $propertyFilePth }}" target="_blank" class="btn-new-ui-default p-sm-1 ms-2 me-1 blue-pdf-icon" title="Download File">Download</a></p>
                    </div>
                @endif

                {{-- Type of property --}}
                <div class="col-md-8 {{ $mainOwnSectionClass }}">
                    <p class=""><span class=" fw-bold">Type of property: </span>{{ isset($property[$property_type]) ? $property[$property_type] : '' }}</p>
                </div>

                {{-- Property Description based on type (1-4: homes, 5-6: land/investment) --}}
                @if(in_array($property_type, [1, 2, 3, 4]))
                <div class="col-md-12 {{ $mainOwnSectionClass }}">
                    <div class="row gx-3">
                        <div class="col-md-3">
                            <p class=""><span class=" fw-bold">Bedrooms: </span>{{ $property_bedrooms }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class=""><span class=" fw-bold">Bathrooms: </span>{{ $property_bathrooms }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class=""><span class=" fw-bold">Square Feet of home: </span>{{ $property_home_sq_ft }} sqft</p>
                        </div>
                    </div>
                </div>
                @endif

                @if(in_array($property_type, [5, 6]))
                <div class="col-md-4 {{ $mainOwnSectionClass }}">
                    <p class=""><span class=" fw-bold">Lot size in Acres: </span>{{ $property_lot_size_acres }} acre</p>
                </div>
                @endif

                {{-- Property Value: --}}
                <div class="col-md-6 {{ $mainOwnSectionClass }}">
                    <p class=""><span class=" fw-bold">Estimated Value of Property: </span>{{ $fmt($details['mortgage_property_value_1'] ?? null) }}</p>
                </div>

                {{-- Owned by: --}}
                <div class="col-md-6 {{ $mainOwnSectionClass }}">
                    @php
                        $ownedByText = '';
                        switch($property_owned_by) {
                            case '1': $ownedByText = 'Self'; break;
                            case '2': $ownedByText = 'Spouse'; break;
                            case '3': $ownedByText = 'Joint'; break;
                            case '4': $ownedByText = 'Other'; break;
                            case '5': $ownedByText = 'Possessory interest only'; break;
                            default: $ownedByText = $property_owned_by;
                        }
                    @endphp
                    <p class=""><span class=" fw-bold">Owned by: </span>{{ $ownedByText }}</p>
                </div>
                
                <div class="col-md-8 ">
                    <p class=""><span class=" fw-bold">Do you have a loan on this property: </span>{{ Helper::key_display_reverse('loan_on_property', $details) }}</p>
                </div>

                <div class="col-md-12 {{ $ownSectionClass }}">
                    <div class="px-3">
                        <div class="row additional-que-div mortgage">
                            <div class="col-md-12 {{ $ownSectionClass }}">
                                <p class=""><span class=" fw-bold">Mortgage - 1st
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-4 {{ $ownSectionClass }}">
                                <p class=""><span class=" fw-bold">Amount Owed: </span>{{ $fmt($details['mortgage_amount_owned_1'] ?? null) }} </p>
                            </div>
                            <div class="col-md-4 {{ $ownSectionClass }}">
                                <p class=""><span class=" fw-bold">Monthly Payment: </span>{{ $fmt($details['mortgage_own_1'] ?? null) }} </p>
                            </div>
                            <div class="col-md-4 {{ $ownSectionClass }}">
                                <p class=""><span class=" fw-bold">Past Due Payments: </span>{{ $fmt($details['mortgage_past_payment_1'] ?? null) }} </p>
                            </div>
                            <div class="col-md-4 {{ $ownSectionClass }}">
                                <p class=""><span class=" fw-bold">Property Value: </span>{{ $fmt($details['mortgage_property_value_1'] ?? null) }} </p>
                            </div>
                            <div class="col-md-8 {{ $ownSectionClass }}"></div>
                            <div class="col-md-3 {{ $ownSectionClass }}">
                                <p class=""><span class=" fw-bold">Name: </span>{{ $details['mortgages_creditor_name_1'] ?? '' }}</p>
                            </div>
                            <div class="col-md-3 {{ $ownSectionClass }}">
                                <p class=""><span class=" fw-bold">Street Address: </span>{{ $details['mortgages_creditor_address_1'] ?? '' }}</p>
                            </div>
                            <div class="col-md-2 {{ $ownSectionClass }}">
                                <p class=""><span class=" fw-bold">City: </span>{{ $details['mortgages_creditor_city_1'] ?? '' }}</p>
                            </div>
                            <div class="col-md-2 {{ $ownSectionClass }}">
                                <p class=""><span class=" fw-bold">State: </span>{{ $details['mortgages_creditor_state_1'] ?? '' }}</p>
                            </div>
                            <div class="col-md-2 {{ $ownSectionClass }}">
                                <p class=""><span class=" fw-bold">Zip code: </span>{{ $details['mortgages_creditor_zipcode_1'] ?? '' }}</p>
                            </div>
                            <div class="col-md-12 {{ $ownSectionClass }}">
                                <p class=""><span class=" fw-bold">Do you have additional loans: </span>{{ $mortgageAdditionalLoans_2 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 {{ $ownSectionClass2 }} {{ $yesOptionClass1 }} {{ $parentOwnSectionClass }}">
                    <div class="px-3">
                        <div class="row additional-que-div mortgage">
                            <div class="col-md-12 {{ $ownSectionClass2 }} {{ $yesOptionClass1 }}">
                                <p class=""><span class=" fw-bold">Mortgage - 2nd
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-4 {{ $ownSectionClass2 }} {{ $yesOptionClass1 }}">
                                <p class=""><span class=" fw-bold">Amount Owed: </span>{{ $fmt($details['mortgage_amount_owned_2'] ?? null) }}
                                </p>
                            </div>
                            <div class="col-md-4 {{ $ownSectionClass2 }} {{ $yesOptionClass1 }}">
                                <p class=""><span class=" fw-bold">Monthly Payment: </span>{{ $fmt($details['mortgage_own_2'] ?? null) }}
                                </p>
                            </div>
                            <div class="col-md-4 {{ $ownSectionClass2 }} {{ $yesOptionClass1 }}">
                                <p class=""><span class=" fw-bold">Past Due Payments: </span>{{ $fmt($details['mortgage_past_payment_2'] ?? null) }}
                                </p>
                            </div>
                            <div class="col-md-3 {{ $ownSectionClass2 }} {{ $yesOptionClass1 }}">
                                <p class=""><span class=" fw-bold">Name: </span>{{ $details['mortgages_creditor_name_2'] ?? '' }}</p>
                            </div>
                            <div class="col-md-3 {{ $ownSectionClass2 }} {{ $yesOptionClass1 }}">
                                <p class=""><span class=" fw-bold">Street Address: </span>{{ $details['mortgages_creditor_address_2'] ?? '' }}</p>
                            </div>
                            <div class="col-md-2 {{ $ownSectionClass2 }} {{ $yesOptionClass1 }}">
                                <p class=""><span class=" fw-bold">City: </span>{{ $details['mortgages_creditor_city_2'] ?? '' }}</p>
                            </div>
                            <div class="col-md-2 {{ $ownSectionClass2 }} {{ $yesOptionClass1 }}">
                                <p class=""><span class=" fw-bold">State: </span>{{ $details['mortgages_creditor_state_2'] ?? '' }}</p>
                            </div>
                            <div class="col-md-2 {{ $ownSectionClass2 }} {{ $yesOptionClass1 }}">
                                <p class=""><span class=" fw-bold">Zip code: </span>{{ $details['mortgages_creditor_zipcode_2'] ?? '' }}</p>
                            </div>
                            <div class="col-md-3 {{ $ownSectionClass2 }} {{ $yesOptionClass1 }} {{ $noOptionClass1 }}">
                            </div>
                            <div class=" {{ $ownSectionClass3 }} ">
                                <p class=""><span class=" fw-bold">Do you have additional loans: </span>{{ $mortgageAdditionalLoans_3 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 {{ $ownSectionClass3 }} {{ $yesOptionClass2 }} {{ $parentOwnSectionClass }} mb-2">
                    <div class="px-3">
                        <div class="row additional-que-div mortgage">
                            <div class="col-md-12 {{ $ownSectionClass3 }} {{ $yesOptionClass2 }}">
                                <p class=""><span class=" fw-bold">Mortgage - 3rd
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-4 {{ $ownSectionClass3 }} {{ $yesOptionClass2 }}">
                                <p class=""><span class=" fw-bold">Amount Owed: </span>{{ $fmt($details['mortgage_amount_owned_3'] ?? null) }}
                                </p>
                            </div>
                            <div class="col-md-4 {{ $ownSectionClass3 }} {{ $yesOptionClass2 }}">
                                <p class=""><span class=" fw-bold">Monthly Payment: </span>{{ $fmt($details['mortgage_own_3'] ?? null) }}
                                </p>
                            </div>
                            <div class="col-md-4 {{ $ownSectionClass3 }} {{ $yesOptionClass2 }}">
                                <p class=""><span class=" fw-bold">Past Due Payments: </span>{{ $fmt($details['mortgage_past_payment_3'] ?? null) }}
                                </p>
                            </div>
                            <div class="col-md-3 {{ $ownSectionClass3 }} {{ $yesOptionClass2 }}">
                                <p class=""><span class=" fw-bold">Name: </span>{{ $details['mortgages_creditor_name_3'] ?? '' }}</p>
                            </div>
                            <div class="col-md-3 {{ $ownSectionClass3 }} {{ $yesOptionClass2 }}">
                                <p class=""><span class=" fw-bold">Street Address: </span>{{ $details['mortgages_creditor_address_3'] ?? '' }}</p>
                            </div>
                            <div class="col-md-2 {{ $ownSectionClass3 }} {{ $yesOptionClass2 }}">
                                <p class=""><span class=" fw-bold">City: </span>{{ $details['mortgages_creditor_city_3'] ?? '' }}</p>
                            </div>
                            <div class="col-md-2 {{ $ownSectionClass3 }} {{ $yesOptionClass2 }}">
                                <p class=""><span class=" fw-bold">State: </span>{{ $details['mortgages_creditor_state_3'] ?? '' }}</p>
                            </div>
                            <div class="col-md-2 {{ $ownSectionClass3 }} {{ $yesOptionClass2 }}">
                                <p class=""><span class=" fw-bold">Zip code: </span>{{ $details['mortgages_creditor_zipcode_3'] ?? '' }}</p>
                            </div>
                            <div class="col-md-3 {{ $ownSectionClass3 }} {{ $yesOptionClass2 }} {{ $noOptionClass2 }}">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <p class=""><span class=" fw-bold">Property in foreclosure: </span>{{ $foreclosureValue }}</p>
                </div>
                <div class="col-md-4  {{ $foreclosureSectionClass }}">
                    <p class=""><span class=" fw-bold">Foreclosure sale date been set: </span>{{ Helper::key_display_reverse('mortgage_foreclosure_date', $details) }}</p>
                </div>
                <div class="col-md-4  {{ $foreclosureSectionClass }}">
                    <p class=""><span class=" fw-bold">Date Foreclosure Scheduled: </span>{!! Helper::validate_key_value('mortgage_foreclosure_date', $details, 'radio') == 0 ? '<span class="text-danger">N/A</span>' : ($details['mortgage_foreclosure_date_scheduled'] ?? '') !!}</p>
                </div>
                <div class="col-md-12  {{ $foreclosureSectionClass }}">
                    <p class=""><span class=" fw-bold">Notes: </span>{{ $details['mortgage_notes'] ?? '' }}</p>
                </div>
            </div>

            <div class="{{$dataFor}} edit-div hide-data">
                <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                    action="{{route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID])}}"
                    method="post" novalidate>
                    @csrf
                    <div class="row gx-3">
                        @include('intake_form.questions.mortgage', ['formData' => $finalDetails])
                    </div>
                    <div class="bottom-btn-div px-0">
                        <button type="button"
                            class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                            onclick="closeIntakeForm('{{$dataFor}}')">Close</button>
                        <button type="button"
                            class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                            onclick="submitIntakeForm('{{ $dataFor }}')">Save
                            Mortgage Info</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>