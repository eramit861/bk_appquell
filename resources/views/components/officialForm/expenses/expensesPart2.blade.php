<x-officialForm.expenses.part2Question4
    name="4-106J" nameA="4a-106J" nameB="4b-106J" nameC="4c-106J" nameD="4d-106J"
    name5="5-106J"
    name6A="6a-106J" name6B="6b-106J" name6C="6c-106J" name6D="6d-106J" name6Other="Other 6d-106J"
    name7="7-106J" name8="8-106J" name9="9-106J" name10="10-106J" name11="11-106J" name12="12-106J"
    name13="13-106J" name14="14-106J" name16="16-106J" name16Other="Other 16-106J"
    name15A="15a-106J" name15B="15b-106J" name15C="15c-106J" name15D="15d-106J" name15Other="Other 15d-106J"
    :partJ="$partJ"
    :expensesInfo="$expensesInfo"
    shtype="j"
></x-officialForm.expenses.part2Question4>
<!-- Row 17 -->
<div class="payroll-deduction">
    <!-- Row 17.a -->
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <strong>{{ __('17. Installment or lease payments:') }}</strong>
            </div>
        </div>
        <div class="col-md-8 mt-1">
            <div class="input-group">
                <label>{{ __('17a. Car Payment for Vehicle 1') }}</label>
            </div>
        </div>
        <div class="col-md-4 mt-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('17a.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('17a-106J') }}" type="text" value="{{ isset($partJ[base64_encode('17a-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('17a-106J')]) : (isset($expensesInfo['installmentpayments_price'][0]) ? Helper::priceFormtWithComma($expensesInfo['installmentpayments_price'][0]) : 0.00) }}" class="price-field sch{{ $shtype }}_line17a_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-1">
            <div class="input-group">
                <label>{{ __('17b. Car Payment for Vehicle 2') }}</label>
            </div>
        </div>
        <div class="col-md-4 mt-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('17b.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('17b-106J') }}" type="text" value="{{ isset($partJ[base64_encode('17b-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('17b-106J')]) : Helper::priceFormtWithComma($expensesInfo['installmentpayments_price'][1] ?? 0.00) }}" class="price-field sch{{ $shtype }}_line17b_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-1">
            <div class="input-group">
                <label>{{ __('17c. Other 1 (Describe)') }}</label>
                <div class="input-group">
                    <input name="{{ base64_encode('Other 17c-106J') }}" name="yyy" type="text" value="{{ $partJ[base64_encode('Other 17c-106J')] ?? $expensesInfo['installmentpayments_value'][2] ?? '' }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('17c.') }} </strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('17c-106J') }}" type="text" value="{{ isset($partJ[base64_encode('17c-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('17c-106J')]) : Helper::priceFormtWithComma($expensesInfo['installmentpayments_price'][2] ?? 0.00) }}" class="price-field sch{{ $shtype }}_line17c_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-1">
            <div class="input-group">
                <label>{{ __('17d. Other 2 (Describe)') }}</label>
                <div class="input-group">
                    <input name="{{ base64_encode('Other 17d-106J') }}" name="yyy" type="text" value="{{ $partJ[base64_encode('Other 17d-106J')] ?? $expensesInfo['installmentpayments_value'][3] ?? '' }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('17d.') }} </strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('17d-106J') }}" type="text" value="{{ isset($partJ[base64_encode('17d-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('17d-106J')]) : Helper::priceFormtWithComma($expensesInfo['installmentpayments_price'][3] ?? 0.00) }}" class="price-field sch{{ $shtype }}_line17d_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Row 18 -->
