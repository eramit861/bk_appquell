<div class="col-12 mt-2">
    <div class="light-gray-div light-gray-div-kr mt-2">
        <div class="row gx-3">
            <!--Rental Income-->
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Rental Income <br>
                        <span class="text-c-blue">(This includes renting your house, apartment, or a room to someone else)</span>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="joints_rent_real_property" id="joints_rent_real_property-no"
                            class="d-none required" value="0" {{ Helper::validate_key_toggle('joints_rent_real_property', $debtorspousemonthlyincome, 0) }}>
                        <label for="joints_rent_real_property-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('joints_rent_real_property', $debtorspousemonthlyincome, 0) }}"
                            onclick="isSameJointRentalRealProperty('no');">No</label>

                        <input type="radio" name="joints_rent_real_property" id="joints_rent_real_property-yes"
                            class="d-none required" value="1" {{ Helper::validate_key_toggle('joints_rent_real_property', $debtorspousemonthlyincome, 1) }}>
                        <label for="joints_rent_real_property-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('joints_rent_real_property', $debtorspousemonthlyincome, 1) }}"
                            onclick="isSameJointRentalRealProperty('yes');">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('joints_rent_real_property', $debtorspousemonthlyincome) }}"
                id="joints_rent_real_property">
                 <div class="main-other-sources">
                    <div class="label-div question-area border-0">
                        <label>
                            Do you receive the same amount each month for this income?
                            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Determines if your income remains the same each month or varies.">
                                <i class="bi bi-question-circle"></i>
                            </div>
                        </label>
                        <div class="custom-radio-group form-group">
                            <input type="radio" name="joints_same_rent_income" id="recieve_same_rent_amount-no"
                                class="d-none required" value="0" {{ Helper::validate_key_toggle('joints_same_rent_income', $debtorspousemonthlyincome, 0) }}>
                            <label for="recieve_same_rent_amount-no"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_rent_income', $debtorspousemonthlyincome, 0) }}"
                                onclick="GetJointRentalRealProperty('no');">No</label>

                            <input type="radio" name="joints_same_rent_income" id="recieve_same_rent_amount-yes"
                                class="d-none required" value="1" {{ Helper::validate_key_toggle('joints_same_rent_income', $debtorspousemonthlyincome, 1) }}>
                            <label for="recieve_same_rent_amount-yes"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_rent_income', $debtorspousemonthlyincome, 1) }}"
                                onclick="GetJointRentalRealProperty('yes');">Yes</label>
                        </div>
                    </div>
                    @if(Helper::key_hide_show_v2('joints_same_rent_income', $debtorspousemonthlyincome))
                        <div class="row" id="joints_same_rent_income">
                            @for ($i = 1; $i <= 1; $i++)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label class="d-block">Average (Per month) </label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control price-field required no_dup_inp"
                                                    name="joints_rent_real_property_month[{{ $i }}]"
                                                    value="{{ Helper::validate_key_loop_value('joints_rent_real_property_month', $debtorspousemonthlyincome, $i) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @else
                        <div class="row" id="joints_same_rent_income">
                            @php
                                $currentDate = date('Y-m-d');
                                for ($i = 1; $i <= 6; $i++) {
                                    $month = date('Y-m', strtotime("-$i months", strtotime($currentDate)));
                                    $year = date('Y', strtotime("-$i months", strtotime($currentDate)));
                                    $month_name = date("F", strtotime("-$i months", strtotime($currentDate)));
                            @endphp
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label class="d-block"> Month
                                            {{ $i }}:&nbsp;{{ $month_name . ', ' . $year }} </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control price-field required no_dup_inp"
                                                name="joints_rent_real_property_month[{{ $i }}]"
                                                value="{{ Helper::validate_key_loop_value('joints_rent_real_property_month', $debtorspousemonthlyincome, $i) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                }
                            @endphp
                          </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
