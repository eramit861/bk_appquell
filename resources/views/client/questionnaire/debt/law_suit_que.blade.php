<!-- $debtorname -->
<!-- $spousename -->

@php
$list_lawsuits_data = Helper::validate_key_value('list_lawsuits_data', $debt, 'array');
// Get current case title value
$caseTitle = Helper::validate_key_value('case_title', $list_lawsuits_data);
// Normalize case for matching
$caseTitleLower = strtolower($caseTitle);
$debtorChecked = (!empty($debtorname) && strpos($caseTitleLower, strtolower($debtorname)) !== false) ? 'checked' : '';
$spouseChecked = (!empty($spousename) && strpos($caseTitleLower, strtolower($spousename)) !== false) ? 'checked' : '';
@endphp

<div class="col-12 law_suit law_suit_div_{{ $i }} {{ Helper::validate_key_value('cards_collections', $debt, 'radio') == 6 ? '' : 'hide-data' }}">
    <div class="row ">
        <div class="col-12">
            <strong class="subtitle">Law Suit Information</strong>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="label-div">
                <div class="form-group">
                    <label class="d-flex align-items-center">
                        <span class="">Case Title</span>
                        <div class="form-check ms-auto mb-0" style="min-height: unset;">
                            <input class="form-check-input debtor" type="checkbox" id="add_debtor_{{ $i }}"
                                data-name="{{ $debtorname }}"
                                onclick="toggleNameToLawSuit(this)" {{ $debtorChecked }}>
                            <label class="form-check-label form-label mb-0"
                                for="add_debtor_{{ $i }}">Debtor</label>
                        </div>
                        @if(!empty($spousename) && $client_type == 3)
                        <div class="form-check ms-2 mb-0" style="min-height: unset;">
                            <input class="form-check-input codebtor" type="checkbox" id="add_codebtor_{{ $i }}"
                                data-name="{{ $spousename }}"
                                onclick="toggleNameToLawSuit(this)" {{ $spouseChecked }}>
                            <label class="form-check-label form-label mb-0"
                                for="add_codebtor_{{ $i }}">{{ ($client_type == 2) ? "Non-Filing Spouse" : "Co-Debtor" }}</label>
                        </div>
                        @endif
                    </label>
                    <input type="text" name="debt_tax[list_lawsuits_data][case_title][{{$i}}]"
                        class="input_capitalize form-control required case_title" placeholder="Case Title"
                        value="{{ $caseTitle }}">
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="label-div">
                <div class="form-group">
                    <label>Case Number</label>
                    <input type="text" name="debt_tax[list_lawsuits_data][case_number][{{$i}}]"
                        class="form-control required case_number" placeholder="Case Number"
                        value="{{ Helper::validate_key_value('case_number', $list_lawsuits_data) }}">
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
            @php $nature_of_case = ArrayHelper::getNatureOfCase(); @endphp
            <div class="label-div">
                <div class="form-group">
                    <label>Nature of the Case</label>
                    <select class="form-control required case_nature"
                        name="debt_tax[list_lawsuits_data][case_nature][{{$i}}]">
                        <option value="">Please Select Nature of the Case</option>
                        @foreach($nature_of_case as $us_key => $usa_vl)
                            <option value="{{ $us_key }}" {{($us_key == Helper::validate_key_value('case_nature', $list_lawsuits_data)) ? 'selected' : ''}}>{{ $usa_vl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <div class="label-div">
                <div class="form-group">
                    <label>
                        <small class="blink text-c-red mb-0">
                            Type the name of the <u>CITY</u> of the courthouse the lawsuit is filed in: </br>
                            Then select the courthouse from the drop down
                        </small>
                    </label>
                    <input type="text"
                        class="input_capitalize form-control required agency_location agency_location_autocomplete autocomplete "
                        placeholder="Enter Name Of City Of Courthouse For List Of Addresses"
                        name="debt_tax[list_lawsuits_data][agency_location][{{$i}}]"
                        value="{{ Helper::validate_key_value('agency_location', $list_lawsuits_data) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-8 col-xl-3">
            <div class="label-div">
                <div class="form-group ">
                    <label>Street Address</label>
                    <input type="text" class="input_capitalize form-control required agency_street"
                        name="debt_tax[list_lawsuits_data][agency_street][{{$i}}]" placeholder="Street Address"
                        value="{{ Helper::validate_key_value('agency_street', $list_lawsuits_data) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
            <div class="label-div">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="input_capitalize form-control required agency_city"
                        name="debt_tax[list_lawsuits_data][agency_city][{{$i}}]" placeholder="City"
                        value="{{ Helper::validate_key_value('agency_city', $list_lawsuits_data) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
            <div class="label-div">
                <div class="form-group">
                    <label>State</label>
                    <select class="form-control required agency_state"
                        name="debt_tax[list_lawsuits_data][agency_state][{{$i}}]">
                        <option disabled="">Please Select State or Territory</option>
                        {!! AddressHelper::getStatesList(Helper::validate_key_value('agency_state', $list_lawsuits_data)) !!}
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
            <div class="label-div">
                <div class="form-group">
                    <label>Zip code</label>
                    <input type="number" class="form-control allow-5digit required agency_zip"
                        name="debt_tax[list_lawsuits_data][agency_zip][{{$i}}]" placeholder="Zip"
                        value="{{ Helper::validate_key_value('agency_zip', $list_lawsuits_data) }}">
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="label-div question-area border-0 pb-0">
                <label class="fs-13px">
                    Status or Disposition
                </label>
                <!-- Radio Buttons -->
                <div class="custom-radio-group form-group mb-0 multi-input-radio-group btn-small">
                    <input type="radio" id="list-lawsuits_disposition_pending-{{ $i }}" class="d-none disposition"
                        name="debt_tax[list_lawsuits_data][disposition][{{$i}}]" required {{ Helper::validate_key_value('disposition', $list_lawsuits_data) == 1 ? 'checked' : '' }}
                        value="1">
                    <label for="list-lawsuits_disposition_pending-{{ $i }}"
                        class="btn-toggle {{ Helper::validate_key_value('disposition', $list_lawsuits_data) == 1 ? 'active' : '' }}">Pending</label>

                    <input type="radio" id="list-lawsuits_disposition_appeal-{{ $i }}" class="d-none disposition"
                        name="debt_tax[list_lawsuits_data][disposition][{{$i}}]" required {{ Helper::validate_key_value('disposition', $list_lawsuits_data) == 2 ? 'checked' : '' }}
                        value="2">
                    <label for="list-lawsuits_disposition_appeal-{{ $i }}"
                        class="btn-toggle {{ Helper::validate_key_value('disposition', $list_lawsuits_data) == 2 ? 'active' : '' }}">On
                        Appeal</label>

                    <input type="radio" id="list-lawsuits_disposition_concluded-{{ $i }}" class="d-none disposition"
                        name="debt_tax[list_lawsuits_data][disposition][{{$i}}]" required {{ Helper::validate_key_value('disposition', $list_lawsuits_data) == 3 ? 'checked' : '' }}
                        value="3">
                    <label for="list-lawsuits_disposition_concluded-{{ $i }}"
                        class="btn-toggle {{ Helper::validate_key_value('disposition', $list_lawsuits_data) == 3 ? 'active' : '' }}">Concluded</label>

                </div>

            </div>
        </div>

        <div class="col-xxl-9 align-left col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 mt-4"> <span
                class="pt-2 blink text-c-red font-weight-bold">We need a copy of the lawsuit so it can be listed in your bankruptcy and all parties are notified, protecting you after your case is complete.</span></div>

    </div>
</div>