<div class="row mt-3">
    <div class="col-md-8">
        <div class="input-group mb-3">
                <x-stronglabel label="18. Your payments of alimony, maintenance, and support that you
                did
                not
                report as deducted from
                your pay on line 5, Schedule I, Your Income (Official Form
                106I)." />
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group d-flex mb-3">
                    <strong class="input-group-text">18.</strong>
                    <x-basicAddOn2  />
                    <input name="{{ base64_encode('18-106J') }}" type="text" value="{{ isset($partJ[base64_encode('18-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('18-106J')]) : Helper::validate_key_value('alimony_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line18_income sch{{ $shtype }}_income form-control">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row 19 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <strong>{{ __('19. Other payments you make to support others who do not live
                with
                you.
                Specify') }}</strong>
            <input name="{{ base64_encode('Other 19-106J') }}" type="text" value="{{ $partJ[base64_encode('Other 19-106J')] ?? Helper::validate_key_value('payments_dependents_value', $expensesInfo) }}" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group d-flex mb-3">
                    <strong class="input-group-text">19.</strong>
                    <x-basicAddOn2  />
                    <input name="{{ base64_encode('19-106J') }}" type="text" value="{{ isset($partJ[base64_encode('19-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('19-106J')]) : Helper::validate_key_value('payments_dependents_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line19_income sch{{ $shtype }}_income form-control">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row 20 -->
<div class="payroll-deduction">
    <!-- Row 20.a -->
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <x-stronglabel label="20. Other real property expenses not included in lines 4 or
                    5 of
                    this form or on Schedule I: Your Income" />
            </div>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <x-labelOnly label="20a. Mortgages on other property" />
            </div>
        </div>
        @php
            $mortgage_property = (!empty($expensesInfo['mortgage_property'])) ? $expensesInfo['mortgage_property'] : [];
        @endphp
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('20a.') }}</strong>
                        <x-basicAddOn2  />
                        <input name="{{ base64_encode('20a-106J') }}" type="text" value="{{ isset($partJ[base64_encode('20a-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('20a-106J')]) : Helper::validate_key_value('other_real_estate_price', $mortgage_property, 'comma') }}" class="price-field sch{{ $shtype }}_line20a_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 20 b -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group">
                <x-labelOnly label="20b. Real estate taxes" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('20b.') }}</strong>
                        <x-basicAddOn2  />
                        <input name="{{ base64_encode('20b-106J') }}" type="text" value="{{ isset($partJ[base64_encode('20b-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('20b-106J')]) : Helper::validate_key_value('tax', $mortgage_property, 'comma') }}" class="price-field sch{{ $shtype }}_line20b_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 20 c -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <x-labelOnly label="20c. Property, homeowner’s, or renter’s insurance" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('20c.') }}</strong>
                        <x-basicAddOn2  />
                        <input name="{{ base64_encode('20c-106J') }}" type="text" value="{{ isset($partJ[base64_encode('20c-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('20c-106J')]) : Helper::validate_key_value('rental_insurance_price', $mortgage_property, 'comma') }}" class="price-field sch{{ $shtype }}_line20c_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 20 d -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                 <x-labelOnly label="20d. Maintenance, repair, and upkeep expenses" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('20d.') }}</strong>
                        <x-basicAddOn2  />
                        <input name="{{ base64_encode('20d-106J') }}" type="text" value="{{ isset($partJ[base64_encode('20d-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('20d-106J')]) : Helper::validate_key_value('home_maintenance_price', $mortgage_property, 'comma') }}" class="price-field sch{{ $shtype }}_line20d_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 20 d -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <x-labelOnly label="20e. Homeowner’s association or condominium dues" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('20e.') }}</strong>
                        <x-basicAddOn2  />
                        <input name="{{ base64_encode('20e-106J') }}" type="text" value="{{ isset($partJ[base64_encode('20e-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('20e-106J')]) : Helper::validate_key_value('condominium_price', $mortgage_property, 'comma') }}" class="price-field sch{{ $shtype }}_line20e_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Row 21 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <strong>{{ __('21. Other. Specify') }}</strong>
            <input name="{{ base64_encode('Other 21-106J') }}" type="text" value="{{ $partJ[base64_encode('Other 21-106J')] ?? Helper::validate_key_value('other_expense_specify', $expensesInfo) }}" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group d-flex mb-3">
                    <strong class="input-group-text">21.</strong>
                    <x-basicAddOn2  />
                    <input name="{{ base64_encode('21-106J') }}" type="text" value="{{ isset($partJ[base64_encode('21-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('21-106J')]) : Helper::validate_key_value('other_expense_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line21_income sch{{ $shtype }}_income form-control">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row 22 -->
