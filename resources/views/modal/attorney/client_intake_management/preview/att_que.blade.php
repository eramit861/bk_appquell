@php
    $dataFor = 'attorney-ques-info';
    $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);
@endphp
<div class="row">
    <div class="col-12 col-md-12">
        <div class="light-gray-div mb-0">
            <h2>Additional Questions</h2>
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
            <div class="row gx-3 {{ $dataFor }} summary-div">
                @if (!empty($concierge_questions))
                    @foreach ($concierge_questions as $key => $value)
                        <div class="col-md-12">
                            <p class=""><span class=" fw-bold">{{ $value['question'] }}:
                                </span>{{ Helper::key_display_reverse('value', $value) }}</p>
                        </div>
                    @endforeach
                @endif
                <div class="col-md-12">
                    <p class=""><span class=" fw-bold">Are you being sued:
                        </span>{{ Helper::key_display_reverse('being_sued', $details) }}</p>
                </div>
                <div class="col-md-12">
                    <p class=""><span class=" fw-bold">Are your wages currently being garnished:
                        </span>{{ Helper::key_display_reverse('wages_being_garnished', $details) }}</p>
                </div>
                <div class="col-md-12">
                    <p class=""><span class=" fw-bold">Is there anything else you would like to share that would be
                            useful for us to know for our appointment:
                        </span>{{ Helper::validate_key_value('extra_notes', $details) }}</p>
                </div>
            </div>
            <div class="{{ $dataFor }} edit-div hide-data">
                <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                    action="{{route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID])}}"
                    method="post" novalidate>
                    @csrf
                    <div class="row gx-3">
                        @include('intake_form.questions.other_debt_aq', ['formData' => $finalDetails])
                    </div>
                    <div class="bottom-btn-div px-0">
                        <button type="button"
                            class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                            onclick="closeIntakeForm('{{$dataFor}}')">Close</button>
                        <button type="button"
                            class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                            onclick="submitIntakeForm('{{ $dataFor }}')">Save
                            Additional Questions Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>