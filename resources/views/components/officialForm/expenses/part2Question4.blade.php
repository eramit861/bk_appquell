<!-- Row 4 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label for="">
                <strong class="d-block">{{ __('4. The rental or home ownership expenses for
                    your
                    residence.') }}
                </strong> {{ __('Include first mortgage payments and
                any rent for the ground or lot.') }}
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group d-flex mb-3">
                    <strong class="input-group-text">4</strong>
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">$</span>
                    </div>
                    <input name="{{ base64_encode($name) }}" type="text" value="{{ isset($partJ[base64_encode($name)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name)]) : Helper::validate_key_value('rent_home_mortage', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line4_income sch{{ $shtype }}_income form-control">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="payroll-deduction">
    <!-- Row 4.a -->
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <strong>{{ __('If not included in line 4:') }}</strong>
            </div>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('4a. Real estate taxes') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">4a.</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($nameA) }}" type="text" value="{{ isset($partJ[base64_encode($nameA)]) ? Helper::priceFormtWithComma($partJ[base64_encode($nameA)]) : Helper::priceFormtWithComma(Helper::validate_key_value('estate_taxes_pay', $expensesInfo)) }}" class="price-field sch{{ $shtype }}_line4a_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 4.b -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('4b. Property, homeowner’s, or renter’s insurance') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">4b.</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($nameB) }}" type="text" value="{{ isset($partJ[base64_encode($nameB)]) ? Helper::priceFormtWithComma($partJ[base64_encode($nameB)]) : Helper::priceFormtWithComma(Helper::validate_key_value('amount_include_property_pay', $expensesInfo)) }}" class="price-field sch{{ $shtype }}_line4b_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 4 c -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <label>{{ __('4c. Home maintenance, repair, and upkeep expenses') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">4c.</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($nameC) }}" type="text" value="{{ isset($partJ[base64_encode($nameC)]) ? Helper::priceFormtWithComma($partJ[base64_encode($nameC)]) : Helper::priceFormtWithComma(Helper::validate_key_value('amount_include_home_pay', $expensesInfo)) }}" class="price-field sch{{ $shtype }}_line4c_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 4 d -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <label>{{ __('4d. Homeowner’s association or condominium dues') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">4d.</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($nameD) }}" type="text" value="{{ isset($partJ[base64_encode($nameD)]) ? Helper::priceFormtWithComma($partJ[base64_encode($nameD)]) : Helper::priceFormtWithComma(Helper::validate_key_value('amount_include_homeowner_pay', $expensesInfo)) }}" class="price-field sch{{ $shtype }}_line4d_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label for="">
                <strong class="d-block">{{ __('5. Additional mortgage payments for your
                    residence') }}
                </strong>{{ __('such as home equity loans') }}
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group d-flex mb-3">
            <strong class="input-group-text">5</strong>
            <div class="input-group-append"><span class="input-group-text"
                                                  id="basic-addon2">$</span>
            </div>
            <input name="{{ base64_encode($name5) }}" type="text" value="{{ isset($partJ[base64_encode('5-106J')]) ? Helper::priceFormtWithComma($partJ[base64_encode('5-106J')]) : Helper::validate_key_value('mortgage_payments_pay', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line5_income sch{{ $shtype }}_income form-control">
        </div>
    </div>
</div>
<!-- Row 6 -->
@php
    $expenses_utilities_info = (!empty($expensesInfo['utilities'])) ? $expensesInfo['utilities'] : [];
@endphp
<div class="payroll-deduction">
    <!-- Row 6.a -->
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <strong>{{ __('6. Utilities:') }}</strong>
            </div>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('6a. Electricity, heat, natural gas') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">6a.</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($name6A) }}" type="text" value="{{ isset($partJ[base64_encode($name6A)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name6A)]) : Helper::validate_key_value('electricity_heating_price', $expenses_utilities_info, 'comma') }}" class="price-field sch{{ $shtype }}_line6a_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 6.b -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('6b. Water, sewer, garbage collection') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">6b.</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($name6B) }}" type="text" value="{{ isset($partJ[base64_encode($name6B)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name6B)]) : Helper::validate_key_value('water_sewerl_price', $expenses_utilities_info, 'comma') }}" class="price-field sch{{ $shtype }}_line6b_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 6 c -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <label>{{ __('6c. Telephone, cell phone, Internet, satellite, and cable
                    services') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">6c.</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($name6C) }}" type="text" value="{{ isset($partJ[base64_encode($name6C)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name6C)]) : Helper::validate_key_value('telephone_service_price', $expenses_utilities_info, 'comma') }}" class="price-field sch{{ $shtype }}_line6c_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 6 d -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <label>{{ __('6d. Other. Specify:') }}</label><br>
                <input name="{{ base64_encode($name6Other) }}" type="text" value="{{ $partJ[base64_encode($name6Other)] ?? Helper::validate_key_value('monthly_utilities_bills', $expensesInfo) }}" class="col-md-6 form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">6d.</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($name6D) }}" type="text" value="{{ isset($partJ[base64_encode($name6D)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name6D)]) : number_format((float)Helper::current(@$expensesInfo['monthly_utilities_value']), 2, '.', '') }}" class="price-field sch{{ $shtype }}_line6d_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row 7 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label for="">
                <strong class="d-block">{{ __('7. Food and housekeeping supplies') }}
                </strong>
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group d-flex mb-3">
            <strong class="input-group-text">7.</strong>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="{{ base64_encode($name7) }}" type="text" value="{{ isset($partJ[base64_encode($name7)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name7)]) : Helper::validate_key_value('food_housekeeping_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line7_income sch{{ $shtype }}_income form-control">
        </div>

    </div>
</div>
<!-- Row 8 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label for="">
                <strong class="d-block">{{ __('8. Childcare and children’s education costs') }}
                </strong>
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group d-flex mb-3">
            <strong class="input-group-text">8.</strong>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="{{ base64_encode($name8) }}" type="text" value="{{ isset($partJ[base64_encode($name8)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name8)]) : Helper::validate_key_value('childcare_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line8_income sch{{ $shtype }}_income form-control">
        </div>
    </div>
</div>
<!-- Row 9 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label for="">
                <strong class="d-block">{{ __('9. Clothing, laundry, and dry cleaning') }}
                </strong>
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group d-flex mb-3">
            <strong class="input-group-text">9.</strong>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="{{ base64_encode($name9) }}" type="text" value="{{ isset($partJ[base64_encode($name9)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name9)]) : Helper::validate_key_value('laundry_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line9_income sch{{ $shtype }}_income form-control">
        </div>
    </div>
</div>
<!-- Row 10 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label for="">
                <strong class="d-block">{{ __('10. Personal care products and services') }}
                </strong>
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group d-flex mb-3">
            <strong class="input-group-text">10.</strong>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="{{ base64_encode($name10) }}" type="text" value="{{ isset($partJ[base64_encode($name10)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name10)]) : Helper::validate_key_value('personal_care_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line10_income sch{{ $shtype }}_income form-control">
        </div>
    </div>
</div>
<!-- Row 11 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label for="">
                <strong class="d-block">{{ __('11. Medical and dental expenses') }}
                </strong>
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group d-flex mb-3">
            <strong class="input-group-text">11.</strong>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="{{ base64_encode($name11) }}" type="text" value="{{ isset($partJ[base64_encode($name11)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name11)]) : Helper::validate_key_value('medical_dental_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line11_income sch{{ $shtype }}_income form-control">
        </div>

    </div>
</div>
<!-- Row 12 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label for="">
                <strong class="d-block">{{ __('12. Transportation.') }}
                </strong> {{ __('Include gas, maintenance, bus or train fare.
                Do not include car payments') }}
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group d-flex mb-3">
            <strong class="input-group-text">12.</strong>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="{{ base64_encode($name12) }}" type="text" value="{{ isset($partJ[base64_encode($name12)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name12)]) : Helper::validate_key_value('transportation_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line12_income sch{{ $shtype }}_income form-control">
        </div>
    </div>
</div>
<!-- Row 13 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label for="">
                <strong class="d-block">{{ __('13. Entertainment, clubs, recreation,
                    newspapers,
                    magazines, and books') }}
                </strong>
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group d-flex mb-3">
            <strong class="input-group-text">13.</strong>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="{{ base64_encode($name13) }}" type="text" value="{{ isset($partJ[base64_encode($name13)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name13)]) : Helper::validate_key_value('entertainment_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line13_income sch{{ $shtype }}_income form-control">
        </div>
    </div>
</div>
<!-- Row 14 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label for="">
                <strong class="d-block">{{ __('14. Charitable contributions and religious
                    donations') }}
                </strong>
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group d-flex mb-3">
            <strong class="input-group-text">14.</strong>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="{{ base64_encode($name14) }}" type="text" value="{{ isset($partJ[base64_encode($name14)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name14)]) : Helper::validate_key_value('charitablet_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line14_income sch{{ $shtype }}_income form-control">
        </div>
    </div>
</div>
<!-- Row 15 -->
<div class="payroll-deduction">
    <!-- Row 15.a -->
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <strong>{{ __('15. Insurance.') }}</strong>
                <p>{{ __('Do not include insurance deducted from your pay or included in
                    lines
                    4 or 20') }}</p>
            </div>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('15a. Life insurance') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('15a.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($name15A) }}" type="text" value="{{ isset($partJ[base64_encode($name15A)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name15A)]) : Helper::validate_key_value('life_insurance_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line15a_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 15 b -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group">
                <label>{{ __('15b. Health insurance') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('15b.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($name15B) }}" type="text" value="{{ isset($partJ[base64_encode($name15B)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name15B)]) : Helper::validate_key_value('health_insurance_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line15b_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 6 c -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <label>{{ __('15c. Vehicle insurance') }}</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('15c.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($name15C) }}" type="text" value="{{ isset($partJ[base64_encode($name15C)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name15C)]) : Helper::validate_key_value('auto_insurance_price', $expensesInfo, 'comma') }}" class="price-field sch{{ $shtype }}_line15c_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row 15 d -->
    <div class="row">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <label>{{ __('15d. Other insurance. Specify') }}</label><br>
                <input name="{{ base64_encode($name15Other) }}" type="text" value="{{ $partJ[base64_encode($name15Other)] ?? Helper::validate_key_value('other_insurance_value', $expensesInfo) }}" class="form-control col-md-6">
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group d-flex mb-3">
                        <strong class="input-group-text">{{ __('15d.') }}</strong>
                        <div class="input-group-append">
									<span class="input-group-text"
                                          id="basic-addon2">$</span>
                        </div>
                        <input name="{{ base64_encode($name15D) }}" type="text" value="{{ isset($partJ[base64_encode($name15D)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name15D)]) : Helper::priceFormtWithComma((isset($expensesInfo['other_insurance_price']) && !empty($expensesInfo['other_insurance_price']) && is_array($expensesInfo['other_insurance_price'])) ? array_sum($expensesInfo['other_insurance_price']) : (isset($expensesInfo['other_insurance_price']) ? $expensesInfo['other_insurance_price'] : 0.00)) }}" class="price-field sch{{ $shtype }}_line15d_income sch{{ $shtype }}_income form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row 16 -->
<div class="row">
    <div class="col-md-8">
        <div class="input-group mb-3">
            <label for="">
                <strong class="d-block">{{ __('16. Taxes.') }}
                </strong>{{ __('Do not include taxes deducted from your pay or included in
                lines 4 or 20. Specify') }}
            </label><br>
            <input name="{{ base64_encode($name16Other) }}" type="text" value="{{ $partJ[base64_encode($name16Other)] ?? Helper::validate_key_value('taxbills_value', $expensesInfo) }}" class="form-control col-md-6">
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group d-flex mb-3">
            <strong class="input-group-text">16</strong>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="{{ base64_encode($name16) }}" type="text" value="{{ isset($partJ[base64_encode($name16)]) ? Helper::priceFormtWithComma($partJ[base64_encode($name16)]) : Helper::priceFormtWithComma((isset($expensesInfo['taxbills_price']) && !empty($expensesInfo['taxbills_price']) && is_array($expensesInfo['taxbills_price'])) ? array_sum($expensesInfo['taxbills_price']) : (isset($expensesInfo['taxbills_price']) ? $expensesInfo['taxbills_price'] : 0.00)) }}" class="price-field sch{{ $shtype }}_line16_income sch{{ $shtype }}_income form-control">
        </div>
    </div>
</div>
