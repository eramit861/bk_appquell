<x-officialForm.expenses.part2Question4 name="Price4" nameA="Price4a" nameB="Price4b" nameC="Price4c" nameD="Price4d"
    name5="Price5" name6A="Price6a" name6B="Price6b" name6C="Price6c" name6D="Price6d" name6Other="Other 6d" name7="Price7"
    name8="Price8" name9="Price9" name10="Price10" name11="Price11" name12="Price12" name13="Price13" name14="Price14"
    name16="Price16" name16Other="Other 16" name15A="Price15a" name15B="Price15b" name15C="Price15c" name15D="Price15d"
    name15Other="Other 15d" :partJ="$partJ" :expensesInfo="$expensesInfo" shtype="j2"></x-officialForm.expenses.part2Question4>

<!-- Row 17 -->
@php
    $alph = [0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd'];
@endphp
<div class="payroll-deduction">
    <!-- Row 17.a -->
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <strong>{{ __('17. Installment or lease payments:') }}</strong>
                <p>{{ __('Do not include insurance deducted from your pay or included in lines 4 or 20') }}</p>
            </div>
        </div>
        @if (isset($expensesInfo['installmentpayments_price']) && is_array($expensesInfo['installmentpayments_price']))
            @for ($i = 0; $i < count($expensesInfo['installmentpayments_price']); $i++)
                @php
                    $payments = '';
                    if ($i == 0) {
                        $payments = 'a';
                    } elseif ($i == 1) {
                        $payments = 'b';
                    } elseif ($i == 2) {
                        $payments = 'c';
                    } elseif ($i == 3) {
                        $payments = 'd';
                    }
                @endphp
                @if (isset($expensesInfo['installmentpayments_type'][$i]))
                    <div class="col-md-8">
                        <div class="input-group">
                            <label>17.{{ $alph[$i] }}
                                {{ isset($expensesInfo['installmentpayments_type'][$i]) ? ArrayHelper::installmentPaymentArray($expensesInfo['installmentpayments_type'][$i]) : '' }}</label>
                            @if (isset($expensesInfo['installmentpayments_type'][$i]) &&
                                    in_array($expensesInfo['installmentpayments_type'][$i], [3, 4]))
                                <div class="input-group">
                                    <input name="{{ base64_encode('Other 17' . $payments) }}" type="text"
                                        value="{{ $partJ[base64_encode('Other 17' . $payments)] ?? $expensesInfo['installmentpayments_value'][$i] }}"
                                        class="col-md-6 form-control">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">17.{{ $alph[$i] }} </strong>
                                    <x-basicAddOn2 />
                                    <input name="{{ base64_encode('Price17' . $payments) }}" type="text"
                                        value="{{ isset($partJ[base64_encode('Price17' . $payments)]) ? Helper::priceFormtWithComma($partJ[base64_encode('Price17' . $payments)]) : Helper::priceFormtWithComma($expensesInfo['installmentpayments_price'][$i]) }}"
                                        class="price-field schj2_line17{{ $alph[$i] }}_income schj2_income form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endfor
        @endif
    </div>
</div>
<!-- Row 18 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <strong>{{ __('18. Your payments of alimony, maintenance, and support that you
                            did
                            not
                            report as deducted from
                            your pay on line 5, Schedule I, Your Income (Official Form
                            106I).') }}</strong>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group d-flex mb-3">
                    <strong class="input-group-text">18.</strong>
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">$</span>
                    </div>
                    <input name="{{ base64_encode('Price18') }}" type="text"
                        value="{{ isset($partJ[base64_encode('Price18')]) ? Helper::priceFormtWithComma($partJ[base64_encode('Price18')]) : Helper::validate_key_value('alimony_price', $expensesInfo, 'comma') }}"
                        class="price-field schj2_line18_income schj2_income form-control">
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
            <input name="{{ base64_encode('Other 19') }}" type="text"
                value="{{ $partJ[base64_encode('Other 19')] ?? Helper::validate_key_value('payments_dependents_value', $expensesInfo) }}"
                class="form-control col-md-6">
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group d-flex mb-3">
                    <strong class="input-group-text">19.</strong>
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">$</span>
                    </div>
                    <input name="{{ base64_encode('Price19') }}" type="text"
                        value="{{ isset($partJ[base64_encode('Price19')]) ? Helper::priceFormtWithComma($partJ[base64_encode('Price19')]) : Helper::validate_key_value('payments_dependents_price', $expensesInfo, 'comma') }}"
                        class="price-field schj2_line19_income schj2_income form-control">
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
                <strong>{{ __('20. Other real property expenses not included in lines 4 or
                                    5 of
                                    this form or on Schedule I: Your Income') }}</strong>
            </div>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('20a. Mortgages on other property') }}</label>
            </div>
        </div>
        @php
            $mortgage_property = !empty($expensesInfo['mortgage_property']) ? $expensesInfo['mortgage_property'] : [];
        @endphp
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('20a.') }}</strong>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('Price20a') }}" type="text"
                            value="{{ isset($partJ[base64_encode('Price20a')]) ? Helper::priceFormtWithComma($partJ[base64_encode('Price20a')]) : Helper::validate_key_value('other_real_estate_price', $mortgage_property, 'comma') }}"
                            class="price-field schj2_line20a_income schj2_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 20 b -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('20b. Real estate taxes') }} </label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('20b.') }}</strong>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('Price20b') }}" type="text"
                            value="{{ isset($partJ[base64_encode('Price20b')]) ? Helper::priceFormtWithComma($partJ[base64_encode('Price20b')]) : Helper::validate_key_value('tax', $mortgage_property, 'comma') }}"
                            class="price-field schj2_line20b_income schj2_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 20 c -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <label>{{ __('20c. Property, homeowner’s, or renter’s insurance') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('20c.') }}</strong>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('Price20c') }}" type="text"
                            value="{{ isset($partJ[base64_encode('Price20c')]) ? Helper::priceFormtWithComma($partJ[base64_encode('Price20c')]) : Helper::validate_key_value('rental_insurance_price', $mortgage_property, 'comma') }}"
                            class="price-field schj2_line20c_income schj2_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 20 d -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <label>{{ __('20d. Maintenance, repair, and upkeep expenses') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('20d.') }}</strong>
                        <x-basicAddOn2 />
                        <input name="{{ base64_encode('Price20d') }}" type="text"
                            value="{{ isset($partJ[base64_encode('Price20d')]) ? Helper::priceFormtWithComma($partJ[base64_encode('Price20d')]) : Helper::validate_key_value('home_maintenance_price', $mortgage_property, 'comma') }}"
                            class="price-field schj2_line20d_income schj2_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Row 20 e -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label>{{ __('20e. Homeowner’s association or condominium dues') }}</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group d-flex mb-3">
                    <strong class="input-group-text">{{ __('20e.') }}</strong>
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">$</span>
                    </div>
                    <input name="{{ base64_encode('Price20e') }}" type="text"
                        value="{{ isset($partJ[base64_encode('Price20e')]) ? Helper::priceFormtWithComma($partJ[base64_encode('Price20e')]) : Helper::validate_key_value('condominium_price', $mortgage_property, 'comma') }}"
                        class="price-field schj2_line20e_income schj2_income form-control">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row 21 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <strong>{{ __('21. Other. Specify') }}</strong><br>
            <input name="{{ base64_encode('Other 21') }}" type="text"
                value="{{ $partJ[base64_encode('Other 21')] ?? Helper::validate_key_value('other_expense_specify', $expensesInfo) }}"
                class="form-control col-md-6">
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group d-flex mb-3">
                    <strong class="input-group-text">21.</strong>
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">$</span>
                    </div>
                    <input name="{{ base64_encode('Price21') }}" type="text"
                        value="{{ isset($partJ[base64_encode('Price21')]) ? Helper::priceFormtWithComma($partJ[base64_encode('Price21')]) : Helper::validate_key_value('other_expense_value', $expensesInfo, 'comma') }}"
                        class="price-field schj2_line21_income schj2_income form-control">
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
                <strong>{{ __('22. Calculate your monthly expenses') }}</strong> {{ __('Add lines 5 through 21.') }}
            </div>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('The result is the monthly expenses of Debtor 2. Copy the result to line 22b of Schedule J to calculate the
                                    total expenses for Debtor 1 and Debtor 2.') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">22.</strong>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode('Price22') }}" type="text"
                            value="{{ isset($partJ[base64_encode('Price22')]) ? Helper::priceFormtWithComma($partJ[base64_encode('Price22')]) : Helper::priceFormtWithComma($totalExpensesSpouse) }}"
                            class="price-field schj2_line22_income schj2_income form-control">
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
                <strong>{{ __('23. Line not used on this form.') }}</strong>
            </div>
        </div>
    </div>
    <!-- Row 24 c -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3 mt-3">
                <strong>{{ __('24. Do you expect an increase or decrease in your expenses
                                    within
                                    the year after you file this form?.') }}</strong>
                <p>{{ __('For example, do you expect to finish paying for your car loan within
                                    the
                                    year or do you expect your
                                    mortgage payment to increase or decrease because of a modification
                                    to
                                    the terms of your mortgage?') }}
                </p>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check24') }}" value="no" type="checkbox" {!! isset($partJ[base64_encode('check24')])
                    ? Helper::validate_key_toggle(base64_encode('check24'), $partJ, 'no')
                    : Helper::validate_key_toggle('increase_decrease_expenses_option', $expensesInfo, 0) !!}>
                <label for="">{{ __('No') }}</label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode('check24') }}" value="yes" type="checkbox" {!! isset($partJ[base64_encode('check24')])
                    ? Helper::validate_key_toggle(base64_encode('check24'), $partJ, 'yes')
                    : Helper::validate_key_toggle('increase_decrease_expenses_option', $expensesInfo, 1) !!}>
                <label for="">{{ __('Yes') }}</label>
            </div>
        </div>
        <div class="col-md-8">
            <textarea name="{{ base64_encode('Other 24') }}" class="form-control" cols="30" rows="5">{{ $partJ[base64_encode('Other 24')] ?? Helper::validate_key_value('increase_decrease_expenses', $expensesInfo) }}</textarea>
        </div>
    </div>
</div>
