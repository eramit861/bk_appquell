<div class="col-12">
    <div class="light-gray-div light-gray-div-kr  light-gray-div-kr-tech">
        <h2 class="text-dark fw-bold"></h2>
        <div class="row gx-3">
            <!--Regular contributions from others to the household expenses, including child support..-->
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Contribution Income <br><span class="text-c-blue">(Such as child support/alimony and any money or support you get from others.)</span>
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Contribution income includes: any family support, child support, alimony, household contributions, and/or money from someone else helping you cover your monthly bills.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="regular_contributions" id="regular_contributions-no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('regular_contributions', $debtormonthlyincome, 0) }}>
                        <label for="regular_contributions-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('regular_contributions', $debtormonthlyincome, 0) }}"
                            onclick="GetIsDebtorSameRegularContributions('no');">No</label>

                        <input type="radio" name="regular_contributions" id="regular_contributions-yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('regular_contributions', $debtormonthlyincome, 1) }}>
                        <label for="regular_contributions-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('regular_contributions', $debtormonthlyincome, 1) }}"
                            onclick="GetIsDebtorSameRegularContributions('yes');">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('regular_contributions', $debtormonthlyincome) }}"
                id="regular_contributions">
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
                        <input type="radio" name="same_regular_contribution_income" id="same_regular_contributions-no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('same_regular_contribution_income', $debtormonthlyincome, 0) }}>
                        <label for="same_regular_contributions-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('same_regular_contribution_income', $debtormonthlyincome, 0) }}"
                            onclick="GetDebtorRegularContributions('no');">No</label>

                        <input type="radio" name="same_regular_contribution_income"
                            id="same_regular_contributions-yes" class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('same_regular_contribution_income', $debtormonthlyincome, 1) }}>
                        <label for="same_regular_contributions-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('same_regular_contribution_income', $debtormonthlyincome, 1) }}"
                            onclick="GetDebtorRegularContributions('yes');">Yes</label>
                    </div>
                </div>
                @if (Helper::key_hide_show_v2('same_regular_contribution_income', $debtormonthlyincome))
                    <div class="row" id="same_regular_contribution_income">
                        @for ($i = 1; $i <= 1; $i++)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label class="d-block">Average (Per month) </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control price-field required no_dup_inp"
                                                name="regular_contributions_month[{{ $i }}]"
                                                value="{{ Helper::validate_key_loop_value('regular_contributions_month', $debtormonthlyincome, $i) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                @else
                    <div class="row " id="same_regular_contribution_income">
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
                                                name="regular_contributions_month[{{ $i }}]"
                                                value="{{ Helper::validate_key_loop_value('regular_contributions_month', $debtormonthlyincome, $i) }}" />
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