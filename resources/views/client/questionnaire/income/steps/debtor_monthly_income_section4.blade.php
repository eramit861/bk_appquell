<div class="col-12 mt-2">
    <div class="light-gray-div light-gray-div-kr light-gray-div-kr-tech">
        <h2 class="text-dark fw-bold"></h2>
        <div class="row gx-3">
            <!--Rental Income-->
            <div class="col-12 ">
                <div class="label-div question-area">
                    <label>
                        Rental Income<br>
                        <span class="text-c-blue">(This includes renting your house, apartment, or a room to someone else)</span>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="rent_real_property" id="rent_real_property-no" class="d-none required"
                            value="0"
                            {{ Helper::validate_key_toggle('rent_real_property', $debtormonthlyincome, 0) }}>
                        <label for="rent_real_property-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('rent_real_property', $debtormonthlyincome, 0) }}"
                            onclick="GetIsDebtorRecievingRentSame('no');">No</label>

                        <input type="radio" name="rent_real_property" id="rent_real_property-yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('rent_real_property', $debtormonthlyincome, 1) }}>
                        <label for="rent_real_property-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('rent_real_property', $debtormonthlyincome, 1) }}"
                            onclick="GetIsDebtorRecievingRentSame('yes');">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12  {{ Helper::key_hide_show_v('rent_real_property', $debtormonthlyincome) }}"
                id="recieve_same_rent_amount">
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
                        <input type="radio" name="same_rent_income" id="recieve_same_rent_amount-no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('same_rent_income', $debtormonthlyincome, 0) }}>
                        <label for="recieve_same_rent_amount-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('same_rent_income', $debtormonthlyincome, 0) }}"
                            onclick="GetDebtorRentalRealProperty('no');">No</label>

                        <input type="radio" name="same_rent_income" id="recieve_same_rent_amount-yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('same_rent_income', $debtormonthlyincome, 1) }}>
                        <label for="recieve_same_rent_amount-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('same_rent_income', $debtormonthlyincome, 1) }}"
                            onclick="GetDebtorRentalRealProperty('yes');">Yes</label>
                    </div>
                </div>
                @if (Helper::key_hide_show_v2('same_rent_income', $debtormonthlyincome))
                    <div class="row  " id="same_rent_income">
                        @for ($i = 1; $i <= 1; $i++)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label class="d-block">Average (Per month) </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control price-field required no_dup_inp"
                                                name="rent_real_property_month[{{ $i }}]"
                                                value="{{ Helper::validate_key_loop_value('rent_real_property_month', $debtormonthlyincome, $i) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                @else
                    <div class="row " id="same_rent_income">
                        @php
                            $currentDate = date('Y-m-d');
                        @endphp
                        @for ($i = 1; $i < 7; $i++)
                            @php
                                // Calculate the date for the current iteration
                                $month = date('Y-m', strtotime("-$i months", strtotime($currentDate)));
                                $year = date('Y', strtotime("-$i months", strtotime($currentDate)));
                                $month_name = date('F', strtotime("-$i months", strtotime($currentDate)));
                            @endphp
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2 ">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label class="d-block"> Month
                                            {{ $i }}:&nbsp;{{ $month_name . ', ' . $year }} </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control price-field required no_dup_inp"
                                                name="rent_real_property_month[{{ $i }}]"
                                                value="{{ Helper::validate_key_loop_value('rent_real_property_month', $debtormonthlyincome, $i) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                @endif
            </div>
            </div>
        </div>
    </div>
</div>
