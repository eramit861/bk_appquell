@php
    $emergency_check = \Helper::validate_key_value('emergency_check', $details);
    $emergency_notes = \Helper::validate_key_value('emergency_notes', $details);
    $eAA = \App\Helpers\ArrayHelper::getEmergencyAssessmentArray();
    $emergencyCheckArr = \Helper::validate_key_value('emergency_check', $details);
    $emergencyCheckArr = json_decode($emergencyCheckArr, true);
    $emergency_check = json_decode($emergency_check, true);
    $dataFor = 'emergency-info';
@endphp

@if (!empty($emergency_check) || !empty($emergency_notes))
    @php
        $historyExists = \Helper::checkSectionKeyExists($historyLog, $dataFor);
    @endphp

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="light-gray-div">
                <h2>Emergency Assessment Information</h2>
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
                    @if (!empty($emergency_check) && is_array($emergency_check))
                        <div class="col-md-12">
                            <p class="">
                                <span class="fw-bold">Urgent Situations : </span>
                                @foreach ($emergency_check as $key => $status)
                                    @if ($status == 1)
                                        {{ \Helper::validate_key_value($key, $eAA) }},
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    @endif

                    @if (!empty($emergency_notes))
                        <div class="col-md-12">
                            <p class="">
                                <span class="fw-bold">Notes : </span>
                                {{ $emergency_notes }}
                            </p>
                        </div>
                    @endif
                </div>

                <div class="row gx-3 {{ $dataFor }} edit-div hide-data">
                    <div class="col-12">
                        <form name="intake_form_save_by_attorney"
                              id="intake_form_save_by_attorney_{{ $dataFor }}"
                              action="{{ route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID]) }}"
                              method="post"
                              novalidate>
                            @csrf
                            <div class="mb-3">
                                @include('intake_form.questions.emergency_checks', ['formData' => $finalDetails])
                            </div>

                            <div class="bottom-btn-div px-0">
                                <button type="button"
                                        class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                                        onclick="closeIntakeForm('{{ $dataFor }}')">Close</button>
                                <button type="button"
                                        class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                                        onclick="submitIntakeForm('{{ $dataFor }}')">Save Emergency Assessment Info</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
