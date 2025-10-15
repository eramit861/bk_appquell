<div class="col-12">
    <div class="light-gray-div light-gray-div-kr">
        <!-- <h2 class="text-dark fw-bold">Unemployment Compensation, Social Security, and/or Government Assistance</h2> -->
        <div class="row gx-3">

            <!--Unemployment Compensation..-->
            <div class="col-12">
                <div class="label-div question-area">
                    <label>Unemployment Compensation</label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="unemployment_compensation" id="unemployment_compensation-no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('unemployment_compensation', $debtormonthlyincome, 0) }}>
                        <label for="unemployment_compensation-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('unemployment_compensation', $debtormonthlyincome, 0) }}"
                            onclick="GetDebtorIsSameUnemploymentCompensation('no');">No</label>

                        <input type="radio" name="unemployment_compensation" id="unemployment_compensation-yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('unemployment_compensation', $debtormonthlyincome, 1) }}>
                        <label for="unemployment_compensation-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('unemployment_compensation', $debtormonthlyincome, 1) }}"
                            onclick="GetDebtorIsSameUnemploymentCompensation('yes');">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('unemployment_compensation', $debtormonthlyincome) }}"
                id="unemployment_compensation">
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
                        <input type="radio" name="same_unemployement_compensation_income"
                            id="same_unemployment_compensation-no" class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('same_unemployement_compensation_income', $debtormonthlyincome, 0) }}>
                        <label for="same_unemployment_compensation-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('same_unemployement_compensation_income', $debtormonthlyincome, 0) }}"
                            onclick="GetDebtorUnemploymentCompensation('no');">No</label>

                        <input type="radio" name="same_unemployement_compensation_income"
                            id="same_unemployment_compensation-yes" class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('same_unemployement_compensation_income', $debtormonthlyincome, 1) }}>
                        <label for="same_unemployment_compensation-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('same_unemployement_compensation_income', $debtormonthlyincome, 1) }}"
                            onclick="GetDebtorUnemploymentCompensation('yes');">Yes</label>
                    </div>
                </div>
                @if (Helper::key_hide_show_v2('same_unemployement_compensation_income', $debtormonthlyincome))
                    <div class="row " id="same_unemployement_compensation_income">
                        @for ($i = 1; $i <= 1; $i++)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label class="d-block">Average (Per month) </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control price-field required no_dup_inp"
                                                name="unemployment_compensation_month[{{ $i }}]"
                                                value="{{ Helper::validate_key_loop_value('unemployment_compensation_month', $debtormonthlyincome, $i) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                @else
                    <div class="row" id="same_unemployement_compensation_income">
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
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label class="d-block"> Month
                                            {{ $i }}:&nbsp;{{ $month_name . ', ' . $year }} </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control price-field required no_dup_inp"
                                                name="unemployment_compensation_month[{{ $i }}]"
                                                value="{{ Helper::validate_key_loop_value('unemployment_compensation_month', $debtormonthlyincome, $i) }}" />
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

<div class="col-12">
    <div class="light-gray-div light-gray-div-kr">
        <!--Social Security income.-->
        <div class="col-12">
            <div class="label-div question-area">
                <label>Social Security<span class="text-c-blue"> (SSI/SSDI)</span></label>
                <div class="custom-radio-group form-group">
                    <input type="radio" name="social_security" id="social_security-no" class="d-none required"
                        value="0"
                        {{ Helper::validate_key_toggle('social_security', $debtormonthlyincome, 0) }}>
                    <label for="social_security-no"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('social_security', $debtormonthlyincome, 0) }}"
                        onclick="GetIsSameDebtorSocialIncome('no');">No</label>

                    <input type="radio" name="social_security" id="social_security-yes" class="d-none required"
                        value="1"
                        {{ Helper::validate_key_toggle('social_security', $debtormonthlyincome, 1) }}>
                    <label for="social_security-yes"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('social_security', $debtormonthlyincome, 1) }}"
                        onclick="GetIsSameDebtorSocialIncome('yes');">Yes</label>
                </div>
            </div>
        </div>
        <div class="col-12 p-0 {{ Helper::key_hide_show_v('social_security', $debtormonthlyincome) }}"
            id="social_security">
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
                    <input type="radio" name="same_social_security_income" id="same_social_security-no"
                        class="d-none required" value="0"
                        {{ Helper::validate_key_toggle('same_social_security_income', $debtormonthlyincome, 0) }}>
                    <label for="same_social_security-no"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('same_social_security_income', $debtormonthlyincome, 0) }}"
                        onclick="GetDebtorSocialIncome('no');">No</label>

                    <input type="radio" name="same_social_security_income" id="same_social_security-yes"
                        class="d-none required" value="1"
                        {{ Helper::validate_key_toggle('same_social_security_income', $debtormonthlyincome, 1) }}>
                    <label for="same_social_security-yes"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('same_social_security_income', $debtormonthlyincome, 1) }}"
                        onclick="GetDebtorSocialIncome('yes');">Yes</label>
                </div>
            </div>
            @if (Helper::key_hide_show_v2('same_social_security_income', $debtormonthlyincome))
                <div class="row " id="same_social_security_income">
                    @for ($i = 1; $i <= 1; $i++)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="d-block">Average (Per month) </label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control price-field required no_dup_inp"
                                            name="social_security_month[{{ $i }}]"
                                            value="{{ Helper::validate_key_loop_value('social_security_month', $debtormonthlyincome, $i) }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @else
                <div class="row" id="same_social_security_income">
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
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="d-block"> Month
                                        {{ $i }}:&nbsp;{{ $month_name . ', ' . $year }} </label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control price-field required no_dup_inp"
                                            name="social_security_month[{{ $i }}]"
                                            value="{{ Helper::validate_key_loop_value('social_security_month', $debtormonthlyincome, $i) }}" />
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