<div class="payroll-deduction">
    <!-- Row 22.a -->
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <strong>{{ __('22. Calculate your monthly expenses') }}</strong>
            </div>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('22a. Add lines 4 through 21.') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('22a.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('22a-106J') }}" type="text" value="{{ isset($partJ[base64_encode('22a-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('22a-106J')]) : Helper::priceFormtWithComma($totalExpenses) }}" class="price-field sch{{ $shtype }}_line22a_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 20 b -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('22b. Copy line 22 (monthly expenses for Debtor 2), if any,
                    from
                    Official Form 106J-2 2') }} </label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('22b.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('22b-106J') }}" type="text" value="{{ isset($partJ[base64_encode('22b-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('22b-106J')]) : Helper::priceFormtWithComma($totalExpensesSpouse) }}" class="price-field sch{{ $shtype }}_line22b_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 20 c -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <label>{{ __('22c. Add line 22a and 22b. The result is your monthly
                    expenses.') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('22c.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('22c-106J') }}" id="j_monthly_expenses" type="text" value="{{ isset($partJ[base64_encode('22c-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('22c-106J')]) : Helper::priceFormtWithComma($resultExpense) }}" class="price-field fi_schedule_j_monthly_expense sch{{ $shtype }}_line22c_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row 23 -->
<div class="payroll-deduction">
    <!-- Row 22.a -->
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <strong>{{ __('23. Calculate your monthly net income.') }}</strong>
            </div>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('23a. Copy line 12 (your combined monthly income) from
                    Schedule
                    I.') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('23a.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('23a-106J') }}" type="text" value="{{ isset($partJ[base64_encode('23a-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('23a-106J')]) : Helper::priceFormtWithComma($line11Total) }}" class="price-field sch{{ $shtype }}_line23a_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 20 b -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('23b. Copy your monthly expenses from line 22c above.') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('23b.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('23b-106J') }}" type="text" value="{{ isset($partJ[base64_encode('23b-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('23b-106J')]) : Helper::priceFormtWithComma($resultExpense) }}" class="price-field sch{{ $shtype }}_line23b_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 20 c -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <label>{{ __('23c. Subtract your monthly expenses from your monthly income.
                    The result is your monthly net income.') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('23c.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('23c-106J') }}" type="text" value="{{ isset($partJ[base64_encode('23c-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('23c-106J')]) : Helper::priceFormtWithComma($monthlyNetIncome) }}" class="fi_schedule_j_line23c_monthly_net_income price-field sch{{ $shtype }}_line23c_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row 24 c -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <strong>{{ __('24. Do you expect an increase or decrease in your expenses
                within
                the year after you file this form?.') }}</strong>
            <p>{{ __('For example, do you expect to finish paying for your car loan within
                the
                year or do you expect your
                mortgage payment to increase or decrease because of a modification
                to
                the terms of your mortgage?') }}</p>
        </div>
        <div class="input-group">
            <input name="{{ base64_encode('check24#0-106J') }}" value="no" type="checkbox" {!! isset($partJ[base64_encode('check24#0-106J')]) ? Helper::validate_key_toggle(base64_encode('check24#0-106J'), $partJ, 'no') : Helper::validate_key_toggle('increase_decrease_expenses_option', $expensesInfo, 0) !!}>
            <label for="">{{ __('No') }}</label>
        </div>
        <div class="input-group">
            <input name="{{ base64_encode('check24#0-106J') }}" value="yes" type="checkbox" {!! isset($partJ[base64_encode('check24#0-106J')]) ? Helper::validate_key_toggle(base64_encode('check24#0-106J'), $partJ, 'yes') : Helper::validate_key_toggle('increase_decrease_expenses_option', $expensesInfo, 1) !!}>
            <label for="">{{ __('Yes') }}</label>
        </div>
    </div>
    <div class="col-md-8">
        <textarea name="{{ base64_encode('Other 24-106J') }}" class="form-control" cols="30" rows="5">{{ $partJ[base64_encode('Other 24-106J')] ?? Helper::validate_key_value('increase_decrease_expenses', $expensesInfo) }}</textarea>
    </div>
</div>