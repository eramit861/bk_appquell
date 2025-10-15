@php
    $dataFor = 'marital-info';
    $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);
@endphp

<div class="row">
    <div class="col-12 col-md-12">
        <div class="light-gray-div">
            <h2>Marital Status</h2>
            <div class="intake-edit-div">
                <a href="javascript:void(0)" class="history-section-btn {{ $historyExists ? '' : 'hide-data' }}" onclick="openHistoryLogsModal('{{ $dataFor }}', {{ $intakeFormID }})">
                    <span class="text-bold" style="min-width: 80px !important;">
                        <i class="bi bi-clock-history"></i> History
                    </span>
                </a>
                <a href="javascript:void(0)" onclick="editIntakeData(this, '{{ $dataFor }}')" class="ml-2 edit edit-section-btn">
                    <span class="text-bold" style="min-width: 80px !important;">
                        <i class="bi bi-pencil-square"></i> Edit
                    </span>
                </a>
            </div>
            
            <div class="row gx-3 {{ $dataFor }} summary-div">
                <div class="col-12">
                    <p class="mt-2">
                        <span class="fw-bold">Current marital status: </span>
                        {{ ArrayHelper::getMartialStatus($details['martial_status']) }}
                    </p>
                </div>
            </div>
            
            <div class="{{ $dataFor }} edit-div hide-data">
                <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                      action="{{ route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID]) }}"
                      method="post" novalidate>
                    @csrf
                    <div class="row gx-3">
                        @include('intake_form.questions.marital_status', ['formData' => $finalDetails])
                    </div>
                    <div class="bottom-btn-div px-0">
                        <button type="button" class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                                onclick="closeIntakeForm('{{ $dataFor }}')">
                            Close
                        </button>
                        <button type="button" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                                onclick="submitIntakeForm('{{ $dataFor }}')">
                            Save Marital Info </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>