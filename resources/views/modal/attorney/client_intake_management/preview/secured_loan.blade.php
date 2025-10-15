@php
    $dataFor = 'secured-loan-info';
    $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);
@endphp
<div class="row">
    <div class="col-12 col-md-12">
        <div class="light-gray-div">
            <h2>Other Secured Loans</h2>
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
                @php
                    $additionalLiensYesOrNo = "";
                    $additionalLiensYesSection = "hide-data";
                    if ($details['additional_liens'] == 0) {
                        $additionalLiensYesOrNo = "No";
                    }
                    if ($details['additional_liens'] == 1) {
                        $additionalLiensYesOrNo = "Yes";
                        $additionalLiensYesSection = "";
                    }
                @endphp
                <div class="col-md-12">
                    <p class=""><span class=" fw-bold">Do you have any additional liens or loans secured against any
                            real or personal property not already listed:
                        </span>{{ $additionalLiensYesOrNo }}</p>
                </div>
                <div class="col-md-12 {{ $additionalLiensYesSection }}">
                    @php
                        $additional_liens_data = $details['additional_liens_data'];
                        $additional_liens_data = json_decode($additional_liens_data, true);
                        $i = 0;
                    @endphp
                    @if(!empty($additional_liens_data))
                        @foreach($additional_liens_data as $val => $data)
                            @php $i++; @endphp
                            <div class="px-3 {{ $i +1  == count($additional_liens_data) ? 'mb-3' : '' }}">
                                <div class="row additional-que-div mortgage">
                                    <div class="col-md-3">
                                        <p class=""><span class=" fw-bold">Secure creditor name:
                                            </span>{{ $data["domestic_support_name"] ?? '' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class=""><span class=" fw-bold">Address:
                                            </span>{{ $data["domestic_support_address"] ?? '' }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class=""><span class=" fw-bold">City:
                                            </span>{{ $data["domestic_support_city"] ?? '' }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class=""><span class=" fw-bold">State:
                                            </span>{{ $data["creditor_state"] ?? '' }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class=""><span class=" fw-bold">Zip:
                                            </span>{{ $data["domestic_support_zipcode"] ?? '' }}</p>
                                    </div>

                                    <div class="col-md-12">
                                        <p class=""><span class=" fw-bold">Property Description:
                                            </span>{{ $data["describe_secure_claim"] ?? '' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class=""><span class=" fw-bold">Monthly Payment:
                                            </span>{{ isset($data['monthly_payment']) ? '$' . number_format((float) $data['monthly_payment'], 2) : '' }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class=""><span class=" fw-bold">Amount Due:
                                            </span>{{ isset($data['additional_liens_due']) ? '$' . number_format((float) $data['additional_liens_due'], 2) : '' }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class=""><span class=" fw-bold">Date:
                                            </span>{{ $data["additional_liens_date"] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="{{ $dataFor }} edit-div hide-data">
                <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                    action="{{route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID])}}"
                    method="post" novalidate>
                    @csrf
                    <div class="row gx-3">
                        @include('intake_form.questions.secured_loan', ['formData' => $finalDetails])
                    </div>
                    <div class="bottom-btn-div px-0">
                        <button type="button"
                            class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                            onclick="closeIntakeForm('{{$dataFor}}')">Close</button>
                        <button type="button"
                            class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                            onclick="submitIntakeForm('{{ $dataFor }}')">Save
                            Other Secured Loans Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>