@php
    $dataFor = 'other-debt-info';
    $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);
@endphp

<div class="row">
    <div class="col-12 col-md-12">
        <div class="light-gray-div">
            <h2>Other Debts</h2>
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

                <div class="col-md-12 {{ isset($details['vehicle_repoed_date']) && !empty($details['vehicle_repoed_date']) ? '' : 'hide-data'}}">
                    <p class=""><span class=" fw-bold">Repo: I had a vehicle repoed in the last 10 days on this date
                            <small>(MM/DD/YYYY)</small>:
                        </span>{{ Helper::validate_key_value('vehicle_repoed_date', $details) }}</p>
                </div>
                <div class="col-md-12 {{ isset($details['borrowed_and_paid_back']) && !empty($details['borrowed_and_paid_back']) ? '' : 'hide-data'}}">
                    <p class=""><span class=" fw-bold">Borrowed & Paid back:
                        </span>{{ Helper::validate_key_value('borrowed_and_paid_back', $details) }}</p>
                </div>
                <div class="col-md-12 {{ isset($details['joint_debt']) && !empty($details['joint_debt']) ? '' : 'hide-data'}}">
                    <p class=""><span class=" fw-bold">Joint debt:
                        </span>{{ Helper::validate_key_value('joint_debt', $details) }}</p>
                </div>
                <div
                    class="col-md-4 {{ (isset($details['family_loans']) && !empty($details['family_loans'])) ? '' : 'hide-data' }}">
                    <p class=""><span class=" fw-bold">Friend/Family debt:
                        </span>{{ $details['family_loans'] ? '$' . number_format((float) $details['family_loans'], 2) : '' }}
                    </p>
                </div>
                <div
                    class="col-md-4 {{ (isset($details['credit_crd_debt']) && !empty($details['credit_crd_debt'])) ? '' : 'hide-data' }}">
                    <p class=""><span class=" fw-bold">Total Credit Card debt:
                        </span>{{ $details['credit_crd_debt'] ? '$' . number_format((float) $details['credit_crd_debt'], 2) : '' }}
                    </p>
                </div>
                <div class="col-md-4 {{ isset($details['total_unsecured_loan']) && !empty($details['total_unsecured_loan']) ? '' : 'hide-data'}}">
                    <p class=""><span class=" fw-bold">Total unsecured debt:
                        </span>{{ $details['total_unsecured_loan'] ? '$' . number_format((float) $details['total_unsecured_loan'], 2) : '' }}</p>
                </div>
                <div
                    class="col-md-4 {{ (isset($details['medical_debt']) && !empty($details['medical_debt'])) ? '' : 'hide-data' }}">
                    <p class=""><span class=" fw-bold">Total Medical debt:
                        </span>{{ $details['medical_debt'] ? '$' . number_format((float) $details['medical_debt'], 2) : '' }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p class=""><span class=" fw-bold">Total utility debt:
                        </span>{{ $details['total_utility_debt'] ? '$' . number_format((float) $details['total_utility_debt'], 2) : '' }}</p>
                </div>
                <div
                    class="col-md-4 {{ (isset($details['law_suit']) && !empty($details['law_suit'])) ? '' : 'hide-data' }}">
                    <p class=""><span class=" fw-bold">Law Suit / Judgement:
                        </span>{{ $details['law_suit'] ? '$' . number_format((float) $details['law_suit'], 2) : '' }}
                    </p>
                </div>
                <div
                    class="col-md-4 {{ (isset($details['student_loans']) && !empty($details['student_loans'])) ? '' : 'hide-data' }}">
                    <p class=""><span class=" fw-bold">Total Student loans:
                        </span>{{ $details['student_loans'] ? '$' . number_format((float) $details['student_loans'], 2) : '' }}
                    </p>
                </div>
                <div class="col-md-4 {{ isset($details['tolls_tickets_fines_owed']) && !empty($details['tolls_tickets_fines_owed']) ? '' : 'hide-data'}}">
                    <p class=""><span class=" fw-bold">Tolls, tickets, & fines owed:
                        </span>{{ $details['tolls_tickets_fines_owed'] ? '$' . number_format((float) $details['tolls_tickets_fines_owed'], 2) : '' }}</p>
                </div>
                <div class="col-md-4 {{ isset($details['eviction_or_back_rent']) && !empty($details['eviction_or_back_rent']) ? '' : 'hide-data'}}">
                    <p class=""><span class=" fw-bold">Eviction or back rent:
                        </span>{{ $details['eviction_or_back_rent'] ? '$' . number_format((float) $details['eviction_or_back_rent'], 2) : '' }}</p>
                </div>
                <div class="col-md-4 {{ isset($details['foreclosure_debt']) && !empty($details['foreclosure_debt']) ? '' : 'hide-data'}}">
                    <p class=""><span class=" fw-bold">Foreclosure debt:
                        </span>{{ $details['foreclosure_debt'] ? '$' . number_format((float) $details['foreclosure_debt'], 2) : '' }}</p>
                </div>
                <div class="col-md-4 {{ isset($details['repo_debt']) && !empty($details['repo_debt']) ? '' : 'hide-data'}}">
                    <p class=""><span class=" fw-bold">Repo debt:
                        </span>{{ $details['repo_debt'] ? '$' . number_format((float) $details['repo_debt'], 2) : '' }}</p>
                </div>
                <div
                    class="col-md-4 {{ (isset($details['credit_union_loans']) && !empty($details['credit_union_loans'])) ? '' : 'hide-data' }}">
                    <p class=""><span class=" fw-bold">Total Credit Union Loans:
                        </span>{{ $details['credit_union_loans'] ? '$' . number_format((float) $details['credit_union_loans'], 2) : '' }}
                    </p>
                </div>
                <div
                    class="col-md-4 {{ (isset($details['personal_loans']) && !empty($details['personal_loans'])) ? '' : 'hide-data' }}">
                    <p class=""><span class=" fw-bold">Total Personal Loans:
                        </span>{{ $details['personal_loans'] ? '$' . number_format((float) $details['personal_loans'], 2) : '' }}
                    </p>
                </div>
                <div
                    class="col-md-4 {{ (isset($details['misc_loans']) && !empty($details['misc_loans'])) ? '' : 'hide-data' }}">
                    <p class=""><span class=" fw-bold">Other debt:
                        </span>{{ $details['misc_loans'] ? '$' . number_format((float) $details['misc_loans'], 2) : '' }}
                    </p>
                </div>
                <div class="col-md-12 {{ isset($details['money_you_have']) && !empty($details['money_you_have']) ? '' : 'hide-data'}}">
                    <p class=""><span class=" fw-bold">How much do you have in the Bank, Credit Union, in your Pocket, in Stock, Bond, Investments, NFTs, Crypto, Cash App, PayPal, Venmo, Whole Life Ins., I.U.L., Trusts, Business Accounts- ANYWHERE except 401(k)s, 403(b)s, 457(b)&(f)s, and IRAs:
                        </span>{{ Helper::validate_key_value('money_you_have', $details) }}</p>
                </div>
                
                <div class="col-md-12">
                    <p class=""><span class=" fw-bold">Have you made purchases in the last 3 months?: </span>{{ Helper::key_display_reverse('made_purchases', $details) }}</p>
                </div>
                <div class="col-md-12">
                    <p class=""><span class=" fw-bold">Do you have a checking account at a bank that issued the
                            card?: </span>{{ Helper::key_display_reverse('checking_account', $details) }}
                    </p>
                </div>
            </div>
            <div class="{{ $dataFor }} edit-div hide-data">
                <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                    action="{{route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID])}}"
                    method="post" novalidate>
                    @csrf
                    <div class="row gx-3">
                        @include('intake_form.questions.other_debt', ['formData' => $finalDetails])
                    </div>
                    <div class="bottom-btn-div px-0">
                        <button type="button"
                            class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                            onclick="closeIntakeForm('{{$dataFor}}')">Close</button>
                        <button type="button"
                            class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                            onclick="submitIntakeForm('{{ $dataFor }}')">Save
                            Other Debts Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>