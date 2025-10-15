@php
    $dataFor = 'back-tax-info';
    $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);
@endphp
<div class="row">
    <div class="col-12 col-md-12">
        <div class="light-gray-div">
            <h2>Back taxes owed</h2>
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
                <div class="col-md-12">
                    <p class=""><span class=" fw-bold">Have you filed State & Federal taxes the last 5 years:
                        </span>{{ Helper::key_display("last_5_year_taxes", $details) }}</p>
                </div>

                <div class="col-md-12 ">
                    <div class="px-3 mb-3">
                        <div class="row additional-que-div mortgage">
                            <div class="col-md-12">
                                <p class=""><span class=" fw-bold">IRS and State Back Taxes
                                    </span>
                                </p>
                            </div>
                            
                            <div
                                class="{{ (Helper::validate_key_value('tax_owned_irs', $details, 'radio') == 1) ? 'col-md-4' : 'col-md-12' }}">
                                <p class=""><span class=" fw-bold">Owe any back taxes to the IRS:
                                    </span>{{ Helper::key_display("tax_owned_irs", $details) }}</p>
                            </div>
                            <div class="col-md-4 {{ Helper::key_hide_show('tax_owned_irs', $details) }}">
                                <p class=""><span class=" fw-bold">Which year(s):
                                    </span>{{ $details['taxes_internal_revenue_year'] }}</p>
                            </div>
                            <div class="col-md-4 {{ Helper::key_hide_show('tax_owned_irs', $details) }}">
                                <p class=""><span class=" fw-bold">Total Taxes Due:
                                    </span>{{ $details['taxes_irs_taxes_due'] ? '$' . number_format((float) $details['taxes_irs_taxes_due'], 2) : '' }}
                                </p>
                            </div>
                            
                            <div
                                class="{{ (Helper::validate_key_value('back_taxes_owed', $details, 'radio') == 1) ? 'col-md-6' : 'col-md-12' }}">
                                <p class=""><span class=" fw-bold">Do you owe any back taxes owed to the State:
                                    </span>{{ Helper::key_display("back_taxes_owed", $details) }}</p>
                            </div>

                            <div class="col-md-2 {{ Helper::key_hide_show('back_taxes_owed', $details) }}">
                                <p class=""><span class=" fw-bold">Taxes - State:
                                    </span>{{ $details['taxes_tax_state'] }}</p>
                            </div>
                            <div class="col-md-4 {{ Helper::key_hide_show('back_taxes_owed', $details) }}">
                                <p class=""><span class=" fw-bold">Which year(s):
                                    </span>{{ $details['taxes_franchise_tax_board'] }}</p>
                            </div>
                            <div class="col-md-12 {{ Helper::key_hide_show('back_taxes_owed', $details) }}">
                                <p class=""><span class=" fw-bold">Total State Taxes Due:
                                    </span>{{ $details['taxes_state_tax_due'] ? '$' . number_format((float) $details['taxes_state_tax_due'], 2) : '' }}
                                </p>
                            </div>
                            @php
                                $childSuppYesOrNo = "";
                                $childSuppYesSection = "hide-data";
                                if ($details['child_supp_or_alimony'] == 0) {
                                    $childSuppYesOrNo = "Yes";
                                    $childSuppYesSection = "";
                                }
                                if ($details['child_supp_or_alimony'] == 1) {
                                    $childSuppYesOrNo = "No";
                                }
                                $childSuppObligationYesOrNo = "";
                                $childSuppObligationSection = "hide-data";
                                $current_on_your_support_obligation = $details['current_on_your_support_obligation'] ?? '';
                                if ($current_on_your_support_obligation == 0) {
                                    $childSuppObligationYesOrNo = "Yes";
                                }
                                if ($current_on_your_support_obligation == 1) {
                                    $childSuppObligationYesOrNo = "No";
                                    $childSuppObligationSection = "";
                                }
                            @endphp

                            <div
                                class="{{ (Helper::validate_key_value('child_supp_or_alimony', $details, 'radio') == 0) ? 'col-md-5' : 'col-md-12' }}">
                                <p class=""><span class=" fw-bold">Do you owed Child Support/Alimony:
                                    </span>{{ $childSuppYesOrNo }}</p>
                            </div>
                            <div class="col-md-4 {{ $childSuppYesSection }}">
                                <p class=""><span class=" fw-bold">Child Support/Alimony - State:
                                    </span>{{ $details['taxes_child_support_state'] }}</p>
                            </div>
                            <div class="col-md-3 {{ $childSuppYesSection }}">
                                <p class=""><span class=" fw-bold">Monthly Payment:
                                    </span>{{ $details['taxes_child_support_due'] ? '$' . number_format((float) $details['taxes_child_support_due'], 2) : '' }}
                                </p>
                            </div>
                            <div class="col-md-6 {{ $childSuppYesSection }}">
                                <p class=""><span class=" fw-bold">Are you current on your support obiligation(s):
                                    </span>{{ $childSuppObligationYesOrNo }}</p>
                            </div>
                            <div class="col-md-6 {{ $childSuppYesSection }} {{ $childSuppObligationSection }}">
                                <p class=""><span class=" fw-bold">Past Due Amount:
                                    </span>{{ $details['taxes_alimony_due'] ? '$' . number_format((float) $details['taxes_alimony_due'], 2) : '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="{{ $dataFor }} edit-div hide-data">
                <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                    action="{{route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID])}}"
                    method="post" novalidate>
                    @csrf
                    <div class="row gx-3">
                        @include('intake_form.questions.back_tax', ['formData' => $finalDetails])
                    </div>
                    <div class="bottom-btn-div px-0">
                        <button type="button"
                            class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                            onclick="closeIntakeForm('{{$dataFor}}')">Close</button>
                        <button type="button"
                            class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                            onclick="submitIntakeForm('{{ $dataFor }}')">Save
                            Back taxes owed Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>