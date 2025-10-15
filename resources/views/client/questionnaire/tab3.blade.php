<div class="tab-pane fade show active" id="section3" role="tabpanel" aria-labelledby="section3-tab">
    <h3 class="section-main-title text-c-blue f-w-800">
        <span class="border-bottom-light-blue">Debts</span>
    </h3>

    <div id="debts-part-a">
        <form name="client_debts" id="client_debts" action="{{ route('debt_custom_save') }}" method="post" novalidate>
            @csrf

            {{-- Hidden ID field --}}
            @if(!empty($debts['id']))
                <input type="hidden" class="debt_id" name="id" value="{{ !empty($debts['id']) ? $debts['id'] : '' }}">
            @endif

            <div class="row mt-3">
                <div class="col-md-12">
                    <p class="section-part-title">
                        <span>Please list below all debts that you owe OR that creditors claim you owe that are secured by property.</span>
                    </p>
                </div>

                <div class="{{ isset($web_view) && $web_view ? '' : 'form-main mt-3 w-100' }}" id="debts_secured_property-form">
                {{-- Type of Debt Section --}}
                <div class="col-md-12">
                    <h5 class="mb-2"><strong>Type of Debt</strong></h5>
                    <div class="form-group">
                        <label>Home loan and/or mortgage</label>
                        <select class="form-control required" name="home_loan_mortgage" id="type_of_debt" onchange="getUnpaidTaxesItems();">
                            @php
                                $debtTypes = [
                                    1 => 'Home loan and/or mortgage',
                                    2 => 'Car loans',
                                                              3 => 'Major credit card debts (Visa,Express, Master Card, Discover)',
                                    4 => 'Major credit card debts (Visa,American Express, Master Card, Discover)',
                                    5 => 'Department store credit card debts',
                                    6 => 'Other credit card debts (gas cards, phone cards, etc.)',
                                    7 => 'Cash advances',
                                    8 => 'Unpaid taxes'
                                ];
                                $selectedType = $debts['home_loan_mortgage'] ?? '';
                            @endphp

                            @foreach($debtTypes as $value => $label)
                                <option value="{{ $value }}" {{ $selectedType == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Creditor Information Section --}}
                <div class="col-md-12">
                    <h5 class="mb-2"><strong>Creditor Information</strong></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount Owed <i>(amount of claim):</i></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number"
                                           class="form-control price-field required"
                                           name="amount_own"
                                           placeholder="Amount Owed"
                                           value="{{ !empty($debts['amount_own']) ? $debts['amount_own'] : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Number, if any:</label>
                                <input type="number"
                                       class="form-control required"
                                       name="account_number"
                                       placeholder="Account Number"
                                       value="{{ !empty($debts['account_number']) ? $debts['account_number'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date/range of dates when debt was incurred:</label>
                                <input type="date"
                                       placeholder="MM/DD/YYYY"
                                       class="form-control date_filed required"
                                       name="debt_incurred_date"
                                       value="{{ !empty($debts['debt_incurred_date']) ? $debts['debt_incurred_date'] : '' }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Creditor Name and Address:</label>
                                <textarea name="creditor_name_addresss"
                                          class="form-control required"
                                          cols="30"
                                          rows="4"
                                          placeholder="Creditor Name and Address">{{ !empty($debts['creditor_name_addresss']) ? $debts['creditor_name_addresss'] : '' }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Contact person's name and address if different:</label>
                                <textarea name="contact_name_addresss"
                                          class="form-control required"
                                          cols="30"
                                          rows="4"
                                          placeholder="Persons name and address">{{ !empty($debts['contact_name_addresss']) ? $debts['contact_name_addresss'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Property Information Section --}}
                <div class="col-md-12">
                    <h5 class="mb-2"><strong>Property Information:</strong></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Monthly payment amount:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number"
                                           class="form-control price-field required"
                                           name="monthly_payment"
                                           placeholder="Monthly payment"
                                           value="{{ !empty($debts['monthly_payment']) ? $debts['monthly_payment'] : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Person(s) Responsible/Codebtor Section --}}
                <div class="col-md-12">
                    <h5 class="mb-2"><strong>Person(s) Responsible/Codebtor:</strong></h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="d-block">Who owes the debt?</label>
                                @php
                                    $debtOwner = $debts['debt_owned_by'] ?? '';
                                    $ownerOptions = [
                                        1 => 'Self',
                                        2 => 'Spouse',
                                        3 => 'Joint',
                                        4 => 'Other'
                                    ];
                                @endphp

                                <div class="d-inline radio-primary">
                                    <input type="radio"
                                           id="who_owes_the_debt_you"
                                           name="debt_owned_by"
                                           required
                                           value="1"
                                           {{ $debtOwner == 1 ? 'checked' : '' }}>
                                    <label for="who_owes_the_debt_you" class="cr">Self</label>
                                </div>

                                <div class="d-inline radio-primary">
                                    <input type="radio"
                                           id="who_owes_the_debt_spouse"
                                           name="debt_owned_by"
                                           required
                                           value="2"
                                           {{ $debtOwner == 2 ? 'checked' : '' }}>
                                    <label for="who_owes_the_debt_spouse" class="cr">Spouse</label>
                                </div>

                                <div class="d-inline radio-primary">
                                    <input type="radio"
                                           id="who_owes_the_debt_joint"
                                           name="debt_owned_by"
                                           required
                                           value="3"
                                           {{ $debtOwner == 3 ? 'checked' : '' }}>
                                    <label for="who_owes_the_debt_joint" class="cr">Joint</label>
                                </div>

                                <div class="d-inline radio-primary">
                                    <input type="radio"
                                           id="who_owes_the_debt_other"
                                           name="debt_owned_by"
                                           required
                                           value="4"
                                           {{ $debtOwner == 4 ? 'checked' : '' }}>
                                    <label for="who_owes_the_debt_other" class="cr">Other</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="d-block">Is there a codebtor or cosigner on this loan?</label>
                                @php $hasCodebtor = $debts['codebtor'] ?? ''; @endphp

                                <div class="d-inline radio-primary">
                                    <input type="radio"
                                           id="codebtor_cosigner_yes"
                                           name="codebtor"
                                           required
                                           onchange="geCodebtorCosignerItems('yes');"
                                           value="1"
                                           {{ $hasCodebtor == 1 ? 'checked' : '' }}>
                                    <label for="codebtor_cosigner_yes" class="cr">Yes</label>
                                </div>

                                <div class="d-inline radio-primary">
                                    <input type="radio"
                                           id="codebtor_cosigner_no"
                                           name="codebtor"
                                           required
                                           onchange="geCodebtorCosignerItems('no');"
                                           value="0"
                                           {{ $hasCodebtor == 0 ? 'checked' : '' }}>
                                    <label for="codebtor_cosigner_no" class="cr">No</label>
                                </div>
                            </div>
                        </div>

                        {{-- Conditional Codebtor Data --}}
                        <div class="col-md-12 {{ isset($debts['codebtor']) && $debts['codebtor'] == 1 ? '' : 'hide-data' }} pt-3" id="codebtor_cosigner_data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Please provide name and address:</label>
                                        <textarea name="codebtor_name_addresss"
                                                  class="form-control required"
                                                  cols="30"
                                                  rows="4"
                                                  placeholder="Name & Address">{{ !empty($debts['codebtor_name_addresss']) ? $debts['codebtor_name_addresss'] : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Dispute Debt Section --}}
                <div class="col-md-12">
                    <h5 class="mb-2"><strong>Do you dispute the debt?</strong></h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="d-block">Do you dispute the debt?</label>
                                @php $disputeDebt = $debts['debt_dispute'] ?? ''; @endphp

                                <div class="d-inline radio-primary">
                                    <input type="radio"
                                           id="dispute_the_debt_yes"
                                           name="debt_dispute"
                                           value="1"
                                           required
                                           {{ $disputeDebt == 1 ? 'checked' : '' }}>
                                    <label for="dispute_the_debt_yes" class="cr">Yes</label>
                                </div>

                                <div class="d-inline radio-primary">
                                    <input type="radio"
                                           id="dispute_the_debt_no"
                                           name="debt_dispute"
                                           value="0"
                                           required
                                           {{ $disputeDebt == 0 ? 'checked' : '' }}>
                                    <label for="dispute_the_debt_no" class="cr">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="next-part-btn text-right">
                        <button type="submit" class="btn btn-primary shadow-2 mb-4">Save & Next</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('tab_scripts')
    <script src="{{ asset('assets/js/tab3.js') }}"></script>
@endpush
<!-- Tab 3 End-->





