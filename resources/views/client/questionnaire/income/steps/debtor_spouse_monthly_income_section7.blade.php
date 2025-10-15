<div class="col-12">
    <div class="light-gray-div light-gray-div-kr">
        <!-- <h2 class="text-dark fw-bold">Unemployment Compensation, Social Security, and/or Government Assistance</h2> -->
        <div class="row gx-3">
            <!--Unemployment Compensation..-->
            <div class="col-12">
                <div class="label-div question-area">
                    <label>Unemployment Compensation</label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="joints_unemployment_compensation"
                               id="joints_unemployment_compensation-no" class="d-none required" value="0" {{ Helper::validate_key_toggle('joints_unemployment_compensation', $debtorspousemonthlyincome, 0) }}>
                        <label for="joints_unemployment_compensation-no"
                               class="btn-toggle {{ Helper::validate_key_toggle_active('joints_unemployment_compensation', $debtorspousemonthlyincome, 0) }}"
                               onclick="isSameJointUnemploymentCompensation('no');">No</label>

                        <input type="radio" name="joints_unemployment_compensation"
                               id="joints_unemployment_compensation-yes" class="d-none required" value="1" {{ Helper::validate_key_toggle('joints_unemployment_compensation', $debtorspousemonthlyincome, 1) }}>
                        <label for="joints_unemployment_compensation-yes"
                               class="btn-toggle {{ Helper::validate_key_toggle_active('joints_unemployment_compensation', $debtorspousemonthlyincome, 1) }}"
                               onclick="isSameJointUnemploymentCompensation('yes');">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('joints_unemployment_compensation', $debtorspousemonthlyincome) }}"
                 id="joints_unemployment_compensation">
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
                            <input type="radio" name="joints_same_unemployement_compensation"
                                   id="joints_same_unemployment_compensation-no" class="d-none required" value="0" {{ Helper::validate_key_toggle('joints_same_unemployement_compensation', $debtorspousemonthlyincome, 0) }}>
                            <label for="joints_same_unemployment_compensation-no"
                                   class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_unemployement_compensation', $debtorspousemonthlyincome, 0) }}"
                                   onclick="GetJointUnemploymentCompensation('no');">No</label>

                            <input type="radio" name="joints_same_unemployement_compensation"
                                   id="joints_same_unemployment_compensation-yes" class="d-none required" value="1" {{ Helper::validate_key_toggle('joints_same_unemployement_compensation', $debtorspousemonthlyincome, 1) }}>
                            <label for="joints_same_unemployment_compensation-yes"
                                   class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_unemployement_compensation', $debtorspousemonthlyincome, 1) }}"
                                   onclick="GetJointUnemploymentCompensation('yes');">Yes</label>
                        </div>
                    </div>
                    @if(Helper::key_hide_show_v2('joints_same_unemployement_compensation', $debtorspousemonthlyincome))
                        <div class="row" id="joints_same_unemployement_compensation">
                            @for ($i = 1; $i <= 1; $i++)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label class="d-block">Average (Per month) </label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control  price-field required"
                                                       name="joints_unemployment_compensation_month[{{ $i }}]"
                                                       value="{{ Helper::validate_key_loop_value('joints_unemployment_compensation_month', $debtorspousemonthlyincome, $i) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @else
                        <div class="row" id="joints_same_unemployement_compensation">
                            @php
                                $currentDate = date('Y-m-d');
                                    // Loop through the last 6 months
                                    for ($i = 1; $i <= 6; $i++) {
                                        // Calculate the date for the current iteration
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
                                                   name="joints_unemployment_compensation_month[{{ $i }}]"
                                                   value="{{ Helper::validate_key_loop_value('joints_unemployment_compensation_month', $debtorspousemonthlyincome, $i) }}" />
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

<div class="col-12">
    <div class="light-gray-div light-gray-div-kr">
        <!-- <h2 class="text-dark fw-bold">Unemployment Compensation, Social Security, and/or Government Assistance</h2> -->
        <div class="row gx-3">
            <!--Social Security income.-->
            <div class="col-12">
                <div class="label-div question-area">
                    <label>Social Security<span class="text-c-blue"> (SSI/SSDI)</span></label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="joints_social_security" id="joints_social_security-no"
                               class="d-none required" value="0" {{ Helper::validate_key_toggle('joints_social_security', $debtorspousemonthlyincome, 0) }}>
                        <label for="joints_social_security-no"
                               class="btn-toggle {{ Helper::validate_key_toggle_active('joints_social_security', $debtorspousemonthlyincome, 0) }}"
                               onclick="isSameJointSocialIncome('no');">No</label>

                        <input type="radio" name="joints_social_security" id="joints_social_security-yes"
                               class="d-none required" value="1" {{ Helper::validate_key_toggle('joints_social_security', $debtorspousemonthlyincome, 1) }}>
                        <label for="joints_social_security-yes"
                               class="btn-toggle {{ Helper::validate_key_toggle_active('joints_social_security', $debtorspousemonthlyincome, 1) }}"
                               onclick="isSameJointSocialIncome('yes');">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('joints_social_security', $debtorspousemonthlyincome) }}"
                 id="joints_social_security">
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
                            <input type="radio" name="joints_same_social_security_income"
                                   id="joints_same_social_security_income-no" class="d-none required" value="0" {{ Helper::validate_key_toggle('joints_same_social_security_income', $debtorspousemonthlyincome, 0) }}>
                            <label for="joints_same_social_security_income-no"
                                   class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_social_security_income', $debtorspousemonthlyincome, 0) }}"
                                   onclick="GetJointSocialIncome('no');">No</label>

                            <input type="radio" name="joints_same_social_security_income"
                                   id="joints_same_social_security_income-yes" class="d-none required" value="1" {{ Helper::validate_key_toggle('joints_same_social_security_income', $debtorspousemonthlyincome, 1) }}>
                            <label for="joints_same_social_security_income-yes"
                                   class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_social_security_income', $debtorspousemonthlyincome, 1) }}"
                                   onclick="GetJointSocialIncome('yes');">Yes</label>
                        </div>
                    </div>
                    @if(Helper::key_hide_show_v2('joints_same_social_security_income', $debtorspousemonthlyincome))
                        <div class="row" id="joints_same_social_security_income">
                            @for ($i = 1; $i <= 1; $i++)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label class="d-block">Average (Per month) </label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control  price-field required"
                                                       name="joints_social_security_month[{{ $i }}]"
                                                       value="{{ Helper::validate_key_loop_value('joints_social_security_month', $debtorspousemonthlyincome, $i) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @else
                        <div class="row" id="joints_same_social_security_income">
                            @php
                                $currentDate = date('Y-m-d');
                            // Loop through the last 6 months
                            for ($i = 1; $i <= 6; $i++) {
                                // Calculate the date for the current iteration
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
                                                   name="joints_social_security_month[{{ $i }}]"
                                                   value="{{ Helper::validate_key_loop_value('joints_social_security_month', $debtorspousemonthlyincome, $i) }}" />
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

<div class="col-12">
    <div class="light-gray-div light-gray-div-kr">
        <!-- <h2 class="text-dark fw-bold">Unemployment Compensation, Social Security, and/or Government Assistance</h2> -->
        <div class="row gx-3">
            <!--government assistance income.-->
            <div class="col-12">
                <div class="label-div question-area">
                    <label>Government Assistance<span class="text-c-blue"> (SNAP food stamps)</span></label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="government_assistance" id="government_assistance-no"
                               class="d-none required" value="0" {{ Helper::validate_key_toggle('government_assistance', $debtorspousemonthlyincome, 0) }}>
                        <label for="government_assistance-no"
                               class="btn-toggle {{ Helper::validate_key_toggle_active('government_assistance', $debtorspousemonthlyincome, 0) }}"
                               onclick="GetSpouseGovernmentAssistance('no');">No</label>

                        <input type="radio" name="government_assistance" id="government_assistance-yes"
                               class="d-none required" value="1" {{ Helper::validate_key_toggle('government_assistance', $debtorspousemonthlyincome, 1) }}>
                        <label for="government_assistance-yes"
                               class="btn-toggle {{ Helper::validate_key_toggle_active('government_assistance', $debtorspousemonthlyincome, 1) }}"
                               onclick="GetSpouseGovernmentAssistance('yes');">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('government_assistance', $debtorspousemonthlyincome) }}"
                 id="spouse_government_assistance">
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
                            <input type="radio" name="joints_same_government_assistance_income"
                                   id="same_government_assistance-no" class="d-none required" value="0" {{ Helper::validate_key_toggle('joints_same_government_assistance_income', $debtorspousemonthlyincome, 0) }}>
                            <label for="same_government_assistance-no"
                                   class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_government_assistance_income', $debtorspousemonthlyincome, 0) }}"
                                   onclick="IsGetSpouseGovernmentAssistance('no');">No</label>

                            <input type="radio" name="joints_same_government_assistance_income"
                                   id="same_government_assistance-yes" class="d-none required" value="1" {{ Helper::validate_key_toggle('joints_same_government_assistance_income', $debtorspousemonthlyincome, 1) }}>
                            <label for="same_government_assistance-yes"
                                   class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_government_assistance_income', $debtorspousemonthlyincome, 1) }}"
                                   onclick="IsGetSpouseGovernmentAssistance('yes');">Yes</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="label-div">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label class="d-block">Specify</label>
                                        <div class="input-group ">
                                            <input placeholder="Specify" type="text" class="input_capitalize form-control"
                                                   name="government_assistance_specify"
                                                   value="{{ Helper::validate_key_value('government_assistance_specify', $debtorspousemonthlyincome) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Helper::key_hide_show_v2('joints_same_government_assistance_income', $debtorspousemonthlyincome))
                        <div class="row" id="joints_same_government_assistance_income">
                            <div class="col-12">
                                <div class="row">
                                    @for ($i = 1; $i <= 1; $i++)
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                            <div class="label-div">
                                                <div class="label-div">
                                                    <div class="form-group">
                                                        <label class="d-block">Average (Per month) </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">$</span>
                                                            <input type="number" class="form-control price-field required"
                                                                   name="government_assistance_month[{{ $i }}]"
                                                                   value="{{ Helper::validate_key_loop_value('government_assistance_month', $debtorspousemonthlyincome, $i) }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row" id="joints_same_government_assistance_income">
                            @php
                                $currentDate = date('Y-m-d');
                            // Loop through the last 6 months
                            for ($i = 1; $i <= 6; $i++) {
                                // Calculate the date for the current iteration
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
                                                   name="government_assistance_month[{{ $i }}]"
                                                   value="{{ Helper::validate_key_loop_value('government_assistance_month', $debtorspousemonthlyincome, $i) }}" />
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
