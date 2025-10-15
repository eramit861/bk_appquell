<div class="col-12">
    <div class="light-gray-div light-gray-div-kr">
        <h2 class="text-dark fw-bold"></h2>
        <div class="row gx-3">
            <!--Regular contributions from others to the household expenses, including child support..-->
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Contribution Income <br>
                        <span class="text-c-blue">(Such as child support/alimony and any money or support you get from others.)</span>
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                             data-bs-original-title="Contribution income includes: any family support, child support, alimony, household contributions, and/or money from someone else helping you cover your monthly bills.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="joints_regular_contributions" id="joints_regular_contributions-no"
                               class="d-none required" value="0" {{ Helper::validate_key_toggle('joints_regular_contributions', $debtorspousemonthlyincome, 0) }}>
                        <label for="joints_regular_contributions-no"
                               class="btn-toggle {{ Helper::validate_key_toggle_active('joints_regular_contributions', $debtorspousemonthlyincome, 0) }}"
                               onclick="isSameJointRegularContributions('no');">No</label>

                        <input type="radio" name="joints_regular_contributions" id="joints_regular_contributions-yes"
                               class="d-none required" value="1" {{ Helper::validate_key_toggle('joints_regular_contributions', $debtorspousemonthlyincome, 1) }}>
                        <label for="joints_regular_contributions-yes"
                               class="btn-toggle {{ Helper::validate_key_toggle_active('joints_regular_contributions', $debtorspousemonthlyincome, 1) }}"
                               onclick="isSameJointRegularContributions('yes');">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('joints_regular_contributions', $debtorspousemonthlyincome) }}"
                 id="joints_regular_contributions">
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
                            <input type="radio" name="joints_same_contribution_income"
                                   id="joints_same_contribution_income-no" class="d-none required" value="0" {{ Helper::validate_key_toggle('joints_same_contribution_income', $debtorspousemonthlyincome, 0) }}>
                            <label for="joints_same_contribution_income-no"
                                   class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_contribution_income', $debtorspousemonthlyincome, 0) }}"
                                   onclick="GetJointRegularContributions('no');">No</label>

                            <input type="radio" name="joints_same_contribution_income"
                                   id="joints_same_contribution_income-yes" class="d-none required" value="1" {{ Helper::validate_key_toggle('joints_same_contribution_income', $debtorspousemonthlyincome, 1) }}>
                            <label for="joints_same_contribution_income-yes"
                                   class="btn-toggle {{ Helper::validate_key_toggle_active('joints_same_contribution_income', $debtorspousemonthlyincome, 1) }}"
                                   onclick="GetJointRegularContributions('yes');">Yes</label>
                        </div>
                    </div>
                    @if(Helper::key_hide_show_v2('joints_same_contribution_income', $debtorspousemonthlyincome))
                        <div class="row" id="joints_same_contribution_income">
                            @for ($i = 1; $i <= 1; $i++)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label class="d-block">Average (Per month) </label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control price-field required no_dup_inp"
                                                       name="joints_regular_contributions_month[{{ $i }}]"
                                                       value="{{ Helper::validate_key_loop_value('joints_regular_contributions_month', $debtorspousemonthlyincome, $i) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @else
                        <div class="row" id="joints_same_contribution_income">
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
                                                   name="joints_regular_contributions_month[{{ $i }}]"
                                                   value="{{ Helper::validate_key_loop_value('joints_regular_contributions_month', $debtorspousemonthlyincome, $i) }}" />
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