<div class="col-12">
    <div class="light-gray-div light-gray-div-kr">
        <!--government assistance income.-->
        <div class="col-12">
            <div class="label-div question-area">
                <label>Government Assistance<span class="text-c-blue"> (SNAP food stamps)</span></label>
                <div class="custom-radio-group form-group">
                    <input type="radio" name="government_assistance" id="government_assistance-no"
                        class="d-none required" value="0"
                        {{ Helper::validate_key_toggle('government_assistance', $debtormonthlyincome, 0) }}>
                    <label for="government_assistance-no"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('government_assistance', $debtormonthlyincome, 0) }}"
                        onclick="GetIsSameDebtorGovernmentAssistance('no');">No</label>

                    <input type="radio" name="government_assistance" id="government_assistance-yes"
                        class="d-none required" value="1"
                        {{ Helper::validate_key_toggle('government_assistance', $debtormonthlyincome, 1) }}>
                    <label for="government_assistance-yes"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('government_assistance', $debtormonthlyincome, 1) }}"
                        onclick="GetIsSameDebtorGovernmentAssistance('yes');">Yes</label>
                </div>
            </div>
        </div>
        <div class="col-12 p-0 {{ Helper::key_hide_show_v('government_assistance', $debtormonthlyincome) }}"
            id="government_assistance">
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
                    <input type="radio" name="same_government_assistance_income"
                        id="same_government_assistance-no" class="d-none required" value="0"
                        {{ Helper::validate_key_toggle('same_government_assistance_income', $debtormonthlyincome, 0) }}>
                    <label for="same_government_assistance-no"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('same_government_assistance_income', $debtormonthlyincome, 0) }}"
                        onclick="GetDebtorGovernmentAssistance('no');">No</label>

                    <input type="radio" name="same_government_assistance_income"
                        id="same_government_assistance-yes" class="d-none required" value="1"
                        {{ Helper::validate_key_toggle('same_government_assistance_income', $debtormonthlyincome, 1) }}>
                    <label for="same_government_assistance-yes"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('same_government_assistance_income', $debtormonthlyincome, 1) }}"
                        onclick="GetDebtorGovernmentAssistance('yes');">Yes</label>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="label-div">
                        <div class="form-group">
                            <label class="d-block">Specify</label>
                            <div class="input-group ">
                                <input placeholder="Specify" type="text"
                                    class="input_capitalize form-control no_dup_inp"
                                    name="government_assistance_specify"
                                    value="{{ Helper::validate_key_value('government_assistance_specify', $debtormonthlyincome) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Helper::key_hide_show_v2('same_government_assistance_income', $debtormonthlyincome))
                <div class="row" id="same_government_assistance_income">
                    <div class="col-12">
                        <div class="row ">
                            @for ($i = 1; $i <= 1; $i++)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label class="d-block">Average (Per month) </label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number"
                                                    class="form-control price-field required no_dup_inp"
                                                    name="government_assistance_month[{{ $i }}]"
                                                    value="{{ Helper::validate_key_loop_value('government_assistance_month', $debtormonthlyincome, $i) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            @else
                <div class="row" id="same_government_assistance_income">
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
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="d-block"> Month
                                        {{ $i }}:&nbsp;{{ $month_name . ', ' . $year }} </label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control price-field required no_dup_inp"
                                            name="government_assistance_month[{{ $i }}]"
                                            value="{{ Helper::validate_key_loop_value('government_assistance_month', $debtormonthlyincome, $i) }}" />
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