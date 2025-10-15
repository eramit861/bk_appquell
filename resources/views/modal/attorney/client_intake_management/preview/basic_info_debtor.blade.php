@php
    $dataFor = 'debtor-basic-info';
    $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);
@endphp

<div class="row">
    <div class="col-12 col-md-12">
        <div class="light-gray-div mt-3">
            <h2>Debtor's Basic Information</h2>
            <div class="intake-edit-div">
                <a href="javascript:void(0)" 
                   class="history-section-btn {{ $historyExists ? '' : 'hide-data' }}"
                   onclick="openHistoryLogsModal('{{ $dataFor }}', {{ $intakeFormID }})">
                    <span class="text-bold" style="min-width: 80px !important;">
                        <i class="bi bi-clock-history"></i> History
                    </span>
                </a>
                <a href="javascript:void(0)" 
                   onclick="editIntakeData(this, '{{ $dataFor }}')" 
                   class="ml-2 edit edit-section-btn">
                    <span class="text-bold" style="min-width: 80px !important;">
                        <i class="bi bi-pencil-square"></i> Edit
                    </span>
                </a>
            </div>   
            <div class="row gx-3 {{ $dataFor }} summary-div">
                <div class="col-md-4">
                    @php
                        $middle_name = $details['middle_name'] ? " " . $details['middle_name'] . ": " : " ";
                        $fullName = $details['name'] . $middle_name . $details['last_name'];
                    @endphp
                    <p class="">
                        <span class="fw-bold">Name: </span>{{ $fullName }}
                    </p>
                </div>
                <div class="col-md-8">
                    <p class="">
                        <span class="fw-bold">Suffix: </span>
                        {{ $details['suffix'] == null ? "None" : ArrayHelper::getSuffixArray($details['suffix']) }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="">
                        <span class="fw-bold">Address: </span>{{ $details['Address'] }}
                    </p>
                </div>
                <div class="col-md-3">
                    <p class="">
                        <span class="fw-bold">City: </span>{{ $details['City'] }}
                    </p>
                </div>
                <div class="col-md-2">
                    <p class="">
                        <span class="fw-bold">State: </span>{{ $details['state'] }}
                    </p>
                </div>
                <div class="col-md-2">
                    <p class="">
                        <span class="fw-bold">Zip: </span>{{ $details['zip'] }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="">
                        <span class="fw-bold">County: </span>
                        {{ \App\Models\CountyFipsData::get_county_name_by_id(Helper::validate_key_value('country', $details)) }}
                    </p>
                </div>
                <div class="col-md-3">
                    <p class="">
                        <span class="fw-bold">Home: </span>{{ $details['home'] }}
                    </p>
                </div>
                <div class="col-md-3">
                    <p class="">
                        <span class="fw-bold">Cell: </span>{{ $details['cell'] }}
                    </p>
                </div>
                
                <div class="col-md-2 {{ (isset($details['security_number']) && !empty($details['security_number'])) ? '' : 'hide-data' }}">
                    <p class="">
                        <span class="fw-bold">SSN: </span>{{ $details['security_number'] }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="">
                        <span class="fw-bold">Email: </span>{{ $details['email'] }}
                    </p>
                </div>
                
                <div class="col-md-5 {{ (isset($details['work']) && !empty($details['work'])) ? '' : 'hide-data' }}">
                    <p class="">
                        <span class="fw-bold">Driver's Lic/Gov. ID: </span>{{ $details['work'] }}
                    </p>
                </div>
                <div class="col-md-3">
                    <p class="">
                        <span class="fw-bold">Date of Birth: </span>{{ $details['date_of_birth'] }}
                    </p>
                </div>   
                <div class="col-md-12">
                    <p class="">
                        <span class="fw-bold">If you filed Chapter 13 in the last 2 years, how have your circumstances improved: </span>
                        {{ $details['chapter_13_filed_info'] }}
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="">
                        <span class="fw-bold">Have you lived at this address for at least 180 days: </span>
                        {{ Helper::key_display('lived_address_from_180', $details) }}
                    </p>
                </div>
                @if (!empty($details['lived_in_nc_month']) && !empty($details['lived_in_nc_year']))
                <div class="col-md-6">
                    <p class="">
                        <span class="fw-bold">How long have you lived in {{ \App\Helpers\AddressHelper::getStateNameByCode($attorney_company->attorney_state) }}: </span>
                        {{ $details['lived_in_nc_month'] . ', ' . $details['lived_in_nc_year'] }}
                    </p>
                </div>
                @endif
                <div class="col-md-6">
                    <p class="">
                        <span class="fw-bold">Have you ever filed a bankruptcy case before: </span>
                        {{ Helper::key_display_reverse('filed_in_last_8_yrs', $details) }}
                    </p>
                </div>

                @php
                    $any_bankruptcy_filed_before_data = Helper::validate_key_value('any_bankruptcy_filed_before_data', $details);
                    $hasFiledBefore = Helper::validate_key_value('filed_in_last_8_yrs', $details, 'radio') == 0 && !empty($any_bankruptcy_filed_before_data);
                @endphp

                @if($hasFiledBefore)
                    @php
                        $any_bankruptcy_filed_before_data = json_decode($any_bankruptcy_filed_before_data, true);
                        $caseNames = [];
                        if (is_array($any_bankruptcy_filed_before_data)) {
                            $caseNames = Helper::validate_key_value('case_name', $any_bankruptcy_filed_before_data, 'array');
                            $count = count($caseNames);
                        } else {
                            $count = 0;
                        }
                    @endphp

                    @if($count > 0)
                        <div class="col-md-12">
                            <div class="px-3">
                                <div class="row additional-que-div-parent">
                                    <div class="col-md-4">
                                        <p class=""><span class="fw-bold">Case Name: </span></p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class=""><span class="fw-bold">Date Filed: </span></p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class=""><span class="fw-bold">Case Number: </span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class=""><span class="fw-bold">District if (known): </span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @for($i = 0; $i < $count; $i++)
                            <div class="col-md-12">
                                <div class="px-3 {{ $i == $count - 1 ? 'mb-3' : '' }}">
                                    <div class="row additional-que-div">
                                        <div class="col-md-4">
                                            <p class="">
                                                <span class="fw-bold">{{ $i + 1 }}. </span>
                                                {{ Helper::validate_key_loop_value('case_name', $any_bankruptcy_filed_before_data, $i) }}
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <p class="">
                                                {{ Helper::validate_key_loop_value('data_field', $any_bankruptcy_filed_before_data, $i) }}
                                                @if(Helper::validate_key_loop_value('data_field_unsure', $any_bankruptcy_filed_before_data, $i) == 'on')
                                                    @if(!empty(Helper::validate_key_loop_value('data_field', $any_bankruptcy_filed_before_data, $i)))
                                                        <br>
                                                    @endif
                                                    <small>(unsure)</small>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <p class="">
                                                {{ Helper::validate_key_loop_value('case_numbers', $any_bankruptcy_filed_before_data, $i) }}
                                                @if(Helper::validate_key_loop_value('case_numbers_unknown', $any_bankruptcy_filed_before_data, $i) == 'on')
                                                    @if(!empty(Helper::validate_key_loop_value('case_numbers', $any_bankruptcy_filed_before_data, $i)))
                                                        <br>
                                                    @endif
                                                    <small>(unknown)</small>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="">
                                                {{ Helper::validate_key_loop_value('district_if_known', $any_bankruptcy_filed_before_data, $i) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endif
                @endif

                <div class="col-md-12">
                    <p class="">
                        <span class="fw-bold">Number of family members and others living with you (including your spouse): </span>
                        {{ $details['family_members'] }}
                    </p>
                </div>
            </div>
            <div class="{{ $dataFor }} edit-div hide-data">
                <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                      action="{{ route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID]) }}"
                      method="post" novalidate>
                    @csrf
                    <div class="row gx-3">
                        @include('intake_form.questions.basic_info_debtor', ['formData' => $finalDetails])
                    </div>
                    <div class="bottom-btn-div px-0">
                        <button type="button" class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                                onclick="closeIntakeForm('{{ $dataFor }}')">
                            Close
                        </button>
                        <button type="button" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                                onclick="submitIntakeForm('{{ $dataFor }}')">
                            Save Debtor Basic Info
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>