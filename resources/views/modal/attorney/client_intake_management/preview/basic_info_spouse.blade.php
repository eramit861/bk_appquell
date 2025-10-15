@php
    $dataFor = 'spouse-basic-info';
    $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);
@endphp

<div class="row {{ $spouseClass }}">
    <div class="col-12 col-md-12">
        <div class="light-gray-div">
            <h2>Co-Debtor's/Spouse's Information</h2>
            <div class="intake-edit-div">
                <a href="javascript:void(0)" class="history-section-btn {{ $historyExists ? '' : 'hide-data' }}" onclick="openHistoryLogsModal('{{ $dataFor }}', {{ $intakeFormID }})">
                    <span class="text-bold" style="min-width: 80px !important;"> <i class="bi bi-clock-history"></i> History </span>
                </a>
                <a href="javascript:void(0)" onclick="editIntakeData(this, '{{ $dataFor }}')" class="ml-2 edit edit-section-btn">
                    <span class="text-bold" style="min-width: 80px !important;"><i class="bi bi-pencil-square"></i> Edit </span>
                </a>
            </div>
            <div class="row gx-3 {{ $dataFor }} summary-div">
                <div class="col-md-4">
                    @php
                        $middle_name = $details['spouse_middle_name'] ? " " . $details['spouse_middle_name'] . " " : " ";
                        $spouseFullName = $details['spouse_name'] . $middle_name . $details['spouse_last_name'];
                    @endphp
                    <p class=""> <span class="fw-bold">Name: </span>{{ $spouseFullName }}</p>
                </div>
                <div class="col-md-3">
                    <p class="">
                        <span class="fw-bold">Suffix: </span>
                        {{ ($details['spouse_suffix'] == null) ? "None" : ArrayHelper::getSuffixArray($details['spouse_suffix'] ?? "") }}
                    </p>
                </div>                     
                <div class="col-md-5">
                    <p class="">
                        <span class="fw-bold">Is your Spouse filing with you: </span>
                        {{ Helper::key_display_reverse('spouse_filing_with_you', $details) }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="">
                        <span class="fw-bold">Cell: </span>{{ $details['spouse_cell'] }}
                    </p>
                </div>
                
                <div class="col-md-3 {{ (isset($details['spouse_security_number']) && !empty($details['spouse_security_number'])) ? '' : 'hide-data' }}">
                    <p class="">
                        <span class="fw-bold">SSN: </span>{{ $details['spouse_security_number'] }}
                    </p>
                </div>
                
                <div class="col-md-4 {{ (isset($details['spouse_email']) && !empty($details['spouse_email'])) ? '' : 'hide-data' }}">
                    <p class="">
                        <span class="fw-bold">Email: </span>{{ $details['spouse_email'] }}
                    </p>
                </div>
                
                <div class="col-md-4 {{ (isset($details['spouse_work']) && !empty($details['spouse_work'])) ? '' : 'hide-data' }}">
                    <p class="">
                        <span class="fw-bold">Driver's License/Gov. ID: </span>{{ $details['spouse_work'] }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="">
                        <span class="fw-bold">Date of Birth: </span>{{ $details['spouse_date_of_birth'] }}
                    </p>
                </div>
            </div>
            <div class="{{ $dataFor }} edit-div hide-data">
                <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                      action="{{ route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID]) }}"
                      method="post" novalidate>
                    @csrf
                    <div class="row gx-3">
                        @include('intake_form.questions.basic_info_spouse', ['formData' => $finalDetails, 'isPreviewPopup' => true])
                    </div>
                    <div class="bottom-btn-div px-0">
                        <button type="button" class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red" onclick="closeIntakeForm('{{ $dataFor }}')">
                            Close
                        </button>
                        <button type="button" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green" onclick="submitIntakeForm('{{ $dataFor }}')">
                            Save Spouse Basic Info
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>